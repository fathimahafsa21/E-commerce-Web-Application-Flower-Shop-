<header class="header">
    <section class="flex">
    <div class= "logo">
    <a href="home.php"><img src="image/logo1.jpeg" width="60px" height="75px"></a>
        <span class="lspn1">FLORAL</span><span class="lspn2">FANTASIA</span>
</div>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about us</a>
            <a href="menu.php">shop</a>
            <a href="order.php">order</a>
            <a href="contact.php">contact</a>
        </nav>
        <form action="search_product.php" method="post" class="search-form">
           <input type="text" name="search_product" placeholder="search_product.." required maxlength="100">
           <button type="submit" class="bx bx-search-alt-2" name="search_product_btn"></button>
        </form>
        <div class="icons">
             <div id="menu-btn" class="bx bx-list-plus"></div>
             <div id="search-btn" class="bx bx-search-alt-2"></div>

             <?php 
                $count_wishlist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_item->execute([$user_id]);
                $total_wishlist_item = $count_wishlist_item->rowCount();

                ?>

             <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?= $total_wishlist_item ?></sup></a>

             <?php 
                $count_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_item->execute([$user_id]);
                $total_cart_item = $count_cart_item->rowCount();

                ?>

             <a href="cart.php" class="cart-btn"><i class="bx bx-cart"></i><sup><?= $total_cart_item ?></sup></a>
             <div class="bx bxs-user" id="user-btn"></div>
        </div>
        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);

                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

            ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
            <h3 style="margin-bottom: 1rem"><?= $fetch_profile['name']; ?></h3>
            <div class="flex-btn">
                <a href="profile.php" class="btn">view profile</a>
                <a href="components/user_logout.php" onclick="return confirm('logout from this wwebsite');" class="btn">logout</a>
            </div>
            <?php }else{ ?>
                <img src="image/user.jpg" alt="">
                <h3 style="margin-bottom: 1rem">please login or register</h3>
                <div class="flex-btn">
                     <a href="login.php" class="btn">login</a>
                     <a href="register.php" class="btn">register</a>
                </div>
            <?php } ?>
        </div>
    </section>
</header>