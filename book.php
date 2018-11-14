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
  
  require 'functions.php';

  $lapangan = query("SELECT * FROM lapangan WHERE lapanganID = '$_GET[lapangan]' AND tempatID = '$_GET[tempat]'");

  $tempat = query("SELECT * FROM tempat WHERE tempatID = '$lapangan[tempatID]'");





if(isset($_POST["book"])){

$conn = mysqli_connect("localhost", "root","", "earenadb");



$dateAndTime = $_POST['dateTime'];




$check = mysqli_query($conn, "SELECT dateAndTime FROM booking
  WHERE dateAndTime = '$dateAndTime'");

if(mysqli_fetch_assoc($check)){

  echo "<script>
      alert('tempat telah di booking!')
    </script>
  ";

}

if ($baris['userMoney']>= $lapangan['lapanganPrice']) {
  $userMoneyBaru = $baris['userMoney'] - $lapangan['lapanganPrice'];

  mysqli_query($conn, "UPDATE user SET userMoney = '$userMoneyBaru' WHERE userName = '$baris[userName]'");
  mysqli_query($conn, "INSERT INTO booking VALUES('$tempat[tempatID]', '$lapangan[lapanganID]', '$dateAndTime', '$baris[userName]')");
}

else {
    echo "<script>
      alert('Saldo anda tidak cukup!')
    </script>
  ";
}





if(mysqli_affected_rows($conn)>0){

  echo "<script>

    alert('BERHASIL booking!');
    document.location.href = 'profile.php';
  </script>";
}
else {

  echo "<script>

    alert('GAGAL booking!');

  </script>";
}


}
   
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
 <title>eArena | Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

 

  <style type="text/css">
    .*{
      margin: 0px;
      padding: 0px;
    }
  </style>


</head>
<body style="background-color: black; background-image: url('img/background.png'); width: 100%; height: auto; background-position: center; font-family: default" data-spy = "scroll" data-target="sticky-content">
  


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


<!-- <div class="card example-1 square scrollbar-cyan bordered-cyan">
      
-->
<div class="row" style="padding-top: 20px; color: white;">
  <div class="col-3"></div>
  <div class="col-6" style="background-color: #1e1e1e; padding: 20px;">
    <div></div>
            <div class="row">
              <div class="col-6" style="padding: auto; margin: auto;">
                <img src="img/<?php echo $lapangan['lapanganPicture']; ?>" style=" margin:auto; width: 320px; height: auto;">
              </div>
              <div class="col-6" style="margin: auto; padding-left: 30px;">
                <div class="row" ></div>
                    <div class="col-12">  
                      <b style="font-size: 30px;">
                        <span style="font-size:30pt"><?php echo $lapangan['lapanganName']; ?></span><br>
                        <?php echo $tempat['tempatName']; ?>
                      </b>
                    </div>
             <form action="" method="POST" style="border-top-style: solid; border-top-color: white; margin-top: 10px; padding-top: 10px;border-top-width: 1px;">
                    <div class="col-12" style="border-bottom-style: solid; border-bottom-color: white; border-bottom-width: 1px;margin-bottom: 15px;">
                      <h5>Choose Date & Time:</h5>

    <input size="16" type="text" name="dateTime" placeholder="YYYY-MM-DD hh:mm">          	 
                      <br>Format: YYYY-MM-DD hh:mm
                      <hr>
                    </div>
                     
                    <div class="row">
                      <div class="col-6"> 
                          <div class="row"> 
                              <div class="col-12" style="text-align: right;">Total Price: Rp <?php echo $lapangan['lapanganPrice']; ?>,-</div>
                              <div class="col-12" style="text-align: right;">Your Balance: Rp <?php 
                                    if ($_SESSION["type"] == "user") {
                                                        echo $baris['userMoney'];
                                        }

                                    else if($_SESSION["type"] == "owner"){
                                        
                                    }


                                     ?>,-</div>
                          </div>
                      </div>
                      <div class="col-6" style="padding-right: 25px;"> <button class="btn btn-success" name="book" style="width: 100%;">Book!</button>
               </form>



                        

                      </div>
                    </div>
                    
              </div>
            </div>

            
  </div>
  <div class="col-3"></div>
  </div>

</div>





<br><br>



<style type="text/css">




</style>




</body>
</html>