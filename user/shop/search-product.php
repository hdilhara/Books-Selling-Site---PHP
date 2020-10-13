<!-- Cart page -->
<!-- PHP login scipt for ADMIN_PANEL -->
<?php
            session_start();
            // if(isset($_SESSION["isLogged"])){
            //     echo "You already Logged";
            //     echo " Logged as ".$_SESSION["userName"];
            // }
            // else{
            //     echo "You are not Logged!";
            // }   
?>
 <!-- End of login PHP script  -->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>SCOTBOOKS</title>
    <style>
        .card-img-top:hover{
            width:99%;
        }
        .products{
            display: flex;
            flex-flow:wrap;
            justify-content:center;
            margin-top:35px;
        }
        .product{
            width:250px;
            padding:10px;
            margin:10px;
        }
        .search-box{
            width: 24%;
            display: inline-block;
        }
        .search-btn{
            margin-top: -4px;
            padding: 5px 12px;
        }
        //footer
        .about{
            max-width: 527px;
        }

        .socialicon:hover{
            padding: 1px;
        }

        .social-icons{
            margin-top: -7px;
        }
        .footer{
            margin-top:95px;
        }
    </style>
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
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    
                    <!-- cart  -->
                    <a class="nav-link" href="../cart" id="cartLink" >Cart <span id="cart" class="badge badge-warning">
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
                    </span></a>

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
            <!-- end of nav  -->

            <!-- back button  -->
            <a href="./" class="btn btn-outline-dark btn-sm">Back</a>

            <?php if(isset($_GET['category'])): ?>
                <div>
                    Category : <?php echo $_GET['category']; ?>
                </div>
            <?php endif; ?>
            <div class="text-center">
                <form action="search-product.php" method="post">
                    <input type="text" name="name" class="form-control search-box" placeholder="search item" required>
                    <button class="btn btn-info search-btn">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="products">
                    <?php
                            require '../../connection/connect.php';
                            $name = $_POST['name'];
                            // $sql = "SELECT * FROM product WHERE `name` LIKE '$name%' ;";

                            $stmt = $conn->prepare("SELECT * FROM product WHERE `name` LIKE ?");
                            $query = $name.'%';
                            $stmt->bind_param("s", $query );
                            $stmt->execute();
                            $result = $stmt->get_result();// $conn->query($sql); $result = $stmt->get_result();
                            $stmt->close();
                            $conn->close();
                    ?>
                    
                    <?php if($result-> num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="card text-center product" >
                            <a href="./view-product.php?id=<?php echo $row['product_id']; ?>" class="product-link"> 
                                <img src="../../resources/images/<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                            </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <hr>
                                    <p class="card-text">Author : <?php echo $row['author']; ?></p>
                                    <p class="card-text">Price : $ <?php echo $row['price']; ?></p>
                                    <!-- <button  class="btn btn-success" onClick="addToCart('<?php echo $row['product_id']; ?>')">Add to Cart</button> -->
                                    <?php if($row['in_stock']==1):  ?>
                                    <form action="./addCart.php?type=all" method="post">
                                        <input name="productId" type="number" value="<?php echo $row['product_id']; ?>" hidden>
                                        <button type="submit" class="btn btn-success" >Add to Cart</button>
                                    </form>
                                    <?php endif; ?>

                                    <?php if($row['in_stock']==0):  ?>
                                        <button type="submit" class="btn btn-info" disabled>Out of Stock!</button>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if($result-> num_rows == 0): ?>
                        <div>
                            <h4 class="text-center">
                            Your search item is not available!
                            </h4>
                        </div>
                    <?php endif; ?>
            </div>

                          <!-- footer  -->
         <div class=" footer">
                        <div class="row" style="background-color:  #4d0000;
    color: white;
    line-height: 77px;">
                            <div class="col-md-3" style=" line-height: 14px; font-size: 12px; padding-left: 73px;">
                        <?php
                            require '../../connection/connect.php';
                            $sql = "SELECT * FROM website_info ORDER BY  info_id  DESC LIMIT 1;";
                            $result = $conn->query($sql);
                            $conn->close();

                            $row = $result->fetch_assoc();
                        ?> 
                        <br>
                        <b><u>Contact Info</u></b><br>
                            <?php echo $row['phone']; ?>
                            <br>
                            <?php echo $row['address']; ?>
                            
                            </div>
                            <div class="col-md-4  text-center" style="line-height: 69px;">
                                <h6 style="line-height: 69px;">@ SCOTBOOKS 2020,</h6>
                            </div>
                            <div class="col-md-2 text-center" >
                                <h6 style="line-height: 69px;">FOLLOW US ON:</h6>
                            </div>
                            <div class="col-md-1 text-center social-icons">
                            <a href="https://www.facebook.com/scotbook.book.1" target="_blank">
                            <svg class="socialicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="35px" height="35px"><path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"/><path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"/></svg>
                            </a>
                            </div>
                            <div class="col-md-1 text-center social-icons">
                            <a href="https://www.instagram.com/scotbooks_BKStore/?hl=en" target="_blank">
                            <svg class="socialicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="35px" height="35px"><path fill="#304ffe" d="M32,42H16c-5.5,0-10-4.5-10-10V16c0-5.5,4.5-10,10-10h16c5.5,0,10,4.5,10,10v16 C42,37.5,37.5,42,32,42z"/><path fill="#304ffe" fill-opacity=".29" d="M6,16v16c0,5.5,4.5,10,10,10h16c5.5,0,10-4.5,10-10V16c0-1-0.1-1.9-0.4-2.8 C36,8.7,28.8,6,21,6c-3.7,0-7.3,0.6-10.7,1.8C7.7,9.6,6,12.6,6,16z"/><path fill="#6200ea" d="M21,8c-5,0-9.6,1.2-13.8,3.2C6.4,12.7,6,14.3,6,16v16c0,5.5,4.5,10,10,10h16c5.5,0,10-4.5,10-10 V16.2C36.5,11.1,29.1,8,21,8z"/><path fill="#673ab7" d="M42,19c-5.3-5.5-12.7-9-21-9c-5.4,0-10.5,1.5-14.8,4.1C6.1,14.7,6,15.3,6,16v16c0,5.5,4.5,10,10,10 h16c5.5,0,10-4.5,10-10V19z"/><path fill="#8e24aa" d="M42,22c-4.9-6.1-12.5-10-21-10c-5.6,0-10.7,1.7-15,4.6V32c0,5.5,4.5,10,10,10h16c5.5,0,10-4.5,10-10 V22z"/><path fill="#c2185b" d="M42,32v-6.6C37.5,18.6,29.8,14,21,14c-5.6,0-10.8,1.9-15,5v13c0,5.5,4.5,10,10,10h16 C37.5,42,42,37.5,42,32z"/><path fill="#d81b60" d="M42,32v-2.4C38.4,21.6,30.4,16,21,16c-5.7,0-11,2.1-15,5.6V32c0,5.5,4.5,10,10,10h16 C37.5,42,42,37.5,42,32z"/><path fill="#f50057" d="M41.6,34.8C39.7,25.2,31.2,18,21,18c-5.9,0-11.2,2.4-15,6.3V32c0,5.5,4.5,10,10,10h16 C36.5,42,40.4,39,41.6,34.8z"/><path fill="#ff1744" d="M39.9,38C39.4,28,31.2,20,21,20c-6.1,0-11.5,2.9-15,7.4V32c0,5.5,4.5,10,10,10h16 C35.2,42,38.1,40.4,39.9,38z"/><path fill="#ff5722" d="M21,22c-6.5,0-12.1,3.6-15,9v1c0,5.5,4.5,10,10,10h16c2.2,0,4.3-0.7,5.9-2c0-0.3,0.1-0.7,0.1-1 C38,29.6,30.4,22,21,22z"/><path fill="#ff6f00" d="M21,24c-7,0-12.8,4.7-14.5,11.2c1.3,4,5.1,6.8,9.5,6.8h16c1.4,0,2.6-0.3,3.8-0.8 c0.1-0.7,0.2-1.5,0.2-2.2C36,30.7,29.3,24,21,24z"/><path fill="#ff9800" d="M21,26c-6.9,0-12.5,5.3-12.9,12c1.8,2.4,4.7,4,7.9,4h16c0.6,0,1.1-0.1,1.7-0.2 C33.9,40.9,34,40,34,39C34,31.8,28.2,26,21,26z"/><path fill="#ffc107" d="M31.6,42c0.3-1,0.4-2,0.4-3c0-6.1-4.9-11-11-11s-11,4.9-11,11c0,0.3,0,0.7,0.1,1 c1.7,1.2,3.7,2,5.9,2H31.6z"/><path fill="#ffd54f" d="M21,30c-5,0-9,4-9,9c0,0.8,0.1,1.6,0.3,2.3c1.1,0.5,2.4,0.7,3.7,0.7h13.5c0.3-0.9,0.5-1.9,0.5-3 C30,34,26,30,21,30z"/><path fill="#ffe082" d="M21,32.1c-3.9,0-7,3.1-7,7c0,1,0.2,1.9,0.6,2.8C15.1,42,15.5,42,16,42h11.4c0.4-0.9,0.6-1.9,0.6-2.9 C28,35.2,24.9,32.1,21,32.1z"/><path fill="#ffecb3" d="M21,34.1c-2.8,0-5,2.2-5,5c0,1.1,0.4,2.1,1,2.9H25c0.6-0.8,1-1.8,1-2.9C26,36.3,23.8,34.1,21,34.1z"/><path fill="#fff" d="M30,38H18c-4.4,0-8-3.6-8-8V18c0-4.4,3.6-8,8-8h12c4.4,0,8,3.6,8,8v12C38,34.4,34.4,38,30,38z M18,12c-3.3,0-6,2.7-6,6v12c0,3.3,2.7,6,6,6h12c3.3,0,6-2.7,6-6V18c0-3.3-2.7-6-6-6H18z"/><path fill="#fff" d="M24 31c-3.9 0-7-3.1-7-7 0-3.9 3.1-7 7-7 3.9 0 7 3.1 7 7C31 27.9 27.9 31 24 31zM24 19c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5S26.8 19 24 19zM32 16c0 .6-.4 1-1 1s-1-.4-1-1 .4-1 1-1S32 15.4 32 16z"/></svg>
                            </a>
                            </div>
                            <div class="col-md-1 text-center social-icons">
                            <a href="https://twitter.com/ScotbooksB" target="_blank">
                            <svg class="socialicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="35px" height="35px"><path fill="#03A9F4" d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429"/></svg>
                            </a>
                            </div>
                        </div>
            </div>
            <!-- end footer  -->



        </div>


    <!-- my custom script  -->
    <script src="./script.js"> </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>