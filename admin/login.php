<?php
    session_start();
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    echo "$userName $password"; 

    if($userName == "admin" && $password == "admin"){
        echo "Succesfuly Logged as admin!";
            $_SESSION["isAdmin"] = true;
             header('Location: '."./system");
    }else{
        echo "login failed!";
            header('Location: '."./?error=Login Failed!");
    }
?>
<html>
    <head>
    </head>
    <body>
        
    </body>
</html>