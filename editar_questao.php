<?php
	session_start();
    $admin = array(1,2);
	if(!(in_array($_SESSION['idUsuarioSessao'], $admin))){
        Header("Location: index.php");
        die();
    }
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
		<?php include 'header.php';?>
        <section class="container-questao center-container">
			<section class="section-content-questao">
                <form method="POST" action="">


                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "usbw";
                        $database = "baseresolv";
                        
                        $conn = mysqli_connect($servername, $username, $password,$database);
						mysqli_set_charset($conn,"utf8");
                        $sql = "SELECT * FROM questao WHERE ID_Questao={$_REQUEST['ID']}";
                        $result = $conn->query($sql);
                        if ($result and $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $enunciado = $row['Enunciado'];
                            $resolucao = $row['Solucao'];
                            $ano = $row['Ano'];
                            $idDisciplina = $row['fk_Disciplina_ID_Disciplina'];
                            $idResposta = $row['fk_Alternativa_ID_Alternativa'];
                            $idVest = $row['fk_Alternativa_ID_Alternativa'];
                        }
                        $sql = "SELECT Nome FROM vestibular WHERE ID='$idVest'";
                        $result = $conn->query($sql);
                        $vest=$result->fetch_assoc()['Nome'];

                        $sql = "SELECT Valor FROM alternativa 
                        INNER JOIN possui ON alternativa.ID_Alternativa = possui.fk_Alternativa_ID_Alternativa INNER JOIN questao ON questao.ID_Questao = possui.fk_Questao_ID_Questao
                        WHERE questao.ID_Questao = {$_REQUEST['ID']}
                        ORDER BY questao.ID_Questao ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $valores = array();
                            while($row = $result->fetch_assoc()) {
                                $valores[] = $row["Valor"];
                            }
                        }
                    ?>

					<p class="login-center"><b>Enunciado</b></p>
					<textarea class="login-center input-width materialize-textarea" name="enunciado" required><?php echo $enunciado; ?></textarea>

					<p class="login-center"><b>Alternativas</b></p>
                    <?php
                    for($i=1; $i<= 5; $i++){
                        echo "<input type='text' class='login-center input-width' name='alternativa$i' placeholder='Alternativa $i' value='{$valores[$i-1]}' required>
                        <br /> <br />";
                    }
                    ?>
					<p class="login-center"><b>Resposta</b></p>
					<select class="browser-default login-center input-width" name="alternativaCorreta" required>
						<option value="-1" disabled>Escolha a alternativa correta</option>
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                           echo "<option value='$i' ";
                           if($idResposta%5==$i){
                               echo "selected";
                            }
                           echo ">Alternativa $i</option>";
                        }
                        ?>

					</select>
					<br /> 
					<p class="login-center"><b>Disciplina</b></p>
					<select name="disciplinas" class="browser-default login-center input-width" required>
						<option value="-1" disabled>Escolha a disciplina</option>
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
							<option value="<?php echo $i;;?>" <?php if($idDisciplina==$i){echo "selected";} $i+=1;?>><?php echo $nomeDisc ?></option>
						<?php endforeach ?>
					</select>
					<br />
					<p class="login-center"><b>Resolução</b></p>
					<textarea class="login-center input-width materialize-textarea" name="resolucao" required><?php echo $resolucao; ?></textarea>
					<br /><br />
					<p class="login-center"><b>Vestibular</b></p>
					<input type="text" class="login-center input-width" name="vestibular" value="<?php echo $vest ?>" required>
					<p class="login-center"><b>Ano de criação</b></p>
					<input type="text" class="login-center input-width" name="ano" value="<?php echo $ano;?>" required>
					<br /><br />

					<button type="submit" class="login-center btn waves-effect waves-light">Editar</button>
                    <button type="submit" class="btn waves-effect waves-light red">Excluir</button>
                </form>
            </section>
        </section>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
    </body>
</html>