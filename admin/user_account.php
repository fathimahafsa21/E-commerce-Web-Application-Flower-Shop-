<?php

   include '../components/connect.php'; 

   if (isset($_COOKIE['seller_id'])) {
      $seller_id = $_COOKIE['seller_id'];
   }else{
      $seller_id = '';
      header('Location:login.php');
   }

   //delete message from database

   if (isset($_POST['delete'])) {

       $delete_id = $_POST['delete_id'];
       $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

       $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
       $verify_delete->execute([$delete_id]);

       if ($verify_delete->rowCount() > 0) {

           $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
           $delete_message->execute([$delete_id]);

           $success_msg[] = 'message deleted';
       }else{
           $warning_msg[] = 'message already deleted';
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
 <title>Floral Fantasia - flower website registered user page</title>
</head>
<body>

      <?php include '../components/admin_header.php'; ?>
      <div class="banner">
         <div class="detail">
             <h1>registered user</h1>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <span> <a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>registered user
       </span>
    </div>
</div>

<section class="user-container">
    <div class="heading">
        <h1>registered user</h1>
        <img src="../image/separator.png">
    </div>  
    <div class="box-container">
        <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();

            if ($select_users->rowCount() > 0) {
                while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                    $user_id = $fetch_users['id'];
                
        ?>
        <div class="box">
            <img src="../uploaded_files/<?= $fetch_users['image']; ?>">
            <div class="detail">
                <p>user id : <span> <?= $user_id; ?></span></p>
                <p>user name : <span> <?= $fetch_users['name']; ?></span></p>
                <p>user email : <span> <?= $fetch_users['email']; ?></span></p>
            </div>
        </div>
        <?php
                }
            }else{
                echo '
                <div class="empty" style="margin: 2rem auto;">
                    <p>no user registered yet</p>
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
