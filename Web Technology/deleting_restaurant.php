<html>
    <?php 
        require_once "connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['nama'])) {
                $errnama = "Nama restoran tidak boleh kosong!";
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
                //delete menu
                $kalimatquery = $conn->prepare("DELETE FROM restaurants WHERE restaurant_name = '$nama'");
                $kalimatquery->execute();

                header("Location:livesearchRestaurant.php");
            } else {
                echo "$errnama <br>";
            }
        ?>
    </body>
</html>