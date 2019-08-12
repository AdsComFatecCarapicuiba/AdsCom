<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: index.php");
	}	
	include_once("conexao.php");
?>
	
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lucas Oliveira">
    <link rel="icon" href="imagens/adscom.ico">

    <title>Publicar Aviso</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script type="text/javascript">
    function optionCheck(){
        var option = document.getElementById("classificacao").value;
        if(option == "1" || option== "3"|| option== "4"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
			document.getElementById("hiddenDiv").style.height ="50px";
			document.getElementById("hiddenDiv").style.width ="100px";
			document.getElementById("data").required =true;
        }
        if(option != "1" && option != "3" && option != "4"){
            document.getElementById("hiddenDiv").style.visibility ="hidden";
			document.getElementById("hiddenDiv").style.height ="0px";
			document.getElementById("hiddenDiv").style.width ="0px";
			document.getElementById("data").required =false;
        }
		
    }
</script>
  </head>

  <body role="document">
	<?php//---------------------------menu _admin -----------------------------------------------------------------?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="administrativo.php">ADScom</a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">            

		
		<?php
			if($_SESSION['nivel_especial'] == 1){ // funcoes permitidas apenas para admin master
					  
				printf("<li><a href='aprovar_admin_master.php'>Aprovar Admin Master</a></li>
					    <li><a href='selecionar_admin.php'>Aprovar Admin</a></li>");	  
			}
		?>
		<li><a href='aprovar_cadastro_aluno.php'> Cadastro de Aluno</a></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avisos <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adicionar_avisos.php">Adicionar Avisos</a></li>
			<li><a href="avaliar_avisos.php">Avaliar Avisos</a></li>  
			<li><a href="avisos_avaliados.php">Avisos Avaliados</a></li>  
		  </ul>
		</li> 
		
	
		<li><a href="cliente.php">Voltar para a página principal</a></li>
		
		<li><a href="sair.php">Sair</a></li>
	  </ul>
	</div>
  </div>
</nav>
	<?php//-----------------------fim--menu _admin ----------------------------------------------------------------?>	
  
					<?php	
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$request = md5(implode($_POST));
				if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){
					//echo "Recado ja foi salvo!";
				}else{
					$_SESSION['ultima_request']  = $request;
					if(isset($_POST['recado'])){
						$urgente= $_POST['urgente'];
						$classificacao= $_POST['classificacao'];
						$recado = $_POST['recado'];
						$data = $_POST['data'];
						$id_aluno = $_SESSION['usuarioId'];
						$titulo = $_POST['titulo'];
						$analise_adm = 0;
						if ($_SESSION['usuarioNiveisAcessoId'] == 1){
								$analise_adm = 1;
						}
						if ($classificacao == 1 ||$classificacao == 3 ||$classificacao == 4 ){
						$result_recado = "INSERT INTO recados (id_aluno,recado,classificacao,urgente,data_,analise_adm,titulo) VALUES ('$id_aluno','$recado','$classificacao','$urgente','$data','$analise_adm','$titulo')";						
						}
						else{
						$result_recado = "INSERT INTO recados (id_aluno,recado,classificacao,urgente,data_,analise_adm,titulo) VALUES ('$id_aluno','$recado','$classificacao','$urgente',NOW(),'$analise_adm','$titulo')";			
						}
						$resultado_recados= mysqli_query($conn, $result_recado);
					}
				}
			}	
					
		?>
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<form action="" method="POST">
					<div class="form-group">
					

					<label for="Input-titulo">Título:</label>
					<input type="text" name="titulo" class="form-control"  maxlength="70" >
					</br>
					
					<div class="element-select"><label class="title">Classificação do Aviso:<p class="text-center text-danger">	<?php 	if(isset($_SESSION['cicloerro'])){	echo $_SESSION['cicloerro'];	unset($_SESSION['cicloerro']);	}?>	</p>

					</label><div class="item-cont"><div class="medium"><span><select id="classificacao" name="classificacao" onchange="optionCheck()"required >

						<option value="">Selecione</option>
						<option value="1">Calendário</option>
						<option value="2">Estágio</option>
						<option value="3">Atrasos/Ausência</option>
						<option value="4">Trabalhos</option>
						<option value="5">Monitoria</option>
						<option value="6">Materiais</option></select><i></i><span class="icon-place" ></span></span></div></div></div>
					
				
					</br>
					<div class="form-group">
						<label for="exampleInputEmail1">Aviso :</label>
						<textarea  name="recado" class="form-control" rows="6" required></textarea>
					</div>
					
					
					<div class="element-radio"><label class="title" >Urgente ?<p class="text-center text-danger">	
	</label>		<div class="column column2"><label><input type="radio" name="urgente" checked="checked" value="0" /><span>Não </span></label></div><span class="clearfix"></span>
					<div class="column column2"><label><input type="radio" name="urgente" value="1" required/><span>Sim</span></label></div><span class="clearfix"></span>
					</div>
						
					<div id="hiddenDiv" style="height:0px;width:0px;border:1px;visibility:hidden;">
				
					<label for="exampleInputDate">Data: 
						<input type="date" name="data" id="data" /></label>
					</div>	
						
					</br>
					<input type="submit" class="btn btn btn-primary" value="Enviar">
				
				</form>
				
				
				
						
						</div>
					</div>
							
				</div>
			

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
