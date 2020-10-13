<!-- PHP login scipt for ADMIN_PANEL -->
<?php
            session_start();
            if(isset($_SESSION["isAdmin"])){
                if(!$_SESSION["isAdmin"])
                    header('Location: '."../?error=Please Log as Admin inorder to access!");
            }
            else{
                header('Location: '."../?error=Please Log as Admin inorder to access!");
            }   
?>
<?php
    require "../../../connection/connect.php";

    if(isset($_GET['delete'])){
        $userId = $_GET['delete'];
        $sql = "DELETE FROM `user` WHERE `user_name`= '$userId';";
        $conn->query($sql);

        header('Location: '."./");
    }

    $conn->close();



?>