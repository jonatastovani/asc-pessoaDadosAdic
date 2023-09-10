<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );

require_once ( "../controllers/saveController.php" ); 

if (isset($_POST["action"]))
{
	switch ($_POST["action"]){
		
		case 'get_header_pessoasCad':
			
			$form_data = array(
				'idpessoa' => $_POST['fam1'],
				'telfam1' => $_POST['telfam1'],
				'fam2' => $_POST['fam2'],
				'telfam2' => $_POST['telfam2'],
				'medic' => $_POST['medic'],
				'telmedic' => $_POST['telmedic'],
				'conv' => $_POST['conv'],
				'hosp' => $_POST['hosp'],
				'obs' => $_POST['obs'],

				'id' => $_POST['id_pessoasDadosAdic']	
			);

			$param = "?action=update_pessoasDadosAdic";				

			echo saveController::update( $form_data, $param, $url_api );
			break;
		

		case 'insert_pessoasDadosAdic':
			
			$form_data = array(
				'end_cep' => $_POST['cep'],
				'end_logr' => $_POST['logradouro'],
				'end_num' => $_POST['numero'],
				'end_bair' => $_POST['bairro'],
				'end_ref' => $_POST['complemento'],
				'end_cid' => $_POST['cidade'],
				'end_est' => $_POST['uf'],
				'tel1' => $_POST['tel1'],
				'tel2' => $_POST['tel2'],
				'tel3' => $_POST['tel3'],
				'tipo_doc' => $_POST['tipo_doc'],
				'doc' => $_POST['doc'],
				'rg' => $_POST['rg'],
				'oe' => $_POST['oe'],
				'nacio' => $_POST['nacionalidade'],
				'natur' => $_POST['naturalidade'],
				'est_civ' => $_POST['estado_civil'],
				'escol' => $_POST['escolaridade'],
				'data_nasc' => $_POST['data_nasc'],
				'situacao' => $_POST['situacao'],
				'data_falec' => $_POST['data_falec'],
				'email_pess' => $_POST['email_pessoal'],
				'sexo' => $_POST['sexo'],
				'email_bol' => $_POST['email_bol'],
				'email_adic' => $_POST['email_adicional'],
				'trat_pess' => $_POST['tratamento_pessoal'],
				'socio_cons' => $_POST['socio_consultor'],
				'data_vinc' => $_POST['data_vinculo'],
				'data_ret_sit' => $_POST['data_retorno_situacao'],
				'sit_ret' => $_POST['situacao_retorno'],
				'quadro' => $_POST['quadro'],
				'matr_opc' => $_POST['matricula_opcional'],
				'data_desl' => $_POST['data_desligamento'],
				'termo' => $_POST['termo'],
				'obs' => $_POST['observacao']
			);
						
			$param = "?action=insert_pessoasDadosAdic";

			echo saveController::add( $form_data, $param, $url_api );

		case 'update_pessoasDadosAdic':
			
			$form_data = array(
				'end_cep' => $_POST['cep'],
				'end_logr' => $_POST['logradouro'],
				'end_num' => $_POST['numero'],
				'end_bair' => $_POST['bairro'],
				'end_ref' => $_POST['complemento'],
				'end_cid' => $_POST['cidade'],
				'end_est' => $_POST['uf'],
				'tel1' => $_POST['tel1'],
				'tel2' => $_POST['tel2'],
				'tel3' => $_POST['tel3'],
				'tipo_doc' => $_POST['tipo_doc'],
				'doc' => $_POST['doc'],
				'rg' => $_POST['rg'],
				'oe' => $_POST['oe'],
				'nacio' => $_POST['nacionalidade'],
				'natur' => $_POST['naturalidade'],
				'est_civ' => $_POST['estado_civil'],
				'escol' => $_POST['escolaridade'],
				'data_nasc' => $_POST['data_nasc'],
				'situacao' => $_POST['situacao'],
				'data_falec' => $_POST['data_falec'],
				'email_pess' => $_POST['email_pessoal'],
				'sexo' => $_POST['sexo'],
				'email_bol' => $_POST['email_bol'],
				'email_adic' => $_POST['email_adicional'],
				'trat_pess' => $_POST['tratamento_pessoal'],
				'socio_cons' => $_POST['socio_consultor'],
				'data_vinc' => $_POST['data_vinculo'],
				'data_ret_sit' => $_POST['data_retorno_situacao'],
				'sit_ret' => $_POST['situacao_retorno'],
				'quadro' => $_POST['quadro'],
				'matr_opc' => $_POST['matricula_opcional'],
				'data_desl' => $_POST['data_desligamento'],
				'termo' => $_POST['termo'],
				'obs' => $_POST['observacao'],

				'id_pessoa' => $_POST['id_pessoaDadosAdic'],
				'id' => $_POST['id_pessoaDadosAdic']
			);
						
			$param = "?action=update_pessoasDadosAdic";				

			echo saveController::update( $form_data, $param, $url_api );
			break;
		
		case 'pessoasDadosAdic_one':
			$id = $_POST["id"];	
			$param = "?action=pessoasDadosAdic_one&id=".$id."";		

			echo saveController::getOne( $id, $param, $url_api );
			break;
	}

}

?>