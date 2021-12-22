<?php
session_start()
?>

<!DOCTYPE html>
<html lang="pt-br">
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
		
		<br /><br />

		<section class="container-questao center-container">
            <section class="section-content-questao">
                    <br />
                    <h5 class="center"><b>Cadastrar questão</b></h5>
                    <br />
                    <form method="POST" action="">
                        <p class="login-center"><b>Enunciado</b></p>
                        <textarea class="login-center input-width materialize-textarea" name="enunciado" required></textarea>
                        
                        <p class="login-center"><b>Alternativas</b></p>
                        <input type="text" class="login-center input-width" name="alternativa1" placeholder="Alternativa 1" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa2" placeholder="Alternativa 2" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa3" placeholder="Alternativa 3" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa4" placeholder="Alternativa 4" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa5" placeholder="Alternativa 5" required>

                        <p class="login-center"><b>Resposta</b></p>
                        <select class="browser-default login-center input-width" name="alternativaCorreta" required>
                            <option value="-1" disabled selected>Escolha a alternativa correta</option>
                            <option value="1">Alternativa 1</option>
                            <option value="2">Alternativa 2</option>
                            <option value="3">Alternativa 3</option>
                            <option value="4">Alternativa 4</option>
                            <option value="5">Alternativa 5</option>
                        </select>
                        <br /> 
						            <p class="login-center"><b>Disciplina</b></p>
                        <select name="disciplinas" class="browser-default login-center input-width" required>
                            <option value="-1" disabled selected>Escolha a disciplina</option>
                            <?php 
                            $servername = "localhost";
                            $username = "root";
                            $password = "usbw";
                            $database = "baseresolv";
                        
                            // Create connection
                            $conn = mysqli_connect($servername, $username, $password,$database);
                            mysqli_set_charset($conn,"utf8");
                            $sql = "SELECT Nome FROM disciplina ORDER BY ID_Disciplina ASC;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              $disciplina = array();
                              while($row = $result->fetch_assoc()) {
                                $disciplina[] = $row["Nome"];
                              }
                            }

                            $i = 1;
                            ?>
                            <?php foreach ($disciplina as $nomeDisc) : ?>
                            <option value="<?php echo $i; $i+=1;?>"><?php echo $nomeDisc ?></option>
                            <?php endforeach ?>
                        </select>
                        <br />
                        <p class="login-center"><b>Resolução</b></p>
                        <textarea class="login-center input-width materialize-textarea" name="resolucao" required></textarea>
                        <br /><br />
                        <p class="login-center"><b>Vestibular</b></p>
                        <input type="text" class="login-center input-width" name="vestibular" required>
                        <p class="login-center"><b>Ano de criação</b></p>
                        <input type="text" class="login-center input-width" name="ano" required>
                        <br /><br />
                        
                        <button type="submit" class="login-center btn waves-effect waves-light">Enviar</button>
                        <?php 
                        if(isset($_SESSION['login']) && $_SESSION['login']==True && isset($_POST['enunciado']) && $_POST['alternativaCorreta']!=-1 && $_POST['disciplinas']!=-1){
                          $servername = "localhost";
                          $username = "root";
                          $password = "usbw";
                          $database = "baseresolv";
                          $conn = mysqli_connect($servername, $username, $password,$database);
                          mysqli_set_charset($conn,"utf8");

                          $apelido = $_SESSION['apelido'];
                          $enunciado = $_POST['enunciado'];
                          
                          $sql = "SELECT * FROM questao WHERE Enunciado='$enunciado'";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0){
                            echo "<span><label>A questão já existe.</label></span>";
                          }else{
                            $a1=$_POST['alternativa1'];
                            $a2=$_POST['alternativa2'];
                            $a3=$_POST['alternativa3'];
                            $a4=$_POST['alternativa4'];
                            $a5=$_POST['alternativa5'];
                            $disciplina=$_POST['disciplinas'];
                            $ano = $_POST['ano'];
                            $vestibular=$_POST['vestibular'];
                            $data = date('y-m-d');
                            $resolucao = $_POST['resolucao'];
                            $idUsuario = $_SESSION['idUsuarioSessao'];

                            $sql = "SELECT * FROM questao ORDER BY ID_Questao DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              $questoesNum=$result->num_rows*5;
                              $alternativaCertaId = $_POST['alternativaCorreta']+$questoesNum;
                              $idQuestao = $result->num_rows+1;
                            }else{
                              $idQuestao = 1;
                            }

                            $sql = "INSERT INTO alternativa (ID_Alternativa, Valor) VALUES
                            ($questoesNum+1, '$a1'),
                            ($questoesNum+2, '$a2'),
                            ($questoesNum+3, '$a3'),
                            ($questoesNum+4, '$a4'),
                            ($questoesNum+5, '$a5');";
                            $conn->query($sql);
                            $conn->commit();
                            echo "'$a1'";
                            $sql = "INSERT INTO questao(ID_Questao, Enunciado, Solucao, Vestibular, Ano, fk_Disciplina_ID_Disciplina, fk_Usuario_ID_Usuario, dataCriada, fk_Alternativa_ID_Alternativa) VALUES
                            ('$idQuestao', '$enunciado','$resolucao','$vestibular','$ano','$disciplina','$idUsuario','$data','$alternativaCertaId');";
                            $conn->query($sql);
								            $conn->commit();
                            $sql = "INSERT INTO possui (fk_Alternativa_ID_Alternativa, fk_Questao_ID_Questao) VALUES
                            ($questoesNum+1, $idQuestao),
                            ($questoesNum+2, $idQuestao),
                            ($questoesNum+3, $idQuestao),
                            ($questoesNum+4, $idQuestao),
                            ($questoesNum+5, $idQuestao);";
                            $conn->query($sql);
                            $conn->commit();
                            echo "<span><label>Questão registrada com sucesso.</label></span>";
                            $conn->close();

                          }

                        }else if($_SESSION['login']==False){
                          echo "<span><label>Você precisa estar logado para registrar uma questão.</label></span>";
                        }else if(isset($_POST['enunciado'])){
                          echo "<span><label>Faltou preencher algum dado.</label></span>";
                        }
                        
                        ?>
                        <br /><br />
                    </form>
            </section>
        </section>


		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>

	</body>
</html>