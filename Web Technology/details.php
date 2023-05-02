<?php
include 'connection.php';
session_start();
// $_SESSION['id'] = $_GET['id'];
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

    <title>WARTEG</title>
</head>

<body style="font-family: 'Poppins', sans-serif; font-size: larger">
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
        .quantity{
            margin-right: 60px;
        }
        .quantity input{
            -webkit-appearance: none;
            border: none;
            text-align: center;
            width: 32px;
            font-size: 16px;
            color: #43484D;
            font-weight: 300;
        }
        .plus-btn{
            width: 30px;
            height: 30px;
            background-color: orange;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .minus-btn{
            width: 30px;
            height: 30px;
            background-color: orange;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .proceed-btn{
            text-align:center;
            width: 1000px;
            height: 40px;
            background-color: orange;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        /* button[class*=btn] {
            width: 30px;
            height: 30px;
            background-color: orange;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        } */
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

        #ourMenu:hover{
            color: red;
        }

        #addToCartButton {
            display: block;
            padding: 10px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border-radius: 5px;
            font-weight: 700;
            background-image: linear-gradient(to left, #ffc312, #ff901f, #ffc312);
            width: 100%;
        }

        #addToCartButton:hover {
            background-position: right;
        }

        #addToCartButton:focus {
            outline: none;
            box-shadow: none;
        }

        #prevNext {
            color: grey;
        }

        #prevNext:hover {
            color: orange;
            background: white;
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
                        <a class="nav-link" href="menu.php">Menu</a>
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
                <li class="breadcrumb-item active" aria-current="page">
                    <!-- Querry nama resto -->
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM restaurants WHERE restaurant_name ='{$_SESSION['rest_name']}'");
                    if (!mysqli_num_rows($sql) == 1) {
                        echo 'not found';
                    };
                    if (mysqli_num_rows($sql) == 1) {
                        $result = mysqli_fetch_assoc($sql);
                        echo $result['restaurant_name'];
                    } ?>
                </li>
            </ol>
        </nav>
        <br>

        <!-- ambil nama produk -->
        <?php 
        $simpan = $_GET['id'] ;
        $sqll= mysqli_query($conn, "SELECT * FROM menu WHERE id ='{$_GET['id']}'");
        $hasil = $sqll->fetch_assoc();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 ">
                    <?php
                    echo '<img width="500" height="400" src="assets/' . $hasil['img'] . '" alt="">';
                    ?>
                </div>
                <div class="col-xl-6 ">
                    <div class="row">
                        <?php
                        echo '<h2 style="color:red">'.$hasil['nama'].'</h2>';
                        echo '<h3>('.$hasil['namaLain'].')</h3>';
                        ?>
                    </div>
                    <div class = "row">
                        <?php
                        echo '<b style="color:orange"> by '.$_SESSION['rest_name']. '</b>';
                        ?>
                    </div>
                    <div class = "row">
                        <?php
                        echo '<p>'.$hasil['deskripsi']. '</p>';
                        ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 sm-6 xs-6">
                            <?php
                                echo '<h4>Rp. '.$hasil['harga'].'</h4>';
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 sm-6 xs-6">
                                
                            <form action="addToCart.php" method="get" id="formQty"></form>
                                <button type="button" class="plus-btn" onclick="plus()" type="button" name="button" id="plus" value="+" >
                                    +
                                </button>
                                <input form="formQty" type="text" class="form" style="text-align:center" value="1" min="0" size="1" name="qty" id="jumlah" class="teximput">
                                <input form="formQty" type="hidden" name="id" value=<?php echo $hasil['id']; ?>>
                                <button type="button" class="minus-btn" onclick="minus()" type="button" name="button" id="minus" value="-" >
                                    -
                                </button>
                            
                        </div>
                    </div>
                    <p>
                    
                    </p>
                    
                    <div class="row">
                        <button class="proceed-btn" form="formQty">Add to Cart</button>
                    </div>

                </div>
            </div>
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
<script>
    function plus(){
        var temp= Number($("#jumlah").val());
        var tot = Number(temp+1);
        document.getElementById("jumlah").value=tot;
        
    }
    function minus(){
        var temp= Number($("#jumlah").val());
        if (temp == 0){
            document.getElementById("jumlah").value=0;
        }
        else{
            var tot = Number(temp-1);
            document.getElementById("jumlah").value=tot;
        }
    }
</script>
</html>