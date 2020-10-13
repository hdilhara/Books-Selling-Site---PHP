<!-- not logging redirect script  -->
<?php
    session_start();

    if(!isset($_SESSION["isLogged"])){
        header('Location:'."../?error=Please Login first before add products to cart!");
    }
?>


 <!-- php script add cart items  -->
<?php
if(isset($_GET['type'])){
    $type = $_GET['type'];

}else{
    $type=all;
}
    
    require '../../connection/connect.php';

    $productId = $_POST['productId'];
    $userId = $_SESSION['userName'];

    if(isset($_SESSION['userName'])){
            $sql = "SELECT * FROM cart WHERE user_id = '$userId'  AND product_id = '$productId' ;";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $quantity = $row['quantity']+1;
            $sql1 = "UPDATE `cart` SET `quantity` = '$quantity' WHERE (`user_id` = '$userId') and (`product_id` = '$productId');";
            $conn -> query($sql1);
            echo $quantity;
            }
            header('Location:'."./?category=$type&addquantity=true");
        }
        else{
            $sql1 = "INSERT INTO `cart` (`user_id`, `product_id`, `quantity`) VALUES ('$userId', '$productId', '1');";
            $conn -> query($sql1);
            header('Location:'."./?category=$type&addcart=true");
        }
    }
    else{
        header('Location:'."../?error=Please Login before add product to cart!");
    }

    $conn->close();

?>