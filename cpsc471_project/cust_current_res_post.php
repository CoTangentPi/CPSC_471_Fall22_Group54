<?php
//start session
session_start();
?>
<html>

<body>

    <?php
        $con = mysqli_connect("localhost", "root", "", "cwcrs_db");
        if (!$con) {
            exit("An error connecting occurred." . mysqli_connect_errno());
        } else {
            echo "Connection successful\n";
        }

        

        if ($_REQUEST["submitbutton"] == "Pay") {
            echo "You pressed pay <br>";
            echo "go to payment page <br>";
            $_SESSION["PayRes"] = true;
            $_SESSION["RemoveRes"] = false;
            $_SESSION["SearchRes"] = false;
            // header("Location: cust_pay.php");
        } else if ($_REQUEST["submitbutton"] == "Remove") {
            echo "You pressed remove";
            $_SESSION["RemoveRes"] = true;
            $_SESSION["PayRes"] = false;
            $_SESSION["SearchRes"] = false;
            //=header("Location: emp_ins_remove.php");
        } else if ($_REQUEST["submitbutton"] == "Search") {
            $_SESSION["SearchRes"] = true;
            $_SESSION["RemoveRes"] = false;
            $_SESSION["PayRes"] = false;
            $search = $_REQUEST["search"];
            echo "search: " . $search . "<br>";
        }

        if ($_SESSION["PayRes"] || $_SESSION["RemoveRes"]) {
            $resID = $_REQUEST["ResID"];
            $payID = $_REQUEST["PaymentID"];
            $price = $_REQUEST["Price"];
            $method = $_REQUEST["PayMethod"];
            echo "Reservation ID: " . $resID . "<br>";
            echo "PayID: " . $payID . "<br>";
            echo "Price: " . $price . "<br>";
            echo "Method: " . $method . "<br>";

            if ($_SESSION["PayRes"]) {
                $_SESSION["ReservationID"] = $resID;
                $_SESSION["PaymentID"] = $payID;
                $_SESSION["Price"] = $price;
                $_SESSION["PayMethod"] = $method;
                $_SESSION["PayRes"] = false;
                header("Location: cust_pay.php");
            }

            if ($_SESSION["RemoveRes"]) {


               
                echo "You pressed remove <br>";
                /*$stmt = $con->prepare("DELETE FROM payment WHERE PaymentID = ? AND C_UserID = ?");
                $stmt->bind_param("ss", $payID, $_SESSION["UserID"]);
                $stmt->execute();
                echo "Payment removed successfully";
                $stmt->close();*/
                $stmt = $con->prepare("DELETE FROM reservation WHERE ReservationID = ?
                AND PaymentID = ?
                AND C_UserID = ?;");
                $stmt->bind_param("sss", $resID, $payID, $_SESSION["UserID"]);//issue
                $stmt->execute();
                echo "Reservation removed successfully";
                $stmt->close();

               /* $stmt = $con->prepare("DELETE FROM payment WHERE PaymentID = ? AND C_UserID = ?");
                $stmt->bind_param("ss", $payID, $_SESSION["UserID"]);
                $stmt->execute();
                echo "Payment removed successfully";
                $stmt->close();*/
                


                $_SESSION["RemoveRes"] = false;
              // header("Location: cust_view_res.php");
            }


        }

       
        // header("Location: emp_res_search.php");
        ?>


</body>

</html>