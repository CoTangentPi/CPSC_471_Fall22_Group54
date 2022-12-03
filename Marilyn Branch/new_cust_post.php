<?php
//start session
session_start();
?>

<html>
    <body>
        Welcome <?php echo $_POST["First_name"]; ?><br>
        Your email address is: <?php echo $_POST["Email"]; ?>

        <?php
        //connect to database
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    
    //get values from form
    $First_name = $_REQUEST["First_name"];
    $Middle_name = $_REQUEST["Middle_name"];
    $Last_name = $_REQUEST["Last_name"];
    $Email = $_REQUEST["Email"];
    $Phone_number = $_REQUEST["Phone_number"];
    $DOB = $_REQUEST["DOB"];
    $Sex = $_REQUEST["Sex"];
    $Street_no = $_REQUEST["Street_no"];
    $Street_name = $_REQUEST["Street_name"];
    $City = $_REQUEST["City"];
    $Province = $_REQUEST["Province"];
    $Postal_code = $_REQUEST["Postal_code"];
    $Username = $_REQUEST["Username"];
    $Password = $_REQUEST["Password"];
    $Confirm_password = $_REQUEST["Confirm_password"];

    echo "inputted username: " . $Username . " inputted password: " . $Password;

    //check if user is over 25
    //adapted from stack overflow
    // https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
    $DOB_to_today = strtotime("$DOB");
    $today = strtotime("today");
    $diff = $today - $DOB_to_today;

    $age = floor($diff / (365.2*60*60*24));


    echo "Num of years between dob and today = " . $age;

    if($age < 25){
        $_SESSION["Under25"] = true;
    }

    //check if passwords match
    if(strcmp($Password, $Confirm_password) != 0) {
        echo "passwords do not match";
        $_SESSION["NotSame"] = true;
        header("Location: new_cust.php");
    } 

    //check if username is already taken
    $sqlcheck = "SELECT * FROM login";
    $resultcheck = $con->query($sqlcheck);

    $count = mysqli_num_rows($resultcheck);
    $same = 0;

    echo "count: " . $count . "<br>";

    if($resultcheck->num_rows > 0) {
        echo "num rows: " . $resultcheck->num_rows . "<br>";
        while($row = $resultcheck->fetch_assoc()) {
                
                if(strcmp($row['Login_username'],$Username) == 0) {
                    //echo "Not user logging in";
                    $same += 1;
                    $_SESSION["Taken"] = $row["Login_username"];
                    echo "taken: " . $_SESSION["Taken"] ."<br>";                
                } 

            echo "same: " . $same . "<br>";
            if($same > 0) {
                echo "Not valid username";
                $_SESSION["Same_Username"] = true;
                header("Location: new_cust.php");
            }

            echo "same username bool: " . $_SESSION["Same_Username"] . "<br>";

            echo "LoginID: " . $row["LoginID"] . " Login_username: " . $row["Login_username"] . " Login_password: " . $row["Login_password"] . " UserID: " . $row["UserID"] . "<br>";
        }
    } else {
        echo "0 results";
    }

    //if username is valid, passwords match, and user is over 25, insert into database

    if(!$_SESSION["Same_Username"] && !$_SESSION["NotSame"] && !$_SESSION["Under25"]){

        //use prepared statements to sanitize user inputs
    $stmt = $con->prepare("INSERT INTO users 
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code);
    
    $stmt->execute();
    //check for last user id inserted as that is the user id for this user
    $last_id = $con->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    $stmt->close();

    //use prepared statements to sanitize user inputs
    $stmt2 = $con->prepare("INSERT INTO login
    VALUES (NULL, ?, ?, ?)");
    $stmt2->bind_param("sss", $Username, $Password, $last_id);
    $stmt2->execute();
    echo "Login record created successfully";
    $stmt2->close();


    $sql = "INSERT INTO Customer VALUES ($last_id)";
    $result = $con->query($sql);

    if($result) {
        echo "Customer record created successfully";
        $sql2 = "INSERT INTO permission VALUES (NULL, 'Customer', $last_id)";
        $result2 = $con->query($sql2);
        if($result2) {
            echo "Permission record created successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $con->error;
        }
    
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $_SESSION["UserID"] = $last_id;
    header("Location: cust.php");
    
}
    
        $con->close();
?>


    </body>
    </html>