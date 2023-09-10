<?php

class PessoasCadastros {
	
	private $id;
	private $data_cadastro;	
	private $data_atualizado;	
	
	public function __contruct() 
	{
		
	}
	
	public function setId($id):void {		
		$this->id = $id;		
	}
	
	public function getId():int {		
		return $this->id;
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