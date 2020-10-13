<?php
    $name = $_POST['name'];
    $address= $_POST['streetAddress1'].", ".$_POST['streetAddress2'].", ".$_POST['city'];
    $phone= $_POST['phone'];
    $payment= $_POST['payment'];
    $paymentMethod = $_POST['paymentMethod'];
    $user_id= $_POST['user_id'];


    require '../../connection/connect.php';
    $stmt = $conn->prepare("INSERT INTO `orders` (`name`, `Address`, `phone`, `payment`, `user_id`, `payment_method`) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $name, $address, $phone, $payment, $user_id, $paymentMethod);
    // $sql = "INSERT INTO `scotbooks`.`orders` (`name`, `Address`, `phone`, `payment`, `user_id`, `payment_method`) VALUES ('$name', '$address', '$phone', '$payment', '$user_id', '$paymentMethod');";

    

    // $conn->query($sql);
    $stmt->execute();
    $stmt->close();

    $sql = "SELECT * FROM `orders` ORDER BY order_id DESC limit 1;";
    $result1 = $conn->query($sql);
    $row = $result1->fetch_assoc();
    $orderId = $row['order_id'];

    $sql1 = "SELECT * FROM `cart` WHERE `user_id`='$user_id';";

    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
      $stmt2 = $conn->prepare("INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES (?,?,?)");
      $productId=0;
      $stmt2->bind_param("sss", $orderId, $productId, $quantity);
      // INSERT INTO `scotbooks`.`order_product` (`order_id`, `product_id`, `quantity`) VALUES ('3', '2', '5');
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $productId=$row['product_id'];
            $quantity=$row['quantity'];    
            // $sql2 = "INSERT INTO `scotbooks`.`order_product` (`order_id`, `product_id`, `quantity`) VALUES ('$orderId', '$productId', '$quantity');";
            $stmt2->execute();
        }
        $stmt2->close();
      }
    
    $conn->close();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Order Succed!</title>
    <style>
        .order-sccess{

        }
    </style>
  </head>
  <body>
    <div class="container">
        
        <div class="alert alert-success order-sccess">
            <b>Your Payment <?php echo $payment; ?> Succeed!</b>
            Your Order Procced Successfuly!
        </div>
    </div>

    
      <script>
          setTimeout(function(){ window.location.replace("../cart/proccess.php?clearcarthome=true"); }, 3000);
      </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>