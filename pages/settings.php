<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
  
  echo '
    <div class="books">
      <form action="../admin-operations.php?process=add" method="POST">
      <table>               
        <tr>
          <td>
            <input class="add-book" name="txt_username" type="text" minlength="6" maxlength="15" placeholder="Choose username" required>
          </td>
          <td>
            <input class="add-book" name="txt_password" type="password" minlength="6" maxlength="15" placeholder="Choose password" required>
          </td>
          <td>
            <input class="add-book" name="txt_password2" type="password" minlength="6" maxlength="15" placeholder="Confirm password" required>
          </td>
          <td>            
            <input class="add-user" type="submit" value=""> 
          </td>
        </tr>             
      </table>
      </form>
      <!--Display admins table -->
      <table id="customers"></table>      
    </div>         
  ';    
?>

<html>
  <head>
    <title>Settings | LMS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/lms.css">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>    
    <!-- This lists admins list from tbl_users collection.-->
    <script>      
      setInterval(        
        function()
        {        	  
            $("#customers").load("../admin-operations.php?process=display");          
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
          <h2>Settings</h2>          
          <div class="content-title-bar"></div>         
        </div>             
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>