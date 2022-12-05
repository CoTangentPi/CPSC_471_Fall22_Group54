
<?php
session_start();
$_SESSION["Start_after_end"] = false;

//$_SESSION["VIN"] = "1HGBH41JXMN109186";
//$_SESSION["VIN"] ="3ABCD12EFGH345678";
//$_SESSION["VIN"] = "1HGBH41JXMN109999"; //this is a VIN that does not exist in the database

//$_SESSION["VIN"] = "2ZYXW98ZYXW987654";
//$_SESSION["VIN"] = "4MNBV65LKJH765432";
//$_SESSION["VIN"] = "5POIU98MNBV987652";
//$_SESSION["VIN"] = "6ASDF56ASDF567890";
//$_SESSION["VIN"] = "7BVCX76NBVC876543";
//$_SESSION["VIN"] = "8NMGH78GHJK456789";

    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
       // echo "Connection successful\n";
    }

    $sql2 = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
    $result2 = $con->query($sql2);

   /* if ($result2->num_rows > 0) {

        while($row = $result2->fetch_assoc()) {

            if($row["UserID"] == $_SESSION["UserID"]) {
                 echo "UserID: " . $row["UserID"]. " - Name: " . $row["First_name"] .  " works at Branch: " . $row["Branch_no"] . "<br>";
            }
        }
      } else {
         echo "Can't find employee";
      }*/




    $sql = "SELECT * FROM Reservation";
    $result = $con->query($sql);


    /*if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
                echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
        
        }
      } else {
        echo "0 results";
      }*/
        $con->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
      body {
         background-color: rgba(0,0,0,0.6499999761581421);
         font-family: verdana;
         color: rgba(139,216,189,1);
         overflow: auto;
        }


      .header{
        overflow:auto;
      }

      .header img {
        float: right;
        width: 10vw;
        height: 10vw;
    }

    .header h1 {
        float: left;
        color: rgba(139,216,189,1);
        font-family:verdana;
        top: 50%;
        transform: translateY(50%);
    }

    ::placeholder{
        color: rgba(139,216,189,1);
    }

    input[type=search]{
        width: 20%;
        padding: 1.5vw 3vw;
        margin: 1vw 0;
        display: inline-block;
        border: 1px solid rgba(139,216,189,1);
        box-sizing: border-box;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-size:1.5vw;
        placeholder-color: rgba(139,216,189,1);
    }

    table {
        font-family: verdana;
        color: rgba(139,216,189,1);
        border-collapse: collapse;
        width: 100%;
        vertical-align: middle;
        table-layout: fixed;
    }

    th {
        font-size:1.5vw;
        text-align: center;
        padding: 1vw;
    }
    .search_table2 td {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
    }

    .searched_car th{
        width: 50%;
        text-align: center;
    }

    .no_pic {
        width:18vw;
        height:15vw;
        color: tomato;
        background-color: darkgrey;
        border: 1px solid black;
        width: 32vw;
        text-align: center;
        vertical-align: middle;
        font-size: 4vw;
    }
    .comingSoon{
        font-size: 1.5vw;
        color: rgba(139,216,189,1);
        text-align: center;
    }

    .car img {
        float: center;
        height: 15vw;
    }

    .car{
        background-color: darkgrey;
        border: 1px solid black;
        text-align: center;
        width: 32vw;

    }

    .no_cust {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }

    .bottom_table{
        position: relative;
        bottom:1vw;
        width: 98.5%;
        overflow: hidden;
        padding: 4vw;
        vertical-align: middle;
    }

    .button_table{
        text-align: center;
        position: relative;
        width: 98.5%;
        transform: translateY(-10vw);
    }

    .bottom_table td {
        text-align: center;
    }

    button{
        background-color: rgba(35,70,101,1);
        border: none;
        color: rgba(139,216,189,1);
        padding: 1.5vw 3vw;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 2vw;
        cursor: pointer;
    }

    button:hover {
        background-color: rgba(139,216,189,1);
        color: rgba(35,70,101,1);
    }

    .searchbutton {
        padding: 0.9vw 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    svg {
        color: #fff;
        fill: currentColor;
        width: 2.5vw;
        height: 2.5vw;
        
      }

      .searchbar {
        display:flex;
        flex-direction:row;
        align-items:center;
      }

      .edit{
        position: relative;
      }

      .editbutton{
        position: absolute;
        bottom: -1vw;
        right:-19vw;
      }

      .removebutton{
        position: absolute;
        bottom: -1vw;
        right:-40vw;
      }
    
    
   </style>
<title>Canada Wide Car Rental Service - Customer: Search Vehicles</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Search Vehicles
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

</br>
</br>
</br>

<table class = "searched_car">
<tr>
    <th>
 </th>
    <th>
            <?php 
                if(strcmp($_SESSION["VIN"],"1HGBH41JXMN109186") == 0){
                   echo "<div class = 'car'><img src='vw jetta.png' alt='vw jetta'/></div>";
                } else if (strcmp($_SESSION["VIN"],"3ABCD12EFGH345678") == 0){
                    echo "<div class = 'car'><img src='chevy spark.png' alt='vw jetta'/></div>";
                } else if (strcmp($_SESSION["VIN"],"2ZYXW98ZYXW987654") == 0){
                    echo "<div class = 'car'><img src='fiat 500.png' alt='vw jetta'/></div>";
                }else if (strcmp($_SESSION["VIN"],"4MNBV65LKJH765432") == 0){
                    echo "<div class = 'car'><img src='nissan versa.png' alt='vw jetta'/></div>";
                }else if (strcmp($_SESSION["VIN"],"5POIU98MNBV987652") == 0){
                    echo "<div class = 'car'><img src='kia forte.png' alt='vw jetta'/></div>";
                }else if (strcmp($_SESSION["VIN"],"6ASDF56ASDF567890") == 0){
                    echo "<div class = 'car'><img src='toyota camry.png' alt='vw jetta'/></div>";
                }else if (strcmp($_SESSION["VIN"],"7BVCX76NBVC876543") == 0){
                    echo "<div class = 'car'><img src='nissan maxima.png' alt='vw jetta'/></div>";
                }else if (strcmp($_SESSION["VIN"],"8NMGH78GHJK456789") == 0){
                    echo "<div class = 'car'><img src='chrysler 300.png' alt='vw jetta'/></div>";
                }else{
                    echo "<div class = 'no_pic'>
                    IMAGE <br> COMING <br> SOON!</div>";
                }
            ?>
    </th>
    <th><!--<form action='emp_veh_search_post.php' method='post'>
    <button class= "submitbutton" type="submit" name="submit" value="Submit">Edit</button>
    </form>-->
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='cust_add_res.php'"> Make Reservation</button>  


</th>
    </tr>
</table>


<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Vehicle, Features, Branch, Insurance
            WHERE  Vehicle.VIN = Features.VIN
            AND Vehicle.Branch_no = Branch.Branch_no
            AND Vehicle.InsuranceID = Insurance.InsuranceID";
    $result = $con->query($sql);

    //echo "num rows: " . $result->num_rows. "<br>";

    $totalRows = $result->num_rows;
    $check = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {

            if(strcmp($row["VIN"],$_SESSION["VIN"]) == 0){

                echo "<table class='search_table2'>
                        <tr> <td> <b>Year: </b> </td><td>" . $row["Year"]. "</td> <td> <b> Make: </b></td><td>" . 
                        $row["Make"] . "</td> </tr><tr> <td> <b> Model: </b></td><td>" . $row["Model"] . 
                        "</td> <td> <b> Branch Located: </b></td><td>" . $row["Branch_name"] . 
                        "</td> </tr><tr> <td> <b> Category: </b></td><td>" 
                        . $row["Category"] . "</td> <td> <b> Trans / Driven Wheels: </b></td><td>" . $row["Trans_Driven_wheels"] . 
                        "</td> </tr><tr> <td> <b> Fuel / Air Conditioning: </b></td><td>" . $row["Fuel_Air_con"] . 
                        "</td> <td> <b> Type: </b></td><td>" . $row["Type"] . "</td> </tr><tr> <td> <b> Horse Power: </b></td><td>" .
                        $row["Horse_power"] . " hp</td> <td> <b> Torque: </b></td><td>" . $row["Torque"] . 
                        " lb-ft</td> </tr> <tr> <td> <b> Tonnage: </b></td><td>" . $row["Tonnage"] . " lbs</td>  <td> <b> Sunroof: </b></td><td>". 
                        $row["Sunroof"] . "</td> </tr><tr> <td> <b> Seat Material: </b></td><td>" . $row["Seat_material"] . 
                        "</td><td> <b> Body Colour: </b></td><td>" . $row["Body_colour"] . "</td> </tr><tr> <td> <b> Interior Colour: </b></td><td>".
                        $row["Interior_colour"] . "</td> <td> <b> Fuel Economy: </b></td><td>" . $row["Fuel_economy"] . 
                        " L / 100 km</td> </tr><tr><td> <b> Child Seat Compatible: </b></td><td>" . $row["Childseat_compatibility"] . 
                        "</td> <td> <b> Number of Passengers: </b></td><td>".                        
                        $row["Number_of_passengers"] .  "</td>  </tr> </table> <br> <br>";
            
            } else {
                $check++;
            }
        }
        if ($check == $totalRows){
            echo "<br>";
            echo "<br>";
            echo "<table class='no_cust'>";
            echo "<tr>";
            echo "<td>";
            echo "No Records Found for VIN: " . $_SESSION["VIN"];
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "<br>";
        }
           } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_cust'>";
        echo "<tr>";
        echo "<td>";
        echo "No Records Found for VIN: " . $_SESSION["VIN"];
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "<br>";
        echo "<br>";
        
      }
    $con->close();

?>  

<!--
<table class = "button_table">
    <tr>
        <td>
        <button class= "backbutton" text-align=left type="button" onclick="window.location.href='transfer.php'"> Transfer</button>  
        </td>
        <td>
        <button class= "backbutton" text-align=left type="button" onclick="window.location.href='add_ins.php'"> Add Insurance</button>  
        </td>
        <td>
        <button class= "backbutton" text-align=left type="button" onclick="window.location.href='service_recs.php'"> Service Records</button>  
        </td>
    </tr>
    </table> -->
  <table class="bottom_table">
  <tr>
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='cust.php'"> Back</button>  
</td>
<td>
</td>

<td>
    <button class= "logoutbutton" type="button" onclick="window.location.href='login.php'"> Log Out</button>  
</td>
</tr>
</table>
    </body>
    </html>