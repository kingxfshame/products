<?php
require ('database.php');
function lisaRaamat($name,$image,$description,$price){
    global $connect;
    $kask=$connect->prepare("INSERT INTO products(name,price,description,image)
VALUES (?,?,?,?)");
    $kask->bind_param("siss",$name,$price,$description,$image);
    $kask->execute();
}


function kustutaZanr($id){
    global $connect;
    $kask=$connect->prepare("DELETE FROM products WHERE id=?");
    $kask->bind_param("i",$id);
    $kask->execute();
}


function raamatuRedegeeremine($id,$name,$description,$price){
    global $connect;
    $kask=$connect->prepare("UPDATE products SET name = ? , price = ? , description = ? WHERE id= ?");
    $kask->bind_param("sisi",$name,$price,$description,$id);
    $kask->execute();
}

?>
