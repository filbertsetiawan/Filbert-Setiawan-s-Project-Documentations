<?php
    $con=mysqli_connect("localhost", "root", "", "onlineorder");
    
    if(!$con){
        echo "DB not Connected...";
    }
    else{
    $result=mysqli_query($con, "Select * from menu group by nama");
    if($result->num_rows>0){
    $xml = new DOMDocument("1.0");
    
    // It will format the output in xml format otherwise
    // the output will be in a single row
    $xml->formatOutput=true;
    $listMenu=$xml->createElement("menus");
    $xml->appendChild($listMenu);
    while($row=mysqli_fetch_array($result)){
        $menu=$xml->createElement("menu");
        $listMenu->appendChild($menu);
        
        $menu_id=$xml->createElement("id", $row['id']);
        $menu->appendChild($menu_id);
        
        $menu_name=$xml->createElement("name", $row['nama']);
        $menu->appendChild($menu_name);
        
        $menu_restaurant=$xml->createElement("restaurant", $row['restaurantID']);
        $menu->appendChild($menu_restaurant);

        $link=$xml->createElement("link", "livesearchResult.php?menuName=".$row['nama']);
        $menu->appendChild($link);
        
    }
    echo "<xmp>".$xml->saveXML()."</xmp>";
    $xml->save("listMenu.xml");
    // Arahin sesuai ke hlmn yg km mw
    header('Location:backend.php');
    }
    else{
        echo "error";
    }
}