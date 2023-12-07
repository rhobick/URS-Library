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
			/* $sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Dashboard',NOW())";
			$result1 = $config->query($sql1); */
		
			
		?>
		<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            width: 100px;
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

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .sidebar {
                min-height: 0;
            }
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
        <main role="main" class="col-md-10 main-content">
            <div class="content">
                <h2>Welcome to your Dashboard!</h2>
                <div class="row">
                    <div class="col-md-4">
                        <a href="dashboard.php" class="text-decoration-none">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <center><h5 class="card-title">Home</h5></center>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="account.php" class="text-decoration-none">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <center><h5 class="card-title">Accounts</h5></center>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="book.php" class="text-decoration-none">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <center><h5 class="card-title">Books</h5></center>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <a href="transaction.php" class="text-decoration-none">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <center><h5 class="card-title">Transactions</h5></center>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="student.php" class="text-decoration-none">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <center><h5 class="card-title">Students</h5></center>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>


	