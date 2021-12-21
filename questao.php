
  <!DOCTYPE html>
  <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>ResolV</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <ul id="dropdown1" class="dropdown-content">
			<li><a href="materias.html">Fazer questões</a></li>
			<li><a href="cadastrar-questao.html">Cadastrar questões</a></li>
		</ul>

		<nav class="white" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="index.html" class="brand-logo">ResolV</a>
				<ul class="right hide-on-med-and-down">
					<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Questões<i class="material-icons right">arrow_drop_down</i></a></li>
					<li><a href="login.html">Login</a></li>
					<li><a href="registrar.html">Cadastrar</a></li>
				</ul>

				<ul id="nav-mobile" class="sidenav">
					<li><a href="#">Navbar Link</a></li>
				</ul>
				<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			</div>
		</nav>
<?php
$questao = $_GET['questao'];

$servername = "localhost";
$username = "root";
$password = "usbw";
$database = "baseresolv";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);
mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM questao where fk_Disciplina_ID_Disciplina = $questao";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$tales = 1;
	while($row = $result->fetch_assoc()) {
		$enunciado = $row["Enunciado"];
	}
} else {
	$tales=0;
	echo "0 results";
}
$conn->close();

?>

	<section class="container center-container">
	    <section class="section_content">
	    <p><b><?php 
if($tales==1){
	echo $enunciado;
}

?></b></p>
						  <br />
	    </section>
	</section>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
    </body>
  </html>


