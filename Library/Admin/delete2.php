<?php
include "connect.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("refresh:0; ../login.php");
    exit;
} else if (isset($_SESSION['LIG'])) {
    $userid = $_SESSION['LIG'];

    $getrecord = mysqli_query($conn, "SELECT * FROM tbl_login WHERE LIG ='$userid'");
    while ($rowedit = mysqli_fetch_assoc($getrecord)) {
        $type = $rowedit['Role'];
        $name = $rowedit['Fname'] . " " . $rowedit['Lname'];
    }
}

$ID = $_GET['ID'];

// Check if there are related records in tbl_transaction
$checkQuery = $conn->prepare("SELECT COUNT(*) as count FROM tbl_transaction WHERE student_id = ?");
$checkQuery->bind_param("i", $ID);
$checkQuery->execute();
$checkResult = $checkQuery->get_result();
$count = $checkResult->fetch_assoc()['count'];

if ($count > 0) {
    // There are related transactions, you can either delete or update them

    // Example: Delete related transactions
    $deleteTransactionsQuery = $conn->prepare("DELETE FROM tbl_transaction WHERE student_id = ?");
    $deleteTransactionsQuery->bind_param("i", $ID);
    $deleteTransactionsQuery->execute();
    $deleteTransactionsQuery->close();

    // Proceed with student deletion
    $deleteStudentQuery = $conn->prepare("DELETE FROM tbl_student WHERE Sid = ?");
    $deleteStudentQuery->bind_param("i", $ID);

    if ($deleteStudentQuery->execute()) {
        ?>
        <script>
            alert("Successfully Deleted");
        </script>
        <?php
        header("refresh:0;url=student.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $deleteStudentQuery->close();
} else {
    // No related transactions, proceed with student deletion
    $deleteStudentQuery = $conn->prepare("DELETE FROM tbl_student WHERE Sid = ?");
    $deleteStudentQuery->bind_param("i", $ID);

    if ($deleteStudentQuery->execute()) {
        ?>
        <script>
            alert("Successfully Deleted");
        </script>
        <?php
        header("refresh:0;url=student.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $deleteStudentQuery->close();
}

$checkQuery->close();
$conn->close();
?>
