<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
  
  echo '
  <div class="books">       
    <table id="customers"></table><!-- Display table for borrowers -->    
  </div>';
?>
<html>
  <head>
    <title>Borrowers | LMS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/lms.css">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script>          
      setInterval(        
        function()
        {               
          $("#customers").load("../borrower-operations.php?process=display"); 
        },500
      );
    </script>    
  </head>
  <body>
        <div class="header"><img class="logo" src="../pics/logo.png"/>
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
          <h2>Borrowers</h2>          
          <div class="content-title-bar"></div>         
        </div>        
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>