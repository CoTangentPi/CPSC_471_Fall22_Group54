
<?php
    session_start();
    
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
       // echo "Connection successful\n";
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
        top: 50%;
        transform: translateY(50%);
    }
     #SchMain, #Type{
        width: 80%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    input[type=text], input[type=date]{
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
    table {
        border-collapse: collapse;
        width: 100%;
        font-size:1.5vw;
        
    }

    input[type=date]{
        padding: 1vw 2vw;
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
        position: absolute;
        bottom:1vw;
        width: 98.5%;
        overflow: hidden;
    }

    .bottom_table td {
        text-align: center;
        padding 1.5vw;
    }

    .start_after_end{
        color: tomato;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Edit Service Record</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Service Record
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
<div>

    
  <table class="edit_table">
    <tr>
        <th>Invoice Number: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM service_record;";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["Invoice_no"] == $_SESSION["InvoiceNo"]) {
                    echo $row["Invoice_no"];
                }
            }
            $con->close();

        ?>
        </span></th>
        <th></th>
        </tr>

        </table>
        <table> 
    <form action='edit_veh_serv_rec_post.php' method='post'>
        <table>
        <tr><td><b>Cost:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Service_record";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["Invoice_no"] == $_SESSION["InvoiceNo"] && $row["VIN"] == $_SESSION["VIN"]) {
                    echo "$" . number_format($row["Cost"], 2);
                }
            }
            $con->close();

        ?></td>
            <td><b>New Cost:</b> </td>
         <!--https://stackoverflow.com/questions/20050245/regular-expression-for-numbers-and-one-decimal -->
         <td><input type = "text" name = "Cost"  id = "Cost" required pattern = "(?:0|[1-9]\d+|)?(?:.?\d{0,2})?$"></td></tr>
            
        <?php
                //if start date is after end date, display error message
                if($_SESSION["Start_after_end"]){
                    echo "<tr> <td> </td> <td></td><td></td><td class = 'start_after_end'> 
                    Oops! Start date cannot be after end date.
                    </td></tr>";
                    $_SESSION["Start_after_end"] = false;
                }

            ?>
            <tr><td><b>Start Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Service_record";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["Invoice_no"] == $_SESSION["InvoiceNo"] && $row["VIN"] == $_SESSION["VIN"]) {
                    echo $row["Start_date"];
                }
            }
            $con->close();

        ?></td>
                <!-- https://stackoverflow.com/questions/32378590/set-date-input-fields-max-date-to-today -->
            <td><b>New Start Date:</b></td>
                <td><input type = "date" name = "Start_date" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr><td><b>End Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Service_record";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["Invoice_no"] == $_SESSION["InvoiceNo"] && $row["VIN"] == $_SESSION["VIN"]) {
                    echo $row["End_date"];
                }
            }
            $con->close();

        ?></td>
            <td><b>New End Date:</b></td>
                <td><input type = "date" name = "End_date" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr><td><b>Type of Service:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Service_record";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["Invoice_no"] == $_SESSION["InvoiceNo"] && $row["VIN"] == $_SESSION["VIN"]) {
                    echo $row["Type_of_service"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Type of Service:</b></td>
                <td> <select name = "Type" id = "Type" required>
                <option value = "Oil Change" > Oil Change </option>
                <option value = "Repair" > Repair </option>
                <option value = "Tune-Up" > Tune-Up </option>
                    
    </select>
</td>
            </tr>
            <tr><td><b>Scheduled Maintenance:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Service_record";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["Invoice_no"] == $_SESSION["InvoiceNo"] && $row["VIN"] == $_SESSION["VIN"]) {
                    echo $row["Scheduled_maintenance"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Scheduled Maintenance:</b></td>
                <td> <select name = "SchMain" id = "SchMain" required>
                <option value = "Yes" > Yes </option>
                <option value = "No" > No </option>
                    
    </select>
</td>
            </tr>
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='veh_serv_recs_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>