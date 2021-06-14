<?php 

require 'configure.php';

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found){
    print "Database not Found";
}

$clients = array ();
$i = 0;

$SQL = "SELECT * FROM client";
$result = mysqli_query($db_handle, $SQL);

while ( $db_field = mysqli_fetch_assoc($result) ) {

    $var = array($db_field['Firstname'], $db_field['Surname'], $db_field['PhoneNumber'], $db_field['House'], $db_field['StreetName'], $db_field['Postcode']);
    array_push($clients, $var);

}

?>

<html>
    <head>
        <title>View Clients</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <form class="createUser" action="viewClients.php" method="post">
                <div class="form-group" id="createuser">
                    <label for="name">First Name:</label>
                    <input type="text" name="fname"class="form-control" id="fname" readonly>
                    <label for="surname">Surname:</label>
                    <input type="text" name="sname" class="form-control" id="sname" readonly>
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="pnumber"class="form-control" id="pnumber" readonly>
                    <label for="hnumber">House Number/Name:</label>
                    <input type="text" name="hnumber" class="form-control" id="hnumber" readonly>
                    <label for="street">Street Name:</label>
                    <input type="text" name="street"class="form-control" id="street" readonly>
                    <label for="Postcode">Postcode:</label>
                    <input type="text" name="pcode" class="form-control" id="pcode" readonly>
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
    console.log(data);

    function refresh(i){

        document.getElementById("fname").value = data[i][0];
        document.getElementById("sname").value = data[i][1];
        document.getElementById("pnumber").value = data[i][2];
        document.getElementById("hnumber").value = data[i][3];
        document.getElementById("street").value = data[i][4];
        document.getElementById("pcode").value = data[i][5];

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
        if(i==data.length-1){
            console.log("At Last");
        }else{
            i ++;
            refresh(i);
        }
    }

    document.getElementById("last").onclick = function (){
        i = (data.length-1);
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