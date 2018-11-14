
<?php

session_start();


if(isset($_SESSION["login"])){
  header("Location: home.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "earenadb");

if (isset($_POST['login'])) {
	$userName = $_POST['userName'];
	$userPassword = $_POST['userPassword'];

	$result = mysqli_query($conn,"SELECT * FROM user WHERE userName = '$userName'");

	if(mysqli_num_rows($result)===1){
		$row = mysqli_fetch_assoc($result);
		if ($userPassword == $row['userPassword']) {
			
			$_SESSION["login"]= true;
			$_SESSION["type"] = "user";
			$_SESSION["userName"] = $userName;

			header("Location: home.php");
			exit;
		}

		$error = true;
	}
}


if (isset($_POST['login2'])) {
	$ownerName = $_POST['ownerName'];
	$ownerPassword = $_POST['ownerPassword'];

	$result = mysqli_query($conn,"SELECT * FROM owner WHERE ownerName = '$ownerName'");

	if(mysqli_num_rows($result)===1){
		$row = mysqli_fetch_assoc($result);
		if ($ownerPassword == $row['ownerPassword']) {

			$_SESSION["login"]= true;
			$_SESSION["type"] = "owner";
			$_SESSION["ownerName"] = $ownerName;


			header("Location: home.php");
			exit;
		}

		$error = true;


	}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>eArena | Log in</title>
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
<body style="background-image: url('img/loginbackground.jpg'); background-size: 100%; background-repeat: no-repeat;">




<div class="row" style="height: 150px;"></div>

<div class="row">
	

	<div class="col-4" style="padding: 20px 50px 20px 50px; color: white; border-radius: 10px;">
		<center>
			<h3> <b style="font-size: 50px;">Log in</b></h3>
			<br>
			  <ul class="nav nav-tabs" style="color: white;">
			    <li class="active" style="width: 70px;background-color: maroon;"><a style="text-decoration: none; color:white;" data-toggle="tab" href="#home" >User</a></li>
			    <li style="background-color: white;width: 70px;"><a data-toggle="tab" href="#menu1" style="text-decoration: none; color:black" >Owner</a></li>
			    <li style="background-color: green;width: 70px;"><a href="registrasi.php" style="text-decoration: none; color:white" >Register</a></li>
			  </ul>

			  <div class="tab-content" style=" color:black;">
			    <div id="home" class="tab-pane fade in active" style="background-color: maroon; color:white;padding:10px;border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
			    	as User
						<form action="" method="POST" name="reg">
							<p>		
							<div class="isi"><b>Username:</b></div>
							<input type="text" id="userName" name="userName" placeholder="Input your Username" style="width: 300px; height: 25px" required>
							</p> 	

							<p>
							<div class="isi"><b>Password:</b></div>
							<input type="Password" id="userPassword" name="userPassword" placeholder="Input your Password" style="width: 300px; height: 25px" required>
							</p>			

							<CENTER>	
								<table>
									<tr>
										<td colspan="3" id="button">
										<button class="btn btn-success" type="submit" name="login" style="margin-right: 10px;">Submit</button>
										<button class="btn btn-light" type="reset" name="reset">Reset</button>
										</td>
									</tr>
								</table>
							</CENTER>			
						</form>
			    </div>
			    <div id="menu1" class="tab-pane fade" style="background-color: white; padding:10px;border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
			    	as Owner
					<form action="" method="POST" name="reg">
						<p>		
						<div class="isi"><b>Username:</b></div>
						<input type="text" id="ownerName" name="ownerName" placeholder="Input your Username" style="width: 300px; height: 25px" required>
						</p> 	

						<p>
						<div class="isi"><b>Password:</b></div>
						<input type="Password" id="ownerPassword" name="ownerPassword" placeholder="Input your Password" style="width: 300px; height: 25px" required>
						</p>			

						<CENTER>	
							<table>
								<tr>
									<td colspan="3" id="button">
									<button class="btn btn-success" type="submit2" name="login2" style="margin-right: 10px;">Submit</button>
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

		<div class="col-4"></div>
	<div class="col-4"></div>

</div>

</body>
</html>