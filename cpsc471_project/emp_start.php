 
<?php

    session_start();
    $_SESSION["Invalid"] = false;
    $_SESSION["Start_after_end"] = false;    
    $_SESSION["Current_mileage"] = 0;
    $_SESSION["Mileage_less_than_current"] = false;
    $_SESSION["Start_branch_same_as_end_branch"] = false;
    $_SESSION["Under25"] = false;

    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $sql = "SELECT * FROM Employee, Users WHERE Employee.E_UserID = Users.UserID";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
                echo "E_UserID: " . $row["E_UserID"]. " - Name: " . $row["First_name"]. " " . $row["Middle_name"]. " " . $row["Last_name"]. "<br>";
        
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
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 2vw;
    }
    td {
        text-align: center;
        padding: 1.5vw;
    }

    .logout_table td {
        text-align: right;
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
        font-size: 3vw;
        cursor: pointer;
    }

    button:hover {
        background-color: rgba(139,216,189,1);
        color: rgba(35,70,101,1);
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee</title>
</head>

<body>
<!--session_start();-->

<div class="header">

<h1 style="font-size:3vw">
<?php ob_start(); ?>
<div>HTML goes here...</div>
<div>More HTML...</div>
<?php $my_var = ob_get_clean(); ?>
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

</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>


  <table>
  <tr>
    <td>
</td>
    <td>
    <button class= "insbutton" type="button" onclick="window.location.href='emp_ins.php'">Insurance</button>  
</td>
    <td></td>
  </tr>
  <tr>
    <td>
</td>
    <td>
    <button class= "resbutton" type="button" onclick="window.location.href='emp_res.php'">Reservations</button>  
</td>
    <td></td>
  </tr>
  <tr>
    <td>
</td>
    <td>
    <button class= "vehiclebutton" type="button" onclick="window.location.href='emp_veh.php'">Vehicles</button>  
</td>
    <td></td>
  </tr>
  <tr>
    <td>
</td>
    <td>
    <button class= "custbutton" type="button" onclick="window.location.href='emp_cust.php'">Customers</button>  
</td>
    <td></td>
  </tr>
</table>
  <table class="logout_table">
  <tr>
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