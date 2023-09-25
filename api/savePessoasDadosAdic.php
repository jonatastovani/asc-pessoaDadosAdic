<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );

require_once ( "../controllers/saveController.php" ); 

if (isset($_POST["action"]))
{
	switch ($_POST["action"]){

		case 'insert_pessoasDadosAdic':
			
			$form_data = array(
				'end_cep' => $_POST['end_cep'],
				'end_logr' => $_POST['end_logr'],
				'end_num' => $_POST['end_num'],
				'end_bair' => $_POST['end_bair'],
				'end_ref' => $_POST['end_ref'],
				'end_cid' => $_POST['end_cid'],
				'end_est' => $_POST['end_est'],
				'tel1' => $_POST['tel1'],
				'tel2' => $_POST['tel2'],
				'tel3' => $_POST['tel3'],
				'tipo_doc' => $_POST['tipo_doc'],
				'doc' => $_POST['doc'],
				'rg' => $_POST['rg'],
				'oe' => $_POST['oe'],
				'nacio' => $_POST['nacio'],
				'natur' => $_POST['natur'],
				'est_civ' => $_POST['est_civ'],
				'escol' => $_POST['escol'],
				'data_nasc' => $_POST['data_nasc'],
				'situacao' => $_POST['situacao'],
				'data_falec' => $_POST['data_falec'],
				'email_pess' => $_POST['email_pess'],
				'sexo' => $_POST['sexo'],
				'email_bol' => $_POST['email_bol'],
				'email_adic' => $_POST['email_adic'],
				'trat_pess' => $_POST['trat_pess'],
				'socio_cons' => $_POST['socio_cons'],
				'data_vinc' => $_POST['data_vinc'],
				'data_ret_sit' => $_POST['data_ret_sit'],
				'sit_ret' => $_POST['sit_ret'],
				'quadro' => $_POST['quadro'],
				'matr_opc' => $_POST['matr_opc'],
				'data_desl' => $_POST['data_desl'],
				'termo' => $_POST['termo'],
				'obs' => $_POST['obs'],			
				'id_pessoa' => $_POST['id_pessoaDadosAdic']
			);
						
			$param = "?action=insert_pessoasDadosAdic";

			echo saveController::add( $form_data, $param, $url_api );
			break;

		case 'update_pessoasDadosAdic':
			
			$form_data = array(
				'end_cep' => $_POST['end_cep'],
				'end_logr' => $_POST['end_logr'],
				'end_num' => $_POST['end_num'],
				'end_bair' => $_POST['end_bair'],
				'end_ref' => $_POST['end_ref'],
				'end_cid' => $_POST['end_cid'],
				'end_est' => $_POST['end_est'],
				'tel1' => $_POST['tel1'],
				'tel2' => $_POST['tel2'],
				'tel3' => $_POST['tel3'],
				'tipo_doc' => $_POST['tipo_doc'],
				'doc' => $_POST['doc'],
				'rg' => $_POST['rg'],
				'oe' => $_POST['oe'],
				'nacio' => $_POST['nacio'],
				'natur' => $_POST['natur'],
				'est_civ' => $_POST['est_civ'],
				'escol' => $_POST['escol'],
				'data_nasc' => $_POST['data_nasc'],
				'situacao' => $_POST['situacao'],
				'data_falec' => $_POST['data_falec'],
				'email_pess' => $_POST['email_pess'],
				'sexo' => $_POST['sexo'],
				'email_bol' => $_POST['email_bol'],
				'email_adic' => $_POST['email_adic'],
				'trat_pess' => $_POST['trat_pess'],
				'socio_cons' => $_POST['socio_cons'],
				'data_vinc' => $_POST['data_vinc'],
				'data_ret_sit' => $_POST['data_ret_sit'],
				'sit_ret' => $_POST['sit_ret'],
				'quadro' => $_POST['quadro'],
				'matr_opc' => $_POST['matr_opc'],
				'data_desl' => $_POST['data_desl'],
				'termo' => $_POST['termo'],
				'obs' => $_POST['obs'],

				'id_pessoa' => $_POST['id_pessoaDadosAdic'],
				'id' => $_POST['id_dadosAdic']
			);
						
			$param = "?action=update_pessoasDadosAdic";				

			echo saveController::update( $form_data, $param, $url_api );
			break;
		
		case 'pessoasDadosAdic_one':
			$id = $_POST["id"];	
			$param = "?action=pessoasDadosAdic_one&id=".$id."";		

			echo saveController::getOne( $id, $param, $url_api );
			break;

		case 'docPessoasDadosAdic_one':
			$doc = $_POST["doc"];	
			$param = "?action=docPessoasDadosAdic_one&doc=".$doc."";		
	
			echo saveController::getOne( $doc, $param, $url_api );		
			break;

		case 'emailPessoasDadosAdic_one':
			$emailPess = $_POST["email_pess"];	
			$param = "?action=emailPessoasDadosAdic_one&email_pess=".$emailPess."";		

			echo saveController::getOne( $emailPess, $param, $url_api );		
			break;

	}

}

?>