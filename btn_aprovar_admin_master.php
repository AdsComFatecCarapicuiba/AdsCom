<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1" || $_SESSION['nivel_especial'] != "1"){
		header("Location: index.php");
	}

include_once("conexao.php");

if ($_SESSION['usuarioNiveisAcessoId'] == 1 && $_SESSION['nivel_especial'] == 1){ 

	$id 				= $_GET["id"];

	$query = "UPDATE alunos SET nivel_especial=1 WHERE id=$id";
	$con = $conn -> query ($query) or die ($conn);

	header("Location: aprovar_admin_master.php");
}
?>
