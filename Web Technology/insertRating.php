<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <?php
    echo $_SESSION['rest_name'];
    $q = intval($_GET['q']);

    $sql = "UPDATE restaurants SET rating = (rating + $q) WHERE restaurant_name = {$_SESSION['rest_name']}";

    $sql2 = "UPDATE restaurants SET total_rating = (total_rating + 1) WHERE restaurant_name = {$_SESSION['rest_name']}";

    if ($conn->query($sql) === TRUE) {
        if ($conn->query($sql2) === TRUE) {
            echo "<script type='text/javascript'>alert('Terima kasih atas review Anda !');</script>";
        }
    }
    ?>
</body>

</html>