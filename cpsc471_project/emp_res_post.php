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

        $search = $_REQUEST["search"];
        echo "search: " . $search . "<br>";

        $stmt = $con->prepare("SELECT * FROM reservation, branch, payment
    WHERE reservation.Branch_no = branch.Branch_no
    AND reservation.PaymentID = payment.PaymentID
    AND reservation.C_UserID = payment.C_UserID
    AND (Start_date LIKE  CONCAT( '%',?,'%')
    OR End_date LIKE CONCAT( '%',?,'%')
    OR payment.PaymentID LIKE CONCAT( '%',?,'%')
    OR payment.C_UserID LIKE CONCAT( '%',?,'%')
    OR branch.Branch_no LIKE CONCAT( '%',?,'%')
    OR VIN LIKE CONCAT( '%',?,'%')
    OR Pickup_location LIKE CONCAT( '%',?,'%')
    OR Dropoff_location LIKE CONCAT( '%',?,'%')
    OR ReservationID LIKE CONCAT( '%',?,'%')
    OR Branch_name LIKE CONCAT( '%',?,'%')
    OR Price LIKE CONCAT( '%',?,'%')
    OR Payment_method LIKE CONCAT( '%',?,'%'));");
        $stmt->bind_param(
            "ssssssssssss",
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search,
            $search
        );
        $stmt->execute();
        echo "created<br>";

        $_SESSION["SearchResult"] = [];
        //$data = [];
        //while ($row = $result->fetch_assoc()) {
        //$data[] = $row;
        //}
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // $data[] = $row;
                $_SESSION["SearchResult"][] = $row;
                echo $row["ReservationID"] . " " . $row["VIN"] . "<br>";
            }
        } //else {
        $stmt->close();
        $stmt2 = $con->prepare("SELECT * FROM reservation, branch, payment
        WHERE reservation.Pickup_location = branch.Branch_no
        AND reservation.PaymentID = payment.PaymentID
        AND reservation.C_UserID = payment.C_UserID
        AND (Branch_name LIKE CONCAT( '%',?,'%')
        OR Pickup_location LIKE CONCAT( '%',?,'%')
        OR Price LIKE CONCAT( '%',?,'%')
        OR Payment_method LIKE CONCAT( '%',?,'%'));");
        //  $stmt2->bind_param("ssssssssss", $search, $search, $search, $search, $search, $search, $search, 
        //                  $search, $search,  $search);
        $stmt2->bind_param("ssss", $search, $search, $search, $search);
        $stmt2->execute();
        echo "pickup<br>";
       // $count = 0;
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $count = 0;
                for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                    if ($_SESSION["SearchResult"][$i]["ReservationID"] == $row["ReservationID"]) {
                        $count++;
                    }
                    //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
                }
                
                if ($count == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["ReservationID"] . " " . $row["VIN"] . "<br>";
                }
            }
            //$_SESSION["SearchResult"][] = $row;
            //  echo $row["ReservationID"] . " " . $row["VIN"]."<br>";
        }
        //} //else {
        $stmt2->close();
        
        $stmt3 = $con->prepare("SELECT * FROM reservation, branch, payment
                WHERE reservation.Dropoff_location = branch.Branch_no
                AND reservation.PaymentID = payment.PaymentID
                AND reservation.C_UserID = payment.C_UserID
                AND (Branch_name LIKE CONCAT( '%',?,'%')
                OR Dropoff_location LIKE CONCAT( '%',?,'%')
                OR Price LIKE CONCAT( '%',?,'%')
                OR Payment_method LIKE CONCAT( '%',?,'%'));");
        //$stmt3->bind_param("ssssssssss", $search, $search, $search, $search, $search, $search, $search, 
        //                  $search, $search,  $search);
        $stmt3->bind_param("ssss", $search, $search, $search, $search);
        $stmt3->execute();
        echo "dropoff<br>";
        $result3 = $stmt3->get_result();
        if ($result3->num_rows > 0) {
            while ($row = $result3->fetch_assoc()) {
                $count = 0;
                for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                    if ($_SESSION["SearchResult"][$i]["ReservationID"] == $row["ReservationID"]) {
                        $count++;
                    }
                    //echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
                }
                // $data[] = $row;
                if ($count == 0) {
                    $_SESSION["SearchResult"][] = $row;
                    echo $row["ReservationID"] . " " . $row["VIN"] . "<br>";
                }
            }
        } //else {
        // echo "0 results";
        //}
        $stmt3->close();
        //}
        //}
        

        for ($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
            echo $_SESSION["SearchResult"][$i]["ReservationID"] . "<br>";
        }



        // $stmt->close();
        


        $con->close();
        header("Location: emp_res_search.php");
        ?>


</body>

</html>