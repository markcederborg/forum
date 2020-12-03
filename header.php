<?php
session_start();
$page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="./Assets/script.js" charset="utf-8"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Assets/style.css">
    <title>Wits Project</title>
</head>
<body>
    <header>
        <nav>
            <ul>
              <li class="<?php if($page == 'index.php'){ echo 'current';}?>"><a href="index.php" >Home</a></li>
<?php
if(isset($_SESSION['username'])){ ?>
  <li class="<?php if($page == 'logout.php'){ echo 'current';}?>"><a href="logout.php" >Logout</a></li>
<?php }else{ ?>
  <li class="<?php if($page == 'login.php'){ echo 'current';}?>"><a href="login.php" >Login</a></li>
<?php } ?>

                <li class="<?php if($page == 'signup.php'){ echo 'current';}?>"><a href="signup.php" >Signup</a></li>
                <li style="float: right;"class="<?php if($page == 'about.php'){ echo 'current';}?>"><a href="about.php" >About</a></li>
            </ul>
        </nav>
    </header>
<main>
