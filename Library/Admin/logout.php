<?php
	include "connect.php";
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
    {
        // When Not Login Return to this Page
        header("refresh:0; ../login.php");
        exit;
    }else if(isset($_SESSION['LIG']))
       {
           $userid = $_SESSION['LIG'];
           
           $getrecord = mysqli_query($conn,"SELECT * FROM tbl_login WHERE LIG ='$userid'");
           while($rowedit = mysqli_fetch_assoc($getrecord))
           {
               $type = $rowedit['Role'];
               $name = $rowedit['Fname']." ".$rowedit['Lname'];
           }
       }
               /* $sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Dashboard',NOW())";
               $result1 = $config->query($sql1); */
if(isset($_POST['logout']))
{
	#$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Logged out',NOW())";
	
	#$result1 = $config->query($viewloginl);
	session_destroy();
	unset($_SESSION['LIG']);
	header('Location:login.php');

}
?>
