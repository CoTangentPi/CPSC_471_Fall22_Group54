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

    $stmt = $con->prepare("SELECT UserID from Login WHERE Login_username = ? AND Login_password = ?"); 
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt->bind_param("ss", $_SESSION["Username"], $_SESSION["Password"]);
    
    $stmt->execute();
    
    //echo " statement user: " . $stmt;
    $stmt->bind_result($UserID);
    $UserID = $stmt->fetch();

    if($UserID)
    echo " statement user: " . $UserID;
    $stmt->close();

    echo "user: " . $UserID;
/*
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
    
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }*/
        $con->close();
?>


    </body>
    </html>