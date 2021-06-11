<?php 

require "configure.php";

$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

$database = "booking_app";

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found){
    print "Database not Found";
}

?>
<html>

<head>
    <title>Babysitting Booking Program</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form class="login" action="index.php" method="post">
        <div class="container">
            <div class="form-group">
                <label for="exampleInputEmail1">Username:</label>
                <input type="text" name="username"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password:</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <input type="submit" name="admin" class="btn btn-primary" value="Admin">
            <input type="submit" name="client" class="btn btn-primary" value="Client">
            <hr  size="5" width="90%" color="black">
            <input type="submit" name="createUser" class="btn btn-primary" value="Create New User">
        </div>
    </form>
</body>

<?php

if(isset($_POST["admin"])){
    $usr = $_POST['username'];
    $pass = $_POST['pass'];
    print $usr;
    $sql = "SELECT * FROM babysitter WHERE Username='$usr' and Pass='$pass'";
    $result = mysqli_query($db_handle, $sql);
    $result = mysqli_query($db_handle, $sql);
    if(!$result || mysqli_num_rows($result) == 0){
        header("Location: ../test/index.php?User not found");
    }else{
        header("Location: ../test/adminMenu.php");
    }
}

if(isset($_POST["client"])){
    $usr = $_POST['username'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM client WHERE Username='$usr' and Pass='$pass'";
    $result = mysqli_query($db_handle, $sql);
    if(!$result || mysqli_num_rows($result) == 0){
        header("Location: ../test/index.php?User not found");
    }else{
        header("Location: ../test/clientMenu.php");
    }
}

if(isset($_POST['createUser'])){
    header("Location: ../test/createUser.php");
}

?>

</html>

<?php

mysqli_close($db_handle);

?>