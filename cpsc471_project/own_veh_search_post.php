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

     //   $dateSold = $_REQUEST["Date_sold"];
       // $price = $_REQUEST["Price"];
        //$datePurch = date("Y-m-d");

        $stmt = $con->prepare("SELECT * FROM lease
                WHERE O_UserID = ?
                AND VIN = ?;");
        $stmt->bind_param("ss", $_SESSION["UserID"], $_SESSION["VIN"]);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["O_UserID"] . " " . $row["VIN"] . "<br>";
               // $datePurch = $row["Date_purchased"];
            }
        } else {
            echo "0 results";
            $_SESSION["NotLeased"] = true;
        //    header("Location: own_veh_search.php");
        }

        if(!$_SESSION["NotLeased"]){
            echo "ok to remove <br>";

           // if($datePurch <= $dateSold){

            $stmt = $con->prepare("DELETE FROM lease WHERE O_UserID = ? AND VIN = ?;");
            $stmt->bind_param("ss", $_SESSION["UserID"], $_SESSION["VIN"]);
      
            $stmt->execute();
            $stmt->close();
            echo "lease removed <br>";
          //  header("Location: own_veh_search.php");

           /*} else {
                echo "date purchased is after date sold <br>";
                $_SESSION["PurchaseAfterSell"] = true;
                header("Location: sell_veh.php");
            }*/

        }

            header("Location: own_veh_search.php");
    
        $con->close();
        ?>


</body>

</html>