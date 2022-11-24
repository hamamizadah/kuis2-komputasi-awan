<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/delete_students.css'; ?>
    </style>

    <?php
        require "./includes/dbh.inc.php" ;

        // Show users in Delete page
        // First of all get them and afterwards display 
        // them in a while loop
        
        $sql = "SELECT * FROM Students";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./Students.php?error=sqlerror");
            exit();
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    ?>
    <main>
        <div class="main-content">
            <div>
                <div class="card-header">
                    <h2>All Students</h2>
                </div>
                <div class="card-body">
                    <table id="students-table" class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Father</th>
                            <th>Grade</th>
                            <th>Phone Number</th>
                            <th>Birthday</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($result)){
                            $id = $row['ID'];
                            $name = $row['NAME'];
                            $surname = $row['SURNAME'];
                            $fathername = $row['FATHERNAME'];
                            $grade = $row['GRADE'];
                            $phone = $row['MOBILENUMBER'];
                            $bday = $row['Birthday'];
                        ?>
                        <tr>
                            <td><?php echo $id;?> </td>
                            <td><?php echo $name;?> </td>
                            <td><?php echo $surname;?> </td>
                            <td><?php echo $fathername;?> </td>
                            <td><?php echo $grade;?> </td>
                            <td><?php echo $phone;?> </td>
                            <td><?php echo $bday;?> </td>
                            <form action="includes/deletestudent.inc.php" method="post" onsubmit="return confirm('Are you sure you want to delete this entry?')">
                                <input type="hidden" name="delete-student-id" id="delete-student-id" value="<?= $id ?>">
                                <td><button name="delete-student-submit" class="btn">Delete</button></td>
                            </form>
                        </tr>
                        <?php    
                        } 
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php
    require "includes/footer.inc.php";
?>