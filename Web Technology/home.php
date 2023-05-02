<?php
    //start session
    session_start();
    include 'connection.php';

    // cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: welcome.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <title>WARTEG | Home</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .navbar-light .navbar-nav .nav-link {
            font: 300 22px/1.5rem Poppins, sans-serif;
            color: #1d1e3c;
            transition: 0.3s;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            font-weight: 600;
            color: #FF2442;
            transition: 0.3s;
        }

        .btn-fill {
            font: 600 18px/normal Poppins, sans-serif;
            background-color: #FFB830;
            border-radius: 12px;
            padding: 12px 32px;
            transition: 0.3s;
        }

        .btn-fill:hover {
            --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            transition: 0.3s;
        }

        .btn-grad {
            background-image: linear-gradient(to right, #F7971E, #FFD200 95%);
            padding: 10px 30px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            display: block;
            width: 75%;
            font-weight: 700;
            font-size: 24px;
            border-radius: 10px;
        }

        .btn-grad:focus {
            outline: none;
            box-shadow: none;
        }

        .fa {
            padding: 20px;
            font-size: 30px;
            width: 30px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 50%;
        }

        .fa:hover {
            color: black;
        }

        .footer {
            position: relative;
            bottom: 0;
        }

        .border-color {
            color: #c7c7c7;
        }

        .footer-link {
            color: #c7c7c7;
        }

        .footer-link:hover {
            color: #555252;
        }

        #dmd {
            font-weight: 700;
            text-align: justify;
            -webkit-transition: color 0.4s;
            transition: color 0.4s;
        }

        #dmd:hover {
            color: #FFD200
        }

        #livesearch {
            overflow-y: scroll;
            /* Add the ability to scroll */
            z-index: 9;
            position: absolute;
            background: white;
            margin-top: 37px;
            height: 150px;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #livesearch::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #livesearch {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        #livesearch2 {
            overflow-y: scroll;
            /* Add the ability to scroll */
            z-index: 9;
            position: absolute;
            background: white;
            margin-top: 37px;
            height: 150px;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #livesearch2::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #livesearch2 {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        #buttonSearch {
            background: linear-gradient(270deg, #0fd850 0%, #f9f047 100%);
        }

        #buttonSearchRestaurant {
            background: linear-gradient(to right, #f12711, #f5af19);
        }

        #searchIcon {
            filter: invert(99%) sepia(98%) saturate(0%) hue-rotate(198deg) brightness(107%) contrast(100%);
            width: 20px;
            height: 20px;
        }

        #inputSearchMenu:focus {
            outline: none;
            box-shadow: none;
            border-color: #c7c7c7;
        }

        #inputSearchRestaurant:focus {
            outline: none;
            box-shadow: none;
            border-color: #c7c7c7;
        }
    </style>

    <script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementById("livesearch").innerHTML = "";
                document.getElementById("livesearch").style.border = "0px";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("livesearch").innerHTML = this.responseText;
                    document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "livesearch.php?q=" + str, true);
            xmlhttp.send();
        }

        function showResult2(str) {
            if (str.length == 0) {
                document.getElementById("livesearch2").innerHTML = "";
                document.getElementById("livesearch2").style.border = "0px";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("livesearch2").innerHTML = this.responseText;
                    document.getElementById("livesearch2").style.border = "1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "livesearch2.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head> 

<body style="font-family: 'Poppins', sans-serif; font-size: larger">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Logo Brand -->
        <a class="navbar-brand" style="margin-right: 0.75rem" href="home.php">
            <img src="assets/logowarteg.png" width="200px">
        </a>

        <!-- Hamburger Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                <ul class="navbar-nav nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurants.php">Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promo.php">Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                </ul>
            </div>
            <div class="modal-footer border-0">
                <div class="dropdown">
                    <button class="btn btn-fill dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="assets/Logo profile.svg" width="20px"><?php echo"   "; echo htmlspecialchars($_SESSION["username"]); ?> 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a class="dropdown-item" href="ewallet.php">E-Wallet</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <br>

    <div class="container">
        <!-- Breadcrumbs -->
        <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="padding: 12px;">
                <li class="breadcrumb-item active" aria-current="page"><a href="home.php">Home</a></li>
            </ol>
        </nav> -->

        <!-- Jumbotron home -->
        <div class="jumbotron" style="background-image: url('assets/restJumbotron8.jpg');padding-top: 10%;
      padding-bottom: 10%;background-size:cover;">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1 style="font-size: 4.7vw;font-weight:600;color:white;outline-color:black">Welcome !</h1>
                    <p style="color:white">Enjoy an extensive selection of finest restaurants, top-quality dishes, and enticing deals. Just one click away.</p>
                </div>
            </div>
        </div>

        <!-- Search bar -->
        <div class="row">
            <!-- Search resto -->
            <div class="col-md-3 offset-md-6 col-sm-4">
                <div class="input-group mb-3">
                    <span><img src="assets/foodSearchLogo2.svg" style="width: 38px;height:38px">&nbsp;</span>
                    <input type="text" class="form-control" placeholder="Find eatery.." id="inputSearchRestaurant" onkeyup="showResult2(this.value)">
                    <div class="input-group-append">
                        <button class="btn" type="submit" id="buttonSearchRestaurant"><img src="assets/search icon.svg" id="searchIcon" class="img-fluid"></button>
                    </div>
                    <div id="livesearch2"></div>
                </div>
            </div>
            <!-- Search menu -->
            <div class="col-md-3 col-sm-4">
                <div class="input-group mb-3">
                    <span><img src="assets/restaurantSearchLogo.svg" style="width: 38px;height:38px">&nbsp;</span>
                    <input type="text" class="form-control" placeholder="Find menu.." id="inputSearchMenu" onkeyup="showResult(this.value)">
                    <div class="input-group-append">
                        <button class="btn" type="submit" id="buttonSearch"><img src="assets/search icon.svg" id="searchIcon" class="img-fluid"></button>
                    </div>
                    <div id="livesearch"></div>
                </div>
            </div>
        </div>
        <hr>
        <br>

        <!-- Carousel resto -->
        <div class="row">
            <div class="col-lg-4 align-self-center">
                <br>
                <h1 id="dmd">Daily-made delicacy.</h1>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <p>Indulge in the finest taste of your favorite international dishes.</p>
                <br>
                <a class="btn btn-grad btn-block" id="buttonLihatMenu" href="restaurants.php">Find eateries</a>
                <br>
            </div>
            <div class="col-lg-8">
                <div id="carouselMenuWarteg" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselMenuWarteg" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselMenuWarteg" data-slide-to="1"></li>
                        <li data-target="#carouselMenuWarteg" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/blackpaperchickrice.jpg" class="d-block w-100" alt="black pepper chicken rice.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Black Pepper Chicken Rice</h2>
                                <p>Fresh tender chicken topped with rich black pepper sauce.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/nasi ayam geprek.jpg" class="d-block w-100" alt="nasi ayam geprek.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Indonesian Style Sambal Glazed Over Crispy Chicken</h2>
                                <p>The crowd's pick for favorite Indonesian cuisine.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/whiskey.jpg" class="d-block w-100" alt="whiskey.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Whiskey</h2>
                                <p>Best selection of alcoholic drinks.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselMenuWarteg" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselMenuWarteg" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Carousel promo -->
        <div class="row" id="promo">
            <div class="col-lg-8">
                <div id="carouselPromo" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselPromo" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselPromo" data-slide-to="1"></li>
                        <li data-target="#carouselPromo" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/drinks.jpg" class="d-block w-100" alt="drinks.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Thirst No More</h2>
                                <p>Get 40% discount on beverages menu from any restaurant</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/food.jpg" class="d-block w-100" alt="food.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Japanese Cuisine Delight</h2>
                                <p>Enjoy 30% cashback on purchase of all your favorite Japanese dishes</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/delivery.jpg" class="d-block w-100" alt="delivery.jpg">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>No Delivery Fee November!</h2>
                                <p>Free delivery fee for a whole month from November 1st - November 30th 2021</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselPromo" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselPromo" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-4 align-self-center">
                <br>
                <h1 id="dmd">The best deals just for you.</h1>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <p>Check out all the available promotions.</p>
                <br>
                <a class="btn btn-grad btn-block" id="buttonLihatPromo" href="promo.php">Find deals</a>
                <br>
            </div>
        </div>
        <br>

    </div>


    <div class="container">
        <!-- Footer -->
        <div class="footer">
            <div class="border-color info-footer">
                <div class="">
                    <hr class="hr">
                </div>
                <div class="mx-auto d-flex flex-column flex-lg-row align-items-center footer-info-space gap-4">
                    <a href="https://facebook.com/" class="fa fa-facebook" style="color: #3B5998;"></a>
                    <a href="https://twitter.com" class="fa fa-twitter" style="color: #55ACEE;"></a>
                    <a href="https://instagram.com/" class="fa fa-instagram" style="color: #125688;"></a>
                    <a href="https://youtube.com/" class="fa fa-youtube" style="color: #bb0000;"></a>
                    <nav class="mx-auto d-flex flex-wrap align-items-center justify-content-center gap-4">
                        <a href="#" class="footer-link" style="text-decoration: none">Terms of Service</a>
                        <span>|</span>
                        <a href="#" class="footer-link" style="text-decoration: none">Privacy Policy</a>
                        <span>|</span>
                        <a href="#" class="footer-link" style="text-decoration: none">Licenses</a>
                    </nav>
                    <nav class="d-flex flex-lg-row flex-column align-items-center justify-content-center">
                        <p style="margin: 0">Copyright &copy; 2021 Warung Tegal</p>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</body>

</html>