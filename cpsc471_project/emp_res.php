
<?php
    session_start();
    $_SESSION["Start_after_end"] = false;    
    $_SESSION["EditRes"] = false;
    $_SESSION["RemoveRes"] = false;

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
           //     echo "ReservationID: " . $row["ReservationID"]. " Start" . $row["Start_date"]. "<br>";
        
        }
      } else {
        echo "0 results";
      }

      $_SESSION["Branches"] = [];
      $sqlbranch = "SELECT * FROM Branch";
      $resultbranch = $con->query($sqlbranch);
      if ($resultbranch->num_rows > 0) {
        while($row = $resultbranch->fetch_assoc()) {
            $_SESSION["Branches"][$row["Branch_no"]] = $row["Branch_name"];
            }
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
         overflow: auto;
         display:flex; 
         flex-direction:column;
         min-height: 100vh; 
         margin:1vw;
        }

    footer{ 
     min-height:7vw; 
    }

    /* The article fills all the space between header & footer */
    article{ 
        flex:1; 
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
        text-align: center;
        font-family: verdana;
        color: rgba(139,216,189,1);
        border-collapse: collapse;
        width: 100%;
        vertical-align: middle;
    }

    .ins_table2 {
        border: 1px solid rgba(139,216,189,1);
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
    }
    
    .ins_table2 td {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    .res_table {
        border: 1px solid rgba(139,216,189,1);
    }
    .res_table th {
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
        position: relative;
        bottom:1vw;
        width: 98.5%;
        overflow: auto;
        transform: translateY(1.5vw);
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
      .addbutton{
        font-size: 1.8vw;
        padding: 1vw 2.5vw;
      }

      .addbuttonbox{
        text-align: right;
      }
    
    
   </style>
<title>Canada Wide Car Rental Service - Employee: View Reservations</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">

Reservations
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

<!--<article>-->
<table class = "toptable">
<form action="emp_res_post.php" method="post">
  <tr>
    <th width = 25%>
    <div class = "searchbar">
      <input type="search" placeholder="Search.." name="search" required>
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" type="submit" name="submit" value="Submit">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>
</th>
    <th width = 20%>Total Number of Reservations:<span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }
    $count = 0;
    $totalRes = 0;
    $today = date("Y-m-d");
    $sql = "SELECT End_date, COUNT(End_date) FROM Reservation 
    WHERE End_date >= $today
    Group by End_date";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["End_date"] >= date("Y-m-d")) {
            $count++;
            $totalRes += $row["COUNT(End_date)"];
          //  echo "row".$row["COUNT(End_date)"];
        }
    }//echo "count" . $count;
   // echo "total" . $totalRes;
     echo $totalRes;
   
    
    //echo "count end date: " . $row["COUNT(End_date)"];
}
    else{
        echo "0";
        }

    $con->close();

?> 
    </span></th>
    <th width = 15%>Number of Pick-Ups Today:<span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $count = 0;
    $totalPickUp = 0;
    //echo "today: " . date("Y-m-d");
    $sql = "SELECT *
    FROM Reservation";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
       // echo "num rows: " . $result->num_rows;
        while($row = $result->fetch_assoc()) {
            if($row["Start_date"] == date("Y-m-d") && $row["Pickup_location"] == $_SESSION["Branch_no"]){

                $totalPickUp++;
            
        }
            } 
            echo $totalPickUp;
        }

        else{
            echo "0";
            }
    $con->close();

?> 
    </span>
    </th>

    <th width = 15%>Number of Drop-Offs Today:
    <span> 
    <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $count = 0;
    $totalDropOff = 0;
    $sql = "SELECT *
    FROM Reservation";
    $result = $con->query($sql);
   // echo "today: " . date("Y-m-d");
    //echo "num rows" . $result->num_rows;
    if ($result->num_rows > 0) {
       // echo "num rows in if: " . $result->num_rows;
        while($row = $result->fetch_assoc()) {
            if($row["End_date"] == date("Y-m-d") && $row["Dropoff_location"] == $_SESSION["Branch_no"]){
                $totalDropOff++;
            } 
            }
            echo $totalDropOff;
        } else{
            echo "0";
            }
    $con->close();

?> 
    </span>
    </th>
    <th class = "addbuttonbox" width = 20%>
    <button class= "addbutton" text-align=right type="button" onclick="window.location.href='add_res.php'"> Make Reservation</button> 
    </th>
  </tr>
  </table>

  <br>
  <br>

  <div style="overflow-x:auto;">
  <table class="res_table">
    <tr>
        <th width: 10%>Reservation ID</th>
        <th width: 6%>Start Date</th>
        <th width: 6%>End Date</th>
        <th width: 5%>Pick-up Location</th>
        <th width: 5%>Drop-off Location</th>
        <th width: 4%>Payment ID</th>
        <th width: 4%>Customer ID</th>
        <th width: 55%>VIN</th>
        <th width: 5%>Branch Created</th>
        <th width: 5%>Price</th>
        <th width: 5%>Payment Method</th>

</tr>

    <!--    </table>
        </div>
        <table>-->

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    

    //foreach($branches as $key => $value) {
      //  echo $key . " " . $value;
    //}

    //echo $branches;

    $sql = "SELECT * FROM Reservation, Branch, Payment
    WHERE Reservation.Branch_no = Branch.Branch_no
    AND Reservation.PaymentID = Payment.PaymentID
    AND Reservation.C_UserID = Payment.C_UserID;";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {
            echo "
            <tr> 
            <td>" . $row["ReservationID"] . "</td> <td>" . $row["Start_date"] . "</td> <td>" . $row["End_date"] .
            "</td> <td>" ;
            foreach($_SESSION["Branches"] as $num => $name) {
                if($row["Pickup_location"] == $num) {
                    echo $name;
                }
                //echo $num . " " . $name;
            }
            //$row["Pickup_location"] .
            echo  "</td> <td>";
            foreach($_SESSION["Branches"] as $num => $name) {
                if($row["Dropoff_location"] == $num) {
                    echo $name;
                }
                //echo $num . " " . $name;
            }//$row["Dropoff_location"] . 
            echo "</td> <td>" . 
            $row["PaymentID"] . "</td> <td>" . $row["C_UserID"] ."</td> <td>" . $row["VIN"] ."</td> <td>" . 
            $row["Branch_name"] . "</td> <td>$" . number_format($row["Price"], 2) . "</td> <td>" . $row["Payment_method"] ."</td> </tr>";
           /* echo "<table class='ins_table2'>
            <tr> 
            <td>" . $row["ReservationID"] . "</td> <td>" . $row["Start_date"] . "</td> <td>" . $row["End_date"] .
            "</td> <td>" . $row["Pickup_location"] . "</td> <td>" . $row["Dropoff_location"] . "</td> <td>" . 
            $row["PaymentID"] . "</td> <td>" . $row["C_UserID"] ."</td> <td>" . $row["VIN"] ."</td> <td>" . 
            $row["Branch_name"] . "</td> </tr> </table>";*/
            
              //  echo "ReservationID: " . $row["ReservationID"]. " - Start Date: " . $row["Start_date"]. " End Date: " . $row["End_date"]. " PaymentID" . $row["PaymentID"] . " CustomerID" . $row["C_UserID"] . " Branch No:" . $row["Branch_no"] . " VIN: " . $row["VIN"] . " Pickup Location: " . $row["Pickup_location"] . " Dropoff Location: " . $row["Dropoff_location"] . "<br>";
            
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
</div>
<!--<div style="overflow-x:auto;">
</article>
<footer>-->
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
</footer>
    </body>
    </html>