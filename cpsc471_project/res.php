
<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
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

    table {
        font-family: verdana;
        color: rgba(139,216,189,1);
        border-collapse: collapse;
        width: 100%;
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
        if($row["UserID"] == 3) {
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
        if($row["UserID"] == 3) {
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
<table>
  <tr>
    <th>
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
            if($row["Start_date"] == date("Y-m-d")) {
    
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

    $sql = "SELECT * FROM Owner";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row["O_UserID"] == 1) {
            $number = $row["Revenue"] - $row["Expenses"];
            echo "$" . number_format($number, 2);
        }
    }
    $con->close();

?> 
    </span>
    </th>
  </tr>
  </table>

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
<tr>
<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Owner, Users WHERE O_UserID = UserID";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
            if($row["UserID"] == 1) {
                echo "O_UserID: " . $row["O_UserID"]. " - Name: " . $row["First_name"]. " " . $row["Middle_name"]. " " . $row["Last_name"]. "<br>";
            }
        }
      } else {
        echo "No Reservations to show";
      }
    $con->close();

?> 
</tr>
</table>
  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="alert('Go to Employee')"> Back</button>  
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
    <button class= "logoutbutton" type="button" onclick="alert('Go to Login')"> Log Out</button>  
</td>
</tr>
</table>
    </body>
    </html>