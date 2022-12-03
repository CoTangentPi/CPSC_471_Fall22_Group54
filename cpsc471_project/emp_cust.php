
<?php
session_start();

$_SESSION["RemoveCust"] = false;
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

    .cust_table {
        border: 1px solid rgba(139,216,189,1);
    }

    .cust_table2 {
        border: 1px solid rgba(139,216,189,1);
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .cust_table2 td {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    .no_cust {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }

    .bottom_table{
        position: absolute;
        bottom:1vw;
        width: 98.5%;
        overflow: scroll;
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
        padding: 0.9vw 1vw;
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
<title>Canada Wide Car Rental Service - Employee: View Customers</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">

Customers

<!--
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

?> -->
<!--<var id="E_UserID" style="display:none">
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
</var>-->
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>

    <form action="emp_cust_post.php" class = "searchbar" method="post">
      <input type="search" placeholder="Search.." name="search" required>
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" class= "submitbutton" type="submit" name="submit" value="Submit">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>

  <br>
  <br>

  <table class="cust_table">
    <tr>
        <th width = 11.35%>Customer ID</th>
        <th width = 20%>Name</th>
        <th width = 18%>Email</th>
        <th width = 12%>Phone Number</th>
        <th width = 7%>D.O.B</th>
        <th width = 4%>Sex</th>
        <th width = 35%>Address</th>

</tr>

        </table>
        <table>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Customer, Users WHERE Customer.C_UserID = Users.UserID";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {

                echo "<table class='cust_table2'>
                        <tr> 
                        <td width = 11.35%>" . $row["C_UserID"] . "</td> <td width = 20%>" . $row["First_name"] . 
                        " " . $row["Middle_name"] . " " . $row["Last_name"] . "</td> <td width = 18%>" . 
                        $row["Email"] . "</td> <td width = 12%>" . $row["Phone_number"] . "</td> <td width = 7%>" . 
                        $row["DOB"] . "</td> <td width = 4%>" . $row["Sex"] . "</td> <td width = 35%>" . 
                        $row["Street_no"] . " " . $row["Street_name"] . " " . $row["City"] . "," . $row["Province"] . " " .
                        $row["Postal_code"] . "</td> </tr> </table>";
            
               /* echo "Customer ID: " . $row["C_UserID"]. " Name: " . $row["First_name"] . " " . $row["Middle_name"] . 
                " " . $row["Last_name"] . " Email: " . $row["Email"] . " Phone Number :" . $row["Phone_number"] . 
                " DOB: " . $row["DOB"] . " Sex: " . $row["Sex"] . " Address: " . $row["Street_no"] . " " .
                $row["Street_name"] . " " . $row["City"] . "," . $row["Province"] . " " .$row["Postal_code"] ."<br>";*/
            
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_cust'>";
        echo "<tr>";
        echo "<td>";
        echo "No Customers to Display";
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