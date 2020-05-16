<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
  
  // Counters
  require '../vendor/autoload.php';
  $client = new MongoDB\Client;
  $db_library015 = $client->db_library015;
  $tbl_users = $db_library015->tbl_users;
  $tbl_books = $db_library015->tbl_books;
  $tbl_borrowers = $db_library015->tbl_borrowers;

  $documentlist = $tbl_books->find();

  $totalBook = 0;
  foreach ($documentlist as $doc)
  {
    $totalBook = $totalBook + $doc['quantity'];
  }

  $numberOfadmins = $tbl_users->count();
  $numberOfborrowers = $tbl_borrowers->count();
?>
<html>
  <head>
    <title>Dashboard | LMS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/lms.css"> 
  </head>
  <body>
        <div class="header">
          <img class="logo" src="../pics/logo.png"/>
          <a class="logout" href="../admin-operations.php?process=logout">
            <img src="../pics/logout.png"/><br /><label id="logout">Logout</label>
          </a>
        </div>        
        <div class="menu">
          <a href="dashboard.php">Dashboard</a>          
          <a href="books.php">Books</a>
          <a href="borrowers.php">Borrowers</a>
          <a href="settings.php">Settings</a>                    
        </div>
        <div class="content-title">
          <h2>Dashboard</h2>          
          <div class="content-title-bar"></div>         
        </div>
        <div class="content">
          <div id="dash1">
          <div class="col-lg-3">            
            <div class="small-box bg-info">
              <div class="inner">
                  <?php
                    echo '<h1>'.$numberOfadmins.'</h1>';
                  ?>
              </div>              
              <img id="dashboard-icon" src="../pics/users.png"/>              
              <label class="small-box-footer">Number of Admins</label>
            </div>            
          </div>
          </div>
          <div id="dash2">
          <div class="col-lg-3">            
            <div class="small-box bg-info">
              <div class="inner">
                  <?php
                    echo '<h1>'.$totalBook.'</h1>';
                  ?>               
              </div>              
              <img id="dashboard-icon" src="../pics/books.png"/>              
              <label class="small-box-footer">Number of books (quantities incld)</label>
            </div>            
          </div>
          </div>
          <div id="dash3">
          <div class="col-lg-3">            
            <div class="small-box bg-info">
              <div class="inner">
                  <?php
                    echo '<h1>'.$numberOfborrowers.'</h1>';
                  ?>               
              </div>              
              <img id="dashboard-icon" src="../pics/borrowers.png"/>              
              <label class="small-box-footer">Number of borrowed books</label>
            </div>            
          </div>
          </div>             
        </div>
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>