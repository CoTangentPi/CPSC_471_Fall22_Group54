
<?php
    session_start();
    $_SESSION["Start_after_end"] = false;    
    $_SESSION["EditRes"] = false;
    $_SESSION["RemoveRes"] = false;

    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
   //     echo "Connection successful\n";
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
        width: 40%;
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

    .search_table {
        border: 1px solid rgba(139,216,189,1);
    }

    .search_table2 {
        border: 1px solid rgba(139,216,189,1);
        width: 50%;
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
    }

    .search_table2 th{
        border: 1px solid rgba(139,216,189,1);
    }
    .search_table2 td {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
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
        right:-31.5vw;
      }
      .cashbutton{
        position: absolute;
        bottom: 30vw;
        right:-35vw;
      }
      .creditbutton{
        position: absolute;
        bottom: 10vw;
        right:-35vw;
      }
      .debitbutton{
        position: absolute;
        bottom: 10vw;
        right:-35vw;
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

<span>
    <?php

$con = mysqli_connect("localhost","root","","cwcrs_db");
if(!$con) {
    exit("An error connecting occurred." .mysqli_connect_errno());
} else {
   // echo "Connection successful\n";
}

       // echo "Welcome, " . $_SESSION["EmployeeName"] . "!";
       $sql = "SELECT * FROM Customer, Users
         WHERE Customer.C_UserID = Users.UserID;";
         $result = $con->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               // echo "Welcome, " . $row["Fname"] . "!";

               if($row["C_UserID"] == $_SESSION["UserID"]){
               echo $row["First_name"];
               }
            }
            } else {
            echo "0 results";
            }
    ?>
</span>'s Reservations
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

<!--<article>-->
<table class = "toptable">
<form action="cust_view_res_post.php" method="post">
  <tr>
    <th width = 25%>
    <div class = "searchbar">
      <input type="search" placeholder="Search.." name="search" required>
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" type="submit" name="submitbutton" value="Search">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>
</th>


<th class = "addbuttonbox" width = 20%><!--
<form action='cust_check_curr_post.php' method='post'>
    <button class= "submitbutton" type="submit" name="submit" value="Submit">View Current Reservation</button>
    </form>-->
    <button class= "addbutton" text-align=right type="button" onclick="window.location.href='cust_current_res.php'"> View Current Reservation</button> 
    </th>
  
          </tr>
  </table>

  <article>
<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $check = 0;
    if(!$_SESSION["SearchRes"]){

    $sql = "SELECT * FROM Reservation, Branch, Features, Payment
    WHERE Reservation.Branch_no = Branch.Branch_no
    AND Reservation.VIN = Features.VIN
    AND Reservation.PaymentID = Payment.PaymentID
    AND Reservation.C_UserID = Payment.C_UserID;";
    $result = $con->query($sql);
    $count = mysqli_num_rows($result);
   
   // echo "count: " . $count;
    if ($result->num_rows > 0) {
        // output data of each row
        
   // echo "num rows: " . $result->num_rows;
        
        while($row = $result->fetch_assoc()) {
     //     echo "while loop";
       //   echo "C_UserID: " . $row["C_UserID"];
       //   if(count($_SESSION["SearchResult"]) > 0){
        
         //   for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
            if($row["C_UserID"] == $_SESSION["UserID"]){
         //     echo "table works";
                $check ++;
              //  echo $check;
                echo "<table class='search_table2'><form action='cust_edit_res_post.php' method='post'>
                        <tr> <th> Reservation ID: " . $row["ReservationID"]. 
                        "</th> </tr> <tr> <td> <b> Start Date: </b>" . 
                        $row["Start_date"] . "</td> </tr> <tr> <td> <b> End Date: </b>" . 
                        $row["End_date"] . 
                        "</td> </tr> <tr> <td> <b> Pick-Up Location: </b>";
                        foreach($_SESSION["Branches"] as $num => $name) {
                          if($row["Pickup_location"] == $num) {
                              echo $name;
                          } 
                        }
                        echo "</td> </tr> <tr> <td> <b> Drop-Off Location: </b>";
                        foreach($_SESSION["Branches"] as $num => $name) {
                          if($row["Dropoff_location"] == $num) {
                              echo $name;
                          }
                        }
                        echo "</td> </tr> <tr> <td> <b> Year: </b>" . $row['Year'] .
                        "</td> </tr> <tr> <td> <b> Make: </b>" . $row['Make'] .
                        "</td> </tr> <tr> <td> <b> Model: </b>" . $row['Model'] . 
                        "</td> </tr> <tr> <td> <b> Colour: </b>" . $row['Body_colour'] . 
                        "</td> </tr> <tr> <td> <b> Price:  </b>$" . number_format($row['Price'], 2) . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Payment: </b>";
                        if(strcasecmp($row['Payment_method'], "cash") == 0) {
                          echo "Paid";
                        } else if(strcasecmp($row['Payment_method'], "credit") == 0) {
                          echo "Paid";
                        } else if(strcasecmp($row['Payment_method'], "debit") == 0) {
                          echo "Paid";
                        } else {
                           echo $row['Payment_method'];
                        }
                        
                        echo "<input type = 'hidden' name = 'PaymentID'  id = 'PaymentID' value = " . $row["PaymentID"] .">
                        <input type = 'hidden' name = 'ResID'  id = 'ResID' value = " . $row["ReservationID"] .">
                        <input type = 'hidden' name = 'Price'  id = 'Price' value = " . $row["Price"] .">
                        <input type = 'hidden' name = 'PayMethod'  id = 'PayMethod' value = " . $row["Payment_method"] .">";
                        if(strcasecmp($row['Payment_method'], "Not Paid") == 0){
                            echo "<button class= 'creditbutton' name='submitbutton' text-align=left type='submit' value='Pay'>Make Payment</button>";
                        }
                        if($row["Start_date"] > date("Y-m-d")){
                            echo "<button class= 'removebutton' name='submitbutton'text-align=left type='submit' value='Remove'> Cancel</button>";
                            }
                            echo "</div></form></td> </tr> </table> <br> <br>";
                    }
        }
       // echo $check; 
        if($check == 0) {
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
      }} else {
/******* */

if(count($_SESSION["SearchResult"]) > 0){
        
  for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {

    if($_SESSION["SearchResult"][$i]["C_UserID"] == $_SESSION["UserID"]){
      echo "<table class='search_table2'><form action='cust_view_res_post.php' method='post'>
              <tr> <th> Reservation ID: " . $_SESSION["SearchResult"][$i]["ReservationID"]. 
              "</th> </tr> <tr> <td> <b> Start Date: </b>" . 
              $_SESSION["SearchResult"][$i]["Start_date"] . "</td> </tr> <tr> <td> <b> End Date: </b>" . 
              $_SESSION["SearchResult"][$i]["End_date"] . 
              "</td> </tr> <tr> <td> <b> Pick-Up Location: </b>";
              foreach($_SESSION["Branches"] as $num => $name) {
                if($_SESSION["SearchResult"][$i]["Pickup_location"] == $num) {
                    echo $name;
                } 
              }
              echo "</td> </tr> <tr> <td> <b> Drop-Off Location: </b>";
              foreach($_SESSION["Branches"] as $num => $name) {
                if($_SESSION["SearchResult"][$i]["Dropoff_location"] == $num) {
                    echo $name;
                }
              }
              echo "</td> </tr> <tr> <td> <b> Year: </b>" . $_SESSION["SearchResult"][$i]['Year'] .
                        "</td> </tr> <tr> <td> <b> Make: </b>" . $_SESSION["SearchResult"][$i]['Make'] .
                        "</td> </tr> <tr> <td> <b> Model: </b>" . $_SESSION["SearchResult"][$i]['Model'] . 
                        "</td> </tr> <tr> <td> <b> Colour: </b>" . $_SESSION["SearchResult"][$i]['Body_colour'] . 
                        "</td> </tr> <tr> <td> <b> Price:  </b>$" . number_format($_SESSION["SearchResult"][$i]['Price'], 2) . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Payment: </b>";
                        if(strcasecmp($_SESSION["SearchResult"][$i]['Payment_method'], "cash") == 0) {
                          echo "Paid";
                        } else if(strcasecmp($_SESSION["SearchResult"][$i]['Payment_method'], "credit") == 0) {
                          echo "Paid";
                        } else if(strcasecmp($_SESSION["SearchResult"][$i]['Payment_method'], "debit") == 0) {
                          echo "Paid";
                        } else {
                           echo $_SESSION["SearchResult"][$i]['Payment_method'];
                        }
                        echo "<input type = 'hidden' name = 'PaymentID'  id = 'PaymentID' value = " . $_SESSION["SearchResult"][$i]["PaymentID"] .">
                        <input type = 'hidden' name = 'ResID'  id = 'ResID' value = " . $_SESSION["SearchResult"][$i]["ReservationID"] .">
                        <input type = 'hidden' name = 'Price'  id = 'Price' value = " . $_SESSION["SearchResult"][$i]["Price"] .">
                        <input type = 'hidden' name = 'PayMethod'  id = 'PayMethod' value = " . $_SESSION["SearchResult"][$i]["Payment_method"] .">";
                        /*if(strcasecmp($_SESSION["SearchResult"][$i]['Payment_method'], "Not Paid") == 0){
                            echo "<button class= 'creditbutton' name='submitbutton' text-align=left type='submit' value='Pay'>Make Payment</button>";
                        }
                        if($row["Start_date"] > date("Y-m-d")){
                            echo "<button class= 'removebutton' name='submitbutton'text-align=left type='submit' value='Remove'> Cancel</button>";
                            }*/
                            echo "</div></form></td> </tr> </table> <br> <br>";
     
}}

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
      $_SESSION["SearchRes"] = false;

      }

      /***** */
    $con->close();

?> 



</article>
<footer>
</table>
  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='cust.php'"> Back</button>  
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
</table> </footer>
    </body>
    </html>