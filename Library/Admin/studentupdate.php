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

$Sid = $_GET['ID'];
$sql = "SELECT * FROM tbl_student WHERE Sid = '$Sid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $SSID = $row['Sid'];
    $StudId = $row['stud_id'];
    $FN = $row['fname'];
    $MN = $row['mname'];
    $LN = $row['lname'];
    $COUR = $row['course'];
    $SECT = $row['section'];
    $EML = $row['email'];
} else {
    echo "No record found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Update</title>
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

                <!-- Update Profile Form -->
                <div class="viewaccdiv">
                    <center><h1 id="announcemetfont">Update Student</h1>
                    <hr id="line">
                <div class="container">
                    <form method="POST" action="studentupdate2.php">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="text" name="SIDS" value="<?php echo $SSID; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Student ID:</label>
                            <input type="text" name="STID" value="<?php echo $StudId; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="FNS" value="<?php echo $FN; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="MNS" value="<?php echo $MN; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="LNS" value="<?php echo $LN; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input type="text" name="COURS" value="<?php echo $COUR; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Yr / Section</label>
                            <input type="text" name="SECTS" value="<?php echo $SECT; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="EMLS" value="<?php echo $EML; ?>" class="form-control">
                        </div>
                  
                        <input type="submit" name="subs" value="UPDATE" class="btn btn-primary">
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
