
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

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }
        if(count($_SESSION["SearchResult"]) > 0){
        
        for($i = 0; $i < count($_SESSION["SearchResult"]); $i++) {
                echo "<table class='search_table2'><form action='owner_branch_search_post.php' method='post'>
                        <tr> <th> Branch Number: " . $_SESSION["SearchResult"][$i]["Branch_no"] . 
                        "</td> </tr> <tr> <td> <b> Branch Name: </b>" . $_SESSION["SearchResult"][$i]["Branch_name"] . 
                        "</td> </tr> <tr> <td> <div class = 'edit'> <b> Branch Address: </b>" . $_SESSION["SearchResult"][$i]["Street_no"] . " " . 
                        $_SESSION["SearchResult"][$i]["Street_name"] . " " . $_SESSION["SearchResult"][$i]["City"] . ", " . 
                        $_SESSION["SearchResult"][$i]["Province"] . " " . $_SESSION["SearchResult"][$i]["Postal_code"] . "          
                        <div class = 'edit'>
                        <input type = 'hidden' name = 'Branch_no'  id = 'Branch_no' value = " . $_SESSION["SearchResult"][$i]["Branch_no"] .">
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