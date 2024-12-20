<?php require_once ("./stroage/db.php") ?>
<?php require_once ("./stroage/user_crud.php") ?>
<?php

// $user = get_user_with_id($mysqli, 1);
// if (!$user) {
//     save_user($mysqli, "admin", "admin@gmail.com", "password", 1);
// }
$users = get_users($mysqli);
$users = $users->fetch_all();
$admin_user = array_filter($users, function ($user) {
    return $user[4] == 1;
});
if (!$admin_user) {
    $admin_password = password_hash("password", PASSWORD_BCRYPT);
    save_user($mysqli, "admin", "admin@gmail.com", $admin_password, 1);
}

$email = $email_err = $password = $password_err = "";

if (isset($_POST['email']) ){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email === ""){
        $email_err = "Email cann't be blank!";
    }
    if($password === ""){
        $password_err = "Password cann't be blank!";
    }
    if($email_err === "" && $password_err === ""){
        $user = get_user_with_email($mysqli,$email);
        if(!$user){
            $email_err = "User does not exist!";
        }else{
            if($password !== $user['password']){
                $password_err = "Password does not match!";
            }else{
                header("Location:./home.php");
            }
        }
        if($password === $user['password']){

        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
</head>
<body>
    <div class="card  mx-auto login-container">
        <div class="card-body">
            <h2 class="text-center">Login Form</h2>
            <form action="post">
            <div class="form-floating mt-5">
                <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>" placeholder="enter email"/>
                <label for="email">Email Address</label>
                <div class="text-danger" style="font-size:12px;"><?= $email_err ?></div>
            </div>
            <div class="form-floating mt-5">
                <input type="password" name="password" id="password" class="form-control" value="<?= $password ?>" placeholder="enter password" />
                <label for="password">Password</label>
                <div class="text-danger" style="font-size:12px;"><?= $password_err ?></div>
            </div>
            <div>
                <input type="checkbox" class="form-check-label" id="show">
                <label class="form-check-label" for="checkbox" >Show Password</label>
            </div>
            <div class="d-grid mt-3">
                <button type="button" class="btn btn-primary">LOGIN</button>
            </div>
            
        </form>
        </div>

    </div>
    <script>
        let show = $("#show");
        let password = $("#password");
        show.on("click",()=>{
            if(show.is(":checked")){
                password.get(0).type = "text";
            }else{
                password.get(0).type ="password";
            }
        })
    </script>
</body>
</html>