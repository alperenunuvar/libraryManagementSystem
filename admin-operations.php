<?php
	session_start();	
	require 'vendor/autoload.php';

	$client = new MongoDB\Client;
	$db_library015 = $client->db_library015;
	$tbl_users = $db_library015->tbl_users;
	
	// Determine which admin process (add, update, delete) to operate
	$process = $_GET["process"];

	if($process == "login")
	{
		// variables from index.php
		$username = $_POST["txt_username"];
    	$password = $_POST["txt_password"];

    	// getting admin list from tbl_users
    	$adminInfo = $tbl_users->findOne(['username' => $username]); 
    	
    	if(($adminInfo['username']==$username)&&($adminInfo['password']==$password))
    	{
    		$_SESSION["signing"] = true;
        	header('Location: pages/dashboard.php');        		
    	}
    	else
    	{
    		echo '
    			<script>
        			alert("Invalid username or password!");
        			window.location.href = "index.php";
        		</script>
        	';        		
    	}    	
	}
	elseif($process == "display")
	{
		$admins = $tbl_users->find(); // Reading the data		
		
    	echo '
      		<tr>
        		<th>#</th>
        		<th>ID</th>
        		<th>Username</th>        		
        		<th>Actions</th> 
      		</tr>
    	';
    	$num=1;
    	foreach ($admins as $admin)
    	{    	 
      		echo '
      			<tr>
          			<td align="center">'.$num.'</td>
          			<td align="center">'.$admin['id'].'</td>
          			<td align="center">'.$admin['username'].'</td>          			
          			<td align="center"><a href="../admin-operations.php?process=delete&id='.$admin['id'].'"><img src="../pics/delete.png" /></a>&nbsp;&nbsp;&nbsp;<a href="edit-admin.php?id='.$admin['id'].'&username='.$admin['username'].'"><img src="../pics/edit.png" /></a></td>
         		</tr>';
      		$num=$num+1;
    	}
	}
	elseif($process == "add")
	{
		// variables comes from settings.php
		$username = $_POST["txt_username"];
		$password = $_POST["txt_password"];		
		$password2 = $_POST["txt_password2"];
		
		if($password!=$password2) // If confirm password does not match
		{
			echo '<script>
				alert("Your passwords does not match each other!");
        		window.location.href = "pages/settings.php";
        	</script>';
		}
		else
		{
			// Checks the collection if same username exist
			$checkingUserName = $tbl_users->findOne(array('username' => array('$regex' => $username)));

			if($checkingUserName['username']=="")
			{
				// finding biggest id to insert new book to tbl_users
				$totalNumberOfAdmins = $tbl_users->findOne([],['sort' => ['id' => -1]], ['limit' => 1]); 				 
				$tbl_users->insertOne(['id' => ($totalNumberOfAdmins['id']+1),'username' => $username, 'password' => $password]);
				header('Location: pages/settings.php');
			}
			else
			{
				echo '<script>
					alert("This username is already exist!")
					window.location.href = "pages/settings.php";
				</script>';
			}
		}		
	}
	elseif ($process == "delete")
	{
		// variable comes from settings.php
		$deletingId = (int)$_GET["id"];		
    	
    	$totalNumberOfAdmins = $tbl_users->count(); // total records from tbl_users 	
    	if($totalNumberOfAdmins>1) // there are more than 1 record to delete
    	{
    		$tbl_users->deleteOne(['id' => $deletingId]); // deleting related user by id 
    		header("Location: pages/settings.php");
    	}
    	else
    	{
    		echo '<script>
					alert("You cannot delete if there is only an user!")
					window.location.href = "pages/settings.php";
			</script>';
    	}    	
	}
	elseif ($process == "edit")
	{
		// variables comes from edit-admin.php
   		$userId = (int)$_GET["id"];
		$newUsername = $_POST["txt_username"];
		$oldPassword = $_POST["txt_oldpassword"];
		$newPassword = $_POST["txt_password"];		
		$newPassword2 = $_POST["txt_password2"];
		
		if($newPassword!=$newPassword2) // If new password does not match
		{
			echo '<script>
				alert("Your passwords does not match each other!");
        		window.location.href = "pages/edit-admin.php?username='.$newUsername.'";
        	</script>';
		}
		else
		{
			$admin = $tbl_users->findOne(array('id' => array('$eq' => $userId)));			
			if($admin['password']==$oldPassword) // old password must be true to change password
			{
				$tbl_users->updateOne(					
					['id' => $userId],
					['$set' => ['username' => $newUsername]]					
				);
				$tbl_users->updateOne(
					['id' => $userId],
					['$set' => ['password' => $newPassword]]					
				);

				echo '<script>
						alert("Updated!");
		        		window.location.href = "pages/settings.php";
        			</script>';
			}
			else // if old password wrong
			{
				echo '<script>
						alert("Invalid password! User could not be updated.");
		        		window.location.href = "pages/settings.php";
        			</script>';
			}
		}
	}
	elseif ($process == "logout")
	{
		session_unset();
		session_destroy();
		header("Location: index.php");
	}
?>