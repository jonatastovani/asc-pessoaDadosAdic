<?php

require_once ( "../models/PessoasDadosAdic.php" );
require_once ( "conexao.php" );

class dataBase {
	
	private $database;

	public function __construct( 	string $host, 
									string $user, 
									string $password, 
									string $dbname ) {

		$this->database = new ConexaoMySQL($host, $user, $password, $dbname);
	}	
	
	public function getUnicoCadastroByPessoasDadosAdic(int $id=null, int $idpessoa, string $doc, string $email):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {
				
				$params = array($idpessoa, $doc, $email);
				
				$and_id = null;
				if ($id!=null) {
					if ($id) {
						$and_id = " and id != ?";
						array_push($params,$id);
					}
				}
				
				$query = 	"SELECT * FROM pessoa_dados_pessoais
							WHERE (id_pessoa = ? OR doc= ? OR email_pess = ?) $and_id;";

                $stmt = $conexao->prepare($query);
				$stmt->execute($params);

                if ($stmt) {
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return new ApiResponse('success', 'Dados recuperados com sucesso.', $retorno);
                } else {
                    return new ApiResponse('error', 'Erro na consulta SQL');
                }
            } else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }

        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function insertPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {
				$DT = new DateTime();

				$consulta = $this->getUnicoCadastroByPessoasDadosAdic(null,$PessoasDadosAdic->getIdPessoa(),$PessoasDadosAdic->getDoc(),$PessoasDadosAdic->getEmailPess());

				if ($consulta->getStatus() == 'success') {

					if (count($consulta->getData()) == 0) {
						
						$DT = new DateTime();

						$params = array(
							$PessoasDadosAdic->getIdPessoa(),
							$PessoasDadosAdic->getEndCep(),
							$PessoasDadosAdic->getEndLogr(),
							$PessoasDadosAdic->getEndNum(),
							$PessoasDadosAdic->getEndBair(),
							$PessoasDadosAdic->getEndRef(),
							$PessoasDadosAdic->getEndCid(),
							$PessoasDadosAdic->getEndEst(),
							$PessoasDadosAdic->getTel1(),
							$PessoasDadosAdic->getTel2(),
							$PessoasDadosAdic->getTel3(),
							$PessoasDadosAdic->getTipoDoc(),
							$PessoasDadosAdic->getDoc(),
							$PessoasDadosAdic->getRg(),
							$PessoasDadosAdic->getOe(),
							$PessoasDadosAdic->getNacio(),
							$PessoasDadosAdic->getNatur(),
							$PessoasDadosAdic->getEstCiv(),
							$PessoasDadosAdic->getEscol(),
							$PessoasDadosAdic->getDataNasc(),
							$PessoasDadosAdic->getSituacao(),
							$PessoasDadosAdic->getDataFalec(),
							$PessoasDadosAdic->getEmailPess(),
							$PessoasDadosAdic->getSexo(),
							$PessoasDadosAdic->getEmailBol(),
							$PessoasDadosAdic->getEmailAdic(),
							$PessoasDadosAdic->getTratPess(),
							$PessoasDadosAdic->getSocioCons(),
							$PessoasDadosAdic->getDataVinc(),
							$PessoasDadosAdic->getDataRetSit(),
							$PessoasDadosAdic->getSitRet(),
							$PessoasDadosAdic->getQuadro(),
							$PessoasDadosAdic->getMatrOpc(),
							$PessoasDadosAdic->getDataDesl(),
							$PessoasDadosAdic->getTermo(),
							$PessoasDadosAdic->getObs(),
							$DT->format("Y-m-d H:i:s")
						);

						$marcadores = implode(', ', array_fill(0, count($params), '?'));

						$query = "INSERT INTO pessoa_dados_pessoais (id_pessoa, end_cep, end_logr, end_num, end_bair, end_ref, end_cid, end_est, tel1, tel2, tel3, tipo_doc, doc, rg, oe, nacio, natur, est_civ, escol, data_nasc, situacao, data_falec, email_pess, sexo, email_bol, email_adic, trat_pess, socio_cons, data_vinc, data_ret_sit, sit_ret, quadro, matr_opc, data_desl, termo, obs, data_cadastro) VALUES ($marcadores);";

						$stmt = $conexao->prepare($query);
						$stmt->execute($params);
		
						$linhasInseridas = $stmt->rowCount();
		
						if ($linhasInseridas > 0) {
							return new ApiResponse('success', 'Dados inseridos com sucesso.', $linhasInseridas);
						} else {
							return new ApiResponse('error', 'Nenhum dado inserido.');
						}		
											
					} else {
						return new ApiResponse('conflict', 'Documento ou Email duplicados. Revise as informações ou edite o cadastro existente.', $consulta['data']);
					}
	
				} else {

					return $consulta;

				}

			} else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }
        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function alterPessoasDadosAdic( PessoasDadosAdic $PessoasDadosAdic ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {
				$DT = new DateTime();

				$consulta = $this->getUnicoCadastroByPessoasDadosAdic($PessoasDadosAdic->getId(),$PessoasDadosAdic->getIdPessoa(),$PessoasDadosAdic->getDoc(),$PessoasDadosAdic->getEmailPess());

				if ($consulta->getStatus() == 'success') {

					if (count($consulta->getData()) == 0) {
						
						$DT = new DateTime();

						$params = array(
							$PessoasDadosAdic->getEndCep(),
							$PessoasDadosAdic->getEndLogr(),
							$PessoasDadosAdic->getEndNum(),
							$PessoasDadosAdic->getEndBair(),
							$PessoasDadosAdic->getEndRef(),
							$PessoasDadosAdic->getEndCid(),
							$PessoasDadosAdic->getEndEst(),
							$PessoasDadosAdic->getTel1(),
							$PessoasDadosAdic->getTel2(),
							$PessoasDadosAdic->getTel3(),
							$PessoasDadosAdic->getTipoDoc(),
							$PessoasDadosAdic->getDoc(),
							$PessoasDadosAdic->getRg(),
							$PessoasDadosAdic->getOe(),
							$PessoasDadosAdic->getNacio(),
							$PessoasDadosAdic->getNatur(),
							$PessoasDadosAdic->getEstCiv(),
							$PessoasDadosAdic->getEscol(),
							$PessoasDadosAdic->getDataNasc(),
							$PessoasDadosAdic->getSituacao(),
							$PessoasDadosAdic->getDataFalec(),
							$PessoasDadosAdic->getEmailPess(),
							$PessoasDadosAdic->getSexo(),
							$PessoasDadosAdic->getEmailBol(),
							$PessoasDadosAdic->getEmailAdic(),
							$PessoasDadosAdic->getTratPess(),
							$PessoasDadosAdic->getSocioCons(),
							$PessoasDadosAdic->getDataVinc(),
							$PessoasDadosAdic->getDataRetSit(),
							$PessoasDadosAdic->getSitRet(),
							$PessoasDadosAdic->getQuadro(),
							$PessoasDadosAdic->getMatrOpc(),
							$PessoasDadosAdic->getDataDesl(),
							$PessoasDadosAdic->getTermo(),
							$PessoasDadosAdic->getObs(),
							$DT->format("Y-m-d H:i:s"),
							$PessoasDadosAdic->getId()
						);

						$query = "UPDATE pessoa_dados_pessoais SET end_cep = ?, end_logr = ?, end_num = ?, end_bair = ?, end_ref = ?, end_cid = ?, end_est = ?, tel1 = ?, tel2 = ?, tel3 = ?, tipo_doc = ?, doc = ?, rg = ?, oe = ?, nacio = ?, natur = ?, est_civ = ?, escol = ?, data_nasc = ?, situacao = ?, data_falec = ?, email_pess = ?, sexo = ?, email_bol = ?, email_adic = ?, trat_pess = ?, socio_cons = ?, data_vinc = ?, data_ret_sit = ?, sit_ret = ?, quadro = ?, matr_opc = ?, data_desl = ?, termo = ?, obs = ?, data_atualizacao = ? WHERE id = ?;";

						$stmt = $conexao->prepare($query);
						$stmt->execute($params);
		
						$linhasAtualizadas = $stmt->rowCount();
	
						if ($linhasAtualizadas > 0) {
							return new ApiResponse('success', 'Dados atualizados com sucesso.', $linhasAtualizadas);
						} elseif ($linhasAtualizadas === 0) {
							return new ApiResponse('success2', 'Nenhum dado atualizado.');
						} else {
							return new ApiResponse('error', 'Erro na atualização dos dados.');
						}
													
					} else {
						return new ApiResponse('conflict', 'Documento ou Email duplicados.', $consulta['data']);
					}
	
				} else {

					return $consulta;

				}

			} else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }
        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function PessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {

				$query = "SELECT * FROM pessoa_dados_pessoais WHERE id_pessoa = ? LIMIT 1;";
				$params = array($PessoasDadosAdic->getIdPessoa());

                $stmt = $conexao->prepare($query);
				$stmt->execute($params);

                if ($stmt->rowCount()) {
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return new ApiResponse('success', 'Dados recuperados com sucesso', $retorno[0]);
                } else if ($stmt->rowCount() == 0) {
                    return new ApiResponse('noContent', 'Não há dados pessoais para o ID informado');
                } else {
                    return new ApiResponse('error', 'Erro na consulta SQL');
                }
            } else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }

        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function docPessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {

				$query = "SELECT * FROM pessoa_dados_pessoais WHERE doc = ?;";
				$params = array($PessoasDadosAdic->getDoc());

                $stmt = $conexao->prepare($query);
				$stmt->execute($params);

                if ($stmt->rowCount()) {
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return new ApiResponse('success', 'Dados recuperados com sucesso.', $retorno);
                } else if ($stmt->rowCount() == 0) {
                    return new ApiResponse('noContent', 'Não há dados pessoais para o Documento informado.');
                } else {
                    return new ApiResponse('error', 'Erro na consulta SQL.');
                }
            } else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }

        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function emailPessPessoasDadosAdic_one( PessoasDadosAdic $PessoasDadosAdic ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {

				$query = "SELECT * FROM pessoa_dados_pessoais WHERE email_pess = ?";
				$params = array($PessoasDadosAdic->getEmailPess());

                $stmt = $conexao->prepare($query);
				$stmt->execute($params);

                if ($stmt->rowCount()) {
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return new ApiResponse('success', 'Dados recuperados com sucesso.', $retorno);
                } else if ($stmt->rowCount() == 0) {
                    return new ApiResponse('noContent', 'Não há dados pessoais para o Email informado.');
                } else {
                    return new ApiResponse('error', 'Erro na consulta SQL.');
                }
            } else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }

        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }

	public function getHeaderPessoasCad( PessoasCadastros $PessoasCadastros ):ApiResponse {

        try {
            $conexao = $this->database->conectar();

            if ($conexao instanceof PDO) {

				$query = "SELECT id, categ, matric, matric_dig, titulo, data_admissao, nome, abrev, link_erp, data_cadastro, data_atualizacao, sit_titulo FROM pessoa_cadastro WHERE id = ?;";

				$params = array($PessoasCadastros->getId());

                $stmt = $conexao->prepare($query);
				$stmt->execute($params);

                if ($stmt->rowCount()) {
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return new ApiResponse('success', 'Dados recuperados com sucesso.', $retorno[0]);
                } else if ($stmt->rowCount() == 0) {
                    return new ApiResponse('noContent', 'Não há dados para o ID Pessoa informado.');
                } else {
                    return new ApiResponse('error', 'Erro na consulta SQL.');
                }
            } else {
				return new ApiResponse('error', 'Erro na conexão com o banco de dados.');
            }

        } catch (Exception $e) {
            return new ApiResponse('error', $e->getMessage());
        
		}  finally {
			$this->database->desconectar();
		}

    }
	
}