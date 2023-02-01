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
	<title>Restyled | Butikker</title>
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
					<li class="nav-item active">
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
	<!-- Create a grid of cards with the stores -->
	<section style="margin-top: 105px;">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12 col-md-6 offset-md-3 col-lg-8 offset-lg-2 offset-xl-2">
                    <h2 style="font-weight: 800; font-size: 2rem; color: #fff;">Butikker</h2>
                </div>
            </div>
			<div class="row text-center" style="margin-top: 25px;">
				<?php
					$stmt = $pdo->prepare("SELECT * FROM stores");
					$stmt->execute();
					$stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

					if ($stmt->rowCount() > 0) {
						if (is_loggedin()) {
							echo '<div class="col-xl-4" style="margin-bottom: 25px;">';
							echo '<a style="text-decoration: none; color: inherit;" href="createstore.php">';
							echo '<div class="card flex-fill bg-section special-card">';
							echo '<div class="card-body d-flex flex-column">';
							echo '<center>';
							echo '<img src="../assets/img/add.png" alt="users" style="width: 80px; height: 80px; margin-bottom: 20px;" draggable="false">';
							echo '</center>';
							echo '<h4 class="card-title" style="font-size: 20px; font-weight: 700; color: #fff;">Tilføj din butik</h4>';
							echo '</div>';
							echo '</div>';
							echo '</a>';
							echo '</div>';
						}
						foreach ($stores as $row) {
							echo '<div class="col-xl-4" style="margin-bottom: 25px;">';
                            echo '<a style="text-decoration: none; color: inherit;" href="store.php?id='.$row['id'].'">';
                            echo '<div class="card flex-fill bg-section special-card">';
                            echo '<div class="card-body d-flex flex-column">';
                            echo '<center>';
                            echo '<img src="../assets/img/stores/'.$row['image'].'" alt="users" style="width: 80px; height: 80px; margin-bottom: 20px;" draggable="false">';
                            echo '</center>';
                            echo '<h4 class="card-title" style="font-size: 20px; font-weight: 700; color: #fff;">'.$row['name'].'</h4>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
						}
					} else {
						if (is_loggedin()) {
							echo '<div class="col-xl-4" style="margin-bottom: 25px;">';
							echo '<a style="text-decoration: none; color: inherit;" href="createstore.php">';
							echo '<div class="card flex-fill bg-section special-card">';
							echo '<div class="card-body d-flex flex-column">';
							echo '<center>';
							echo '<img src="../assets/img/add.png" alt="users" style="width: 80px; height: 80px; margin-bottom: 20px;" draggable="false">';
							echo '</center>';
							echo '<h4 class="card-title" style="font-size: 20px; font-weight: 700; color: #fff;">Tilføj din butik</h4>';
							echo '</div>';
							echo '</div>';
							echo '</a>';
							echo '</div>';
						}
					}
				?>
			</div>
		</div>
	</section>
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