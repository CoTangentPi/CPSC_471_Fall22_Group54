
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

    .sell_table td{
        width:50%;
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

    .purchAfterSell{
        color: tomato;
    }

    .error {
        color: tomato;
        text-align: center;
    }
    
   </style>
<title>Canada Wide Car Rental Service - Owner: Sell Vehicle</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Sell Vehicle
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

<?php
                //if vehicle is not owned, display error message
                if($_SESSION["NotOwned"]){
                    echo "<table class = 'error'><tr> <td class = 'purchAfterSell'> 
                    Oops! Cannot Sell a Vehicle that is not Owned.
                    </td></tr></table>";
                    $_SESSION["NotOwned"] = false;
                }


            ?>



<div>
    <form action='sell_veh_post.php' method='post'>
        <table class = "sell_table">
          
        <?php
                //if sell date is before start date, display error message
                if($_SESSION["PurchaseAfterSell"]){
                    echo "<tr> <td> </td> <td class = 'purchAfterSell'> 
                    Oops! Date Sold cannot be before Date Purchased.
                    </td></tr>";
                    $_SESSION["PurchaseAfterSell"] = false;
                }


            ?>
            <tr>
                <!-- https://stackoverflow.com/questions/32378590/set-date-input-fields-max-date-to-today -->
            <td>Start Date:</td>
                <td><input type = "date" name = "Date_sold" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]" required></td>
            </tr>
            <tr>
            <td>Price:</td>
                <!--https://stackoverflow.com/questions/20050245/regular-expression-for-numbers-and-one-decimal -->
                <td><input type = "text" name = "Price"  id = "Price" required pattern = "(?:0|[1-9]\d+|)?(?:.?\d{0,2})?$"></td></tr>
            
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='own_veh_search.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Sell</button></td>
            </tr>
            </table>
    </form>
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->


    </body>
    </html>