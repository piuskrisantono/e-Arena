<?php

session_start();

//USEROWNER
if(!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}
$conn = mysqli_connect("localhost", "root","", "earenadb");
/*
if ($_SESSION["type"] == "user") {
  $hasil = mysqli_query($conn,"SELECT * FROM user WHERE userName = '$_SESSION[userName]'");
$baris = mysqli_fetch_assoc($hasil);

  $booking = mysqli_query($conn,"SELECT * FROM booking WHERE userName = '$_SESSION[userName]'");
}
}*/

if ($_SESSION["type"] == "user") {
  $hasil = mysqli_query($conn,"SELECT * FROM user WHERE userName = '$_SESSION[userName]'");
$baris = mysqli_fetch_assoc($hasil);

  $booking = mysqli_query($conn,"SELECT * FROM booking WHERE userName = '$_SESSION[userName]' ORDER BY dateAndTime");

  function getNameTempat($tempatID) {
  	$conn = mysqli_connect("localhost", "root","", "earenadb");
  	$tempatTemp = mysqli_query($conn,"SELECT * FROM tempat WHERE tempatID ='$tempatID' ");
  	$listTempat = mysqli_fetch_assoc($tempatTemp);
  	return $listTempat['tempatName'];
  }

    function getNameLapangan($lapanganID) {
  	$conn = mysqli_connect("localhost", "root","", "earenadb");
  	$lapanganTemp = mysqli_query($conn,"SELECT * FROM lapangan WHERE lapanganID ='$lapanganID' ");
  	$listLapangan = mysqli_fetch_assoc($lapanganTemp);
  	return $listLapangan['lapanganName'];
  }


}

else if($_SESSION["type"] == "owner"){
    $hasil = mysqli_query($conn,"SELECT * FROM owner WHERE ownerName = '$_SESSION[ownerName]'");
    $baris = mysqli_fetch_assoc($hasil);

    $tempat = mysqli_query($conn,"SELECT * FROM tempat WHERE ownerName = '$_SESSION[ownerName]'");
    $tempatHasil = mysqli_fetch_assoc($tempat);


    $booking = mysqli_query($conn,"SELECT * FROM booking WHERE tempatID = '$tempatHasil[tempatID]' ORDER BY dateAndTime");

    function getNameTempat($tempatID) {
  	$conn = mysqli_connect("localhost", "root","", "earenadb");
  	$tempatTemp = mysqli_query($conn,"SELECT * FROM tempat WHERE tempatID ='$tempatID' ");
  	$listTempat = mysqli_fetch_assoc($tempatTemp);
  	return $listTempat['tempatName'];
  }

    function getNameLapangan($lapanganID) {
  	$conn = mysqli_connect("localhost", "root","", "earenadb");
  	$lapanganTemp = mysqli_query($conn,"SELECT * FROM lapangan WHERE lapanganID ='$lapanganID' ");
  	$listLapangan = mysqli_fetch_assoc($lapanganTemp);
  	return $listLapangan['lapanganName'];
  }

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
<body style="background-color: black;">
  


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


<div class="container" style="padding: 20px;background-color: #1e1e1e; color: white;">
	


		<div class="row">
			<div class="col-12">
			<center>
		     <img src="img/<?php 
                  if ($_SESSION["type"] == "user") {
                                      echo $baris['userPicture'];
                      }

                  else if($_SESSION["type"] == "owner"){
                      echo $baris['ownerPicture'];
                  }


                 ?>" class="rounded-circle" style="height: 300px; width: 300px;">  
            </center>
            </div>

            <div class="col-12">
			<center>
			<h1>
			<?php 
                  if ($_SESSION["type"] == "user") {
                                      echo $baris['userName'];
                      }

                  else if($_SESSION["type"] == "owner"){
                      echo $baris['ownerName'];
                  }
                 ?>
             </h1>
             </center>
             </div>
             <div class="col-12">
             	<center><?php 
                  if ($_SESSION["type"] == "user") {
                  					echo "Rp ";
                                      echo $baris['userMoney'];
                                      echo ",-";
                      }		

                  else if($_SESSION["type"] == "owner"){
                     
                  }
                 ?></center>
                 <br>	
             	<center><b style="font-size: 30px;">My Bookings:</b></center>

	
            		<table class="table">
						    <thead>
						      <tr>
						      	<th>No.</th>
						        <th>Tempat</th>
						        <th>Lapangan</th>
						        <th>Date and Time</th>
						        	<?php 
						                  if ($_SESSION["type"] == "user") {
						                                     
						                      }

						                  else if($_SESSION["type"] == "owner"){
						                      echo "<th>Username</th>";
						                  }
						                 ?>
						        
						      </tr>
						    </thead>

						    <tbody>
						     

						      <?php $i=1; while ($list = mysqli_fetch_assoc($booking)) { ?>
						      	<tr>

						      		<td><?php echo $i; ?></td>
						       		<td><?php echo getNameTempat($list['tempatID']) ?></td>
						       		<td><?php echo getNameLapangan($list['lapanganID']) ?></td>
						       		<td><?php echo $list['dateAndTime'] ?></td>
						       			<?php 
						                  if ($_SESSION["type"] == "user") {
						                                     
						                      }

						                  else if($_SESSION["type"] == "owner"){?>
						                       <td><?php echo $list['userName'];?></td>
						                  
						                 <?php }?>
						       		
						       	</tr>
						      
						      <?php $i++;}  ?>
						     



						      

						    </tbody>
					</table>


             </div>

          </div>


</div>

  


  






</body>
</html>