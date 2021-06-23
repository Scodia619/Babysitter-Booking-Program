<?php 

session_start();

require 'configure.php';

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found){
    print "Database not Found";
}

$clients = array ();
$id = $_SESSION['babysitter_id'];
$i = 0;
$date = date("Y-m-j");

$SQL = "SELECT * FROM bookings WHERE babysitter_ID = '$id' ORDER BY bdate, TimeStart ASC";
$result = mysqli_query($db_handle, $SQL);

while ( $db_field = mysqli_fetch_assoc($result) ) {

    $var = array($db_field['bdate'], $db_field['TimeStart'], $db_field['TimeEnd'], $db_field['Pay']);
    array_push($clients, $var);

}

?>

<html>
    <head>
        <title>See Bookings</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <form class="createUser" action="seeBookingAdmin.php" method="post">
                <div class="form-group" id="createuser">
                    <label for="name">Date - YYYY-MM-DD:</label>
                    <input type="text" name="date"class="form-control" id="date" readonly>
                    <label for="surname">Start Time - 24hr:</label>
                    <input type="text" name="stime" class="form-control" id="stime" readonly>
                    <label for="phone">End Time - 24hr:</label>
                    <input type="text" name="etime"class="form-control" id="etime" readonly>
                    <label for="hnumber">Pay (£):</label>
                    <input type="text" name="pay" class="form-control" id="pay" readonly>
                    <button type="button" name="first" class="btn btn-primary" id="first"><<</button>
                    <button type="button" name="prev" class="btn btn-primary" id="prev"><</button>
                    <button type="button" name="next" class="btn btn-primary" id="next">></button>
                    <button type="button" name="last" class="btn btn-primary" id="last">>></button></br>
                    <input type="submit" name="back" class="btn btn-primary" value="Back" id="userbtn">
                </div>
        </form>
    </body>
</html>


<script tpye="text/javascript">

    var data = new Array();
    data = <?php echo json_encode($clients)?>;
    var i = 0;

    var d = new Date();
    var y = d.getFullYear();
    var m = d.getMonth() + 1;
    var D = d.getDate();

    if(m.length = 1){
        var string = y + "-0" + m + "-" + D;
    }else{
        var string = y + "-" + m + "-" + D;
    }
    console.log(string);

    var aDate = new Array();

    i = 0;

    while (i < data.length){
        if(data[i][0] >= string){
            aDate.push(data[i]);
        }
        i ++;
    }

    i = 0;

    function refresh(i){

        document.getElementById("date").value = aDate[i][0];
        document.getElementById("stime").value = aDate[i][1];
        document.getElementById("etime").value = aDate[i][2];
        document.getElementById("pay").value = aDate[i][3];

    }

    document.getElementById("first").onclick = function (){
        i = 0;
        refresh(i);
    }

    document.getElementById("prev").onclick = function (){
        if(i==0){
            console.log("At first");
        }else{
            i --;
            refresh(i);
        }
    }

    document.getElementById("next").onclick = function (){
        if(i==aDate.length-1){
            console.log("At Last");
        }else{
            i ++;
            refresh(i);
        }
    }

    document.getElementById("last").onclick = function (){
        i = (aDate.length-1);
        refresh(i);
    }

    refresh(i);

</script>

<?php 

if(isset($_POST['back'])){
    header("Location: ../test/adminMenu.php");
}

mysqli_close($db_handle);

?>