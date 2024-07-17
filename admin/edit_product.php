<?php

   include '../components/connect.php'; 

   if (isset($_COOKIE['seller_id'])) {
      $seller_id = $_COOKIE['seller_id'];
   }else{
      $seller_id = '';
      header('Location:login.php');
   }
 
   //update product
   if (isset($_POST['update'])) {

       $product_id = $_POST['product_id'];
       $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);

       $price = $_POST['price'];
       $price = filter_var($price, FILTER_SANITIZE_STRING);

       $content = $_POST['content'];
       $content = filter_var($content, FILTER_SANITIZE_STRING);

       $stock = $_POST['stock'];
       $stock = filter_var($stock, FILTER_SANITIZE_STRING);

       $status = $_POST['status'];
       $status = filter_var($status, FILTER_SANITIZE_STRING);

       $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ?, stock = ?, status = ? WHERE id = ?");
       $update_product->execute([$name, $price, $content, $stock, $status, $product_id]);

       $success_msg[] = 'product updated!';

       $old_image = $_POST['old_image'];
       $image = $_FILES['image']['name'];
       $image_size = $_FILES['image']['size'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $image_folder = '../uploaded_files/'.$image;

       $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
       $select_image->execute([$image, $seller_id]);

       if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        }elseif($select_image->rowCount() > 0 AND $image != ''){
            $warning_msg[] = 'please rename your image';
        }else{
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $product_id]);

            move_uploaded_file($image_tmp_name, $image_folder);
            if ($old_image != $image AND $old_image != '') {
                unlink('../uploaded_files/'.$sold_image);
            }
            $success_msg[] = 'image updated';
        }
      }
   }
   
   //delete product
   if (isset($_POST['delete'])) {

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$product_id]);

    $success_msg[] = 'product deleted successfully';
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link href ='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
 <title>Floral Fantasia - flower website edit product page</title>
</head>
<body>

      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>edit product</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>edit product
       </span>
    </div>
</div>

<section class="post_editor">
    <div class="heading">
        <h1>edit product</h1>
        <img src="../image/separator.png">
    </div>    
    <div class="container">
        <?php
            $product_id = $_GET['id'];
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$product_id]);

            if ($select_product->rowCount() > 0) {
                while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){


            ?>  
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                    <div class="input-field">
                        <p>product status <span>*</span></p>
                        <select name="status" class="box">
                            <option selected value="<?= $fetch_product['status']; ?>"><?= $fetch_product['status']; ?></option>
                            <option value="active">active</option>
                            <option value="deactive">deactive</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <p>product name <span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_product['name']; ?>"  class="box">
                    </div>
                    <div class="input-field">
                        <p>product price <span>*</span></p>
                        <input type="number" name="price" value="<?= $fetch_product['price']; ?>"  class="box">
                    </div>
                    <div class="input-field">
                        <p>product description <span>*</span></p>
                        <textarea name="content" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                    </div>
                    <div class="input-field">
                        <p>total stock <span>*</span></p>
                        <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>"  class="box" maxlength="10" min="0" max="9999999999">
                    </div>
                    <div class="input-field">
                        <p>product image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                        <?php if($fetch_product['image'] != '') {?>
                             <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                        <?php } ?>
                    </div>
                    <div class="flex-btn">
                        <input type="submit" name="update" value="update product" class="btn">
                        <input type="submit" name="delete" value="delete product" class="btn" onclick="return confirm('delete this product');">
                    </div>
                </form> 
            </div>
            <?php
                 }
            }else{
                echo '
                <div class="empty" style="margin: 2rem>
                    <p>no products added yet! <br> <a href="add_product.php" class="btn" 
                    style="margin-top: 1rem;">add product</a></p>
                </div>

                ';

            }
            
            ?>
    </div>
</section>





      <?php include '../components/admin_footer.php'; ?>

         <!-- sweetalert cdn link -->   
         <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
          <!--custom js link --> 
        <script type="text/javascript" src="../js/admin_script.js"></script>
           <!-- alert -->

           <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Your SweetAlert invocation code here
    <?php
    if (isset ($success_msg)) {
        foreach ($success_msg as $success_msg) {
            echo 'swal("'.$success_msg.'", "", "success");';
        }
    }

    if (isset ($warning_msg)) {
        foreach ($warning_msg as $warning_msg) {
            echo 'swal("'.$warning_msg.'", "", "warning");';
        }
    }

    if (isset ($info_msg)) {
        foreach ($info_msg as $info_msg) {
            echo 'swal("'.$info_msg.'", "", "info");';
        }
    }

    if (isset ($error_msg)) {
        foreach ($error_msg as $error_msg) {
            echo 'swal("'.$error_msg.'", "", "error");';
        }
    }
    ?>
});

</script>
          
</body>
</html>

