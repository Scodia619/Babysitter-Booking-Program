<?php 

session_start();
require "configure.php";

?>

<html>
    <head>
        <title>Change Details</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <form class="createUser" action="changeDetails.php" method="post">
                <div class="form-group" id="createuser">
                    <label for="name">First Name:</label>
                    <input type="text" name="fname"class="form-control" id="fname" value='<?php echo $_SESSION["name"]?>'>
                    <label for="surname">Surname:</label>
                    <input type="text" name="sname" class="form-control" id="sname" value='<?php echo $_SESSION["sname"]?>'>
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="pnumber"class="form-control" id="pnumber" value='<?php echo $_SESSION["pnum"]?>'>
                    <label for="hnumber">House Number/Name:</label>
                    <input type="text" name="hnumber" class="form-control" id="hnumber" value='<?php echo $_SESSION["hnum"]?>'>
                    <label for="street">Street Name:</label>
                    <input type="text" name="street"class="form-control" id="street" value='<?php echo $_SESSION["street"]?>'>
                    <label for="Postcode">Postcode:</label>
                    <input type="text" name="pcode" class="form-control" id="pcode" value='<?php echo $_SESSION["pcode"]?>'>
                    <label for="Postcode">Password:</label>
                    <input type="text" name="pass" class="form-control" id="pcode" value='<?php echo $_SESSION["pass"]?>'>
                    <input type="submit" name="update" class="btn btn-primary" value="Update" id="userbtn"><br>
                    <input type="submit" name="back" class="btn btn-primary" value="Back" id="userbtn">
                </div>
        </form>
    </body>
</html>

<?php 

if(isset($_POST['back'])){

    header("Location: ../test/clientMenu.php");

}

if(isset($_POST['update'])){
    if(empty($_POST['fname'])){
        header("Location: ../test/changeDetails.php?No Firstname Given");
    }elseif(empty($_POST['sname'])){
        header("Location: ../test/changeDetails.php?No Surname Given");
    }elseif(empty($_POST['pnumber'])){
        header("Location: ../test/changeDetails.php?No Phone Number Given");
    }elseif(empty($_POST['hnumber'])){
        header("Location: ../test/changeDetails.php?No House Given");
    }elseif(empty($_POST['street'])){
        header("Location: ../test/changeDetails.php?No Street Name Given");
    }elseif(empty($_POST['pcode'])){
        header("Location: ../test/changeDetails.php?No Postcode Given");
    }elseif(empty($_POST['pass'])){
        header("Location: ../test/changeDetails.php?No Password Given");
    }else{
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $pnumber = $_POST['pnumber'];
        $hnumber = $_POST['hnumber'];
        $street = $_POST['street'];
        $pcode = $_POST['pcode'];
        $usr = $_SESSION['user'];
        $pass = $_POST['pass'];
        $sql = "UPDATE client SET Firstname = '$fname', Surname = '$sname', PhoneNumber = '$pnumber', House = '$hnumber', StreetName = '$street', Postcode = '$pcode', Pass = '$pass' WHERE Username = '$usr' AND Pass = '$pass'";
        $result = mysqli_query($db_handle, $sql);
        if($result){
            $_SESSION['name'] = $_POST['fname'];
            $_SESSION['sname'] = $_POST['sname'];
            $_SESSION['pnum'] = $_POST['pnumber'];
            $_SESSION['hnum'] = $_POST['hnumber'];
            $_SESSION['street'] = $_POST['street'];
            $_SESSION['pcode'] = $_POST['pcode'];
            $_SESSION['pass'] = $_POST['pass'];
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "failed";
        }
        }
    }

    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr";
      }

    set_error_handler("customError");

?>