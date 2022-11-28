<div>
	This is a test page for SQL testing purposes only <br>
	======================================================================<br>
	
	php code to get current date <br>
	
	<?php
	//set timezone 
	//ideally, when we connect to database the time should set automatically
	date_default_timezone_set("America/Edmonton");
	echo "Today is ". date("l") . " ". date("Y-m-d") . "<br>";
	echo "The time is " . date("h:i:sa").  "<br>";
	?>
	
	
	======================================================================<br>
	
	This simple from from php will take username and userpassword as input<br>
	after user click the login button, it will jump to login.php file<br>
	<br>
	<body>
		<form method="POST" action="login.php">
			<label for="username">Username:</label>
			<input type="text" name="username" placeholder="Enter your username">
			
			<label for="password">Password:</label>
			<input type="password" name="password" placeholder="Enter your password">
			
			<input type="submit" value="Login">
		</form>
	</body>
	
	
	
	======================================================================<br>
	
	This line should print login error message if it exist<br>
	No erroe message should show if no failed attempt of loging occured <br>
	
	<?php if (isset($_GET['error'])) { 
		echo $_GET['error']; 
	}
	?>
	
	

</div>