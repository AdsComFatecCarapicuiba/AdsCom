<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1" ){
		header("Location: index.php");
	}

	
include_once("conexao.php");

	$id = $_GET["id"];

	$query = "UPDATE recados SET analise_adm=1 WHERE id=$id";
	$con = $conn -> query ($query) or die ($conn);

	header("Location: avaliar_avisos.php");

?>