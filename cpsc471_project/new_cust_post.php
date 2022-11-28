<html>
    <body>
        Welcome <?php echo $_POST["First_name"]; ?><br>
        Your email address is: <?php echo $_POST["Email"]; ?>

        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    

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

    $stmt = $con->prepare("INSERT INTO users 
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt->bind_param("ssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code);
    
    $stmt->execute();
    //echo "New record created successfully";
    $last_id = $con->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    $stmt->close();

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
    

      //  echo "New record created successfully";
      /*  $sql2 = "INSERT INTO permission VALUES (NULL, 'Customer', UserID = (SELECT UserID FROM users WHERE UserID = (SELECT MAX(UserID) FROM users))";
        $result2 = $con->query($sql2);

        if($result2) {
            $sql3 = "INSERT INTO customer VALUES (C_UserID = (SELECT UserID FROM users WHERE UserID = (SELECT MAX(UserID) FROM users))";
            $result3 = $con->query($sql3);

            if($result3) {
                $sql4 = "INSERT INTO login VALUES (NULL, $Username, $Password, UserID = (SELECT UserID FROM users WHERE UserID = (SELECT MAX(UserID) FROM users))";
                $result4 = $con->query($sql4);

                if($result4) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql4 . "<br>" . $con->error;
                }
            } else {
                echo "Error: " . $sql3 . "<br>" . $con->error;
            }

        } else {
            echo "Error: " . $sql2 . "<br>" . $con->error;
        } */
    
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
        $con->close();
?>


    </body>
    </html>