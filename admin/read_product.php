<?php

include '../components/connect.php'; 

// Check if the seller_id cookie is set and retrieve its value, otherwise redirect to login
if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: login.php');
    exit;
}

// Get the post_id from the GET request
$get_id = $_GET['post_id'];

// Check if the delete form is submitted
if (isset($_POST['delete'])) {

    // Sanitize the product_id from POST request
    $p_id = filter_var($_POST['product_id'], FILTER_SANITIZE_STRING);

    // Prepare and execute the query to select the product
    $delete_image = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $delete_image->execute([$p_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    // Check if the image exists and delete it from the server
    if (!empty($fetch_delete_image['image'])) {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    // Prepare and execute the query to delete the product
    $delete_product = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_product->execute([$p_id]);

    // Redirect to view_products page after deletion
    header('Location: view_products.php');
    exit;
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
 <title>Floral Fantasia - flower website read product page</title>
</head>
<body>

      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>read product</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>read product
       </span>
    </div>
</div>

<section class="read_product">
    <div class="heading">
        <h1>product detail</h1>
        <img src="../image/separator.png">
    </div>    
    <div class="container">
        <?php
          $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
          $select_product->execute([$get_id]);

          if ($select_product->rowCount() > 0) {
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){

            
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

            <div class="status" style="color: <?php if($fetch_product['status']=='active'){echo
            "limegreen";}else{echo "red";} ?>"><?= $fetch_product['status']; ?></div>
            
            <?php if($fetch_product['image'] != ''){ ?>
                <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">
            <?php } ?>

            <div class="price">$<?= $fetch_product['price']; ?>/-</div>
            <div class="title"><?= $fetch_product['name']; ?></div>
            <div class="content"><?= $fetch_product['product_detail']; ?></div>
            <div class="flex-btn">
                <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                <a href="view_products.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
            </div>
        </form>
        <?php
              }
            }else{
                echo '
                <div class="empty">
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
          
</body>
</html>

