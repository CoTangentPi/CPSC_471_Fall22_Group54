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
        top: 50%;
        transform: translateY(50%);
    }
    #Province, #Branch_no{
        width: 80%;
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
        width: 80%;
        padding: 1vw 4vw;
        margin: 1vw 0;
        display: inline-block;
        border: 1px solid rgba(139,216,189,1);
        box-sizing: border-box;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-size:1.5vw;
    }

    input[type=date]{
        padding: 1vw 3vw;
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
        width: 25%;
    }
    td {
        text-align: center;
        padding: 1.5vw;
        width: 25%;
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
    
   </style>
<title>Canada Wide Car Rental Service - Owner: Edit Employee</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Employee
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<div>
    
  <table class="edit_table">
    <tr>
        <th>Branch ID: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
               if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["E_UserID"];
                }
            }
            $con->close();

        ?>
        </span></th>
        <th></th>
        <th></th>
        <th></th>
        </tr>

        </table>
        <table> 
    <form action='owner_emp_edit_post.php' method='post'>
        <table>
        <?php
                //if user input is incorrect, display error message
              /*  if($_SESSION["NotSame"] || $_SESSION["Same_Username"]){
                    echo "<tr><td class = taken> 
                    Errors exist below. Please correct them and try again.
                    </td></tr>";
                }*/

            ?>
            <tr>
                
                <td><b>First Name:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["First_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New First Name:</b></td>
                <td><input type = "text" name = "First_name" required></td>
            </tr>
            <tr>
                <td><b>Middle Name:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               // if($row["C_UserID"] == 9) {
                
               if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Middle_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Middle Name:</b></td>
                <td><input type = "text" name = "Middle_name"></td>
            </tr>
            <tr>
                <td><b>Last Name:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
               if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Last_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Last Name:</b></td>
                <td><input type = "text" name = "Last_name" required></td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Email"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Email:</b></td>
                <td><input type = "email" name = "Email" required></td>
            </tr>
            <tr>
                <td><b>Phone Number:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Phone_number"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Phone Number:</b></td>
                <td><input type = "text" name = "Phone_number" required></td>
            </tr>
            <tr>
                <td><b>Date of Birth:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["DOB"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Date of Birth:<b></td>
                <td><input type = "date" name = "DOB" required></td>
            </tr>
            <tr>
                <td><b>Gender:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Sex"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Gender:<b></td>
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
                <td><b>Street Number:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Street_no"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Street Number:</b></td>
                <td><input type = "text" name = "Street_no" required pattern = "[0-9]+"></td>
            </tr>
            <tr>
                <td><b>Street Name:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               // if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Street_name"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Street Name:</b></td>
                <td><input type = "text" name = "Street_name" required></td>
            </tr>
            <tr>
                <td><b>City:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["City"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New City:</b></td>
                <td><input type = "text" name = "City" required></td>
            </tr>
            <tr>
                <td><b>Province:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Province"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Province:</b></td>
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
                <td><b>Postal Code:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Users, Employee WHERE Users.UserID = Employee.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Postal_code"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Postal Code:</b></td>
                <td><input type = "text" name = "Postal_code" required pattern = "/[A-Z][0-9][A-Z]][0-9][A-Z]][0-9]/i"></td>
            </tr>

            <tr>
                <td><b>SIN:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employee";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["SIN"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New SIN:</b></td>
                <td><input type = "text" name = "SIN"></td>
            </tr>

            <tr>
                <td><b>Branch Number:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employee";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Branch_no"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Branch Number:</b></td>
                <td> <select name = "Branch_no" id = "Branch_no" required>
                    <?php
                      $con = mysqli_connect("localhost","root","","cwcrs_db");
                      if(!$con) {
                          exit("An error connecting occurred." .mysqli_connect_errno());
                      } else { }
                  
                      $sql = "SELECT * FROM Branch";
                      $result = $con->query($sql);
                      if ($result->num_rows > 0) {
                          // output data of each row
                          
                      
                          
                          while($row = $result->fetch_assoc()) {
                                if($row["Branch_no"] != 0){
                                  echo "<option value = '" . $row["Branch_no"] . "' >" .$row["Branch_no"].
                                  " </option>";
                              }
                            }
                          }

                      $con->close();

                    ?>
    </select>
</td>
            </tr>
            </tr>

            <tr>
                <td><b>Status:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employs as e, Employee as emp 
                    WHERE e.E_UserID = emp.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Employment_status"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Status:</b></td>
                <td><input type = "text" name = "Employment_status"></td>
            </tr>

            <tr>
                <td><b>Start Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employs as e, Employee as emp 
                    WHERE e.E_UserID = emp.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Start_date"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Start Date:<b></td>
                <td><input type = "date" name = "Start_date" required></td>
            </tr>

            <tr>
                <td><b>End Date:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employs as e, Employee as emp 
                    WHERE e.E_UserID = emp.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["End_date"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New End Date:<b></td>
                <td><input type = "date" name = "End_date"></td>
            </tr>




            <tr>
                <td><b>Salary:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employs as e, Employee as emp 
                    WHERE e.E_UserID = emp.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Salary"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Salary:<b></td>
                <td><input type = "text" name = "Salary" required></td>
            </tr>

            <tr>
                <td><b>Severance:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Employs as e, Employee as emp 
                    WHERE e.E_UserID = emp.E_UserID";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                //if($row["C_UserID"] == 9) {
                
                if($row["E_UserID"] == $_SESSION["E_UserID"]) {
                    echo $row["Severance"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Severance:<b></td>
                <td><input type = "text" name = "Severance"></td>
            </tr>

            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='owner_emp_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>

            </table>
    </form>

    </body>
    </html>

<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
  //      echo "Connection successful\n";
    }

        $con->close();
?>