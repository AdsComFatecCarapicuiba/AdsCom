<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: index.php");
	}else{			
		/*echo "Usuario: ". $_SESSION['usuarioNome'];	*/
		
	}
?>
	
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lucas Oliveira">
    <link rel="icon" href="imagens/adscom.ico">

    <title>Administrativo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
	<?php//---------------------------menu _admin -----------------------------------------------------------------?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="administrativo.php">ADScom</a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">            

		
		<?php
			if($_SESSION['nivel_especial'] == 1){ // funcoes permitidas apenas para admin master
					  
				printf("<li><a href='aprovar_admin_master.php'>Aprovar Admin Master</a></li>
					    <li><a href='selecionar_admin.php'>Aprovar Admin</a></li>");	  
			}
		?>
		<li><a href='aprovar_cadastro_aluno.php'> Cadastro de Aluno</a></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avisos <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adicionar_avisos.php">Adicionar Avisos</a></li>
			<li><a href="avaliar_avisos.php">Avaliar Avisos</a></li>  
			<li><a href="avisos_avaliados.php">Avisos Avaliados</a></li>  
		  </ul>
		</li> 
		
	
		<li><a href="cliente.php">Voltar para a página principal</a></li>
		
		<li><a href="sair.php">Sair</a></li>
	  </ul>
	</div>
  </div>
</nav>
	<?php//-----------------------fim--menu _admin ----------------------------------------------------------------?>	
  
  <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Bem-vindo à área administrativa
		</h1>
      </div>
	  <font size="3">
		Aqui você pode usufruir de suas funções como administrador, tais como: 
		</br></br>
		<a href="aprovar_admin_master.php">- Aprovar para Administrador Master</a></br>
		<a href="selecionar_admin.php">- Aprovar para Administrador </a></br>
		<a href="aprovar_cadastro_aluno.php">- Cadastrar aluno</a></br>
		<a href="adicionar_avisos.php">- Adicionar aviso</a></br>
		<a href="avaliar_avisos.php">- Avaliar avisos</a></br>
		<a href="avisos_avaliados.php">- Listar avisos avaliados</a></font>
    </div> 

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
