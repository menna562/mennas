<?php  
    require "../../models/users/profile_setting.php";
    require_once('../../models/database.php');


    // session_start();
    
    $_SESSION["currentpassword"] = $_POST["currentpassword"];
    $_SESSION["newpassword"] = $_POST["newpassword"];
    $_SESSION["confirmpassword"] = $_POST["confirmpassword"];
    $password=$_SESSION['password'];

    $_SESSION["errors"] = [];


if ($_SESSION["currentpassword"] !== $_SESSION["password"])
{
    $_SESSION['errors']["dontMatch"] = "Wrong Password";
}
    // validate password
if ($_SESSION["newpassword"] !== $_SESSION["confirmpassword"])
{
    $_SESSION['errors']["dontMatch"] = "Passwords don't Match";
}

if(isset($_SESSION['newpassword']))
{
    $newpassword = $_SESSION['newpassword'];
 
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
 
    if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        $_SESSION['errors']["invalidPassword"] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    } 
}

 $updatedata = new updatedata($_SESSION["username"], $_SESSION['password']);

    $updatedata->updatedata();
    header("Location:/friends/views/users/profile_setting.php");
?>