<?php
	# Enabling error display
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	session_start();

    require __DIR__ . "/assets/lib/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Nikolaj Jakobsen">
	<meta name="description" content="Restyled - Find det nye i det gamle.">
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Restyled | Hjem</title>
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
					<li class="nav-item active">
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
    <section style="margin-top: 105px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 offset-md-3 col-lg-8 offset-lg-2 offset-xl-2">
                    <center>
                        <img class="img-fluid" src="assets/img/logo.png" alt="pagelogo" style="height: 200px; width: auto;" draggable="false">
						<p style="font-size: 1.5rem; font-weight: 600; color: #00a797;">Find det nye i det gamle</p>
						<button type="button" class="btn btn-primary btn-lg" style="margin-top: 20px;" href="stores.php">Find butikker</button>
                    </center>
                </div>
			</div>
		</div>
	</section>
	<section style="margin-top: 50px; margin-bottom: 50px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="card bg-section text-white" style="height: 200px;">
						<div class="card-body text-center">
							<h5 class="card-title" style="font-weight: 600;">Nemt og hurtigt</h5>
							<p class="card-text">Vores hjemmeside er nem og hurtig på grund af sin brugervenlige design og en optimal brugeroplevelse. Navigationen er enkel og intuitiv, så du hurtigt kan finde det, du leder efter. Det er også hurtigt at indlæse siderne, så du sparer tid og kan fokusere på det, der er vigtigst for dig. Alt i alt er vores hjemmeside en nem, hurtig og effektiv løsning, der er designet med din tid og dine behov i tankerne.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="card bg-section text-white" style="height: 200px;">
						<div class="card-body text-center">
							<h5 class="card-title" style="font-weight: 600;">Bæredygtigt</h5>
							<p class="card-text">Vi går op i bæredygtighed, fordi vi er opmærksomme på den påvirkning, vores handlinger har på klimaet. Vi tror på, at vi alle kan gøre en forskel og bidrage til en grønnere fremtid. Derfor tager vi ansvar og arbejder aktivt på at reducere vores miljøpåvirkning, så vi kan bidrage til en mere bæredygtig verden for fremtidige generationer. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<br>
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