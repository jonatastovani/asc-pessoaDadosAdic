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
	
	public function getUnicoCadastroByPessoasDadosAdic(int $id=null, string $idpessoa, string $doc, string $email):int{
		$con = $this->getConn();

		$and_id = null;
		
		if ($id!=null) {
			$id = preg_replace('/\D/', '', $id);

			if ($id) {
				$escapeId = mysqli_real_escape_string($con, $id);
				$and_id = " and id != $escapeId ";
			}
		}
		
		$escapeIdPessoa = mysqli_real_escape_string($con, $idpessoa);
		$escapeDoc = mysqli_real_escape_string($con, $doc);
		$escapeEmail = mysqli_real_escape_string($con, $email);

		$query = "select id from pessoa_dados_pessoais where (id_pessoa='$escapeIdPessoa' or doc='$escapeDoc' or email_pess='$escapeEmail') $and_id ";

		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function retornaIdDadosPessoaisExistente(int $idpessoa):int{
		$con = $this->getConn();

		$idretorno = 0;

		$escapeId = mysqli_real_escape_string($con, $idpessoa);
		
		$query = "select id from pessoa_dados_pessoais where id_pessoa = $escapeId limit 1";
		
		$res = mysqli_query($con,$query);
		$row = mysqli_fetch_row($res);

		
		if ($row!=null) {
			$idretorno = $row[0];
		}
		
		return $idretorno;
	}

	public function insertPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):array{		

		$con = $this->getConn();		

		if ($this->getUnicoCadastroByPessoasDadosAdic(null,$PessoasDadosAdic->getIdPessoa(),$PessoasDadosAdic->getDoc(),$PessoasDadosAdic->getEmailPess())==0) {

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
			$escapeDataNasc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataNasc());
			$escapeSituacao = mysqli_real_escape_string($con, $PessoasDadosAdic->getSituacao());
			$escapeDataFalec = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataFalec());
			$escapeEmailPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailPess());
			$escapeSexo = mysqli_real_escape_string($con, $PessoasDadosAdic->getSexo());
			$escapeEmailBol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailBol());
			$escapeEmailAdic = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailAdic());
			$escapeTratPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getTratPess());
			$escapeSocioCons = mysqli_real_escape_string($con, $PessoasDadosAdic->getSocioCons());
			$escapeDataVinc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataVinc());
			$escapeDataRetSit = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataRetSit());
			$escapeSitRet = mysqli_real_escape_string($con, $PessoasDadosAdic->getSitRet());
			$escapeQuadro = mysqli_real_escape_string($con, $PessoasDadosAdic->getQuadro());
			$escapeMatrOpc = mysqli_real_escape_string($con, $PessoasDadosAdic->getMatrOpc());
			$escapeDataDesl = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataDesl());
			$escapeTermo = mysqli_real_escape_string($con, $PessoasDadosAdic->getTermo());
			$escapeObs = mysqli_real_escape_string($con, $PessoasDadosAdic->getObs());
			$escapeDataCadastro = mysqli_real_escape_string($con, $DT->format("Y-m-d H:i:s"));

			$query = "INSERT INTO pessoa_dados_pessoais (id_pessoa, end_cep, end_logr, end_num, end_bair, end_ref, end_cid, end_est, tel1, tel2, tel3, tipo_doc, doc, rg, oe, nacio, natur, est_civ, escol, data_nasc, situacao, data_falec, email_pess, sexo, email_bol, email_adic, trat_pess, socio_cons, data_vinc, data_ret_sit, sit_ret, quadro, matr_opc, data_desl, termo, obs, data_cadastro) VALUES (
			'$escapeIdPessoa', '$escapeEndCep', '$escapeEndLogr', '$escapeEndNum', '$escapeEndBair', '$escapeEndRef', '$escapeEndCid', '$escapeEndEst', '$escapeTel1', '$escapeTel2', '$escapeTel3', '$escapeTipoDoc', '$escapeDoc', '$escapeRg', '$escapeOe', '$escapeNacio', '$escapeNatur', '$escapeEstCiv', '$escapeEscol', '$escapeDataNasc', '$escapeSituacao', '$escapeDataFalec', '$escapeEmailPess', '$escapeSexo', '$escapeEmailBol', '$escapeEmailAdic', '$escapeTratPess', '$escapeSocioCons', '$escapeDataVinc', '$escapeDataRetSit', '$escapeSitRet', '$escapeQuadro', '$escapeMatrOpc', '$escapeDataDesl', '$escapeTermo', '$escapeObs', '$escapeDataCadastro')";
					
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
			
		}else{
			$data[] = array(
				'success' => '2'
			);		
		}		

		return $data;
		
	}

	public function alterPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):array{		

		$con = $this->getConn();		

		if ($this->getUnicoCadastroByPessoasDadosAdic($PessoasDadosAdic->getId(),$PessoasDadosAdic->getIdPessoa(),$PessoasDadosAdic->getDoc(),$PessoasDadosAdic->getEmailPess())==0) {

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
			$escapeDataNasc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataNasc());
			$escapeSituacao = mysqli_real_escape_string($con, $PessoasDadosAdic->getSituacao());
			$escapeDataFalec = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataFalec());
			$escapeEmailPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailPess());
			$escapeSexo = mysqli_real_escape_string($con, $PessoasDadosAdic->getSexo());
			$escapeEmailBol = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailBol());
			$escapeEmailAdic = mysqli_real_escape_string($con, $PessoasDadosAdic->getEmailAdic());
			$escapeTratPess = mysqli_real_escape_string($con, $PessoasDadosAdic->getTratPess());
			$escapeSocioCons = mysqli_real_escape_string($con, $PessoasDadosAdic->getSocioCons());
			$escapeDataVinc = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataVinc());
			$escapeDataRetSit = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataRetSit());
			$escapeSitRet = mysqli_real_escape_string($con, $PessoasDadosAdic->getSitRet());
			$escapeQuadro = mysqli_real_escape_string($con, $PessoasDadosAdic->getQuadro());
			$escapeMatrOpc = mysqli_real_escape_string($con, $PessoasDadosAdic->getMatrOpc());
			$escapeDataDesl = mysqli_real_escape_string($con, $PessoasDadosAdic->getDataDesl());
			$escapeTermo = mysqli_real_escape_string($con, $PessoasDadosAdic->getTermo());
			$escapeObs = mysqli_real_escape_string($con, $PessoasDadosAdic->getObs());
			$escapeDataAtualizacao = mysqli_real_escape_string($con, $DT->format("Y-m-d H:i:s"));

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
				data_atualizacao='$escapeDataAtualizacao'
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

		}else{
			$data[] = array(
				'success' => '2'
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
			
			$pessoasDadosAdic[] = array();
			
			if (mysqli_query($con,$query)) {
				while($row=mysqli_fetch_assoc($res)) 
				{
					$pessoasDadosAdic[0]['id'] = $row['id'];
					$pessoasDadosAdic[0]['id_pessoa'] = $row['id_pessoa'];
					$pessoasDadosAdic[0]['end_cep'] = $row['end_cep'];
					$pessoasDadosAdic[0]['end_logr'] = $row['end_logr'];
					$pessoasDadosAdic[0]['end_num'] = $row['end_num'];
					$pessoasDadosAdic[0]['end_bair'] = $row['end_bair'];
					$pessoasDadosAdic[0]['end_ref'] = $row['end_ref'];
					$pessoasDadosAdic[0]['end_cid'] = $row['end_cid'];
					$pessoasDadosAdic[0]['end_est'] = $row['end_est'];
					$pessoasDadosAdic[0]['tel1'] = $row['tel1'];
					$pessoasDadosAdic[0]['tel2'] = $row['tel2'];
					$pessoasDadosAdic[0]['tel3'] = $row['tel3'];
					$pessoasDadosAdic[0]['tipo_doc'] = $row['tipo_doc'];
					$pessoasDadosAdic[0]['doc'] = $row['doc'];
					$pessoasDadosAdic[0]['rg'] = $row['rg'];
					$pessoasDadosAdic[0]['oe'] = $row['oe'];
					$pessoasDadosAdic[0]['nacio'] = $row['nacio'];
					$pessoasDadosAdic[0]['natur'] = $row['natur'];
					$pessoasDadosAdic[0]['est_civ'] = $row['est_civ'];
					$pessoasDadosAdic[0]['escol'] = $row['escol'];
					$pessoasDadosAdic[0]['data_nasc'] = $row['data_nasc'];
					$pessoasDadosAdic[0]['situacao'] = $row['situacao'];
					$pessoasDadosAdic[0]['data_falec'] = $row['data_falec'];
					$pessoasDadosAdic[0]['email_pess'] = $row['email_pess'];
					$pessoasDadosAdic[0]['sexo'] = $row['sexo'];
					$pessoasDadosAdic[0]['email_bol'] = $row['email_bol'];
					$pessoasDadosAdic[0]['email_adic'] = $row['email_adic'];
					$pessoasDadosAdic[0]['trat_pess'] = $row['trat_pess'];
					$pessoasDadosAdic[0]['socio_cons'] = $row['socio_cons'];
					$pessoasDadosAdic[0]['data_vinc'] = $row['data_vinc'];
					$pessoasDadosAdic[0]['data_ret_sit'] = $row['data_ret_sit'];
					$pessoasDadosAdic[0]['sit_ret'] = $row['sit_ret'];
					$pessoasDadosAdic[0]['quadro'] = $row['quadro'];
					$pessoasDadosAdic[0]['matr_opc'] = $row['matr_opc'];
					$pessoasDadosAdic[0]['data_desl'] = $row['data_desl'];
					$pessoasDadosAdic[0]['termo'] = $row['termo'];
					$pessoasDadosAdic[0]['obs'] = $row['obs'];
					$pessoasDadosAdic[0]['data_cadastro'] = $row['data_cadastro'];
					$pessoasDadosAdic[0]['data_atualizacao'] = $row['data_atualizacao'];
				}		
				
				return $pessoasDadosAdic;		
			}
	
		}else{
			$data[] = array(
				'success' => '2'
			);

			return $data;		
		}

	}

	public function docPessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):array {

		$con = $this->getConn();
		
		$doc = $PessoasDadosAdic->getDoc();

		if ($doc!='') {
			
			$escapeDoc = mysqli_real_escape_string($con, $doc);

			$query = "select * from pessoa_dados_pessoais where doc='$escapeDoc'";
	
			$res = mysqli_query($con,$query);
			
			$pessoasDadosAdic = [];
			
			if (mysqli_query($con,$query)) {
				while($row=mysqli_fetch_assoc($res)) 
				{
					$pessoasDadosAdic[0]['id'] = $row['id'];
					$pessoasDadosAdic[0]['id_pessoa'] = $row['id_pessoa'];
					$pessoasDadosAdic[0]['tipo_doc'] = $row['tipo_doc'];
					$pessoasDadosAdic[0]['doc'] = $row['doc'];
					$pessoasDadosAdic[0]['data_nasc'] = $row['data_nasc'];
					$pessoasDadosAdic[0]['data_falec'] = $row['data_falec'];
					$pessoasDadosAdic[0]['email_pess'] = $row['email_pess'];
				}		
				
				return $pessoasDadosAdic;		
			}
	
		}else{
			$data[] = array(
				'success' => '2'
			);

			return $data;		
		}

	}

	public function idPessoaPessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):array {

		$con = $this->getConn();
		
		$idpessoa = $PessoasDadosAdic->getIdPessoa();

		if ($idpessoa>0) {
			
			$escapeIdPessoa = mysqli_real_escape_string($con, $idpessoa);

			$query = "select * from pessoa_dados_pessoais where id_pessoa='$escapeIdPessoa'";

			$res = mysqli_query($con,$query);
			
			$pessoasDadosAdic = [];
			
			if (mysqli_query($con,$query)) {
				while($row=mysqli_fetch_assoc($res)) 
				{
					$pessoasDadosAdic[0]['id'] = $row['id'];
					$pessoasDadosAdic[0]['id_pessoa'] = $row['id_pessoa'];
					$pessoasDadosAdic[0]['tipo_doc'] = $row['tipo_doc'];
					$pessoasDadosAdic[0]['doc'] = $row['doc'];
					$pessoasDadosAdic[0]['data_nasc'] = $row['data_nasc'];
					$pessoasDadosAdic[0]['data_falec'] = $row['data_falec'];
					$pessoasDadosAdic[0]['email_pess'] = $row['email_pess'];
				}		
				
				return $pessoasDadosAdic;		
			}
	
		}else{
			$data[] = array(
				'success' => '2'
			);

			return $data;		
		}

	}

	public function emailPessPessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):array {

		$con = $this->getConn();
		
		$emailPess = $PessoasDadosAdic->getEmailPess();

		if ($emailPess!='') {
			
			$escapeEmailPess = mysqli_real_escape_string($con, $emailPess);

			$query = "select * from pessoa_dados_pessoais where email_pess='$escapeEmailPess'";
	
			$res = mysqli_query($con,$query);
			
			$pessoasDadosAdic = [];
			
			if (mysqli_query($con,$query)) {
				while($row=mysqli_fetch_assoc($res)) 
				{
					$pessoasDadosAdic[0]['id'] = $row['id'];
					$pessoasDadosAdic[0]['id_pessoa'] = $row['id_pessoa'];
					$pessoasDadosAdic[0]['tipo_doc'] = $row['tipo_doc'];
					$pessoasDadosAdic[0]['doc'] = $row['doc'];
					$pessoasDadosAdic[0]['data_nasc'] = $row['data_nasc'];
					$pessoasDadosAdic[0]['data_falec'] = $row['data_falec'];
					$pessoasDadosAdic[0]['email_pess'] = $row['email_pess'];
				}		
				
				return $pessoasDadosAdic;		
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
		$query = "SELECT pc.id, pc.categ, pc.matric, pc.matric_dig, pc.titulo, pc.data_admissao, pc.nome, pc.abrev, pc.link_erp, pc.data_cadastro, pc.data_atualizacao, pc.sit_titulo
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