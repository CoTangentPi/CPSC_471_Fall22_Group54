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
        header("Location: edit_veh_serv_rec.php");
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
        header("Location: service_recs_veh.php");
    }

   /* $insID = $_REQUEST["InsuranceID"];
    $Ins_type = $_REQUEST["Ins_type"];
    $Cost = $_REQUEST["Cost"];
    $_SESSION["InsuranceID"] = $insID;
    //$_SESSION["Ins_type"] = $Ins_type;
    //$_SESSION["Cost"] = $Cost;
    echo "Insurance ID: " . $_SESSION["InsuranceID"] . "<br>";
    echo "Insurance type: " . $_SESSION["Ins_type"] . "<br>";
    
    echo "Cost: " . $_SESSION["Cost"] . "<br>";

    if($_REQUEST["submitbutton"]=="Edit"){
        echo"You pressed edit";
        $_SESSION["EditIns"] = true;
        $_SESSION["RemoveIns"] = false;
        header("Location: emp_ins_edit.php");
    } else if($_REQUEST["submitbutton"]=="Remove"){
        echo "You pressed remove";
        $_SESSION["RemoveIns"] = true;
        $_SESSION["EditIns"] = false;
        //header("Location: emp_ins_remove.php");
    }

    $noVeh = true;

    $sqlcheck = "SELECT * FROM vehicle";

        $resultcheck = $con->query($sqlcheck);

        $count = mysqli_num_rows($resultcheck);
        if($resultcheck->num_rows > 0) {
            while($row = $resultcheck->fetch_assoc()) {

                if ($row["InsuranceID"] == $_SESSION["InsuranceID"]) {
                    $noVeh = false;
                }
            }}
    
    if($_SESSION["RemoveIns"] && $noVeh && !$_SESSION["EditIns"]) {
        $stmt = $con->prepare("DELETE FROM insurance WHERE InsuranceID = ?");
        $stmt->bind_param("s", $_SESSION["InsuranceID"]);
        $stmt->execute();
        echo "Insurance removed successfully";
        $stmt->close();
        $_SESSION["RemoveIns"] = false;
        header("Location: emp_ins.php");
    } else if (!$noVeh && !$_SESSION["EditIns"]) {
        $_SESSION["InsInUse"] = true;
        echo "Insurance is in use";
        header("Location: emp_ins_search.php");
    }*/

        $con->close();
?>


    </body>
    </html>