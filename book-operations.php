<?php
	session_start();
	if(!isset($_SESSION["signing"]))
  	{
    	header("Location: index.php");
  	}

	require 'vendor/autoload.php';
	$client = new MongoDB\Client;
	$db_library015 = $client->db_library015;
	$tbl_books = $db_library015->tbl_books;
	$tbl_borrowers = $db_library015->tbl_borrowers;

	// Determine which book process (add, update, delete) to operate
	$process = $_GET["process"];

	if($process == "display")
	{		
		// Book list paging Limits
		if(isset($_GET["page"]))
		{
			$page = (int)$_GET["page"];
		}		
		if(isset($_GET["recordperpage"]))
		{
			$recordPerPage = (int)$_GET["recordperpage"];
		}
		$skip = ($page-1)*$recordPerPage;		
		$options = ["limit" => $recordPerPage, "skip" => $skip];						
			
		// If all search textboxes are empty (books.php)
		if(($_GET["sTitle"]==null) && ($_GET["sAuthor"]==null) && ($_GET["sSeries"]==null) && ($_GET["sIsbn"]==null) && 
			($_GET["sEdition"]==null) && ($_GET["sPublisher"]==null) && (isset($_GET["sLanguage"])) && (isset($_GET["sAvailable"])) && (isset($_GET["sNonavailable"])))
		{
			$tbl_books->find([],$options); // Reading the data
		}
		
		// Search arrays
		// This arrays use to print book list
		$searchTitleArray = [];
		$searchAuthorArray = [];
		$searchSeriesArray = [];	
		$searchIsbnArray = [];
		$searchEditionArray = [];
		$searchPublisherArray = [];
		$searchLanguageArray = [];
		$searchAvailableArray = [];
		$searchNonavailableArray = [];

		// Search textbox variables comes from books.php
		if($_GET["sTitle"]!=null)
		{ 
			$searchTitleArray = array('title' => array('$regex' => $_GET["sTitle"])); 
		}
		if($_GET["sAuthor"]!=null)
		{ 
			$searchAuthorArray = array('author' => array('$regex' => $_GET["sAuthor"]));
		}
		if($_GET["sSeries"]!=null)
		{
			$searchSeriesArray = array('series' => array('$regex' => $_GET["sSeries"]));
		}
		if($_GET["sIsbn"]!=null)
		{
			$searchIsbnArray = array('isbn' => array('$regex' => $_GET["sIsbn"]));
		}
		if($_GET["sEdition"]!=null)
		{
			$searchEditionArray = array('edition' => array('$regex' => $_GET["sEdition"]));
		}
		if($_GET["sPublisher"]!=null)
		{
			$searchPublisherArray = array('publisher' => array('$regex' => $_GET["sPublisher"]));
		}
		if(isset($_GET["sLanguage"]))
		{
			$searchLanguageArray = array('language' => array('$regex' => $_GET["sLanguage"]));
		}
		if(isset($_GET["sAvailable"]))
		{
			$searchAvailableArray = array('isAvailable' => array('$eq' => true));
		}
		if(isset($_GET["sNonavailable"]))
		{
			$searchNonavailableArray = array('isAvailable' => array('$eq' => false));
		}

		// All search results are merging to display common results
		$search = array_merge(
			$searchTitleArray, 
			$searchAuthorArray, 
			$searchSeriesArray, 
			$searchIsbnArray,
			$searchEditionArray,
			$searchPublisherArray,
			$searchLanguageArray,
			$searchAvailableArray,
			$searchNonavailableArray
		);

		echo '      
      		<tr>
      			<th>ID</th>            
            	<th>Title</th>
            	<th>Author</th>
            	<th>Series</th>
            	<th>ISBN</th>
            	<th>Publish Year</th>
            	<th>Edition</th>
            	<th>Publisher</th>
            	<th>Page Count</th>
            	<th>Language</th>
            	<th>Quantity/Borrowing</th>
            	<th>Available</th>
            	<th>Actions</th>
          	</tr>
      	';

      	$books = $tbl_books->find($search, $options); // Reading the data as search results

      	// List books
      	foreach ($books as $book)
      	{
        	if($book['isAvailable']==true)
        	{
          		$bookAvailable = "../pics/ava.png";
        	}
	        else
	        {
	          $bookAvailable = "../pics/nonava.png";
	        }  
	          echo '
	            <tr>
	            	<td align="center">'.$book['id'].'</td>              
	              	<td>'.$book['title'].'</td>
	              	<td>'.$book['author'].'</td>
	              	<td>'.$book['series'].'</td>
	              	<td align="center">'.$book['isbn'].'</td>
	              	<td align="center">'.$book['publish-year'].'</td>
	              	<td align="center">'.$book['edition'].'</td>
	              	<td>'.$book['publisher'].'</td>
	              	<td align="center">'.$book['page-count'].'</td>
	              	<td align="center">'.$book['language'].'</td>
	              	<td align="center">'.$book['quantity'].'/'.$book['borrow_quantity'].'</td>
	              	<td align="center"><img src="'.$bookAvailable.'" /></td>
	              	<td>
	                	<a href="../book-operations.php?process=delete&id='.$book['id'].'"><img src="../pics/delete.png" /></a>&nbsp;&nbsp;&nbsp;<a href="edit-book.php?id='.$book['id'].'&title='.$book['title'].'&author='.$book['author'].'&series='.$book['series'].'&isbn='.$book['isbn'].'&publish-year='.$book['publish-year'].'&edition='.$book['edition'].'&publisher='.$book['publisher'].'&page-count='.$book['page-count'].'&language='.$book['language'].'&quantity='.$book['quantity'].'"><img src="../pics/edit.png" /></a>&nbsp;&nbsp;&nbsp;<a href="borrow-a-book.php?id='.$book['id'].'&title='.$book['title'].'"><img src="../pics/borrow.png" /></a>               
	            	</td>
	        	</tr>         
	        ';                    
	    }
	}	
	elseif($process == "add")
	{
		// Add book variables comes from add-book.php
		$title = $_POST["txt_title"];
		$author = $_POST["txt_author"];
		$series = $_POST["txt_series"];
		$isbn = $_POST["txt_isbn"];
		$publishYear = $_POST["txt_publishYear"];
		$edition = $_POST["txt_edition"];
		$publisher = $_POST["txt_publisher"];
		$pageCount = $_POST["txt_pageCount"];
		$language = $_POST["txt_language"];
		$quantity = $_POST["txt_quantity"];		
		
		// finding biggest id to insert new book to tbl_books
		$totalNumberOfBooks = $tbl_books->findOne([],['sort' => ['id' => -1]], ['limit' => 1]);	
		$tbl_books->insertOne(
			['id' => ($totalNumberOfBooks['id']+1),
			'title' => $title, 
			'author' => $author,
			'series' => $series,
			'isbn' => $isbn,
			'publish-year' => $publishYear,
			'edition' => $edition,
			'publisher' => $publisher,
			'page-count' => $pageCount,
			'language' => $language,
			'quantity' => $quantity,
			'borrow_quantity' => 0,
			'isAvailable' => true]);

		echo '
			<script>
    			alert("Book added!");
    			window.location.href = "pages/books.php";
    		</script>
    	';		
	}	
	elseif ($process == "delete")
	{
		// variables comes from books.php
		$deletingId = (int)$_GET["id"];
		
    	$book = $tbl_books->findOne(array('id' => array('$eq' => $deletingId)));
    	if($book['isAvailable']==true) // if the book is not borrowing from someone
    	{
    		$tbl_books->deleteOne(['id' => $deletingId]); // deleting related book by id
    		header("Location: pages/books.php");
    	}
    	else
    	{
    		echo '
    			<script>
        			alert("The book is not available to delete!");
        			window.location.href = "pages/books.php";
        		</script>
        	';	
    	}
	}	
	elseif ($process == "edit")
	{
		// variables comes from edit-book.php
		$bookId = (int)$_GET["id"];
		$newTitle = $_POST["txt_title"];
		$newAuthor = $_POST["txt_author"];
		$newSeries = $_POST["txt_series"];
		$newIsbn = $_POST["txt_isbn"];
		$newPublishYear = $_POST["txt_publishYear"];
		$newEdition = $_POST["txt_edition"];
		$newPublisher = $_POST["txt_publisher"];
		$newPageCount = $_POST["txt_pageCount"];
		$newLanguage = $_POST["txt_language"];
		$newQuantity = $_POST["txt_quantity"];		
		
		// Finding a book from tbl_books by id    	
    	$book = $tbl_books->findOne(array('id' => array('$eq' => $bookId)));    
    	
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['title' => $newTitle]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['author' => $newAuthor]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],
			['$set' => ['series' => $newSeries]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['isbn' => $newIsbn]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['publish-year' => $newPublishYear]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['edition' => $newEdition]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['publisher' => $newPublisher]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['page-count' => $newPageCount]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['language' => $newLanguage]]					
		);
		$tbl_books->updateOne(
			['id' => $bookId],	
			['$set' => ['quantity' => $newQuantity]]					
		);
			
		echo '
    		<script>
    			alert("The book updated!");
    			window.location.href = "pages/books.php";
    		</script>
    	';    			
	}
    elseif($process == "borrow")
	{		
		// Borrow variables comes from borrow-a-book.php
		$bookId = (int)$_GET["id"];
		$borrowTime = $_GET["time"];						
		$borrowerFullname = $_POST["txt_bfullname"];
		$phoneNumber = $_POST["txt_phonenumber"];		
		$borrowDeadline = $_POST["txt_borrowdeadline"];		

		// Finding a book from tbl_books by id    	
    	$book = $tbl_books->findOne(array('id' => array('$eq' => $bookId)));

    	$oldQuantity = $book['borrow_quantity']; // keeping borrow_quantity before to borrow	
    	if($book['isAvailable']==true) // If book is available to borrow someone
    	{
    		// increases number of borrow_quantity to show borrowed books
    		$tbl_books->updateOne(
				['id' => $bookId],	
				['$set' => ['borrow_quantity' => $oldquantity + 1]]
			);

    		// the book is called up again. because if not called bug comes out
			$book = $tbl_books->findOne(array('id' => array('$eq' => $bookId)));

			// If all books are borrowed, available status of book is must be false.
			if($book['quantity']==$book['borrow_quantity'])
			{
				$tbl_books->updateOne(
					['id' => $bookId],	
					['$set' => ['isAvailable' => false]]
				);
			}

			// finding biggest id to insert new book to tbl_borrowers			
			$totalNumberOfBorrowers = $tbl_borrowers->findOne([],['sort' => ['id' => -1]], ['limit' => 1]);			
			// After, Adding borrower info to borrow report table
			$tbl_borrowers->insertOne(
				['id' => ($totalNumberOfBorrowers['id']+1),
				'book_id' => $bookId,
				'book_title' => $book['title'],				
				'fullname' => $borrowerFullname,
				'phone_number' => $phoneNumber,
				'borrow_time' => $borrowTime,
				'borrow_deadline' => $borrowDeadline]);
			echo '
				<script>
					alert("The book borrowed to '.$borrowerFullname.'.");					
					window.location.href = "pages/books.php";									
				</script>
			';
    	}
    	else
    	{
    		echo '
				<script>
					alert("All books are already borrowed!");					
					window.location.href = "pages/books.php";									
				</script>
				';
    	}
	}
?>