<?php
/* verifica e encaminha o  aluno para a pagina de cliente e o administrador para a pagina administrativo */

if(isset($_SESSION["usuarioId"]) && isset($_SESSION["usuarioNiveisAcessoId"])) {
		if($_SESSION['usuarioNiveisAcessoId'] == "1"){
			header("Location: administrativo.php");
		}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
			header("Location: cliente.php");
		}
	}
?>
