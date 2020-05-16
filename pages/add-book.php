<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
?>
<html>
  <head>
    <title>Add a Book | LMS</title>
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
          <h2>Add a Book</h2>
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
            <form action="../book-operations.php?process=add" method="POST">
              <table>
                <tr>
                  <td>
                    Title
                    <input class="add-book" type="text" name="txt_title" placeholder="Title" required>
                  </td>
                  <td>
                    Author
                    <input class="add-book" type="text" name="txt_author" placeholder="Author" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Series
                    <input class="add-book" type="text" name="txt_series" placeholder="Series" required>
                  </td>
                  <td>
                    ISBN
                    <input class="add-book" type="text" name="txt_isbn" placeholder="ISBN" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Publish Year
                    <input class="add-book" type="text" min="1900" max="2030" minlength="4" maxlength="4" name="txt_publishYear" placeholder="Publish Year" required>
                  </td>
                  <td>
                    Edition
                    <input class="add-book" type="text" name="txt_edition" placeholder="Edition" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Publisher
                    <input class="add-book" type="text" name="txt_publisher" placeholder="Publisher" required>
                  </td>
                  <td>
                    Page Count
                    <input class="add-book" type="number" name="txt_pageCount" placeholder="Page Count" min="1" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Language
                    <select name="txt_language" required>
                      <option selected disabled hidden>Select Language</option>
                      <option value="Arabic">Arabic</option>
                      <option value="Chinese">Chinese</option>
                      <option value="English">English</option>
                      <option value="French">French</option>
                      <option value="German">German</option>
                      <option value="Greek">Greek</option>
                      <option value="Latin">Latin</option>
                      <option value="Italian">Italian</option>
                      <option value="Japanese">Japanese</option>
                      <option value="Korean">Korean</option>
                      <option value="Russian">Russian</option>
                      <option value="Spanish">Spanish</option>
                      <option value="Turkish">Turkish</option>
                    </select>
                  </td>
                  <td>
                    <label for="quantity">Quantity of Book</label>
                    <input class="add-book" type="number" id="quantity" name="txt_quantity" placeholder="Quantity" min="1" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input class="add-book" type="submit" value="Add">
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