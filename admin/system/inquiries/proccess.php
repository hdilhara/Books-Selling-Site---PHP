<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        echo $id;
        require "../../../connection/connect.php";
        // $sql = "DELETE FROM `inquiry` WHERE `inquiry_id`=$id;";
        $stmt = $conn->prepare("DELETE FROM `inquiry` WHERE `inquiry_id`=?");
        $stmt->bind_param("s", $id);

        $stmt->execute();
        // $conn->query($sql);

        $stmt->close();
        $conn->close();

        header('Location: ./');
    }



?>