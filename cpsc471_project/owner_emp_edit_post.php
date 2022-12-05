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
    $SIN = $_REQUEST["SIN"];
    $Branch_no = $_REQUEST["Branch_no"];
    $Employment_status = $_REQUEST["Employment_status"];
    $Start_date = $_REQUEST["Start_date"];
    $End_date = $_REQUEST["End_date"];
    $Salary = $_REQUEST["Salary"];
    $Severance = $_REQUEST["Severance"];
    $CurrentID = $_SESSION["E_UserID"];

    echo "Employee id: " . $_SESSION["E_UserID"] . "<br>";
    echo "name: " .$First_name . " " . $Middle_name . " " . $Last_name . "<br>";
    echo "email: " . $Email . "<br>";
    echo "phone number: " . $Phone_number . "<br>";
    echo "DOB: " . $DOB . "<br>";
    echo "Sex: " . $Sex . "<br>";
    echo "Address: " . $Street_no . " " . $Street_name . " " . $City . " " . $Province . " " . $Postal_code . "<br>";

    $stmt = $con->prepare("UPDATE users SET First_name = ?, Middle_name = ?, Last_name = ?, Email = ?, Phone_number = ?,
    DOB = ?, Sex = ?, Street_no = ?, Street_name = ?, City = ?, Province = ?, Postal_code = ?
    WHERE UserID = ?");
    $stmt->bind_param("sssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code, $_SESSION["E_UserID"]);
    $stmt->execute();
    echo "Employee user edited successfully";

    $stmt->close();

    $stmt = $con->prepare("UPDATE employee SET SIN = ?, Branch_no = ?
    WHERE E_UserID = ?");
    $stmt->bind_param("sss", $SIN, $Branch_no, $_SESSION["E_UserID"]);
    $stmt->execute();
    echo "Employee edited successfully";

    $stmt->close();

    $stmt = $con->prepare("UPDATE employs SET Employment_status = ?, Start_date = ?, End_date = ?, Salary = ?, Severance = ?
    WHERE E_UserID = ?");
    $stmt->bind_param("ssssss", $Employment_status, $Start_date, $End_date, $Salary, $Severance, $_SESSION["E_UserID"]);
    $stmt->execute();
    echo "Employs edited successfully";

    $stmt->close();

        header("Location: owner_emp_view.php");
        $con->close();
?>


    </body>
    </html>