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
			  <li><a href="login.php">Login</a></li>
			  <li><a href="registrar.php">Cadastrar</a></li>
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
                    <form method="POST">
                        <p class="login-center"><b>Enunciado</b></p>
                        <textarea class="login-center input-width materialize-textarea" name="textarea1" required></textarea>
                        
                        <p class="login-center"><b>Alternativas</b></p>
                        <input type="text" class="login-center input-width" name="alternativa1" id="alternativa1" placeholder="Alternativa 1" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa2" id="alternativa2" placeholder="Alternativa 2" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa3" id="alternativa3" placeholder="Alternativa 3" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa4" id="alternativa4" placeholder="Alternativa 4" required>
                        <br /><br />
                        <input type="text" class="login-center input-width" name="alternativa5" id="alternativa5" placeholder="Alternativa 5" required>

                        <p class="login-center"><b>Resposta</b></p>
                        <select class="browser-default login-center input-width">
                            <option value="-1" disabled selected>Escolha a alternativa correta</option>
                            <option value="1">Alternativa 1</option>
                            <option value="2">Alternativa 2</option>
                            <option value="3">Alternativa 3</option>
                            <option value="4">Alternativa 4</option>
                            <option value="5">Alternativa 5</option>
                        </select>
                        <br /> 
						            <p class="login-center"><b>Disciplina</b></p>
                        <select class="browser-default login-center input-width">
                            <option value="-1" disabled selected>Escolha a disciplina</option>
                            <?php 
                            $servername = "localhost";
                            $username = "root";
                            $password = "usbw";
                            $database = "baseresolv";
                        
                            // Create connection
                            $conn = mysqli_connect($servername, $username, $password,$database);
                            mysqli_set_charset($conn,"utf8");
                            $sql = "SELECT Nome FROM disciplina;";
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
                        <br /><br />
                        <button type="submit" class="login-center btn waves-effect waves-light">Entrar</button>

                        <br /><br />
                    </form>
            </section>
        </section>


		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>

	</body>
</html>