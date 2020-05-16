<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header('Location: ../index.php');
  }
  
  $userId = $_GET["id"];
  $oldUsername = $_GET["username"];  
?>

<html>
  <head>
    <title>Edit an Admin | LMS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/lms.css">      
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
          <h2>Edit Admin</h2>
          <div class="add-button">            
            <a href="settings.php">
              <img src="../pics/back.png" /><br />
              <label id="add-text">Go Back</label>
            </a>  
          </div>
          <div class="content-title-bar"></div>         
        </div>
        <div class="content">
          <div class="add-book">
          <?php
            echo '<form action="../admin-operations.php?process=edit&id='.$userId.'" method="POST">';
          ?>
              <table>
                <tr>
                  <td>
                    Edit Username
                    <?php echo '<input class="add-book" type="text" name="txt_username" value="'.$oldUsername.'" required>'; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Old Password
                    <input class="add-book" type="password" minlength="6" maxlength="15" name="txt_oldpassword" placeholder="Old Password" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    New Password
                    <input class="add-book" type="password" minlength="6" maxlength="15" name="txt_password" placeholder="Password" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Confirm Password
                    <input class="add-book" type="password" minlength="6" maxlength="15" name="txt_password2" placeholder="Confirm Password" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><input class="add-book" type="submit" value="Edit"></td>          
                </tr>                
              </table>
            </form>
          </div>
        </div>
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>