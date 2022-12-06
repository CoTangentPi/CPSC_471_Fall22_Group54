
<?php
    session_start();
  //  $_SESSION["VehIns"] = 0;
    
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
    #InsuranceID{
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

    input[type=text], input[type=date]{
        width: 80%;
        padding: 1vw 2vw;
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

    #PayMethod{
        width: 80%;
        background-color: rgba(35,70,101,1);
        color: rgba(139,216,189,1);
        font-family: verdana;
        font-size: 1.5vw;
        padding: 1vw;
        border: 1px solid rgba(139,216,189,1);
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
    
    .edit_table th {
        width: 25%;
    }
    .edit_table td {
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
<title>Canada Wide Car Rental Service - Customer: Make Payment</title>
</head>

<body>

<div class="header">

<h1 style="font-size:3vw">
Make Payment
</h1>  
    <img src="logo.png" alt="logo" width=2vw height=2vw/>
</div>
</br>

<table class="edit_table">
    <tr>
        <th>Reservation ID: <span> 
        <?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                exit("An error connecting occurred." .mysqli_connect_errno());
            } else { }

            $sql = "SELECT * FROM Reservation";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()) {
               if($row["ReservationID"] == $_SESSION["ReservationID"]) {
                    echo $row["ReservationID"];
                }
            }
            $con->close();

        ?>
        </span></th>
        <th></th>
        </tr>

        </table>
        <table> 

<div>

        <table> 
    <form action='cust_pay_post.php' method='post'>
        <table class="edit_table">
            <tr>
                
                <td><b>Price:</b></td>
                <td><?php
            $con = mysqli_connect("localhost","root","","cwcrs_db");
            if(!$con) {
                
                exit("An error connecting occurred." .mysqli_connect_errno());
                
            } else { }

            $sql = "SELECT * FROM Reservation, Payment
            WHERE Reservation.PaymentID = Payment.PaymentID
            AND Reservation.C_UserID = Payment.C_UserID";
            $result = $con->query($sql);
           // echo "num rows: " . $result->num_rows;
           // echo "session payment id: " . $_SESSION["PaymentID"];
            //echo "session user id: " . $_SESSION["UserID"];
            while($row = $result->fetch_assoc()) {
                 if($row["PaymentID"] == $_SESSION["PaymentID"] && $row["C_UserID"] == $_SESSION["UserID"]) {
                    echo "$". number_format($row["Price"], 2);
                  //  echo "price";
                  //  $_SESSION["VehIns"] = $row["InsuranceID"];
                }
            }
            $con->close();

        ?></td>
                <td><b> Payment Method:</b></td>
                <td> <select name = "PayMethod" id = "PayMethod" required>
                    <option value = "Credit">Credit</option>
                    <option value = "Debit">Debit</option>
                    </select>
                    </td>
                    </td>
            </tr>
            <tr>

                <td><b>Card Number:</b></td>
                <td><input type="text" name="CardNum" id="CardNum" required pattern = "[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]"></td>
                <td><b>Card Expiry Date:</b></td>
                <td><input type="date" name="CardExp" id="CardExp" min="3000-01-01" onfocus="this.min=new Date().toISOString().split('T')[0]" required></td>
                
        
            <tr>
                <td><button class= "backbutton" text-align=left type="button" onclick="window.location.href='cust_view_res.php'"> Back</button>  
                <td></td>
                <td></td>
                <td><button class= "submitbutton" type="submit" name="submit" value="Submit">Pay</button></td>
            </tr>
            </table>
    </form>
    </body>
    </html>