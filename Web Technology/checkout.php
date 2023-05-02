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

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>WARTEG</title>

    <script>
        function showPromo(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "cekPromo.php?q=" + str, true);
                xmlhttp.send();
            }
        }

        function checkPayment(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "cekPayment.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
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

        tr {
            border-bottom: 1px solid #ddd;
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
                <li class="breadcrumb-item"><a href="restaurants.php"> Restaurants </a> </li>
                <li class="breadcrumb-item"><a href="cart.php"> Cart </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
    <hr>
    <div class="container">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>FREE DELIVERY!</strong> Khusus hari ini semua ongkos pengiriman pembelian produk WARTEG gratis.
        </div>


        <div class="container" style="background-color:orange; padding: 10px;border-radius: 6px;">
            <h2 class="mb-3" style="color:white ;text-align:center">Shipping Details</h2>
            <hr>
            <form action="order.php" method="POST">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Nama penerima</label>
                        <input name="name" type="text" class="form-control" placeholder="Bambang" required>
                        <!-- <div class="invalid-feedback">name is required.</div> -->
                    </div>
                    <div class="col-sm-6">
                        <label for="notelp" class="form-label">No Telp</label>
                        <input name="notelp" type="text" class="form-control" placeholder="0822222222" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="address" class="form-label"> Address </label>
                        <input name="address" type="text" class="form-control" placeholder="Jalan Siwalankerto No 12" required>
                    </div>
                </div>
                <br>
                <hr>
                <div class="container">
                    <h2 class="mb-3" style="color:white ;text-align:center">Payment Details</h2>
                    <hr>
                    <div class="row">
                        <table>
                            <?php
                            // Querry dari tabel menu
                            $sql = "SELECT * FROM cart";
                            $result = $conn->query($sql);
                            ?>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table" id="data">
                                        <tr>
                                            <th> Produk </th>
                                            <th> Jumlah </th>
                                            <th> Harga </th>
                                        </tr>

                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>'.$row["nama"].'</td>';
                                        echo '<td>'.$row["qty"]. '</td>';
                                        echo '<td>'.$row["harga"].'</td>';
                                        echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>

                                <p>Harga Total:
                                    <a name="grand_total"><?php echo $_SESSION['grand_total']; ?></a>
                                </p>

                                <br>

                                <label for="payment">Choose a method of payment:</label>
                                <select name="payment" id="payment" onchange="checkPayment(this.value)" style="border-radius:6px;">
                                    <option>--Select a Method of Payment--</option>
                                    <option value="cash">CASH</option>
                                    <option value="tegpay">TEGPAY</option>
                                </select>
                                <div class="row">
                                    <div class="col-12" id="TempatPromo">
                                        <br>
                                        <?php
                                        $sql = "SELECT * FROM promotions";
                                        $result = $conn->query($sql);
                                        ?>
                                        <label for="promo">Promo Available:</label>
                                        <select name="promo" id="promo" onchange="showPromo(this.value)" style="border-radius:6px;">
                                            <option>--Select a Promo--</option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option>' . $row["promotion_name"] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                        <div id="txtHint">
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <input type="submit" class="button btn-fill" value="Confirm" style="background-color: #FF2442;">
                                <!-- <input type="submit" class="btn btn-danger" value="entry"> -->
                            </div>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </div>
    <?php
    //    function promo($value,$harga){
    //        if $value = "TEGPAY"{

    //        }
    //        return $harga_final
    //    }
    ?>
    <br>
    <br>
    <!-- <div class="container" style="background-color:orange; padding: 10px;border-radius: 6px;">
                <div id ="deliveryDetails">
                    <h3>Delivery Cost</h3>
                    <p>Total Cost: </p>
                    <p>Delivery fee: Rp 0</p>

                    
                    </div>
                </div>
            </div> -->
    

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
</script>

</html>