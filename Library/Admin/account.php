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
			/*$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Dashboard',NOW())";
			$result1 = $config->query($sql1); */
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Update Profile</title>
    <link rel="icon" href="../Images/urs.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="book.css">
    <style>
        .header {
  background: linear-gradient(to top, #2269d4, #48ccfc); /* Adjust the gradient colors as needed */
  color: #fff;
  padding: 20px;
  text-align: right;
}

        .logo-img {
            width: 100px;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .viewaccdiv {
            max-width: 800px;
            margin: 20px auto;
        }

        /* Add more styles as needed for responsiveness */

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
              <!-- Update Profile Form -->
<div class="viewaccdiv">
    <h1 id="announcemetfont">Change Password and Username</h1>
    <hr id="line">
    <form method="post" action="" align="center">
        <!-- Existing password fields -->
        <input type="password" name="currentPassword" required placeholder="Current password" class="currentpass">
        <span id="currentPassword" class="required" required></span>
        <br>
        <input type="password" name="newPassword" required placeholder="New password" class="newpass">
        <span id="newPassword" class="required" required></span>
        <br>
        <input type="password" name="confirmPassword" required placeholder="Confirm password" class="confirmpass">
        <span id="confirmPassword" class="required" required></span>
        <br>

        <!-- New username field -->
        <input type="text" name="newUsername" placeholder="New username" class="newuser">
        <br>

        <input type="submit" name='submit' class='viewaccsubmit'>
    </form>
</div>

            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>


<!-- Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>




<?php
include "connect.php";
session_start();

// ... (existing code)

if (isset($_POST['submit'])) {
    global $confirmPassword;

    $result = mysqli_query($conn, "SELECT * FROM tbl_login WHERE LIG='" . $userid . "'");
    $row = mysqli_fetch_array($result);

    // Check if the new password matches the confirmation
    if ($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"]) {
        
        // Update the password
        mysqli_query($conn, "UPDATE tbl_login SET password='" . $_POST["newPassword"] . "' WHERE LIG='" . $userid . "'");

        // Check if a new username is provided
        if (!empty($_POST["newUsername"])) {
            mysqli_query($conn, "UPDATE tbl_login SET username='" . $_POST["newUsername"] . "' WHERE LIG='" . $userid . "'");
        }

        ?>
        <script>
            alert("Password and/or username changed successfully");
        </script>

        <?php
    } else {
        ?>
        <script>
            alert("Incorrect password or password mismatch");
        </script>
        <?php
    }
}
?>




</div>
</body>
</html>
