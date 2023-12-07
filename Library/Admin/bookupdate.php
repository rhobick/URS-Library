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

$Bid = $_GET['ID'];
$sql = "SELECT * FROM tbl_book WHERE Bid = '$Bid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $BBID = $row['Bid'];
    $TIT = $row['title'];
    $DESC = $row['description'];
    $CAT = $row['category'];
    $AUT = $row['author'];
    $PUB = $row['date'];
    $QUAN = $row['quantity'];
} else {
    echo "No record found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Update</title>
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
                    <center><h1 id="announcemetfont">Update Book</h1>
                    <hr id="line">
                <div class="container">
                    <form method="POST" action="bookupdate2.php">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="text" name="BID" value="<?php echo $BBID; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="TITS" value="<?php echo $TIT; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" name="DESCS" value="<?php echo $DESC; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <input type="text" name="CATS" value="<?php echo $CAT; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Author:</label>
                            <input type="text" name="AUTS" value="<?php echo $AUT; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date Published:</label>
                            <input type="date" name="PUBS" value="<?php echo $PUB; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quantity:</label>
                            <input type="text" name="QUANS" value="<?php echo $QUAN; ?>" class="form-control">
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
