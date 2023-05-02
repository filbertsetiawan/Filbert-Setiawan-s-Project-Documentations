<html>
    <?php 
        require_once "connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Cek nama makanan/minuman
            if (empty($_POST['nama'])) {
                $errnama = "Nama makanan/minuman tidak boleh kosong!";
            } else {
                $nama = saring_input($_POST['nama']);
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
                // delete menu
                $kalimatquery = $conn->prepare("DELETE FROM menu WHERE nama = '$nama'");
                $kalimatquery->execute();

                header("Location:livesearchMenu.php");
            } else {
                echo "$errnama <br>";
            }
        ?>
    </body>
</html>