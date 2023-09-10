<?php
	$_POST['id_pessoaContEmerg'] = 1;
	$idpessoa = isset($_POST['id_pessoaContEmerg'])?$_POST['id_pessoaContEmerg']:0;
?>
<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Test</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
	</head>
	
	<body>

		<div class="container">

			<?php  $disabled='socio'; require("nav.php"); ?>

			<!-- <div class="container mt-5" id="headerPessoa">
				<div class="row">
					<div class="col-lg-9">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Informações Pessoais</h5>
								<p><strong>Nome Completo:</strong> [Nome Completo]</p>
								<p><strong>Nome Social:</strong> [Nome Social]</p>
								<p><strong>Nome do Pai:</strong> [Nome do Pai]</p>
								<p><strong>Nome da Mãe:</strong> [Nome da Mãe]</p>
								<p><strong>RG:</strong> [RG]</p>
								<p><strong>CPF:</strong> [CPF]</p>
								<p><strong>Número de Telefone:</strong> [Telefone]</p>
							</div>
						</div>
					</div>

					<div class="col-lg-3 mx-auto d-flex align-items-center">
						<div class="embed-responsive embed-responsive-3by4" style="height: 200px;">
							<img src="../img/sem-foto.png" alt="Foto da Pessoa" class="embed-responsive-item img-fluid">
						</div>
					</div>
				</div>
			</div> -->

			<h4 class="text-center">Cadastro de Contatos de Emergência</h4>
			<hr>

			<form name="form1" id="form1" method="post">
				<div class="form-control">
					<div class="row mb-3">
						<div class="col-lg-8">
							<label for="fam1" class="form-label">Nome de Familiar 1:</label>
							<input type="text" class="form-control" name="fam1" id="fam1" maxlength="255" autofocus>
						</div>
						<div class="col-lg-4">
							<label for="telfam1" class="form-label">Telefone Familiar 1:</label>
							<input type="text" class="form-control clstelefone" name="telfam1" id="telfam1" maxlength="16">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-8">
							<label for="fam2" class="form-label">Nome de Familiar 2:</label>
							<input type="text" class="form-control" name="fam2" id="fam2" maxlength="255">
						</div>
						<div class="col-lg-4">
							<label for="telfam2" class="form-label">Telefone Familiar 2:</label>
							<input type="text" class="form-control clstelefone" name="telfam2" id="telfam2" maxlength="16">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-8">
							<label for="medic" class="form-label">Nome de Médico:</label>
							<input type="text" class="form-control" name="medic" id="medic" maxlength="255">
						</div>
						<div class="col-lg-4">
							<label for="telmedic" class="form-label">Telefone Médico:</label>
							<input type="text" class="form-control clstelefone" name="telmedic" id="telmedic" maxlength="16">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-4">
							<label for="conv" class="form-label">Convênio Médico:</label>
							<input type="text" class="form-control" name="conv" id="conv"  maxlength="100">
						</div>
						<div class="col-lg-8">
							<label for="hosp" class="form-label">Hospital de preferência:</label>
							<input type="text" class="form-control" name="hosp" id="hosp" maxlength="255">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-12">
							<label for="hosp" class="form-label">Observações:</label>
							<textarea class="form-control" name="obs" id="obs" cols="10" rows="5"></textarea>
						</div>
					</div>
					<input type="hidden" name="id_contEmerg" id="id_contEmerg">
					<input type="hidden" name="id_pessoaContEmerg" id="id_pessoaContEmerg" value="<?=$idpessoa?>">
					<input type="hidden" name="action" id="action" value="update_pessoasContEmerg">

					<hr>

					<div class="row center mb-3">
						<div class="col-lg-12">
							<input id="save" class="btn btn-primary" type="submit" value="Salvar informações" title="Confirmar e enviar os dados do cadastro">&nbsp;
							<input id="cancel" class="btn btn-primary" type="reset" value="Limpar" title="Cancelar e limpar formulário de cadastro">
						</div>
					</div>
				</div>
			</form>

			<?php require("footer.php"); ?>

		</div>

		<script src="/js/jquery-3.2.1.min.js"></script>

		<script src="../css/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
    	<script src="../css/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

		<script src="../js/jquery.mask.min.js"></script>

		<script src="../js/pessoasContEmerg.js"></script>
		<script src="../js/common_functions.js"></script>

	</body>
</html>