<html>
    <?php
        session_start();
        require_once "connection.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['topup'])) {
                $saldo = "Saldo tidak boleh kosong!";
            } else {
                $saldo = saring_input($_POST['topup']);
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
            if (!empty($saldo)) {
                $kalimatquery = $conn->prepare("UPDATE customer SET saldo = saldo+? WHERE id = {$_SESSION['id']}");
                $kalimatquery->bind_param("i", $saldo);
                $kalimatquery->execute();
                header("Location:topup.php");
            }
        ?>
    </body>
</html>