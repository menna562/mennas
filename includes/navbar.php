 <!-- navbar  -->
<?php
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-3" href="/friends">Home</a>
    <a class="navbar-brand ms-5" href="/friends/views/users/profile.php">My Profile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end pe-5" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mt-2" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION["username"] ?>
          </a>
          <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/friends/views/users/profile_setting.php">Profile Setting</a></li>
            <li><a class="dropdown-item text-danger" href="/friends/controllers/users/logout.php">Log Out</a></li>
          </ul>
        </li>
      <li class="nav-item ms-2" style="font-size: 32px;">
      <?php
          if(isset($_SESSION["image_link"])){
            echo '<img style="width: 50px; border-radius: 50%;" src="';
            echo $_SESSION['image_link'];
            echo '" alt="Profile Picture" />';

          }else{
              echo ($_SESSION["gender"] == "male" ?  '<i class="fas fa-user text-light"></i>' : '<i class="fas fa-female" style="color:#E95771; font-size:1.5rem;" ></i>');
          }
      ?>
      </li>
      </ul>
    </div>
  </div>
</nav>
<!-- end of navbar -->