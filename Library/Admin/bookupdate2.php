<?php
include "connect.php";
if($conn->connect_error){
	echo "Not Connected";
}else{
	echo " Connected";
}

if(isset($_POST['subs'])){
$BID = $_POST['BID'];
$TITS = $_POST['TITS'];
$DESCS = $_POST['DESCS'];
$CATS = $_POST['CATS'];
$AUTS = $_POST['AUTS'];
$PUBS = $_POST['PUBS'];
$QUANS = $_POST['QUANS'];

$sql = "Update tbl_book SET title='$TITS',description='$DESCS',category='$CATS', author='$AUTS', date='$PUBS', quantity='$QUANS' where Bid='$BID'";

$result = $conn->query($sql);
if($result == True){
    ?>
    <script>
    alert("Successfully Update")
    </script>
    <?php
    header("refresh:0;url=book.php");
    }else{
        echo $conn->error;
    }
}
?>