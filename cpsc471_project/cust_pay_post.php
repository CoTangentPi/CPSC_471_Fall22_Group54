<?php
//start session
session_start();
?>
<html>
    <body>
        Welcome <?php echo $_SESSION["UserID"]; ?><br> ?>

        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $method = $_REQUEST["PayMethod"];
    $cardNum = $_REQUEST["CardNum"];
    $expDate = $_REQUEST["CardExp"];

    echo "Payment Method: " . $method . "<br>";

    $stmt = $con->prepare("UPDATE payment
        SET Payment_Method = ?
        WHERE PaymentID = ? AND C_UserID = ?");
        $stmt->bind_param("sss", $method, $_SESSION["PaymentID"], $_SESSION["UserID"]);
        $stmt->execute();
        echo "Payment updated successfully";
        $stmt->close();

        header("Location: cust.php");
        
        $con->close();
?>


    </body>
    </html>