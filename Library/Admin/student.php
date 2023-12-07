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

                <!-- Student Information Form -->
                <div class="viewaccdiv">
                    <center>
                        <h1 id="announcemetfont">Student Management</h1>
                        <hr id="line">

                        <!-- Add Student Form -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal" style="margin-right: 10px;">
                            Add Student
                        </button>

                        <!-- Add Student Modal -->
                        <div class="modal" id="studentModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Student</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="studentview.php">
                                            <!-- Add Student Form Inputs -->
                                            <input type="text" name="Stud" required placeholder="Student ID">
                                            <br>
                                            <input type="text" name="Fname" required placeholder="First Name">
                                            <br>
                                            <input type="text" name="Mname" required placeholder="Middle Name">
                                            <br>
                                            <input type="text" name="Lname" required placeholder="Last Name">
                                            <br>
                                            <input type="text" name="Cour" required placeholder="Course">
                                            <br>
                                            <input type="text" name="Sect" required placeholder="Yr/Section">
                                            <br>
                                            <input type="text" name="Em" required placeholder="Email">
                                            <br>
                                            <input type="submit" name="sub" class="viewaccsubmit" value="SAVE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Student View Form -->
                        <form method="POST" action="student.php">
                            Search:
                            <input type="text" name="search">
                            <input type="submit" name="sub" value="Search">
                        </form>

                        <!-- Student View Table -->
                        <?php
include "connect.php";

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    
    if (!empty($search)){
        $sql = "SELECT * FROM tbl_student WHERE Sid LIKE '%$search%' OR 
        stud_id LIKE '%$search%' OR
        fname LIKE '%$search%' OR
        mname LIKE '%$search%' OR
        lname LIKE '%$search%' OR
        course LIKE '%$search%' OR
        section LIKE '%$search%' OR
        email LIKE '%$search%'";

    } else {
        $sql = "SELECT * FROM tbl_student";
    }


} else {
    $sql = "SELECT * FROM tbl_student";
}

$result = $conn->query($sql);

if ($conn->connect_error || !$result) {
    echo "Query Failed: " . $conn->error;
}

$result = $conn->query($sql);

if ($conn->connect_error || !$result) {
    echo "Not Connected or Query Failed";
}

$result = $conn->query($sql);

if ($conn->connect_error || !$result) {
    echo "Not Connected or Query Failed";
}

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th>Student ID</th>";
    echo "<th>Full Name</th>";
    echo "<th>Course</th>";
    echo "<th>Section</th>";
    echo "<th>Email</th>";
    echo "<th>Update</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['stud_id'] . "</td>";
        echo "<td>" . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . "</td>";
        echo "<td>" . $row['course'] . "</td>";
        echo "<td>" . $row['section'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td style='background-color:#90EE90;'><center><a href='studentupdate.php?ID=" . $row['Sid'] . "'><img src='../Images/Edit.png' width='30' height='25'></a></td>";
        echo "<td style='background-color:#FF7276;'><center><a href='delete2.php?ID=" . $row['Sid'] . "'><img src='../Images/delete.png' width='20' height='20'></a></td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='text-center'>No records found</p>";
}
?>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    </body>

    </html>
