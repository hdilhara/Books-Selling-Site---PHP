<!-- PHP login scipt for ADMIN_PANEL -->
<?php
            session_start();
            if(isset($_SESSION["isAdmin"])){
                if(!$_SESSION["isAdmin"])
                    header('Location: '."../../?error=Please Log as Admin inorder to access!");
            }
            else{
                header('Location: '."../../?error=Please Log as Admin inorder to access!");
            }   
?>
 <!-- End of login PHP script  -->
 
<?php
    if(isset($_POST['category'])){

        include '../../../connection/connect.php';
        $categoryName = $_POST['categoryname'];
        $stmt = $conn->prepare("INSERT  INTO `category`(`category_name`) VALUES (?)");
        $stmt->bind_param("s", $categoryName);
        // $sql = "INSERT  INTO `category`(`category_name`) VALUES ('$categoryName')";

        // if($conn->query($sql)){
        if($stmt->execute()){
            echo "category added!";
        header('Location:'."./?message=Category Added Successfuly!");
        }
        else{
            header('Location:'."./?error=Category is Already Exists!");
        }
        $stmt->close();
        $conn->close();
    }
    if(isset($_POST['product'])){

        $name = $_POST['name'];
        $price = $_POST['price'];
        $author = $_POST['author'];
        if(isset($_POST['description']))
            $description = $_POST['description'];
        else
            $description = ' ';
        // $image = $_POST['image'];
        $category_id = $_POST['category_id'];


        //file
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
        $file_temp_loc = $file['tmp_name'];
        $file_store = "../../../resources/images/".$file_name;

        move_uploaded_file($file_temp_loc,$file_store);

        echo $file_name;

        include '../../../connection/connect.php';
        $categoryName = $_POST['categoryname'];

        $stmt = $conn->prepare("INSERT INTO `product` (`name`, `price`, `author`, `description`, `image`, `category_id`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $name, $price, $author, $description, $file_name, $category_id);
        // $sql = "INSERT INTO `product` (`name`, `price`, `author`, `description`, `image`, `category_id`) VALUES ('$name', '$price', '$author', '$description', '$file_name', '$category_id');";

        // if($conn->query($sql)){
        if($stmt->execute()){
            echo "category added!";
        header('Location:'."./add-product.php?message=Product Added Successfuly!");
        }
        else{
            header('Location:'."./?error=Product adding is failed!");
        }
        $stmt->close();
        $conn->close();



    }
    if(isset($_GET['delete'])){
        include '../../../connection/connect.php';
        $deleteProduct = $_GET['delete'];

        $stmt = $conn->prepare("DELETE FROM `product` WHERE (`product_id` = ?)");
        $stmt->bind_param("s", $deleteProduct);
        // $sql = "DELETE FROM `product` WHERE (`product_id` = '$deleteProduct');";

        // if($conn->query($sql)){
        if($stmt->execute()){
            echo "product deleted!";
        header('Location:'."./?message=Product Deleted Successfuly!");
        }
        else{
            header('Location:'."./?error=Product Deliting is failed!");
        }
        $stmt->close();
        $conn->close();
    }
    
    if(isset($_POST['deletecategory'])){
        include '../../../connection/connect.php';
        $deleteCategory = $_POST['deletecategory'];
        $stmt = $conn->prepare("DELETE FROM `category` WHERE `category_name` = ?");
        
        $stmt->bind_param("s", $deleteCategory);
        $sql = "DELETE FROM `category` WHERE (`category_name` = '$deleteCategory');";
        echo $sql;
        // DELETE FROM `category` WHERE (`category_name` = 'Foods & drinks');
        // if($conn->query($sql)){
        if($stmt->execute()){
            echo "product deleted!";
            header('Location:'."./categories.php?message=Category and related products Deleted Successfuly!");
        }
        else{
            header('Location:'."./categories.php?error=Category Deliting is failed!");
        }
        $stmt->close();
        $conn->close();
    }

    if(isset($_GET['outofstock'])){
        include '../../../connection/connect.php';
        $id = $_GET['outofstock'];
        $sql = "UPDATE `product` SET `in_stock` = '0' WHERE (`product_id` = ' $id');";
        if($conn->query($sql)){
            echo "product deleted!";
        header('Location:'."./?message=Product with $id is out-of Stock!");
        }
        else{
            header('Location:'."./?error=Operation failed failed!");
        }
        $conn->close();
    }
    if(isset($_GET['instock'])){
        include '../../../connection/connect.php';
        $id = $_GET['instock'];
        $sql = "UPDATE `product` SET `in_stock` = '1' WHERE (`product_id` = ' $id');";
        if($conn->query($sql)){
            echo "product deleted!";
        header('Location:'."./?message=Product with $id is in Stock!");
        }
        else{
            header('Location:'."./?error=Operation failed failed!");
        }
        $conn->close();
    }
?>