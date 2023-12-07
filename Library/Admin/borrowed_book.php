<?php
include "connect.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // When not logged in, return to the login page
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

// Fetch borrowed books information
// Fetch borrowed books information with deadline calculation
$borrowedQuery = "SELECT 
                    t.Transaction_ID, 
                    t.borrow_date,
                    DATE_ADD(t.borrow_date, INTERVAL 5 DAY) AS deadline_date,
                    s.Sid,
                    CONCAT(s.fname, ' ', s.mname, ' ', s.lname) AS student_name,
                    b.title
                FROM tbl_transaction t
                INNER JOIN tbl_student s ON t.student_id = s.Sid
                INNER JOIN tbl_book b ON t.book_id = b.Bid";



$borrowedResult = $conn->query($borrowedQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Borrowed Books</title>
    <link rel="icon" href="../Images/urs.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #E5E4E2;
        }

        .container-fluid {
            padding: 0;
        }

        .header {
  background: linear-gradient(to top, #2269d4, #48ccfc); /* Adjust the gradient colors as needed */
  color: #fff;
  padding: 20px;
  text-align: right;
}
        
.logo-img {
      width: 100px; /* Adjust the width as needed */
      height: auto;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

        .logout-btn {
            background: #fff;
            color: #48ccfc;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .main-content {
            padding: 20px;
        }

        #announcemetfont {
            font-size: 24px;
            color: #025dea;
        }

        #line {
            background-color: #025dea;
            height: 2px;
            border: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Header -->
            <div class="col-md-12 header">
            <img src="../Images/urs.png" alt="Logo" class="logo-img">
                <p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
                <form method="POST" action="logout.php">
                <a href="transaction.php" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                <!-- Your main content goes here -->

                <!-- Borrowed Books Table -->
                <!-- Borrowed Books Table -->
<div class="main-content">
    <center>
        <h1 id="announcemetfont">Borrowed Books</h1>
        <hr id="line">

        <table>
            <thead>
                <tr>
                    
                 
                    <th>Student Name</th>
                    <th>Borrowed Book</th>
                    <th>Borrow Date</th>
                    <th>Deadline Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display borrowed books information in the table
                while ($borrowedRow = $borrowedResult->fetch_assoc()) {
                    echo "<tr>";
                
                
                    echo "<td>{$borrowedRow['student_name']}</td>";
                    echo "<td>{$borrowedRow['title']}</td>";
                    echo "<td>{$borrowedRow['borrow_date']}</td>";
                    echo "<td";
                
                    // Check if the deadline is overdue
                    $currentDate = date('Y-m-d');
                    if ($borrowedRow['deadline_date'] < $currentDate) {
                        echo " style='background-color: #FF7276;'"; // Red color for overdue
                    } else {
                        echo " style='background-color: #90EE90;'"; // Green color for not overdue
                    }
                
                    echo ">{$borrowedRow['deadline_date']}</td>";
                    echo "</tr>";
                }
                ?>
              
            </tbody>
        </table>
    </center>
</div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
