
<?php
    //start session for shared variables
    session_start();

    //checking if we can connect to database
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        //echo "Connection successful\n";
    }
        $con->close();
?>

<!-- code heavily adapted from W3 Schools HTML Tutorials
     https://www.w3schools.com/html/default.asp -->

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
        width: 50%;
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

    .errortable td{
        text-align: center;
    }


    .taken, .no_match{
        color: tomato;
    }
    
   </style>
   <!-- set title for page -->
<title>Canada Wide Car Rental Service - Create New Customer</title>
</head>

<body>

<div class="header">
<!-- header with logo and title -->
<h1 style="font-size:3vw">
Create New Customer
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>
<?php
                //if user input is incorrect, display error message
                if($_SESSION["NotSame"] || $_SESSION["Same_Username"] || $_SESSION["Under25"]){
                    echo "<table class = 'error table'><tr><td class = 'taken'> 
                    Errors exist below. Please correct them and try again.
                    </td></tr></table>";
                }

            ?>

<div>
    <!-- form for user to sign up -->
    <form action='new_cust_post.php' method='post'>
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type = "text" name = "First_name" required></td>
            </tr>
            <tr>
                <td>Middle Name:</td>
                <td><input type = "text" name = "Middle_name"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type = "text" name = "Last_name" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type = "email" name = "Email" required></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type = "text" name = "Phone_number" required></td>
            </tr>
            <?php
                //if user is not over 25, display error message
                if($_SESSION["Under25"]){
                    echo "<tr> <td> </td> <td class = 'taken'> 
                    Oh No! You must be 25 or older to rent a car.
                    </td></tr>";
                    $_SESSION["Under25"] = false;
                }

            ?>
            <tr>
                <td>Date of Birth:</td>
                <td><input type = "date" name = "DOB" max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]"required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="female") echo "checked";?>
        value="female">Female
        <input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="male") echo "checked";?>
        value="male">Male
        <input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="other") echo "checked";?>
        value="other">Other</td>
            </tr>
            <tr>
                <td>Street Number:</td>
                <td><input type = "text" name = "Street_no" required pattern = "[0-9]+"></td>
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
                <td><input type = "text" name = "Postal_code" required pattern = "/[A-Z][0-9][A-Z]][0-9][A-Z]][0-9]/i"></td>
            </tr>
            <?php
                //if user tries to use a username already taken, display error message
                if($_SESSION["Same_Username"]){
                    echo "<tr> <td> </td> <td class = 'taken'> 
                    Username: " . $_SESSION["Taken"] ." is already taken!
                    <br> Please choose a different one.
                    </td></tr>";
                    $_SESSION["Same_Username"] = false;
                }

            ?>
            <tr>
                <td>Username:</td>
                <td><input type = "text" name = "Username" required></td>
            </tr>
            <?php
                //if user fails to confirm password, display error message
                if($_SESSION["NotSame"]){
                    echo "<tr> <td> </td> <td class = 'no_match'> 
                    Passwords do not match!
                    </td></tr>";
                    $_SESSION["NotSame"] = false;
                }

            ?>
            <tr>
                <td>Password:</td>
                <td><input type = "password" name = "Password" required></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type = "password" name = "Confirm_password" required></td>
                </tr>
            <tr>
                <!-- back button goes to login screen, submit button creates a new customer-->
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='login.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Create</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>