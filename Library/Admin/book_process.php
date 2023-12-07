<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

var_dump($_POST);  // Add this line

include "connect.php";

foreach ($selectedBooks as $bookId) {
    $insertTransactionQuery = "INSERT INTO tbl_transaction (student_id, book_id, borrow_date) VALUES ('$studentId', '$bookId', NOW())";
    echo $insertTransactionQuery;  // Add this line
    $conn->query($insertTransactionQuery);

    // Update the book quantity in the 'tbl_book' table (assuming you have a 'quantity' column)
    $updateBookQuery = "UPDATE tbl_book SET quantity = quantity - 1 WHERE Bid = '$bookId'";
    echo $updateBookQuery;  // Add this line
    $conn->query($updateBookQuery);
}
// Handle Book Borrow Action
if (isset($_POST['borrow_submit'])) {
    $studentId = mysqli_real_escape_string($conn, $_POST['student_id']);
    // Get the selected books from the form data
    $selectedBooks = isset($_POST['books']) ? (array)$_POST['books'] : array();



    // Perform the necessary SQL queries and updates here to record the transaction
    foreach ($selectedBooks as $bookId) {
        $insertTransactionQuery = "INSERT INTO tbl_transaction (student_id, book_id, borrow_date) VALUES ('$studentId', '$bookId', NOW())";
        $conn->query($insertTransactionQuery);

        // Update the book quantity in the 'tbl_book' table (assuming you have a 'quantity' column)
        $updateBookQuery = "UPDATE tbl_book SET quantity = quantity - 1 WHERE Bid = '$bookId'";
        $conn->query($updateBookQuery);
    }

    // You may also want to perform additional checks and error handling
}

// Redirect back to book.php after processing
header("Location: transaction.php");
exit();
?>
