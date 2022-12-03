<?php
    $con = mysqli_connect("localhost","root","","cwcrs_db");
    if(!$con) {
        exit("An error connecting occurred." .mysqli_connect_errno());
    } else {
        echo "Connection successful";
    }

?>


<h1>Hello World!</h1>

<form action = "index.php" method = "post">
<!-- Name: <input type="text" name="name" value="<?php echo $name;?>"> </br>-->
    First Name: <input type = "text" name = "First_name"/> </br> </br>
    Middle Name: <input type = "text" name = "Middle_name" /> </br> </br>
    Last Name: <input type = "text" name = "Last_name" /> </br> </br>
    Email: <input type = "email" name = "Email" /> </br> </br>
    Phone Number: <input type = "text" name = "Phone_number" /> </br> </br>
    Date of Birth: <input type = "date" name = "DOB" /> </br> </br>
    Gender: <input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="female") echo "checked";?>
        value="female">Female
        <input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="male") echo "checked";?>
        value="male">Male
        <input type="radio" name="Sex"
        <?php if (isset($Sex) && $Sex=="other") echo "checked";?>
        value="other">Other </br> </br>
    Street Number: <input type = "text" name = "Street_no" /> </br> </br>
    Street Name: <input type = "text" name = "Street_name" /> </br> </br>
    City: <input type = "text" name = "City" /> </br> </br>
    Province: <select name = "Province" >
        <option value = "Alberta" > AB </option>
        <option value = "British_columbia" > BC </option>
        <option value = "Manitoba" > MB </option>
        <option value = "New_brunswick" > NB </option>
        <option value = "Newfoundland_and_labrador" > NL </option>
        <option value = "Northwest_territories" > NT </option>
        <option value = "Nova_scotia" > NS </option>
        <option value = "Ontario" > NU </option>
        <option value = "Ontario" > ON </option>
        <option value = "Prince_edward_island" > PE </option>
        <option value = "Quebec" > QC </option>
        <option value = "Saskatchewan" > SK </option>
        <option value = "Yukon" > YT </option>
    </select>
    <br><br>
    Postal Code: <input type = "text" name = "Postal_code" /> </br> </br>
    <input type = "submit" name = "Submit" />
</form>

