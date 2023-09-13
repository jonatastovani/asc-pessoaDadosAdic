<?php
	$_POST['id_pessoaDadosAdic'] = 2;
	$idpessoa = isset($_POST['id_pessoaDadosAdic'])?$_POST['id_pessoaDadosAdic']:0;
?>
<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Test</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/popup-style.css">
	</head>
	
	<body>

		<div class="container">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">ASCCLUB</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="..\index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Dados Pessoais</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="container mt-5" id="headerPessoa">
			</div>

			<hr>

			<form name="form1" id="form1" method="post">
				<div class="row">
					<div class="col-lg-9">
						<div class="row mb-3">
							<div class="col-md-3">
								<label for="end_cep" class="form-label"><b>CEP:</b></label>
								<input type="text" class="form-control" name="end_cep" id="end_cep" required autofocus>
							</div>
							<div class="col-md-9">
								<label for="end_logr" class="form-label"><b>Logradouro:</b></label>
								<input type="text" class="form-control grupoCEP" name="end_logr" id="end_logr" maxlength="255" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-2">
								<label for="end_num" class="form-label"><b>Número:</b></label>
								<input type="text" class="form-control" name="end_num" id="end_num" maxlength="6" value="12345" required>
							</div>
							<div class="col-md-5">
								<label for="end_ref" class="form-label">Referência:</label>
								<input type="text" class="form-control" name="end_ref" id="end_ref" maxlength="100">
							</div>
							<div class="col-md-5">
								<label for="end_bair" class="form-label"><b>Bairro:</b></label>
								<input type="text" class="form-control grupoCEP" name="end_bair" id="end_bair" maxlength="100" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-10">
								<label for="end_cid" class="form-label"><b>Cidade:</b></label>
								<input type="text" class="form-control grupoCEP" name="end_cid" id="end_cid" maxlength="255" required>
							</div>
							<div class="col-md-2">
								<label for="end_est" class="form-label"><b>UF:</b></label>
								<input type="text" class="form-control grupoCEP" name="end_est" id="end_est" required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-4">
								<label for="tel1" class="form-label">Telefone 1:</label>
								<input type="text" class="form-control clstelefone" name="tel1" id="tel1">
							</div>
							<div class="col-lg-4">
								<label for="tel2" class="form-label">Telefone 2:</label>
								<input type="text" class="form-control clstelefone" name="tel2" id="tel2">
							</div>
							<div class="col-lg-4">
								<label for="tel3" class="form-label">Telefone 3:</label>
								<input type="text" class="form-control clstelefone" name="tel3" id="tel3">
							</div>
						</div>
					</div>
					<div class="col-lg-3 mx-auto d-flex align-items-center">
						<div class="row">
							<div class="col-md-12">
								<div class="embed-responsive embed-responsive-3by4" style="height: 200px;">
									<img src="../img/sem-foto.png" alt="Foto da Pessoa" class="embed-responsive-item img-fluid">
								</div>
							</div>
							<div class="col-md-12 mt-3">
								<button class="btn btn-primary me-2" id="select_photo">Selecionar</button>
								<button class="btn btn-danger">Remover</button>
								<input type="file" id="uploader" hidden accept="image/jpeg,image/png"><br><br>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-2">
						<label for="tipo_doc" class="form-label"><b>CPF/CNPJ:</b></label>
						<select class="form-control" name="tipo_doc" id="tipo_doc" required>
							<option value="cpf" selected>CPF</option>
							<option value="cnpj">CNPJ</option>
						</select>
					</div>
					<div class="col-lg-3">
						<label for="doc" class="form-label"><b><span id="lbldoc">CPF:</span></b></label>
						<input type="text" class="form-control" name="doc" id="doc" value="123456789123456789" required>
					</div>
					<div class="col-lg-2">
						<label for="rg" class="form-label">RG:</label>
						<input type="text" class="form-control" name="rg" id="rg" maxlength="20">
					</div>
					<div class="col-lg-2">
						<label for="oe" class="form-label">O.E.:</label>
						<input type="text" class="form-control" name="oe" id="oe" maxlength="30">
					</div>
					<div class="col-lg-3">
						<label for="nacio" class="form-label">Nacionalidade:</label>
						<input type="text" class="form-control" name="nacio" id="nacio" maxlength="100">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-4">
						<label for="natur" class="form-label">Naturalidade:</label>
						<input type="text" class="form-control" name="natur" id="natur" maxlength="100">
					</div>
					<div class="col-lg-3">
						<label for="est_civ" class="form-label">Estado Civil:</label>
						<input type="text" class="form-control" name="est_civ" id="est_civ" maxlength="30">
					</div>
					<div class="col-lg-3">
						<label for="escol" class="form-label">Escolaridade:</label>
						<input type="text" class="form-control" name="escol" id="escol" maxlength="30">
					</div>
					<div class="col-lg-2">
						<label for="data_nasc" class="form-label"><b>Data de Nascimento:</b></label>
						<input type="date" class="form-control" name="data_nasc" id="data_nasc" value="1995-03-22" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-3">
						<label for="situacao" class="form-label">Situação:</label>
						<input type="text" class="form-control" name="situacao" id="situacao" maxlength="30">
					</div>
					<div class="col-lg-2">
						<label for="data_falec" class="form-label">Data de Falecimento:</label>
						<input type="date" class="form-control" name="data_falec" id="data_falec">
					</div>
					<div class="col-lg-5">
						<label for="email_pess" class="form-label">Email pessoal <b>(Email pessoal deve ser único)</b>:</label>
						<input type="email" class="form-control" name="email_pess" id="email_pess" maxlength="100">
					</div>
					<div class="col-lg-2">
						<label for="sexo" class="form-label"><b>Sexo(M/F):</b></label>
						<input type="text" class="form-control" name="sexo" id="sexo" maxlength="1" value="M" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-5">
						<label for="email_bol" class="form-label">Email boleto:</label>
						<input type="email" class="form-control" name="email_bol" id="email_bol"  maxlength="100">
					</div>
					<div class="col-lg-7">
						<label for="email_adic" class="form-label">Email adicional (Separe com ";" vários emails):</label>
						<input type="text" class="form-control" name="email_adic" id="email_adic"  maxlength="255">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-2">
						<label for="trat_pess" class="form-label">Tratamento pessoal:</label>
						<input type="text" class="form-control" name="trat_pess" id="trat_pess"  maxlength="30">
					</div>
					<div class="col-lg-2">
						<label for="socio_cons" class="form-label">Sócio concelheiro:</label>
						<input type="text" class="form-control" name="socio_cons" id="socio_cons"  maxlength="30">
					</div>
					<div class="col-lg-2">
						<label for="data_vinc" class="form-label">Data Vinculação:</label>
						<input type="date" class="form-control" name="data_vinc" id="data_vinc"  maxlength="255">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-2">
						<label for="data_ret_sit" class="form-label">Data Ret. Situação:</label>
						<input type="date" class="form-control" name="data_ret_sit" id="data_ret_sit">
					</div>
					<div class="col-lg-2">
						<label for="sit_ret" class="form-label">Situação Retorno:</label>
						<input type="text" class="form-control" name="sit_ret" id="sit_ret"  maxlength="30">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-2">
						<label for="quadro" class="form-label">Quadro:</label>
						<input type="text" class="form-control" name="quadro" id="quadro"  maxlength="30">
					</div>
					<div class="col-lg-2">
						<label for="matric_opc" class="form-label">Matrícula Opc:</label>
						<input type="text" class="form-control" name="matr_opc" id="matr_opc">
					</div>
					<div class="col-lg-2">
						<label for="data_desl" class="form-label">Data Desligamento:</label>
						<input type="date" class="form-control" name="data_desl" id="data_desl">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-6">
						<label for="termo" class="form-label">Termo:</label>
						<textarea class="form-control" name="termo" id="termo" cols="10" rows="5"></textarea>
					</div>
					<div class="col-lg-6">
						<label for="obs" class="form-label">Observações:</label>
						<textarea class="form-control" name="obs" id="obs" cols="10" rows="5"></textarea>
					</div>
				</div>

				<input type="hidden" name="id_dadosAdic" id="id_dadosAdic">
				<input type="hidden" name="id_pessoaDadosAdic" id="id_pessoaDadosAdic" value="<?=$idpessoa?>">
				<input type="hidden" name="action" id="action" value="insert_pessoasDadosAdic">

				<hr>

				<div class="row center mb-3">
					<div class="col-lg-12">
						<input id="save" class="btn btn-primary" type="submit" value="Salvar informações" title="Confirmar e enviar os dados do cadastro">&nbsp;
						<input id="cancel" class="btn btn-primary" type="reset" value="Limpar" title="Cancelar e limpar formulário de cadastro">
					</div>
				</div>
			</form>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
		<!-- <script src="../js/jquery.mask.min.js"></script> -->

		
		<?php include_once ("popupPhotos.php"); ?>
		
		<script src="../js/buscaCEP.js"></script>
		<script src="../js/common_functions.js"></script>
		<script src="../js/pessoasDadosAdic.js"></script>

	</body>
</html>