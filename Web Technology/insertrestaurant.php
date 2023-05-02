<?php
    //start session
    session_start();

    //cek apakah user sudah login, jika belum maka akan dikembalikan ke login page
    if (!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true) {
        header("location: welcome.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <title>Backend | Add Menu</title>
    </head>
    <body style="font-family: 'Poppins', sans-serif; font-size: 20px;">
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
        </style>
        
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <img src="assets/logowarteg.png" width="100%">
            <a href="backend.php"style="text-decoration: none;">Home</a>
            
            <button class="dropdown-btn">Menu<img src="assets/down-chevron-svgrepo-com.svg" width="20px" style="float: right; padding-top:6px;"></button>
            <div class="dropdown-container">
                <a href="insertmenu.php">Add new menu</a>
                <a href="updatemenu.php">Update menu</a>
                <a href="deletemenu.php">Delete menu</a>
            </div>

            <button class="dropdown-btn">Restaurants<img src="assets/down-chevron-svgrepo-com.svg" width="20px" style="float: right; padding-top:6px;"></button>
            <div class="dropdown-container">
                <a href="insertrestaurant.php" class="active">Add new restaurants</a>
                <a href="updaterestaurant.php">Update restaurants</a>
                <a href="deleterestaurant.php">Delete restaurants</a>
            </div>
            
            <br>
            <a href="logout.php" style="text-decoration: none;">Logout</a>
        </div>

        <!-- Content -->
        <div class="content" style="background-color: #3DB2FF; padding-top: 12px; padding-bottom: 8px;">
            <h1 style="font-family: 'Poppins', sans-serif; font-size: xx-large;"><b>ADD RESTAURANT</b></h1>
            <br>
            <form action="inserting_restaurant.php" method="post">
                <!-- input id resto -->
                ID restoran:  
                <br><input type="text" name="idresto">
                <br>
                <br>

                <!-- input nama resto -->
                Nama restoran: 
                <br><input type="text" name="nama">
                <br>
                <br>

                <!-- pilih kategori 1 -->
                <label>Pilih kategori 1: </label>
                <select name="kategori1">
                    <option>Pilih</option>
                    <option value="Casual">Casual</option>
                    <option value="Coffee">Coffee</option>
                    <option value="Fast">Fast food</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Fine dining">Fine dining</option>
                    <option value="Pizzeria">Pizzeria</option>
                    <option value="Ethnic">Ethnic</option>
                    <option value="Diner">Diner</option>
                    <option value="Bakery">Bakery</option>
                    <option value="Seafood">Seafood</option>
                    <option value="Bar">Bar</option>
                    <option value="Mart">Mart</option>
                    <option value="Vegan">Vegan</option>
                </select>
                <br>
                <br>

                <!-- pilih kategori 2 -->
                <label>Pilih kategori 2: </label>
                <select name="kategori2">
                    <option>Pilih</option>
                    <option value="Indonesian">Indonesian</option>
                    <option value="Western">Western</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Italian">Italian</option>
                    <option value="American">American</option>
                    <option value="European">European</option>
                    <option value="Middle East">Middle East</option>
                    <option value="International">International</option>
                </select>
                <br>
                <br>

                <!-- input alamat restoran -->
                Alamat: 
                <br><textarea name="alamat"></textarea>
                <br>
                <br>

                <!-- pilih kota -->
                <label>Pilih kota: </label>
                <select name="kota">
                    <option>Pilih</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Malang">Malang</option>
                </select>
                <br>
                <br>

                <!-- input link google maps -->
                Link: 
                <br><input type="text" name="link" value="https://">
                <br>
                <br>

                <!-- input nomor telepon resto -->
                No. telepon: 
                <br><input type="text" name="notelp">
                <br>
                <br>

                <!-- input jam buka resto -->
                <label>Waktu buka: </label>
                <input type="time" name="open">
                <br>
                <br>

                <!-- input jam tutup resto -->
                <label>Waktu tutup: </label>
                <input type="time" name="close">
                <br>
                <br>

                <!-- input nama file gambar resto -->
                Nama file image: 
                <br><input type="text" name="image">
                <br>
                <br>
                <input class="btn btn-fill" type="submit" value="Add">
            </form>
        </div>

        <script>
            //loop dropdown 
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
