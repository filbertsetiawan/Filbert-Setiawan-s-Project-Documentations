<?php
    //start session
    session_start();
    include 'connection.php';

    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
    if (!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true) {
        header("location: welcome.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <title>Backend | Home</title>

    </head>
    <body style="font-family: 'Poppins', sans-serif; font-size: 20px">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
            .sidebar {
                margin: 0;
                padding: 0;
                width: 300px;
                background-color: #FFEDDA;
                position: fixed;
                height: 100%;
                overflow: auto;
            }

            .sidebar a {
                display: block;
                color: black;
                padding: 16px;
                text-decoration: none;
            }
            
            .sidebar a.active {
                background-color: #8E806A;
                color: white;
            }

            .sidebar a:hover:not(.active) {
                background-color: #E6CCA9;
                color: black;
            }

            div.content {
                margin-left: 300px;
                padding: 1px 16px;
                height: 65px;
            }

            @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {float: left;}
            div.content {margin-left: 0;}
            }

            @media screen and (max-width: 400px) {
                .sidebar a {
                    text-align: center;
                    float: none;
                }
            }

            .dropdown-btn {
                padding: 16px 15px 16px 16px;
                text-decoration: none;
                color: black;
                display: block;
                border: none;
                background: none;
                width: 100%;
                text-align: left;
                cursor: pointer;
                outline: none;
            }

            .dropdown-btn:hover {
                background-color: #E6CCA9;
                color: black;
            }

            .dropdown-container {
                display: none;
                background-color: #D9CAB3;
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

            .card-title {
                font-weight: 600;
                -webkit-transition: color 0.2s;
                transition: color 0.2s;
            }

            .card {
                transition: transform .2s;
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

            #buttonSearch {
                background-image: linear-gradient(90deg, #0fd850 0%, #f9f047 100%);
            }

            #searchIcon {
                filter: invert(99%) sepia(98%) saturate(0%) hue-rotate(198deg) brightness(107%) contrast(100%);
                width: 20px;
                height: 20px;
            }

            #inputSearchMenu:focus {
                outline: none;
                box-shadow: none;
            }

            #ourMenu {
                font-weight: 500;
                font-size: 55px;
                border-bottom: 3px solid black;
                padding-bottom: 3px;
                -webkit-transition: color 0.4s;
                transition: color 0.4s;
            }

            #ourMenu:hover {
                color: red;
            }

            #addToCartButton:focus {
                outline: none;
                box-shadow: none;
            }

            #logoResto {
                width: 175px;
                height: 175px;
            }

            #ratingResto {
                float: right;
            }

            #hrRestName {
                border: 1.5px solid;
                border-radius: 10px;
                background: black;
            }

            #namaRestoran {
                font-weight: 600;
            }

            #logoInfoResto {
                width: 30px;
                height: 30px;
            }

            #contact {
                font-weight: 500;
                font-size: x-large;
            }

            #bintangRating {
                width: 25px;
                height: 25px;
                padding-bottom: 2px;
                margin-bottom: 5px;
            }

            #badgeCategory1 {
                float: left;
                border-radius: 20px;
                background: #FFB830;
            }

            #badgeCategory2 {
                float: left;
                margin-left: 10px;
                border-radius: 20px;

            }
        
        </style>
        
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <img src="assets/logowarteg.png" width="100%">
            <a href="backend.php" class="active" style="text-decoration: none;">Home</a>
            
            <button class="dropdown-btn">Menu<img src="assets/down-chevron-svgrepo-com.svg" width="20px" style="float: right; padding-top:6px;"></button>
            <div class="dropdown-container">
                <a href="insertmenu.php">Add new menu</a>
                <a href="updatemenu.php">Update menu</a>
                <a href="deletemenu.php">Delete menu</a>
            </div>

            <button class="dropdown-btn">Restaurants<img src="assets/down-chevron-svgrepo-com.svg" width="20px" style="float: right; padding-top:6px;"></button>
            <div class="dropdown-container">
                <a href="insertrestaurant.php">Add new restaurants</a>
                <a href="updaterestaurant.php">Update restaurants</a>
                <a href="deleterestaurant.php">Delete restaurants</a>
            </div>
            
            <br>
            <a href="logout.php" style="text-decoration: none;">Logout</a>
        </div>

        <!-- Content -->
        <div class="content" style="background-color: #3DB2FF; padding-top: 12px; padding-bottom: 8px;">
            <h1 style="font-family: 'Poppins', sans-serif; font-size: xx-large;"><b>HOME</b></h1>
            <br>
            
            <img src="assets/left-arrow-svgrepo-com.svg" width="20px" style="float: left; padding-top: 5px;"><a href="backend.php" style="text-decoration: none; color:black;">Back</a>

            <h1 style="text-align: center;"><span id="ourMenu"> &nbsp; M E N U &nbsp;</span></h1>
            <br>
                
            <div class="row">
                <?php
                $id = intval($_GET['id']);
                //query tabel menu 
                $sql = "SELECT * FROM menu WHERE restaurantID = $id";
                $result = $conn->query($sql); ?>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">';
                        echo '<div class="card h-100" id="menu">';
                        // Foto makanan
                        echo '<a href="#"><img class="card-img-top" src="assets/' . $row['img'] . '" alt=""></a>';
                        // Body kartu
                        echo '<div class="card-body">';
                        // Nama menu
                        echo '<h2 class="card-title" id="nama' . $row['id'] . '">' . $row['nama'] . '</h2>';
                        echo '<h5 class="card-title" id="namaLain' . $row['id'] . '">' . $row['namaLain'] . '</h5>';
                        // Harga menu
                        echo '<p id="hargaMenu' . $row['id'] . '">Rp ' . number_format($row['harga']) . '</p>';
                        // Kategori menu
                        echo '<small class="text-muted" id="kategoriMenu' . $row['id'] . '">' . $row['kategori'] . '</small>';
                        // Deskripsi menu
                        echo '<p id="deskripsiMenu">' . $row['deskripsi'] . '</p>';
                        echo '</div>';
                        // Closing div
                        echo '</div></div>';
                    }
                } ?>
            </div>    
        </div>

        <script>
            // loop dropdown 
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
    </body>
</html>
