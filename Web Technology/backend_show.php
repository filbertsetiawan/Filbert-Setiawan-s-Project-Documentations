<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require_once "connection.php";
            $tableName = $_GET['q'];
            
            //kalo nama tabel yg ingin dishow == menu maka show menu
            if ($tableName == "menu") {
                $sql = "SELECT * FROM menu";
                $result = mysqli_query($conn, $sql);

                echo "<div class='row'>";
                while($row = mysqli_fetch_array($result)) {
                    echo '<div class="col-lg-3 col-md-6 mb-4">';
                    echo '<div class="card h-100" id="menu">';
                    // Foto makanan
                    echo '<a href="#"><img class="card-img-top" src="assets/' . $row['img'] . '" alt=""></a>';
                    // Body kartu
                    echo '<div class="card-body">';
                    // Nama menu
                    echo '<h2 class="card-title" id="nama' . $row['id'] . '">' . $row['nama'] . '</h2>';
                    echo '<h5 class="card-title" id="namaLain' . $row['id'] . '">' . $row['namaLain'] . '</h5>';
                    // Harga menu
                    echo '<p id="hargaMenu' . $row['id'] . '">Rp ' . number_format($row['harga']) . '</p>';
                    // Kategori menu
                    echo '<small class="text-muted" id="kategoriMenu' . $row['id'] . '">' . $row['kategori'] . '</small>';
                    // Deskripsi menu
                    echo '<p id="deskripsiMenu">' . $row['deskripsi'] . '</p>';
                    echo '</div>';
                    // Closing div
                    echo '</div></div>';
                } 
                echo "</div>";
            
                //kalo nama tabel yg ingin dishow == restoran maka show restoran
            } else if ($tableName == "restaurants") {
                $sql = "SELECT * FROM restaurants";
                $result = $conn->query($sql); 

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["total_rating"] == 0) {
                            $rataRataRating = 0;
                        } else {
                            $rataRataRating = $row["rating"] / $row["total_rating"];
                        }
                        echo '<br>';
                        echo '<div class="row" id="rowResto">';
                        // Logo resto
                        echo '<div class="col-lg-3 col-md-12 mx-auto my-auto text-center"><img id="logoResto" src="assets/' . $row["img"] . '"></div> ';
                        // Nama resto
                        echo '<div class="col-lg-9"><h1 id="namaRestoran">' . $row["restaurant_name"] . '</h1><hr id="hrRestName" >';
                        // Alamat resto
                        echo '<div class="row"><div class="col-xl-9 col-lg-8 col-md-8 col-xs-9"><div><img id="logoInfoResto" src="assets/locationLogo2.svg"><span>&nbsp; : &nbsp;<a id="contact" href="' . $row['link'] . '"></span>' . $row["street"] . ', ' . $row["city"] . '</a></div>';
                        // No telp resto
                        echo '<div id="noTelpRest"><img id="logoInfoResto" src="assets/phoneLogo2.svg"><span>&nbsp; : &nbsp;<a id="contact" href="tel:' . $row["phone"] . '"><span>' . $row["phone"] . '</a><br></div></div>';
                        // Logo open
                        echo '<div class="col-xl-1 col-lg-2 col-md-2 col-xs-1"><img src="assets/logoBuka.svg" id="logoBuka"></div>';
                        // Operational hours
                        echo '<div class="col-xl-2 col-lg-2 col-md-2 col-xs-2"><h3 id="badgeJamBuka"><span class="badge badge-success">&nbsp;' . $row["open_time"] . '&nbsp;</span></h3><h3  id="badgeJamTutup"><span class="badge badge-danger">&nbsp;' . $row["close_time"] . '&nbsp;</span></h3></div></div><br>';
                        // Label & Rating resto
                        echo '<div>
                        <h3><span id="badgeCategory1" class="badge badge-primary">&nbsp;' . $row["category1"] . '&nbsp;</span><span id="badgeCategory2" class="badge badge-primary">&nbsp;' . $row["category2"] . '&nbsp;</span></h3>
                        <h2 id="ratingResto">' . $rataRataRating . '&nbsp;<span><img id="bintangRating" src="assets/ratingStar.svg"></span></h2>
                        </div>';
                        echo '<a href="backend_showmenu.php?id=' . $row["id"] . '" class="stretched-link"></a>';
                        // Closing column div
                        echo '</div></div>';
                        echo '<br><hr>';
                    }
                } 
            }
            mysqli_close($conn);
        ?>
    </body>
</html>