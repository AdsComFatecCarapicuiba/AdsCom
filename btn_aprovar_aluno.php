<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: index.php");
	}

include_once("conexao.php");

if ($_SESSION['usuarioNiveisAcessoId'] == 1){ 
	
	$id = $_GET["id"];
	$result_usuario = "SELECT * FROM alunos WHERE id=$id LIMIT 1";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	$resultado = mysqli_fetch_assoc($resultado_usuario);
	
	
	if ($_SESSION['nivel_especial'] == 1){
	
		$query = "UPDATE alunos SET niveis_acesso_id=2 WHERE id=$id";
		$con = $conn -> query ($query) or die ($conn);
	
		header("Location: aprovar_cadastro_aluno.php");
	}
	else if ($_SESSION['nivel_especial'] == 0 && $resultado['periodo'] =$_SESSION['periodo'] && $resultado['ciclo']= $_SESSION['ciclo']){
		$query = "UPDATE alunos SET niveis_acesso_id=2 WHERE id=$id";
		$con = $conn -> query ($query) or die ($conn);
	
		header("Location: aprovar_cadastro_aluno.php");
	}	
}	

?>