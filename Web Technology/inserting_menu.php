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

            // Cek nama makanan/minuman
            if (empty($_POST['nama'])) {
                $errnama = "Nama makanan/minuman tidak boleh kosong!";
            } else {
                $nama = saring_input($_POST['nama']);
            }

            // Cek nama lain
            if (empty($_POST['namalain'])) {
                $errnamalain = "Nama lain tidak boleh kosong!";
            } else {
                $namalain = saring_input($_POST['namalain']);
            }

            // Cek kategori
            if (empty($_POST['kategori'])) {
                $errkategori = "Kategori tidak boleh kosong!";
            } else {
                $kategori = saring_input($_POST['kategori']);
            }

            // Cek deskripsi
            if (empty($_POST['deskripsi'])) {
                $errdeskripsi = "Deskripsi tidak boleh kosong!";
            } else {
                $deskripsi = saring_input($_POST['deskripsi']);
            }

            // Cek harga
            if (empty($_POST['harga'])) {
                $errharga = "Harga tidak boleh kosong!";
            } else {
                $harga = saring_input($_POST['harga']);
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
                // cek apakah nama makanan yang diinputkan sudah ada/belum
                $kalimatquery1 = "SELECT nama FROM menu WHERE nama = '$nama' LIMIT 1";
                $hasilquery1 = $conn->query($kalimatquery1);

                if ($hasilquery1->num_rows > 0) {
                    echo "Nama makanan/minuman sudah ada, silahkan input ulang!";
                }
                else{
                    // insert menu ke database
                    $kalimatquery = $conn->prepare("INSERT INTO menu (restaurantID, nama, namaLain, kategori, deskripsi, harga, img) VALUES (?,?,?,?,?,?,?)");
                    $kalimatquery->bind_param("issssis", $idresto, $nama, $namalain, $kategori, $deskripsi, $harga, $image);
                    $kalimatquery->execute();
                    header("Location:livesearchMenu.php");
                }
            } else {
                echo "$errnama <br>";
            }

            if(empty($idresto)){
                echo "$erridresto <br>";
            }

            if(empty($namalain)){
                echo "$errnamalain <br>";
            }

            if(empty($kategori)){
                echo "$errkategori <br>"; 
            }

            if(empty($deskripsi)){
                echo "$errdeskripsi <br>"; 
            }

            if(empty($harga)){
                echo "$errdeskripsi <br>"; 
            }

            if(empty($image)){
                echo "$errimage <br>"; 
            }
        ?>
    </body>
</html>