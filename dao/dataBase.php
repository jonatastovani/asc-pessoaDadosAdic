<?php

require_once ( "../models/PessoasDadosAdic.php" );
require_once ( "../models/Email.php" );

class dataBase {
	
	private $host;
	private $user;
	private $pass;
	private $bd;
	private $con;	

	private $table;

	public function __construct( 	string $host, 
									string $user, 
									string $password, 
									string $dbname ) {
	
		$this->host = $host;
		$this->user = $user;
		$this->pass = $password;
		$this->bd = $dbname;		
		
	}	
	
	public function getConn() {
		return $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
	}
	
	public function retornaIdDadosPessoaisExistente(int $idpessoa):int{
		$con = $this->getConn();

		$idretorno = 0;

		$escapeId = mysqli_real_escape_string($con, $idpessoa);
		
		$query = "select id from pessoa_dados_pessoais where id_pessoa = $escapeId limit 1";
		
		$res = mysqli_query($con,$query);
		$row = mysqli_fetch_row($res);

		
		if ($row!=null) {
			$idretorno = $row['id'];
		}
		
		return $idretorno;
	}

	public function insertPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):array{		

		$con = $this->getConn();		

		$DT = new DateTime();

		$escapeIdPessoa = mysqli_real_escape_string($con, $PessoasDadosAdic->getIdPessoa());
		$escapeEndCep = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndCep());
		$escapeEndLogr = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndLogr());
		$escapeEndNum = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndNum());
		$escapeEndBair = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndBair());
		$escapeEndRef = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndRef());
		$escapeEndCid = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndCid());
		$escapeEndEst = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndEst());
		$escapeTel1 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel1());
		$escapeTel2 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel2());
		$escapeTel3 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel3());
		$escapeTipoDoc = mysqli_real_escape_string($con, $PessoasDadosAdic->getTipoDoc());
		$escapeDoc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDoc());
		$escapeRg = mysqli_real_escape_string($con, $PessoasDadosAdic->getRg());
		$escapeOe = mysqli_real_escape_string($con, $PessoasDadosAdic->getOe());
		$escapeNacio = mysqli_real_escape_string($con, $PessoasDadosAdic->getNacio());
		$escapeNatur = mysqli_real_escape_string($con, $PessoasDadosAdic->getNatur());
		$escapeEstCiv = mysqli_real_escape_string($con, $PessoasDadosAdic->getEstCiv());
		$escapeEscol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEscol());
		$escapeDataNasc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataNasc()->format("Y-m-d H:i:s"));
		$escapeSituacao = mysqli_real_escape_string($con, $PessoasDadosAdic->getSituacao());
		$escapeDataFalec = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataFalec()->format("Y-m-d H:i:s"));
		$escapeEmailPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailPess());
		$escapeSexo = mysqli_real_escape_string($con, $PessoasDadosAdic->getSexo());
		$escapeEmailBol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailBol());
		$escapeEmailAdic = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailAdic());
		$escapeTratPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getTratPess());
		$escapeSocioCons = mysqli_real_escape_string($con, $PessoasDadosAdic->getSocioCons());
		$escapeDataVinc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataVinc()->format("Y-m-d H:i:s"));
		$escapeDataRetSit = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataRetSit()->format("Y-m-d H:i:s"));
		$escapeSitRet = mysqli_real_escape_string($con, $PessoasDadosAdic->getSitRet());
		$escapeQuadro = mysqli_real_escape_string($con, $PessoasDadosAdic->getQuadro());
		$escapeMatrOpc = mysqli_real_escape_string($con, $PessoasDadosAdic->getMatrOpc());
		$escapeDataDesl = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataDesl()->format("Y-m-d H:i:s"));
		$escapeTermo = mysqli_real_escape_string($con, $PessoasDadosAdic->getTermo());
		$escapeObs = mysqli_real_escape_string($con, $PessoasDadosAdic->getObs());
		$escapeDataCadastro = mysqli_real_escape_string($con, $DT->format("Y-m-d H:i:s"));

		$query = "INSERT INTO pessoa_dados_pessoais (id_pessoa, end_cep, end_logr, end_num, end_bair, end_ref, end_cid, end_est, tel1, tel2, tel3, tipo_doc, doc, rg, oe, nacio, natur, est_civ, escol, data_nasc, situacao, data_falec, email_pess, sexo, email_bol, email_adic, trat_pess, socio_cons, data_vinc, data_ret_sit, sit_ret, quadro, matr_opc, data_desl, termo, obs, data_cadastro) VALUES (
		'$escapeIdPessoa', '$escapeEndCep', '$escapeEndLogr', '$escapeEndNum', '$escapeEndBair', '$escapeEndRef', '$escapeEndCid', '$escapeEndEst', '$escapeTel1', '$escapeTel2', '$escapeTel3', '$escapeTipoDoc', '$escapeDoc', '$escapeRg', '$escapeOe', '$escapeNacio', '$escapeNatur', '$escapeEstCiv', '$escapeEscol', '$escapeDataNasc', '$escapeSituacao', '$escapeDataFalec', '$escapeEmailPess', '$escapeSexo', '$escapeEmailBol', '$escapeEmailAdic', '$escapeTratPess', '$escapeSocioCons', '$escapeDataVinc', '$escapeDataRetSit', '$escapeSitRet', '$escapeQuadro', '$escapeMatrOpc', '$escapeDataDesl', '$escapeTermo', '$escapeObs', '$escapeDataCadastro', '$escapeDataCadastro')";
		
		if (mysqli_query($con,$query)) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
	
		return $data;
		
	}

	public function alterPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):array{		

		$con = $this->getConn();		

		$DT = new DateTime();

		$escapeId = mysqli_real_escape_string($con, $PessoasDadosAdic->getId());
		$escapeEndCep = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndCep());
		$escapeEndLogr = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndLogr());
		$escapeEndNum = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndNum());
		$escapeEndBair = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndBair());
		$escapeEndRef = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndRef());
		$escapeEndCid = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndCid());
		$escapeEndEst = mysqli_real_escape_string($con, $PessoasDadosAdic->getEndEst());
		$escapeTel1 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel1());
		$escapeTel2 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel2());
		$escapeTel3 = mysqli_real_escape_string($con, $PessoasDadosAdic->getTel3());
		$escapeTipoDoc = mysqli_real_escape_string($con, $PessoasDadosAdic->getTipoDoc());
		$escapeDoc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDoc());
		$escapeRg = mysqli_real_escape_string($con, $PessoasDadosAdic->getRg());
		$escapeOe = mysqli_real_escape_string($con, $PessoasDadosAdic->getOe());
		$escapeNacio = mysqli_real_escape_string($con, $PessoasDadosAdic->getNacio());
		$escapeNatur = mysqli_real_escape_string($con, $PessoasDadosAdic->getNatur());
		$escapeEstCiv = mysqli_real_escape_string($con, $PessoasDadosAdic->getEstCiv());
		$escapeEscol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEscol());
		$escapeDataNasc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataNasc()->format("Y-m-d H:i:s"));
		$escapeSituacao = mysqli_real_escape_string($con, $PessoasDadosAdic->getSituacao());
		$escapeDataFalec = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataFalec()->format("Y-m-d H:i:s"));
		$escapeEmailPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailPess());
		$escapeSexo = mysqli_real_escape_string($con, $PessoasDadosAdic->getSexo());
		$escapeEmailBol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailBol());
		$escapeEmailAdic = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailAdic());
		$escapeTratPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getTratPess());
		$escapeSocioCons = mysqli_real_escape_string($con, $PessoasDadosAdic->getSocioCons());
		$escapeDataVinc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataVinc()->format("Y-m-d H:i:s"));
		$escapeDataRetSit = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataRetSit()->format("Y-m-d H:i:s"));
		$escapeSitRet = mysqli_real_escape_string($con, $PessoasDadosAdic->getSitRet());
		$escapeQuadro = mysqli_real_escape_string($con, $PessoasDadosAdic->getQuadro());
		$escapeMatrOpc = mysqli_real_escape_string($con, $PessoasDadosAdic->getMatrOpc());
		$escapeDataDesl = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataDesl()->format("Y-m-d H:i:s"));
		$escapeTermo = mysqli_real_escape_string($con, $PessoasDadosAdic->getTermo());
		$escapeObs = mysqli_real_escape_string($con, $PessoasDadosAdic->getObs());
		$escapeDataAtualizado = mysqli_real_escape_string($con, $DT->format("Y-m-d H:i:s"));

		$query = "UPDATE pessoa_dados_pessoais SET 
			end_cep='$escapeEndCep',
			end_logr='$escapeEndLogr',
			end_num='$escapeEndNum',
			end_bair='$escapeEndBair',
			end_ref='$escapeEndRef',
			end_cid='$escapeEndCid',
			end_est='$escapeEndEst',
			tel1='$escapeTel1',
			tel2='$escapeTel2',
			tel3='$escapeTel3',
			tipo_doc='$escapeTipoDoc',
			doc='$escapeDoc',
			rg='$escapeRg',
			oe='$escapeOe',
			nacio='$escapeNacio',
			natur='$escapeNatur',
			est_civ='$escapeEstCiv',
			escol='$escapeEscol',
			data_nasc='$escapeDataNasc',
			situacao='$escapeSituacao',
			data_falec='$escapeDataFalec',
			email_pess='$escapeEmailPess',
			sexo='$escapeSexo',
			email_bol='$escapeEmailBol',
			email_adic='$escapeEmailAdic',
			trat_pess='$escapeTratPess',
			socio_cons='$escapeSocioCons',
			data_vinc='$escapeDataVinc',
			data_ret_sit='$escapeDataRetSit',
			sit_ret='$escapeSitRet',
			quadro='$escapeQuadro',
			matr_opc='$escapeMatrOpc',
			data_desl='$escapeDataDesl',
			termo='$escapeTermo',
			obs='$escapeObs',
			data_atualizado='$escapeDataAtualizado'
			WHERE id='$escapeId'";


		if (mysqli_query($con,$query)) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
	
		return $data;
		
	}

	public function PessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):array {

		$con = $this->getConn();
		
		$id = $this->retornaIdDadosPessoaisExistente($PessoasDadosAdic->getIdPessoa());

		if ($id>0) {
			
			$escapeId = mysqli_real_escape_string($con, $id);

			$query = "select * from pessoa_dados_pessoais where id=$escapeId";
	
			$res = mysqli_query($con,$query);
			
			$pessoasFisicas = array();
			
			if (mysqli_query($con,$query)) {
				while($row=mysqli_fetch_assoc($res)) 
				{
					$pessoasFisicas['id'] = $row['id'];
					$pessoasFisicas['id_pessoa'] = $row['id_pessoa'];
					$pessoasFisicas['end_cep'] = $row['end_cep'];
					$pessoasFisicas['end_logr'] = $row['end_logr'];
					$pessoasFisicas['end_num'] = $row['end_num'];
					$pessoasFisicas['end_bair'] = $row['end_bair'];
					$pessoasFisicas['end_ref'] = $row['end_ref'];
					$pessoasFisicas['end_cid'] = $row['end_cid'];
					$pessoasFisicas['end_est'] = $row['end_est'];
					$pessoasFisicas['tel1'] = $row['tel1'];
					$pessoasFisicas['tel2'] = $row['tel2'];
					$pessoasFisicas['tel3'] = $row['tel3'];
					$pessoasFisicas['tipo_doc'] = $row['tipo_doc'];
					$pessoasFisicas['doc'] = $row['doc'];
					$pessoasFisicas['rg'] = $row['rg'];
					$pessoasFisicas['oe'] = $row['oe'];
					$pessoasFisicas['nacio'] = $row['nacio'];
					$pessoasFisicas['natur'] = $row['natur'];
					$pessoasFisicas['est_civ'] = $row['est_civ'];
					$pessoasFisicas['escol'] = $row['escol'];
					$pessoasFisicas['data_nasc'] = $row['data_nasc'];
					$pessoasFisicas['situacao'] = $row['situacao'];
					$pessoasFisicas['data_falec'] = $row['data_falec'];
					$pessoasFisicas['email_pess'] = $row['email_pess'];
					$pessoasFisicas['sexo'] = $row['sexo'];
					$pessoasFisicas['email_bol'] = $row['email_bol'];
					$pessoasFisicas['email_adic'] = $row['email_adic'];
					$pessoasFisicas['trat_pess'] = $row['trat_pess'];
					$pessoasFisicas['socio_cons'] = $row['socio_cons'];
					$pessoasFisicas['data_vinc'] = $row['data_vinc'];
					$pessoasFisicas['data_ret_sit'] = $row['data_ret_sit'];
					$pessoasFisicas['sit_ret'] = $row['sit_ret'];
					$pessoasFisicas['quadro'] = $row['quadro'];
					$pessoasFisicas['matr_opc'] = $row['matr_opc'];
					$pessoasFisicas['data_desl'] = $row['data_desl'];
					$pessoasFisicas['termo'] = $row['termo'];
					$pessoasFisicas['obs'] = $row['obs'];
					$pessoasFisicas['data_cadastro'] = $row['data_cadastro'];
					$pessoasFisicas['data_atualizacao'] = $row['data_atualizacao'];
				}		
				
				return $pessoasFisicas;		
			}
	
		}else{
			$data[] = array(
				'success' => '2'
			);

			return $data;		
		}

	}

	public function getHeaderPessoasCad(PessoasCadastros $PessoasCadastros):array{
		
		$con = $this->getConn();	
		
		$escapeId = mysqli_real_escape_string($con, $PessoasCadastros->getId());

		$pessoa = array();		
		$query = "SELECT pc.categ, pc.matric, pc.matric_dig, pc.titulo, pc.data_admissao, pc.nome, pc.abrev, pc.link_erp, pc.data_cadastro, pc.data_atualizacao, pc.sit_titulo
		FROM pessoa_cadastro pc
		WHERE pc.id = $escapeId;";
		
		$res = mysqli_query($con,$query);		

		// echo "count ".count(mysqli_fetch_all($res))."\r";
		$result = mysqli_fetch_assoc($res);

		if (count($result)){
			$pessoa[] = $result;

		}else{
			$pessoa[] = array(
				'success' => '2'
			);		
		}
		
		return $pessoa;		
	}

	public function sendEmail( Email $Email ):array{

		$email = $Email->getemail();
		$date = $Email->getDate();
		$subject = $Email->getSubject();
		$total = $Email->getTotal();
		$body = " Day: $date - Total Sales: $total ";
		
		if ($Email->send( $email, $subject, $body )) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
				
		return $data;
	}	
	
}