<?php
//start session
session_start();
    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
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
        <title>WARTEG | Top Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                clear: both;
                position: relative;
                height: 200px;
                margin-top: -200px;
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
                font-size: 35px;
            }
            
            .amount-box p {
                margin-top: 10px;
                margin-bottom: -10px;
            }
            
            .btn-group {
                margin: 20px 0;
            }
            
            .btn-group .btn {
                margin: 8px;
                border-radius: 20px !important;
                font-size: 12px;
            }
            
            .txn-list {
                background-color: #fff;
                padding: 12px 10px; 
                color: #777;
                font-size: 14px;
                margin: 7px 0;
            }
            
            .debit-amount {
                color: red;
                float: right;
            }
            
            .credit-amount {
                color: green;
                float: right;
            
            }
            
            

        
            input:invalid{
                background: pink;
            }
        
            .input-form{
                width:100%;
                background-color: #F9F9F9;
                padding:10px;
                border: none;
                border-radius: 5px;
            }
            .input-form-number{
                width:100%;
                background-color: #F9F9F9;
                padding:10px;
                border: none;
                border-radius: 5px;
            }
            .input-form-value{
                width:100%;
                background-color: #F9F9F9;
                padding:10px;
                border: none;
                border-radius: 5px;
            }
            .btn-form-change{
                color:white;
                background: #ff6868;
                font-weight: bold;
                border:none;
                border-radius:50px;
                padding:15px;
                margin:10px;
                width: 35%;
                float:left;
                margin-left: 20px;
                cursor: pointer;
            }
            .btn-form-pay{
                color:white;
                background: #68a2ff;
                font-weight: bold;
                border:none;
                border-radius:50px;
                padding:15px;
                margin:10px;
                width: 35%;
                float:right;
                cursor: pointer;
            }
            .btn-form-pay:hover{
                background:#66bef9;
            }
            .btn-form-change:hover{
                background: #fc7979;
            }
            table {
                margin-top: 5px;
                border-collapse: collapse;
                width: 100%;
                border: 1px solid #ddd;
            }
        </style>
    </head>
    <body style="font-family: 'Poppins', sans-serif; font-size: larger">
        <?php
            require_once "connection.php";
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
            
        <div class="container">
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="padding: 12px;">
                    <li class="breadcrumb-item "><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="ewallet.php">E-Wallet</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Top Up</li>
                </ol>
            </nav>
            <div>
                <p class = "mx-auto my-auto text-center" style=" font-weight:700; font-size: 3.7vw;">Top Up</p><br>
                <p required class="input-form">No Virtual Account: 124241531516</p>
                <form action="topup_show.php" method="post">
                    <input required class="input-form" type="number" name="topup" placeholder="Rp." id="topup">
                    <br><br>
                    <table  class="input-form" cellpadding="10">Pilih Metode Pembayaran
                        <tr>
                            <th><input type="radio" id="bni" name="bank" value="bni"><img src="assets/bni.png" width="60px" height="20px" for="bni"></th>
                            <th><input type="radio" id="bca" name="bank" value="bca"><img src="assets/logo-bca.png" width="60px" height="20px"for="bca"></th>
                            <th><input type="radio" id="bri" name="bank" value="bri"><img src="assets/bri.png" width="60px" height="20px"for="bri"></th>
                        </tr>
                        <tr>
                            <th><input type="radio" id="alfa" name="bank" value="alfa"><img src="assets/alfa.jpg" width="60px" height="20px"for="alfa"></th>
                            <th><input type="radio" id="indomaret" name="bank" value="indomaret"><img src="assets/indomaret.png" width="60px" height="20px"for="indomaret"></th>
                            <th><input type="radio" id="gopay" name="bank" value="gopay"><img src="assets/gopay.jpg" width="60px" height="20px"for="gopay"></th>
                        </tr>
                    </table>
                    <button class="btn-form-pay" type="submit" onclick="success()">Proceed</button>
                    <button class="btn-form-change" onclick="failed()">Cancel</button>
                </form>
            </div>
              
                <script>
                    function success() {
                        Swal.fire(
                            'Payment Success',
                            'Thankyou For Top Up!',
                            'success'
                        )
                    }
                    function failed() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Unsuccess',
                            text: 'Something went wrong!'
                        })
                    } 
                </script>
                <br><br><br><br><br><br><br>
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
        </div>
    </body>
</html>