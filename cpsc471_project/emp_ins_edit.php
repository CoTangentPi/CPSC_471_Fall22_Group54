
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
    #Ins_type{
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



    input[type=text]{
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
        position: absolute;
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
<title>Canada Wide Car Rental Service - Employee: Edit Insurance</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Edit Insurance
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<div>

    
  <table class="edit_table">
    <tr>
        <th>Insurance ID: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM insurance";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["InsuranceID"] == $_SESSION["InsuranceID"]) {
                    echo $row["InsuranceID"];
                }
            }
            $con->close();

        ?>
        </span></th>
        <th></th>
        </tr>

        </table>
        <table> 
    <form action='edit_ins_post.php' method='post'>
        <table>
            <tr>
                
                <td><b>Type:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM insurance";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
                 if($row["InsuranceID"] == $_SESSION["InsuranceID"]) {
                    echo $row["Ins_Type"];
                }
            }
            $con->close();

        ?></td>
                <td><b>New Type:</b></td>
                <td> <select name = "Ins_type" id = "Ins_type" required>
                    <option value = "Full">Full</option>
                    <option value = "Liability">Liability</option>
                    </select>
                    </td>
            </tr>
            <tr>
                <td><b>Cost:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM insurance";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["InsuranceID"] == $_SESSION["InsuranceID"]) {
                    echo "$". number_format($row["Cost"], 2);
                }
            }
            $con->close();

        ?></td>
                <td><b>New Cost:</b></td>
                <td><input type = "text" name = "Cost"required pattern="(?:0|[1-9]\d+|)?(?:.?\d{0,2})?$"></td>
        </tr>
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='emp_ins_search.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Update</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>