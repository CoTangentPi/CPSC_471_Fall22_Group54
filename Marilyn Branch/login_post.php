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

   // if ($stmt->num_rows > 0) {

    while($stmt->fetch()) {
       /* if($row['Login_username'] != $_SESSION["Username"] || $row['Login_password'] != $_SESSION["Password"]) {
            echo "Not valid user";
            $_SESSION["Invalid"] = true;
            header("Location: login.php");

        } else {*/
        echo "LoginID: " . $LoginID . " Login_username: " . $Login_username . " Login_password: " . $Login_password . " UserID: " . $UserID;
        //}
    }

        echo "statement num rows before: " . $stmt->num_rows . "<br>";
        $stmt->close();

        $sqlcheck = "SELECT * FROM login";

        $resultcheck = $con->query($sqlcheck);

        $count = mysqli_num_rows($resultcheck);
        $checked = 0;

        echo "count: " . $count . "<br>";

        if($resultcheck->num_rows > 0) {
            echo "num rows: " . $resultcheck->num_rows . "<br>";
            while($row = $resultcheck->fetch_assoc()) {
                
                for($i = 0; $i < $count; $i++) {
                    if($row['Login_username'] != $_SESSION["Username"] || $row['Login_password'] != $_SESSION["Password"]) {
                        echo "Not user logging in";
                        $checked += 1;
                        //$_SESSION["Invalid"] = true;
                       // header("Location: login.php");
                    } else {
                        echo "LoginID: " . $row["LoginID"]. " Login_username: " . $row["Login_username"]. " Login_password: " . $row["Login_password"]. " UserID: " . $row["UserID"]. "<br>";
                    }
                }

                if($checked == $count) {
                    echo "Not valid user";
                    $_SESSION["Invalid"] = true;
                    header("Location: login.php");
                }

                echo "LoginID: " . $row["LoginID"] . " Login_username: " . $row["Login_username"] . " Login_password: " . $row["Login_password"] . " UserID: " . $row["UserID"] . "<br>";
            }
        } else {
            echo "0 results";
        }

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
                        $sqlemp = "SELECT * FROM Employee WHERE E_UserID = $UserID";
                        $resultemp = $con->query($sqlemp);
                        if ($resultemp->num_rows > 0) {
                            while($row = $resultemp->fetch_assoc()) {
                                $_SESSION["Branch_no"] = $row["Branch_no"];
                            }
                        }
                        header("Location: emp_start.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $con->error;
                    }
            }
          } else {
            echo "0 results";
          }
        /*} else {
            echo "0 row results";
            echo "Not valid user";
            $_SESSION["Invalid"] = true;
            echo "LoginID: " . $LoginID . " Login_username: " . $Login_username . " Login_password: " . $Login_password . " UserID: " . $UserID;
       
            //header("Location: login.php");
          }*/
    
    

    



    
        $con->close();
?>


    </body>
    </html>