<?php
    // $servername = "localhost";
    // $username = "hdilhara_hdilharadb";
    // $password = "123456789";
    // $database = "hdilhara_hdilharadb";
    // $port = 3306;
    
    // // Create connection
    // $conn =  new mysqli($servername, $username, $password, $database, $port);
    
    // // Check connection
    // if ($conn->connect_error) {
    //   die("Connection failed: " . $conn->connect_error);
    // }
    //echo "Connected successfully";

?>


<!-- local server config  -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "scotbooks";
    $port = 3307;
    
    // Create connection
    $conn =  new mysqli($servername, $username, $password, $database, $port);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
?>