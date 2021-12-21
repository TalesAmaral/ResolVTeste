
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
	<link href="css/form.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
    <ul id="dropdown1" class="dropdown-content">
			<li><a href="materias.html">Fazer questões</a></li>
			<li><a href="cadastrar-questao.php">Cadastrar questões</a></li>
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
		$clicou = $_GET['clicou'];
		$servername = "localhost";
		$username = "root";
		$password = "usbw";
		$database = "baseresolv";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password,$database);
		mysqli_set_charset($conn,"utf8");
		$sql = "SELECT * FROM questao where fk_Disciplina_ID_Disciplina = $questao ORDER BY RAND () LIMIT 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$enunciado = $row["Enunciado"];
				$ano = $row["Ano"];
				$idQuestao = $row["ID_Questao"];
			}
			$resultados = True;
		} else {
			$resultados=False;
		}

		?>

	<section class="container center-container">
	    <section class="section_content">
			<p><b><?php 
				if($resultados==True){
					echo $enunciado;
				}else{
					echo "Não foi possível achar nenhuma questão.";
				}
				?></b></p>
			<br />
			
			<form method="POST" action="questao.php?questao=1&clicou=1">
			<?php
			if($resultados){
				$sql = "SELECT Valor FROM alternativa 
				INNER JOIN possui ON alternativa.ID_Alternativa = possui.fk_Alternativa_ID_Alternativa INNER JOIN questao ON questao.ID_Questao = possui.fk_Questao_ID_Questao
				WHERE questao.ID_Questao = $idQuestao
				ORDER BY RAND()";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$valores = array();
					while($row = $result->fetch_assoc()) {
						$valores[] = $row["Valor"];
					}
					$resultados=True;
				} else {
					$resultados=False;
				}
			}
			$conn->close();

			?>
			
			<?php foreach ($valores as $valor) : ?>
				<?php 
					$conn = mysqli_connect($servername, $username, $password,$database); #conecta de novo ao banco de dados
					mysqli_set_charset($conn,"utf8");
					$sql = "SELECT Valor FROM alternativa
					INNER JOIN possui ON alternativa.ID_Alternativa = possui.fk_Alternativa_ID_Alternativa INNER JOIN questao ON questao.ID_Questao = possui.fk_Questao_ID_Questao
					WHERE ID_Alternativa = questao.fk_Alternativa_ID_Alternativa"; #pega a alternativa correta
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$resposta = $row["Valor"];
						}
					}
					if($clicou==1 && isset($_POST['alternativas'])){
						if($valor==$resposta){
							echo "<p class='acertou'>";
						}else if($_POST['alternativas']==$valor && $valor!=$resposta){
							echo "<p class='errou'>";
						}
					}
					
				?>
				<label>
				<input type="radio" name="alternativas" id="resposta_<?php echo $valor ?>" value="<?php echo $valor ?>" <?php
				if($clicou==1 && isset($_POST['alternativas'])){
					if($valor==$_POST['alternativas']){
						echo "checked";
					}
				}
				?> /><span><?php echo $valor; ?></span>
				</label>
				<p>
    		<?php endforeach ?>
			<button type="submit" class="btn waves-effect waves-light">Enviar</button>
		</form>


	    </section>
	</section>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
    </body>
  </html>


