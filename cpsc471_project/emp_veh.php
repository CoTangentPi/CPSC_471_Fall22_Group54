
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

    .features{
      border: 1px solid rgba(139,216,189,1);
    }

    .veh_table {
        border: 1px solid rgba(139,216,189,1);
    }

    .car_table {
        width = 70%;
        
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .car_table td {
        font-size:1.5vw;
        text-align: center;
        padding: 1vw;
    }

    .no_veh {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }
    .no_pic {
        width:18vw;
        height:15vw;
        color = rgba(139,216,189,1);
        background-color: rgba(35,70,101,1);
    }

    .car img {
        float: center;
        height: 11.5vw;
    }

    .car{
        background-color: darkgrey;
        border: 1px solid black;
        text-align: center;
        width: 24vw;

    }
    .no_pic {
        width:18vw;
        height:12.2vw;
        color: tomato;
        background-color: darkgrey;
        border: 1px solid black;
        width: 24vw;
        text-align: center;
        vertical-align: middle;
        font-size: 3.5vw;
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

      .carbutton{
        padding: 0%;
      }

      .column {
        float: right;
        width: 80%;
        padding: 0 10px;
        text-align: center;
      }
      .column2{
        float: left;
        width: 20%;
        padding: 0 10px;
        text-align: center;
      }

      .features td {
        text-align: left;
      }

      * {
          box-sizing: border-box;
        }

    
   </style>
<title>Canada Wide Car Rental Service - Employee: View Vehicles</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">

Vehicles

</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>

    <form action="veh_search_emp_post.php" class = "searchbar" method="post">
      <input type="search" placeholder="Search.." name="search">
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" class= "submitbutton" type="submit" name="submit" value="Submit">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>

  <br>
  <br>
  <div class="row">
  <div class="column2" style="overflow:auto;height:40vw;">
  <form action="features_table_post.php" method="post">
    <table class = "features">
      <!-- dealing with the checkboxes adapted from 
      https://stackoverflow.com/questions/18421988/getting-checkbox-values-on-submit-->
    <tr>
      <th>Features</th>
    </tr>
    <tr><td><b>Year</b></td></tr>
    <tr><td>                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $year = [];
                      
                      $sql = "SELECT DISTINCT Year FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                                  echo "<input type = 'checkbox' ' name = 'Year[]' value = '".$row["Year"]. "'>
                                  <label for = 'Year[]' >" .$row["Year"].
                                  " </label><br>";
                              }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Make</b></td></tr>
    <tr><td>                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Make FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Make[]' value = '".$row["Make"]. "'>
                            <label for = 'Make[]' >" .$row["Make"].
                            " </label><br>";
                        }
                    }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Model</b></td></tr>
    <tr><td>               
           <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Model FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Model[]' value = '".$row["Model"]. "'>
                            <label for = 'Model[]' >" .$row["Model"].
                            " </label><br>";
                        }
                      }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Colour</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Body_colour FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Body_colour[]' value = '".$row["Body_colour"]. "'>
                            <label for = 'Body_colour[]' >" .$row["Body_colour"].
                            " </label><br>";
                        }
                      }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Category</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Category FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Category[]' value = '".$row["Category"]. "'>
                            <label for = 'Category[]' >" .$row["Category"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Transmission/<br> Driven Wheels</b></td></tr>
    <tr><td>                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Trans_Driven_wheels FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Trans_Driven_wheels[]' value = '".$row["Trans_Driven_wheels"]. "'>
                            <label for = 'Trans_Driven_wheels[]' >" .$row["Trans_Driven_wheels"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Fuel Type/<br>Air Conditioning</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Fuel_Air_con FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Fuel_Air_con[]' value = '".$row["Fuel_Air_con"]. "'>
                            <label for = 'Fuel_Air_con[]' >" .$row["Fuel_Air_con"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Type</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Type FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Type[]' value = '".$row["Type"]. "'>
                            <label for = 'Type[]' >" .$row["Type"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Horse Power</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Horse_power FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Horse_power[]' value = '".$row["Horse_power"]. "'>
                            <label for = 'Horse_power[]' >" .$row["Horse_power"].
                            " hp</label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Torque</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Torque FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Torque[]' value = '".$row["Torque"]. "'>
                            <label for = 'Torque[]' >" .$row["Torque"].
                            " lb-ft</label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Tonnage</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Tonnage FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Tonnage[]' value = '".$row["Tonnage"]. "'>
                            <label for = 'Tonnage[]' >" .$row["Tonnage"].
                            " lbs</label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Seat Material</b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Seat_material FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Seat_material[]' value = '".$row["Seat_material"]. "'>
                            <label for = 'Seat_material[]' >" .$row["Seat_material"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Interior Colour<b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Interior_colour FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Interior_colour[]' value = '".$row["Interior_colour"]. "'>
                            <label for = 'Interior_colour[]' >" .$row["Interior_colour"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Fuel Economy<b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Fuel_economy FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Fuel_economy[]' value = '".$row["Fuel_economy"]. "'>
                            <label for = 'Fuel_economy[]' >" .$row["Fuel_economy"].
                            " L / 100 km</label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Child Seat <br>Compatible<b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Childseat_compatibility FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Childseat_compatibility[]' value = '".$row["Childseat_compatibility"]. "'>
                            <label for = 'Childseat_compatibility[]' >" .$row["Childseat_compatibility"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
    <tr><td><b>Number of <br>Passengers<b></td></tr>
    <tr><td>                    
      <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                      $sql = "SELECT DISTINCT Number_of_passengers FROM vehicle, features WHERE vehicle.VIN = features.VIN";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row       
                          while($row = $result->fetch_assoc()) {
                              
                            echo "<input type = 'checkbox' ' name = 'Number_of_passengers[]' value = '".$row["Number_of_passengers"]. "'>
                            <label for = 'Number_of_passengers[]' >" .$row["Number_of_passengers"].
                            " </label><br>";
                        }
                          }
                      $con->close();

                    ?>
</td></tr>
         
    </table>
                        
    <br>
    <button class= "submitbutton" type="submit" name="submit" value="Submit">Search</button>
    
                        </form>
  </div>
  <div class="column">
  <table class='car_table'>
  <!--<form action='emp_veh_post.php' method='post'>-->

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }
    if(!$_SESSION["Search"]){
    $sql = "SELECT * FROM Vehicle";
    $result = $con->query($sql);
    $count = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        
    //echo "Number of rows: " . $result->num_rows;
        
        while($row = $result->fetch_assoc()) {
         // echo "<form action='emp_veh_post.php' method='post'>";

            if($count % 3 == 0) {
                echo "<tr>";
            }

                echo "<td >";

                if(strcmp($row["VIN"],"1HGBH41JXMN109186") == 0){
                  echo "<form action='emp_veh_post.php' method='post'>
                        <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                        <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                        <div class = 'car'><img src='vw jetta.png' alt='vw jetta'/></div></button></form>";
                 // echo "<div class = 'car'><img src='vw jetta.png' alt='vw jetta'/></div>";
               } else if (strcmp($row["VIN"],"3ABCD12EFGH345678") == 0){
                  echo "<form action='emp_veh_post.php' method='post'>
                        <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                        <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                        <div class = 'car'><img src='chevy spark.png' alt='chevy spark'/></div></button></form>";
                  // echo "<div class = 'car'><img src='chevy spark.png' alt='chevy spark'/></div>";
               } else if (strcmp($row["VIN"],"2ZYXW98ZYXW987654") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                        <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                        <div class = 'car'><img src='fiat 500.png' alt='fiat 500'/></div></button></form>";
                 //  echo "<div class = 'car'><img src='fiat 500.png' alt='fiat 500'/></div>";
               }else if (strcmp($row["VIN"],"4MNBV65LKJH765432") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'car'><img src='nissan versa.png' alt='nissan versa'/></div></button></form>";
                  // echo "<div class = 'car'><img src='nissan versa.png' alt='nissan versa'/></div>";
               }else if (strcmp($row["VIN"],"5POIU98MNBV987652") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'car'><img src='kia forte.png' alt='kia forte'/></div></button></form>";
                  // echo "<div class = 'car'><img src='kia forte.png' alt='kia forte'/></div>";
               }else if (strcmp($row["VIN"],"6ASDF56ASDF567890") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'car'><img src='toyota camry.png' alt='toyota camry'/></div></button></form>";
                  // echo "<div class = 'car'><img src='toyota camry.png' alt='toyota camry'/></div>";
               }else if (strcmp($row["VIN"],"7BVCX76NBVC876543") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'car'><img src='nissan maxima.png' alt='nissan maxima'/></div></button></form>";
                  // echo "<div class = 'car'><img src='nissan maxima.png' alt='nissan maxima'/></div>";
               }else if (strcmp($row["VIN"],"8NMGH78GHJK456789") == 0){
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'car'><img src='chrysler 300.png' alt='chrysler 300'/></div></button></form>";
                  // echo "<div class = 'car'><img src='chrysler 300.png' alt='chrysler 300'/></div>";
               }else{
                echo "<form action='emp_veh_post.php' method='post'>
                      <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $row["VIN"] .">
                      <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                      <div class = 'no_pic'>IMAGE <br> COMING <br> SOON!</div></button></form>";
                 //  echo "<div class = 'no_pic'>";
                   //"IMAGE COMING SOON!</div>";
               }
                echo"</td>";
            
              if($count % 3 == 2){
              echo "</tr>";
            }
                $count += 1;
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_veh'>";
        echo "<tr>";
        echo "<td>";
        echo "No Vehicles to Display";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
      }} else {
        $count = 0;
        if(count($_SESSION["SearchResult"]) > 0){
        
          for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) { if($count % 3 == 0) {
            echo "<tr>";
        }

            echo "<td >";

            if(strcmp($_SESSION["SearchResult"][$i]["VIN"],"1HGBH41JXMN109186") == 0){
              echo "<form action='emp_veh_post.php' method='post'>
                    <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                    <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                    <div class = 'car'><img src='vw jetta.png' alt='vw jetta'/></div></button></form>";
             // echo "<div class = 'car'><img src='vw jetta.png' alt='vw jetta'/></div>";
           } else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"3ABCD12EFGH345678") == 0){
              echo "<form action='emp_veh_post.php' method='post'>
                    <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                    <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                    <div class = 'car'><img src='chevy spark.png' alt='chevy spark'/></div></button></form>";
              // echo "<div class = 'car'><img src='chevy spark.png' alt='chevy spark'/></div>";
           } else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"2ZYXW98ZYXW987654") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                    <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                    <div class = 'car'><img src='fiat 500.png' alt='fiat 500'/></div></button></form>";
             //  echo "<div class = 'car'><img src='fiat 500.png' alt='fiat 500'/></div>";
           }else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"4MNBV65LKJH765432") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'car'><img src='nissan versa.png' alt='nissan versa'/></div></button></form>";
              // echo "<div class = 'car'><img src='nissan versa.png' alt='nissan versa'/></div>";
           }else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"5POIU98MNBV987652") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'car'><img src='kia forte.png' alt='kia forte'/></div></button></form>";
              // echo "<div class = 'car'><img src='kia forte.png' alt='kia forte'/></div>";
           }else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"6ASDF56ASDF567890") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'car'><img src='toyota camry.png' alt='toyota camry'/></div></button></form>";
              // echo "<div class = 'car'><img src='toyota camry.png' alt='toyota camry'/></div>";
           }else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"7BVCX76NBVC876543") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'car'><img src='nissan maxima.png' alt='nissan maxima'/></div></button></form>";
              // echo "<div class = 'car'><img src='nissan maxima.png' alt='nissan maxima'/></div>";
           }else if (strcmp($_SESSION["SearchResult"][$i]["VIN"],"8NMGH78GHJK456789") == 0){
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'car'><img src='chrysler 300.png' alt='chrysler 300'/></div></button></form>";
              // echo "<div class = 'car'><img src='chrysler 300.png' alt='chrysler 300'/></div>";
           }else{
            echo "<form action='emp_veh_post.php' method='post'>
                  <input type = 'hidden' name = 'VIN'  id = 'VIN' value = " . $_SESSION["SearchResult"][$i]["VIN"] .">
                  <button class= 'carbutton' name='submitbutton' type='submit' value='Chosen'>
                  <div class = 'no_pic'>IMAGE <br> COMING <br> SOON!</div></button></form>";
             //  echo "<div class = 'no_pic'>";
               //"IMAGE COMING SOON!</div>";
           }
            echo"</td>";
        
          if($count % 3 == 2){
          echo "</tr>";
        }
            $count += 1;
    }
  } else {
    echo "<br>";
    echo "<br>";
    echo "<table class='no_veh'>";
    echo "<tr>";
    echo "<td>";
    echo "No Vehicles to Display";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
  }}
        

      $_SESSION["Search"] = false;
    $con->close();

?> 
</form>
</table>
</div>
    </div>
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