
<?php
    session_start();
    
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

    input[type=text]{
        width: 40%;
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
    .formtable td{
        text-align: center;
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

    .taken{
        color: tomato;
    }
    #Ins_type{
        width: 40%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
    }
    
   </style>
<title>Canada Wide Car Rental Service - Employee: Add Insurance</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Add Insurance
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<div>
    <form action='add_ins_post.php' method='post'>
        <table class = "formtable">
        <?php
                //if user input is incorrect, display error message
                if($_SESSION["SamePolicy"]){

                    echo "<tr> <td> </td> <td class = 'taken'> 
                    Insurance ID: " . $_SESSION["TakenPolicy"] ." already exists!
                    </td></tr>";
                    $_SESSION["SamePolicy"] = false;
            
                }

            ?>
            <tr>
                <td>Insurance ID:</td>
                <td><input type = "text" name = "InsuranceID" required></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td> <select name = "Ins_type" id = "Ins_type" required>
                    <option value = "Full">Full</option>
                    <option value = "Liability">Liability</option>
                    </select>
                    </td>
            </tr>
            <tr>
                <td>Cost:</td>
                <td><input type = "text" name = "Cost" required></td>
            </tr>
            
            <?php
                //if user input is incorrect, display error message
                if($_SESSION["Same_Username"]){
                    echo "<tr> <td> </td> <td class = 'taken'> 
                    Username: " . $_SESSION["Taken"] ." is already taken!
                    <br> Please choose a different one.
                    </td></tr>";
                    $_SESSION["Same_Username"] = false;
                }

            ?>
          
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_ins.php'"> Back</button>  
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Add</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>