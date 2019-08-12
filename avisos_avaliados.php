<?php
	session_start();
	
	if($_SESSION['usuarioNiveisAcessoId'] != "1"){
		header("Location: index.php");	
	}
	include_once("conexao.php");
	
	if ($_SESSION['nivel_especial'] == "1"){
		$result_recado_bd = "SELECT * FROM recados where analise_adm=1  ORDER BY classificacao ASC,urgente DESC";
		$con = $conn -> query ($result_recado_bd) or die ($conn);	
	}else if ($_SESSION['nivel_especial'] == "0"){
		
		$periodo = $_SESSION['periodo'];
		$ciclo = $_SESSION['ciclo'];
	
		$consulta = "select * from recados inner join alunos on alunos.id = recados.id_aluno where recados.analise_adm=1 and alunos.periodo='$periodo' and alunos.ciclo='$ciclo'  ORDER BY classificacao ASC,urgente DESC";
		$con = $conn -> query ($consulta) or die ($conn);	
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

    <title>Avisos Avaliados</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
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

	<div class="container theme-showcase" role="main">      
      
	  <div class="page-header">
        <h1>Avisos já Avaliados</h1>
		</div>
	  
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
            <!--     <th>Nome</th>
                <th>Ciclo</th>
                <th>Período</th> -->
				<th>titulo</th>
				<th>classificação</th>
				<th>urgente</th>
				<th>Ação</th>
              </tr>
            </thead>
            <tbody>
				<?php 
			    while($linhas = $con-> fetch_array()){ 
					echo "<tr>";
					//	echo "<td>".$linhas['nome']."</td>";
					//	if ($linhas['periodo'] == "Manha"){
					//		$linhas['periodo'] = "Manhã";
				//		}
				//		echo "<td>".$linhas['ciclo']."</td>";
				//		echo "<td>".$linhas['periodo']."</td>";
				
						printf("<td width='720'>%s</td>",$linhas['titulo']);
						
						switch ($linhas['classificacao']){
							case 1: echo "<td width='210'>Calendário</td>";break;
							case 2: echo "<td width='210'>Estágio</td>";break;
							case 3: echo "<td width='210'>Atrasos/Ausência</td>";break;
							case 4: echo "<td width='210'>Trabalhos</td>";break;
							case 5: echo "<td width='210'>Monitoria</td>";break;
							case 6: echo "<td width='210'>Materiais</td>";break;	
						}
						if ($linhas['urgente'] == 1){
							echo "<td width='210'>SIM</td>";
							
						} else if($linhas['urgente'] == 0){
							echo "<td width='210'>Não</td>";
						}
						?>
						<td> 
						
						<a href='btn_visualizar_aviso_2.php?id=<?php echo $linhas['id_recado']; ?>'><button type='button' class='btn btn-sm btn-warning'>Visualizar</button></a>
					
					<?php	
					echo "</tr>";
					
				}	
			?>
            </tbody>
          </table>
        </div>
		</div>
 </div>
				
	
					
	
	

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
