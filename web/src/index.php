<?php
    session_start();

    // If you are already connected goto Home page
    if (isset($_SESSION["Username"])){
        header("Location: ./Teachers.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login page</title>
  <link rel="stylesheet" href="css/login_register.css" type="text/css">
</head>
<body>
<?php
  if(isset($_GET['error'])){
    if($_GET['error'] == "sqlerror"){
      echo "<script>alert('There is something wrong with the database');</script>";
    }
    else if($_GET['error'] == "wrongcrentetials1" || $_GET['error'] == "wrongcrentetials2"){
      echo "<script>alert('Username or password is wrong');</script>";
    }
    else{
      echo "<script>alert('Unexpected error');</script>";
    }
  }
  else if (isset($_GET['register'])){
    if($_GET['register'] == "true"){
      echo "<script>alert('User Created!');</script>";
    }
  }
?>
<div class="login_register-page">
  <div class="form">
    <div class='login_register-form-text'><h2>Welcome to Students Management System</h2></div>
    <form class="login-form" action="includes/login.inc.php" method="post">
      <input type="text" name="login-email" maxlength="100" placeholder="Username/Email*" required/>
      <input type="password" name="login-pwd" maxlength="100" placeholder="Password*" required/>
      <button type="submit" name="login-submit">LOGIN</button>
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p> 
    </form>
  </div>
</div>
</body>
</html>

