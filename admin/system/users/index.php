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

    <title>ADMIN PANNEL</title>
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

<?php
      require "../../../connection/connect.php";

      $sql = "SELECT * FROM `user`;";
      $result = $conn->query($sql);

      $conn->close();
      // if ($result->num_rows > 0) {
      //   // output data of each row
      //   while($row = $result->fetch_assoc()) {
      //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      //   }
      // }
?>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">User Name</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
<?php if ($result->num_rows > 0): ?>
  <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <th scope="row"><?php  echo $row['user_name']; ?></th>
              <td><?php  echo $row['first_name']; ?></td>
              <td><?php  echo $row['last_name']; ?></td>
              <td><?php  echo $row['email']; ?></td>
              <td><a href="./proccess.php?delete=<?php  echo $row['user_name']; ?>" class="btn btn-sm btn-outline-danger">Remove User</a></td>
            </tr>
  <?php endwhile; ?>
<?php endif; ?>
          </tbody>
        </table>



      </div>

       



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>