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
   </style>

    <body>
        <h1>Employee Temp Terminated</h1>
    <button class= "addbutton" type="button" name="addbutton" value="addbutton" onclick="window.location.href='owner_emp_view.php'">Ok</button></td>
        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    

    $Date_Fired = $_REQUEST["Date_Fired"];
    $Severance = $_REQUEST["Severance"];
    
    /* Need to add sql statements 

    $stmt = $con->prepare("INSERT INTO branch 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $Branch_Number, $Branch_Name, $Street_no, $Street_name, $City, $Province, $Postal_code);
    
    $stmt->execute();
    //echo "New record created successfully";
    $last_id = $con->insert_id;
    echo "New branch created successfully. Last inserted ID is: " . $last_id;
    $stmt->close();

    $stmt2 = $con->prepare("INSERT INTO branch_phone_number
    VALUES (?, ?)");
    $stmt2->bind_param("ss", $Branch_Number, $Phone_number);
    $stmt2->execute();
    echo "Phone number created successfully";
    $stmt2->close();
    
    */

    $con->close();
?>


    </body>
    </html>