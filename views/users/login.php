<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/log_register.css">

    <script>
    window.addEventListener("load", function () {
        document.getElementsByTagName("button")[0].addEventListener("click", function () {
            window.location.href = "/friends/views/users/register.php";
        })// end of click on register button
    }); //end of load event
    </script>
</head>
<body>
    <?php
        session_start();
        // registration success message
        if (isset($_SESSION['userAdded']))
        {
            echo '<div class="successMessage">';
                echo $_SESSION['userAdded'];
            echo "</div>";
            unset($_SESSION['userAdded']);
        }
        // main error messaage
        if (isset($_SESSION['userNotLogged']))
        {
            echo '<div class="mainErrormessage">';
                echo $_SESSION['userNotLogged'];
            echo "</div>";
            unset($_SESSION['userNotLogged']);
        }
    ?>
    <div class="mainwraper">
        <h1>login</h1>
        <form action="/friends/controllers/users/login.php" method="POST">
            <div class="inputs">
                <label for="email">Email</label>
                <!-- //usename error message -->
                <?php
                    if (isset($_SESSION['invalidEmail']))
                    {
                        echo "<span class='error errorusername'>".$_SESSION['invalidEmail']."</span>";
                        unset($_SESSION['invalidEmail']);
                    }
                ?>
                <input type="text" name="email" id="username" autocomplete="off" autofocus>
                <label for="password">Password</label>
                <!-- password error messages -->
                <?php
                    if (isset($_SESSION['invalidPass']))
                    {
                        echo "<span class='error errorusername'>".$_SESSION['invalidPass']."</span>";
                        unset($_SESSION['invalidPass']);
                    }
                ?>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>
            <input type="submit" value="Ok" id="ok">
            <input type="reset" value="Cancel" id="cancel">
        </form>
        <div id="or">Or</div>
        <button>Register</button>
    </div>
</body>
</html>