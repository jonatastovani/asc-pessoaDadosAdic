<?php

class PessoasDadosAdic {
    private $id;
    private $idpessoa;
    private $end_cep;
    private $end_logr;
    private $end_num;
    private $end_bair;
    private $end_ref;
    private $end_cid;
    private $end_est;
    private $tel1;
    private $tel2;
    private $tel3;
    private $tipo_doc;
    private $doc;
    private $rg;
    private $oe;
    private $nacio;
    private $natur;
    private $est_civ;
    private $escol;
    private $data_nasc;
    private $situacao;
    private $data_falec;
    private $email_pess;
    private $sexo;
    private $email_bol;
    private $email_adic;
    private $trat_pess;
    private $socio_cons;
    private $data_vinc;
    private $data_ret_sit;
    private $sit_ret;
    private $quadro;
    private $matr_opc;
    private $data_desl;
    private $termo;
    private $obs;
    private $data_cadastro;
    private $data_atualizado;

    public function __contruct() {}

    public function getId(): int {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getIdPessoa(): int {
        return $this->idpessoa;
    }

    public function setIdPessoa($idpessoa): void {
        $this->idpessoa = $idpessoa;
    }

    public function getEndCep(): string {
        return $this->end_cep;
    }

    public function setEndCep($end_cep): void {
        $this->end_cep = $end_cep;
    }

    public function getEndLogr(): string {
        return $this->end_logr;
    }

    public function setEndLogr($end_logr): void {
        $this->end_logr = $end_logr;
    }

    public function getEndNum(): string {
        return $this->end_num;
    }

    public function setEndNum($end_num): void {
        $this->end_num = $end_num;
    }

    public function getEndBair(): string {
        return $this->end_bair;
    }

    public function setEndBair($end_bair): void {
        $this->end_bair = $end_bair;
    }

    public function getEndRef(): ?string {
        return $this->end_ref;
    }

    public function setEndRef($end_ref): void {
        $this->end_ref = $end_ref;
    }

    public function getEndCid(): string {
        return $this->end_cid;
    }

    public function setEndCid($end_cid): void {
        $this->end_cid = $end_cid;
    }

    public function getEndEst(): string {
        return $this->end_est;
    }

    public function setEndEst($end_est): void {
        $this->end_est = $end_est;
    }

    public function getTel1(): ?string {
        return $this->tel1;
    }

    public function setTel1($tel1): void {
        $this->tel1 = $tel1;
    }

    public function getTel2(): ?string {
        return $this->tel2;
    }

    public function setTel2($tel2): void {
        $this->tel2 = $tel2;
    }

    public function getTel3(): ?string {
        return $this->tel3;
    }

    public function setTel3($tel3): void {
        $this->tel3 = $tel3;
    }

    public function getTipoDoc(): ?string {
        return $this->tipo_doc;
    }

    public function setTipoDoc($tipo_doc): void {
        $this->tipo_doc = $tipo_doc;
    }

    public function getDoc(): ?string {
        return $this->doc;
    }

    public function setDoc($doc): void {
        $this->doc = $doc;
    }

    public function getRg(): ?string {
        return $this->rg;
    }

    public function setRg($rg): void {
        $this->rg = $rg;
    }

    public function getOe(): ?string {
        return $this->oe;
    }

    public function setOe($oe): void {
        $this->oe = $oe;
    }

    public function getNacio(): ?string {
        return $this->nacio;
    }

    public function setNacio($nacio): void {
        $this->nacio = $nacio;
    }

    public function getNatur(): ?string {
        return $this->natur;
    }

    public function setNatur($natur): void {
        $this->natur = $natur;
    }

    public function getEstCiv(): ?string {
        return $this->est_civ;
    }

    public function setEstCiv($est_civ): void {
        $this->est_civ = $est_civ;
    }

    public function getEscol(): ?string {
        return $this->escol;
    }

    public function setEscol($escol): void {
        $this->escol = $escol;
    }

    public function getDataNasc(): ?DateTimeInterface {
        return $this->data_nasc;
    }

    public function setDataNasc($data_nasc): void {
        $this->data_nasc = $data_nasc;
    }

    public function getSituacao(): ?string {
        return $this->situacao;
    }

    public function setSituacao($situacao): void {
        $this->situacao = $situacao;
    }

    public function getDataFalec(): ?DateTimeInterface {
        return $this->data_falec;
    }

    public function setDataFalec($data_falec): void {
        $this->data_falec = $data_falec;
    }

    public function getEmailPess(): ?string {
        return $this->email_pess;
    }

    public function setEmailPess($email_pess): void {
        $this->email_pess = $email_pess;
    }

    public function getSexo(): ?string {
        return $this->sexo;
    }

    public function setSexo($sexo): void {
        $this->sexo = $sexo;
    }

    public function getEmailBol(): ?string {
        return $this->email_bol;
    }

    public function setEmailBol($email_bol): void {
        $this->email_bol = $email_bol;
    }

    public function getEmailAdic(): ?string {
        return $this->email_adic;
    }

    public function setEmailAdic($email_adic): void {
        $this->email_adic = $email_adic;
    }

    public function getTratPess(): ?string {
        return $this->trat_pess;
    }

    public function setTratPess($trat_pess): void {
        $this->trat_pess = $trat_pess;
    }

    public function getSocioCons(): ?string {
        return $this->socio_cons;
    }

    public function setSocioCons($socio_cons): void {
        $this->socio_cons = $socio_cons;
    }

    public function getDataVinc(): ?DateTimeInterface {
        return $this->data_vinc;
    }

    public function setDataVinc($data_vinc): void {
        $this->data_vinc = $data_vinc;
    }

    public function getDataRetSit(): ?DateTimeInterface {
        return $this->data_ret_sit;
    }

    public function setDataRetSit($data_ret_sit): void {
        $this->data_ret_sit = $data_ret_sit;
    }

    public function getSitRet(): ?string {
        return $this->sit_ret;
    }

    public function setSitRet($sit_ret): void {
        $this->sit_ret = $sit_ret;
    }

    public function getQuadro(): ?string {
        return $this->quadro;
    }

    public function setQuadro($quadro): void {
        $this->quadro = $quadro;
    }

    public function getMatrOpc(): ?int {
        return $this->matr_opc;
    }

    public function setMatrOpc($matr_opc): void {
        $this->matr_opc = $matr_opc;
    }

    public function getDataDesl(): ?DateTimeInterface {
        return $this->data_desl;
    }

    public function setDataDesl($data_desl): void {
        $this->data_desl = $data_desl;
    }

    public function getTermo(): ?string {
        return $this->termo;
    }

    public function setTermo($termo): void {
        $this->termo = $termo;
    }

    public function getObs(): ?string {
        return $this->obs;
    }

    public function setObs($obs): void {
        $this->obs = $obs;
    }
		
	public function setDatacadastro($data_cadastro):void {
		$this->data_cadastro = $data_cadastro;
	}
	
	public function getDatacadastro():DateTimeInterface {
		return $this->data_cadastro;		
	}
	
	public function setDataatualizado($data_atualizado):void {
		$this->data_atualizado = $data_atualizado;
	}
	
	public function getDataatualizado():DateTimeInterface {
		return $this->data_atualizado;		
	}

}