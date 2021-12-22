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
		

		<section class="container center-container">
            <section class="section_content">
                    <h5 class="center"><b>Cadastrar</b></h5>
					<br />
                    <form method="POST" action="">

                        <p class="login-center"><b>Nome completo</b></p>
                        <input type="text" class="login-center input-width" name="nome" required>

                        <p class="login-center"><b>Apelido</b></p>
                        <input type="text" class="login-center input-width" name="apelido" required>

                        <p class="login-center"><b>E-mail</b></p>
                        <input type="text" class="login-center input-width" name="email" required>
                        
                        <p class="login-center"><b>Senha</b></p>
                        <input type="password" class="login-center input-width" name="senha" required>

                        <br /> <br />
                        <button type="submit" class="login-center btn waves-effect waves-light">Registrar</button>
						<?php 
						if(isset($_POST['apelido'])){
							$servername = "localhost";
							$username = "root";
							$password = "usbw";
							$database = "baseresolv";
							$apelido = $_POST['apelido'];
							$email = $_POST['email'];
							$senha = $_POST['senha'];
							$nome = $_POST['nome'];
							// Create connection
							$conn = mysqli_connect($servername, $username, $password,$database);
							mysqli_set_charset($conn,"utf8");
							$sql = "SELECT * FROM usuario WHERE Apelido='$apelido' OR Email='$email'";
							$result = $conn->query($sql);
							if ($result->num_rows == 0){
								$sql = "SELECT * FROM usuario ORDER BY ID_Usuario DESC LIMIT 1";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$idUsuario=$row['ID_Usuario']+1;
									}
								}else{
									$idUsuario = 1;
								}
								$sql = "INSERT INTO usuario(Nome, Email, Apelido, Senha, ID_Usuario) VALUES ('$nome', '$email', '$apelido', '$senha', $idUsuario);";
								$result = $conn->query($sql);
								$conn->commit();
								echo "<label><span>Conta criada com sucesso.</span></label>";
							}else{
								echo "<label><span>Foi colocado um email ou apelido existente.</span></label>";
							}
							$conn->close();
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