<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="asset/css/style.css"> -->
    <link rel="icon" href="asset/img/logo.png" type="image/x-icon">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <style>	
		body {
		    font-family: 'Century Gothic' ,'Poppins' ,Montserrat ,Georgia, times new roman, Times, Merriweather, Cambria, Times, serif;
		    font-weight: 300;
		    font-size: 16px;
		    line-height: 2;
		    background-color: #C6D7EB; 
		    color: #4d4b4b;
		}
		.centerDiv {
			height: 100vh;
			width: 100%;
		}
	</style>	
</head>
<body>
	<div class="container-fluid">	
		<div class="row centerDiv">
			<div class="col-sm-12 my-auto">
				<div class="card border-0">
				  <div class="row">
				    <div class="col-md-8">
				      <div class="card-body">
				      	<img src="asset/img/home.JPG" class="img-fluid rounded-start shadow" alt="ROTA.jpg">
				      </div>
				    </div>
				    <div class="col-md-4">
				      <div class="card-body">
				      	<div class="mb-5 text-center">
				      		<img src="asset/img/logo.png" class="img-fluid mt-5" width="150" alt="logo smk" title="SMKN 1 ROTA Bayat">
				      		<h2 class="h5 mt-4">Login</h2>
				      	</div>
			      		<form name="login" action="ceklogin.php" method="POST">
			      		  <div class="mb-3">
			      		    <input type="text" name="username" id="username" class="form-control border-success text-center" placeholder="Username" required/>
			      		    <div id="usernameHelp" class="form-text">Isi dengan username anda</div>
			      		  </div>
			      		  <div class="mb-3">
			      		    <input type="password" name="password" id="password" class="form-control border-success text-center" placeholder="Password" required/>
			      		     <div id="passHelp" class="form-text">Isi dengan password anda</div>
			      		  </div>
						  <div class="form-outline form-white mb-3">
							<select name="level" class="form-select form-select-lg mb-3 text-center bg-primary text-white" aria-label=".form-select-lg example" required>
								<option selected>Select User</option>
								<option value="admin">Admin</option>
								<option value="guru">Guru</option>
								<option value="siswa">Siswa</option>
							</select>
						  </div>
			      		  <button class="btn btn-primary w-100" name="login" type="submit">Login</button>
			      		</form>
				      </div>
				    </div>
					<footer class="text-center">SMK Negeri 1 ROTA Bayat &copy; 2022</footer>
				  </div>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>