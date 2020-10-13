<?php
    require "../../connection/connect.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO `inquiry` (`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$name, $email, $subject, $message);
    //$sql = "INSERT INTO `scotbooks`.`inquiry` (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message');";
    // $conn->query($sql);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: ./?message=Your inqueiry successfuly submitted!');
?>