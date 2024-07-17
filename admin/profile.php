<?php

   include '../components/connect.php'; 

   if (isset($_COOKIE['seller_id'])) {
      $seller_id = $_COOKIE['seller_id'];
   }else{
      $seller_id = '';
      header('Location:login.php');
   }

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id=?");
   $select_products->execute([$seller_id]);
   $total_products = $select_products->rowCount();

   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
   $select_orders->execute([$seller_id]);
   $total_orders = $select_orders->rowCount();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link href ='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
 <title>Admin - Dashboard</title>
</head>
<body>

      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>seller profile</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>profile</span>
    </div>
</div>

<section class="seller_profile">
    <div class="heading">
          <h1>seller profile</h1>
          <img src="../image/separator.png" width="100">
    </div>
    <div class="detail">
        <div class="seller">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span>seller</span>
            <a href="update.php" class="btn">update profile</a>
        </div>
        <div class="flex">
            <div class="box">
                <span><?= $total_products; ?></span>
                <p>total products</p>
                <a href="view_product.php" class="btn">view products</a>
            </div>
            <div class="box">
                <span><?= $total_orders; ?></span>
                <p>total orders placed</p>
                <a href="admin_order.php" class="btn">view orders</a>
            </div>
       </div>
</div>
</section>





      <?php include '../components/admin_footer.php'; ?>

         <!-- sweetalert cdn link -->   
         <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
          <!--custom js link --> 
        <script type="text/javascript" src="../js/admin_script.js"></script>
           <!-- alert -->
          
</body>
</html>

