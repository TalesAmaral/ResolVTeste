<?php
	session_start();
?>
  
 
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
    <?php include 'header.php';?>
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
		if($clicou==0){
			$sql = "SELECT * FROM questao where fk_Disciplina_ID_Disciplina = $questao AND Aprovada=1 ORDER BY RAND () LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$_SESSION['enunciado'] = $row["Enunciado"];
					$_SESSION['ano'] = $row["Ano"];
					$_SESSION['idQuestao'] = $row["ID_Questao"];
					$idVest=$row["fk_Vestibular_ID"];
				}
				$sql = "SELECT Nome FROM vestibular WHERE ID='$idVest'";
		    	$result = $conn->query($sql);
            	$_SESSION['vest']=$result->fetch_assoc()['Nome'];
				$_SESSION['resultados'] = True;
				$idQuestao = $_SESSION['idQuestao'];
			} else {
				$_SESSION['resultados']=False;
			}
		}else{
			$idQuestao = $_SESSION['idQuestao'];
		}

?>

	<section class="container center-container">
	    <section class="section_content">
	    <p><b><?php 
		if($_SESSION['resultados']==True){ #Verifica se foi encontrado alguma questão
			echo "(".$_SESSION['vest']." - ".$_SESSION['ano'].") ".$_SESSION['enunciado'];
		}else{
			echo "Não foi possível achar nenhuma questão.";
		}
?></b></p>
			<br />

			<form method="POST" action="<?php
		if($clicou==0){ #Inverte os casos
			echo "questao.php?questao=".$questao."&clicou=1";
		}else{
			echo "questao.php?questao=".$questao."&clicou=0";
		}
?>">
<?php
		if($clicou==0 && $_SESSION['resultados']){ #Verifica os resultados das alternativas, caso tenha achado alguma questão
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
				$_SESSION['alternativas'] = $valores;
				$_SESSION['resultados']=True;
			} else {
				$_SESSION['resultados']=False;
			}
		}else if($_SESSION['resultados']){
			$valores = $_SESSION['alternativas'];
		}else{
			$valores = array();
		}
		$conn->close();
?>

<?php 
		if($_SESSION['resultados']){ #Encontra a alternativa certa, caso tenha encontrado as alternativas
			$conn = mysqli_connect($servername, $username, $password,$database); #conecta de novo ao banco de dados
			mysqli_set_charset($conn,"utf8");
			$sql = "SELECT Valor FROM alternativa
				INNER JOIN possui ON alternativa.ID_Alternativa = possui.fk_Alternativa_ID_Alternativa INNER JOIN questao ON questao.ID_Questao = possui.fk_Questao_ID_Questao
				WHERE ID_Alternativa = questao.fk_Alternativa_ID_Alternativa AND questao.ID_questao = $idQuestao"; #pega a alternativa correta
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$resposta = $row["Valor"];
				}
			}
			$conn->close();
		}
?>

			<?php foreach ($valores as $valor) : ?> 
<?php
		if($_SESSION['resultados']){ #Construção das alternativas
			if($clicou==1 && isset($_POST['alternativas'])){
				if($valor==$resposta){
					echo "<p class='acertou'>";
				}else if($_POST['alternativas']==$valor && $valor!=$resposta){
					echo "<p class='errou'>";
				}
			}
		}else{
			echo "<p>";
		}
?>
				<label>
				<input type="radio" name="alternativas" id="resposta_<?php if($_SESSION['resultados']){echo $valor;} ?>" value="<?php if($_SESSION['resultados']){echo $valor;} ?>" <?php
				if($clicou==1 && isset($_POST['alternativas'])){
					if($valor==$_POST['alternativas']){
						echo "checked";
					}
				}
		?> /><span><?php if($_SESSION['resultados']){echo $valor;} ?></span>
			</label>
			</p>
			<?php endforeach ?>

<?php
		if($clicou==1 && $_SESSION['resultados']){ #Coloca a solução da questão caso o usuário tenha clicado em enviar
			echo "<p><b>Resolução:</b></p><br />";
			$conn = mysqli_connect($servername, $username, $password,$database); #conecta de novo ao banco de dados
			mysqli_set_charset($conn,"utf8");
			$sql = "SELECT Solucao FROM questao WHERE ID_Questao = $idQuestao";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$resolucao = $row["Solucao"];
				}
			}
			echo $resolucao."<br /><br />";
			$conn->close();
		}
?>

	<button type="submit" class="btn waves-effect waves-light"><?php 
		if($clicou==0 && $_SESSION['resultados']){
			echo "Enviar";
		}else{
			echo "Próxima questão";
		}
?></button>
		</form>


	    </section>
	</section>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
    </body>
  </html>

