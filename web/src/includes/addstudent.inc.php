<?php
    if (isset($_POST['add-student-submit'])){
        require "dbh.inc.php" ;

        $uid = $_POST['add-student-id'];
        $uname = $_POST['add-student-name'];
        $usname = $_POST['add-student-surname'];
        $ufather = $_POST['add-student-fathername'];
        $ugrade = $_POST['add-student-grade'];
        $uphone = $_POST['add-student-mobile'];
        $ubdate = $_POST['add-student-birthday'];

        // Check in backend if fields are acceptable
        if (empty($uid) || empty($uname) || empty($usname) || empty($ufather) || empty($ugrade) || empty($uphone) || empty($ubdate)){
            header("Location: ../AddStudent.php?error=emptyfields");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9_]+$/", $uid)){
            header("Location: ../AddStudent.php?error=notvalidid");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $uname)){
            header("Location: ../AddStudent.php?error=notvalidname");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $usname)){
            header("Location: ../AddStudent.php?error=notvalidsurname");
            exit();
        }
        else if (!preg_match("/^[A-Za-z]+$/", $ufather)){
            header("Location: ../AddStudent.php?error=notvalidusername");
            exit();
        }

        // Prepare query using placeholders (prevent sql injection)
        $sql = "SELECT * FROM Students WHERE ID=? OR MOBILENUMBER=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../AddStudent.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "ss", $uid, $uphone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        // Someone already exists with this id or email
        if ($resultCheck > 0){
            header("Location: ../AddStudent.php?error=userexists");
            exit();
        }

        // -----------------------------------
        // Finaly if nothing is wrong add user
        // -----------------------------------
        // Prepare query using placeholders (prevent sql injection)
        $sql = "INSERT INTO Students (ID, NAME, SURNAME, FATHERNAME, GRADE, MOBILENUMBER, Birthday) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../AddStudent.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement
        mysqli_stmt_bind_param($stmt, "sssssss", $uid, $uname, $usname, $ufather, $ugrade, $uphone, $ubdate);
        mysqli_stmt_execute($stmt);

        header("Location: ../AddStudent.php?add-student=true");
        exit();

        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access register without submiting form
    else{
        header("Location: ../AddStudent.php");
        exit();
    }
