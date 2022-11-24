<?php
    session_start();

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
  <title>Sign up</title>
  <link rel="stylesheet" href="css/login_register.css" type="text/css">
  <script src="js/register.js"></script> 
</head>
<body>
<?php
    // Check if some error exist and inform user
    if(isset($_GET['error'])){
        if($_GET['error'] == "sqlerror"){
          echo "<script>alert('There is something wrong with the database');</script>";
        }
        else if($_GET['error'] == "userexists"){
          echo "<script>alert('ID, Username or Email already exists!');</script>";
        }
        else{
          echo "<script>alert('Unexpected error');</script>";
        }
    }
?>
<div class="login_register-page">
    <div class="form">
    <div class='login_register-form-text'><h2>Welcome to Students Management System</h2></div>
    <form name="register-form" class="register-form" onsubmit="return validateForm()" action="includes/register.inc.php"  method="post">
      <input type="text" name="register-id" maxlength="255" placeholder="ID*" required pattern="[A-Za-z0-9]+" title="Could contain only latin characters and numbers."/>
      <input type="text" name="register-name" maxlength="255" placeholder="Name*" required pattern="[A-Za-z]+" title="Could contain only latin characters."/>
      <input type="text" name="register-surname" maxlength="255" placeholder="Surname*" required pattern="[A-Za-z]+" title="Could contain only latin characters."/>
      <input type="text" name="register-username" maxlength="255" placeholder="Username*" required pattern="[A-Za-z0-9_]+" title="Could contain only latin characters, numbers and underscore."/>
      <input type="email" name="register-email1" maxlength="255" placeholder="Email*" title="Please enter an acceptable email. E.g: joe-smith_2@email.com" required pattern="[^@]+@[a-zA-Z0-9]+\.[a-z]+"/>
      <input type="email" name="register-email2" maxlength="255" placeholder="Email (again)*" title="Please enter an acceptable email. E.g: joe-smith_2@email.com" required pattern="[^@]+@[a-zA-Z0-9]+\.[a-z]+"/>
      <input type="password" name="register-pwd1" maxlength="50" placeholder="Password*" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
      <input type="password" name="register-pwd2" maxlength="50" placeholder="Password (again)*" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
      <button type="submit" name="register-submit">SIGN UP</button>
      <p class="message">Already registered? <a href="index.php">Sign In</a></p>
    </form>
  </div>
</div>
</body>
</html>

