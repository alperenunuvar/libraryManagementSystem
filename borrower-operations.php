<?php
  session_start();
  if(!isset($_SESSION["signing"]))
  {
    header("Location: ../index.php");
  }
	require 'vendor/autoload.php';

	$client = new MongoDB\Client;
	$db_library015 = $client->db_library015;
	$tbl_borrowers = $db_library015->tbl_borrowers;
  $tbl_books = $db_library015->tbl_books;

	// Determine which book process (add, update, delete) to operate
	$process = $_GET["process"];

	if($process == "display")
	{
		echo '
  		<tr>        		
        <th>ID</th>
        <th>Full Name</th>
        <th>Phone Number</th>        		
        <th>Book Title</th>     
    		<th>Borrowing Time</th>
    		<th>Borrowing Deadline</th>        		
    		<th>Actions</th>
  		</tr>
    ';
    $borrowers = $tbl_borrowers->find(); // Reading the data    	
    		
  	foreach ($borrowers as $borrower)
  	{    			 
  		echo '      			
  			<tr>
    			<td align="center">'.$borrower['id'].'</td>
          <td>'.$borrower['fullname'].'</td>                    
          <td align="center">'.$borrower['phone_number'].'</td>        			
          <td>'.$borrower['book_title'].'</td>              
    			<td align="center">'.$borrower['borrow_time'].'</td>
    			<td align="center">'.$borrower['borrow_deadline'].'</td>        			
    			<td align="center">
    				<a href="../borrower-operations.php?process=detail&bookid='.$borrower['book_id'].'"><img src="../pics/book-info.png" /></a>&nbsp;&nbsp;&nbsp;<a href="../borrower-operations.php?process=end&id='.$borrower['id'].'"><img src="../pics/end-borrowing.png" /></a>        				
    			</td>
  			</tr>
  		';
  	}    
	}
  elseif($process == "detail")
  {
    $bookId = (int)$_GET['bookid'];

    $book = $tbl_books->findOne(array('id' => array('$eq' => $bookId)));

    echo '
      <script>        
        alert("DETAILED BOOK INFORMATION\n\n*Book ID = '.$book['id'].'\n*Title = '.$book['title'].'\n*Author = '.$book['author'].'\n*Series = '.$book['series'].'\n*ISBN = '.$book['isbn'].'\n*Publish Year = '.$book['publish-year'].'\n*Edition = '.$book['edition'].'\n*Publisher = '.$book['publisher'].'\n*Page Count = '.$book['page-count'].'\n*Language = '.$book['language'].'\n*Quantity = '.$book['quantity'].'\n*Borrowed = '.$book['borrow_quantity'].'");
        window.location.href = "pages/borrowers.php";        
      </script>
    '; 
  }
  elseif($process == "end")
  {
    // variables comes from borrowers.php
    $borrowerId = (int)$_GET["id"];    

    // getting borrower's book_id to get book from tbl_books
    $borrower = $tbl_borrowers->findOne(array('id' => array('$eq' => $borrowerId)));
    $bookId = (int)$borrower['book_id'];
    $book = $tbl_books->findOne(array('id' => array('$eq' => $bookId)));

    // deleting borrower from tbl_borrowers
    $tbl_borrowers->deleteOne(['id' => $borrowerId]);

    // Changing book's availability true
    if($book['isAvailable']==false)
    {
      $tbl_books->updateOne(
        ['id' => $bookId],  
        ['$set' => ['isAvailable' => true]]          
      );
    }

    $oldQuantity = $book['borrow_quantity'];
    $newQuantity = $oldQuantity-1;

    $tbl_books->updateOne(
      ['id' => $bookId],  
      ['$set' => ['borrow_quantity' => $newQuantity]]          
    );

    echo '
    <script>        
        alert("Borrowing ended.");
        window.location.href = "pages/borrowers.php";        
      </script>
    ';
  }  
?>