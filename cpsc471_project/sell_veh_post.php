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
            echo "Connection successful<br>";
        }

        echo "owner id: " . $_SESSION["UserID"] . "<br>";
        echo "vin: " . $_SESSION["VIN"] . "<br>";

        $dateSold = $_REQUEST["Date_sold"];
        $price = $_REQUEST["Price"];
        $datePurch = date("Y-m-d");

        $stmt = $con->prepare("SELECT * FROM buys
                WHERE O_UserID = ?
                AND VIN = ?;");
        $stmt->bind_param("ss", $_SESSION["UserID"], $_SESSION["VIN"]);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["O_UserID"] . " " . $row["VIN"] . "<br>";
                $datePurch = $row["Date_purchased"];
            }
        } else {
            echo "0 results";
            $_SESSION["NotOwned"] = true;
            header("Location: sell_veh.php");
        }

        if(!$_SESSION["NotOwned"]){
            echo "ok to sell <br>";

            if($datePurch <= $dateSold){

            $stmt = $con->prepare("INSERT INTO sells
            VALUES (?, ?, ?, ?);");
            $stmt2->bind_param("ssss", $_SESSION["UserID"], $_SESSION["VIN"], $dateSold, $price);
      
            $stmt->execute();
            $stmt->close();
            echo "inserted into sells <br>";
            header("Location: own_veh_search.php");

            } else {
                echo "date purchased is after date sold <br>";
                $_SESSION["PurchaseAfterSell"] = true;
                header("Location: sell_veh.php");
            }

        }


        
        $con->close();
        ?>


</body>

</html>