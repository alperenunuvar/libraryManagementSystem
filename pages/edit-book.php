<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
  
  $bookId = $_GET["id"];
  $txt_oldTitle = $_GET["title"];
  $txt_oldAuthor = $_GET["author"];
  $txt_oldSeries = $_GET["series"];
  $txt_oldIsbn = $_GET["isbn"];
  $txt_oldPublishYear = $_GET["publish-year"];
  $txt_oldEdition = $_GET["edition"];
  $txt_oldPublisher = $_GET["publisher"];
  $txt_oldPageCount = $_GET["page-count"];
  $txt_oldLanguage = $_GET["language"];
  $txt_oldQuantity = $_GET["quantity"];
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
          <h2>Edit Book</h2>
          <div class="add-button">            
            <a href="books.php">
              <img src="../pics/back.png" /><br />
              <label id="add-text">Go Back</label>
            </a>  
          </div>
          <div class="content-title-bar"></div>         
        </div>
        <div class="content">
          <div class="add-book">
          <?php
            echo '<form action="../book-operations.php?process=edit&id='.$bookId.'" method="POST">
              <table>
                <tr>
                  <td>
                    <label for="title">Title</label>
                    <input class="add-book" type="text" id="title" name="txt_title" placeholder="Title" value="'.$txt_oldTitle.'" required></input>
                  </td>
                  <td>
                    <label for="author">Author</label>
                    <input class="add-book" type="text" id="author" name="txt_author" placeholder="Author" value="'.$txt_oldAuthor.'" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    Series
                    <input class="add-book" type="text" id="series" name="txt_series" placeholder="Series" value="'.$txt_oldSeries.'" required>
                  </td>
                  <td>
                    <label for="isbn">ISBN</label>
                    <input class="add-book" type="text" id="isbn" name="txt_isbn" placeholder="ISBN" value="'.$txt_oldIsbn.'" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="pYear">Publish Year</label>                    
                    <input class="add-book" type="text" min="1900" max="2030" minlength="4" maxlength="4" name="txt_publishYear" placeholder="Publish Year" value="'.$txt_oldPublishYear.'" required>
                  </td>
                  <td>
                    <label for="edition">Edition</label>
                    <input class="add-book" type="text" id="edition" name="txt_edition" placeholder="Edition" value="'.$txt_oldEdition.'" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="publisher">Publisher</label>
                    <input class="add-book" type="text" id="publisher" name="txt_publisher" placeholder="Publisher" value="'.$txt_oldPublisher.'" required>
                  </td>
                  <td>
                    <label for="pagecount">Page Count</label>
                    <input class="add-book" type="number" id="pagecount" name="txt_pageCount" placeholder="Page Count" min="1" value="'.$txt_oldPageCount.'" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="language">Language</label>
                    <select id="language" name="txt_language" value="'.$txt_oldLanguage.'" required>
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
                    <input class="add-book" type="number" id="quantity" name="txt_quantity" placeholder="Quantity" min="1" value="'.$txt_oldQuantity.'" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input class="add-book" type="submit" value="Edit">
                  </td>                  
                </tr>
              </table>
            ';
          ?>
            </form>
          </div>
        </div>
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>