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

    $stmt = $con->prepare("UPDATE users SET First_name = ?, Middle_name = ?, Last_name = ?, Email = ?, Phone_number = ?,
    DOB = ?, Sex = ?, Street_no = ?, Street_name = ?, City = ?, Province = ?, Postal_code = ?
    WHERE UserID = ?");
    $stmt->bind_param("sssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code, $_SESSION["C_UserID"]);
    $stmt->execute();
    echo "Customer edited successfully";

    $stmt->close();

        
        header("Location: emp_cust.php");
        $con->close();
?>


    </body>
    </html>