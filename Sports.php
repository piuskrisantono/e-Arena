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

if ($_GET["id"]=='all') {
 $result = mysqli_query($conn, "SELECT * FROM tempat");
}

else {

    $tempatIDlapangan = mysqli_query($conn, "SELECT tempatID FROM lapangan WHERE lapanganTipe = '$_GET[id]' GROUP BY tempatID");

    $z=0;

    while($tempatTipe = mysqli_fetch_assoc($tempatIDlapangan)){
        $simpanTipe[$z] = $tempatTipe['tempatID'];
        $z++;

    }



     $result = mysqli_query($conn, "SELECT * FROM tempat");



}



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eArena | Places</title>
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
<body style="background-color: #1e1e1e" data-spy = "scroll" data-target="sticky-content">
  



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

<div style="z-index: -3;">
<div class="row" >
<!-- Page content -->


  <div class="container">
  
                  <div class="row" style="margin:0 20px 30px 20px; width:97%;">
                      <!--<div class="col-4" style="padding: 20px;"><div style="width: 100%; height: 100%; background-image: url('img/futsal/1.jpg');background-repeat: no-repeat; background-position: center; background-size: 120%;  border-radius: 10px; border-bottom-style: solid; border-bottom-width: 40px;"></div></div>-->
                       <?php  
                            while($row = mysqli_fetch_assoc($result)):
                              if($_GET["id"]=='all'){?>
  
                                        <div class="col-4" style="padding: 20px">
                                            <div class="card col-12" style="padding-top: 10px; padding-bottom: 10px;height: 400px">
                                              <div style="height: 200px; width: auto; line-height: 20 0px;">
                                                  <img class="card-img-top" style="height: 100%; width: 100%;" src="img/<?php echo $row['tempatPicture']; ?>" alt="Card image cap">
                                              </div>
                                              <div class="card-body">
                                                <h5 class="card-title"><b><?php echo $row['tempatName']; ?></b></h5>
                                                <p class="card-text" style="color: #686868"><?php echo $row['tempatAddress'] ?></p>
                                              
                                                   <a href="detail.php?tempat=<?php echo $row['tempatID']; ?>" class="btn btn-success" style="bottom: 20px; right: 15px; position: absolute;">Book Now</a>

                                              </div>
                                             </div>
                                        </div>







                              <?php }
                              else{

                                  if(in_array($row['tempatID'], $simpanTipe)){

                             ?>
  
                                        <div class="col-4" style="padding: 20px">
                                            <div class="card col-12" style="padding-top: 10px; padding-bottom: 10px;height: 400px">
                                              <div style="height: 200px; width: auto; line-height: 20 0px;">
                                                  <img class="card-img-top" style="height: 100%; width: 100%;" src="img/<?php echo $row['tempatPicture']; ?>" alt="Card image cap">
                                              </div>
                                              <div class="card-body">
                                                <h5 class="card-title"><b><?php echo $row['tempatName']; ?></b></h5>
                                                <p class="card-text" style="color: #686868"><?php echo $row['tempatAddress'] ?></p>
                                              
                                                   <a href="detail.php?tempat=<?php echo $row['tempatID']; ?>" class="btn btn-success" style="bottom: 20px; right: 15px; position: absolute;">Book Now</a>

                                              </div>
                                             </div>
                                        </div>


                        <?php 
                               }
                            }

                        endwhile;
                       ?>


                    </div>  
</div>



</div>

</div>




<style type="text/css">

.side-content{
    text-decoration: none;
    font-size: 30px;
    color: white;
    display: block;
}

.side-content:hover(.active){

}


.card{
  height: 425px;
  overflow: hidden;
}

</style>

</body>
</html>