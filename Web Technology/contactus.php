<?php
//start session
session_start();
    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: welcome.php");
        exit;
    }
?>
<html>
    <head>
        <title>WARTEG | Contact Us</title>        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link rel="stylesheet" type="text/css" href="https://bilba.go-jek.com/dist/styles/bin/pure-min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        
        <title>WARTEG | Contact Us</title>
        
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
                /* background-color: #FF2442; */
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
            .map-container{
                overflow:hidden;
                padding-bottom:56.25%;
                position:relative;
                height:0;
            }
            .map-container iframe{
                left:0;
                top:0;
                height:100%;
                width:100%;
                position:absolute;
            }
            .form__group {
                position: relative;
                padding: 15px 0 0;
                margin-top: 10px;
                width: 100%;
            }

            .form__field {
            font-family: inherit;
            width: 100%;
            border: 0;
            border-bottom: 2px solid #9b9b9b;
            outline: 0;
            font-size: 1.3rem;
            color: #fff;
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;
            }
            .form__field::placeholder {
            color: transparent;
            }
            .form__field:placeholder-shown ~ .form__label {
            font-size: 1.3rem;
            cursor: text;
            top: 20px;
            }

            .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #9b9b9b;
            }

            .form__field:focus {
            padding-bottom: 6px;
            font-weight: 700;
            border-width: 3px;
            border-image: linear-gradient(to right, #FF2442, #FFB830);
            border-image-slice: 1;
            }
            .form__field:focus ~ .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #FF2442;
            font-weight: 700;
            }


            
        </style>
    </head>
    <body style="font-family: 'Poppins', sans-serif; font-size: larger">
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
                        <button class="btn btn-fill dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #FFB830;">
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
    
        <!-- Background image -->
        <div class="bg-image"
        style="background-image: url('https://images.pexels.com/photos/3310691/pexels-photo-3310691.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');height: 400px;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class=" text-white text-center">
                    <P class = "mx-auto my-auto text-center" style=" font-weight:700; font-size: 3.7vw;">ANDA MEMILIKI PERTANYAAN?</P>                    
                    <div class="form__group field">
                        <input type="input" class="form__field" placeholder="Name" name="question" id='question'>
                        <label for="name" class="form__label">Pertanyaan</label>                      
                    </div>
                    <br>
                    <button onclick="info()" class="btn btn-fill" style="background-color: #FF2442; color: #FFEDDA;">Submit</button>
                    
                        
                </div> 
         
            </div>
            
        </div>
        <script>
            function info() {
                Swal.fire({
                    icon: 'info',
                    title: 'Thankyou for asking',
                    text: 'We will answer youre question on email!'
                })
            }
        </script>
        
        <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <br>
                    <h2>Kantor Pusat</h2>
                    <p>
                        <br>(031) 8439040
                        <br>Jl. Siwalankerto No.121-131, Siwalankerto, Kec. Wonocolo, 
                        <br>Kota SBY, Jawa Timur 60236
                    </p>
                    <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 300px">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4705.844495175395!2d112.73552673767749!3d-7.339545830686136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb4867925b0b%3A0xd06ae2d4f0af3f59!2sUniversitas%20Kristen%20Petra!5e0!3m2!1sid!2sid!4v1639385581130!5m2!1sid!2sid" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
           
            
                <div class="col-sm-8"> 
                    <div class="container">
                    <br>
                    <h2>Kantor Cabang</h2> 
                    <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <h4>Bekasi</h4>
                                    <a>(031) 8439040</a>
                                    <p>Ruko Emerald Summarecon Blok UB 11-12</p>
                                </div>
                                <div>
                                    <h4>Malang</h4>
                                    <a>(031) 8439040</a>
                                    <p>Jl. L.A. Sucipto 90A, Blimbing, Malang</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div>
                                    <h4>Jakarta</h4>
                                    <a>(031) 8439040</a>
                                    <p>Jl. Kemang Timur No.21, Jakarta Selatan</p>
                                </div>
                                <div>
                                    <h4>Surabaya</h4>
                                    <a>(031) 8439040</a>
                                    <p>Jl. Monginsidi no. 14 Surabaya</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div>
                                    <h4>Bali - Denpasar </h4>
                                    <a>(031) 8439040</a>
                                    <p>Jl. Teuku Umar Barat No. 18 Denpasar, Bali</p>
                                </div>
                            </div>
                        </div>
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