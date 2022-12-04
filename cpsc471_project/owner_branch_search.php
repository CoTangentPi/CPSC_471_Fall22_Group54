
<?php
session_start();
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
       // echo "Connection successful\n";
    }

    // $sql2 = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
    // $result2 = $con->query($sql2);

   /* if ($result2->num_rows > 0) {

        while($row = $result2->fetch_assoc()) {

            if($row["UserID"] == $_SESSION["UserID"]) {
                 echo "UserID: " . $row["UserID"]. " - Name: " . $row["First_name"] .  " works at Branch: " . $row["Branch_no"] . "<br>";
            }
        }
      } else {
         echo "Can't find employee";
      }*/


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
         overflow: auto;
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

    .search_table {
        border: 1px solid rgba(139,216,189,1);
    }

    .search_table2 {
        border: 1px solid rgba(139,216,189,1);
        width: 50%;
    }
    th {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .search_table2 td {
        font-size:1.5vw;
        text-align: left;
        padding: 1vw;
    }

    .no_cust {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }

    .bottom_table{
        position: relative;
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
        color: #fff;
        fill: currentColor;
        width: 2.5vw;
        height: 2.5vw;
        
      }

      .searchbar {
        display:flex;
        flex-direction:row;
        align-items:center;
      }

      .edit{
        position: relative;
      }

      .editbutton{
        position: absolute;
        bottom: -1vw;
        right:-19vw;
      }

      .removebutton{
        position: absolute;
        bottom: -1vw;
        right:-40vw;
      }
    
    
   </style>
<title>Canada Wide Car Rental Service - Owner: Search Branch</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Search Branch
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

</br>
</br>
</br>
<!--
    <form action="cust_search.php" class = "searchbar">
      <input type="search" placeholder="Search.." name="search">
      <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> 
     <button class = "searchbutton">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>

  <br>
  <br>-->
<!--
  <table class="search_table">
    <tr>
        <th>Customer ID: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Customer WHERE Users.UserID = Customer.C_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                if($row["C_UserID"] == 9) {
                
               // if($row["UserID"] == $_SESSION["UserID"]) {
                    echo $row["C_UserID"];
                }
            }
            $con->close();

        ?>
        </span></th>
        </tr>

        </table>
        <table> -->

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    //$sql = "SELECT * FROM Customer, Users WHERE Customer.C_UserID = Users.UserID";
    //$result = $con->query($sql);
    //if ($result->num_rows > 0) {
        // output data of each row

        if(count($_SESSION["SearchResult"]) > 0){
        
        for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
          //echo $_SESSION["SearchResult"][$i]["C_UserID"] . "<br>";
      //}
        
       // while($row = $result->fetch_assoc()) {

                echo "<table class='search_table2'><form action='owner_branch_search_post.php' method='post'>
                        <tr> <th> Branch Number: " . $_SESSION["SearchResult"][$i]["Branch_no"] . 
                        "</td> </tr> <tr> <td> <b> Branch Name: </b>" . $_SESSION["SearchResult"][$i]["Branch_name"] . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Branch Address: </b>" . $_SESSION["SearchResult"][$i]["Street_no"] . " " . 
                        $_SESSION["SearchResult"][$i]["Street_name"] . " " . $_SESSION["SearchResult"][$i]["City"] . ", " . 
                        $_SESSION["SearchResult"][$i]["Province"] . " " . $_SESSION["SearchResult"][$i]["Postal_code"] . "
            
                        <div class = 'edit'>
                        <input type = 'hidden' name = 'C_UserID'  id = 'C_UserID' value = " . $_SESSION["SearchResult"][$i]["Branch_no"] .">
                        <button class= 'editbutton' name='submitbutton' text-align=left type='submit' value='Edit'>Edit</button>
                        <button class= 'removebutton' name='submitbutton'text-align=left type='submit' value='Remove'> Remove </button>
                        </div></form></td> </tr> </table> <br> <br>";
                           
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_cust'>";
        echo "<tr>";
        echo "<td>";
        echo "No Branches to Display";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
      }
    $con->close();

?> 
</table>
  <table class="bottom_table">
  <tr>
    <td>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_branch_view.php'"> Back</button>  
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