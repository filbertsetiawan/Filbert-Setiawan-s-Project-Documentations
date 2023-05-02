<html>
    <?php
        session_start();
        require_once "connection.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['password'])) {
                $password = "Password tidak boleh kosong!";
            } else {
                $password = saring_input($_POST['password']);
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
            if (!empty($password)) {
                $kalimatquery = $conn->prepare("UPDATE customer SET password=? WHERE id = {$_SESSION['id']}");
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $kalimatquery->bind_param("s", $param_password);
                $kalimatquery->execute();
                header("Location:home.php");
            }
        ?>
    </body>
</html>