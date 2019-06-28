<?php
require('database.php');
$connect = mysqli_connect("localhost","root","","products") or die("could not connect");

$output = '';
if(isset($_POST['search'])){
  $searchq = $_POST['search'];
  $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
  $sql = "SELECT * FROM products WHERE name LIKE '%$searchq%' OR description LIKE '%$searchq%'" or die ("could not search");
  $query = mysqli_query($connect,$sql);
  $count = mysqli_num_rows($query);
  if($count == 0){
    $output = 'There was no search results';
  }
  else{
    while($row = mysqli_fetch_array($query)){
      $name = $row['name'];
      $price = $row['price'];
      $description = $row['description'];
      $image = $row['image'];
      $id = $row['id'];

      $output .= '
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="image-flip" ontouchstart="this.classList.toggle("hover");">
              <div class="mainflip">
                  <div class="frontside">
                      <div class="card">
                          <div class="card-body text-center">
                              <p><img class=" img-fluid" src="images/'.$image.'" alt="card image"></p>
                              <h4 class="card-title">'.$name.'</h4>
                              <p class="card-text">Product: '.$name.' <br> Price: '.$price.' $</p>
                              <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="backside">
                      <div class="card">
                          <div class="card-body text-center mt-4">
                              <h4 class="card-title">'.$name.'</h4>
                              <p class="card-text">'.$description.'</p>
                              <ul class="list-inline">
                                  <li class="list-inline-item">
                                      <a class="social-icon text-xs-center" target="_blank" href="#">
                                          <i class="fa fa-facebook"></i>
                                      </a>
                                  </li>
                                  <li class="list-inline-item">
                                      <a class="social-icon text-xs-center" target="_blank" href="#">
                                          <i class="fa fa-twitter"></i>
                                      </a>
                                  </li>
                                  <li class="list-inline-item">
                                      <a class="social-icon text-xs-center" target="_blank" href="#">
                                          <i class="fa fa-skype"></i>
                                      </a>
                                  </li>
                                  <li class="list-inline-item">
                                      <a class="social-icon text-xs-center" target="_blank" href="#">
                                          <i class="fa fa-google"></i>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      ';
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Small Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">
    <!--стиль для авторизации в админ панель -->
    <style>

      #auth{display:none;}
      }
      #login{
      display: none;
      position: fixed;
      top: 200px;
      right: 800px;
      border: 3px solid #f1f1f1;
      z-index: 9;
      }
      .form-popup {
        display: none;
        position: fixed;
        top: 200px;
        right: 800px;
        border: 3px solid #f1f1f1;
        z-index: 9;
      }

      .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
      }

      .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
      }

      .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }

      .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
      }

      .form-container .cancel {
        background-color: red;
      }

      .form-container .btn:hover, .open-button:hover {
        opacity: 1;
      }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!--Скрипт для проверки введенных данных в форму авторизации -->
    <script>
    function OpenFunction() {
      document.getElementById("auth").style.display = "block";
    }
    function closeForm() {
        document.getElementById("auth").style.display = "none";
      }
    function check(form)
      {
        if(form.userid.value == "admin" && form.pswrd.value == "admin")
        {
          window.open('admin.php')
          document.getElementById("auth").style.display = "none";
          <?php
          ?>
            }
        else
        {
          alert("Invalid username or password")
            }
      }
    </script>


</head>
<body>
  <div id="auth" class="form-popup">
  <form name="login" class="form-container">
      <b>Login<b><input type="text" name="userid" placeholder="UserName" required/>
      Passowrd<input type="password" name="pswrd"placeholder="Password" required/>
      <input type="button" onclick="check(this.form)" class="btn" value="Login" />
      <input type="button" value="Cancel" class="btn cancel" onclick="closeForm();"/>
    </form>
  </div>
<div class="header">
    <h2 align="center">Small Shop</h2>
</div>

<ul>
    <li><a class="active" href="index.php">All products</a></li>
    <li><a href="#" onclick="OpenFunction();">Admin Panel</a></li>
</ul>
<br>
<br>
<section id="team" class="pb-5">
      <div class="container">
          <h5 class="section-title h1">All products of Shop</h5>
          <div class="row">
            <form action="index.php" method="post">
              <input type="text" name="search" placeholder="Search product"/>
              <br>
              <input type="submit" value="Search"/>
            </form>
              <!-- Team member -->
              <?php
              if($output == ''){
              $database=$connect->prepare("SELECT id , name , TRUNCATE(price , 2) , description , image
                FROM products");
              $database->bind_result($id, $name, $price ,$description, $image);
              $database->execute();
              while($database->fetch()){
                echo '
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle("hover");">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="images/'.$image.'" alt="card image"></p>
                                        <h4 class="card-title">'.$name.'</h4>
                                        <p class="card-text">Product: '.$name.' <br> Price: '.$price.' $</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">'.$name.'</h4>
                                        <p class="card-text">'.$description.'</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                ';
            }

          }
              else{
              print("$output");
            }

              ?>
          </div>
      </div>
  </section>

</body>
</html>
