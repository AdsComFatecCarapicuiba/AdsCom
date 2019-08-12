<?php
	session_start();	

	include_once("conexao.php");	
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
		$senha = md5($senha);
			
		//Buscar na tabela alunos o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT * FROM alunos WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		if(isset($resultado)){
			$_SESSION['usuarioId'] = $resultado['id'];
			$_SESSION['usuarioNome'] = $resultado['nome'];
			$_SESSION['RA'] = $resultado['RA'];
			$_SESSION['celular'] = $resultado['celular'];
			$_SESSION['ciclo']= $resultado['ciclo'];
			$_SESSION['periodo']= $resultado['periodo'];
			$_SESSION['usuarioNiveisAcessoId'] = $resultado['niveis_acesso_id'];
			$_SESSION['usuarioEmail'] = $resultado['email'];
			$_SESSION['nivel_especial'] = $resultado['nivel_especial'];
			if($_SESSION['usuarioNiveisAcessoId'] == "1"){
				header("Location: cliente.php");
			}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
				header("Location: cliente.php");	
			}
			elseif($_SESSION['usuarioNiveisAcessoId'] == "3"){
				$_SESSION['analise'] = "Cadastro em análise";
				header("Location: index.php");
			}
		//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		//redireciona o usuario para a página de login
		}else{	
			//Váriavel global recebendo a mensagem de erro
			$_SESSION['loginErro'] = "Usuário ou senha Inválido";
			header("Location: index.php");
		}
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: index.php");
	}
?>