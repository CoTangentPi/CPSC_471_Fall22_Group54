<?php
//start session
session_start();
?>

<html>
    <body>
        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    
    $_SESSION["Username"] = $_REQUEST["Username"];
    $_SESSION["Password"] = $_REQUEST["Password"];

    echo "session keys: " . $_SESSION["Username"] . " " . $_SESSION["Password"];

    $stmt = $con->prepare("SELECT * from Login WHERE Login_username = ? AND Login_password = ?"); 
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt->bind_param("ss", $_SESSION["Username"], $_SESSION["Password"]);
    
    $stmt->execute();
    
    //echo " statement user: " . $stmt;
    $stmt->bind_result($LoginID, $Login_username, $Login_password, $UserID);
    echo "UserID: " . $UserID;

    while($stmt->fetch()) {
        echo "LoginID: " . $LoginID . " Login_username: " . $Login_username . " Login_password: " . $Login_password . " UserID: " . $UserID;
    }

    //$result = $stmt->fetch();
    $stmt->close();

    $_SESSION["UserID"] = $UserID;


    $sql = "SELECT * FROM permission WHERE UserID = $UserID";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
     
        while($row = $result->fetch_assoc()) {
            if($row["PermissionName"] == "Owner") {
                header("Location: owner_start.php");
                } else if($row["PermissionName"] == "Customer") {
                    header("Location: cust.php");
                } else if($row["PermissionName"] == "Employee") {
                    header("Location: emp_start.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
        }
      } else {
        echo "0 results";
      }

    
        $con->close();
?>


    </body>
    </html>
