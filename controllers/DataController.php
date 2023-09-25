<?php

class DataController {   

    public static function getDataGeneric( $param, $url_api, $type ) { 
        
        $url = $url_api.$param;                
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);	
        $response = curl_exec($client);
        $result = json_decode($response, true);
        $output = "";
        $responseData = [];
    
        if ($result['status']==='success') {
        
            switch ($type) {
                case 'pessoasCadHeader':

                    if (count($result['data'])) {

                        $row = $result['data'];

                        $id = $row['id'];
                        $categ = $row['categ'];
                        $nome = $row['nome'];
                        $matric = $row['matric'];
                        $matric_dig = $row['matric_dig'];
                        $titulo = $row['titulo'];
                        $sit_titulo = $row['sit_titulo'];
                        $data_admissao = new DateTime($row['data_admissao']);
                        $data_admissao = $data_admissao->format('d/m/Y');
                        $data_atualizacao = $row['data_atualizacao'];
                        $abrev = $row['abrev'];
                        $link_erp = $row['link_erp'];
                        $data_cadastro = new DateTime($row['data_cadastro']);
                        $data_cadastro = $data_cadastro->format('d/m/Y');
                        $data_atualizacao = $row['data_atualizacao'];
                        
                        if ($matric !== null) {
                            $matric = str_pad($matric, 9, '0', STR_PAD_LEFT);
                        }
                        if ($matric_dig !== null) {
                            $matric_dig = str_pad($matric_dig, 2, '0', STR_PAD_LEFT);
                        }
                        if ($titulo !== null) {
                            $titulo = str_pad($titulo, 5, '0', STR_PAD_LEFT);
                        }
                        if ($data_atualizacao !== null) {
                            $data_atualizacao = new DateTime($data_atualizacao);
                            $data_atualizacao = $data_atualizacao->format('d/m/Y H:i:s');
                        }

                        $caminhoFoto = "../img/fotos/pessoas/$id.jpg";

                        if (!file_exists($caminhoFoto)) {
                            $caminhoFoto = "../img/sem-foto.png";
                        }

                        $output .= '
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><b>Categoria:</b> '.$categ.'</p>
                                                    <p><b>Matrícula:</b> <span id="matrPessoa">'.$matric.'-'.$matric_dig.'</span></p>
                                                    <p><b>Admissão:</b> '.$data_admissao.'</p>
                                                    <p><b>Nome Completo:</b> <span id="nomePessoa">'.$nome.'</span></p>
                                                    <p><b>Abreviação:</b> '.$abrev.'</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><b>Link ERP:</b> '.$link_erp.'</p>
                                                    <p><b>Data de inserção:</b> '.$data_cadastro.'</p>
                                                    <p><b>Data da última atualização:</b> '.$data_atualizacao.'</p>                                        
                                                    <p><b>Situação do título:</b> '.$data_atualizacao.'</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-3 mx-auto d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="embed-responsive embed-responsive-3by4" style="height: 200px;">
                                            <img src="'.$caminhoFoto.'" alt="Foto da Pessoa" class="clsfotoPessoa embed-responsive-item img-fluid" style="width: auto; max-height: 100%;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                    
                        ';

                    }else {
                        
                        $output .= '
                        <div class="row">
                            <div class="col-md-9">
                                <h4>Nenhum resultado de dados.</h4>
                            </div>
                        </div>';
        
                    }
                    break;

                }

            $responseData['status'] = 'success';
            $responseData['message'] = 'Dados encontrados com sucesso.';
            $responseData['data'] = $output;

        } else {

            $output .= '
                <tr>
                    <td colspan=6>Nenhum resultado de dados.</td>
                </tr>
            ';

            $responseData['status'] = 'error';
            $responseData['message'] = 'Nenhum dado encontrado ou ocorreu um erro ao buscar os dados.';
            $responseData['data'] = $output;
        
        }
        
        return json_encode($responseData);

    
    }    
}