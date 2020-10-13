<?php
    $isLogged = false;
    $isAdmin = false;
    // Start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    else{
        session_destroy();
        session_start();
    }

   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Login/Singnup</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
            .login-icon{
                width: 75px;
                margin-top: 55px;
            }
        </style>
    </head>
<body>
    <div class="container-fluid">  
        <!-- start nav  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../">
                <img src="../images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                SCOTBOOKS
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link " href="../">Home <span class="sr-only">(current)</span></a>
                    <!-- shop dropdown  -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./shop?category=all">All Products</a>
                        <?php
                            require '../connection/connect.php';
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                            $conn->close();
                        ?> 
                        <?php if($result-> num_rows > 0): ?>
                          <?php while($row = $result->fetch_assoc()): ?>
                            <a class="dropdown-item" href="./shop?category=<?php
                                $url = $row['category_name'];    
                                echo urlencode($url); ?>"><?php echo $row['category_name']; ?></a>
                            <!-- <a class="dropdown-item" href="./shop?category=<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></a> -->
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </div>
                    </li>
                    <!-- shop dropdown End -->

                    <!-- cart  -->
                    <a class="nav-link" href="./cart" id="cartLink" >Cart <span id="cart" class="badge badge-warning">
            <?php
                if(isset($_SESSION["isLogged"])){

                    $user = $_SESSION["userName"];

                    require "./connection/connect.php";
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

                    
                    <a class="nav-link" href="./about">About</a>
                    <a class="nav-link" href="./contact">Contact us</a>
                    <?php if(!isset($_SESSION["isLogged"])): ?>
                        <a class="nav-link active" href="./">Login</a>
                    <?php endif; ?>

                    <?php if(isset($_SESSION["isLogged"])): ?>
                        


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION["userName"] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </div>
            </div>
            </nav>
        <!-- end of nav  -->
        <div class="row">       
            <div class="col-md-6 offset-md-3">
                <?php
                     if(isset($_GET["error"])):?>
                        <div id="error" class="alert alert-danger text-center" role="alert"> 
                            <?php
                                echo $_GET["error"];
                            ?>
                        </div>
                        <?php endif; ?>
                <!-- login form  -->
                <div id="login">
                    <div class="text-center">
                        <h4>WELCOME TO SCOTBOOKS</h4>
                        <svg viewBox="0 0 16 16" class="bi bi-person-bounding-box login-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <h3>LOGIN</h3>
                    </div>
                    <form  action="./login.php" method="post"> 
                    <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input  name="userName" type="text" class="form-control" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div>
                            Create a new Account
                            <button class= "btn btn-outline-dark btn-sm" onClick="toggleLogin()">Create Account</button>
                    </div>

                </div>
                <!-- signup form  -->
                <div id="singup"  >
                        <div class="text-center">
                            <h4>WELCOME TO SCOTBOOKS</h4>
                            <svg viewBox="0 0 16 16" class="bi bi-person-bounding-box login-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <h3>SIGNUP</h3>
                        </div>
                        <form  action="./signup.php" method="post"> 

                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input  name="firstName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input  name="lastName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input  name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input  name="userName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input  name="password" type="password" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Signup</button>
                        </form>

                        <div>
                            Already Have An Account?
                            <button class= "btn btn-outline-dark btn-sm" onClick="toggleLogin()">Login</button>
                        </div>

                </div>

               
                


            </div>
        </div>
    </div>

    

    <!-- my custom script -->
    <script>
        var login = false;
        var x = document.getElementById("login");
        var y = document.getElementById("singup");

        x.style.display = "block";
        y.style.display = "none";


        function toggleLogin() {
            //  var x = document.getElementById("login");
            //  var y = document.getElementById("singup");
            if (login) {
                x.style.display = "block";
                y.style.display = "none";
                login = false;
            } else {
                y.style.display = "block";
                x.style.display = "none";
                login = true;
            }
        }
    </script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>