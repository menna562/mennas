<!-- //profile setting -->
<?php
session_start();
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/profile_setting.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <form action="/friends/controllers/users/profile_setting.php" method="POST" class="border">
                  <label for="inputPassword5" class="form-label">username</label>
                  <input type="text" name="username" value="<?php echo $_SESSION["username"] ?>" class="form-control" >


                  <label for="inputPassword5" class="form-label">Current Password</label>
                  <input type="password" name="currentpassword" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

               
                  <label for="inputPassword5" class="form-label">New Password</label>
                  <input type="password" name="newpassword" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

                  <label for="inputPassword5" class="form-label">confirm Password</label>
                  <input type="password" name="confirmpassword" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

                  <button type="submit" class="btn btn-secondary btn-sm">Update</button>
                </form>
            </div>
        </div>

   </div>
</body>    