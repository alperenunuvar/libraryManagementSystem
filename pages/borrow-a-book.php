<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
  
  //current time
  date_default_timezone_set('Etc/GMT-3');
  $time1 = date("d.m.Y H:i");
  $time2 = date("Y-m-d")."T".date("H:i");

  $bookId = $_GET["id"];
  $title = $_GET["title"];  
?>

<html>
  <head>
    <title>Borrow a Book | LMS</title>
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
          <h2>Borrow a Book</h2>          
          <div class="content-title-bar"></div>         
        </div>
        <div class="content">
          <div class="add-button">            
            <a href="books.php">
              <img src="../pics/back.png" />
            </a>
            <br />
            <label id="add-text">Go back</label> 
          </div>
          <div class="content-title-bar"></div>         
        </div>        
        <div class="content">
          <div class="add-book">          
            <?php echo '<form action="../book-operations.php?process=borrow&id='.$bookId.'&time='.$time2.'" method="POST">'; ?>
              <table>
                <tr>
                  <td>
                    <label for="title">Title</label>
                    <?php echo '<input class="add-book" type="text" id="title" name="txt_title" placeholder="Title" readonly value="'.$title.'">'; ?>
                  </td>
                </tr>                
                <tr>
                  <td>
                    <label for="bfullname">Borrower's Full Name</label>
                    <input class="add-book" type="text" id="bfullname" name="txt_bfullname" placeholder="Borrower's Full Name" required>
                  </td>
                  <td>
                    Borrower's Full Name
                    <input class="add-book" type="text" name="txt_phonenumber" placeholder="Phone Number" minlength="11" maxlength="11" required>
                  </td>
                </tr>                
                <tr>
                  <td>
                    <label for="borrowtime">Borrowing Time</label>
                    <?php echo '<input class="add-book" type="text" id="borrowtime" name="txt_borrowtime" placeholder="Borrowing Time" readonly value="'.$time1.'">'; ?>
                  </td>
                  <td>
                    <label for="borrowdeadline">Borrowing Deadline</label>
                    <input class="add-book" type="datetime-local" id="borrowdeadline" name="txt_borrowdeadline" placeholder="Borrowing Deadline" required>
                  </td>
                </tr>           
                <tr>
                  <td colspan="2">
                    <input class="add-book" type="submit" value="Start Borrowing">
                  </td>                  
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