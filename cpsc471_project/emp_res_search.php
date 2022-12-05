
<?php
session_start();
$_SESSION["Start_after_end"] = false;    
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
        right:-47vw;
      }
      .cashbutton{
        position: absolute;
        bottom: 30vw;
        right:-35vw;
      }
      .creditbutton{
        position: absolute;
        bottom: 20vw;
        right:-35vw;
      }
      .debitbutton{
        position: absolute;
        bottom: 10vw;
        right:-35vw;
      }
    
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Search Reservations</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Search Reservations
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

</br>
</br>
</br>
<article>
<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    //$sql = "SELECT * FROM Reservation, Branch
    //WHERE Reservation.Branch_no = Branch.Branch_no";
    //$result = $con->query($sql);
    //if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        //while($row = $result->fetch_assoc()) {

          if(count($_SESSION["SearchResult"]) > 0){
        
            for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
      

                echo "<table class='search_table2'><form action='emp_res_search_post.php' method='post'>
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
                        echo "</td> </tr> <tr> <td> <b> Payment ID: </b>" . $_SESSION["SearchResult"][$i]['PaymentID'] .
                        "</td> </tr> <tr> <td> <b> Customer ID: </b>" . $_SESSION["SearchResult"][$i]['C_UserID'] .
                        "</td> </tr> <tr> <td> <b> VIN: </b>" . $_SESSION["SearchResult"][$i]['VIN'] . 
                        "</td> </tr> <tr> <td> <b> Price: $ </b>" . number_format($_SESSION["SearchResult"][$i]['Price'], 2) . 
                        "</td> </tr> <tr> <td> <b> Payment Method: </b>" . $_SESSION["SearchResult"][$i]['Payment_method'] . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Branch Created: </b>";
                        foreach($_SESSION["Branches"] as $num => $name) {
                          if($_SESSION["SearchResult"][$i]["Branch_no"] == $num) {
                              echo $name;
                          }
                        }
                        echo "<input type = 'hidden' name = 'PaymentID'  id = 'PaymentID' value = " . $_SESSION["SearchResult"][$i]["PaymentID"] .">
                        <input type = 'hidden' name = 'CustID'  id = 'CustID' value = " . $_SESSION["SearchResult"][$i]["C_UserID"] .">
                        <input type = 'hidden' name = 'ResID'  id = 'ResID' value = " . $_SESSION["SearchResult"][$i]["ReservationID"] .">
                        <input type = 'hidden' name = 'Price'  id = 'Price' value = " . $_SESSION["SearchResult"][$i]["Price"] .">";
                        if(strcasecmp($_SESSION["SearchResult"][$i]['Payment_method'], "Not Paid") == 0){
                        
                        echo "<button class= 'cashbutton' name='submitbutton' text-align=left type='submit' value='Cash'>Paid Cash</button>
                        <button class= 'creditbutton' name='submitbutton' text-align=left type='submit' value='Credit'>Paid Credit</button>
                        <button class= 'debitbutton' name='submitbutton' text-align=left type='submit' value='Debit'>Paid Debit</button>";
                        }
                        echo "<button class= 'editbutton' name='submitbutton' text-align=left type='submit' value='Edit'>Edit</button>
                        <button class= 'removebutton' name='submitbutton'text-align=left type='submit' value='Remove'> Remove </button>
                        </div></form></td> </tr> </table> <br> <br>";
               
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



</article>
<footer>
</table>
  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_res.php'"> Back</button>  
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