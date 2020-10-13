<?php
    session_start();
    $user = $_POST["userName"];
    $pass = $_POST["password"];

    echo "$user $pass";
 

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $database = "scotbooks";
    // $port = 3307;
    
    // // Create connection
    // $conn =  new mysqli($servername, $username, $password, $database, $port);
    
    // // Check connection
    // if ($conn->connect_error) {
    //   die("Connection failed: " . $conn->connect_error);
    // }
    // echo "Connected successfully";

    include '../connection/connect.php';

    $sql = "SELECT * FROM `user` WHERE user_name='$user' AND password='$pass'";

    $result = $conn->query($sql);
    $count=$result->num_rows;
    echo $count;

    if ($count > 0 ) {
        echo "logged";
        $_SESSION["isLogged"] = true;
        $_SESSION["userName"] = $user;
         header('Location: '."../");
    }
    else{
        echo "Login Failed!";
        header('Location: '."./?error=Login Failed!");
    }
?>
