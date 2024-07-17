<?php

   include '../components/connect.php'; 

   if (isset($_COOKIE['seller_id'])) {
      $seller_id = $_COOKIE['seller_id'];
   }else{
      $seller_id = '';
      header('Location:login.php');
   }
 
  //update payment status from database
  if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_pay->execute([$update_payment, $order_id]);

    $success_msg[] = 'order payment_status updated';
  }

   //delete order from database

   if (isset($_POST['delete_order'])) {
    $delete_id = $_POST['order_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_id]);

        $success_msg[] = 'order deleted';
    }else{
        $warning_msg[] = 'order already deleted';
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
 <title>Floral Fantasia - flower website user orders page</title>
</head>
<body>

      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>orders detail</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>orders detail
       </span>
    </div>
</div>

<section class="order-container">
    <div class="heading">
        <h1>total orders placed</h1>
        <img src="../image/separator.png">
    </div>    
    <div class="box-container">
         <?php
           $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
           $select_order->execute([$seller_id]);

           if ($select_order->rowCount() > 0) {
            while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
  

         ?>
         <div class="box">
            <div class="status" style="color: <?php if($fetch_order['status']=='in progress'){
                echo "limegreen";}else{echo "red";} ?>"><?= $fetch_order['status']; ?></div>
                <div class="detail">
                    <p>user name : <span><?= $fetch_order['name']; ?></span></p>
                    <p>user id : <span><?= $fetch_order['user_id']; ?></span></p>
                    <p>placed on : <span><?= $fetch_order['date']; ?></span></p>
                    <p>number : <span><?= $fetch_order['number']; ?></span></p>
                    <p>email : <span><?= $fetch_order['email']; ?></span></p>
                    <p>total price : <span><?= $fetch_order['price']; ?></span></p>
                    <p>payment method : <span><?= $fetch_order['method']; ?></span></p>
                    <p>address : <span><?= $fetch_order['address']; ?></span></p>
            </div>
            <form action="" method="post">
                 <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                 <select name="update_payment" class="box" style="width=90%;">
                    <option disabled selected><?= $fetch_order['payment_status']; ?></option>
                    <option value="pending">Pending</option>
                    <option value="complete">complete</option>
                 </select>
                 <div class="flex-btn">
                    <button type="submit" name="update_order" class="btn">update payment</button>
                    <button type="submit" name="delete_order" class="btn">delete order</button>
                    
                </div>
            </form>
         </div>
         <?php
               }
            }else{
                echo '
                <div class="empty" style="margin: 2rem auto;">
                    <p>no order take placed yet</p>
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

