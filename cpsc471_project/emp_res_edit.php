
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
    #Ins_type{
        width: 80%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    #Pickup, #Dropoff{
        width: 90%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    #VIN{
        width: 90%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.27vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }


    input[type=text], input[type=date]{
        width: 90%;
        padding: 1vw 4vw;
        margin: 1vw 0;
        display: inline-block;
        border: 1px solid rgba(139,216,189,1);
        box-sizing: border-box;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-size:1.5vw;
    }

/*    input[type=date]{
        padding: 1vw 3vw;
    }*/
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
<title>Canada Wide Car Rental Service - Employee: Edit Reservation</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Reservation
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<div>

    
  <table class="edit_table">
    <tr>
        <th>Reservation ID: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo $row["ReservationID"];
                }
            }
            $con->close();

        ?>
        </span></th>
        <th></th>
        </tr>

        </table>
        <table> 
    <form action='edit_res_post.php' method='post'>
        <table>
        <?php
                //if start date is after end date, display error message
                if($_SESSION["Start_after_end"]){
                    echo "<tr> <td> </td> <td> </td><td> </td><td class = 'start_after_end'> 
                    Oops! Start date cannot be after end date.
                    </td></tr>";
                    $_SESSION["Start_after_end"] = false;
                }

            ?>
            <tr>
                
                <td><b>Start Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                 if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo $row["Start_date"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Start Date:</b></td>
                <td><input type = "date" name = "Start_date" required></td>
            </tr>

               <!-- <td> <select name = "Ins_type" id = "Ins_type" required>
                    <option value = "Full">Full</option>
                    <option value = "Liability">Liability</option>
                    </select>
                    </td>
            </tr>-->
            <tr>
            <td><b>End Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                 if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo $row["End_date"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New End Date:</b></td>
                <td><input type = "date" name = "End_date" required></td>
            </tr>
            <tr>
                <td><b>Pick-Up Location:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Branch, Reservation
            WHERE Branch.Branch_no = Reservation.Pickup_location";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo  $row["Branch_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Pick-Up Location:</b></td>
                <td> <select name = "Pickup" id = "Pickup" required>
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
                              
                            if(!($row["Branch_no"] == 0)){
                              
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
                <td><b>Drop-Off Location:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Branch, Reservation
            WHERE Branch.Branch_no = Reservation.Dropoff_location";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo  $row["Branch_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Drop-Off Location:</b></td>
                <td> <select name = "Dropoff" id = "Dropoff" required>
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
                              
                            if(!($row["Branch_no"] == 0)){
                              
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
                <td><b>VIN:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo  $row["VIN"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New VIN:</b></td>
                <td> <select name = "VIN" id = "VIN" required>
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
        </tr>
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_res_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>