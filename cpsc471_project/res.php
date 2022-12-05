
<?php
session_start();
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $sql2 = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
    $result2 = $con->query($sql2);

    if ($result2->num_rows > 0) {

        while($row = $result2->fetch_assoc()) {

            if($row["UserID"] == $_SESSION["UserID"]) {
                echo "UserID: " . $row["UserID"]. " - Name: " . $row["First_name"] .  " works at Branch: " . $row["Branch_no"] . "<br>";
            }
        }
      } else {
        echo "Can't find employee";
      }




    $sql = "SELECT * FROM Reservation";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
                echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
        
        }
      } else {
        echo "0 results";
      }
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
        width: 80%;
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
    }

    .res_table {
        border: 1px solid rgba(139,216,189,1);
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 2vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .res_table td {
        text-align: center;
        padding: 1.5vw;
        border: 1px solid rgba(139,216,189,1);
    }

    .no_res {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }

    .bottom_table{
        position: absolute;
        bottom:1vw;
        width: 98.5%;
        overflow: hidden;
    }

    .bottom_table td {
        text-align: center;
        padding 1.5vw;
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
        padding: 1.14vw 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    svg {
        color: rgba(139,216,189,1);
        fill: currentColor;
        width: 2.5vw;
        height: 2.5vw;
        
      }

      svg:hover {
        color: rgba(35,70,101,1);
      }

      .searchbar {
        display:flex;
        flex-direction:row;
        align-items:center;
      }

    
    
   </style>
<title>Canada Wide Car Rental Service - Employee: View Reservations</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">


<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT UserID, First_name, Middle_name, Last_name FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row["UserID"] == $_SESSION["UserID"]) {
            echo "Hello " . $row["First_name"]. " " . $row["Last_name"]. "!" ."<br>";
        }
    }
    $con->close();

?> 
<var id="E_UserID" style="display:none">
<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT UserID, First_name, Middle_name, Last_name FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row["UserID"] == $_SESSION["UserID"]) {
            echo "Hello " . $row["First_name"]. " " . $row["Last_name"]. "!" ."<br>";
        }
    }
    $con->close();

?> 
</var>
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>

<table class = "toptable">
<form action="res_post.php" method="post">
  <tr>
    <th>
    <div class = "searchbar">
      <input type="search" placeholder="Search.." name="search" required>
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" type="submit" name="submit" value="Submit">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>
</th>
    <th>Total Number of Reservations:<span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT End_date, COUNT(End_date) FROM Reservation Group by End_date";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["End_date"] >= date("Y-m-d")) {

            echo $row["COUNT(End_date)"];
        }
    }
}
    else{
        echo "0";
        }

    $con->close();

?> 
    </span></th>
    <th>Number of Pick-Ups Today:<span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Reservation";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["Start_date"] == date("Y-m-d") && $row["Pickup_location"] == $_SESSION["Branch_no"]) {
    
                echo $row["COUNT(Start_date)"];
            }
        }
    }
        else{
            echo "0";
            }
    $con->close();

?> 
    </span>
    </th>

    <th>Number of Drop-Offs Today:
    <span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Reservation";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["End_date"] == date("Y-m-d") && $row["Dropoff_location"] == $_SESSION["Branch_no"]) {
    
                echo $row["COUNT(Start_date)"];
            }
        }
    }
        else{
            echo "0";
            }
    $con->close();

?> 
    </span>
    </th>
    <th class = "addbutton">
    <button class= "backbutton" text-align=right type="button" onclick="window.location.href='add_res.php'"> Make Reservation</button> 
    </th>
  </tr>
  </table>

  <br>
  <br>

  <table class="res_table">
    <tr>
        <th>Reservation ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Pick-up Location</th>
        <th>Drop-off Location</th>
        <th>Payment ID</th>
        <th>Customer ID</th>
        <th>VIN</th>
        <th>Branch Created</th>

</tr>

        </table>
        <table>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Reservation";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
            
                echo "ReservationID: " . $row["ReservationID"]. " - Start Date: " . $row["Start_date"]. " End Date: " . $row["End_date"]. " PaymentID" . $row["PaymentID"] . " CustomerID" . $row["C_UserID"] . " Branch No:" . $row["Branch_no"] . " VIN: " . $row["VIN"] . " Pickup Location: " . $row["Pickup_location"] . " Dropoff Location: " . $row["Dropoff_location"] . "<br>";
            
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_res'>";
        echo "<tr>";
        echo "<td>";
        echo "No Reservations to Display";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
      }
    $con->close();

?> 
</table>
  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_start.php'"> Back</button>  
</td>
<td>
</td>
<td>
</td>
<td>
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