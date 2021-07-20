<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../assets/css/log_register.css">
</head>
<style>
    .mainwraper
    {
        margin: 30px auto;
        height: 570px;
        padding-top: 10px;
    }
    #ok, #cancel
    {
        margin-top: 0px;
    }
</style>
<body>
    <!-- error messages -->
   
    <!-- password error messages -->
     <?php
        session_start();
        if (isset($_SESSION['errors']["invalidPassword"]))
        {
            echo "<span class='error mainErrormessage'>".$_SESSION['errors']["invalidPassword"]."</span>";
            unset($_SESSION['errors']["invalidPassword"]);
        }
    ?>

    <!-- email already registered  -->
    <?php
        if (isset($_SESSION['errors']["emailAlreadyExist"]))
        {
            echo "<span class='error mainErrormessage'>".$_SESSION['errors']["emailAlreadyExist"]."</span>";
            unset($_SESSION['errors']["emailAlreadyExist"]);
        }
    ?>
    <!-- end of  error messages -->

    <!-- registration form -->
    <div class="mainwraper">
        <h1>Register</h1>
        <form action="/friends/controllers/users/register.php" method="POST" enctype="multipart/form-data">
            <div class="inputs">
                <label for="username">User Name</label> 
                <!-- username error -->
                <?php
                    if (isset( $_SESSION['errors']["invalidUserName"]))
                    {
                        echo "<span class='error errorusername'>".$_SESSION['errors']["invalidUserName"]."</span>";
                        unset($_SESSION['errors']["invalidUserName"]);
                    }
                ?>
                <input type="text" name="username" id="username" autocomplete="off" value="<?= isset($_SESSION["username"]) ? htmlentities($_SESSION["username"]) : "" ?>" autofocus />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" value="<?= isset($_SESSION["password"]) ? htmlentities($_SESSION["password"]) : "" ?>" />
                <label for="password">Confirm Password</label>
                <!-- confirm match error -->
                <?php
                    if (isset($_SESSION['errors']["dontMatch"]))
                    {
                        echo "<span class='error errorusername'>".$_SESSION['errors']["dontMatch"]."</span>";
                        unset($_SESSION['errors']["dontMatch"]);
                    }
                ?>
                <input type="password" name="confirmpass" id="confirmpass" value="<?= isset($_SESSION["confirmpass"]) ? htmlentities($_SESSION["confirmpass"]) : "" ?>" />
                <label for="email">E-mail</label>
                <!-- email errormessage -->
                <?php
                    if (isset($_SESSION['errors']["invalidEmail"]))
                    {
                        echo "<span class='error errorusername'>".$_SESSION['errors']["invalidEmail"]."</span>";
                        unset($_SESSION['errors']["invalidEmail"]);
                    }
                ?>
                <input type="text" name="email" id="email"  autocomplete="off" value="<?= isset($_SESSION["email"]) ? htmlentities($_SESSION["email"]) : "" ?>" />
                <div class="genderwraper">
                    <label for="male" id="genderLabel">Gender</label>
                    <input type="radio" name="gender" id="male" value="male" <?=  ( isset($_SESSION["gender"]) && $_SESSION["gender"] == "male") ? "checked" : "" ?> />
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female" <?= ( isset($_SESSION["gender"]) && $_SESSION["gender"] == "female") ? "checked" : "" ?> />
                    <label for="female">Female</label> <br>
                    <!-- gender error -->
                    <?php
                        if (isset($_SESSION['errors']["invalidGender"]))
                        {
                            echo "<span class='error gendererror'>".$_SESSION['errors']["invalidGender"]."</span>";
                            unset($_SESSION['errors']["invalidGender"]);
                        }
                    ?>
                </div>
                <div class="imageUpload">
                         <!-- image upload -->
                        <label for="images">Profile Picture</label>
                        <?php
                            if (isset($_SESSION['errors']["imageError"]))
                                {
                                    echo "<span class='error imageError'>".$_SESSION['errors']["imageError"]."</span>";
                                    unset($_SESSION['errors']["imageError"]);
                                }
                            ?>
                        <input type = "file" name = "image" id="image" />
                </div>
            </div>
            <input type="submit" value="Ok" id="ok">
            <input type="reset" value="Cancel" id="cancel">
            <p id="already">Already registerd? <a href="/friends/views/users/login.php">Login</a></p>
        </form>
    </div>
</body>
</html>