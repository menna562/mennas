<?php
require "../../models/users/register.php";
require "../../config.php";

session_start();

$_SESSION["username"] = $_POST["username"];
$_SESSION["password"] = $_POST["password"];
$_SESSION["confirmpass"] = $_POST["confirmpass"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["gender"] = $_POST["gender"];

header("location:/friends/views/users/register.php");

// errors array
$_SESSION["errors"] = [];

// validating username
if (! isset($_SESSION['username']) || $_SESSION["username"] == "")
{
    $_SESSION['errors']["invalidUserName"] = "Please Enter Your Username";
}
// validating password
if ($_SESSION["password"] !== $_SESSION["confirmpass"])
{
    $_SESSION['errors']["dontMatch"] = "Passwords don't Match";
}

if(isset($_SESSION['password']))
{
    $password = $_SESSION['password'];
 
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
 
    if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        $_SESSION['errors']["invalidPassword"] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    } 
}

// validating email

if (! filter_var($_SESSION["email"]))
{
    $_SESSION['errors']["invalidEmail"] = "Please Enter a Valid Email";
}
// validating gender
if (!isset($_POST['gender']) || ! in_array( $_POST['gender'], ["male", "female"]))
{
    $_SESSION['errors']["invalidGender"] = "Please Select your gender";
}
// validating image
if(strlen($_FILES["image"]["name"]) !== 0){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions) === false){
        $_SESSION['errors']["imageError"] = "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152) {
        $_SESSION['errors']["imageError"] ='Max file size is 2 MB ';
    }
 }

// registration
if (count($_SESSION['errors']) == 0)
{
    if (strlen($_FILES["image"]["name"]) !== 0){
        
        $uniqueName = uniqid();
        $imagePath = "/friends/assets/images/users_pics/".$uniqueName.".".$file_ext;
        $imageDestination = DOCUMENT_ROOT."friends/assets/images/users_pics/".$uniqueName.".".$file_ext;
        if(!move_uploaded_file($file_tmp,$imageDestination))
        {
            $_SESSION['errors']["imageError"] = "Sorry Couldn't save your image";
        }
    }else{
        $imagePath = null;
    }
    

    // hashing password
    $password = $_SESSION["password"];
    $hash_variable_salt = password_hash($password, PASSWORD_DEFAULT, array('cost' => 9));
    $registrator = new RegisterModel($_SESSION["username"], $hash_variable_salt, $_SESSION['email'], $_SESSION["gender"], $imagePath);

    if (!$registrator->emailAreadyExists()) //check if email is bound to another account
    {
    $newUserId = $registrator->register();
    if ($newUserId)
    {
        session_destroy();
        session_start();
        $_SESSION["userAdded"] = "Welcome ". ucfirst($_POST['username']). " your account is ready, please Log";
        header("location:/friends/views/users/login.php");
    }
    }else
    {
        $_SESSION['errors']["emailAlreadyExist"] = "Looks like you Already have an account ! please log in or use different Email.";
        header("location:/friends/views/users/register.php");
    }

    

}else{
    header("location:/friends/views/users/register.php");
}

