<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );
require_once ( "../dao/dataBase.php" ) ;

require_once ( "../models/PessoasCadastros.php" );
require_once ( "../models/PessoasDadosAdic.php" );
require_once ( "../models/Email.php" );

$data = new DataBase( $host, $user, $password, $dbname );

$PessoasCadastros = new PessoasCadastros();
$PessoasDadosAdic = new PessoasDadosAdic();

$Email = new Email();

switch ($_GET['action']) {

	case 'get_header_pessoasCad':
		
		$id = $PessoasCadastros->setId($_GET['id']);
		$res = $data->getHeaderPessoasCad($PessoasCadastros);
		
		break;

	case 'insert_pessoasDadosAdic':

		$PessoasDadosAdic->setIdpessoa(trim($_POST['id_pessoa']));
		$PessoasDadosAdic->setEndCep(trim($_POST['end_cep']));
		$PessoasDadosAdic->setEndLogr(trim($_POST['end_logr']));
		$PessoasDadosAdic->setEndNum(trim($_POST['end_num']));
		$PessoasDadosAdic->setEndBair(trim($_POST['end_bair']));
		$PessoasDadosAdic->setEndRef(trim($_POST['end_ref']));
		$PessoasDadosAdic->setEndCid(trim($_POST['end_cid']));
		$PessoasDadosAdic->setEndEst(trim($_POST['end_est']));
		$PessoasDadosAdic->setTel1(preg_replace('/\D/', '', $_POST['tel1']));
		$PessoasDadosAdic->setTel2(preg_replace('/\D/', '', $_POST['tel2']));
		$PessoasDadosAdic->setTel3(preg_replace('/\D/', '', $_POST['tel3']));
		$PessoasDadosAdic->setTipoDoc(trim($_POST['tipo_doc']));
		$PessoasDadosAdic->setDoc(trim($_POST['doc']));
		$PessoasDadosAdic->setRg(trim($_POST['rg']));
		$PessoasDadosAdic->setOe(trim($_POST['oe']));
		$PessoasDadosAdic->setNacio(trim($_POST['nacio']));
		$PessoasDadosAdic->setNatur(trim($_POST['natur']));
		$PessoasDadosAdic->setEstCiv(trim($_POST['est_civ']));
		$PessoasDadosAdic->setEscol(trim($_POST['escol']));
		$PessoasDadosAdic->setDataNasc(trim($_POST['data_nasc']));
		$PessoasDadosAdic->setSituacao(trim($_POST['situacao']));
		$PessoasDadosAdic->setDataFalec(trim($_POST['data_falec']));
		$PessoasDadosAdic->setEmailPess(trim($_POST['email_pess']));
		$PessoasDadosAdic->setSexo(trim($_POST['sexo']));
		$PessoasDadosAdic->setEmailBol(trim($_POST['email_bol']));
		$PessoasDadosAdic->setEmailAdic(trim($_POST['email_adic']));
		$PessoasDadosAdic->setTratPess(trim($_POST['trat_pess']));
		$PessoasDadosAdic->setSocioCons(trim($_POST['socio_cons']));
		$PessoasDadosAdic->setDataVinc(trim($_POST['data_vinc']));
		$PessoasDadosAdic->setDataRetSit(trim($_POST['data_ret_sit']));
		$PessoasDadosAdic->setSitRet(trim($_POST['sit_ret']));
		$PessoasDadosAdic->setQuadro(trim($_POST['quadro']));
		$PessoasDadosAdic->setMatrOpc(trim($_POST['matr_opc']));
		$PessoasDadosAdic->setDataDesl(trim($_POST['data_desl']));
		$PessoasDadosAdic->setTermo(trim($_POST['termo']));
		$PessoasDadosAdic->setObs(trim($_POST['obs']));
	
		$res = $data->insertPessoasDadosAdic( $PessoasDadosAdic );
		
		break;

	case 'update_pessoasDadosAdic':

		$PessoasDadosAdic->setIdpessoa(trim($_POST['id_pessoa']));
		$PessoasDadosAdic->setEndCep(trim($_POST['end_cep']));
		$PessoasDadosAdic->setEndLogr(trim($_POST['end_logr']));
		$PessoasDadosAdic->setEndNum(trim($_POST['end_num']));
		$PessoasDadosAdic->setEndBair(trim($_POST['end_bair']));
		$PessoasDadosAdic->setEndRef(trim($_POST['end_ref']));
		$PessoasDadosAdic->setEndCid(trim($_POST['end_cid']));
		$PessoasDadosAdic->setEndEst(trim($_POST['end_est']));
		$PessoasDadosAdic->setTel1(preg_replace('/\D/', '', $_POST['tel1']));
		$PessoasDadosAdic->setTel2(preg_replace('/\D/', '', $_POST['tel2']));
		$PessoasDadosAdic->setTel3(preg_replace('/\D/', '', $_POST['tel3']));
		$PessoasDadosAdic->setTipoDoc(trim($_POST['tipo_doc']));
		$PessoasDadosAdic->setDoc(trim($_POST['doc']));
		$PessoasDadosAdic->setRg(trim($_POST['rg']));
		$PessoasDadosAdic->setOe(trim($_POST['oe']));
		$PessoasDadosAdic->setNacio(trim($_POST['nacio']));
		$PessoasDadosAdic->setNatur(trim($_POST['natur']));
		$PessoasDadosAdic->setEstCiv(trim($_POST['est_civ']));
		$PessoasDadosAdic->setEscol(trim($_POST['escol']));
		$PessoasDadosAdic->setDataNasc(trim($_POST['data_nasc']));
		$PessoasDadosAdic->setSituacao(trim($_POST['situacao']));
		$PessoasDadosAdic->setDataFalec(trim($_POST['data_falec']));
		$PessoasDadosAdic->setEmailPess(trim($_POST['email_pess']));
		$PessoasDadosAdic->setSexo(trim($_POST['sexo']));
		$PessoasDadosAdic->setEmailBol(trim($_POST['email_bol']));
		$PessoasDadosAdic->setEmailAdic(trim($_POST['email_adic']));
		$PessoasDadosAdic->setTratPess(trim($_POST['trat_pess']));
		$PessoasDadosAdic->setSocioCons(trim($_POST['socio_cons']));
		$PessoasDadosAdic->setDataVinc(trim($_POST['data_vinc']));
		$PessoasDadosAdic->setDataRetSit(trim($_POST['data_ret_sit']));
		$PessoasDadosAdic->setSitRet(trim($_POST['sit_ret']));
		$PessoasDadosAdic->setQuadro(trim($_POST['quadro']));
		$PessoasDadosAdic->setMatrOpc(trim($_POST['matr_opc']));
		$PessoasDadosAdic->setDataDesl(trim($_POST['data_desl']));
		$PessoasDadosAdic->setTermo(trim($_POST['termo']));
		$PessoasDadosAdic->setObs(trim($_POST['obs']));
	
		$id = $PessoasDadosAdic->setId($_POST['id']);
	
		$res = $data->alterPessoasDadosAdic( $PessoasDadosAdic );
		
		break;

	case 'pessoasDadosAdic_one':
		$id_pessoaContEmerg = $PessoasDadosAdic->setIdPessoa($_GET["id"]);	
		$res = $data->PessoasDadosAdic_one( $PessoasDadosAdic );

		break;


}

echo json_encode($res);

