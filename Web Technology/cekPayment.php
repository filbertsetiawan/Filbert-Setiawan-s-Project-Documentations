<?php
include 'connection.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>

<?php
$q = $_GET['q'];

// Bila menggunakan tegpay
if($q == 'tegpay'){
    $_SESSION['payment_method'] = 1;
    
}
// Bila menggunakan cash
elseif($q == 'cash'){
    $_SESSION['payment_method'] = 2;
}
?>
</body>
</html>