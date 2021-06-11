<?php 

require "configure.php";

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found){
    print "Database not Found";
}

?>

<html>

<head>
    <title>Create a User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form class="createUser" action="createUser.php" method="post">
            <div class="form-group" id="createuser">
                <label for="name">First Name:</label>
                <input type="text" name="fname"class="form-control" id="fname" aria-describedby="emailHelp" placeholder="First Name">
                <label for="surname">Surname:</label>
                <input type="text" name="sname" class="form-control" id="sname" placeholder="Surname">
                <label for="phone">Phone Number:</label>
                <input type="text" name="pnumber"class="form-control" id="pnumber" aria-describedby="emailHelp" placeholder="Phone Number">
                <label for="hnumber">House Number/Name:</label>
                <input type="text" name="hnumber" class="form-control" id="hnumber" placeholder="House">
                <label for="street">Street Name:</label>
                <input type="text" name="street"class="form-control" id="street" aria-describedby="emailHelp" placeholder="Street Name">
                <label for="Postcode">Postcode:</label>
                <input type="text" name="pcode" class="form-control" id="pcode" placeholder="Postcode">
                <label for="exampleInputEmail1">Username:</label>
                <input type="text" name="username"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <label for="exampleInputPassword1">Password:</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                <input type="submit" name="createUser" class="btn btn-primary" value="Create New User" id="userbtn">
            </div>
    </form>
</body>

</html>

<?php

if(isset($_POST['createUser'])){
    if(empty($_POST['fname'])){
        header("Location: ../test/createUser.php?No Firstname Given");
    }elseif(empty($_POST['sname'])){
        header("Location: ../test/createUser.php?No Surname Given");
    }elseif(empty($_POST['pnumber'])){
        header("Location: ../test/createUser.php?No Phone Number Given");
    }elseif(empty($_POST['hnumber'])){
        header("Location: ../test/createUser.php?No House Given");
    }elseif(empty($_POST['street'])){
        header("Location: ../test/createUser.php?No Street Name Given");
    }elseif(empty($_POST['pcode'])){
        header("Location: ../test/createUser.php?No Postcode Given");
    }elseif(empty($_POST['username'])){
        header("Location: ../test/createUser.php?No Username Given");
    }elseif(empty($_POST['pass'])){
        header("Location: ../test/createUser.php?No Password Given");
    }else{
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $pnumber = $_POST['pnumber'];
        $hnumber = $_POST['hnumber'];
        $street = $_POST['street'];
        $pcode = $_POST['pcode'];
        $usr = $_POST['username'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM client WHERE Username='$usr'";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result) == 1){
            header("Location: ../test/createUser.php?Username Taken");
        }else{
            $sql = "INSERT INTO client (Firstname, Surname, PhoneNumber, House, StreetName, Postcode, Username, Pass)
                VALUES ('$fname', '$sname', '$pnumber', '$hnumber', '$street', '$pcode', '$usr', '$pass')";
            if($result = mysqli_query($db_handle, $sql)){
                header("Location: ../test/index.php");
            }else{
                echo "<h3>Saving Failed</h3>";
            }
        }
    }
}

mysqli_close($db_handle);

?>