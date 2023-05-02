<?php
if (isset($_GET['restName'])) {
    $_SESSION['rest_name'] = $_GET['restName'];
} elseif (isset($_GET['menuName'])) {
    $_SESSION['menu_name'] = $_GET['menuName'];
}
include 'connection.php';
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

    <title>WARTEG | Search result</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .navbar-light .navbar-nav .nav-link {
            font: 300 22px/1.5rem Poppins, sans-serif;
            color: #1d1e3c;
            transition: 0.3s;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            font: 600 22px/1.5rem Poppins, sans-serif;
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

        .card-title {
            font-weight: 600;
            -webkit-transition: color 0.2s;
            transition: color 0.2s;
        }

        .card {
            transition: transform .2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card:hover .card-title {
            color: red;
        }

        .page-item.active .page-link {
            color: #fff !important;
            background: #f00 !important;
            border-color: red;
        }

        .page-link {
            color: red;
            font-weight: 500;
        }

        .page-link:hover {
            color: white;
            background: red;
        }

        #logoResto {
            width: 150px;
            height: 150px;
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

        #logoInfoResto {
            width: 30px;
            height: 30px;
        }

        #hrRestName {
            border: 2.5px solid gold;
            background: gold;
        }

        #namaResto {
            font-weight: 600;
        }

        #brKhusus{
            display: block;
            margin-bottom: 0.5em;
        }

        #bintangRating {
            width: 35px;
            height: 35px;
            padding-bottom: 2px;
            margin-bottom: 5px;
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
                        <a class="nav-link" href="aboutus.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">Contact Us</a>
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
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="restaurants.php">Restaurants</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search :
                    <!-- Querry nama menu -->
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM menu WHERE nama ='{$_SESSION["menu_name"]}'");
                    if (!mysqli_num_rows($sql) == 1) {
                        echo 'not found';
                    };
                    if (mysqli_num_rows($sql) >= 1) {
                        $result = mysqli_fetch_assoc($sql);
                        echo $result['nama'];
                    } ?>
                </li>
            </ol>
        </nav>

        <!-- Search bar -->
        <div class="row">
            <!-- Search resto -->
            <div class="col-md-3 offset-md-6">
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
            <div class="col-md-3">
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

        <?php
        // Query dari tabel menu
        $sqlMenu = "SELECT * FROM menu WHERE nama LIKE '%{$_SESSION['menu_name']}%' ORDER BY restaurantID";
        $resultMenu = $conn->query($sqlMenu);
        if ($resultMenu->num_rows > 0) {
            $satu = 0;
            $printed = 0;
            $printedID = '';
            // Looping semua menu yang sesuai dengan pencarian
            while ($rowMenu = $resultMenu->fetch_assoc()) {
                // Query nama restonya utk dicetak, sesuai dengan restaurant ID milik menu
                $sqlRestoran = mysqli_query($conn, "SELECT * FROM restaurants WHERE id = '{$rowMenu["restaurantID"]}'");
                // Bila restoran not found
                if (!mysqli_num_rows($sqlRestoran) >= 1) {
                    echo 'not found';
                };
                // Bila restoran ditemukan
                if (mysqli_num_rows($sqlRestoran) >= 1) {
                    $resultRestoran = mysqli_fetch_assoc($sqlRestoran);
                    // Jika masih dari restoran yang sama, tidak perlu cetak nama restoran
                    if ($resultRestoran['id'] == $printedID) {
                        $printedID = $resultRestoran['id'];
                    }
                    // Jika belum dicetak / sudah beda restoran, cetak info restoran
                    elseif ($printed == 0 and $satu == 1) {
                        echo '</div><hr>';
                        echo '<div class="row">';
                        // Col 3 : logo resto
                        echo '<div class="col-lg-3 col-md-12 mx-auto my-auto text-center">';
                        echo '<img id="logoResto" src="assets/' . $resultRestoran["img"] . '">';
                        echo '</div>';
                        // Col 9 : info resto
                        echo '<div class="col-lg-9">';
                        echo '<div style="clear : both">';
                        echo '<h1 id="namaResto">' . $resultRestoran['restaurant_name'];
                        // Rating resto
                        echo '<span style="float:right">'; 
                        echo'<img id="bintangRating" src="assets/ratingStar.svg">&nbsp;'.$resultRestoran['rating'];
                        echo '</span></h1></div>';
                        // hr kuning
                        echo '<hr id="hrRestName">';
                        // Alamat resto
                        echo '<img id="logoInfoResto" src="assets/locationLogo2.svg">';
                        echo '<span>&nbsp; : &nbsp;';
                        echo '<a id="contact" href="' . $resultRestoran['link'] . '">';
                        echo '</span>';
                        echo $resultRestoran["street"] . ', ' . $resultRestoran["city"];
                        echo '</a>';
                        // New line
                        echo '<span id="brKhusus"></span>';
                        // Telpon resto
                        echo '<img id="logoInfoResto" src="assets/phoneLogo2.svg">';
                        echo '<span>&nbsp; : &nbsp;'; 
                        echo '<a id="contact" href="tel:' . $resultRestoran["phone"] . '">'; 
                        echo '</span>'; 
                        echo $resultRestoran["phone"];
                        echo '</a>'; 
                        // New line
                        echo '<span id="brKhusus"></span>';
                        // Jam buka resto
                        echo '<img id="logoInfoResto" src="assets/logoJamBuka.svg">';
                        echo '<span>&nbsp; : &nbsp;';
                        echo '<a id="badgeJamBuka"><span class="badge badge-success">&nbsp;' . $resultRestoran["open_time"] . '&nbsp;</span></a> - <a id="badgeJamTutup"><span class="badge badge-danger">&nbsp;' . $resultRestoran["close_time"] . '&nbsp;</span></a>';
                        echo '</span>';
                        echo '</div>';
                        echo '</div><hr><br>';
                        echo '<div class="row">';
                        $printedID = $resultRestoran['id'];
                    }
                    // Pencetakan baris pertama
                    else {
                        echo '<br><hr>';
                        echo '<div class="row">';
                        // Col 3 : logo resto
                        echo '<div class="col-lg-3 col-md-12 mx-auto my-auto text-center">';
                        echo '<img id="logoResto" src="assets/' . $resultRestoran["img"] . '">';
                        echo '</div>';
                        // Col 9 : info resto
                        echo '<div class="col-lg-9">';
                        echo '<div style="clear : both">';
                        echo '<h1 id="namaResto">' . $resultRestoran['restaurant_name'];
                        // Rating resto
                        echo '<span style="float:right">'; 
                        echo'<img id="bintangRating" src="assets/ratingStar.svg">&nbsp;'.$resultRestoran['rating'];
                        echo '</span></h1></div>';
                        // hr kuning
                        echo '<hr id="hrRestName">';
                        // Alamat resto
                        echo '<img id="logoInfoResto" src="assets/locationLogo2.svg">';
                        echo '<span>&nbsp; : &nbsp;';
                        echo '<a id="contact" href="' . $resultRestoran['link'] . '">';
                        echo '</span>';
                        echo $resultRestoran["street"] . ', ' . $resultRestoran["city"];
                        echo '</a>';
                        // New line
                        echo '<span id="brKhusus"></span>';
                        // Telpon resto
                        echo '<img id="logoInfoResto" src="assets/phoneLogo2.svg">';
                        echo '<span>&nbsp; : &nbsp;'; 
                        echo '<a id="contact" href="tel:' . $resultRestoran["phone"] . '">'; 
                        echo '</span>'; 
                        echo $resultRestoran["phone"];
                        echo '</a>'; 
                        // New line
                        echo '<span id="brKhusus"></span>';
                        // Jam buka resto
                        echo '<img id="logoInfoResto" src="assets/logoJamBuka.svg">';
                        echo '<span>&nbsp; : &nbsp;';
                        echo '<a id="badgeJamBuka"><span class="badge badge-success">&nbsp;' . $resultRestoran["open_time"] . '&nbsp;</span></a> - <a id="badgeJamTutup"><span class="badge badge-danger">&nbsp;' . $resultRestoran["close_time"] . '&nbsp;</span></a>';
                        echo '</span></div>';
                        echo '</div><hr><br>';
                        echo '<div class="row">';
                        $printedID = $resultRestoran['id'];
                        $satu = 1;
                    }
                }

                // Cetak menu
                echo '<div class="col-lg-4 col-md-6 mb-4">';
                echo '<div class="card h-100" id="menu">';
                // Foto makanan
                echo '<a href="#"><img class="card-img-top" src="assets/' . $rowMenu['img'] . '" alt=""></a>';
                // Body kartu
                echo '<div class="card-body">';
                // Nama menu
                echo '<h2 class="card-title" id="nama' . $rowMenu['id'] . '">' . $rowMenu['nama'] . '</h2>';
                echo '<h5 class="card-title" id="namaLain' . $rowMenu['id'] . '">' . $rowMenu['namaLain'] . '</h5>';
                // Harga menu
                echo '<p id="hargaMenu' . $rowMenu['id'] . '">Rp ' . number_format($rowMenu['harga']) . '</p>';
                // Kategori menu
                echo '<small class="text-muted" id="kategoriMenu' . $rowMenu['id'] . '">' . $rowMenu['kategori'] . '</small>';
                // Deskripsi menu
                echo '<p id="deskripsiMenu">' . $rowMenu['deskripsi'] . '</p><a type="button" class="stretched-link" href="menu.php?restName=' . $resultRestoran['restaurant_name'] . '"></a>';
                echo '</div>';
                // Closing div
                echo '</div></div>';
            }
        } ?>
    </div>

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
</body>

</html>