<?php
include "connect.php";
if($conn->connect_error){
	echo "Not Connected";
}else{
	echo " Connected";
}

if(isset($_POST['subs'])){
$SIDS = $_POST['SIDS'];
$STID = $_POST['STID'];
$FNS = $_POST['FNS'];
$MNS = $_POST['MNS'];
$LNS = $_POST['LNS'];
$COURS = $_POST['COURS'];
$SECTS = $_POST['SECTS'];
$EMLS = $_POST['EMLS'];

$sql = "Update tbl_student SET stud_id='$STID',fname='$FNS',mname='$MNS', lname='$LNS', course='$COURS', section='$SECTS', email='$EMLS' where Sid='$SIDS'";

$result = $conn->query($sql);
if($result == True){
    ?>
    <script>
    alert("Successfully Update")
    </script>
    <?php
    header("refresh:0;url=student.php");
    }else{
        echo $conn->error;
    }
}
?>