<?php
    include 'connection.php';
    session_start();
    
    //cek untuk tidak bisa beda restaurant
    $id= $_GET['id'];
    $sqll= mysqli_query($conn, "SELECT * FROM menu WHERE id ='{$_GET['id']}'");
    $result = mysqli_fetch_object($sqll);
    $restID = $result->restaurantID;
    
    
    if(!isset($_SESSION['cart_rest'])){
        $_SESSION['cart_rest']=$restID;
    }


    
    if($_SESSION['cart_rest']==$restID ){

        $sqlinsert = "INSERT INTO cart (product_id, nama, harga, qty, img) VALUES ('{$_GET['id']}', '{$result->nama}', '{$result->harga}', '{$_GET['qty']}', '{$result->img}')";
        if ($conn->query($sqlinsert) === TRUE) {
            echo '<script language="javascript">alert("product added to cart");</script>';
            
            } else {
            echo '<script language="javascript">alert("this product is already in cart");</script>';
        }
        echo "<script>document.location = 'menu.php?restName=" .$_SESSION['rest_name']. "'</script>";
    } else{
        echo '<script language="javascript">alert("You have to order from the same restaurant. Clear cart to change restaurant.");</script>';
        echo "<script>document.location = 'restaurants.php'</script>";
    }
/*     $_SESSION["cart"][$id] = [
        "nama" => $result->nama,
        "harga" => $result->harga,
        "img" => $result->img,
        "qty" => $_GET['qty']
    ]; */


    //header("location: menu.php?restName=".$_SESSION['rest_name']);
?>