<html>
    <head>
        <title>Admin Menu</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <form class="aMenu" action="adminMenu.php" method="post">
            <div class="form-group">
                <input type="submit" name="seeBook" class="btn btn-primary" value="See Bookings" id="adminbtn"><br>
                <input type="submit" name="calc" class="btn btn-primary" value="Calculate Gross Pay" id="adminbtn"><br>
                <input type="submit" name="timeOff" class="btn btn-primary" value="Booking Time Off" id="adminbtn"><br>
                <input type="submit" name="viewClients" class="btn btn-primary" value="View Clients" id="adminbtn"><br>
                <input type="submit" name="back" class="btn btn-primary" value="Logout" id="adminbtn">
            </div>
        </form>
    </body>

</html>

<?php

if(isset($_POST['seeBook'])){
    header("Location: ../test/seeBookingAdmin.php");
}

if(isset($_POST['calc'])){
    header("Location: ../test/calcPay.php");
}

if(isset($_POST['timeOff'])){
    header("Location: ../test/timeOff.php");
}

if(isset($_POST['viewClients'])){
    header("Location: ../test/viewClients.php");
}

if(isset($_POST['back'])){
    header("Location: ../test/index.php");
}

?>