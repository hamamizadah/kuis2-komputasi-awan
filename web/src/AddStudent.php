<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/add_students.css'; ?>
    </style>
    <main>
            <?php
                // Check if some error exist and inform user
                if(isset($_GET['error'])){
                    if($_GET['error'] == "sqlerror"){
                        echo "<script>alert('There is something wrong with the database');</script>";
                    }
                    else if($_GET['error'] == "userexists"){
                        echo "<script>alert('ID or Mobile already exists');</script>";
                    }
                    else{
                        echo "<script>alert('Unexpected error');</script>";
                    }
                }
                // Inform user when a new user added successfully to the system
                else if (isset($_GET['add-student'])){
                    if($_GET['add-student'] == "true"){
                        echo "<script>alert('User Created!');</script>";
                    }
                }
            ?>
            <div class="add-student-page">
                <div class="form">
                <div class='add-student-form-text'><h2>Add new Student</h2></div>
                <form name="add-student-form" class="add-student-form" action="includes/addstudent.inc.php"  method="post">
                <input type="text" name="add-student-id" maxlength="255" placeholder="ID*" required pattern="[A-Za-z0-9_]+" title="Could contain only latin characters and numbers."/>
                <input type="text" name="add-student-name" maxlength="255" placeholder="Name*" required pattern="[A-Za-z]+" title="Could contain only latin characters."/>
                <input type="text" name="add-student-surname" maxlength="255" placeholder="Surname*" required pattern="[A-Za-z]+" title="Could contain only latin characters."/>
                <input type="text" name="add-student-fathername" maxlength="255" placeholder="Father's Name*" required pattern="[A-Za-z]+" title="Could contain only latin characters."/>
                <input type="number" name="add-student-grade" placeholder="Grade*" value="" required min="0" value="20" step="0.01" title="Could be a floating point number."/>
                <input type="text" name="add-student-mobile" maxlength="255" placeholder="Mobile*" required pattern="[0-9\-\(\) \+]+" title="Could contain only numbers, space, dash and parentesis."/>
                <input type="date" name="add-student-birthday" placeholder="Birthday*" value="" required title="Could be date."/>
                <button type="submit" name="add-student-submit">ADD</button>
                </form>
            </div>
            </div>
    </main>

<?php
    require "includes/footer.inc.php";
?>