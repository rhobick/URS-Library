<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | URS LIBRARY ADMIN</title>
    <link rel="icon" href="../Images/urs.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {

			background: linear-gradient(to bottom, #48ccfc 100%, #025dea 100%);
        }

        .card {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #fonttitle {
            text-align: center;
            margin: 0;
            padding: 0;
            font-weight: bold;
            font-size: 24px;
            letter-spacing: 0;
        }

        .logo {
            max-width: 80px; /* Adjust the logo size as needed */
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <form method="POST" action="login.php">
            <img src="../Images/urs.png" class="logo" alt="Logo">

            <h3 id="fonttitle">UNIVERSITY OF RIZAL SYSTEM | LIBRARY SYSTEM</h3>

            <h4 id="fonttitle">ADMIN - LOG IN</h4>

            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>




<?php
	include "connect.php";
	
	if (isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password  = $_POST['password'];
		
		$viewlogin= "SELECT * FROM tbl_login WHERE username = '$username'";
		
		$result = mysqli_query($conn,$viewlogin);
		$number = mysqli_num_rows($result);
		
		if($number>0)
		{
			$row = mysqli_fetch_array($result);
			$type = $row['Role'];
			$userid = $row['LIG'];
			$username = $row['username'];
			$dbusername = $row['Fname']." ".$row['Lname'];
			$dbpassword = $row['password'];

			session_start();
						
			$_SESSION['LIG'] = $userid;
			$_SESSION['username'] = $username;
			$_SESSION['Role'] = $type;

					if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
		 }else if(isset($_SESSION['LIG']))
			{
	
				$getrecord = mysqli_query($conn,"SELECT * FROM tbl_login WHERE LIG ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					$name = $rowedit['Fname']." ".$rowedit['Lname'];
				}
			}
	
	
				$_SESSION['loggedin'] = true;	
			if($type == "Admin")
				{
					if($dbpassword == $password)
						{
							header("refresh:0;url=./dashboard.php");
						}
						else
						{
							?>
							<script>
								alert("Hi User! Your Password is Incorrect!")
							</script>
							<?php
						}
				}
		}else
		{
				?>
				<script>
					alert("Username is not Registered")
				</script>
				<?php
		}
	}
?>