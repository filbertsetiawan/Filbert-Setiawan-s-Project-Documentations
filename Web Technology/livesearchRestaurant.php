<?php
    $con=mysqli_connect("localhost", "root", "", "onlineorder");
    
    if(!$con){
        echo "DB not Connected...";
    }
    else{
    $result=mysqli_query($con, "Select * from restaurants");
    if($result->num_rows>0){
    $xml = new DOMDocument("1.0");
    
    // It will format the output in xml format otherwise
    // the output will be in a single row
    $xml->formatOutput=true;
    $listMenu=$xml->createElement("restaurants");
    $xml->appendChild($listMenu);
    while($row=mysqli_fetch_array($result)){
        $menu=$xml->createElement("restaurant");
        $listMenu->appendChild($menu);
        
        $menu_id=$xml->createElement("id", $row['id']);
        $menu->appendChild($menu_id);
        
        $menu_name=$xml->createElement("name", $row['restaurant_name']);
        $menu->appendChild($menu_name);

        $link=$xml->createElement("link", "menu.php?restName=".$row['restaurant_name']);
        $menu->appendChild($link);
        
    }
    echo "<xmp>".$xml->saveXML()."</xmp>";
    $xml->save("listResto.xml");
    // Arahin sesuai ke hlmn yg km mw
    header('Location:backend.php');
    }
    else{
        echo "error";
    }
    }
?>