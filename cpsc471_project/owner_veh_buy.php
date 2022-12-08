<?php
    session_start();
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
    //    echo "Connection successful\n";
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
    #Province, #Branch_no, #InsuranceID, #Category{
        width: 50%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
        text-align: left;
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

    .same_plate{
        color: tomato;
    }
    
    /*
    .popup {
        width: 250px;
        height: 150px;
        background: #fff;
        border-radius: 6px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.1);
        text-align: center;
        visibility: hidden;
    }

    .open-popup {
        visibility: visible;
        top: 50%;
        transform: translate(-50%, -50%) scale(1);
    }

    .popup_button {
        background-color: rgba(35,70,101,1);
        border: none;
        color: rgba(139,216,189,1);
        padding: 1vw 2vw;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 1vw;
        cursor: pointer;
    } */

   </style>
<title>Canada Wide Car Rental Service - Owner: Buy Vehicle</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Buy Vehicle
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>
<div>

    <form action='owner_veh_buy_post.php' method='post'>
        <table>
        <?php
                //if start date is after end date, display error message
                if($_SESSION["SameVIN"]){
                    echo "<tr> <td> </td> <td class = 'same_plate'> 
                    Oops! VIN: ". $_SESSION["SameVINis"] ." already exists!
                    </td></tr>";
                    $_SESSION["SameVIN"] = false;
                }

            ?>
            <tr>
                <td>VIN:</td>
                <td><input type = "text" name = "VIN" required pattern = "[0-9][A-Z][A-Z][A-Z][A-Z][0-9][0-9][A-Z][A-Z][A-Z][A-Z][0-9][0-9][0-9][0-9][0-9][0-9]"></td>
            </tr>
            <tr>
                <td>Year:</td>
                <td><input type = "text" name = "Year" required pattern="[2][0][0-9][0-9"></td>
            </tr>
            <tr>
                <td>Make:</td>
                <td><input type = "text" name = "Make" required></td>
            </tr>
            <tr>
                <td>Model:</td>
                <td><input type = "text" name = "Model" required></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td> <select name = "Status" id = "Province" required>
                    <option value = "Ready" > Ready </option>
                    <option value = "Not_Ready" > Not Ready </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mileage:</td>
                <td><input type = "text" name = "Mileage" required pattern="[1-9][0-9]+"></td>
            </tr>
            <?php
                //if start date is after end date, display error message
                if($_SESSION["SamePlate"]){
                    echo "<tr> <td> </td> <td class = 'same_plate'> 
                    Oops! Cannot have the same licence plate for two vehicles.
                    </td></tr>";
                    $_SESSION["SamePlate"] = false;
                }

            ?>
            <tr>
                <td>Liscence Plate Number:</td>
                <td><input type = "text" name = "Liscence_plate_no" required></td>
            </tr>
            <tr>
                <td>Registration Province:</td>
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
                <td>Insurance ID:</td>
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
                <td>Branch Number:</td>
                <td> <select name = "Branch_Number" id = "Branch_no" required>
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

            <!-- Not sure how to do this dynamically
            <tr>
                <td>Branch Number:</td>
                <td> <select name = "Branch_no" id = "Branch_no" required>
                    <option value = "Branch 1" > Branch 1</option>
                </select>
            </td>
            </tr> -->
            <tr>
                <td>Category:</td>
                <td> <select name = "Category" id = "Category" required>
                    <option value = "M: Mini" > M: Mini </option>
                    <option value = "N: Mini Elite" > N: Mini Elite</option>
                    <option value = "E: Economy" > E: Economy </option>
                    <option value = "H: Economy Elite" > H: Economy Elite </option>
                    <option value = "C: Compact" > C: Compact </option>
                    <option value = "D: Compact Elite" > D: Compact Elite </option>
                    <option value = "I: Intermediate" > I: Intermediate </option>
                    <option value = "J: Intermediate Elite" > J: Intermediate Elite </option>
                    <option value = "S: Standard" > S: Standard </option>
                    <option value = "R: Standard Elite" > R: Standard Elite </option>
                    <option value = "F: Fullsize" > F: Fullsize </option>
                    <option value = "G: Fullsize Elite" > G: Fullsize Elite </option>
                    <option value = "P: Premium" > P: Premium </option>
                    <option value = "U: Premium Elite" > U: Premium Elite </option>
                    <option value = "L: Luxury" > L: Luxury </option>
                    <option value = "W: Luxury Elite" > W: Luxury Elite </option>
                    <option value = "O: Oversize" > O: Oversize </option>
                    <option value = "X: Special" > X: Special </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Trans Driven Wheels:</td>
                <td> <select name = "Trans_Driven_Wheels" id = "Province" required>
                    <option value = "M: Manual (Drive Unspecified)" > M: Manual (Drive Unspecified) </option>
                    <option value = "N: Manual 4WD" > N: Manual 4WD </option>
                    <option value = "C: Manual AWD" > C: Manual AWD </option>
                    <option value = "A: Auto (Drive Unspecified)" > A: Auto (Drive Unspecified) </option>
                    <option value = "B: Auto 4WD" > B: Auto 4WD </option>
                    <option value = "D: Auto AWD" > D: Auto AWD </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Fuel/Air Conditioning:</td>
                <td> <select name = "Fuel_Air_Conditioning" id = "Province" required>
                    <option value = "R: Unspecified Fuel With Air Conditioning (AC)" > R: Unspecified Fuel With Air Conditioning (AC) </option>
                    <option value = "N: Unspecified Fuel Without AC" > N: Unspecified Fuel Without AC </option>
                    <option value = "D: Diesel With AC" > D: Diesel With AC </option>
                    <option value = "Q: Diesel Without AC" > Q: Diesel Without AC </option>
                    <option value = "H: Hybrid With AC" > H: Hybrid With AC </option>
                    <option value = "I: Hybrid Without AC" > I: Hybrid Without AC </option>
                    <option value = "E: Electric With AC" > E: Electric With AC </option>
                    <option value = "C: Electric Without AC" > C: Electric Without AC </option>
                    <option value = "L: LPG/Compressed Gas With AC" > L: LPG/Compressed Gas With AC </option>
                    <option value = "S: LPG/Compressed Gas Without AC" > S: LPG/Compressed Gas Without AC </option>
                    <option value = "A: Hydrogen With AC" > A: Hydrogen With AC </option>
                    <option value = "B: Hydrogen Without AC" > B: Hydrogen Without AC </option>
                    <option value = "M: Multi Fuel/Power With AC" > M: Multi Fuel/Power With AC </option>
                    <option value = "F: Multi Fuel/Power Without AC" > F: Multi Fuel/Power Without AC </option>
                    <option value = "V: Petrol With AC" > V: Petrol With AC </option>
                    <option value = "Z: Petrol Without AC" > Z: Petrol Without AC </option>
                    <option value = "U: Ethanol With AC" > U: Ethanol With AC </option>
                    <option value = "X: Ethanol Without AC" > X: Ethanol Without AC </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Type:</td>
                <td> <select name = "Type" id = "Province" required>
                    <option value = "B: 2-3 Door" > B: 2-3 Door </option>
                    <option value = "C: 2/4 Door" > C: 2/4 Door </option>
                    <option value = "D: 4-5 Door" > D: 4-5 Door </option>
                    <option value = "W: Wagon/Estate" > W: Wagon/Estate </option>
                    <option value = "V: Passenger Van" > V: Passenger Van </option>
                    <option value = "L: Limousine" > L: Limousine </option>
                    <option value = "S: Sport" > S: Sport </option>
                    <option value = "T: Convertible" > T: Convertible </option>
                    <option value = "F: SUV" > F: SUV </option>
                    <option value = "J: Open Air All Terrain" > J: Open Air All Terrain </option>
                    <option value = "X: Special" > X: Special </option>
                    <option value = "P: Pick up Regular Cab" > P: Pick up Regular Cab </option>
                    <option value = "Q: Pick up Extended Cab" > Q: Pick up Extended Cab </option>
                    <option value = "Z: Special Offer Car" > Z: Special Offer Car </option>
                    <option value = "E: Coupe" > E: Coupe </option>
                    <option value = "M: Monospace" > M: Monospace </option>
                    <option value = "R: Recreational Vehicle" > R: Recreational Vehicle </option>
                    <option value = "H: Motor Home" > H: Motor Home </option>
                    <option value = "Y: 2 Wheel Vehicle" > Y: 2 Wheel Vehicle </option>
                    <option value = "N: Roadster" > N: Roadster </option>
                    <option value = "G: Crossover" > G: Crossover </option>
                    <option value = "K: Commercial Van/Truck" > K: Commercial Van/Truck </option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Horse Power:</td>
                <td><input type = "text" name = "Horse_Power" required pattern="[0-9]+"></td>
            </tr>
            <tr>
                <td>Torque:</td>
                <td><input type = "text" name = "Torque" required pattern="[0-9]+"></td>
            </tr>
            <tr>
                <td>Tonnage:</td>
                <td><input type = "text" name = "Tonnage" required pattern="[0-9+"></td>
            </tr>

            <tr>
                <td>Sunroof:</td>
                <td> <select name = "Sunroof" id = "Province" required>
                    <option value = "Yes" > Yes </option>
                    <option value = "No" > No </option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Seat Material:</td>
                <td> <select name = "Seat_Material" id = "Province" required>
                    <option value = "Cloth" > Cloth </option>
                    <option value = "Leather" > Leather </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Body Colour:</td>
                <td><input type = "text" name = "Body_Colour" required></td>
            </tr>
            <tr>
                <td>Interior Colour:</td>
                <td><input type = "text" name = "Interior_Colour" required></td>
            </tr>
            <tr>
                <td>Fuel Economy:</td>
                <td><input type = "text" name = "Fuel_Economy" required ></td>
            </tr>
            <tr>
                <td>Child Seat Compatible:</td>
                <td> <select name = "Child_Seat_Compatible" id = "Province" required>
                    <option value = "Yes" > Yes </option>
                    <option value = "No" > No </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Number of Passengers:</td>
                <td><input type = "text" name = "Passengers_no" required></td>
            </tr>
            <tr>
                <td>Date Purchased:</td>
                <td><input type = "date" name = "Date_Purchased" required></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type = "text" name = "Price" required pattern="(?:0|[1-9]\d+|)?(?:.?\d{0,2})?$"></td>
            </tr>
            <tr>
                <!-- href whould be owner_veh_view.php -->
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_start.php'">Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Buy</button></td>
            </tr>

            </table>
    </form>
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->

    <!--
    <script>
        let popup = document.getElementById("popup");

        function openPopup() {
            popup.classList.add("open-popup");
        }

        
        function closePopup() {
            popup.classList.remove("open-popup");
        }

    </script>
    -->

    </body>
    </html>