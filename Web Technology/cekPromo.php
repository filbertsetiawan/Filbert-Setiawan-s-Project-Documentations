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
    // Pass nama promo
    $q = $_GET['q'];

    // Bila memakai tegpay
    if ($_SESSION['payment_method'] == 1) {

        // Dicek saldonya
        $sql = "SELECT * FROM customer WHERE username= '{$_SESSION['username']}'";
        $result = $conn->query($sql);

        while ($result1 = $result->fetch_assoc()) {

            // Ambil minimal cost
            $sql2 = "SELECT * FROM promotions WHERE promotion_name = '$q'";
            $result2 = $conn->query($sql2);

            while ($result3 = $result2->fetch_assoc()) {
                // Cek bila saldo mencukupi
                if ($result1['saldo'] >= $result3['minimal_cost']) {
                    $hargaSekarang = intval($_SESSION['grand_total']) - (intval($_SESSION['grand_total']) * (intval($result3['discount']) / 100));
                    $_SESSION["final_price"] = $hargaSekarang;
                    echo '<input name="total" type="text" disabled value="'.$hargaSekarang.'">';
                } else {
                    echo 'Saldo Tidak Mencukupi, Silahkan Top Up';
                    echo '<a class="button" href="ewallet.php">Top Up</a>';
                }
            }
        };
    }
    // Bila memakai cash
    elseif ($_SESSION['payment_method'] == 2) {
        return 'gatau';
    }

    // $sql="SELECT * FROM promotions WHERE id = '".$q."'";
    // $result = mysqli_query($con,$sql);

    // echo "<table>
    // <tr>
    // <th>Firstname</th>
    // <th>Lastname</th>
    // <th>Age</th>
    // <th>Hometown</th>
    // <th>Job</th>
    // </tr>";
    // while($row = mysqli_fetch_array($result)) {
    //   echo "<tr>";
    //   echo "<td>" . $row['FirstName'] . "</td>";
    //   echo "<td>" . $row['LastName'] . "</td>";
    //   echo "<td>" . $row['Age'] . "</td>";
    //   echo "<td>" . $row['Hometown'] . "</td>";
    //   echo "<td>" . $row['Job'] . "</td>";
    //   echo "</tr>";
    // }
    // echo "</table>";
    // mysqli_close($con);
    ?>
</body>

</html>
