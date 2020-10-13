<!-- Order Page  -->
<!-- not logging redirect script  -->
<?php
    session_start();

    if(!isset($_SESSION["isLogged"])){
        header('Location:'."../?error=Please Login first before go to cart!");
    }
    if(!isset($_GET["total"])){
      header('Location:'."../cart");
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

    <title>Order</title>
    <style>

      .back-button{
        margin: 25px 22px;
      }

      #paynow{
        padding:20px;
        background-color:rgb(255, 230, 230);
      }
      .order-btn{
        margin-bottom: 20px;
      }

    </style>
  </head>
  <body>
    
    <div class="container-fluid">
      <a href="../cart">
        <button class="btn btn-outline-dark back-button btn-sm">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-90deg-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M6.104 2.396a.5.5 0 0 1 0 .708L3.457 5.75l2.647 2.646a.5.5 0 1 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
              <path fill-rule="evenodd" d="M2.75 5.75a.5.5 0 0 1 .5-.5h6.5a2.5 2.5 0 0 1 2.5 2.5v5.5a.5.5 0 0 1-1 0v-5.5a1.5 1.5 0 0 0-1.5-1.5h-6.5a.5.5 0 0 1-.5-.5z"/>
            </svg>  
          Back
        </button>
        </a>

        <!-- dilivery details form  -->
        <div class="col-md-6 offset-md-3">
        <form action="./process.php" method="post" onsubmit="loading()">
                    <div class="text-center">
                     <h5> Add Delivery Details</h5>
                    </div>
                    <b>Name</b>
                    <div class="form-group">
                        <input  name="name" class="form-control" type="text" placeholder="Name" required>
                    </div>
                    <b>Address</b>
                    <div class="form-group">
                        <input  name="streetAddress1" class="form-control" type="text" placeholder="Street Address" required>
                    </div>
                    <div class="form-group">
                        <input  name="streetAddress2" class="form-control" type="text" placeholder="Street Address Line 2" required>
                    </div>
                    <div class="form-group">
                        <input  name="city" class="form-control" type="text" placeholder="City" required>
                    </div>
                    <b>Contact No</b>
                    <div class="form-group">
                        <input  name="phone" class="form-control" type="number" placeholder="Contact No"  required>
                    </div>
                <!-- payment details  -->
                    <div class="form-group">
                      <b>Pay on Delivery</b>
                        <input  name="paymentMethod" class="" type="radio" onclick="payment2()" value="0"  >
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <b>Pay Now</b>
                        <input   name="paymentMethod" class="" type="radio" onclick="payment1()" value="1" >
                    </div>

                    <div id="paynow" style="display:none;">
                        <div class="text-center">
                          <h3>Card Details</h3>
                        </div>
                     <b>Card Owner</b>
                          <div class="form-group">
                            <input  class="form-control" type="text" placeholder="Card owner name" >
                        </div>
                        <b>Card number</b>
                        <div class="form-group">
                            <input  class="form-control" type="text" placeholder="Valid card number" >
                        </div>
                        <b>Expiration Date & CVV</b>
                        <div class="form-group">
                            <input  class="form-control" type="text" placeholder="MM" style="display:inline; width:30%;" >
                            <input   class="form-control" type="text" placeholder="YY" style="display:inline; width:30%;" >
                            &nbsp;&nbsp; &nbsp;
                            <input   class="form-control" type="text" placeholder="CVV" style="display:inline; width:30%;" >
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <b>Total Payment : </b>$ <?php echo $_GET['total']; ?>
                        <!-- hidden input  -->
                        <input  name="payment" class="form-control" type="number" value= "<?php echo $_GET['total']; ?>" hidden>
                        <input type="text" name="user_id" value= "<?php echo $_SESSION['userName']; ?>" hidden >
                    </div>

                    <button type="submit" class="btn btn-success btn-sm order-btn" > Place Order </button>
        </form>
        </div>







    </div>
      
     


<script>
    function payment1(){
      document.getElementById('paynow').style.display = "block";
    }
    function payment2(){
      document.getElementById('paynow').style.display = "none";
    }

    function loading(){
      var currentTime = new Date().getTime();
      alert('Loading.....')
      while (currentTime + 5000 >= new Date().getTime()) {
      }
    }
</script>


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>