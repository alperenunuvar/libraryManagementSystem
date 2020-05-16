<?php
	$database_name = "db_library015";

	require 'vendor/autoload.php';
	$client = new MongoDB\Client;	
	
	foreach($client->listDatabases() as $dbs)
	{    	
    	if($dbs->getName()==$database_name)
    	{ 
    		$isDbExist=true;
    		break;
    	}
    	else
    	{
    		$isDbExist=false;
    	}
	}

	if($isDbExist==false)
	{		
		$database = $client->$database_name;
		$tbl_users = $database->tbl_users;
		$tbl_books = $database->tbl_books;

		// Creating tables
    	$database->createCollection('tbl_users');
    	$database->createCollection('tbl_books');
    	$database->createCollection('tbl_borrowers');

    	// Creating first user
    	$tbl_users->insertOne(
          ['id' => 1, 'username' => "admin", 'password' => "123456"]
        );

    	// Creating test data
    	$tbl_books->insertOne(
			['id' => 1,
			'title' => "Software Engineering and Testing: An Introduction (Computer Science)", 
			'author' => "B. B. Agarwal, S. P. Tayal, M. Gupta",
			'series' => "-",
			'isbn' => "1934015555, 9781934015551, 9780763783020",
			'publish-year' => "2009",
			'edition' => "1",
			'publisher' => "Jones & Bartlett Publishers",
			'page-count' => "529",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 2,
			'title' => "Code Complete", 
			'author' => "Steve McConnell",
			'series' => "-",
			'isbn' => "9781556154843, 1556154844",
			'publish-year' => "1993",
			'edition' => "1",
			'publisher' => "Microsoft Press",
			'page-count' => "890",
			'language' => "English",
			'quantity' => 3,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 3,
			'title' => "New Software Engineering Paradigm Based on Complexity Science: An Introduction to NSE", 
			'author' => "Jay Xiong",
			'series' => "-",
			'isbn' => "1441973257, 9781441973252",
			'publish-year' => "2011",
			'edition' => "1",
			'publisher' => "Springer-Verlag New York",
			'page-count' => "783",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 4,
			'title' => "Object-Oriented and Classical Software Engineering, 8th Edition", 
			'author' => "Stephen R. Schach",
			'series' => "editor1",
			'isbn' => "0073376183, 9780073376189",
			'publish-year' => "2010",
			'edition' => "8th",
			'publisher' => "McGraw-Hill Companies",
			'page-count' => "688",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 5,
			'title' => "Software Engineering, 10th Edition", 
			'author' => "Ian Sommerville",
			'series' => "Global Edition",
			'isbn' => "9781292096131",
			'publish-year' => "2016",
			'edition' => "10",
			'publisher' => "Pearson",
			'page-count' => "811",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 6,
			'title' => "Java How to Program, Early Objects", 
			'author' => "Paul Deitel, Harvey Deitel",
			'series' => "How to Program",
			'isbn' => "0133807800, 9780133807806",
			'publish-year' => "2015",
			'edition' => "10",
			'publisher' => "Pearson Education",
			'page-count' => "1245",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 7,
			'title' => "C++ How to Program", 
			'author' => "Harvey & Paul Deitel & Deitel",
			'series' => "-",
			'isbn' => "9780131857575, 0131857576",
			'publish-year' => "2005",
			'edition' => "5",
			'publisher' => "Prentice Hall",
			'page-count' => "1536",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 8,
			'title' => "C How to Program. With an Introduction to C++", 
			'author' => "Paul Deitel, Harvey Deitel",
			'series' => "-",
			'isbn' => "129211097X",
			'publish-year' => "2016",
			'edition' => "Global Edition",
			'publisher' => "Pearson International",
			'page-count' => "1006",
			'language' => "English",
			'quantity' => 13,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 9,
			'title' => "Data Structures and Algorithm Analysis", 
			'author' => "Mark Allen Weiss",
			'series' => "-",
			'isbn' => "0805390529, 9780805390520",
			'publish-year' => "1991",
			'edition' => "Global Edition",
			'publisher' => "Benjamin-Cummings Pub Co",
			'page-count' => "469",
			'language' => "English",
			'quantity' => 13,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 10,
			'title' => "UNIX: The Complete Reference", 
			'author' => "Kenneth Rosen, Douglas Host, Rachel Klee, Richard Rosinski",
			'series' => "Complete Reference Series",
			'isbn' => "9780072263367, 0072263369",
			'publish-year' => "2006",
			'edition' => "2",
			'publisher' => "McGraw-Hill Osborne Media",
			'page-count' => "912",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 11,
			'title' => "Discrete Mathematics and Its Applications", 
			'author' => "Rosen K.",
			'series' => "-",
			'isbn' => "-",
			'publish-year' => "1999",
			'edition' => "2",
			'publisher' => "-",
			'page-count' => "700",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 12,
			'title' => "Thomas' Calculus", 
			'author' => "George B. Thomas, Maurice D. Weir, Joel Hass, Frank R. Giordano",
			'series' => "Global Edition",
			'isbn' => "9780321185587, 0321185587",
			'publish-year' => "2004",
			'edition' => "11th",
			'publisher' => "Addison Wesley",
			'page-count' => "1563",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 13,
			'title' => "Computer Organization and Architecture", 
			'author' => "William Stallings",
			'series' => "-",
			'isbn' => "9780130351197, 0130351199, 0130493074, 97801304930717",
			'publish-year' => "2002",
			'edition' => "6",
			'publisher' => "Prentice Hall",
			'page-count' => "826",
			'language' => "English",
			'quantity' => 4,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 14,
			'title' => "Learning Kernel Classifiers: Theory and Algorithms", 
			'author' => "Ralf Herbrich",
			'series' => "Adaptive Computation and Machine Learning",
			'isbn' => "026208306X, 9780585436685, 9780262083065",
			'publish-year' => "2001",
			'edition' => "-",
			'publisher' => "The MIT Press",
			'page-count' => "371",
			'language' => "English",
			'quantity' => 3,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 15,
			'title' => "Instructor's Manual for Operating System Concepts", 
			'author' => "Abraham Silberschatz, Peter Baer Galvin, Greg Gagne",
			'series' => "-",
			'isbn' => "0471694665",
			'publish-year' => "2004",
			'edition' => "7",
			'publisher' => "John Wiley & Sons",
			'page-count' => "156",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 16,
			'title' => "Introduction to Network Analysis", 
			'author' => "Laura Chappell",
			'series' => "-",
			'isbn' => "1-893939-286",
			'publish-year' => "2000",
			'edition' => "Second Edition",
			'publisher' => "Podbooks.Com Llc",
			'page-count' => "205",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 17,
			'title' => "Network Analysis: Methodological Foundations", 
			'author' => "Ulrik Brandes, Thomas Erlebach (auth.), Ulrik Brandes, Thomas Erlebach (eds.)",
			'series' => "Lecture Notes in Computer Science 3418 : Theoretical Computer Science and General Issues",
			'isbn' => "9783540249795, 3-540-24979-6",
			'publish-year' => "2005",
			'edition' => "1",
			'publisher' => "Springer-Verlag Berlin Heidelberg",
			'page-count' => "482",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 18,
			'title' => "Data mining: concepts and techniques", 
			'author' => "Jiawei Han, Micheline Kamber, Jian Pei",
			'series' => "The Morgan Kaufmann Series in Data Management Systems",
			'isbn' => "9781558609013, 1558609016",
			'publish-year' => "2006",
			'edition' => "2",
			'publisher' => "Morgan Kaufmann",
			'page-count' => "30",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 19,
			'title' => "Python Cookbook", 
			'author' => "Alex Martelli, Anna Ravenscroft, David Ascher",
			'series' => "-",
			'isbn' => "9780596007973, 0596007973",
			'publish-year' => "2005",
			'edition' => "2nd",
			'publisher' => "O'Reilly",
			'page-count' => "848",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 20,
			'title' => "Oracle 9i Real Application Clusters. Deployment and Performance", 
			'author' => "Bauer M.",
			'series' => "-",
			'isbn' => "-",
			'publish-year' => "2001",
			'edition' => "release 9.0.1",
			'publisher' => "-",
			'page-count' => "244",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 21,
			'title' => "Computer Organization and Design, Third Edition: The Hardware/Software Interface, Third Edition", 
			'author' => "David A. Patterson, John L. Hennessy",
			'series' => "The Morgan Kaufmann Series in Computer Architecture and Design",
			'isbn' => "9781558606043, 1-55860-604-1",
			'publish-year' => "2004",
			'edition' => "3",
			'publisher' => "Morgan Kaufmann",
			'page-count' => "684",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 22,
			'title' => "The Linux® Command Line", 
			'author' => "William E. Shotts, Jr.",
			'series' => "The Morgan Kaufmann Series in Computer Architecture and Design",
			'isbn' => "-",
			'publish-year' => "2009",
			'edition' => "-",
			'publisher' => "lulu.com",
			'page-count' => "522",
			'language' => "English",
			'quantity' => 1,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 23,
			'title' => "Database Systems: Design, Implementation and Management", 
			'author' => "Carlos Coronel, Steven Morris, Peter Rob",
			'series' => "-",
			'isbn' => "0538748842, 9780538748841",
			'publish-year' => "2009",
			'edition' => "9",
			'publisher' => "Cengage Learning",
			'page-count' => "724",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 24,
			'title' => "Data Warehousing in the Age of Big Data", 
			'author' => "Krish Krishnan",
			'series' => "The Morgan Kaufmann Series on Business Intelligence",
			'isbn' => "0124058914, 9780124058910",
			'publish-year' => "2013",
			'edition' => "1",
			'publisher' => "Morgan Kaufmann",
			'page-count' => "371",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 25,
			'title' => "The Definitive Guide to Mongodb: The Nosql Database for Cloud and Desktop Computing", 
			'author' => "Peter Membrey, Wouter Thielen, Eelco Plugge, Tim Hawkins",
			'series' => "-",
			'isbn' => "1430230517, 9781430230519",
			'publish-year' => "2010",
			'edition' => "1",
			'publisher' => "Apress",
			'page-count' => "329",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 26,
			'title' => "Scaling MongoDB", 
			'author' => "Kristina Chodorow",
			'series' => "-",
			'isbn' => "1449303218, 9781449303211",
			'publish-year' => "2011",
			'edition' => "1",
			'publisher' => "O'Reilly Media",
			'page-count' => "59",
			'language' => "English",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 27,
			'title' => "Sorgulayan Denemeler", 
			'author' => "Bertrand Russell",
			'series' => "TÜBİTAK Popüler Bilim Kitapları",
			'isbn' => "9754030308, 9789754030303",
			'publish-year' => "1995",
			'edition' => "-",
			'publisher' => "TÜBİTAK",
			'page-count' => "182",
			'language' => "Turkish",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);

		$tbl_books->insertOne(
			['id' => 28,
			'title' => "Yıldızların zamanı", 
			'author' => "Alev, Murat; Lightman, Alan",
			'series' => "TÜBİTAK popüler bilim kitapları 21.",
			'isbn' => "9789754030358, 9754030359",
			'publish-year' => "1999",
			'edition' => "-",
			'publisher' => "TÜBİTAK",
			'page-count' => "146",
			'language' => "Turkish",
			'quantity' => 2,
			'borrow_quantity' => 0,			
			'isAvailable' => true
		]);		
	}	
?>