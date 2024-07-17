<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = '';
    }

    if (isset($_POST['send_message'])) {

        if ($user_id != '') {
            $id = unique_id();
    
            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
            $subject = $_POST['subject'];
            $subject = filter_var($subject, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $message = $_POST['message'];
            $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
            $verify_message->execute([$user_id, $name, $email, $subject, $message]);
    
            if ($verify_message->rowCount() > 0) {
                $warning_msg[] = 'Message already sent';
            } else {
                $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, subject, message) VALUES(?,?,?,?,?,?)");
                $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
                $success_msg[] = 'Message sent';
            }
    
        } else {
            $warning_msg[] = 'Please login first';
        }
    
    }
    

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- box icon cdn link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <title>Floral Fantasia - flower website contact page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>contact us</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi reprehenderit quos quaerat. Tenetur ipsam voluptatum hic, veniam delectus at laborum similique? Blanditiis, totam. Quo earum adipisci</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>contact</span>
        </div>
    </div>

    <div class="service">
        <div class="heading">
            <h1>our services</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci itaque enim mollitia porro
                <br>necessitatibus hic ducimus doloribus quidem, pariatur ad officia consectetur, est iste cumque</p>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/delivery.png" alt="">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
                </div>
            </div>
            <div class="box">
                <img src="image/return.png" alt="">
                <div>
                    <h1>money back guarentee</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
                </div>
            </div>
            <div class="box">
                <img src="image/discount.png" alt="">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
                </div>
            </div>
        </div>
    </div>

    <!-------------- service section end----------------->

    <div class="contact">
        <div class="heading">
            <h1>drop a line</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci itaque enim mollitia porro
                <br>necessitatibus hic ducimus doloribus quidem, pariatur ad officia consectetur, est iste cumque
                <p>
                    <img src="image/separator.png" alt="">
        </div>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="login">                
                <div class="input-field">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                        <p>subject <span>*</span></p>
                        <input type="text" name="subject" placeholder="enter the subject" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                        <p>message <span>*</span></p>
                        <textarea name="message" class="box"></textarea>
                </div>

                <button type="submit" name="send_message" class="btn">send message</button>
            </form>
        </div>
    </div>

    <!-------------- contact form section end----------------->

    <div class="address">
        <div class="heading">
                <h1>our contact details</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci itaque enim mollitia porro
                    <br>necessitatibus hic ducimus doloribus quidem, pariatur ad officia consectetur, est iste cumque</p>
                <img src="image/separator.png" alt="">
            </div>
           <div class="box-container">
                <div class="box">
                    <i class="bx bxs-map-alt"></i>
                    <div>
                        <h4>address</h4>
                        <p>1093 Marigold Lane, Coral Way <br>Miami, Florida, 33169</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-map-phone-incoming"></i>
                    <div>
                        <h4>phone number</h4>
                        <p>22123124512</p>
                        <p>23912495491</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-map-envelope"></i>
                    <div>
                        <h4>email</h4>
                        <p>hafsahndeen@gmail.com</p>
                        <p>hafsa@gmail.com</p>
                    </div>
                </div>
           </div> 

    </div>



    <?php include 'components/user_footer.php'; ?>
    <!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- sweetalert cdn link -->
<script type="text/javascript" src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>


       