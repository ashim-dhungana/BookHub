<?php
// Check if the URL path contains "/admin"
if ($_SERVER['REQUEST_URI'] === "/admin") {
    header("Location: ./src/Pages/admin.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "database123";
$database = "bookhub";
$conn;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub</title>

    <link rel="stylesheet" href="./web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/swiper-bundle.min.css">

    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.angularjswiki.com/fontawesome/fa-blog/">
    <link href="https://i.pinimg.com/736x/b2/38/01/b238018c0a4861898f3f44f78ce3eb2c.jpg" rel="icon" type="image/svg+xml">

</head>

<body>
    <!-- header sections starts -->

    <header class="header">

        <?php
        include('./src/Pages/header.php');

        // session_start();
        // session_unset();
        // session_destroy();
        ?>
        <div class="header-2">
            <nav class="navbar">
                <a href="src/Pages/welcome.php">Home</a>
                <a href="#featured">Featured</a>
                <a href="#reviews">Reviews</a>
                <a href="#about">About</a>
            </nav>
        </div>
    </header>

    <!-- header sections ends -->




    <!-- Login form starts -->

    <div class="form-container login-form-container">
        <div id="close-login-btn">&#10060;</div>
        <form action="./src/Utils/Login.php" method="post">
            <h3>Sign In</h3>
            <span>username</span>
            <input type="email" name="email" class="box" placeholder="enter your email" id="email">
            <span>password</span>
            <input type="password" name="password" class="box" placeholder="enter your password" id="password">
            <div class="checkbox">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember-me</label>
            </div>
            <input type="submit" value="sign in" class="btn">
            <p>don't have an account ?
                <a href="#signin-btn">create one</a>
            </p>
        </form>
    </div>
    <!-- Login form ends -->


    <!-- Sign-up form starts -->
    <div class="form-container signin-form-container">
        <div id="close-login-btn">&#10060;</div>
        <form action="./src/Utils/signup.php" method="post">
            <h3>Sign Up</h3>
            <span>Username</span>
            <input type="email" name="email" class="box" placeholder="Enter your email" id="email">
            <input type="text" name="fullName" class="box" placeholder="Enter your Full name" id="fullName">
            <span>Password</span>
            <input type="password" required name="password" class="box" placeholder="Enter your password" id="password">
            <input type="password" required name="cpassword" class="box" placeholder="Confirm your password" id="cpassword">
            <input type="submit" value="sign Up" class="btn">
            <p>
                <a href="#admin-signin-btn">Sign Up as Admin</a>
            </p>
        </form>
    </div>
    <!-- Sign-up form ends -->

    <!-- Sign-up form for admin starts -->
    <div class="form-container admin-signin-form-container">
        <div id="close-login-btn">&#10060;</div>
        <form action="./src/Utils/signup-admin.php" method="post">
            <h3>Sign Up</h3>

            <span>Username</span>
            <input type="email" name="email" class="box" placeholder="Enter your email" id="email">
            <input type="text" name="fullName" class="box" placeholder="Enter your Full name" id="fullName">

            <span>Admin code</span>
            <input type="text" name="code" class="box" placeholder="Secret code" id="code">

            <span>Password</span>
            <input type="password" required name="password" class="box" placeholder="Enter your password" id="password">
            <input type="password" required name="cpassword" class="box" placeholder="Confirm your password" id="cpassword">

            <input type="submit" value="sign Up" class="btn">
        </form>
    </div>
    <!-- Sign-up form for admin ends -->


    <!-- Home part starts -->

    <section class="home" id="home">
        <div class="row">
            <div class="content">
                <h3>Don't Miss Out!</h3>
                <p>Embark on a literary adventure with BookHub's festival! Dive into captivating stories, explore thrilling adventures, and uncover hidden gems at up to 75% off. Don't miss out - indulge in the magic of reading today!</p>


                <a href="./src/Pages/welcome.php" class="btn" style="color:inherit; color:white;">Shop now</a>
            </div>
            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/1.jpeg" alt=""></a>
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/2.jpeg" alt=""></a>
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/3.jpeg" alt=""></a>
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/4.jpeg" alt=""></a>
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/5.jpeg" alt=""></a>
                    <a href="./src/Pages/welcome.php" class="swiper-slide"><img src="Assets/6.jpeg" alt=""></a>
                </div>
                <img src="Assets/stand1.png" class="stand" alt="">
            </div>
        </div>
    </section>
    <!-- Home part ends -->

    <!-- icons sections starts -->

    <section class="icons-container">
    <div class="icons">
        <i class="fa fa-globe"></i>
        <div class="content">
            <h3>Easy Browsing</h3>
            <p>Discover a vast collection of books.</p>
        </div>
    </div>
    <div class="icons">
        <i class="fa fa-lock"></i>
        <div class="content">
            <h3>Secure payment</h3>
            <p>100% secure payment</p>
        </div>
    </div>
    <div class="icons">
        <i class="fa fa-download"></i>
        <div class="content">
            <h3>Easy download</h3>
            <p>PDF and EPUB</p>
        </div>
    </div>
    <div class="icons">
        <i class="fa fa-headphones"></i>
        <div class="content">
            <h3>24/7 hr</h3>
            <p>Call us anytime</p>
        </div>
    </div>
    <div class="icons">
        <i class="fa fa-book"></i>
        <div class="content">
            <h3>Wide Range of Genres</h3> <!-- Updated to represent various genres -->
            <p>Find your favorite genre</p>
        </div>
    </div>
</section>

    <!-- icons sections ends -->

    <!-- featured sections starts -->

    <section class="featured" id="featured">
        <h1 class="heading">
            <span>Featured books</span>
        </h1>
        <div class="swiper featured-slider">
                <div class="swiper-wrapper">

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/12.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h3>The five steps</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/13.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>Who stole my pension?</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/14.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h3>Rich Dad Poor Dad</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/15.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h3>The road to stoicism</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/16.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h3>The Hidden Hindu</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/17.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>The Power of Now</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/24.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>Hard Time</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/23.jfif" alt="">
                        </div>
                        <div class="content">
                            <h3>Memoir</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/22.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>Meditations</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <div class="image">
                            <img src="Assets/11.jpeg" alt="">
                        </div>
                        <div class="content">
                            <h3>The Alchemist</h3>
                            <a href="src/Pages/welcome.php" class="btn" style="text-decoration:none; color:white;">View</a>
                        </div>
                    </div>

                </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- featured sections ends -->

    <!-- review section -->
    <section class="reviews" id="reviews">
        <h1 class="heading"><span>Client's reviews</span></h1>

        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <img src="Images/People1.jpeg" alt="">
                    <h3>Ram Yadav</h3>
                    <p>
                        BookHub is a reader's paradise! The website's simplicity and efficiency make finding and purchasing books a breeze.
                    </p>

                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People2.jpeg" alt="">
                    <h3>John Deo</h3>
                    <p>
                        As a book lover, BookHub is my go-to. It's user-friendly interface and smooth navigation make browsing and buying books enjoyable.
                    </p>

                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People3.jpeg" alt="">
                    <h3>Kat Kristan</h3>
                    <p>
                        BookHub's streamlined layout makes it easy to discover new reads and quickly complete purchases. A must-visit for any bookworm!
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People4.jpeg" alt="">
                    <h3>Shyam Khadka</h3>
                    <p>
                        BookHub simplifies the book-buying process with its intuitive design. Finding my next read has never been easier!
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People5.jpeg" alt="">
                    <h3>Kristina Thapa</h3>
                    <p>
                        I love how effortless it is to explore BookHub's extensive collection. The website's efficiency ensures a stress-free book shopping experience every time.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People5.jpeg" alt="">
                    <h3>Ashika Dhungana</h3>
                    <p>
                        BookHub is a bookworm's dream come true! Its user-friendly platform makes browsing and purchasing books a delight.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="Images/People4.jpeg" alt="">
                    <h3>Radha Karki</h3>
                    <p>
                        Navigating BookHub is a pleasure, thanks to its efficient layout. Finding the perfect book is just a few clicks away!
                    </p>

                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="about">
        <div class="about-container">
            <h2>About</h2>
            <p>Welcome to BookHub, your premier destination for all things literary! At BookHub, we pride ourselves on providing a seamless and enjoyable experience for both book lovers and administrators alike.</p>
            <p>For our valued users, BookHub offers a curated collection of books spanning every genre imaginable. Our user-friendly interface makes browsing, searching, and purchasing your next favorite read a breeze. Whether you're seeking a timeless classic or the latest bestseller, BookHub has you covered.</p>
            <p>For administrators, managing our website is as effortless as turning a page. With intuitive tools and streamlined processes, you can easily update inventory, track sales, and engage with our vibrant community of book enthusiasts.</p>
            <p>Join us at BookHub, where the joy of reading meets the ease of technology. Let's embark on a literary journey together!</p>
        </div>
    </section>


    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Our locations</h3>
                <a href="#"><i class="fas fa-map-marker-alt"></i>Nepal</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>India</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>USA</a>
            </div>
            <img src="Assets/Map.jpeg" class="map" alt="">

            <div class="box" style="margin-left: 300px;">
                <h3>Contact Info</h3>
                <a href="#"><i class="fas fa-phone"></i>+9779824446666</a>
                <a href="#"><i class="fas fa-phone"></i>+9779823334444</a>
                <a href="#"><i class="fas fa-envelope"></i>bookhub@gmail.com</a>
            </div>

        </div>

        <div class="share" style="margin-top:50px;">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>

        <div class="credit">
            Created by <span> KCC - BIT V </span> | All rights reserved 2024-2025 ! </div>

    </section>

    <!-- Footer section ends -->

    <!-- Loader -->

    <div class="loader-container">
        <img src="Assets/loader-img.gif" alt="">
    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- custom js file link -->
    <script src="../js/script.js"></script>

</body>

</html>