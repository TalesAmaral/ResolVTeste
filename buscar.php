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
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	<body>
		<?php include 'header.php';?>
		<form action = "" action = "post" class = "row">

			<div class="input-field col s12 m3">
				<select name = "disciplinas[]" multiple>
					<option value="" disabled selected>Escolha as disciplinas</option>

					<?php 
						$servername = "localhost";
						$username = "root";
						$password = "usbw";
						$database = "baseresolv";

						// Create connection
						$conn = mysqli_connect($servername, $username, $password,$database);
						mysqli_set_charset($conn,"utf8");
						$sql = "SELECT * FROM disciplina ORDER BY ID_Disciplina ASC;";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<option value=\"{$row["ID_Disciplina"]}\"> {$row["Nome"]}</option>";
							}
						}

					?>


				</select>
			</div>
			<div class="input-field col s12 m3">
				<select name = "vestibulares[]" multiple>
					<option value="" disabled selected>Escolha os Vestibulares</option>

					<?php 
						$servername = "localhost";
						$username = "root";
						$password = "usbw";
						$database = "baseresolv";

						// Create connection
						$conn = mysqli_connect($servername, $username, $password,$database);
						mysqli_set_charset($conn,"utf8");
						$sql = "SELECT * FROM Vestibular ORDER BY ID ASC;";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<option value=\"{$row["ID"]}\"> {$row["Nome"]}</option>";
							}
						}

					?>


				</select>
			</div>
			<div class="input-field col s6 m2">
				<label for="ano-comeco"> Escolha o ano inicial:</label>	
				<input name="ano-comeco" type="number" min="1900" max="2099" step="1" value="1990" />
			</div>

			<div class="input-field col s6 m2">
				<label for="ano-fim"> Escolha o ano final:</label>	
				<input name="ano-fim" type="number" min="1900" max="2099" step="1" value="2016" />
			</div>
			<div class="input-field col s12 m2">

				<textarea id="textarea1" name = "termo" class="materialize-textarea"></textarea>
				<label for="textarea1">Pesquisar:</label>
			</div>

			<div class="input-field col s12">
				<button class="btn waves-effect waves-light" type="submit" name="action">Buscar
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>

		<table>
			<thead>
				<th> Enunciado </th> 
				<th> Disciplina </th>
				<th>Vestibular</th>
				<th>Ano</th>
			</thead>
			<tbody>
				<?php
							$servername = "localhost";
							$username = "root";
							$password = "usbw";
							$database = "baseresolv";

							// Create connection
							$conn = mysqli_connect($servername, $username, $password,$database);
							mysqli_set_charset($conn,"utf8");
						if(!empty($_REQUEST["vestibulares"]) && !empty($_REQUEST["disciplinas"])){
							$Enunciado = $_REQUEST["termo"];
							$vestibulares = $_REQUEST["vestibulares"];
							$disciplinas = $_REQUEST["disciplinas"];
							$anoComeco = $_REQUEST["ano-comeco"];
							$anoFim = $_REQUEST["ano-fim"];

							$vestibulares =  "(".implode(",",$vestibulares).")";
							$disciplinas =  "(".implode(",",$disciplinas).")";


							$sql = "SELECT Enunciado, vestibular.nome 'Vestibular', disciplina.nome 'disciplina', Ano from questao inner join disciplina on (questao.fk_Disciplina_ID_Disciplina = disciplina.ID_Disciplina) inner join vestibular on (questao.fk_Vestibular_ID = vestibular.ID) where Enunciado like '%{$Enunciado}%' and questao.fk_Disciplina_ID_Disciplina in $disciplinas and questao.fk_Vestibular_ID in $vestibulares and questao.ano >= $anoComeco and questao.ano <= $anoFim;";
							$result = $conn->query($sql);
							if ($result and $result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "

										<tr>
											<td>
												{$row["Enunciado"]}
											</td>
											<td>
												{$row["disciplina"]}
											</td>
											<td>
												{$row["Vestibular"]}
											</td>
											<td>
												{$row["Ano"]}
											</td>
										</tr>
									   ";
								}
							}
						} else{

							$sql = "SELECT Enunciado, vestibular.nome 'Vestibular', disciplina.nome 'disciplina', Ano from questao inner join disciplina on (questao.fk_Disciplina_ID_Disciplina = disciplina.ID_Disciplina) inner join vestibular on (questao.fk_Vestibular_ID = vestibular.ID);";
							$result = $conn->query($sql);
							if ($result and $result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "

										<tr>
											<td>
												{$row["Enunciado"]}
											</td>
											<td>
												{$row["disciplina"]}
											</td>
											<td>
												{$row["Vestibular"]}
											</td>
											<td>
												{$row["Ano"]}
											</td>
										</tr>
									   ";
								}
							}
						}
				?>
			</tbody>
		</table>

		<!--  Scripts-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>

	</body>
</html>
