<?php
	session_start();
	if(!isset($_SESSION["usuarioId"]) || !isset($_SESSION["usuarioNiveisAcessoId"]) || 
	   !isset($_SESSION["usuarioNome"]) || !isset($_SESSION["usuarioEmail"])) {
		
		header("Location: index.php");
		
	}else{
	
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['RA'],
		$_SESSION['celular'],
		$_SESSION['ciclo'],
		$_SESSION['periodo'],
		$_SESSION['usuarioNiveisAcessoId'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioSenha'],
		$_SESSION['nivel_especial']	
	);
	
	$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	//redirecionar o usuario para a página de login
	header("Location: index.php");
	}
?>