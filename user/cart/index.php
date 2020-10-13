<!-- Cart page -->
<!-- not logging redirect script  -->
<?php
    session_start();

    if(!isset($_SESSION["isLogged"])){
        header('Location:'."../?error=Please Login first before go to cart!");
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Cart</title>
  </head>
  <body>
  <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../../">
                <img src="./images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                SCOTBOOKS
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link " href="../../">Home <span class="sr-only">(current)</span></a>
                    <!-- shop dropdown  -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../shop?category=all">All Products</a>
                        <?php
                            require '../../connection/connect.php';
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                            $conn->close();
                        ?> 
                        <?php if($result-> num_rows > 0): ?>
                          <?php while($row = $result->fetch_assoc()): ?>
                            <a class="dropdown-item" href="../shop?category=<?php
                                $url = $row['category_name'];    
                                echo urlencode($url); ?>"><?php echo $row['category_name']; ?></a>
                            <!-- <a class="dropdown-item" href="../shop?category=<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></a> -->
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </div>
                    </li>
                    <!-- shop dropdown End -->
                    <a class="nav-link active" href="../cart">Cart 
                    <span id="cart" class="badge badge-warning">
            <?php
                if(isset($_SESSION["isLogged"])){

                    $user = $_SESSION["userName"];

                    require "../../connection/connect.php";
                    $sql = "SELECT * FROM `cart` WHERE user_id='$user';";
                    $result = $conn->query($sql);
                    $count = $result->num_rows;
                    echo $count;
                    $conn->close();
                }
                else{
                    echo '0';
                }
            ?>
                    </span>
                    </a>
                    <a class="nav-link" href="../about">About</a>
                    <a class="nav-link" href="../contact">Contact us</a>
                    <?php if(!isset($_SESSION["isLogged"])): ?>
                       
                        <a class="nav-link" href="../">Login</a>
                    <?php endif; ?>

                    <?php if(isset($_SESSION["isLogged"])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION["userName"] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="../my-orders">My Orders</a>
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </div>
            </div>
            </nav>


            <?php

                require '../../connection/connect.php';
                $userId = $_SESSION["userName"];
                $total = 0;
                $sql = "SELECT * FROM  `cart` WHERE `user_id` = '$userId' ;";

                $result = $conn->query($sql);

            ?>

            <div class="col-md-6 offset-md-3">
                <?php if ($result->num_rows > 0): ?>

    <!-- clear cart  -->
                    <a href="./proccess.php?clearcart=true"><button class="btn btn-sm btn-outline-danger">Clear My Cart</button></a>
    <!-- table  -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <?php
                                        $productId = $row['product_id'];
                                        $sql1 = "SELECT * FROM `product` WHERE `product_id` = $productId;";
                                        $res = $conn->query($sql1);
                                        $product = $res->fetch_assoc();
                                    ?>
                                    <td><?php echo $product['name']; ?></td>
                                    <td>$ <?php echo $product['price']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td>$ <?php
                                        $price = $row['quantity']*$product['price'];
                                        $total = $total+$price;
                                        echo $price; ?></td>
                                </tr>
                    <?php endwhile; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Price:</b> </td>
                                    <td>$ <?php echo $total; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="../order?total=<?php echo $total; ?>" class="btn btn-sm btn-success">Proceed Order</a>
                        </div>
                <?php endif; ?>
    <?php $conn->close(); ?>

                <?php if ($result->num_rows == 0): ?>
                    <h3 class="text-center">Your Cart is empty!</h3>
                <?php endif; ?>
            </div>
            

        </div>

        <!-- custom scripts  -->
        <script src="./script.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>