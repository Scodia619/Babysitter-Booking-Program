<html>
    <head>
    <title>Client Menu</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    
    <body>
        <form class="Menu" action="clientMenu.php" method="post">
            <div class="form-group">
                <input type="submit" name="book" class="btn btn-primary" value="Book Babysitter" id="adminbtn"><br>
                <input type="submit" name="details" class="btn btn-primary" value="Change Details" id="adminbtn"><br>
                <input type="submit" name="seeBookings" class="btn btn-primary" value="See Bookings" id="adminbtn"><br>
                <input type="submit" name="back" class="btn btn-primary" value="Logout" id="adminbtn">
            </div>
        </form>
    </body>
</html>

<?php

if(isset($_POST['book'])){
    header("Location: ../test/booking.php");
}

if(isset($_POST['details'])){
    header("Location: ../test/changeDetails.php");
}

if(isset($_POST['seeBookings'])){
    header("Location: ../test/seeBooking.php");
}

if(isset($_POST['back'])){
    header("Location: ../test/index.php");
}

?>