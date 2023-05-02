<?php
//start session
session_start();
    include 'connection.php';

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: welcome.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>WARTEG | E-wallet</title>
	<link rel="stylesheet" href="E-wallet.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <style type="text/css">
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
    
    .wallet-container {
        background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(assets/wa);
            width: 320px;
            color: #fff;
            font-size: 15px;
            padding: 20px 20px 0;
            top: 55%;
            left: 50%;
            transform: translate(-50%,-50%);
            position: absolute;
      
      
    }
    
    .page-title {
        text-align: left;
    }
    
    .fa-user {
        float: right;
    }
    
    .fa-align-left {
        margin-right: 15px;
    }
    
    .amount-box img {
        width: 50px;
    }
    
    .amount {
        font-size: 30px;
    }
    
    .amount-box p {
        margin-top: 10px;
        margin-bottom: -10px;
    }
    
  
    </style>
</head>
<body style="font-family: 'Poppins', sans-serif; font-size: larger">
    <?php
        $kalimatquery ="SELECT saldo FROM customer WHERE id = {$_SESSION['id']}";
        $hasilquery=$conn->query ($kalimatquery);
        $result = mysqli_fetch_assoc($hasilquery);   
        $_SESSION["saldo"]=$result["saldo"];
    ?>
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="padding: 12px;">
                <li class="breadcrumb-item "><a href="topup.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">E-Wallet</li>
            </ol>
        </nav>
        <br>
        <div style="  text-align: center;">
            <img srcset="https://lh3.googleusercontent.com/ohLHGNvMvQjOcmRpL4rjS3YQlcpO0D_80jJpJ-QA7-fQln9p3n7BAnqu3mxQ6kI4Sw 3000w" >
            <br>
            <a style=" font-weight:700; font-size: 3.7vw;">Total Balance</a>
            <br>
            <a style="font-weight:500; font-size:3vw;">Rp. </a>
            <?php 
                echo"<a style='font-weight:500; font-size:3vw;'>".$_SESSION["saldo"]." </a>"
            ?>
            <br><br>
            <p>Not enough cash? <a href="topup.php">Top up now</a>.</p>
        </div>
           
    
    </div>
    <div class="container">
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
            <br>
        </div>
    </div>
</body>
</html>