
<?php
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
    #Province{
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
    
   </style>
<title>Canada Wide Car Rental Service - Add Branch</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Add Branch
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
</br>
</br>
<div>
    <form action='owner_branch_add_post.php' method='post'>
        <table>
            <tr>
                <td>Branch Number:</td>
                <td><input type = "text" name = "Branch_Number" required></td>
            </tr>
            <tr>
                <td>Branch Name:</td>
                <td><input type = "text" name = "Branch_Name"></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type = "text" name = "Phone_number" required></td>
            </tr>
            <tr>
                <td>Street Number:</td>
                <td><input type = "text" name = "Street_no" required></td>
            </tr>
            <tr>
                <td>Street Name:</td>
                <td><input type = "text" name = "Street_name" required></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type = "text" name = "City" required></td>
            </tr>
            <tr>
                <td>Province:</td>
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
                <td>Postal Code:</td>
                <td><input type = "text" name = "Postal_code" required></td>
            </tr>
            <tr>
                <!-- change location to search branch page -->
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='login.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Add</button></td>
            </tr>
            </table>
    </form>
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->


    </body>
    </html>