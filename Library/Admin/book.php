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
            $name = $rowedit['Fname']." ".$rowedit['Lname'];
        }
    }
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

                <!-- Book Management Form -->
                <div class="viewaccdiv">
                    <center>
                        <h1 id="announcemetfont">Book Management</h1>
                        <hr id="line">

                        <!-- Add Book Form -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookModal" style="margin-right: 10px;">
                            Add Book
                        </button>

                        <!-- Add Book Modal -->
                        <div class="modal" id="bookModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Book</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="bookview.php">
                                            <!-- Add Book Form Inputs -->
                                            <input type="text" name="tit" required placeholder="Title">
                                            <br>
                                            <input type="text" name="desc" required placeholder="Description">
                                            <br>
                                            <input type="text" name="cat" required placeholder="Category">
                                            <br>
                                            <input type="text" name="aut" required placeholder="Author">
                                            <br>
                                            <input type="date" name="pub" required placeholder="Date Published">
                                            <br>
                                            <input type="text" name="quan" required placeholder="Quantity">
                                            <br>
                                            <input type="submit" name="sub" class="viewaccsubmit" value="SAVE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Book View Form -->
                        <form method="POST" action="book.php">
                    Search:
                    <input type="text" name="search">
                    <input type="submit" name="sub" value="Search">
                </form>

                <?php
                    include "connect.php";

                    if (isset($_POST['search'])) {
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        
                        if (!empty($search)) {
                            $sql = "SELECT * FROM tbl_book WHERE 
                                Bid LIKE '%$search%' OR 
                                title LIKE '%$search%' OR
                                description LIKE '%$search%' OR
                                category LIKE '%$search%' OR
                                author LIKE '%$search%' OR
                                date LIKE '%$search%' OR
                                quantity LIKE '%$search%'";
                        } else {
                            $sql = "SELECT * FROM tbl_book";
                        }
                    } else {
                        $sql = "SELECT * FROM tbl_book";
                    }

                    $result = $conn->query($sql);

                    if ($conn->connect_error || !$result) {
                        echo "Query Failed: " . $conn->error;
                    }

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='thead-dark'>";
                        echo "<tr>";
                        echo "<th><center>Book Number</th>";
                        echo "<th><center>Title</th>";
                        echo "<th><center>Description</th>";
                        echo "<th><center>Category</th>";
                        echo "<th><center>Author</th>";
                        echo "<th><center>Date Published</th>";
                        echo "<th><center>Quantity</th>";
                        echo "<th><center>Update</th>";
                        echo "<th><center>Delete</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        while ($row = $result->fetch_assoc()) {
                                $zero = 0;
                                $tz_object = new DateTimeZone('Brazil/East');
                                $datetime = new DateTime();
                                $datetime->setTimezone($tz_object);
                                $dateformat = date_format($datetime, "y");
                                echo "<tr>";
                                echo "<td style='background-color: #fff;'><center>" . $dateformat . "-" . $zero . "" . $zero . "" . $zero . "-" . $row['Bid'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['title'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['description'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['category'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['author'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['date'] . "</td>";
                                echo "<td style='background-color: #fff;'><center>" . $row['quantity'] . "</td>";
                                echo "<td style='background-color:#90EE90;'><center><a href='bookupdate.php?ID=" . $row['Bid'] . "'><img src='../Images/Edit.png' width='30' height='25'></a></td>";
                                echo "<td style='background-color:#FF7276;'><center><a href='delete.php?ID=" . $row['Bid'] . "'><img src='../Images/delete.png' width='20' height='20'></a></td>";
                                echo "</tr>";
    }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<p class='text-center'>No records found</p>";
                            }
                        ?>
                    </main>
                </div>
            </div>
        
            <!-- Bootstrap JS and Popper.js scripts -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
        </body>
        
        </html>
