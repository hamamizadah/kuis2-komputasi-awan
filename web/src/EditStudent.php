<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/edit_students.css'; ?>
    </style>
    
    <?php
        require "./includes/dbh.inc.php" ;

        // Check if some error exist and inform user
        if(isset($_GET['error'])){
            if($_GET['error'] == "sqlerror"){
                echo "<script>alert('There is something wrong with the database');</script>";
            }
            else{
                echo "<script>alert('Unexpected error');</script>";
            }
        }
        // Show user in Edit page
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
                        <form name="edit-student-form" class="edit-student-form" action="/includes/editstudent.inc.php" method="post" onsubmit="return confirm('Are you sure you want to edit this entry?')"> 
                            <input type="hidden" name="edit-student-id" value="<?php echo $id;?>">
                            <td><?php echo $id;?></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-student-name" maxlength="255" placeholder="Name*" value="<?php echo $name;?>" required pattern="[A-Za-z]+" title="Could contain only latin characters."/></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-student-surname" maxlength="255" placeholder="Surname*" value="<?php echo $surname;?>" required pattern="[A-Za-z]+" title="Could contain only latin characters."/></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-student-fathername" maxlength="255" placeholder="Father's Name*" value="<?php echo $fathername;?>" required pattern="[A-Za-z]+" title="Could contain only latin characters."/></td>
                            <td><input class="std-ed-te" type="number" size="10" name="edit-student-grade" placeholder="Grade*" required min="0" value="<?php echo $grade;?>" step="0.01" title="Could be a floating point number."/></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-student-mobile" maxlength="255" placeholder="Mobile*" value="<?php echo $phone;?>" required pattern="[0-9\-\(\) \+]+" title="Could contain only numbers, space, dash and parentesis."/></td>
                            <td><input class="std-ed-te" type="date" size="10" name="edit-student-birthday" placeholder="Birthday*" value="<?php echo $bday;?>" required title="Could be date."/>
                            <td><button  name="edit-student-submit" lass="btn">Edit</button></td>
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
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    require "includes/footer.inc.php";
?>