<?php
//start session
session_start();

//cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: welcome.php");
//     exit;
// }
// require_once "connect-mysql.php";
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
            border-color: greenyellow;
        }

        #inputSearchRestaurant:focus {
            outline: none;
            box-shadow: none;
            border-color: orange;
        }

        #bintangRating {
            width: 45px;
            height: 45px;
            padding-bottom: 2px;
            margin-bottom: 5px;
        }

        #satu,
        #dua,
        #tiga,
        #empat,
        #lima {
            width: 1.25em;
            height: 1.25em;
        }

        #submitButton {
            display: block;
            padding: 10px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border-radius: 30px;
            font-weight: 700;
            background-image: linear-gradient(to left, #ffc312, #ff901f, #ffc312);
            width: 100%;
            height: 50px;
        }

        #submitButton:hover {
            background-position: right;
        }

        #submitButton:focus {
            outline: none;
            box-shadow: none;
        }

        input[type='radio']:after {
            width: 1.25em;
            height: 1.25em;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #d1d3d1;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        input[type='radio']:checked:after {
            width: 1.25em;
            height: 1.25em;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color:orange;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
    </style>

    <script>
        function submitRating() {
            var a = document.querySelector('input[name="ratingStar"]:checked').value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.replace('home.php');
                    window.alert('Terima kasih atas review Anda !');
                }
            };
            xmlhttp.open("GET", "insertRating.php?q=" + a, true);
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
                </ul>
            </div>
            <div class="modal-footer border-0">
                <a href="loginpage.php">
                    <button class="btn btn-fill text-white">Log In</button>
                </a>
            </div>
        </div>
    </nav>

    <br>

    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="padding: 12px;">
                <li class="breadcrumb-item active" aria-current="page"><a href="home.php">Home</a></li>
            </ol>
        </nav>

        <h1 class="text-center" style="font-weight:600;">-Rate your order-</h1>
        <br>
        <!-- Sistem rating -->
        <div class="row">
            <div class="col-lg-1" style="width: 12.499999995%;
    flex: 0 0 12.499%;max-width: 12.499%;"></div>
            <div class="col-lg-3 text-center">
                <input type="radio" id="lima" name="ratingStar" value="5">
                <label for="lima"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"></label><br>
            </div>

            <div class="col-lg-3 text-center">
                <input type="radio" id="empat" name="ratingStar" value="4">
                <label for="empat"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"></label><br>
            </div>

            <div class="col-lg-3 text-center">
                <input type="radio" id="tiga" name="ratingStar" value="3">
                <label for="tiga"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"></label><br>
            </div>
            <div class="col-lg-1" style="width: 12.499999995%;
    flex: 0 0 12.499%;max-width: 12.499%;"></div>

        </div>

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-2 text-center">
                <input type="radio" id="dua" name="ratingStar" value="2">
                <label for="dua"><img id="bintangRating" src="assets/ratingStar.svg"><img id="bintangRating" src="assets/ratingStar.svg"></label><br>
            </div>

            <div class="col-lg-2 text-center">
                <input type="radio" id="satu" name="ratingStar" value="1">
                <label for="satu"><img id="bintangRating" src="assets/ratingStar.svg"></label><br>
            </div>
            <div class="col-lg-4"></div>
        </div>

        <br>
        <div class="row">
            <div class="text-center col-lg-4 offset-lg-4">
                <button id="submitButton" class="btn" onclick="submitRating()">
                    SUBMIT
                </button>
            </div>
        </div>

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