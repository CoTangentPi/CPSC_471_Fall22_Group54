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

    //if($_REQUEST["submitbutton"]=="Chosen"){
        echo"You chose a car!";
        $vin = $_REQUEST["VIN"];
        echo "VIN: " . $vin . "<br>";

        $sqlcheck = "SELECT * FROM vehicle";
        $result = mysqli_query($con, $sqlcheck);

        if ($result->num_rows > 0) {
             
            while($row = $result->fetch_assoc()) {
                if ($row["VIN"] == $vin) {
                    $_SESSION["VIN"] = $vin;
                    echo "session VIN: " . $_SESSION["VIN"] . "<br>";
                }
          } 
        }else {
            echo "0 results";
          }
          

        $con->close();

        header("Location: emp_veh_search.php");
?>


    </body>
    </html>