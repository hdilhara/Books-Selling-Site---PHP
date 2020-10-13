<?php

    if(isset($_GET['clearcart'])){
        session_start();
        require '../../connection/connect.php';
        $userId = $_SESSION['userName'];
        $sql = "DELETE FROM `cart` WHERE `user_id`= '$userId';";
        $conn -> query($sql);
        $conn->close();
        header('Location:'."./");
    }
    
    if(isset($_GET['clearcarthome'])){
        session_start();
        require '../../connection/connect.php';
        $userId = $_SESSION['userName'];
        $sql = "DELETE FROM `cart` WHERE `user_id`= '$userId';";
        $conn -> query($sql);
        $conn->close();
        header('Location:'."../../");
    }
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //       echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    //     }
    // }
    // else{

    // }
    // if(isset($_GET['remove'])){
    //     session_start();
    //     require '../../connection/connect.php';
    //     $userId = $_SESSION['userName'];
    //     $sql = "DELETE FROM `cart` WHERE `user_id`= '$userId';";
    //     $conn -> query($sql);
    //     $conn->close();
    //     header('Location:'."../../");
    // }
?>