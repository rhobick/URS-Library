<?php
include "connect.php";


if(isset($_POST['sub'])){
    $studs = $_POST['Stud'];
    $fn = $_POST['Fname'];
    $mn = $_POST['Mname'];
    $ln = $_POST['Lname'];
    $cr = $_POST['Cour'];
    $sc = $_POST['Sect'];
	$em = $_POST['Em'];

    $sql = "INSERT INTO tbl_student (stud_id, fname, mname, lname, course, section, email) VALUES ('$studs', '$fn', '$mn', '$ln', '$cr', '$sc', '$em')";
    $insert = $conn->query($sql);

    if($insert == true){
        
            ?>
            <script>
            alert("Successfully Added")
            </script>
            <?php
            header("refresh:0;url=student.php");
        }
    else
    {
    echo "";
    }
}
?>