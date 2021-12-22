<header>

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
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</header>