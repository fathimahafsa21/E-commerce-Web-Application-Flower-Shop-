<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    include 'components/add_wishlist.php';
    include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- box icon cdn link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <title>Floral Fantasia - flower website home page</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

<!-------------- home slider section start----------------->
<div class="slider-container">
        <div class="container">
            <div class="slider-item active">
                <img src="image/slider.jpg">
            </div>
            <!-- <div class="slider-item">
                <img src="image/slider.jpg">
            </div>
            <div class="slider-item">
                <img src="image/slider1.png">
            </div>
            <div class="slider-item">
                <img src="image/slider1.jpg">
            </div>
            <div class="slider-item">
                <img src="image/slider2.jpg">
            </div>
        </div>
        <div class="left-arrow" id="prevSlide"><i class="bx bx-left-arrow-alt"></i></div>
        <div class="right-arrow" id="nextSlide"><i class="bx bx-right-arrow-alt"></i></div> -->
    </div>
    <!-------------- home slider section end----------------->

     <div class="services">
        <div class="box-container">
            <div class="box">
                <div class="icon">
                    <img src="image/service.png">
                </div>
                <div class="detail">
                    <h4>online shopping</h4>
                    <span>100% secure</span>
               </div> 
           </div>
           <div class="box">
                <div class="icon">
                    <img src="image/services2.png">
                </div>
                <div class="detail">
                    <h4>quality products</h4>
                    <span>100% secure</span>
               </div> 
           </div>
           <div class="box">
                <div class="icon">
                    <img src="image/services.png">
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>24 * 7 hours</span>
               </div> 
           </div>
           <div class="box">
                <div class="icon">
                    <img src="image/services0.png">
                </div>
                <div class="detail">
                    <h4>customer services</h4>
                    <span>support girt services</span>
               </div> 
           </div>
           <div class="box">
                <div class="icon">
                    <img src="image/service.png">
                </div>
                <div class="detail">
                    <h4>well organized</h4>
                    <span>24 * 7 free returns</span>
               </div> 
           </div>
           <div class="box">
                <div class="icon">
                    <img src="image/services1.png">
                </div>
                <div class="detail">
                    <h4>much more</h4>
                    <span>100% secure</span>
               </div> 
           </div>
       </div>
    </div>
    <!-------------- service section end----------------->
    <img src="image/sub-banner0.jpg" class="sub-banner">

    <div class="frame-container">
        <div class="box-container">
            <div class="frame">
                <div class="detail">
                    <span>shop seasonal</span>
                    <h2>50% off</h2>
                    <h1>all seasonal flowers</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <div class="box-detail">
                    <img src="image/frame.webp" class="img">
                    <div class="img-detail">
                        <span>wide range</span>
                        <h1>fresh organic flowers</h1>
                        <a href="menu.php" class="btn">shop now</a>
                   </div>
                </div>
                <div class="box-detail">
                    <img src="image/frame2.webp" class="img">
                    <div class="img-detail">
                        <span>wide range</span>
                        <h1>fresh organic flowers</h1>
                        <a href="menu.php" class="btn">shop now</a>
                   </div>
                </div>
           </div>
    </div>

   <!-------------- frame section end----------------->
   <div class="about-us">
     <div class="box-container">
        <div class="img-box">
            <img src="image/about.jpg" class="img">
            <img src="image/about0.jpg" class="img">
            <div class="play"><i class="bx bx-play"></i></div>
        </div>
        <div class="box">
            <div class="heading">
                <span>why choose us</span>
                <h1>why floral fantasia website</h1> 
                <img src="image/separator.png">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, doloremque provident, nisi quis nulla maiores, aut vero deserunt voluptate quaerat distinctio veritatis asperiores quidem corporis accusamus similique itaque eum corrupti.</p>
                <a href="about.php" class="btn">know more</a>
                <a href="contact.php" class="btn">contact us</a>
           </div>
      </div>
   </div>
  </div>

    <!-------------- about section end----------------->
    <div class="sub-banner">
        <div class="box-container">
            <img src="image/sub-banner.png">
            <img src="image/sub-banner.jpg" height="85%">
       </div>
    </div>
    <!-------------- sub-banner section end----------------->
    <div class="categories">
        <div class="heading">
            <h1>categories features</h1>
            <img src="image/separator.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/features.jpg">
                <div class="detail">
                    <span>fresh from farm</span>
                    <h1>bouquets</h1>
                    <a href="menu.php" class="btn">shop now</a>
               </div>
            </div>
            <div class="box">
                <img src="image/features1.jpg">
                <div class="detail">
                    <span>fresh from farm</span>
                    <h1>green plants</h1>
                    <a href="menu.php" class="btn">shop now</a>
               </div>
            </div>
            <div class="box">
                <img src="image/features0.jpg">
                <div class="detail">
                    <span>fresh from farm</span>
                    <h1>wedding bouquets</h1>
                    <a href="menu.php" class="btn">shop now</a>
               </div>
            </div>
            <div class="box">
                <img src="image/features.jpg">
                <div class="detail">
                    <span>fresh from farm</span>
                    <h1>green feijoas</h1>
                    <a href="menu.php" class="btn">shop now</a>
               </div>
            </div>
          </div>
      </div>
      <!-------------- categories section end----------------->
    <div class="sub-banner">
        <div class="box-container">
            <img src="image/slider3.png">
            <img src="image/slider4.png">
       </div>
    </div>
    <!-------------- sub-banner section end----------------->
    <div class="offer">
        <div class="heading">
            <span>fresh from farm</span>
            <h1>Buy any products from green organic @ get One free</h1>
            <img src="image/separator.png">
        </div>
        <div class="box-container">
            <div class="box">
                <div class="detail">
                    <h1>fresh tulips</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <img src="image/categories1.jpg">
            </div>
            <div class="box">
                <div class="detail">
                    <h1>fresh roses</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <img src="image/categories.jpg">
            </div>
            <div class="box">
                <div class="detail">
                    <h1>fresh sunflower</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <img src="image/categories2.jpg">
            </div>
            <div class="box">
                <div class="detail">
                    <h1>fresh levender</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <img src="image/categories3.webp">
            </div>
        </div>
    </div>
        <!-------------- offer section end----------------->
        <div class="offer-1">
            <div class="detail">
                <h1>special discount for all <br> flower products</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni quae labore esse. Explicabo dolor quas vitae laudantium impedit dolorem architecto pariatur voluptatum quia quo, maiores voluptatibus, cupiditate eum necessitatibus nostrum! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, harum! Soluta enim, esse voluptas harum fugiat placeat earum vero explicabo vitae necessitatibus architecto quas ipsam natus? Laudantium accusantium animi vitae!</p>
                <div class="container">
                    <div id="countdown" style="color:#fff;">
                <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>hour</li>
                    <li><span id="minutes"></span>minutes</li>
                    <li><span id="seconds"></span>seconds</li>
                </ul>
            </div>
        </div>
        <a href="menu.php" class="btn">buy now</a>
    </div>
</div>
        <!-------------- offer-1 section end----------------->
        <div class="products">
            <div class="heading">
                <h1>our latest products</h1>
                <img src="./image/separator.png" alt="">
            </div>
            <?php include 'components/shop.php';?>
        </div>
        
        <!-------------- products section end----------------->
        <div class="offer-2">
            <div class="detail">
                <h1>We pride Ourselves On <br> Exceptional flower design</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus maxime, quasi rerum pariatur recusandae quibusdam qui odio ex modi laborum, tempore amet adipisci, veritatis obcaecati iste doloremque beatae quae suscipit.
                Voluptatum, inventore, officiis culpa esse suscipit laboriosam aliquid explicabo harum, eum aut maiores porro distinctio? Dolor quod temporibus ratione. Corporis consequuntur corrupti non sequi esse fugiat laudantium, enim repudiandae amet.</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <!-------------- offer-2 section end----------------->
        <div class="gurantee">
            <div class="heading">
                <h1>our guarantee</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda omnis, aut unde provident corrupti illo, iure praesentium dolorum</p>
                <img src="./image/separator.png" alt="">
            </div>
            <div class="box-container">
            <div class="box">
                    <img src="./image/service0.jpg" style="height:18rem;">
                    <div class="detail">
                        <h1>events</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/service0.jpg" style="height:18rem;">
                    <div class="detail">
                        <h1>delivery</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/service0.jpg">
                    <div class="detail">
                        <h1>interior florist</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/service0.jpg">
                    <div class="detail">
                        <h1>exterior florist</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/service0.jpg">
                    <div class="detail">
                        <h1>hospitality</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/service0.jpg">
                    <div class="detail">
                        <h1>wedding planner</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum alias esse possimus est nam eligendi non iste, cumque, illum necessitatibus illo ullam dolores.</p>
                    </div>
                </div>
            </div>
        </div>




    <!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- sweetalert cdn link -->
<script type="text/javascript" src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>


       