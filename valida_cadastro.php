<?php
	session_start();	

	include_once("conexao.php");	
	
	if((isset($_POST['email'])) ){
		$email = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
		$senha = md5($senha);
		$confirma_senha = mysqli_real_escape_string($conn, $_POST['confirma_senha']);
		$confirma_senha = md5($confirma_senha);
		$nome = mysqli_real_escape_string($conn, $_POST['nome']);
		$RA = $_POST['RA'];
		$celular = $_POST['celular'];
		$ciclo = $_POST['ciclo'];
		$periodo = $_POST['periodo'];
		$erro = 0;
		
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_aluno = "SELECT * FROM alunos WHERE email = '$email' LIMIT 1";
		$resultado_aluno = mysqli_query($conn, $result_aluno);
		$resultado = mysqli_fetch_assoc($resultado_aluno);
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_aluno_RA = "SELECT * FROM alunos WHERE RA = '$RA' LIMIT 1";
		$resultado_aluno_RA = mysqli_query($conn, $result_aluno_RA);
		$resultado_RA = mysqli_fetch_assoc($resultado_aluno_RA);
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_aluno_celular = "SELECT * FROM alunos WHERE celular = '$celular' LIMIT 1";
		$resultado_aluno_celular = mysqli_query($conn, $result_aluno_celular);
		$resultado_celular = mysqli_fetch_assoc($resultado_aluno_celular);
		//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
			
		if ($senha != $confirma_senha){			
			$_SESSION['senhaerro'] = "Senhas incompativeis";
			$erro++;
		}
		if ($ciclo == ""){
			$_SESSION['cicloerro'] = "Escolha um ciclo";
			$erro++;			
		}
		if ($periodo == ""){
			$_SESSION['periodoerro'] = "Escolha um periodo";	
			$erro++;
		}		
		if($RA != is_numeric($RA)){
			$_SESSION['RAerro'] = "Apenas numeros";
			$erro++;
		}
		if($celular != is_numeric($celular)){
			$_SESSION['celularerro'] = "Apenas numeros";
			$erro++;
		}	
		if(isset($resultado)){
			
			$_SESSION['emailerro'] = "Email ja cadastrado";
			$erro++;
		}
		if(isset($resultado_RA)){
			
			$_SESSION['RAerro2'] = "RA ja cadastrado";
			$erro++;
		}
		if(isset($resultado_celular)){
			
			$_SESSION['celularerro2'] = "celular ja cadastrado";
			$erro++;
		}	
		if($erro != 0){
			header("Location: cadastro.php");
		}
		else{
			$acesso = 3; /*pedido de analise*/
			htmlentities($nome);
			$cadastrar_aluno = "INSERT INTO alunos (`nome`,`email`,`RA`,`celular`,`ciclo`,`periodo`,`senha`,`niveis_acesso_id`,`nivel_especial`) VALUES( '$nome', '$email','$RA','$celular','$ciclo','$periodo','$senha','$acesso',0)";
		
			$result = mysqli_query($conn,$cadastrar_aluno);
				
			header("Location: index.php");
		}			
	}
	else {
		header("Location: index.php");		
	}		
?>