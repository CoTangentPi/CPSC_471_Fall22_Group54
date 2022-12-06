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

    $sql = "SELECT * FROM Reservation, Customer
    WHERE Reservation.C_UserID = Customer.C_UserID";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
               // echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
                if($row["C_UserID"] == $_SESSION["UserID"]){
                 //   echo "has reservation";
                    if($row["Start_date"] > date("Y-m-d")){
                       echo "start date is after today";
                        $_SESSION["HasRes"] = true;
                        header("Location: cust_veh_search.php");
                    } else {
                        echo "start date is before today";
                        //$_SESSION["HasRes"] = false;
                      //  header("Location: cust_add_res.php");
                    }

                    
                } else {
                    echo "user: ".$_SESSION["UserID"]." has no reservation";
                  //  $_SESSION["HasRes"] = false;
                    header("Location: cust_add_res.php");
                }
        
        }
      } else {
      //  echo "0 results";
      }
        
        $con->close();
?>


    </body>
    </html>