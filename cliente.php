<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "2" && $_SESSION['usuarioNiveisAcessoId'] != "1"){
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
		<link rel="stylesheet" type="text/css" href="css/div.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<meta name="author" content="Lucas Oliveira">
		<link rel="icon" href="imagens/adscom.ico">
		<title>Sistema de Comunicação ADS</title>
		<script type="text/javascript">
    function optionCheck(){
        var option = document.getElementById("classificacao").value;
        if(option == "1" || option== "3"|| option== "4"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
			document.getElementById("hiddenDiv").style.height ="100px";
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
	<body>
	<div id="general">
	
	<div id="logo">	      
		<img src="imagens\logo__cliente.png">	
	</div>
      
		
	<div id="bem_vindo">	

		 
	  <?php 
	  
	  printf("Bem-Vindo(a), %s ", $_SESSION['usuarioNome'] );
	  if ( $_SESSION['periodo'] == "Manha" ){
		  $periodo= "Manhã"; 
	  }
	  else{
		  $periodo= $_SESSION['periodo'];
	  }
	  switch ( $_SESSION['ciclo']){
		  case 'ADS 1':printf("- 1º ADS - %s",$periodo);break;
		  case 'ADS 2':printf("- 2º ADS - %s",$periodo);break;
		  case 'ADS 3':printf("- 3º ADS - %s",$periodo);break;
		  case 'ADS 4':printf("- 4º ADS - %s",$periodo);break;
		  case 'ADS 5':printf("- 5º ADS - %s",$periodo);break;
		  case 'ADS 6':printf("- 6º ADS - %s",$periodo);break;
		  default:printf("Não foi possivel localizar ciclo");
	  }	  
	  ?>  
		
    </div> 
	<div id="button">
		<?php 
			if ($_SESSION['usuarioNiveisAcessoId'] == 1){
				echo "<a href='administrativo.php'> <button type='button' class='btn ttn-sm btn-info' >Área do Administrador</button></a>";
			}	
		?>
		<a href="sair.php"> <button type="button" class="btn ttn-sm btn-danger" >Sair</button></a>
	</div>
	
		<div class="container theme-showcase" role="main">
			
			<div>

			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#calendario" aria-controls="calendario" role="tab" data-toggle="tab">Calendário</a></li>
				<li role="presentation"><a href="#estagios" aria-controls="estagios" role="tab" data-toggle="tab">Estágios</a></li>
				<li role="presentation"><a href="#atrasos_ausencia" aria-controls="atrasos_ausencia" role="tab" data-toggle="tab">Atrasos/Ausência</a></li>
				<li role="presentation"><a href="#trabalhos" aria-controls="trabalhos" role="tab" data-toggle="tab">Trabalhos</a></li>
				<li role="presentation"><a href="#monitoria" aria-controls="monitoria" role="tab" data-toggle="tab">Monitoria</a></li>
				<li role="presentation"><a href="#materiais" aria-controls="materiais" role="tab" data-toggle="tab">Materiais</a></li>
				<?php
				if ($_SESSION['usuarioNiveisAcessoId'] == "2"){ //if para exibir "enviar-aviso" apenas para aluno comum
				echo "<li role='presentation'><a href='#enviar_recado' aria-controls='enviar_recado' role='tab' data-toggle='tab'>Enviar Aviso</a></li>";   }?>
			  </ul>

			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="calendario">
					</br>
				
				<div class="container theme-showcase" role="main">      
     
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
				
              </tr>
            </thead>
            <tbody>
				<?php 
				$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=1 ORDER BY data_ ASC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						 
						 
						echo "<td width='210'>".date('d/m/Y', strtotime($linhas['data_']))."</td>";
						echo "<td >".nl2br($linhas['recado'])."</td>";
					
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>
				
				
				
					
				</div>
				<div role="tabpanel" class="tab-pane" id="estagios">
				
						<div class="container theme-showcase" role="main">      
      
      <div class="row">
        <div class="col-md-12">
          <table class="table">
		
          
            <tbody>
				<?php 
					$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=2 ORDER BY urgente DESC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						
						echo "<td>".nl2br($linhas['recado'])."</td>";
						
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>
					
				</div>
				<div role="tabpanel" class="tab-pane" id="atrasos_ausencia">
					
						<div class="container theme-showcase" role="main">      
     
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
				
              </tr>
            </thead>
            <tbody>
				<?php 
				$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=3 ORDER BY data_ ASC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						 
						 
						echo "<td width='210'>".date('d/m/Y', strtotime($linhas['data_']))."</td>";
						echo "<td >".nl2br($linhas['recado'])."</td>";
					
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>
				
				</div>
				<div role="tabpanel" class="tab-pane" id="trabalhos">

						<div class="container theme-showcase" role="main">      
     
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
				
              </tr>
            </thead>
            <tbody>
				<?php 
				$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=4 ORDER BY data_ ASC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						 
						 
						echo "<td width='210'>".date('d/m/Y', strtotime($linhas['data_']))."</td>";
						echo "<td >".nl2br($linhas['recado'])."</td>";
					
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>
				
				</div>
				<div role="tabpanel" class="tab-pane" id="monitoria">
				
				<div class="container theme-showcase" role="main">      
      
      <div class="row">
        <div class="col-md-12">
          <table class="table">
		
          
            <tbody>
				<?php 
					$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=5 ORDER BY urgente DESC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						
						echo "<td>".nl2br($linhas['recado'])."</td>";
						
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>
				
				</div>
				<div role="tabpanel" class="tab-pane" id="materiais">
		
			
					
				<div class="container theme-showcase" role="main">      
      
      <div class="row">
        <div class="col-md-12">
          <table class="table">
		
          
            <tbody>
				<?php 
					$periodo= $_SESSION['periodo'];
				$ciclo= $_SESSION['ciclo'];
				$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 
				and alunos.periodo='$periodo' and alunos.ciclo='$ciclo' and recados.classificacao=6 ORDER BY urgente DESC";
				$con = $conn -> query ($consulta) or die ($conn);
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
						
						echo "<td>".nl2br($linhas['recado'])."</td>";
						
						?>
						<td> 
						<?php
					echo "</tr>";
				}
			?>
            </tbody>
          </table>
        </div>
		</div>
	</div>

				
				
				</div>
				
		
				<div role="tabpanel" class="tab-pane" id="enviar_recado">
				
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
						$analise_adm = 0;
						if ($_SESSION['usuarioNiveisAcessoId'] == 1){
								$analise_adm = 1;
						}
						if ($classificacao == 1 ||$classificacao == 3 ||$classificacao == 4 ){
						$result_recado = "INSERT INTO recados (id_aluno,recado,classificacao,urgente,data_,analise_adm) VALUES ('$id_aluno','$recado','$classificacao','$urgente','$data','$analise_adm')";						
						}
						else{
						$result_recado = "INSERT INTO recados (id_aluno,recado,classificacao,urgente,data_,analise_adm) VALUES ('$id_aluno','$recado','$classificacao','$urgente',NOW(),'$analise_adm')";			
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
						<textarea  name="recado" id="recado" class="form-control" rows="6" required></textarea>
					</div>
					
					
					<div class="element-radio"><label class="title" >Urgente ?<p class="text-center text-danger">	
	</label>		<div class="column column2"><label><input type="radio" name="urgente" checked="checked" value="0" /><span>Não </span></label></div><span class="clearfix"></span>
					<div class="column column2"><label><input type="radio" name="urgente" value="1" required/><span>Sim</span></label></div><span class="clearfix"></span>
					</div>
						
					<div id="hiddenDiv" style="height:0px;width:0px;border:1px;visibility:hidden;">
					</br>
					<label for="exampleInputDate">Data: 
						<input type="date" name="data" id="data" /></label>
					</div>	
						
					</br>
					<input type="submit" class="btn btn btn-primary" value="Enviar">
				
				</form>
				
				
				
							
						</div>
					</div>
							
				</div>
			</div>

			</div>
		</div>
	</div>	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

