<?php
session_start();
$_SESSION["Invalid"] = false;
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $sql = "SELECT UserID, First_name, Middle_name, Last_name FROM Users";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
   
        while($row = $result->fetch_assoc()) {
            if($row["UserID"] == $_SESSION["UserID"]) {
                echo "UserID: " . $row["UserID"]. " - Name: " . $row["First_name"]. " " . $row["Middle_name"]. " " . $row["Last_name"]. "<br>";
            }
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
        width: 98%;
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

    .logout_table{
        position: absolute;
        bottom: 1vw;
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
    .logoutbutton {
        
        font-size: 2vw;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Owner</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">


<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT UserID, First_name, Middle_name, Last_name FROM Users";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row["UserID"] == $_SESSION["UserID"]) {
            echo "Hello " . $row["First_name"]. " " . $row["Middle_name"]. " " . $row["Last_name"]. "!" ."<br>";
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


</table>
  <table class="logout_table">
  <tr>
    <td>
</td>
<td>
</td>
<td>
    <button class= "logoutbutton" type="button" onclick="window.location.href='login.php'""> Log Out</button>  
</td>
</tr>
</table>
    </body>
    </html>