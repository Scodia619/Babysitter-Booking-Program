<?php

session_start();

require "configure.php";

?>

<html>
    <head>
        <title>Book a Babysitter</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>

    <form class="createUser" action="booking.php" method="post">
                <div class="form-group" id="createuser">
                    <label for="name">Date: (YYYY-MM-DD)</label>
                    <input type="text" name="date"class="form-control" id="fname">
                    <label for="surname">Starting Time: (Number of the Hour for the 24HR Clock Eg. 22)</label>
                    <input type="number" name="stime" class="form-control" id="stime">
                    <label for="phone">Ending Time: (Number of the Hour for the 24HR Clock Eg. 22)</label>
                    <input type="number" name="etime"class="form-control" id="etime">
                    <input type="button" name="payment" class="btn btn-primary" value="Generate Payment" id="payment"><br>
                    <label for="street">Payment: (GBP £)</label>
                    <input type="text" name="pay"class="form-control" id="pay">
                    <input type="submit" name="confirm" class="btn btn-primary" value="Confirm Booking" id="userbtn"><br>
                    <input type="submit" name="back" class="btn btn-primary" value="Back" id="userbtn">
                </div>
        </form>

</html>

<script>

    var rate = 7;
    var pay = 0;
    var d = new Date();
    var y = d.getFullYear();
    var m = d.getMonth();
    var D = d.getDate();
    var re =  /^[0-9]{4}[.-]{1}[0-9]{2}[.-][0-9]{2}$/;

    function success(extra) {

        var check = re.test(document.getElementById("date").value);
        console.log(document.getElementById("date").value);
        if(!check){
            document.getElementById("pay").value = "Date not in correct format (YYYY-MM-DD)";
        }else{
            pay = rate * (document.getElementById("etime").value - document.getElementById("stime").value + extra);
            document.getElementById("pay").value = "£" + pay;
        }

    }

    document.getElementById("payment").onclick = function (){
        if((document.getElementById("etime").value - document.getElementById("stime").value) <= 0){
            if(confirm("Is the booking going into the next day, Past 24:00")){
                success(24);
            }else{
                document.getElementById("pay").value = "Error End Time is the Same Or before Start Time";
            }
        }else{
            success(0);
        }
    }

</script>

<?php 

if(isset($_POST['date'])){
    $state = "/^[0-9]{4}[.-]{1}[0-9]{2}[.-]{1}[0-9]{2}$/";
    if(preg_match($state, $_POST['date'])){
        echo "failed";
    }
    $pay = 7;
}

?>
