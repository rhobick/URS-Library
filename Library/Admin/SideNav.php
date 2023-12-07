<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #E5E4E2;
    }

    .container-fluid {
      padding: 0;
    }

    .sidebar {
      background-color: #48ccfc;
      padding-top: 10px;
      min-height: 100vh;
      color: #fff;
    }

    /* Responsive styles */
    @media (max-width: 767px) {
      .sidebar {
        padding-top: 20px; /* Adjust spacing for small screens */
      }

      .sidebar img {
        width: 100px; /* Adjust image size for small screens */
      }

      .sidebar a {
        padding: 10px; /* Adjust link padding for small screens */
        font-size: 16px; /* Adjust font size for small screens */
      }
    }

    .sidebar a {
      color: #48ccfc;
      text-decoration: none;
      display: block;
      padding: 15px; /* Increase spacing between options */
      font-size: 18px;
      transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out;
    }

    .sidebar a:hover {
  color: #fff;
  background-color: #007bff;
  padding: 15px 153px; /* Increase horizontal spacing on hover */
}

    .main-content {
      padding: 20px;
    }

    /* Custom styling for centering content on small screens */
    @media (max-width: 576px) {
      .container-fluid {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .row {
        flex: 1;
        width: 100%;
        max-width: 100%;
      }
    }
  </style>

  <title>Your Dashboard</title>
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 sidebar">
        <div class="sidebar-sticky">
          <a href="dashboard.php" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="../Images/home.png" alt="Home Icon" class="mr-2" style="width: 55px; height: auto;">
            Home
          </a>
          <a href="account.php" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="../Images/account.png" alt="Accounts Icon" class="mr-2" style="width: 50px; height: auto;">
            Accounts
          </a>
          <a href="book.php" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="../Images/book.png" alt="Books Icon" class="mr-2" style="width: 50px; height: auto;">
            Books
          </a>
          <a href="transaction.php" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="../Images/transaction.png" alt="Transactions Icon" class="mr-2" style="width: 50px; height: auto;">
            Transactions
          </a>
          <a href="student.php" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="../Images/student.jpg" alt="Students Icon" class="mr-2" style="width: 50px; height: auto;">
            Students
          </a>
        </div>
      </nav>

      <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        <!-- Your main content goes here -->
      </main>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>
