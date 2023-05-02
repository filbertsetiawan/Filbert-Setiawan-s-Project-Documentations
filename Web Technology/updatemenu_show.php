<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require_once "connection.php";
            $id = intval($_GET['q']);

            //query dari database menu
            $sql="SELECT * FROM menu WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            
            //query id restoran
            $sql2 = "SELECT id FROM restaurants";
            $result2 = $conn->query($sql2);

            while($row = mysqli_fetch_array($result)) {
                echo '<br>
                    <label>Pilih ID restoran: </label>
                    <select name="idresto">
                    <option>Pilih</option>';
                while($row2 = mysqli_fetch_array($result2)) {
                    $idresto = $row2['id'];
                    echo "<option value='".$idresto."'>".$row2['id']."</option>";
                        
                } 
                echo '</select>
                    <br>
                    <br>
                    Nama makanan atau minuman:  
                    <br><input type="text" name="nama" value="'.$row['nama'].'">
                    <br>
                    <br>
                    Nama lain: 
                    <br><input type="text" name="namalain" value="'.$row['namaLain'].'">
                    <br> 
                    <br>
                    <label>Pilih kategori: </label>
                    <select name="kategori">
                    <option>Pilih</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Seafood">Seafood</option>
                    <option value="Beef">Beef</option>
                    <option value="Mixed">Mixed</option>
                    <option value="Beverage">Beverage</option>
                    <option value="Other">Other</option>
                    </select>
                    <br>
                    <br>
                    Deskripsi: 
                    <br><textarea name="deskripsi">'.$row['deskripsi'].'</textarea>
                    <br>
                    <br>
                    Harga: 
                    <br><input type="text" name="harga" value="'.$row['harga'].'">
                    <br>
                    <br>
                    Nama file image: 
                    <br><input type="text" name="image" value="'.$row['img'].'">
                    <br>';
            }
            mysqli_close($conn);
        ?>
    </body>
</html>