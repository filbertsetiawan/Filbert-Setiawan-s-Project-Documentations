<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require_once "connection.php";
            $id = intval($_GET['q']);

            //query dari database restoran
            $sql="SELECT * FROM restaurants WHERE id = $id";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_array($result)) {
                echo '<br>
                    ID restoran:  
                    <br><input type="text" name="idresto" value="'.$row['id'].'">
                    <br>
                    <br>
                    Nama restoran: 
                    <br><input type="text" name="nama" value="'.$row['restaurant_name'].'">
                    <br>
                    <br>
                    <label>Pilih kategori 1: </label>
                    <select name="kategori1">
                        <option>Pilih</option>
                        <option value="Casual">Casual</option>
                        <option value="Coffee">Coffee</option>
                        <option value="Fast">Fast food</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Fine dining">Fine dining</option>
                        <option value="Pizzeria">Pizzeria</option>
                        <option value="Ethnic">Ethnic</option>
                        <option value="Diner">Diner</option>
                        <option value="Bakery">Bakery</option>
                        <option value="Seafood">Seafood</option>
                        <option value="Bar">Bar</option>
                        <option value="Mart">Mart</option>
                        <option value="Vegan">Vegan</option>
                    </select>
                    <br>
                    <br>
                    <label>Pilih kategori 2: </label>
                    <select name="kategori2">
                        <option>Pilih</option>
                        <option value="Indonesian">Indonesian</option>
                        <option value="Western">Western</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Italian">Italian</option>
                        <option value="American">American</option>
                        <option value="European">European</option>
                        <option value="Middle East">Middle East</option>
                        <option value="International">International</option>
                    </select>
                    <br>
                    <br>
                    Alamat: 
                    <br><textarea name="alamat">'.$row['street'].'</textarea>
                    <br>
                    <br>
                    <label>Pilih kota: </label>
                    <select name="kota">
                        <option>Pilih</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Semarang">Semarang</option>
                        <option value="Malang">Malang</option>
                    </select>
                    <br>
                    <br>
                    Link: 
                    <br><input type="text" name="link" value="'.$row['link'].'">
                    <br>
                    <br>
                    No. telepon: 
                    <br><input type="text" name="notelp" value="'.$row['phone'].'">
                    <br>
                    <br>
                    <label>Waktu buka: </label>
                    <input type="time" name="open" value="'.$row['open_time'].'">
                    <br>
                    <br>
                    <label>Waktu tutup: </label>
                    <input type="time" name="close" value="'.$row['close_time'].'">
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