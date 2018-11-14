
<?php

$conn = mysqli_connect("localhost", "root", "", "earenadb");

function upload(){
	$namaFile = $_FILES['userPicture']['name'];
	$ukuranFile = $_FILES['userPicture']['size'];
	$error = $_FILES['userPicture']['error'];
	$tempName = $_FILES['userPicture']['tmp_name'];

	if ($error === 4) {
		echo "<script>
			alert('Pilih gamabr terlebih dahulu!')
			document.location.href = 'registrasi.php';

		</script>";
		return false;
	}

	$ekstensiGambarValid =['jpg', 'jpeg', 'png'];

	$ekstensiGambar = explode('.', $namaFile);

	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){

		echo "<script>
			alert('yang anda upload bukan gambar!');
			document.location.href = 'registrasi.php';
		</script>";

		die;
	}

	if ($ukuranFile > 5000000) {
		echo "<script>
			alert('ukuran gambar terlalu besar!');
			document.location.href = 'registrasi.php';
		</script>";
		die;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tempName, 'img/'. $namaFileBaru);

	return $namaFileBaru;
}


function uploadOwner(){
	$namaFile = $_FILES['ownerPicture']['name'];
	$ukuranFile = $_FILES['ownerPicture']['size'];
	$error = $_FILES['ownerPicture']['error'];
	$tempName = $_FILES['ownerPicture']['tmp_name'];

	if ($error === 4) {
		echo "<script>
			alert('Pilih gamabr terlebih dahulu!')
			document.location.href = 'registrasi.php';
		</script>";
		return false;
	}

	$ekstensiGambarValid =['jpg', 'jpeg', 'png'];

	$ekstensiGambar = explode('.', $namaFile);

	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){

		echo "<script>
			alert('yang anda upload bukan gambar!');
			document.location.href = 'registrasi.php';
		</script>";
		die;
	}

	if ($ukuranFile > 5000000) {
		echo "<script>
			alert('ukuran gambar terlalu besar!');
			document.location.href = 'registrasi.php';
		</script>";
		die;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tempName, 'img/'. $namaFileBaru);

	return $namaFileBaru;

}


if(isset($_POST["submit"])){


$userName = $_POST['userName'];

$userPassword = $_POST['userPassword'];

$gambar = upload();

if (!$gambar) {
	return false;
}

$check = mysqli_query($conn, "SELECT userName FROM user
	WHERE userName = '$userName'");

if(mysqli_fetch_assoc($check)){

	echo "<script>
			alert('username telah terdaftar!')
			document.location.href = 'registrasi.php';
		</script>
	";
	die;
}


mysqli_query($conn, "INSERT INTO user VALUES('$userName', '$userPassword', '$gambar','')");


if(mysqli_affected_rows($conn)>0){

	echo "<script>

		alert('BERHASIL terdaftar!');
		document.location.href = 'login.php';
	</script>";
}
else {

	echo "<script>

		alert('GAGAL terdaftar!');
		document.location.href = 'registrasi.php';
	</script>";
}


} 

if(isset($_POST["submit2"])){

$ownerName = $_POST['ownerName'];

$ownerPassword = $_POST['ownerPassword'];

$gambarOwner = uploadOwner();

if (!$gambarOwner) {
	return false;
}




mysqli_query($conn, "INSERT INTO owner VALUES('$ownerName', '$ownerPassword', '$gambarOwner')");



if(mysqli_affected_rows($conn)>0){

	echo "<script>

		alert('BERHASIL terdaftar!');
		document.location.href = 'login.php';
	</script>";
}
else {

	echo "<script>

		alert('GAGAL terdaftar!');
		document.location.href = 'registrasi.php';
	</script>";
}


} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eArena | Sign in</title>
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
<body style="background-image: url('img/signinbackground.jpg'); background-size: 100%; background-repeat: no-repeat;">


<div class="row" style="height: 150px;"></div>

<div class="row">
	
	<div class="col-4"></div>
	<div class="col-4"></div>
	<div class="col-4" style="padding: 20px 50px 20px 50px; color: white; border-radius: 10px;">
		<center>
			<h3> <b style="font-size: 50px;">Register</b></h3>
			<br>
			  <ul class="nav nav-tabs" style="color: white;">
			    <li class="active" style="width: 70px;background-color: maroon;"><a style="text-decoration: none; color:white;" data-toggle="tab" href="#home" >User</a></li>
			    <li style="background-color: white;width: 70px;"><a data-toggle="tab" href="#menu1" style="text-decoration: none; color:black" >Owner</a></li>
			    <li style="background-color: green;width: 70px;"><a href="login.php" style="text-decoration: none; color:white" >log in</a></li>
			  </ul>

			  <div class="tab-content" style=" color:black;">
			    <div id="home" class="tab-pane fade in active" style="background-color: maroon; color:white;padding:10px;border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
			    	as User
						<form action="" method="POST" name="reg" enctype="multipart/form-data">
							<p>		
							<div class="isi"><b>Username:</b></div>
							<input type="text" id="userName" name="userName" placeholder="Input your Username" style="width: 300px; height: 25px" required>
							</p> 	

							<p>
							<div class="isi"><b>Password:</b></div>
							<input type="Password" id="userPassword" name="userPassword" placeholder="Input your Password" style="width: 300px; height: 25px" required>
							</p>

							<p>				
							<div class="isi">Profile Picture</div>
							<input type="file" id="userPicture" name="userPicture">			
							</p>
							<br><br>				

							<CENTER>	
								<table>
									<tr>
										<td colspan="3" id="button">
										<button class="btn btn-success" type="submit" name="submit" style="margin-right: 10px;">Submit</button>
										<button class="btn btn-light" type="reset" name="reset">Reset</button>
										</td>
									</tr>
								</table>
							</CENTER>			
						</form>
			    </div>
			    <div id="menu1" class="tab-pane fade" style="background-color: white; padding:10px;border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
			    	as Owner
					<form action="" method="POST" name="reg" enctype="multipart/form-data">
						<p>		
						<div class="isi"><b>Username:</b></div>
						<input type="text" id="ownerName" name="ownerName" placeholder="Input your Username" style="width: 300px; height: 25px" required>
						</p> 	

						<p>
						<div class="isi"><b>Password:</b></div>
						<input type="Password" id="ownerPassword" name="ownerPassword" placeholder="Input your Password" style="width: 300px; height: 25px" required>
						</p>

						<p>				
						<div class="isi">Profile Picture</div>
						<input type="file" id="ownerPicture" name="ownerPicture">			
						</p>
						<br><br>				

						<CENTER>	
							<table>
								<tr>
									<td colspan="3" id="button">
									<button class="btn btn-success" type="submit2" name="submit2" style="margin-right: 10px;">Submit</button>
										<button class="btn btn-light" type="reset2" name="reset2">Reset</button>
									</td>
								</tr>
							</table>
						</CENTER>			
					</form>
			    </div>

			  </div>


		</center>
	</div>

</div>


</body>
</html>