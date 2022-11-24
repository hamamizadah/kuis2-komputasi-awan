<?php
    if (isset($_POST['edit-student-submit'])){
        require "dbh.inc.php" ;

        $uid = $_POST['edit-student-id'];
        $uname = $_POST['edit-student-name'];
        $usname = $_POST['edit-student-surname'];
        $ufather = $_POST['edit-student-fathername'];
        $ugrade = $_POST['edit-student-grade'];
        $uphone = $_POST['edit-student-mobile'];
        $ubdate = $_POST['edit-student-birthday'];

        // Check in backend if fields are acceptable
        if (empty($uid) || empty($uname) || empty($usname) || empty($ufather) || empty($ugrade) || empty($uphone) || empty($ubdate)){
            header("Location: ../EditStudent.php?error=emptyfields");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9_]+$/", $uid)){
            header("Location: ../EditStudent.php?error=notvalidid");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $uname)){
            header("Location: ../EditStudent.php?error=notvalidname");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $usname)){
            header("Location: ../EditStudent.php?error=notvalidsurname");
            exit();
        }
        else if (!preg_match("/^[A-Za-z]+$/", $ufather)){
            header("Location: ../EditStudent.php?error=notvalidusername");
            exit();
        }
        else if (!preg_match("/^[0-9\-\(\) \+]+$/", $uphone)){
            header("Location: ../EditStudent.php?error=notvalidusername");
            exit();
        }
    
        // Prepare query using placeholders (prevent sql injection)
        $sql = "UPDATE Students SET NAME = ?, SURNAME = ?, FATHERNAME = ?, GRADE = ?, MOBILENUMBER = ?, Birthday = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../EditStudent.php?error=sqlerror");
            exit();
        }
    
        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "sssssss", $uname, $usname, $ufather, $ugrade, $uphone, $ubdate, $uid);
        mysqli_stmt_execute($stmt);
    
        if(mysqli_stmt_affected_rows($stmt)){
            header("Location: ../EditStudent.php?edited=true");
            exit();
        }
        else{
            // echo mysqli_stmt_error($stmt);
            header("Location: ../EditStudent.php?edited=false");
            exit();
        }
    
        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access register without submiting form
    else{
        header("Location: ../EditStudent.php?POST=false");
        exit();
    }
    