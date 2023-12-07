<?php
include "connect.php";


if (isset($_POST['sub'])) {
    $tits = $_POST['tit'];
    $desc = $_POST['desc'];
    $cats = $_POST['cat'];
    $authors = $_POST['aut'];
    $pubs = $_POST['pub'];
    $quans = $_POST['quan'];

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO tbl_book (title, description, category, author, date, quantity) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssi", $tits, $desc, $cats, $authors, $pubs, $quans);

    // Execute the statement
    $insert = $stmt->execute();

    if ($insert == true) {
        ?>
        <script>
            alert("Successfully Added");
        </script>
        <?php
        header("refresh:0;url=book.php");
    } else {
        echo "";
    }

    // Close the statement
    $stmt->close();
}
?>