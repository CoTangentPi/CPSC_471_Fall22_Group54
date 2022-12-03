<?php
//session variables adapted from 
//https://stackoverflow.com/questions/25316186/how-do-i-share-a-php-variable-between-multiple-pages

//start session
session_start();

//set session variables
$_SESSION["Same_Username"] = false; //if username already exists
$_SESSION["NotSame"] = false; //if passwords do not match
$_SESSION["Under25"] = false; //if user is under 25
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

    ::placeholder{
        color: rgba(139,216,189,1);
    }

    input[type=text], input[type=password]{
        width: 20%;
        padding: 1.5vw 3vw;
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
        text-align: center;
    }
    th {
        font-size:3vw;
        padding: 2vw;
    }
    td {
        font-size:2vw;
    }

    .tdname {
        padding: 0.5vw;
    }

    .tdbutton{
        padding: 1.5vw;
    }

    .invalid{
        color: tomato;
    }

    button{
        background-color: rgba(35,70,101,1);
        border: none;
        color: rgba(139,216,189,1);
        padding: 1.5vw 3vw;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 3vw;
        cursor: pointer;
    }

    button:hover {
        background-color: rgba(139,216,189,1);
        color: rgba(35,70,101,1);
    }
    .logoutbutton {
        
        font-size: 2vw;
    }
    
   </style>
   <!-- set title for page -->
<title>Canada Wide Car Rental Service - Log In</title>
</head>

<body>
<!-- header with logo and title -->
<div class="header">

<h1 style="font-size:3vw">
Canada Wide Car Rental Service
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>

</br>
</br>

<!-- form for user to log in -->
<div class="login">
<form action="login_post.php" method="post">
<table>
<tr> 
    <th>Sign In
    </th>
</tr>
<?php
    //if username or password is incorrect, display error message
    if($_SESSION["Invalid"]){
        echo "<tr><td class = 'invalid'>
        Invalid username or password
        </td></tr>";
        $_SESSION["Invalid"] = false;
    }

?>
<tr>
    <td class = "tdname">
        Username:
    </td>
</tr>
<tr>
    <td class = "tdname">
        <input type = "text" name = "Username" placeholder = "Username" required/>
    
    </td>
</tr>
<tr>
    <td class = "tdname">
        Password:
    </td>
</tr>
<tr>
    <td class = "tdname">
        <input type = "password" name = "Password" placeholder = "Password" required/>

    </td>
<tr>
    <td class = "tdbutton">
    <button class= "submitbutton" type="submit" name="submit" value="Submit">Sign In</button>
    </td>
</tr>
</table>
</form>
</div>
</br>
</br>
<table>
<!-- link to sign up page for new customers -->
<tr> 
    <th>New Customer
    </th>
</tr>
<form action="new_cust.php" method="post">
<tr>
    <td class = "tdbutton">
        <button type="submit" name="signup" >Sign Up</button>
    </td>
</tr>
</form>
</table>
    </body>
    </html>