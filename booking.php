<?php

session_start();
require "configure.php";
    
    $bookings = array ();

    $SQL = "SELECT bdate, TimeStart, TimeEnd FROM bookings";
    $result = mysqli_query($db_handle, $SQL);

    while ( $db_field = mysqli_fetch_assoc($result) ) {

        $var = array($db_field['bdate'], $db_field['TimeStart'], $db_field['TimeEnd']);
        array_push($bookings, $var);
}

if(isset($_POST['confirm'])){

    $client = $_SESSION['client_id'];
    $date = $_POST['date'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $pay = $_POST['pay'];

    if($_POST['pay'] == "" || strlen($_POST['pay'])  > 3){
        header("Location: ../test/booking.php?Booking Failed");
    }else{
        $sql = "INSERT INTO bookings (client_ID, babysitter_ID, bdate, TimeStart, TimeEnd, Pay) 
        VALUES ('$client', 1, '$date', '$stime', '$etime', '$pay')";
        if($result = mysqli_query($db_handle, $sql)){
            header("Location: ../test/booking.php?Booking Successful");
        }else{
            header("Location: ../test/booking.php?Failed to Save");
        }
    }
}

if(isset($_POST['back'])){
    header("Location: ../test/clientMenu.php");
}
?>

</html>

    <head>
        <title>Book a Babysitter</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <form class="createUser" action="booking.php" method="post">
                <div class="form-group" id="createuser">
                    <label for="name">Date: (YYYY-MM-DD)</label>
                    <input type="text" name="date"class="form-control" id="date">
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
    </body>

</html>

<script>

    var rate = 7;
    var pay = 0;
    var d = new Date();
    var y = d.getFullYear();
    var m = d.getMonth();
    var D = d.getDate();
    var re =  /^[0-9]{4}[.-]{1}[0-9]{2}[.-][0-9]{2}$/;

    var data = new Array();
    data = <?php echo json_encode($bookings)?>;
    var i = 0;
    var sameDate = new Array();
    var overlap = new Array();
    var tBook = 0;

    function success(extra) {

        var check = re.test(document.getElementById("date").value);
        var year = parseInt((document.getElementById("date").value).substring(0, 4));
        var days = parseInt((document.getElementById("date").value).substring(8, 10));

        tBook = 0;

        if(parseInt((document.getElementById("date").value).substring(5, 6)) == 0){
            var month = parseInt((document.getElementById("date").value).substring(6, 7));
        }else{
            var month = parseInt((document.getElementById("date").value).substring(5, 7));
        }

        if(!check){
            document.getElementById("pay").value = "Date not in correct format (YYYY-MM-DD)";
        }else{
            if(year >= parseInt(y)){
                if(month >= parseInt(m)+1 || year >= parseInt(y)){
                    if(days >= parseInt(D) || month >= parseInt(m)+1){

                        while(i < data.length){
                            if(document.getElementById("date").value == String(data[i][0])){
                                sameDate.push(data[i]);
                            }
                            i += 1;
                        }

                        i = 0;

                        while(i < sameDate.length){
                            console.log(sameDate[i]);
                            console.log(i)
                            //Checks if the start time is before that bookings start time
                            if(document.getElementById("stime").value <= parseInt(sameDate[i][1])){
                                if(document.getElementById("etime").value >= parseInt(sameDate[i][2])){
                                    console.log("End Time greater than end time of booking")
                                }
                                //Checks if the end time is less or equal to the start time
                                else if(document.getElementById("etime").value <= parseInt(sameDate[i][1])){
                                    console.log("True gay");
                                    tBook += 1;
                                }else{
                                    console.log("False end greater than start");
                                }
                            //Checks if the start time is after that bookings start time
                            }else if(document.getElementById("stime").value >= parseInt(sameDate[i][2])){
                                //Checks if the start time is greater or equal to the end time
                                if(document.getElementById("stime").value < parseInt(sameDate[i][2])){
                                    console.log("False start is less than end time");
                                }//Checks if the end time is bigger then existing booking end time
                                else if(document.getElementById("etime").value >= parseInt(sameDate[i][2])){
                                    console.log("True les");
                                    tBook += 1;
                                }else if(document.getElementById("etime").value < parseInt(sameDate[i][1])){
                                    console.log("True straight");
                                    tBook += 1;
                                }else{
                                    console.log("False im a gay");
                                }
                            }else{
                                console.log("False");
                            }
                            //Increments the i Counter Variable
                            i += 1;
                        }

                        if(tBook == sameDate.length){
                            pay = rate * (document.getElementById("etime").value - document.getElementById("stime").value + extra);
                            document.getElementById("pay").value = pay;
                        }else{
                            document.getElementById("pay").value = "Booking already taken";
                        }
                    }else{
                        document.getElementById("pay").value = "Day has already been";
                    }
                }else{
                    document.getElementById("pay").value = "Month has already been";
                }
            }else{
                document.getElementById("pay").value = "Year has already been";
            }
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
