<html>
    <?php 
        require_once "connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Cek id restoran
            if (empty($_POST['idresto'])) {
                $erridresto = "ID restoran tidak boleh kosong!";
            } else {
                $idresto = saring_input($_POST['idresto']);
            }

            // Cek nama restoran
            if (empty($_POST['nama'])) {
                $errnama = "Nama restoran tidak boleh kosong!";
            } else {
                $nama = saring_input($_POST['nama']);
            }

            // Cek kategori 1
            if (empty($_POST['kategori1'])) {
                $errkategori1 = "Kategori 1 tidak boleh kosong!";
            } else {
                $kategori1 = saring_input($_POST['kategori1']);
            }

            // Cek kategori 2
            if (empty($_POST['kategori2'])) {
                $errkategori2 = "Kategori 2 tidak boleh kosong!";
            } else {
                $kategori2 = saring_input($_POST['kategori2']);
            }

            // Cek alamat
            if (empty($_POST['alamat'])) {
                $erralamat = "Alamat tidak boleh kosong!";
            } else {
                $alamat = saring_input($_POST['alamat']);
            }

            // Cek kota
            if (empty($_POST['kota'])) {
                $errkota = "Kota tidak boleh kosong!";
            } else {
                $kota = saring_input($_POST['kota']);
            }

            // Cek link
            if (empty($_POST['link'])) {
                $errlink = "Link tidak boleh kosong!";
            } else {
                $link = saring_input($_POST['link']);
            }

            // Cek no. telp
            if (empty($_POST['notelp'])) {
                $errnotelp = "Nomor telepon tidak boleh kosong!";
            } else {
                $notelp = saring_input($_POST['notelp']);
            }

            // Cek waktu buka
            if (empty($_POST['open'])) {
                $erropen = "Waktu buka tidak boleh kosong!";
            } else {
                $open = saring_input($_POST['open']);
            }

            // Cek waktu tutup
            if (empty($_POST['close'])) {
                $errclose = "Waktu tutup tidak boleh kosong!";
            } else {
                $close = saring_input($_POST['close']);
            }

            // Cek image
            if (empty($_POST['image'])) {
                $errimage = "Image tidak boleh kosong!";
            } else {
                $image = saring_input($_POST['image']);
            }
        }

        function saring_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <body>
        <?php
            if (!empty($nama)) {
                //update
                $kalimatquery = $conn->prepare("UPDATE restaurants SET id = ?, restaurant_name = ?, category1 = ?, category2 = ?, street = ?, city = ?, link = ?, phone = ?, open_time = ?, close_time = ?, img = ? WHERE restaurant_name = '$nama'");
                $kalimatquery->bind_param("issssssssss", $idresto, $nama, $kategori1, $kategori2, $alamat, $kota, $link, $notelp, $open, $close, $image);
                $kalimatquery->execute();
                header("Location: livesearchRestaurant.php");
            } else {
                echo "$errnama <br>";
            }

            if(empty($idresto)){
                echo "$erridresto <br>";
            }

            if(empty($kategori1)){
                echo "$errkategori1 <br>";
            }

            if(empty($kategori2)){
                echo "$errkategori2 <br>"; 
            }

            if(empty($alamat)){
                echo "$erralamat <br>"; 
            }

            if(empty($kota)){
                echo "$errkota <br>"; 
            }

            if(empty($link)){
                echo "$errlink <br>"; 
            }

            if(empty($notelp)){
                echo "$errnotelp <br>"; 
            }

            if(empty($open)){
                echo "$erropen <br>"; 
            }

            if(empty($close)){
                echo "$errclose <br>"; 
            }

            if(empty($image)){
                echo "$errimage <br>"; 
            }
        ?>
    </body>
</html>