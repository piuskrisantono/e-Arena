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



$conn = mysqli_connect("localhost", "root","", "earenadb");

$result = mysqli_query($conn, "SELECT * FROM tempat, lapangan WHERE tempat->tempatID = lapangan->lapanganID AND                                  tempatID = $_GET[tempat] ");

$tempat = mysqli_query($conn, "SELECT * FROM tempat WHERE tempatID = '$_GET[tempat]'");

$slider =mysqli_query($conn, "SELECT * FROM lapangan WHERE tempatID = '$_GET[tempat]'");

$sliderinner =mysqli_query($conn, "SELECT * FROM lapangan WHERE tempatID = '$_GET[tempat]'");

$lapanganlist = mysqli_query($conn, "SELECT * FROM lapangan WHERE tempatID = '$_GET[tempat]'");

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eArena | Tangkas Sports</title>
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
<body style="background-color: black" data-spy = "scroll" data-target="sticky-content">
  


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

  </div>
</nav>

<div class="row" style="height: 550px; width: 100%">
          <div class="col-8">

                   <div id="demo" class="carousel slide" data-ride="carousel" style="width: 100%;height: 100%; color: white;" >

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <?php  
                      $i=0;
                            while($sld= mysqli_fetch_assoc($slider)):

                            ?>

                      <li data-target="#demo" data-slide-to="<?php echo $i; ?>"  <?php if($i==0){ ?>class="active"<?php } ?>></li>

                            <?php $i++; ?>

                      <?php endwhile ?>
                    </ul>
                    
                    <!-- The slideshow -->
                    <div class="carousel-inner" style="height: 100%">
                           <?php  
                            $j=0;
                            while($sldin= mysqli_fetch_assoc($sliderinner)):

                            ?>
                            <div class="carousel-item <?php if($j==0){ ?>active <?php } ?>" style="background-image: url('img/<?php echo $sldin['lapanganPicture']; ?>'); background-size: 100%; height: 545px; background-position: center;background-repeat: no-repeat;">
                              <div class="carousel-caption"> 
                              </div>
                            </div>
                            <?php 
                              $j++;
                            endwhile
                             ?>

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



  <div class="col-4" style="color:white;">
    <div class="row">
        <div class="col-12" style="height: 350px;">
          <br>
          <?php  
                            while($desc= mysqli_fetch_assoc($tempat)):

          ?>

          <h1 style="height: 80px"><?php echo $desc['tempatName'] ?></h1>
          <p><?php echo $desc['tempatDesc']; ?></p>
        <?php endwhile ?>

        </div>
        <div class="col-12" style="background-color: black; color: white; padding: 0px; height: 100%;">
            <div class="card example-1 square scrollbar-cyan bordered-cyan" style="padding: 0px; background-color: black;">
            <div class="card-body" style="margin: 0px; padding: 0px; background-color: black">
                  <h4>      
                          <?php 
                          $num=0;
                              while ($list= mysqli_fetch_assoc($lapanganlist)) :
                                $num++;
                              
                            ?>
                                    <div class="row" style="background-color: #1e1e1e;margin: 3px;">
                                         <div class="col-1" style="margin: auto;"><h4><?php echo $num; ?></h4></div>
                                         <div class="col-3"><img src="img/<?php echo $list['lapanganPicture']; ?>" style="width: 100px; height: 70px;"></div>
                                         <div class="col-5" style="margin: auto; padding-left: 30px;">
                                            <div class="row">
                                              <?php echo $list['lapanganName']; ?>
                                            </div>
                                            <div class="row">
                                             <span style="font-size: 20px;">Rp <?php echo $list['lapanganPrice']; ?> ,-</span>
                                            </div>
                                         </div>
                                         <div class="col-3" style="margin: auto;padding-right: 20px;"><a href="book.php?lapangan=<?php echo $list['lapanganID']; ?>"><button type="button" class="btn btn-success">Book</button></a></div>
                                    </div>
                          <?php endwhile ?>
            </div>
        </div>
 
            </div>
        </div>
        </div>
    </div>

  </div>

</div>

<!-- <div class="card example-1 square scrollbar-cyan bordered-cyan">
      
-->

<style type="text/css">





.scrollbar-cyan::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
}

.scrollbar-cyan::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-cyan::-webkit-scrollbar-thumb {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #00bcd4; }


.bordered-cyan::-webkit-scrollbar-track {
  -webkit-box-shadow: none;
  border: 10px solid #00bcd4; }

.bordered-cyan::-webkit-scrollbar-thumb {
  -webkit-box-shadow: none; }

.square::-webkit-scrollbar-track {
  border-radius: 0 !important; }

.square::-webkit-scrollbar-thumb {
  border-radius: 0 !important; }

.thin::-webkit-scrollbar {
  width: 6px; }

.example-1 {
  position: relative;
  overflow-y: scroll;
  height: 200px; }
          

</style>

</body>
</html>