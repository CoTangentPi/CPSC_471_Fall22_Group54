
<?php
session_start();
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

    .no_ins {
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

    .isInUse{
      color: tomato;
      font-size: 1.75vw;
      text-align: center;
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

      
/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: rgba(35,70,101,1);
  color: rgba(139,216,189,1);
}

/* Add a color to the delete button */
.deletebtn {
  background-color: tomato;
  color: rgba(0,0,0,0.6499999761581421);
}

.deletebtn:hover {
    background-color: rgba(0,0,0,0.6499999761581421);
    color: tomato;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(35,70,101,0.5);
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: rgba(0,0,0,0.6499999761581421);
  margin: 25% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid black;
  margin-bottom: 25px;
}
 
/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: tomato;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

    
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Search Insurance</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Search Insurance
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

</br>
</br>
</br>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

   // $sql = "SELECT * FROM Insurance";
    //$result = $con->query($sql);
    //if ($result->num_rows > 0) {
        // output data of each row
        
        if(count($_SESSION["SearchResult"]) > 0){
        
          for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
    
        
      //  while($row = $result->fetch_assoc()) {

            if($_SESSION["InsInUse"] && $_SESSION["InsuranceID"] == $_SESSION["SearchResult"][$i]["InsuranceID"]){
              echo "<div> <span class='isInUse'>
               Insurance ID: " .$_SESSION["InsuranceID"] ." is currently in use. Please remove all vehicles using this insurance before removing.
               </div></span> <br>";
               $_SESSION["InsInUse"] = false;
               $_SESSION["RemoveIns"] = false;
            }

                echo "<table class='search_table2'><form action='emp_ins_search_post.php' method='post'>
                        <tr> <th> Insurance ID: " . $_SESSION["SearchResult"][$i]["InsuranceID"]. 
                        "</th> </tr> <tr> <td> <b> Type: </b>" . $_SESSION["SearchResult"][$i]["Ins_Type"] . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Cost: $ </b>" . number_format($_SESSION["SearchResult"][$i]["Cost"], 2) . 
                        "<div class = 'edit'>
                        <input type = 'hidden' name = 'InsuranceID'  id = 'InsuranceID' value = " . $_SESSION["SearchResult"][$i]["InsuranceID"] .">
                        <input type = 'hidden' name = 'Ins_type'  id = 'Ins_type' value = " . $_SESSION["SearchResult"][$i]["Ins_Type"] .">
                        <input type = 'hidden' name = 'Cost'  id = 'Cost' value = " . $_SESSION["SearchResult"][$i]["Cost"] .">
                        <button class= 'editbutton' name='submitbutton' text-align=left type='submit' value='Edit'>Edit</button>
                        <button class= 'removebutton' name='submitbutton'text-align=left type='submit' value='Remove'> Remove </button>
                        </div></form></td> </tr> </table> <br> <br>";

                        /*echo "<table class='search_table2'>
                        <tr> <th> Insurance ID: " . $row["InsuranceID"]. "</th> </tr> <tr> <td> <b> Type: </b>" . 
                        $row["Ins_Type"] . "</td> </tr> <tr> <td> <div class = 'edit'> <b> Cost: $ </b>" . $row["Cost"] . 
                        "<button class= 'editbutton' text-align=left type='button' onclick='window.location.href='emp_ins_edit.php''> Edit </button>  
                        <button class= 'removebutton' text-align=left type='button' onclick='window.location.href='emp_ins_remove.php''> Remove </button>
                        </div></td> </tr> </table> <br> <br>";*/
            
               
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_ins'>";
        echo "<tr>";
        echo "<td>";
        echo "No Insurance to Display";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
      }
    $con->close();

?> 
<!--
<button onclick="document.getElementById('id01').style.display='block'">Open Modal</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-content" action="emp_ins_search_post.php" method = "post">
    <div class="container">
      <h1>Delete Account</h1>
      <p>Are you sure you want to delete your account?</p>
    
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <!<button type="submit" class="deletebtn">Delete</button>
        <button class= "deletebtn" name='submitbutton'text-align=left type='submit' value='Remove'> Remove </button>
                        
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>-->

  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_ins.php'"> Back</button>  
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