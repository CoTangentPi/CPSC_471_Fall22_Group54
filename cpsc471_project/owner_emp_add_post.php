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
        <h1>Employee <?php echo $_POST["First_name"]; ?> successfully added</h1><br>
    <button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_emp_view.php'">Back</button>  
    <button class= "addbutton" type="button" name="addbutton" value="addbutton" onclick="window.location.href='owner_emp_add.php'">Add Another Employee</button></td>
        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }
    

    $First_name = $_REQUEST["First_name"];
    $Middle_name = $_REQUEST["Middle_name"];
    $Last_name = $_REQUEST["Last_name"];

    $SIN = $_REQUEST["SIN"];
    $Branch_Number = $_REQUEST["Branch_Number"];

    $Email = $_REQUEST["Email"];
    $Phone_number = $_REQUEST["Phone_number"];
    $DOB = $_REQUEST["DOB"];
    $Sex = $_REQUEST["Sex"];
    $Street_no = $_REQUEST["Street_no"];
    $Street_name = $_REQUEST["Street_name"];
    $City = $_REQUEST["City"];
    $Province = $_REQUEST["Province"];
    $Postal_code = $_REQUEST["Postal_code"];

    $Start_date = $_REQUEST["Start_date"];
    $Salary = $_REQUEST["Salary"];

    $Username = $_REQUEST["Employee_Username"];
    $Password = $_REQUEST["Employee_Password"];

    $stmt = $con->prepare("INSERT INTO users 
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //VALUES (NULL, $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code)";
    $stmt->bind_param("ssssssssssss", $First_name, $Middle_name, $Last_name, $Email, $Phone_number, $DOB, $Sex, $Street_no, $Street_name, $City, $Province, $Postal_code);
    
    $stmt->execute();
    //echo "New record created successfully";
    $last_id = $con->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    $stmt->close();

    $stmt2 = $con->prepare("INSERT INTO login
    VALUES (NULL, ?, ?, ?)");
    $stmt2->bind_param("sss", $Username, $Password, $last_id);
    $stmt2->execute();
    echo "Login record created successfully";
    $stmt2->close();


    $sql = "INSERT INTO Employee VALUES ($last_id, $SIN, $Branch_Number)";
    $result = $con->query($sql);

    if($result) {
        echo "Employee created successfully";
        $sql2 = "INSERT INTO permission VALUES (NULL, 'Employee', $last_id)";
        $result2 = $con->query($sql2);
        if($result2) {
            echo "Permission record created successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $con->error;
        }
        
        // Start date insertion is all 0's
        $sql3 = "INSERT INTO employs VALUES ($last_id, '1', 'Employed', $Start_date, NULL, $Salary, NULL)";
        $result3 = $con->query($sql3);
        if($result3) {
            echo "Employs table updated successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $con->error;
        }
    
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
        $con->close();
?>


    </body>
    </html>