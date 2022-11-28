<div>
	This login page after user enter their username and password <br>
	======================================================================<br>
	SQL connection code from tut<br>

	<?php
		$con = mysqli_connect("localhost","root","","cwcrs_db");
		if(!$con) {
			exit("An error connecting occurred." .mysqli_connect_errno());
		} else {
			echo "Connection successful <br>";
		}
	?>
	
	======================================================================<br>

	<?php
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	?>
	
	Test variable getter<br>
	The username entered is <?php echo $uname ?> <br>
	The username entered is <?php echo $pword ?> <br>
	
	<?php 
	
	session_start(); 
	//if username or password is empty, go the the login error page and try again 
	if (empty($uname )) {

		header("Location: index.php?error=User Name is required");

		exit();

	}else if(empty($pword)){

		header("Location: index.php?error=Password  is required");

		exit();

	}else{

		$sql = "SELECT * FROM login WHERE Login_username='$uname' AND Login_password='$pword'";
		$result = mysqli_query($con, $sql);
		
		
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);

			if ($row['Login_username'] === $uname && $row['Login_password'] === $pword) {

				echo "Logged in!";
					
				$userid = $row['UserID'];
				
				$sql = "SELECT * FROM permission WHERE UserID='$userid'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result);
				
				if ($row['PermissionName'] === "owner"){
					header("Location: ownerpage.php");
				}
				else if ($row['PermissionName'] === "customer"){
					header("Location: customerpage.php");
				}
				
				exit();

			}else{

				header("Location: index.php?error=Incorect User name or password");

				exit();

			}
		}else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }


	}
	
	?>
	
	
</div>