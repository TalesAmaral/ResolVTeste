<?php
	session_start()
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>ResolV</title>

		<!-- CSS  -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	<body>

		<ul id="dropdown1" class="dropdown-content">
			<li><a href="materias.php">Fazer questões</a></li>
			<li><a href="cadastrar-questao.php">Cadastrar questões</a></li>
		</ul>

		<nav class="white" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="index.php" class="brand-logo">ResolV</a>
				<ul class="right hide-on-med-and-down">
					<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Questões<i class="material-icons right">arrow_drop_down</i></a></li>
					<?php 
					if(isset($_SESSION['login']) && $_SESSION['login']==True){
						echo "<li><a href='sair.php'>Sair</a></li>";
					}else{
						echo"<li><a href='login.php'>Login</a></li>
						<li><a href='registrar.php'>Cadastrar</a></li>";
					}
					?>
				</ul>

				<ul id="nav-mobile" class="sidenav">
					<li><a href="#">Navbar Link</a></li>
				</ul>
				<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			</div>
		</nav>
		<h2 class = "center">
			Escolha uma matéria
		</h2>

		<div class="container">
			<div class="section">

				<div class="row">
					<a href = "questao.php?questao=1&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">calculate</i></h2>
							<h5 class="center black-text"> Matemática</h5>

						</div>
					</div>
					</a>

					<a href = "questao.php?questao=2&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">precision_manufacturing</i></h2>
							<h5 class="center black-text">Física</h5>
						</div>
					</div>
					</a>

					<a href = "questao.php?questao=3&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">menu_book</i></h2>
							<h5 class="center black-text">Português</h5>

						</div>
					</div>
					</a>
					<a href = "questao.php?questao=4&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">science</i></h2>
							<h5 class="center black-text">Química</h5>

						</div>
					</div>
					</a>
					<a href = "questao.php?questao=5&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">biotech</i></h2>
							<h5 class="center black-text">Biologia</h5>

						</div>
					</div>
					</a>
					<a href = "questao.php?questao=6&clicou=0">
					<div class="card col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">psychology</i></h2>
							<h5 class="center black-text">Filosofia</h5>

						</div>
					</div>
					</a>
				</div>

			</div>
		</div>


		<!--  Scripts-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>

	</body>
</html>