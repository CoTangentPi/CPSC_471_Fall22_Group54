
<?php
    session_start();
    
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
       // echo "Connection successful\n";
    }

    //if($_SESSION["Taken"] != NULL){

    //echo "Taken: " . $_SESSION["Taken"] . "<br>";
    //}
    if($_SESSION["Same_Username"] != NULL){
    echo "Same Username: " . $_SESSION["Same_Username"] . "<br>";
    }

        $con->close();

  //  $_SESSION["C_UserID"] = 8;
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
        top: 50%;
        transform: translateY(50%);
    }
    #Province, #Status, #Branch_no, #InsuranceID{
        width: 80%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    input[type=radio]{
        width: 20%;
    }



    input[type=text], input[type=password], 
    input[type=email], input[type=date]{
        width: 80%;
        padding: 1vw 4vw;
        margin: 1vw 0;
        display: inline-block;
        border: 1px solid rgba(139,216,189,1);
        box-sizing: border-box;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-size:1.5vw;
    }

    input[type=date]{
        padding: 1vw 3vw;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        font-size:1.5vw;
        
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 2vw;
        width: 25%;
    }
    td {
        text-align: center;
        padding: 1.5vw;
        width: 25%;
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
        font-size: 2vw;
        cursor: pointer;
    }

    button:hover {
        background-color: rgba(139,216,189,1);
        color: rgba(35,70,101,1);
    }
  
    .bottom_table{
        position: relative;
        bottom:1vw;
        width: 98.5%;
        overflow: hidden;
    }

    .bottom_table td {
        text-align: center;
        padding 1.5vw;
    }

    .same_plate{
        color: tomato;
    }
    
    
   </style>
<title>Canada Wide Car Rental Service - Owner: Edit Vehicle</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Vehicle
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM Vehicle, Features
            WHERE  Vehicle.VIN = Features.VIN";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
    
        
        while($row = $result->fetch_assoc()) {

            if(strcmp($row["VIN"],$_SESSION["VIN"]) == 0){

                echo "<table class='search_table2'>
                        <tr> <td> <b>VIN: </b> </td><td>" . $row["VIN"]. "</td> <td> <b> Year: </b></td><td>" . 
                        $row["Year"] . "</td> <td> <b> Make: </b></td><td>" . $row["Make"] . 
                        "</td> <td> <b> Model: </b></td><td>" . $row["Model"] . "</td>  </tr> </table> <br> <br>";
            
            }
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_veh'>";
        echo "<tr>";
        echo "<td>";
        echo "No Records Found for VIN: " . $_SESSION["VIN"];
        echo "</td>";
        echo "</tr>";
        echo "</table>";
      }
    $con->close();

?>  
        <table> 
    <form action='own_edit_veh_post.php' method='post'>
        <table>
        <?php

            ?>
            <tr>
                
                <td><b>Mileage:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                    echo $row["Mileage"];
            }
            $con->close();

        ?></td>
                <td><b>New Mileage:</b></td>
                <td><input type = "text" name = "Mileage" required></td>
            </tr>
            <tr>
                <td><b>Status:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                
                    echo $row["Status"];
                
            }
            $con->close();

        ?></td>
                <td><b>New Status:</b></td>
                <td><select name = "Status" id = "Status" required>
                <option value = "Ready">Ready</option>
                <option value = "Not Ready">Not Ready</option>
    </select></td>
            </tr>
            <?php
                //if start date is after end date, display error message
                if($_SESSION["SamePlate"]){
                    echo "<tr> <td> </td> <td></td><td></td><td class = 'same_plate'> 
                    Oops! Cannot have the same licence plate for two vehicles.
                    </td></tr>";
                    $_SESSION["SamePlate"] = false;
                }

            ?>
            <tr>
                <td><b>Licence Plate Number:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                    echo $row["Licence_plate_no"];
                }
            $con->close();

        ?></td>
                <td><b>New Licence Plate Number:</b></td>
                <td><input type = "text" name = "Licence_plate" required></td>
            </tr>
            <tr>
                <td><b>Registration Province:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                    echo $row["Registration_province"];
                }
            $con->close();

        ?></td>
                <td><b>New Registration Province:</b></td>
                <td> <select name = "Province" id = "Province" required>
        <option value = "AB" > Alberta </option>
        <option value = "BC" > British Columbia </option>
        <option value = "MB" > Manitoba </option>
        <option value = "NB" > New Brunswick </option>
        <option value = "NL" > Newfoundland and Labrador </option>
        <option value = "NT" > Northwest Territories </option>
        <option value = "NS" > Nova Scotia </option>
        <option value = "NU" > Nunavut </option>
        <option value = "ON" > Ontario </option>
        <option value = "PE" > Prince Edward Island </option>
        <option value = "QC" > Quebec </option>
        <option value = "SK" > Saskatchewan </option>
        <option value = "YT" > Yukon </option>
    </select>
</td>
            </tr>
            <tr>
                <td><b>Insurance ID:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle WHERE VIN = '" . $_SESSION["VIN"] . "'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                    echo $row["InsuranceID"];
                
            }
            $con->close();

        ?></td>
                <td><b>New Insurance ID:</b></td>
                <td><select name = "InsuranceID" id = "InsuranceID" required>
                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                  
                      $sql = "SELECT * FROM Insurance";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row        
                          while($row = $result->fetch_assoc()) {

                              
                                  echo "<option value = '" . $row["InsuranceID"] . "' >" .$row["InsuranceID"].
                                  " </option>";
                              }
                          }

                      $con->close();

                    ?>
    </select></td>
            </tr>
            <tr>
                <td><b>Branch Number:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Vehicle, Branch WHERE VIN = '" . $_SESSION["VIN"] . "'
            AND Vehicle.Branch_no = Branch.Branch_no";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                    echo $row["Branch_name"];
            }
            $con->close();

        ?></td>
                <td><b>New Branch Number:<b></td>
                <td> <select name = "Branch_no" id = "Branch_no" required>
                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                  
                      $sql = "SELECT * FROM Branch";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          
                      
                          
                          while($row = $result->fetch_assoc()) {

                                    if($row["Branch_no"] != 0){
                              
                                  echo "<option value = '" . $row["Branch_no"] . "' >" .$row["Branch_name"].
                                  " </option>";
                                    }
                              }
                          }

                      $con->close();

                    ?>
    </select>
</td>
            </tr>
           
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='own_veh_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>
            </table>
    </form>
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->


    </body>
    </html>