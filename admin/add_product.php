<?php

   include '../components/connect.php'; 

   if (isset($_COOKIE['seller_id'])) {
      $seller_id = $_COOKIE['seller_id'];
   }else{
      $seller_id = '';
      header('Location:login.php');
   }

   if (isset($_POST['publish'])) {
    $id = unique_id();

    $name = $_POST['title'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'image name repeated';
        }elseif($image_size > 2000000){
            $warning_msg[] = 'image size is too large';
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }
    if ($select_image->rowCount() > 0 AND $image != '') {
        $warning_msg[] = 'please rename your image';
    }else{
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, 
           image, stock, product_detail, status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $content, $status]);

        $success_msg[] = 'product added successfully';
    }

  }

  //save product as draft
  if (isset($_POST['draft'])) {
    $id = unique_id();

    $name = $_POST['title'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'image name repeated';
        }elseif($image_size > 2000000){
            $warning_msg[] = 'image size is too large';
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }
    if ($select_image->rowCount() > 0 AND $image != '') {
        $warning_msg[] = 'please rename your image';
    }else{
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, 
           image, stock, product_detail, status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $content, $status]);

        $success_msg[] = 'product save as draft successfully';
    }

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
 <title>Floral Fantasia - flower website add products page</title>
</head>
<body>
   
      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>add product</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>add product</span>
    </div>
</div>
<section class="add-product">
    <div class="heading">
        <h1>add product</h1>
        <img src="../image/separator.png">
</div>
<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="register">
        <div class="input-field">
            <p>product name <span>*</span></p>
            <input type="text" name="title" maxlength="100" placeholder="add product title" required class="box">
        </div>
        <div class="input-field">
            <p>product price <span>*</span></p>
            <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box">
        </div>
        <div class="input-field">
            <p>product description <span>*</span></p>
            <textarea name="content" required maxlength="10000" placeholder="product description" class="box"></textarea>
        </div>
        <div class="input-field">
            <p>total stock <span>*</span></p>
            <input type="number" name="stock" maxlength="10" placeholder="total products available" min="0" max="9999999999" required class="box">
        </div>
        <div class="input-field">
            <p>product image <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
        </div>
        <div class="flex-btn">
            <input type="submit" name="publish"  value="publish now" class="btn">
            <input type="submit" name="draft" value="save draft"  class="btn">
       </div>
   </form>
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