<?php

session_start();

//USEROWNER
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}
$conn = mysqli_connect("localhost", "root","", "earenadb");

if ($_SESSION["type"] == "user") {
  $hasil = mysqli_query($conn,"SELECT * FROM user WHERE userName = '$_SESSION[userName]'");
$baris = mysqli_fetch_assoc($hasil);
}

else if($_SESSION["type"] == "owner"){
    $hasil = mysqli_query($conn,"SELECT * FROM owner WHERE ownerName = '$_SESSION[ownerName]'");
    $baris = mysqli_fetch_assoc($hasil);
}
//USEROWNER


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eArena | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <style type="text/css">
    .*{
      margin: 0px;
      padding: 0px;
    }
  </style>
</head>
<body >
  


<div class="header" style="background-image: url('img/cr.jpg'); background-size: 100%; height: 300px; padding: 60px 30px 30px 50px; font-size: 72pt; color: white"><i><b>JUST BOOK IT.</b></i></div>




<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 0 16px 0 16px;">
  <a class="navbar-brand" href="#">eArena</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php" style="font-size: 20pt;"><b>Home </b><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20pt;">
          <b>Sports</b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Sports.php?id=all">All sports</a>
          <a class="dropdown-item" href="Sports.php?id=futsal">Futsal</a>
          <a class="dropdown-item" href="Sports.php?id=basket">Basketball</a>
          <a class="dropdown-item" href="Sports.php?id=volley">Volley</a>
          <a class="dropdown-item" href="Sports.php?id=badminton">Badminton</a>
          <a class="dropdown-item" href="Sports.php?id=minisoccer">Mini Soccer </a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
      <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search field.." aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Search</button>
    </form>


      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20pt;">
                <img src="img/<?php 
                  if ($_SESSION["type"] == "user") {
                                      echo $baris['userPicture'];
                      }

                  else if($_SESSION["type"] == "owner"){
                      echo $baris['ownerPicture'];
                  }


                 ?>" class="rounded-circle" style="height: 30px; width: 30px; margin-left: 15px;">    
          </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <a class="dropdown-item" href="profile.php">My Book</a>
          <a class="dropdown-item" href="logout.php">Log out</a>

        </div>
      </li>
    </ul>

  </div>
</nav>

  </div>
</nav>




<div style="background-color: black; height: 200px;font-size: 110pt">
 
  <div class="row">
  
    <div class="col-11" style="text-align: right"><span style="color: white;"><b>Hot <span style="color: maroon;">Promo</span></b></span></div>
      <div class="col-1"></div>
  </div>

</div>

    <div id="demo" class="carousel slide" data-ride="carousel" style="width: 100%;height: 640px; color: white;" >

      <!-- Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      
      <!-- The slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('img/soccer/1.jpg'); background-size: 100%; height: 640px;">
          <div class="carousel-caption">
           <b style="font-size: 30px;">Tangkas Sports Center</b>
           <p style="font-size: 20px;">Futsal-Badminton-Basketball</p>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url('img/badminton/1.jpg'); background-size: 100%; height: 640px;">
           <div class="carousel-caption">
           <b style="font-size: 30px;">International Sports Club</b>
           <p style="font-size: 20px;">Futsal-Badminton</p>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url('img/futsal/4.jpg'); background-size: 100%; height: 640px;">
           <div class="carousel-caption">
           <b style="font-size: 30px;">Badminton Saga</b>
           <p style="font-size: 20px;">Badminton</p>
          </div>
        </div>
      </div>
      
      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>

      </div>
    </div>  


  



<div style="background-color: black; height: 200px;font-size: 110pt;">




  <div class="row">
      <div class="col-1"></div>
      <div class="col-11"><span style="color: white;"><b><span style="color: maroon; ">Best</span> Deals</b></span></div>
  </div>

</div>
          <div id="demo2" class="carousel slide" data-ride="carousel" style="width: 100%;height: 400px; color: black;" >

              <!-- Indicators 
              <ul class="carousel-indicators">
                <li data-target="#demo2" data-slide-to="0" class="active"></li>
                <li data-target="#demo2" data-slide-to="1"></li>
                <li data-target="#demo2" data-slide-to="2"></li>
              </ul>
              
              The slideshow -->
              <div class="carousel-inner">


              <div class="carousel-item active" style="background-color: #1e1e1e">
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-5">
                      <div style="background-image: url('img/soccer/1.jpg'); background-size: 100%; height: 400px;"></div>
                  </div>
                   <div class="col-1"></div>
                  <div class="col-4" style="padding: 40px;">
                      <center>
                        <h1 style="color: white"><span style="color: maroon">#1 </span>Tangkas Sport Center</h1>
                        <p style="color: white;">Lapangan olahraga merupakan suatu bentuk ruang terbuka non hijau sebagai suatu pelataran dengan fungsi utama tempat dilangsungkannya aktivitas olahraga. Setiap jenis olahraga diperlukan sarana lapangan untuk tempat berlangsungnya aktivitas. Secara garis besar beberapa jenis olah raga yang membutuhkan saranan lapangan adalah Tenis, Futsal, Basket, dan Badminton. Untuk setiap jenis lapangan memiliki ukuran atau dimensi yang berbeda-beda.</p>
                      </center>
                  </div>
                   <div class="col-1"></div>
                </div>
              </div>

             <div class="carousel-item" style="background-color: #1e1e1e">
                <div class="row">
                   <div class="col-1"></div>
                  <div class="col-5">
                      <div style="background-image: url('img/badminton/3.jpg'); background-size: 100%; height: 400px;"></div>
                  </div>
                   <div class="col-1"></div>
                   <div class="col-4" style="padding: 40px;">
                      <center>
                        <h1 style="color: white"><span style="color: maroon">#2 </span>Internation Sports Club</h1>
                        <p style="color: white;">Lapangan olahraga merupakan suatu bentuk ruang terbuka non hijau sebagai suatu pelataran dengan fungsi utama tempat dilangsungkannya aktivitas olahraga. Setiap jenis olahraga diperlukan sarana lapangan untuk tempat berlangsungnya aktivitas. Secara garis besar beberapa jenis olah raga yang membutuhkan saranan lapangan adalah Tenis, Futsal, Basket, dan Badminton. Untuk setiap jenis lapangan memiliki ukuran atau dimensi yang berbeda-beda.</p>
                      </center>
                  </div>
                   <div class="col-1"></div>
                </div>
              </div>

             <div class="carousel-item" style="background-color: #1e1e1e">
                <div class="row">
                   <div class="col-1"></div>
                  <div class="col-5">
                      <div style="background-image: url('img/volley/2.jpg'); background-size: 100%; height: 400px;"></div>
                  </div>
                   <div class="col-1"></div>
                  <div class="col-4" style="padding: 40px;">
                      <center>
                        <h1 style="color: white"><span style="color: maroon">#3 </span>Capoeira Co.</h1>
                        <p style="color: white;">Lapangan olahraga merupakan suatu bentuk ruang terbuka non hijau sebagai suatu pelataran dengan fungsi utama tempat dilangsungkannya aktivitas olahraga. Setiap jenis olahraga diperlukan sarana lapangan untuk tempat berlangsungnya aktivitas. Secara garis besar beberapa jenis olah raga yang membutuhkan saranan lapangan adalah Tenis, Futsal, Basket, dan Badminton. Untuk setiap jenis lapangan memiliki ukuran atau dimensi yang berbeda-beda.</p>
                      </center>
                  </div>
                   <div class="col-1"></div>
                </div>
              </div>

              <div class="carousel-item" style="background-color: #1e1e1e">
                <div class="row">
                   <div class="col-1"></div>
                  <div class="col-5">
                      <div style="background-image: url('img/basket/1.jpg'); background-size: 100%; height: 400px;"></div>
                  </div>
                   <div class="col-1"></div>
                   <div class="col-4" style="padding: 40px;">
                      <center>
                        <h1 style="color: white"><span style="color: maroon">#4 </span>Basket4Lyfe</h1>
                        <p style="color: white;">Lapangan olahraga merupakan suatu bentuk ruang terbuka non hijau sebagai suatu pelataran dengan fungsi utama tempat dilangsungkannya aktivitas olahraga. Setiap jenis olahraga diperlukan sarana lapangan untuk tempat berlangsungnya aktivitas. Secara garis besar beberapa jenis olah raga yang membutuhkan saranan lapangan adalah Tenis, Futsal, Basket, dan Badminton. Untuk setiap jenis lapangan memiliki ukuran atau dimensi yang berbeda-beda.</p>
                      </center>
                  </div>
                   <div class="col-1"></div>
                </div>
              </div>

              <div class="carousel-item" style="background-color: #1e1e1e">
                <div class="row">
                   <div class="col-1"></div>
                  <div class="col-5">
                      <div style="background-image: url('img/volley/3.jpg'); background-size: 100%; height: 400px;"></div>
                  </div>
                   <div class="col-1"></div>
                  <div class="col-4" style="padding: 40px;">
                      <center>
                        <h1 style="color: white;"><span style="color: maroon">#5 </span>Volley Besar Rayar</h1>
                        <p style="color: white;">Lapangan olahraga merupakan suatu bentuk ruang terbuka non hijau sebagai suatu pelataran dengan fungsi utama tempat dilangsungkannya aktivitas olahraga. Setiap jenis olahraga diperlukan sarana lapangan untuk tempat berlangsungnya aktivitas. Secara garis besar beberapa jenis olah raga yang membutuhkan saranan lapangan adalah Tenis, Futsal, Basket, dan Badminton. Untuk setiap jenis lapangan memiliki ukuran atau dimensi yang berbeda-beda.</p>
                      </center>
                  </div>
                   <div class="col-1"></div>
                </div>
              </div>
              <!-- Left and right controls -->
              <a class="carousel-control-prev" href="#demo2" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#demo2" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>


            </div>  

        </div>






 <!--
  </div>

  <div class="col-1"></div>

  <div class="col-3">
    <h1><b>Top Deals</b></h1>
    <div style="width: 100%; height: 500px; background-color: #f8f9fa">
                      <br>
                       <div class="row" style="background-color: white;">
                           <div class="col-1" style="margin:auto;"><h4>1.</h4></div>
                           <div class="col-4"><img src="img/cr.jpg" style="width: 100px; height: 70px;"></div>
                           <div class="col-7" style="margin: auto;">Abc Sports</div>
                      </div>
                      <br>
                      <div class="row" style="background-color: white;">
                           <div class="col-1" style="margin:auto;"><h4>2.</h4></div>
                           <div class="col-4"><img src="img/cr.jpg" style="width: 100px; height: 70px;"></div>
                           <div class="col-7" style="margin: auto;">Abc Sports</div>
                      </div>
                      <br>
                      <div class="row" style="background-color: white;">
                           <div class="col-1" style="margin:auto;"><h4>3.</h4></div>
                           <div class="col-4"><img src="img/cr.jpg" style="width: 100px; height: 70px;"></div>
                           <div class="col-7" style="margin: auto;">Abc Sports</div>
                      </div>
                      <br>
                      <div class="row" style="background-color: white;">
                           <div class="col-1" style="margin:auto;"><h4>4.</h4></div>
                           <div class="col-4"><img src="img/cr.jpg" style="width: 100px; height: 70px;"></div>
                           <div class="col-7" style="margin: auto;">Abc Sports</div>
                      </div>
                      <br>
                      <div class="row" style="background-color: white;">
                           <div class="col-1" style="margin:auto;"><h4>5.</h4></div>
                           <div class="col-4"><img src="img/cr.jpg" style="width: 100px; height: 70px;"></div>
                           <div class="col-7" style="margin: auto;">Abc Sports</div>
                      </div>


    </div>
  </div>

  <div class="col-1"></div>
</div>

<br>
<div class="row">
  <div class="col-1"></div>
  <div class="col-11"><h3><b>Based on Sports</b></h3></div>
</div>

<div class="row">
  <div class="col-1"></div>
  <div class="col-2" style="padding: 10px;background-color: #f8f9fa ">
    <center>
      <img src="img/cr.jpg" style="width: 230px; height: 170px; display: block">
      <h4>Futsal</h4>
    </center>
  </div>
   <div class="col-2" style="padding: 10px;background-color: #f8f9fa ">
    <center>
      <img src="img/cr.jpg" style="width: 230px; height: 170px; display: block">
      <h4>Basket</h4>
    </center>
  </div>
   <div class="col-2" style="padding: 10px;background-color: #f8f9fa ">
    <center>
      <img src="img/cr.jpg" style="width: 230px; height: 170px; display: block">
      <h4>Volley</h4>
    </center>
  </div>
   <div class="col-2" style="padding: 10px;background-color: #f8f9fa ">
    <center>
      <img src="img/cr.jpg" style="width: 230px; height: 170px; display: block">
      <h4>Badminton</h4>
    </center>
  </div>
   <div class="col-2" style="padding: 10px;background-color: #f8f9fa ">
    <center>
      <img src="img/cr.jpg" style="width: 230px; height: 170px; display: block">
      <h4>Mini Soccer</h4>
    </center>
  </div>

  <div class="col-1""></div>
</div>

<br>
<br>
  -->
</body>
</html>