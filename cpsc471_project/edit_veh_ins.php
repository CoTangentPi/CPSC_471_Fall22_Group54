
<?php
    session_start();
  //  $_SESSION["VehIns"] = 0;
    
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
    #InsuranceID{
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



    input[type=text]{
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
    }
    td {
        text-align: center;
        padding: 1.5vw;
    }
    
    .edit_table th {
        width: 25%;
    }
    .edit_table td {
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

    .taken{
        color: tomato;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Edit Vehicle Insurance</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Vehicle Insurance
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

        <table> 
    <form action='edit_veh_ins_post.php' method='post'>
        <table class="edit_table">
            <tr>
                
                <td><b>Insurance ID:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM vehicle";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                 if(strcmp($row["VIN"],$_SESSION["VIN"]) == 0) {
                    echo $row["InsuranceID"];
                  //  $_SESSION["VehIns"] = $row["InsuranceID"];
                }
            }
            $con->close();

        ?></td>
                <td><b> New Insurance ID:</b></td>
                <td> <select name = "InsuranceID" id = "InsuranceID" required>
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
    </select>
                    </td>
            </tr>
            <tr>
           <!--     <td><b>Cost:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM insurance";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["InsuranceID"] == $_SESSION["InsuranceID"]) {
                    echo "$". number_format($row["Cost"], 2);
                }
            }
            $con->close();

        ?></td>
                <td><b>New Cost:</b></td>
                <td><input type = "text" name = "Cost"required></td>
        </tr>-->
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_veh_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>