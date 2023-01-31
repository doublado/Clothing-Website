<?php
	# Enabling error display
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	session_start();

    require __DIR__ . "/assets/lib/crud.php";
    require __DIR__ . "/assets/lib/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Nikolaj Jakobsen">
	<meta name="description" content="Restyled - Genbrug, der aldrig går af mode.">
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Restyled | Login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" height="55" width="auto" alt="logo" draggable="false"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="#navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Hjem</a>
					</li>
					<li class="nav-item">
                        <a class="nav-link" href="stores.php">Butikker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clothing.php">Produkter</a>
					</li>
				</ul>
				<ul class="navbar-nav ms-auto">
				<?php
                    if (is_loggedin()) {
						echo '<a class="btn btn-outline-primary" href="logout.php">Log ud</a>';
					} else {
						echo '<a class="btn btn-outline-primary" href="login.php">Login</a>';
					}
				?>
				</ul>
			</div>
		</div>
	</nav>
	<section class="center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-section text-white">
						<div class="card-header">
							<h3 class="card-title">Login</h3>
						</div>
						<div class="card-body login">
							<form action="loginfunc.php" method="post">
								<div class="form-group" style="margin-bottom: 10px;">
									<label for="username">Brugernavn</label>
									<input class="form-control dou-input" type="text" name="username" class="form-control" id="username" placeholder="Brugernavn" required>
								</div>
								<div class="form-group" style="margin-bottom: 10px;">
									<label for="password">Adgangskode</label>
									<input class="form-control dou-input" type="password" name="password" class="form-control" id="password" placeholder="Adgangskode" required>
								</div>
								<button type="submit" class="btn btn-primary">Login</button>
								<a class="login-text" href="register.php">Opret konto</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
        document.querySelector(".login form").onsubmit = function(event) {
            event.preventDefault();
            var form_data = new FormData(document.querySelector(".login form"));
            var xhr = new XMLHttpRequest();
            xhr.open("POST", document.querySelector(".login form").action, true);
            xhr.onload = function () {
                if (this.responseText.toLowerCase().indexOf("success") !== -1) {
                    window.location.href = "index.php";
                } else {
                    document.querySelector(".errormessage").innerHTML = this.responseText;
                }
            };
            xhr.send(form_data);
        };
    </script>
	<link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <footer>
        <div class="container">
            <div style="color: #fff;">
                &copy; Copyright <?php echo date("Y");?> Nikolaj Jakobsen, Alle rettigheder forbeholdes.
            </div>   
        </div>
    </footer>
</body>
</html>