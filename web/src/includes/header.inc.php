<?php
    session_start();

    // Check if user is not connected
    if (!isset($_SESSION["Username"])){
        header("Location: ../index.php");
        exit();
    }
    $username = $_SESSION["Username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo "<title>".substr(basename($_SERVER['PHP_SELF']),0,-4)."</title>"; ?>
    <link rel="stylesheet" href="../css/header.css" type="text/css">
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/tables.css" type="text/css">
</head>
<body>
    <header>
        <nav class ="menubar">
            <ul>
                <li><div class="nav-item left"><a href="Teachers.php">Home</a></div></li>
                <li><div class="nav-item left"><a href="AddStudent.php">Add</a></div></li>
                <li><div class="nav-item left"><a href="EditStudent.php">Edit</a></div></li>
                <li><div class="nav-item left"><a href="DeleteStudent.php">Delete</a></div></li>
                <li><div class="nav-item left"><a href="SearchStudent.php">Search</a></div></li>
                <li><div class="nav-item logout-user right"><a href="/includes/logout.inc.php">Logout</a></div></li>
            </ul>
            <div class="user-name-header"><?php echo $username;?></div>
        </nav>
    </header>
    <br>
    <br>
    