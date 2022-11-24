<?php
    if (isset($_POST['register-submit'])){
        require "dbh.inc.php" ;

        $uid = $_POST['register-id'];
        $uname = $_POST['register-name'];
        $usname = $_POST['register-surname'];
        $username = $_POST['register-username'];
        $uemail1 = $_POST['register-email1'];
        $uemail2 = $_POST['register-email2'];
        $upass1 = $_POST['register-pwd1'];
        $upass2 = $_POST['register-pwd2'];

        // Check in backend if register fields are acceptable
        if (empty($uid) || empty($uname) || empty($usname) || empty($username) || empty($uemail1) || empty($uemail2) || empty($upass1) || empty($upass2)){
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        else if ($uemail1 !== $uemail2){
            header("Location: ../signup.php?error=emaildonotmatch");
            exit();
        }
        else if ($upass1 !== $upass2){
            header("Location: ../signup.php?error=passdonotmatch");
            exit();
        }
        else if (!filter_var($uemail1, FILTER_VALIDATE_EMAIL)){
            header("Location: ../signup.php?error=notvalidemail");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9]+$/", $uid)){
            header("Location: ../signup.php?error=notvalidid");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $uname)){
            header("Location: ../signup.php?error=notvalidname");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $usname)){
            header("Location: ../signup.php?error=notvalidsurname");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)){
            header("Location: ../signup.php?error=notvalidusername");
            exit();
        }

        // Prepare query using placeholders (prevent sql injection)
        $sql = "SELECT USERNAME FROM Teachers WHERE ID=? OR EMAIL=? OR USERNAME=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "sss", $uid, $uemail1, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        // Someone already exists with this id or email
        if ($resultCheck > 0){
            header("Location: ../signup.php?error=userexists");
            exit();
        }

        // -----------------------------------
        // Finaly if nothing is wrong add user
        // -----------------------------------
        // Prepare query using placeholders (prevent sql injection)
        $sql = "INSERT INTO Teachers (ID, NAME, SURNAME, USERNAME, PASSWORD, EMAIL) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        // TODO: fix verify problem passwords does not match
        $hashedPwd = $upass1;
        // $hashedPwd = password_hash($upass1, PASSWORD_DEFAULT);

        // Pass parameters and execute statement
        mysqli_stmt_bind_param($stmt, "ssssss", $uid, $uname, $usname, $username, $hashedPwd, $uemail1);
        mysqli_stmt_execute($stmt);

        header("Location: ../index.php?register=true");
        exit();

        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access register without submiting form
    else{
        header("Location: ../signup.php");
        exit();
    }
