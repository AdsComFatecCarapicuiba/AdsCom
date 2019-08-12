<?php
session_start();
include_once("encaminha.php");	
include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Cadastro </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/ie-emulation-modes-warning.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet">
	<meta name="author" content="Lucas Oliveira">
	<link rel="icon" href="imagens/adscom.ico">
</head>
<body class="blurBg-false" style="background-color:#EBEBEB">


<!-- Start Formoid form-->
<link rel="stylesheet" href="formoid_files/formoid1/formoid-solid-blue.css" type="text/css" />
<script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
<form class="formoid-solid-blue" action="valida_cadastro.php" style="background-color:#FFFFFF;font-size:12px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:480px;min-width:150px" method="post"><div class="title"><h2>Cadastro</h2></div>
	<div class="element-name"><label class="title">Nome Completo:</label><span class="nameFirst" ><input  type="text" size="8" name="nome" minlength="5"required /><span class="icon-place"></span></div>
	<div class="element-email"><label class="title">E-mail: <p class="text-center text-danger">	<?php if(isset($_SESSION['emailerro'])){echo $_SESSION['emailerro'];	unset($_SESSION['emailerro']);	}?></p>
													</label><div class="item-cont"><input class="large" type="email" name="email" value="" placeholder="" required/><span class="icon-place"></span></div></div>
	<div class="element-number"><label class="title">RA (apenas números):<p class="text-center text-danger">	<?php 	if(isset($_SESSION['RAerro'])){	echo $_SESSION['RAerro'];	unset($_SESSION['RAerro']);	}?>	</p> <p class="text-center text-danger">	<?php 	if(isset($_SESSION['RAerro2'])){	echo $_SESSION['RAerro2'];	unset($_SESSION['RAerro2']);	}?>	</p>
	</label><div class="item-cont"><input class="large" type="text"  name="RA" id="RA" minlength="13" maxlength="13" required value=""/><span class="icon-place"></span></div></div>
	<div class="element-phone"><label class="title">Telefone Celular(apenas números ):<p class="text-center text-danger">	<?php 	if(isset($_SESSION['celularerro'])){	echo $_SESSION['celularerro'];	unset($_SESSION['celularerro']);	}?>	</p> <p class="text-center text-danger">	<?php 	if(isset($_SESSION['celularerro2'])){	echo $_SESSION['celularerro2'];	unset($_SESSION['celularerro2']);	}?>	</p>
	</label><div class="item-cont"><input class="large" type="tel"  maxlength="9" minlength="9"name="celular" id="celular" placeholder="" value="" required/><span class="icon-place"></span></div></div>
	<div class="element-select"><label class="title">Ciclo:<p class="text-center text-danger">	<?php 	if(isset($_SESSION['cicloerro'])){	echo $_SESSION['cicloerro'];	unset($_SESSION['cicloerro']);	}?>	</p>

	</label><div class="item-cont"><div class="medium"><span><select name="ciclo" >

		<option value="">Selecione</option>
		<option value="ADS 1">ADS 1</option>
		<option value="ADS 2">ADS 2</option>
		<option value="ADS 3">ADS 3</option>
		<option value="ADS 4">ADS 4</option>
		<option value="ADS 5">ADS 5</option>
		<option value="ADS 6">ADS 6</option></select><i></i><span class="icon-place"></span></span></div></div></div>
	<div class="element-radio"><label class="title" >Periodo<p class="text-center text-danger">	<?php 	if(isset($_SESSION['periodoerro'])){	echo $_SESSION['periodoerro'];	unset($_SESSION['periodoerro']);	}?>	</p>
	</label>		<div class="column column2"><label><input type="radio" name="periodo" value="Manha" /><span>Manhã </span></label></div><span class="clearfix"></span>
		<div class="column column2"><label><input type="radio" name="periodo" value="Noite" required/><span>Noite</span></label></div><span class="clearfix"></span>
</div>
	<div class="element-password"><label class="title">Senha:<p class="text-center text-danger">		<?php if(isset($_SESSION['senhaerro'])){	echo $_SESSION['senhaerro'];	unset($_SESSION['senhaerro']);}?></p>
	</label><div class="item-cont"><input class="large" type="password" name="senha" id="senha" value="" placeholder="Password" required/><span class="icon-place"></span></div></div>
	<div class="element-password"><label class="title">Repetir Senha:</label><div class="item-cont"><input class="large" type="password" name="confirma_senha" id="confirma_senha" value="" placeholder="Password" required/><span class="icon-place"></span></div></div>
<div class="submit"><input type="submit" value="Enviar"/></div></form><p class="frmd"><script type="text/javascript" src="formoid_files/formoid1/formoid-solid-blue.js"></script>
<!-- Stop Formoid form-->
	

</body>
</html>
