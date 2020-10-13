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
 <!-- End of login PHP script  -->

 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Products</title>

    <style>

      .back-button{
        margin: 25px 22px;
      }
    </style>
    
  </head>
  <body>
    <div class="container-fluid">
      <a href="../">
      <button class="btn btn-outline-dark btn-sm back-button">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-90deg-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M6.104 2.396a.5.5 0 0 1 0 .708L3.457 5.75l2.647 2.646a.5.5 0 1 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
            <path fill-rule="evenodd" d="M2.75 5.75a.5.5 0 0 1 .5-.5h6.5a2.5 2.5 0 0 1 2.5 2.5v5.5a.5.5 0 0 1-1 0v-5.5a1.5 1.5 0 0 0-1.5-1.5h-6.5a.5.5 0 0 1-.5-.5z"/>
          </svg>  
        Back
      </button>
      </a>
      <!-- display messages -->
      <?php if(isset($_GET['message'])):?>
        <div class="alert alert-success">
          <?php echo $_GET['message']; ?>
        </div>
      <?php endif ; ?>
      <!-- display error -->
      <?php if(isset($_GET['error'])):?>
        <div class="alert alert-danger">
          <?php echo $_GET['error']; ?>
        </div>
      <?php endif ; ?>

      <div >
        <a href="./index.php" class="btn btn-info" style="width:150px;">Manage <br> Products</a>
        <a href="./add-product.php" class="btn btn-success" style="width:150px;" >Add New Product</a>
      </div>
      

      <!-- add new category  -->
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="text-center">Add New Category</h4>
              <form  action="./proccess.php" method="post"> 
                <div class="form-group">
                  <label >Category</label>
                  <input  name="categoryname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" name="category" class="btn btn-success">Add Category</button>
              </form>
        </div>
      </div>

    <div class="col-md-6 offset-md-3">
    
<!-- data table -->
    <h3 class="text-center">Manage Categories</h3>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody>
        <!-- load Products  -->
        <?php
                        require '../../../connection/connect.php';
                        $sql = "SELECT * FROM category;";
                        $result = $conn->query($sql);
                        $conn->close();
        ?> 

        <?php if($result-> num_rows > 0): ?>
              <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?php  echo $row['category_name']; ?> </td>
                          <td>
                              <form action="./proccess.php" method="post">
                                <input name="deletecategory" type="text" value="<?php  echo $row['category_name']; ?>" hidden>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                               </form>
                          </td>
                        </tr>
              <?php endwhile; ?>
        <?php endif; ?>
  </tbody>
</table>
    </div>



    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>