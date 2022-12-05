
<?php
    session_start();
    
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
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
        width: 40%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    input[type=text], input[type=date]{
        width: 40%;
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
    .formtable td{
        text-align: center;
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

    .taken{
        color: tomato;
    }
    #Ins_type{
        width: 40%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .start_after_end{
        color: tomato;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Add Service Record</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Add Service Record
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
    <form action='add_serv_rec_veh_post.php' method='post'>
        <table class = "formtable">
        <?php
                //if start date is after end date, display error message
                if($_SESSION["InvoiceExists"]){
                    echo "<tr> <td> </td> <td class = 'start_after_end'> 
                    Oops! Invoice No: " . $_SESSION["InvoiceNo"]. " already exists. Please try again.
                    </td></tr>";
                    $_SESSION["InvoiceExists"] = false;
                }

            ?>
        <tr> <td> Invoice Number: </td> 
        <td> <input type="text" name="InvoiceNo" id="InvoiceNo" required pattern = "[0-9]+"> </td> </tr>
        <tr><td> Cost: </td>
         <!--https://stackoverflow.com/questions/20050245/regular-expression-for-numbers-and-one-decimal -->
         <td><input type = "text" name = "Cost"  id = "Cost" required pattern = "(?:0|[1-9]\d+|)?(?:.?\d{0,2})?$"></td></tr>
            
        <?php
                //if start date is after end date, display error message
                if($_SESSION["Start_after_end"]){
                    echo "<tr> <td> </td> <td class = 'start_after_end'> 
                    Oops! Start date cannot be after end date.
                    </td></tr>";
                    $_SESSION["Start_after_end"] = false;
                }

            ?>
            <tr>
                <!-- https://stackoverflow.com/questions/32378590/set-date-input-fields-max-date-to-today -->
            <td>Start Date:</td>
                <td><input type = "date" name = "Start_date" min="3000-01-01" onfocus="this.min=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr>
            <td>End Date:</td>
                <td><input type = "date" name = "End_date" min="3000-01-01" onfocus="this.min=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr>
                <td>Type of Service:</td>
                <td> <select name = "Type" id = "Type" required>
                <option value = "Oil Change" > Oil Change </option>
                <option value = "Repair" > Repair </option>
                <option value = "Tune-Up" > Tune-Up </option>
                    
    </select>
</td>
            </tr>
            <tr>
                <td>Scheduled Maintenance:</td>
                <td> <select name = "SchMain" id = "SchMain" required>
                <option value = "Yes" > Yes </option>
                <option value = "No" > No </option>
                    
    </select>
</td>
            </tr>

          <!--  <tr>
                <td>VIN:</td>
                <td> <select name = "vin" id = "vin" required>
                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                  
                      $sql = "SELECT * FROM Vehicle";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          
                      
                          
                          while($row = $result->fetch_assoc()) {
                              
                                  echo "<option value = '" . $row["VIN"] . "' >" .$row["VIN"].
                                  " </option>";
                              }
                          }

                      $con->close();

                    ?>
    </select>
</td>
            </tr> -->
            
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='service_recs_veh.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Add</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>