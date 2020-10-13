<!-- PHP login scipt for ADMIN_PANEL -->
<?php
            session_start();
            if(isset($_SESSION["isAdmin"])){
                if(!$_SESSION["isAdmin"])
                    header('Location: '."../../../?error=Please Log as Admin inorder to access!");
            }
            else{
                header('Location: '."../../../?error=Please Log as Admin inorder to access!");
            }   
?>
 <!-- End of login PHP script  -->


<?php 
   
    if(isset($_POST['product'])){
        $id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $author = $_POST['author'];
        if(isset($_POST['description']))
            $description = $_POST['description'];
        else
            $description = ' ';
        // $image = $_POST['image'];
        $category_id = $_POST['category_id'];

        include '../../../../connection/connect.php';

        // if(isset($_FILES['file'])){
            if(!empty($_FILES['file']['name'])){
            //file
                $file = $_FILES['file'];
                $file_name = $file['name'];
                $file_type = $file['type'];
                $file_size = $file['size'];
                $file_temp_loc = $file['tmp_name'];
                $file_store = "../../../../resources/images/".$file_name;

                move_uploaded_file($file_temp_loc,$file_store);

                echo 'xxxxxxxxxxxxx';
                $stmt = $conn->prepare("UPDATE `product` SET `name`=?,`price`=?,`author`=?,`description`=?,`image`=?,`category_id`=? WHERE `product_id`=?");
                $stmt->bind_param("sssssss", $name, $price, $author, $description, $file_name, $category_id, $id);
                // $sql = "UPDATE `product` SET `name`='$name',`price`=$price,`author`='$author',`description`='$description',`image`='$file_name',`category_id`='$category_id' WHERE `product_id` = $id";

        }
        else{
            echo 'yyyyyyyyyyyyyyyyy';
            $stmt = $conn->prepare("UPDATE `product` SET `name`=?,`price`=?,`author`=?,`description`=?, `category_id`=? WHERE `product_id` = ?");
            $stmt->bind_param("ssssss", $name, $price, $author, $description, $category_id, $id);
            // $sql = "UPDATE `product` SET `name`='$name',`price`=$price,`author`='$author',`description`='$description',`category_id`='$category_id' WHERE `product_id` = $id";
        }
        

        if($stmt->execute()){
        // if($conn->query($sql)){
            echo "category added!";
             header('Location:'."./?id=$id&message=Product updated Successfuly!");
        }
        else{
            echo "category not added!";
            header('Location:'."./?id=$id&error=Product updating failes is failed!");
        }
        
        $stmt->close();
        $conn->close();



    }


?>