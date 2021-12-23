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
			<form class = "row">

				<div class="input-field col s12 m3">
					<select multiple>
						<option value="" disabled selected>Escolha as disciplinas</option>

						<?php 
							$servername = "localhost";
							$username = "root";
							$password = "usbw";
							$database = "baseresolv";

							// Create connection
							$conn = mysqli_connect($servername, $username, $password,$database);
							mysqli_set_charset($conn,"utf8");
							$sql = "SELECT Nome FROM disciplina ORDER BY ID_Disciplina ASC;";
							$i = 1;
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value=\"$i\"> {$row["Nome"]}</option>";
									$i+=1;
								}
							}

						?>


					</select>
				</div>
				<div class="input-field col s12 m3">
					<select multiple>
						<option value="" disabled selected>Escolha os Vestibulares</option>

						<?php 
							$servername = "localhost";
							$username = "root";
							$password = "usbw";
							$database = "baseresolv";

							// Create connection
							$conn = mysqli_connect($servername, $username, $password,$database);
							mysqli_set_charset($conn,"utf8");
							$sql = "SELECT Nome FROM Vestibular ORDER BY ID ASC;";
							$i = 1;
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value=\"$i\"> {$row["Nome"]}</option>";
									$i+=1;
								}
							}

						?>


					</select>
				</div>
				<div class="input-field col s6 m2">
					<label for="ano-comeco"> Escolha o ano inicial:</label>	
					<input id="ano-comeco" type="number" min="1900" max="2099" step="1" value="1990" />
				</div>

				<div class="input-field col s6 m2">
					<label for="ano-fim"> Escolha o ano final:</label>	
					<input id="ano-fim" type="number" min="1900" max="2099" step="1" value="2016" />
				</div>
				<div class="input-field col s12 m2">

					  <textarea id="textarea1" class="materialize-textarea"></textarea>
					  <label for="textarea1">Pesquisar:</label>
				</div>
			</form>



		<!--  Scripts-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>

	</body>
</html>
