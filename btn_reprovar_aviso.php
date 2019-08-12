<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1" ){
		header("Location: index.php");
	}

include_once("conexao.php");

	$id = $_GET["id"];
	$result_usuario = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.id_recado='$id'";			
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	$resultado = mysqli_fetch_assoc($resultado_usuario);
	if($_SESSION['periodo'] == $resultado['periodo'] && $_SESSION['ciclo'] == $resultado['ciclo']){	
		$query = "DELETE FROM recados WHERE id_recado=$id";
		$con = $conn -> query ($query) or die ($conn);
		if($resultado['analise_adm'] == 0){ 
			header("Location: avaliar_avisos.php");	
		}else if ($resultado['analise_adm'] == 1){ 
			header("Location: avisos_avaliados.php");	
		}

	}else{
		if($_SESSION['nivel_especial'] == "1"){
			$query = "DELETE FROM recados WHERE id_recado=$id";
			$con = $conn -> query ($query) or die ($conn);
			if($resultado['analise_adm'] == 0){ 
				header("Location: avaliar_avisos.php");	
			}else if ($resultado['analise_adm'] == 1){ 
				header("Location: avisos_avaliados.php");	
			}
	
		}else if($_SESSION['nivel_especial'] != "1"){
				header("Location: sair.php");	
		}	
	}
	

	
?>
