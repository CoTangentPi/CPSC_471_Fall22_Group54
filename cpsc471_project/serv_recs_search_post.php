<?php
//start session
session_start();
?>
<html>
    <body>
        Welcome <?php echo $_SESSION["UserID"]; ?><br> ?>

        <?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful\n";
    }

    $invoiceNo = $_REQUEST["Invoice_no"];

    if($_REQUEST["submitbutton"]=="Edit"){
        echo"You pressed edit";
        $_SESSION["EditRec"] = true;
        $_SESSION["RemoveRec"] = false;
        $_SESSION["InvoiceNo"] = $invoiceNo;
        header("Location: edit_serv_rec.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed remove";
        $_SESSION["RemoveRec"] = true;
        $_SESSION["EditRec"] = false;
        //header("Location: emp_ins_remove.php");
    }

    echo "Invoice No: " . $invoiceNo . "<br>";
    if($_SESSION["RemoveRec"] && !$_SESSION["EditRec"]) {
        $stmt = $con->prepare("DELETE FROM service_record WHERE Invoice_no = ?");
        $stmt->bind_param("s", $invoiceNo);
        $stmt->execute();
        echo "Service record removed successfully";
        $stmt->close();
        $_SESSION["RemoveRec"] = false;
        header("Location: emp_serv_recs.php");
    }

  
        $con->close();
?>


    </body>
    </html>