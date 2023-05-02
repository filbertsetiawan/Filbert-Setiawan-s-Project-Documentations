<?php
include 'connection.php';
session_start();

if(isset($_GET["del"])){
    $sql = "DELETE FROM cart WHERE product_id ='{$_GET['del']}'";
    $conn->query($sql);
    echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Product have been removed from card.
    </div>';
}

if(isset($_GET["delall"])){
    $sql = "DELETE FROM cart";
    $conn->query($sql);
    echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Cart has been cleared.
    </div>';
}

if(isset($_GET["upd"])){
    $sql = "UPDATE cart SET qty='{$_GET['qty']}' WHERE product_id ='{$_GET['upd']}'";
    $conn->query($sql);
}

$sql="SELECT * FROM cart";
$result = mysqli_query($conn,$sql);
echo '<table class="table table-striped">
    <tr>
        <th>No.</th>
        <th></th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>&nbsp; </th>
    </tr>';

    $no=1;
    $total=0;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $id = $row['product_id'];
            $sub =  $row["harga"] * $row["qty"];
            $total += $sub;
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo '<td><img width="300" height="200" src="assets/' . $row["img"] . '" alt=""></td>';
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo '<td><form><input type="hidden" value="'. $id .'"><input onChange="upd(this.previousElementSibling.value, this.value)" type="number" min="1" max="99" value ="'. $row["qty"] .'"></form></td>';
            echo "<td>" . $sub . "</td>";
            echo "<td><button class= 'close' value='". $id ."' onclick='del(this.value)'>X</button></td>";    
            echo "</tr>";
        }
    }else{
        echo "<h1>Cart is Empty</h1>";
        unset( $_SESSION['cart_rest']);
    }
    $_SESSION['grand_total'] = $total;
    echo '<tr>
    <th colspan="5">Total</th>
    <th>Rp. ' . $total . '</th>
    <th></th>
    </tr>
</table>
';

    ?>
