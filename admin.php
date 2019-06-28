<?php
// Запрос файла
require('php/funktsioonid.php');
// Функция на добавление книжки и проверку файла
if(isset($_REQUEST["ProductNeww"])) {
  if(isset($_FILES['image'])){
   $errors= array();
   $file_name = $_FILES['image']['name'];
   $file_size =$_FILES['image']['size'];
   $file_tmp =$_FILES['image']['tmp_name'];
   $file_type=$_FILES['image']['type'];
   $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

   $expensions= array("jpg");
   if(in_array($file_ext,$expensions)=== false){
      $errors[]="Only JPEG  imagES";
   }

   if(empty($errors)==true){
      move_uploaded_file($file_tmp,"images/".$file_name);
      lisaRaamat($_REQUEST["newProductName"],$file_name,$_REQUEST["newProductDescription"],$_REQUEST["newProductPrice"]);
      header("Location: admin.php");
      exit();
   }
   else{
      print_r($errors);
    }
  }

}
// Функция на изменения книги
if(isset($_REQUEST["ProductEditt"])) {
    raamatuRedegeeremine($_REQUEST["RaamatSelectRedeg"],$_REQUEST["editproductName"],$_REQUEST["editproductDescription"],$_REQUEST["editproductprice"]);
    header("Location: admin.php");
    exit();
}

// Функция на удаление жанра
if(isset($_REQUEST["ProductDeletee"])) {
    kustutaZanr($_REQUEST["deleteproductName"]);
    header("Location: admin.php");
    exit();
}
// Функция на удаление автора

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">
</head>
<body>
<div class="header">
    <h2 align="center">Shop</h2>
</div>

<ul>
    <li><a class="active" href="index.php">All products</a></li>
</ul>
<h3 style="text-align:center;">Admin Panel</h3>
<br>
<br>

<div id ="ProductNew">
    <!--При нажатие на кнопку открывается форма -->
<a href="?addproduct" class="btn btn-outline-primary">New Product</a>
    <br>
    <br>
    <?php
    if(isset($_REQUEST["addproduct"])){
        echo "<form action='admin.php' method='POST' enctype='multipart/form-data'>";
        echo "Product Name: ";
        echo "<br>";
        echo "<input type='text' name='newProductName'>";
        echo "<br>";
        echo "Description: ";
        echo "<br>";
        echo "<input type='text' name='newProductDescription'>";
        echo "<br>";
        echo "Price: ";
        echo "<br>";
        echo "<input type='text' name='newProductPrice'>";
        echo "<br>";
        echo "<br>";
        echo "Product Image: ";
        echo "<br>";
        echo "<input type='file' name='image' />";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<input type='submit' name='ProductNeww' value='Add' class=\"btn btn-outline-success\">";
    }

    ?>
</div>








  <!--При нажатие на кнопку открывается форма -->
<div id ="ProductDelete">
    <a href="?deleteproduct" class="btn btn-outline-primary">Delete Product</a>
    <br>
    <br>
    <?php
    if(isset($_REQUEST["deleteproduct"])){
        echo "<form action='admin.php'>";
        echo "Select Product:";
        echo "<br>";
        echo "<select name='deleteproductName'>";
        $kask=$connect->prepare("SELECT id , name , TRUNCATE(price , 2) , description , image
          FROM products");
        $kask->bind_result($id, $name, $price ,$description, $image);
        $kask->execute();
        while($kask->fetch()){
            echo "<option value='$id'>$name</option>";
        }
        echo "</select>";
        echo "<br>";
        echo "<br>";
        echo "<input type='submit' name='ProductDeletee' value='Delete' class=\"btn btn-outline-danger\">";
    }

    ?>
</div>
<div id ="ProductEdit">
    <a href="?editproduct" class="btn btn-outline-primary">Edit Product</a>
    <br>
    <br>
    <?php
    if(isset($_REQUEST["editproduct"])){
        echo "<form action='admin.php'>";
        echo "Выберите Книгу:";
        echo "<br>";
        echo "<select name='RaamatSelectRedeg' id='editproducts'>";

        $kask=$connect->prepare("SELECT id , name , TRUNCATE(price , 2) , description , image
          FROM products");
        $kask->bind_result($id, $name, $price ,$description, $image);
        $kask->execute();
        while($kask->fetch()){
            echo "<option value='$id'>$name</option>";
        }
        echo "</select>";
        echo "<br>";
        echo "------------";
        echo "<br>";
        echo "<form action='admin.php' method='post'> ";
        echo "Product Name:";
        echo "<br>";
        echo "<input type='text' name='editproductName'>";
        echo "<br>";
        echo "Product Description:";
        echo "<br>";
        echo "<input type='text' name='editproductDescription'>";
        ECHO "<BR>";
        echo "Product Price:";
        echo "<br>";
        echo "<input type='text' name='editproductprice'>";
        echo "<br>";
        echo "<br>";

        echo "<input type='submit' name='ProductEditt' value='Change' class=\"btn btn-outline-info\">";
    }

    ?>
</div>


    <div class="footer">
        <p>artur.kexpa()gmail.com <br>
          Artur Šumilo
        </p>
    </div>
</body>
</html>
