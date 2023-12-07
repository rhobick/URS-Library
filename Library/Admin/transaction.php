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

// Fetch data from tbl_student for dropdown
$studentQuery = "SELECT Sid, CONCAT(fname, ' ', mname, ' ', lname) AS student_name FROM tbl_student";
$studentResult = $conn->query($studentQuery);

// Fetch data from tbl_book
$bookQuery = "SELECT Bid, title, quantity FROM tbl_book";
$bookResult = $conn->query($bookQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Management</title>
    <link rel="icon" href="../Images/urs.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #E5E4E2;
        }

        form {
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"],
        input[type="date"] {
            max-width: 300px;
            width: 100%;
            padding: 10px;
            margin: 10px auto;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #025dea;
            color: #fff;
            border: none;
            cursor: pointer;
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

        .sidebar {
            background-color: #025dea;
            padding-top: 20px;
            min-height: 100vh;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: #fff;
            text-decoration: underline;
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
                    <button type="submit" name="logout" class="logout-btn">Log Out</button>
                </form>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <?php include_once('SideNav.php'); ?>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                <!-- Your main content goes here -->

                <!-- Book Borrow Form -->
<form method="post" action="book_process.php">
    <!-- Select Student -->
    <label for="studentSelect">Select Student:</label>
    <select name="student_id" id="studentSelect" required>
        <?php
        // Display options from tbl_student
        while ($studentRow = $studentResult->fetch_assoc()) {
            echo "<option value='{$studentRow['Sid']}'>{$studentRow['student_name']}</option>";
        }
        ?>
    </select>
    <br>

    <!-- Select Books -->
    <table>
        <thead>
            <tr>
            <thead class='thead-dark'>
                <th>Book ID</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Display checkboxes for each book with quantity check
            while ($bookRow = $bookResult->fetch_assoc()) {
                $zero = 0;
                $tz_object = new DateTimeZone('Brazil/East');
                $datetime = new DateTime();
                $datetime->setTimezone($tz_object);
                $dateformat = date_format($datetime, "y");
                echo "<tr>";
                echo "<td style='background-color: #fff;'><center>" . $dateformat . "-" . $zero . "" . $zero . "" . $zero . "-" . $bookRow['Bid'] . "</td>";
                echo "<td style='background-color: #fff;'>{$bookRow['title']}</td>";
                echo "<td style='background-color: #fff;'>{$bookRow['quantity']}</td>";
                echo "<td style='background-color: #fff;'><input type='checkbox' name='books[]' value='{$bookRow['Bid']}' " . ($bookRow['quantity'] > 0 ? '' : 'disabled') . "></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <br>

    <input type="submit" name="borrow_submit" value="Borrow">
    <a href="borrowed_book.php" class="btn btn-primary">View</a>


</form>
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
