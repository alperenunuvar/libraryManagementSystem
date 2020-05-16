<?php
  session_start();

  if(!isset($_SESSION["signing"]))
  {
    header("Location: index.php");
  }

  $page = 1; // Book list page
  if(isset($_GET["page"]))
  {
    $page = $_GET["page"];
  }

  require '../vendor/autoload.php';
  $client = new MongoDB\Client;
  $db_library015 = $client->db_library015;
  $tbl_books = $db_library015->tbl_books;
  
  $recordPerPage=10; // Number of display books each page
  $totalBookRecords = $tbl_books->count(); // total book records from tbl_books   
  $totalPageButton = ceil($totalBookRecords/$recordPerPage); // Calculating how many page buttons in book list

  echo '<div class="books">'; // Displays all content
    // Search book field
    echo '   
    <table>
      <tr>
        <td>
          <input type="text" id="txt_searchtitlebox" placeholder="Search Title">
        </td>
        <td>
          <input type="text" id="txt_searchauthorbox" placeholder="Search Author">
        </td>
        <td>
          <input type="text" id="txt_searchpublisherbox" placeholder="Search Publisher">
        </td>              
        <td>
          <input type="text" id="txt_searchseriesbox" placeholder="Search Series">
        </td>
        <td>
          <input type="text" id="txt_searchisbnbox" placeholder="Search Isbn">
        </td>
        <td>
          <input type="text" id="txt_searcheditionbox" placeholder="Search Edition">
        </td>
        <td>
          <table>
          <tr>
            <td>
              <input class="add-book" type="checkbox" name="ava-choice" value="available" id="rb_selectavailable"><label for="rb_selectavailable">Available</label>
            </td>
          </tr>
          <tr>
            <td>
              <input class="add-book" type="checkbox" name="ava-choice" value="nonavailable" id="rb_selectnonavailable"><label for="rb_selectnonavailable">Not Available</label>
            </td>
          </tr>
        </table>
        </td>
        <td>          
          <select id="language" name="txt_language">
            <option selected disabled hidden>Search Language</option>            
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
      </tr>   
    </table>';
    // Paging book list
    $range = range($page-1,$page+1); // Show 3 page buttons
    echo '
      <table>
        <tr>
          <td>            
            <a href="?page=1"><button id="paging">First</button></a>';
            foreach ($range as $numberOfPage)
            {
              if(($numberOfPage==0) || ($numberOfPage>$totalPageButton)) { continue; }
              echo '<a href="?page='.$numberOfPage.'"><button id="paging">'.$numberOfPage.'</button></a>';
            }
            echo '<a href="?page='.$totalPageButton.'"><button id="paging">Last</button></a>          
          </td>
        </tr>        
      </table> 
    <table id="customers"></table>
  </div>';
?>

<html>
  <head>
    <title>Books | LMS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/lms.css">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>       
    <script>
      var page = "<?php echo $page ?>";
      var recordperpage = "<?php echo $recordPerPage ?>";      

      setInterval(        
        function()
        {
          var search;               
          var sTitleBox=document.getElementById("txt_searchtitlebox").value;
          var sAuthorBox=document.getElementById("txt_searchauthorbox").value;
          var sSeriesBox=document.getElementById("txt_searchseriesbox").value;
          var sIsbnBox=document.getElementById("txt_searchisbnbox").value;    
          var sEditionBox=document.getElementById("txt_searcheditionbox").value; 
          var sPublisherBox=document.getElementById("txt_searchpublisherbox").value;
          var e = document.getElementById("language");
          var sLanguageBox = e.options[e.selectedIndex].value;          

          if(sTitleBox!=null) { search = "&sTitle="+sTitleBox; }
          if(sTitleBox!=null) { search += "&sAuthor="+sAuthorBox; }
          if(sSeriesBox!=null) { search += "&sSeries="+sSeriesBox; }
          if(sIsbnBox!=null) { search += "&sIsbn="+sIsbnBox; }
          if(sEditionBox!=null) { search += "&sEdition="+sEditionBox; }
          if(sPublisherBox!=null) { search += "&sPublisher="+sPublisherBox; }
          if(e.selectedIndex) { search += "&sLanguage="+sLanguageBox; }
          if(document.getElementById("rb_selectavailable").checked==true) { search += "&sAvailable=true"; }
          if(document.getElementById("rb_selectnonavailable").checked==true) { search += "&sNonavailable=true"; }

          $("#customers").load("../book-operations.php?process=display&page="+page+"&recordperpage="+recordperpage+search);   
          search=null;                                
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
          <h3>Books</h3>
          <div class="add-button">            
            <a href="add-book.php">
              <img src="../pics/add.png" />             
            </a>
            <br /> 
            <label id="add-text">Add a Book</label> 
          </div>
          <div class="content-title-bar"></div>         
        </div>
        <div class="footer">
          <p>SE308 01 Advanced Topics in Database Systems - Term Project - Library Management System - Alperen Fatih ÜNÜVAR - 150706015</p>
        </div>
  </body>
</html>