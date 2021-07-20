<?php
session_start();
require "../../models/users/login.php";
// check if user entered email and password
if (! isset($_POST['email']) || $_POST['email'] == ""){
    $_SESSION['invalidEmail'] = "Enter Your Email";
}
if (!isset($_POST['password']) || $_POST['password'] == "")
{
    $_SESSION['invalidPass'] = "Enter Your Password";
}

if (!isset($_SESSION['invalidEmail']) && !isset($_SESSION['invalidPass']))
{
   $logger = new LoginModel($_POST['email'], $_POST['password']);
   $currentUser = $logger->login();
    if($currentUser)
    {
        $_SESSION['user_logged'] = true;
        $_SESSION['id'] = $currentUser["id"];
        $_SESSION["username"] = ucfirst($currentUser["username"]);
        $_SESSION["gender"] = $currentUser["gender"];
        $_SESSION["email"] = $currentUser["email"];
        $_SESSION["image_link"] = $currentUser["image_link"];
        $_SESSION["password"] = $_SESSION["password"];
        header("location:/friends");

    }
    else
    {
        $_SESSION['userNotLogged'] = "Invalid Email or Password";
        header("location:/friends/views/users/login.php");
    }
}
else
{
    header("location:/friends/views/users/login.php");
}