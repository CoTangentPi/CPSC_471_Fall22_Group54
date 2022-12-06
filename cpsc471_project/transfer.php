
<?php
    session_start();
 //   echo "current branch: " . $_SESSION["Current_branch"] . "<br>";
    
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
 //       echo "Connection successful\n";
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
    #Start_branch, #End_branch, #Status{
        width: 50%;
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
        width: 50%;
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

    .start_after_end{
        color: tomato;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Transfer Vehicle</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Transfer Vehicle
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
    <form action='transfer_post.php' method='post'>
        <table>
          
           <!-- <tr>
                <td>Start Branch:</td>
                <td> <select name = "Start_branch" id = "Start_branch" required>
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
                              
                                  echo "<option value = '" . $row["Branch_no"] . "' >" .$row["Branch_name"].
                                  " </option>";
                              }
                          }

                      $con->close();

                    ?>
    </select>
</td>
            </tr> -->
            
            <?php
                $con = mysqli_connect("localhost","root","","cwcrs_db");
                if(!$con) {
                    exit("An error connecting occurred." .mysqli_connect_errno());
                } else { }
            
                $sql = "SELECT * FROM Branch";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    
                //echo "number of rows: " . $result->num_rows;
                    
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION["Current_branch"] == $row["Branch_no"]){
                          //  echo "<tr> <td> <b>Current Branch: </b> </td><td>" . $row["Branch_name"]. "</td> </tr>";
                        

                //if end branch is same as start branch, display error message
                if($_SESSION["Start_branch_same_as_end_branch"]){
                    echo "<tr> <td> </td> <td class = 'start_after_end'> 
                    Oops! End Branch cannot be the same as the <br>
                    current branch " . $row["Branch_name"] .
                    ".</td></tr>";
                    $_SESSION["Start_branch_same_as_end_branch"] = false;
                }
            }
        }
        }

    $con->close();

            ?>
            <tr>
                <td>End Branch:</td>
                <td> <select name = "End_branch" id = "End_branch" required>
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
                
            <?php
            
                //if mileage is less than current mileage, display error message
                if($_SESSION["Mileage_less_than_current"]){
                    echo "<tr> <td> </td> <td class = 'start_after_end'> 
                    Oops! Mileage must be greater than the current <br> mileage of  " .
                    $_SESSION["Current_mileage"] . " kms. 
                    </td></tr>";
                    $_SESSION["Mileage_less_than_current"] = false;
                }

            ?>
            <tr>
                <td>New Mileage:</td>
                <td><input type = "text" name = "Mileage"  id = "Mileage" required></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><select name = "Status" id = "Status" required>
                <option value = "Ready">Ready</option>
                <option value = "Not Ready">Not Ready</option>
    </select></td>
            </tr>
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
                <td><input type = "date" name = "Start_date" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr>
            <td>End Date:</td>
                <td><input type = "date" name = "End_date" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_veh_search.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Transfer</button></td>
            </tr>
            </table>
    </form>
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->


    </body>
    </html>