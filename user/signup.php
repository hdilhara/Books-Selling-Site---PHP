<?php
    session_start();

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
    require "../connection/connect.php";

    $user = $_POST['userName'];
    $pass = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

   // $sql = "INSERT INTO `user`(`user_name`, `password`, `role`) VALUES ('$user','$pass','user')";
    $sql = "INSERT INTO `user` (`user_name`, `password`, `role`, `first_name`, `last_name`, `email`) VALUES ('$user', '$pass', 'user', '$firstName', '$lastName', '$email');";



    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $_SESSION["isLogged"] = true;
        $_SESSION["userName"] = $user;
        header('Location: '."../");
    } else {
        header('Location: '."./?error=User Already Exists!");
    }

    $conn->close();




?>