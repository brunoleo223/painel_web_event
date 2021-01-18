
<?php 
session_start();

include_once("../controll/hold.php");

if(isset($_SESSION['etapa'])){
	echo "Evento ID".$_SESSION['evento_id'];
	echo"<br>";
	echo "Cliente ID".$_SESSION['cliente_id'];
	echo"<br>";
	echo "Live ID".$_SESSION['cliente_id'];
	echo"<br>";
    echo "Message:".$_SESSION['msg'];
}

?>

<!doctype html>
<html lang="pt-br">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" sizes="212x212" href="../assets/img/icon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/application.css">
	<!-- toastify.js and css-->
	<script src="../assets/js/toastify.js"></script>
	<link rel="stylesheet" href="../assets/css/toastify.css">
	<title>_webEvent - Instalador</title>
</head>
<body class="instalador">
	<?php
	 include_once("../connect/connect.php")
	?>
	<div class="container">
		<!--
			Região do SideBar
			#Criação de uma região monitorando as etapas concluídas
			#Região não permite clice ou Rollback de etapas
			#Região sobrepondo outra divs, sem responsividade
		 -->
		 <script> console.log(window)</script>
		<div class="row">
			<!-- Sidebar -->
			<div class="col-md-3">
				<div class="sidebar">
					<img src="../assets/img/logo_b.png" alt="">
					<ul class="list-group">
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 1){echo "checked"; }?> disabled>
							Cliente
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 1){echo "checked"; }?> disabled>
							Sobre o Evento
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 2){echo "checked"; }?> disabled>
							Convidados
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 2){echo "checked"; }?> disabled>
							Personalização
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 3){echo "checked"; }?> disabled>
							Interação
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 3){echo "checked"; }?> disabled>
							Transmissão
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 4){echo "checked"; }?> disabled>
							Cadastro
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 5){echo "checked"; }?> disabled>
							Login
						</li>
						<li class="list-group-item">
							<input class="form-check-input mr-1" type="checkbox" value="" aria-label="..." <?php if($_SESSION['etapa'] > 6){echo "checked"; }?> disabled>
							Mensagens
						</li>
					</ul>
				</div>
			</div>
			
			<!-- Campos -->
			<div class="col-md-9 campos">
				<form class="row g-3 needs-validation mb-5 pb-5" enctype="multipart/form-data" action="../controll/create_event.php" method="post" novalidate>
					
					<?php if($_SESSION['etapa'] == 1){?>
						
						<!-- Cliente -->
						<div id="campo_clientes" class="row g-3">
							<h2 class="display-2">Cliente</h2>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="tipo_de_cliente" name="tipo_de_cliente" value=1 checked  onchange="checkbox_fields('cliente')">
								<!-- value=<?php echo $_SESSION['tipo_de_cliente']?>; <?php echo $_SESSION['checkbox_Client'];?> -->
								<label class="form-check-label" for="tipo_de_cliente">Cliente já cadastrado</label>
							</div>
							<div class="row g-3" id="campos_mostrar_cliente">
								<div class="col-md-12">
									<label for="cliente" class="form-label">Lista de Clientes*</label>
									<select class="form-select" id="cliente" name="cliente_id" required="true">
										<option selected disabled value="">Selecione...</option>
										<?php
											# Região de listagem da lista de dados
											$idEvent = $_SESSION['evento_id'];
											$sql2 = ("SELECT * from lives WHERE idlives = '$idEvent'");
											$consultaIdCliente = mysqli_query($link,$sql2);
											while($dadosClientes2=mysqli_fetch_array($consultaIdCliente)){
												$idCli=$dadosClientes2[1];
											}			
											$sql=("SELECT nome,idclientes from clientes");
											$consultaNome=mysqli_query($link,$sql);
											while($dadosClientes=mysqli_fetch_array($consultaNome)){
												$nome=$dadosClientes[0];
												$idclient=$dadosClientes[1];
												if($idclient == $idCli){
													echo "<option value='$idclient' selected>".$nome."</option>";	
												}else{
													echo "<option value='$idclient'>".$nome."</option>";
												}												
											}											
										?>
									</select>
								</div>
							</div>
							<div class="row g-3" id="campos_oculto_cliente" name="add_cliente" value="1">
								<div class="col-md-6">
									<label for="cliente_nome" class="form-label">Nome</label>
									<input type="text" class="form-control" name="cliente_nome" id="cliente_nome" value="<?php echo $_SESSION['cliente_nome']?>">
								</div>
								<div class="col-md-6">
									<label for="cliente_site" class="form-label">Site</label>
									<input type="text" class="form-control" name="cliente_site" id="cliente_site" value="<?php echo $_SESSION['cliente_site']?>">
								</div>
								<div class="col-md-6">
									<label for="cliente_responsavel" class="form-label">Responsável</label>
									<input type="text" class="form-control" name="cliente_responsavel" id="cliente_responsavel" value="<?php echo $_SESSION['cliente_responsavel']?>">
								</div>
								<div class="col-md-6">
									<label for="cliente_logo" class="form-label">Logo</label>
									<div class="form-file">
										<input type="file" class="form-file-input" name="cliente_logo" id="cliente_logo" >
										<label class="form-file-label" for="cliente_logo">
											<span class="form-file-text">Inserir logo da empresa...</span>
											<span class="form-file-button">Procurar</span>
										</label>
									</div>
								</div>
							</div>														
						</div>
						
						<!-- Evento -->
						<div id="campo_evento" class="row g-3">
							<h2 class="display-2 mt-5 pt-5">Evento</h2>
							<div class="col-md-12">
								<label for="evento_nome" class="form-label">Nome*</label>
								<input type="text" class="form-control" name="evento_nome" id="evento_nome" placeholder="Nome do Evento" required="true" value="<?php echo $_SESSION['evento_nome']?>">
							</div>
							<div class="col-md-6">
								<label for="evento_data" class="form-label">Data</label>
								<input type="date" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" class="form-control" name="evento_data" id="evento_data" required="true" value="<?php echo $_SESSION['evento_data']?>">
							</div>
							<div class="col-md-6">
								<label for="evento_hora" class="form-label">Hora</label>
								<input type="time" class="form-control" data-mask="00:00" name="evento_hora" id="evento_hora" required="true" value="<?php echo $_SESSION['evento_hora']?>">
							</div>
						</div>

						<?php 
							if($_SESSION['invalid']==1){								
								echo "<script>var myToast = Toastify({
								text: 'Selecione o cliente e Insira o nome do Evento!',
								duration: 5000
						        })
							    myToast.showToast();
							    </script>";
							    $_SESSION['invalid']=0;
							} 
						?>
						<?php
					} if($_SESSION['etapa'] == 2){?>
						<!-- Convidados -->
						<div id="campo_convidados" class="row g-3">
							<h2 class="display-2">Convidados</h2>
							<div class="form-check form-switch">
								<label class="form-check-label" for="tipo_de_convidados"><b>Habilitar Convidados</b></label>
								<input class="form-check-input" type="checkbox" id="tipo_de_convidados" value="1" name="tipo_de_convidados" checked onchange="checkbox_fields('convidados')">
							</div>
							<div class="row g-3" id="campos_mostrar_convidados">
								<div class="btn btn-outline-dark mb-4" data-toggle="modal" data-target="#addUser">+ Adicionar convidado</div>
								<?php if($_SESSION['list_convidados'] == 0){?>
									<div class="convidados">
										<div class="convidado row">
											<div class="col-auto"><div class="foto_convidado"><img src="../assets/img/icon.png" alt="foto"></div></div>											
											<div class="col-3"><b>Nome</b><br><input class="form-control" type="text" id="nome_convidado" value="" disabled></div>
											<div class="col-3"><b>Link do Currículo</b><br><input class="form-control" type="text" id="link_convidado" value="" disabled></div>
											<div class="col-3"><b>Mini Bio</b><br><input class="form-control" type="text" id="bio_convidado" value="" disabled></div>
											<div class="col-md-1 pt-3">
												<div class="edit_convidado">
													<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
														<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
													</svg>
												</div> 
												<div class="del_convidado">
													<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
													</svg>
												</div>
											</div>
										</div>
									</div>
									<?php } else { $rows = count($_SESSION['list_convidados']); if ( $rows > 0) { for($i = $rows-1; $i >= 0; $i--){ ?>
										<div class="convidados">
											<div class="convidado row">
												<div class="col-auto"><div class="foto_convidado"><img src="../assets/img/<?php echo $_SESSION['list_convidados'][$i]['foto']; ?>" alt=""></div></div>
												<div class="col-3"><b>Nome</b><br><input class="form-control" type="text" id="nome_convidado" value="<?php echo $_SESSION['list_convidados'][$i]['nome']; ?>" disabled></div>
												<div class="col-3"><b>Link do Currículo</b><br><input class="form-control" type="text" id="link_convidado" value="<?php echo $_SESSION['list_convidados'][$i]['link_curriculo']; ?>" disabled></div>
												<div class="col-3"><b>Mini Bio</b><br><input class="form-control" type="text" id="bio_convidado" value="<?php echo $_SESSION['list_convidados'][$i]['minibio']; ?>" disabled></div>
												<div class="col-md-1 pt-3">
													<div class="edit_convidado" data-toggle="tooltip" data-placement="right" title="Editar">
														<svg data-toggle="modal" data-target="#editUser" onclick="edit_user('<?php echo $_SESSION['list_convidados'][$i]['idconvidados'];?>', '<?php echo $_SESSION['list_convidados'][$i]['nome'];?>', '<?php echo $_SESSION['list_convidados'][$i]['link_curriculo'];?>', '<?php echo $_SESSION['list_convidados'][$i]['minibio'];?>')" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
															<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
															<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
														</svg>
													</div> 
													<div class="del_convidado" data-toggle="tooltip" data-placement="right" title="Deletar">
														<svg data-toggle="modal" data-target="#delUser" onclick="del_user('<?php echo $_SESSION['list_convidados'][$i]['idconvidados'];?>')" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
														</svg>
													</div>
												</div>
											</div>
										</div>
										<?php }
									}
								} ?>
							</div>
							<div id="campos_oculto_convidados">
								<p>Habilite a opção de convidados para poder editar.</p>
							</div>
						</div>
						
						<!-- Personalização -->
						<div id="campo_personalizacao" class="row g-3">
							<h2 class="display-2">Personalização</h2>
							<div class="col-md-4">
								<label for="personalizacao_bg" class="form-label">Background das Páginas</label>
								<div class="form-file">
									<input type="file" class="form-file-input" id="personalizacao_bg" name="personalizacao_bg" required>
									<label class="form-file-label" for="personalizacao_bg">
										<span class="form-file-text">Inserir imagem de fundo...</span>
										<span class="form-file-button">Procurar</span>
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<label for="personalizacao_logo" class="form-label">Logo do Evento</label>
								<div class="form-file">
									<input type="file" class="form-file-input" id="personalizacao_logo" name="personalizacao_logo" required>
									<label class="form-file-label" for="personalizacao_logo">
										<span class="form-file-text">Inserir logo do evento...</span>
										<span class="form-file-button">Procurar</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<label for="personalizacao_cor1" class="form-label">Cor Principal</label>
								<input type="color" class="form-control form-control-color" id="personalizacao_cor1" name="personalizacao_cor1" value="#ff5f0a" title="Choose your color">
							</div>
							<div class="col-md-2">
								<label for="personalizacao_cor2" class="form-label">Secundária</label>
								<input type="color" class="form-control form-control-color" id="personalizacao_cor2" name="personalizacao_cor2" value="#ff8d50" title="Choose your color">
							</div>
						</div>					
						<?php
					} if($_SESSION['etapa'] == 3){?>
						
						<!-- Interação -->
						<div id="campo_interacao" class="row g-3">
							<h2 class="display-2">Interação</h2>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="interacao_perguntas" onchange="nocheck('interacao_perguntas', 'tipo_de_interacao', 'interacao');" id="interacao_perguntas" <?php if($_SESSION['interacao_perguntas']=='1'){echo "checked"; }?>>
								<label class="form-check-label" for="interacao_perguntas" >Perguntas</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
								<label class="form-check-label" for="tipo_de_interacao">Slido, Vevox, Vimeo, outros...*</label>
								<input class="form-check-input" type="checkbox" name="tipo_de_interacao" id="tipo_de_interacao" onchange="checkbox_fields('interacao'); nocheck('tipo_de_interacao', 'interacao_perguntas');" <?php if($_SESSION['interacao_perguntas'] !='1'){echo "checked"; }?>>
							</div>
							<div class="row g-3" id="campos_mostrar_interacao" <?php if($_SESSION['interacao_perguntas']=='1'){echo "style='display: none;'";}else{echo "style='display: block;'";}?>>
								<div class="col-md-12">
									<label for="interacao_codigo" class="form-label">Código</label>
									<input type="text" class="form-control" name="interacao_codigo" id="interacao_codigo" rows="5" required value="<?php echo $_SESSION['interacao_codigo']?>">
								</div>
							</div>
							<div id="campos_oculto_interacao">
							</div>
						</div>
						
						<!-- Transmissão -->
						<div id="campo_transmissao" class="row g-3">
							<h2 class="display-2 mt-5 pt-5">Transmissão</h2>
							<div class="col-md-12 pt-3">
								<label for="transmissao_player1" class="form-label">Código do Player Principal*</label>
								<input type="text" class="form-control" name="transmissao_player1" id="transmissao_player1" rows="2" required value="<?php echo $_SESSION['transmissao_player1']?>">
							</div>
							<div class="col-md-12 pt-3">
								<label for="transmissao_player2" class="form-label">Código do Player Secundário</label>
								<input type="text" class="form-control" name="transmissao_player2" id="transmissao_player2" rows="2" value="<?php echo $_SESSION['transmissao_player2']?>">
							</div>
							<div class="col-md-12 pt-3">
								<label for="transmissao_traducao" class="form-label">Código do Player de Tradução (quando houver)</label>
								<input type="text" class="form-control" name="transmissao_traducao" id="transmissao_traducao" rows="2" value="<?php echo $_SESSION['transmissao_traducao']?>">
							</div>
						</div>
						<?php 
							if($_SESSION['invalid']==1){							
								echo "<script>var myToast = Toastify({
								text: 'Preencha os campos obrigatórios',
								duration: 5000
						        })
							    myToast.showToast();
							    </script>";
							    $_SESSION['invalid']=0;
							} 
						?>
						
						<?php
					} if($_SESSION['etapa'] == 4){?>
						
						<!-- Cadastro -->
						<div id="campo_cadastro" class="row g-3">
							<h2 class="display-2">Cadastro</h2>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
								<label class="form-check-label" for="tipo_de_cadastro"><b>Habilitar Cadastro</b></label>
								<input class="form-check-input" type="checkbox" id="tipo_de_cadastro" name="tipo_de_cadastro" checked onchange="checkbox_fields('cadastro')">
							</div>
							<div class="row g-3" id="campos_mostrar_cadastro">
								<hr>
								<b>Selecione os campos para cadastro</b>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_nome" id="cadastro_campo_nome" <?php if($_SESSION['campo_nome']=='1'){echo "checked"; }else if($_SESSION['campo_nome']=='1'){echo " ";}else{echo "checked";}?>>
										<label class="form-check-label" for="cadastro_campo_nome">Nome</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_sobrenome" id="cadastro_campo_sobrenome" <?php if($_SESSION['campo_sobrenome']=='1'){echo "checked"; }else if($_SESSION['campo_sobrenome']=='1'){echo " ";}else{echo "checked";}?>>
										<label class="form-check-label" for="cadastro_campo_sobrenome">Sobrenome</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_email" id="cadastro_campo_email" onchange="exibe('cadastro_campo_email', 'campo_valida_email')" <?php if($_SESSION['campo_email']=='1'){echo "checked"; }else if($_SESSION['campo_email']=='1'){echo " ";}else{echo "checked";}?>>
										<label class="form-check-label" for="cadastro_campo_email">Email</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_telefone" id="cadastro_campo_telefone" <?php if($_SESSION['campo_telefone']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_telefone">Telefone</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_celular"  id="cadastro_campo_celular" <?php if($_SESSION['campo_celular']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_celular">Celular</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_empresa" id="cadastro_campo_empresa" <?php if($_SESSION['campo_empresa']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_empresa">Empresa</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_cargo" id="cadastro_campo_cargo" <?php if($_SESSION['campo_cargo']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_cargo">Cargo</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_especialidade" id="cadastro_campo_especialidade" <?php if($_SESSION['campo_especialidade']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_especialidade">Especialidade</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox"  name="campo_ufcrm" id="cadastro_campo_uf_crm" onchange="exibe('cadastro_campo_uf_crm', 'campo_valida_crm')"  <?php if($_SESSION['campo_ufcrm']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="cadastro_campo_uf_crm">UF e CRM</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" name="campo_senha"  id="tipo_de_senha" onchange="checkbox_fields('senha');" <?php if($_SESSION['campo_senha']=='1'){echo "checked"; }?>>
										<label class="form-check-label" for="tipo_de_senha" >Senha</label>
									</div>
								</div>
								<div class="row g-3" id="campos_mostrar_senha" style="display: none;">
									<hr>
									<b>Senha</b>
									<div class="col-md-3 pt-1">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox"  name="senha_aleatoria" id="senha_aleatoria" onchange="checkbox_fields2('senha_padrao'); nocheck('senha_aleatoria', 'tipo_de_senha_padrao', '1')" <?php if($_SESSION['senha_aleatoria']=='1'){echo "checked"; }?>>
											<label class="form-check-label" for="senha_aleatoria">Senha Aleatória</label>
										</div>
									</div>
									<div class="col-md-auto pt-1">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="senha_padrao" id="tipo_de_senha_padrao" onchange="checkbox_fields('senha_padrao'); nocheck('tipo_de_senha_padrao', 'senha_aleatoria', '1');" <?php if($_SESSION['senha_padrao']=='1'){echo "checked";}?>>
											<label class="form-check-label" for="senha_padrao" >Senha Padrão</label>
										</div>
									</div>
									<div class="col-md-6" id="campos_mostrar_senha_padrao" <?php if($_SESSION['senha_padrao']!='1'){echo "style='display: none;'";}?>>
										<input type="text" class="form-control" name="senha_campo" id="senha_do_evento" rows="2" value="<?php echo $_SESSION['senha_campo']?>">
									</div>
									<div id="campos_oculto_senha_padrao"></div>
								</div>
								<div class="row g-3" id="campos_oculto_senha"></div>
								<hr>
								<b>Validações</b>
								<div class="col-md-3" id="campo_valida_crm">
									<div class="form-check form-switch" >
										<input class="form-check-input" type="checkbox" name="valida_crm" id="valida_crm" <?php if($_SESSION['valida_crm']=='1'){echo "checked"; }else if($_SESSION['valida_crm']=='1'){echo " ";}else{echo "checked";}?>>
										<label class="form-check-label" for="valida_crm">Validar CRM</label>
									</div>
								</div>
								<div class="col-md-4" id="campo_valida_email">
									<div class="form-check form-switch" >
										<input class="form-check-input" type="checkbox" name="valida_email" id="valida_email" <?php if($_SESSION['valida_email']=='1'){echo "checked"; }else if($_SESSION['valida_email']=='1'){echo " ";}else{echo "checked";}?>>
										<label class="form-check-label" for="valida_email">Validar E-mails Duplicados</label>
									</div>
								</div>
							</div>
							<div id="campos_oculto_cadastro">
							</div>
							<?php 
								if($_SESSION['etapa']==4 && $_SESSION['invalid']==1){																
									echo "<script>var myToast = Toastify({
									text: 'Selecione um Item',
									duration: 5000
									})
									myToast.showToast();
									</script>";
									$_SESSION['invalid']=0;
								} 
							?>
							<?php 
								if($_SESSION['etapa']==4 && $_SESSION['invalid']==2){																
									echo "<script>var myToast = Toastify({
									text: 'Preencha o campo de Senha',
									duration: 5000
									})
									myToast.showToast();
									</script>";
									$_SESSION['invalid']=0;
								} 
							?>
							<?php 
								if($_SESSION['etapa']==4){																
									echo "<script>var check = document.getElementById('tipo_de_senha');
									var ocultar = document.getElementById('campos_mostrar_senha');									
									if (check.checked == true){				
										ocultar.style.display = 'flex';
									}
									</script>";
								} 
							?>
						</div>
											
						<?php 
					} if($_SESSION['etapa'] == 5){?>				  
						<!-- Login -->
						<div id="campo_login" class="row g-3">
							<h2 class="display-2">Login</h2>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_nome" id="login_campo_nome" <?php if($_SESSION['login_campo_nome']=='1'){echo "checked"; }else if($_SESSION['login_campo_nome']=='1'){echo " ";}else{echo "checked";}?>>
									<label class="form-check-label" for="login_campo_nome">Nome</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_sobrenome" id="login_campo_sobrenome" <?php if($_SESSION['login_campo_sobrenome']=='1'){echo "checked"; }else if($_SESSION['login_campo_sobrenome']=='1'){echo " ";}else{echo "checked";}?>>
									<label class="form-check-label" for="login_campo_sobrenome">Sobrenome</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_email" id="login_campo_email" <?php if($_SESSION['login_campo_email']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_email">Email</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_telefone" id="login_campo_telefone" <?php if($_SESSION['login_campo_telefone']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_telefone">Telefone</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_celular" id="login_campo_celular" <?php if($_SESSION['login_campo_celular']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_celular">Celular</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_empresa" id="login_campo_empresa" <?php if($_SESSION['login_campo_empresa']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_empresa">Empresa</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_cargo" id="login_campo_cargo" <?php if($_SESSION['login_campo_cargo']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_cargo">Cargo</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_especialidade" id="login_campo_especialidade" <?php if($_SESSION['login_campo_especialidade']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_especialidade">Especialidade</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_uf_crm" id="login_campo_uf_crm" <?php if($_SESSION['login_campo_uf_crm']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_uf_crm">UF e CRM</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="login_campo_senha" id="login_campo_senha" <?php if($_SESSION['login_campo_senha']=='1'){echo "checked"; }?>>
									<label class="form-check-label" for="login_campo_senha">Senha</label>
								</div>
							</div>
							<?php 
								if($_SESSION['etapa']==1){
									$_SESSION['invalid']=10;
								}

								if($_SESSION['etapa']==5 && $_SESSION['invalid']==1){
									echo "<script>var myToast = Toastify({
										text: 'Selecione pelo menos um item!',
										duration: 5000
									   })
									   myToast.showToast();
									   </script>";
									$_SESSION['invalid']=0;
								} 
							?>
						</div>	
						
						<?php
					} if($_SESSION['etapa'] == 6){?>
						
						<!-- Mensagens -->
						<div id="campo_mensagens" class="row g-3">
							<h2 class="display-2">Mensagens</h2>
							<div class="col-md-12 pt-3">
								<label for="texto_email_cadastro" class="form-label">Texto do e-mail de cadastro*</label>
								<input type="text" class="form-control" name="texto_email_cadastro" id="texto_email_cadastro" rows="5" required="" value="<?php echo $_SESSION['texto_email_cadastro']?>">
							</div>
							<div class="col-md-12 pt-3">
								<label for="texto_email_nova_senha" class="form-label">Texto do e-mail de nova senha*</label>
								<input type="text" class="form-control" name="texto_email_nova_senha" id="texto_email_nova_senha" rows="5" required="" value="<?php echo $_SESSION['texto_email_nova_senha']?>">
							</div>
						</div>
						<?php 
								if($_SESSION['etapa']==6 && $_SESSION['invalid']==1){																
									echo "<script>var myToast = Toastify({
									text: 'Preencha os campos',
									duration: 5000
									})
									myToast.showToast();
									</script>";
									$_SESSION['invalid']=0;
								} 
							?>
						
						<?php
					} ?>
					
					<div class="col-12 mt-5 mb-5">
						<hr>
						<input type="hidden" name="etapa" value="<?php echo $_SESSION['etapa'];?>">
						<!-- <button class="btn btn-primary" type="submit" value="Reset">Reset</button> -->
						<!-- Região de Manipulação do retornar -->
						<?php 
						if($_SESSION['etapa'] > 1){								
							echo '<button class="btn btn-primary"  type="submit" name="retornar" value="1">'.'Retornar'.'</button>';
						};
						?> 
						<button class="btn btn-primary" type="submit"><?php if($_SESSION['etapa'] == 6){echo 'Iniciar Instalação';} else {echo 'Continuar...';}?></button>
						<p id="result"></p>
					</div>
				</form>

				
				
				<!-- Add Usuário -->
				<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="addUserLabel">Adicionar Convidado</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="needs-validation" enctype="multipart/form-data" action="../controll/create_event.php?f=add" method="post" novalidate>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-check form-switch">
												<label for="convidados_nome" class="form-label">Nome</label>
												<input type="text" class="form-control" id="convidados_nome" name="convidados_nome" required>
											</div>
										</div>
										<div class="col-md-12 pt-3">
											<label for="convidados_curriculo" class="form-label">Link do Currículo</label>
											<input type="text" class="form-control" id="convidados_curriculo" name="convidados_curriculo">
										</div>
										<div class="col-md-12 pt-3">
											<div class="form-check form-switch">
												<label for="convidados_foto" class="form-label">Foto</label>
												<div class="form-file">
													<input type="file" class="form-file-input" id="convidados_foto" name="convidados_foto" required>
													<label class="form-file-label" for="convidados_foto">
														<span class="form-file-text">Inserir foto...</span>
														<span class="form-file-button">Procurar</span>
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-12 pt-3">
											<label for="convidados_bio" class="form-label">Mini Bio</label>
											<textarea type="text" class="form-control" id="convidados_bio" name="convidados_bio" rows="5"></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
									<button class="btn btn-primary">Adicionar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				
				<!-- Edit Usuário -->
				<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="editUserLabel">Editar dados do convidado</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="needs-validation" enctype="multipart/form-data" action="../controll/create_event.php?f=edit" method="post" novalidate>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-check form-switch">
												<label for="edit_convidados_nome" class="form-label">Nome</label>
												<input type="text" class="form-control" id="edit_convidados_nome" name="edit_convidados_nome" required>
											</div>
										</div>
										<div class="col-md-12 pt-3">
											<label for="edit_convidados_curriculo" class="form-label">Link do Currículo</label>
											<input type="text" class="form-control" id="edit_convidados_curriculo" name="edit_convidados_curriculo">
										</div>
										<div class="col-md-12 pt-3">
											<div class="form-check form-switch">
												<label for="edit_convidados_foto" class="form-label">Foto</label>
												<div class="form-file">
													<input type="file" class="form-file-input" id="edit_convidados_foto" name="edit_convidados_foto">
													<label class="form-file-label" for="edit_convidados_foto">
														<span class="form-file-text">Inserir foto...</span>
														<span class="form-file-button">Procurar</span>
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-12 pt-3">
											<label for="edit_convidados_bio" class="form-label">Mini Bio</label>
											<textarea type="text" class="form-control" id="edit_convidados_bio" name="edit_convidados_bio" rows="5"></textarea>
											<input type="hidden" id="edit_convidados_id" name="edit_convidados_id" value="">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
									<button class="btn btn-primary">Atualizar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<!-- Del Usuário -->
				<div class="modal fade" id="delUser" tabindex="-1" aria-labelledby="delUserLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="delUserLabel">Deletar convidado</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="needs-validation" enctype="multipart/form-data" action="../controll/create_event.php?f=del" method="post" novalidate>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12 pt-3">
											<p>Deseja realmente deletar esse convidado desse evento?</p>
											<input type="hidden" id="del_convidados_id" name="del_convidados_id" value="">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
									<button class="btn btn-primary">Confirmar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
	
	<script>
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
		
		(function () {
			var forms = document.querySelectorAll('.needs-validation')
			Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}
					form.classList.add('was-validated')
				}, false)
			})
		})()
	</script>
	
	<script>
		function edit_user(id, nome, link, bio){
			$('#edit_convidados_id').val(id);
			$('#edit_convidados_nome').val(nome);
			$('#edit_convidados_curriculo').val(link);
			$('#edit_convidados_bio').val(bio);
		}
		
		function del_user(id){
			$('#del_convidados_id').val(id);
		}

		function nocheck(check1, check2, ocultar){
			var check1 = document.getElementById(check1);
			var check2 = document.getElementById(check2);
			if (check1.checked == true){
				check2.checked = false;
				if(ocultar != '0'){
					checkbox_fields(ocultar);
				}
				if(ocultar == '1'){
					check2.checked = false;
				}
			} else {
				if(ocultar == '1'){
					check2.checked = true;
				}
			}
		}

		// ***esse*** igual a ação de OOP this
		function exibe(esse, id_campo){
			var esse = document.getElementById(esse);
			var id_campo = document.getElementById(id_campo);
			if (esse.checked == false){
				id_campo.style.display = "none";
			} else {
				id_campo.style.display = "flex  ";
			}
		}
		
		function checkbox_fields(campo) {
			let check = document.getElementById('tipo_de_'+campo);
			let section = document.getElementById('campo_'+campo);
			let ocultar = document.getElementById('campos_oculto_'+campo);
			let mostrar = document.getElementById('campos_mostrar_'+campo);
			if (check.checked == true){
				
				ocultarNone(ocultar);				
				mostrar.style.display = "flex";
				inputs = mostrar.querySelectorAll('input, select');
				for (index = 0; index < inputs.length; ++index) {
					inputs[index].setAttribute("required", "required")
				}
				
			} else {					
				ocultarFlex(ocultar);
				mostrarNone(mostrar);				
			}
		}

		function checkbox_fields2(campo) {
			let check = document.getElementById('tipo_de_'+campo);
			let section = document.getElementById('campo_'+campo);
			let ocultar = document.getElementById('campos_oculto_'+campo);
			let mostrar = document.getElementById('campos_mostrar_'+campo);
			if (check.checked == false){
				
				ocultarNone(ocultar);				
				mostrar.style.display = "flex";
				inputs = mostrar.querySelectorAll('input, select');
				for (index = 0; index < inputs.length; ++index) {
					inputs[index].setAttribute("required", "required")
				}
				
			} else {					
				ocultarFlex(ocultar);
				mostrarNone(mostrar);				
			}
		}	

		function ocultarNone(ocultar){
			ocultar.style.display = "none";
			inputs = ocultar.querySelectorAll('input, select');
			for (index = 0; index < inputs.length; ++index) {
				inputs[index].removeAttribute("required")
			}
		}

		function ocultarFlex(ocultar){
			ocultar.style.display = "flex";
			inputs = ocultar.querySelectorAll('input, select');
			for (index = 0; index < inputs.length; ++index) {
				inputs[index].setAttribute("required", "required")
			}
		}

		function mostrarNone(mostrar){
			mostrar.style.display = "none";
			inputs = mostrar.querySelectorAll('input, select');
			for (index = 0; index < inputs.length; ++index) {
				inputs[index].removeAttribute("required")
			}
		}	
	</script>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="../assets/js/jquery.mask.min.js"></script>	
</body>
</html>