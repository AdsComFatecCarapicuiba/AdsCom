<?php
	session_start();
	include_once ("encaminha.php");
				
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Lucas Oliveira">
    
	<link rel="icon" href="imagens/adscom.ico">
    <title>Login</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>

  </head>

  <body>

    <div class="container">
      <form class="form-signin" method="POST" action="valida.php">
	  
		<p class="text-center"> <img src="imagens\logo_index.jpg"> </p>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-danger btn-block" type="submit">Entrar</button>
		<p class="text-center"><a class="text-center" href="cadastro.php">Cadastre-se</a> </p>
      </form>
	  <p class="text-center text-danger">
			<?php if(isset($_SESSION['loginErro'])){
				echo $_SESSION['loginErro'];
				unset($_SESSION['loginErro']);
			}?>
		</p>
		<p class="text-center text-success">
			<?php 
			if(isset($_SESSION['logindeslogado'])){
				echo $_SESSION['logindeslogado'];
				unset($_SESSION['logindeslogado']);
			}
			?>
		</p>
		<p class="text-center text-success">
			<?php 
			if(isset($_SESSION['analise'])){
				echo $_SESSION['analise'];
				unset($_SESSION['analise']);
			}
			?>
		</p>
		
    </div> 

	
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
