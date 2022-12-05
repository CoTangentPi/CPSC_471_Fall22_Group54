<?php
//start session
session_start();
?>
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

    echo "customer id: " . $_SESSION["C_UserID"] . "<br>";
    echo "name: " .$First_name . " " . $Middle_name . " " . $Last_name . "<br>";
    echo "email: " . $Email . "<br>";
    echo "phone number: " . $Phone_number . "<br>";
    echo "DOB: " . $DOB . "<br>";
    echo "Sex: " . $Sex . "<br>";
    echo "Address: " . $Street_no . " " . $Street_name . " " . $City . " " . $Province . " " . $Postal_code . "<br>";

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

    if(!$_SESSION["Under25"]){

    $stmt = $con->prepare("UPDATE users SET First_name = ?, Middle_name = ?, Last_name = ?, Email = ?, Phone_number = ?,
    DOB = ?, Sex = ?, Street_no = ?, Street_name = ?, City = ?, Province = ?, Postal_code = ?
    WHERE UserID = ?");
    $stmt->bind_param("sssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code, $_SESSION["C_UserID"]);
    $stmt->execute();
    echo "Customer edited successfully";

    $stmt->close();

        
        header("Location: emp_cust.php");
    } else {
        header("Location: edit_cust.php");
    }
        $con->close();
?>


    </body>
    </html>