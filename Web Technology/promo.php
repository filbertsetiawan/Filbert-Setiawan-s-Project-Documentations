<?php
    //start session
    session_start();
    include 'connection.php';
    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
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

    <title>WARTEG | Deals</title>

    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
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

        #jumbotron0 {
            transition: transform .2s;
            background: linear-gradient(to right, #ff00cc, #333399);
            color: white;
            border-radius: 30px;
            opacity: 0.9;
        }

        #jumbotron1 {
            transition: transform .2s;
            background: linear-gradient(to right, #fc00ff, #00dbde);
            color: white;
            border-radius: 30px;
            opacity: 0.9;
        }

        .special:hover {
            transform: scale(1.05);
        }

        .promo-title {
            font-size: 50px;
            font-weight: 700;
        }

        #buttonModalPromo {
            display: block;
            padding: 10px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border-radius: 10px;
            font-weight: 700;
            background-image: linear-gradient(to left, #ffc312, #ff901f, #ffc312);
            height: 60px;
            outline: none;
            width: 30%;
        }

        #buttonModalPromo:hover {
            background-position: right;
        }

        #buttonModalPromo:focus {
            outline: none;
            box-shadow: none;
        }

        #underline {
            border-bottom: 7px solid gold;
            border-radius: 10px;
            background: orange;
        }

        #underlineAtas{
            border-bottom: 7px solid red;
            border-radius: 10px;
            background: red;
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="padding: 12px;">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deals</li>
            </ol>
        </nav>

        <br>

        <!-- Jumbotron promo-->
        <div class="jumbotron" style="background-image: url('assets/promoJumbotron.jpg');padding-top: 5%;
      padding-bottom: 5%;background-size:cover;">
            <div class="row">
                <div class="col-6">
                    <h1 style="font-size: 4.2vw;font-weight:600;color:white;outline-color:black">Best deals.</h1>
                    <h5 style="color:white">Enjoy WARTEG's exclusive deals and offers while they last !</h5>
                </div>
            </div>
        </div>

        <!-- List promo -->
        <?php
        $sql = "SELECT * FROM promotions";
        $result = $conn->query($sql); ?>

        <?php
        if ($result->num_rows > 0) {
            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                if ($counter % 2 == 0) {
                    echo "<div class='jumbotron special' id='jumbotron0'>";
                } else {
                    echo "<div class='jumbotron special' id='jumbotron1'>";
                }
                echo "<h1 class = 'promo-title' id=promo" . $row['id'] . ">" . $row['promotion_name'] . "</h1>";
                echo '<div id="underline"></div>';
                echo "<p style='margin-top:15px'>" . $row['detail'] . "</p>";
                echo '<button type="button" class="btn" data-toggle="modal" data-target="#modalDetailPromo' . $row['id'] . '" id="buttonModalPromo">Click for details</button><br><div>';
                echo '<small style="float:left">*T&C apply</small><h5 style="float:right"> Exp. ' . $row['end_date'] . '</h5></div>';
                echo "</div>";
                // Modal T&C
                echo '<div class="modal fade" id="modalDetailPromo' . $row["id"] . '">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Terms & Conditions
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align: justify;">' . $row["terms"] . '

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Got it !</button>
                        </div>
                    </div>
                </div>
            </div>';
                $counter++;
            }
        } ?>
    </div>

</body>

</html>