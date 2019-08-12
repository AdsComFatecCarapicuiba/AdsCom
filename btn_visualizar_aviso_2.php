<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: index.php");
	}

include_once("conexao.php");

	$id= $_GET["id"];

	$result_usuario = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.id_recado='$id'";			
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	$resultado = mysqli_fetch_assoc($resultado_usuario);
	if($_SESSION['periodo'] == $resultado['periodo'] && $_SESSION['ciclo'] == $resultado['ciclo']){	
	}else{
		if($_SESSION['nivel_especial'] != "1"){
			header("Location: sair.php");		
		}
	}	
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lucas Oliveira">
    <link rel="icon" href="imagens/adscom.ico">

    <title>Aviso</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>
  <body>
<div class="container theme-showcase" role="main">  

	<b>Categoria do Aviso:</b><?php
	switch ($resultado['classificacao']){
		case 1: echo " Calendário";break;
		case 2: echo " Estágio";break;
		case 3: echo " Atrasos/Ausência";break;
		case 4: echo " Trabalhos";break;
		case 5: echo " Monitoria";break;
		case 6: echo " Materiais";break;	
	}
	?>
	</br></br>
	<form action="" method="POST">
	<div class="form-group">
		<label for="Input-titulo">Título:</label>
		<input type="text" name="titulo" class="form-control"  maxlength="70" value="<?php printf("%s",$resultado['titulo']);?>" >
	</div>
      				
	<?php	
	
		if(isset($_POST['recado'])){
			
			$titulo= $_POST['titulo'];
			$recado = $_POST['recado'];
			$urgente= $_POST['urgente'];
			$data = $_POST['data'];
			
			if($resultado['classificacao'] == "1" || $resultado['classificacao'] == "3"|| $resultado['classificacao'] == "4"){
				$query = "UPDATE recados SET recado='$recado',data_='$data',urgente='$urgente',titulo='$titulo' WHERE id_recado=$id";
				$result = mysqli_query($conn,$query);
			
			}else{
				$query = "UPDATE recados SET recado='$recado',urgente='$urgente',titulo='$titulo' WHERE id_recado=$id";
				$result = mysqli_query($conn,$query);
			}
			
			if($resultado['analise_adm'] == 0){ //significa que o aviso foi publicado
				$query_2 =  "UPDATE recados SET analise_adm=1 WHERE id_recado=$id";
				$result_2 = mysqli_query($conn,$query_2);
				header("Location: avaliar_avisos.php");	
			}else if ($resultado['analise_adm'] == 1){ // significa que o aviso foi editado
				header("Location: avisos_avaliados.php");	
			} 
					
		}
	
	

			printf("<textarea  name='recado' id='recado' class='form-control' rows='10' 'required'>%s</textarea>",$resultado['recado']);
				
	?>
			<div class="element-radio"><label class="title" >Urgente ?<p class="text-center text-danger"></label>	
			<div class="column column2"><label><input type="radio" name="urgente" <?php if($resultado['urgente'] == 0 )printf("checked='checked'");?> value="0" /><span>Não </span></label></div><span class="clearfix"></span>
			<div class="column column2"><label><input type="radio" name="urgente" <?php if($resultado['urgente'] == 1) printf("checked='checked'");?> value="1" required/><span>Sim</span></label></div><span class="clearfix"></span>
			</div>
			
			<?php
			if($resultado['classificacao'] == "1" || $resultado['classificacao'] == "3"|| $resultado['classificacao'] == "4"){
				printf("<label for='Input-titulo'>Data: </label>");
				echo "<input type='date' value='".$resultado['data_']."'name='data'  /></label></br></br>";
			
			}
			?>
			
				
			<input type="submit" class='btn btn-sm btn-info' value="<?php if($resultado['analise_adm'] == 0){printf("Publicar");}else{printf("Salvar Alterações");}?>">	
			<a href='btn_reprovar_aviso.php?id=<?php echo $resultado['id_recado']?>'><button type='button' class='btn btn-sm btn-danger'>Excluir</button></a>			
			
			<?php
				if($resultado['analise_adm'] == 0){ 
					$redirecionar="avaliar_avisos.php";
				}else if ($resultado['analise_adm'] == 1){
					$redirecionar="avisos_avaliados.php";
				} 
			?>		
			
			<a href='<?php echo "$redirecionar"?>'><button type='button' class='btn btn-sm btn-warning'>Voltar</button></a>
			</form>	
			
</div>
				
      <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>