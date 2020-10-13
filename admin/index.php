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
        <title>Admin Panel Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
<body>
    <div class="container-fluid">        
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
                
                <div class="text-center">
                    <h4>Welcome To Admin-Panel</h4>
                    <h3>LOGIN</h3>
                </div>

                <form  action="./login.php" method="post"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input  name="userName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- my custom script -->
    <script>

    </script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>