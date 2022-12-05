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

    .ins_table {
        border: 1px solid rgba(139,216,189,1);
    }

    .ins_table2 {
        border: 1px solid rgba(139,216,189,1);
    }
    th {
        font-size:1.0vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    .ins_table2 td {
        font-size:1.0vw;
        text-align: left;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }

    .no_cust {
        text-align: center;
        font-size: 2vw;
        padding: 2vw;
    }

    .bottom_table{
        position: bottom;
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
        color: rgba(139,216,189,1);
        fill: currentColor;
        width: 2.5vw;
        height: 2.5vw;
        
      }

      svg:hover {
        color: rgba(35,70,101,1);
      }

      .searchbar {
        display:flex;
        flex-direction:row;
        align-items:center;
      }
    
    
   </style>
<title>Canada Wide Car Rental Service - Owner: View Employee</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">

View Employee

</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>

    <button class= "button" type="button" onclick="window.location.href='owner_emp_add.php'">Add Employee</button>  
    <form action="owner_emp_view_post.php" class = "searchbar" method="post">
      <input type="search" placeholder="Search.." name="search">
     <!-- <button type="submit" class = "searchbutton"><i class="fa fa-search"></i></button> -->
     <button class = "searchbutton" class= "submitbutton" type="submit" name="submit" value="Submit">
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>

  <br>
  <br>

  <table class="ins_table">
    <tr>
        <th width = 20%>Employee Number</th>
        <th width = 20%>Name</th>
        <th width = 20%>SIN</th>
        <th width = 15%>Branch Number</th>
        <th width = 20%>Status</th>
        <th width = 33%>Email</th>
        <th width = 25%>Phone Number</th>
        <th width = 20%>DOB</th>
        <th width = 7%>Sex</th>
        <th width = 20%>Address</th>
        <th width = 20%>Start Date</th>
        <th width = 20%>End Date</th>
        <th width = 20%>Salary</th>
        <th width = 20%>Severance</th>

</tr>

        </table>
        <table>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else { }

    $sql = "SELECT * FROM employee as emp, employs as e, users as u
            WHERE u.UserID = emp.E_UserID
            AND emp.E_UserID = e.E_UserID";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

                echo "<table class='ins_table2'>
                        <tr> 
                        
                        <td width = 20%>" . $row["E_UserID"] . "</td> 
                        <td width = 20%>" . $row["First_name"] . " " . $row["Middle_name"] . " " . $row["Last_name"] ."</td> 
                        <td width = 20%>" . $row["SIN"] . "</td> 
                        <td width = 15%>" . $row["Branch_no"] . "</td> 
                        <td width = 20%>" . $row["Employment_status"] . "</td> 
                        <td width = 33%>" . $row["Email"] . "</td> 
                        <td width = 25%>" . $row["Phone_number"] . "</td> 
                        <td width = 20%>" . $row["DOB"] . "</td> 
                        <td width = 7%>" . $row["Sex"] . "</td> 
                        <td width = 20%>" . $row["Street_no"] . " " . $row["Street_name"] . " " . $row["City"] . " " . $row["Province"] . " " . $row["Postal_code"] . "</td> 
                        <td width = 20%>" . $row["Start_date"] . "</td> 
                        <td width = 20%>" . $row["End_date"] . "</td> 
                        <td width = 20%>" . $row["Salary"] . "</td> 
                        <td width = 20%>" . $row["Severance"] . "</td> 

                        </tr> </table>";
        }
      } else {
        echo "<br>";
        echo "<br>";
        echo "<table class='no_cust'>";
        echo "<tr>";
        echo "<td>";
        echo "No Employees to Display";
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
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_start.php'"> Back</button>  
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