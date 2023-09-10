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
			
			$id = $_POST['id'];
			$param = "?action=get_header_pessoasCad&id=$id";				

			echo saveController::getOne( $id, $param, $url_api );
			break;
		
	}

}

?>