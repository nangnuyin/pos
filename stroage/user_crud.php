<?php

function save_user($mysqli,$name,$email,$password,$role,$profile)
{
    $sql = "INSERT INTO `user` (`username`,`email`,`password`,`role`,`profile`) VALUE ('$name','$email','$password','$role','$profile')";
    return $mysqli->query($sql);
    
}

function get_user_with_id($mysqli,$id)
{
    $sql = "SELECT * FROM `user` WHERE `id`=$id";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

function get_user_with_email($mysqli,$mail)
{
    $sql = "SELECT * FROM `user` WHERE `email`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

// function get_users($mysql,$currentPage)
// {
//     $sql = "SELECT * FROM `user` ORDER BY `id` LIMIT 5 OFFSET $currentPage";
//     return $mysqli->query($sql);
// }


