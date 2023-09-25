<?php

class DataController {   

    public static function getDataGeneric( $param, $url_api, $type ) { 
        
        $url = $url_api.$param;                
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);	
        $response = curl_exec($client);
        $result = json_decode($response, true);
        $output = "";
        $status = "";
        $message = "";
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
                        $status = 'success';
                        $message = 'Dados encontrados com sucesso.';

                    }else {
                        
                        $output .= '
                        <div class="row">
                            <div class="col-md-9">
                                <h4>Nenhum resultado de dados.</h4>
                            </div>
                        </div>';
                        $status = 'noContent';
                        $message = 'Nenhum resultado de dados.';
        
                    }
                break;

                case 'acomodacoes':
            
                    if (count($result['data'])) {

                        foreach($result['data'] as $row) {

                            $id = $row['id'];
                            $descricao = $row['descricao'];
                            $capacidade = $row['capacidade'];
                            $unidade = $row['unidade'];
                            $observacoes = $row['observacoes'];
                            $categoria = $row['categoria'];
                            
                            $output .= '
                            <tr style="text-align:center">
                                <td>'.$id.'</td>                        
                                <td>'.$descricao.'</td>				
                                <td>'.$capacidade.'</td>				
                                <td>'.$unidade.'</td>				
                                <td>'.$observacoes.'</td>				
                                <td>'.$categoria.'</td>				
                                <td>
                                    <form action="cadAcomodacoes.php" method="post">
                                        <input type="hidden" name="id_acomodacao" value="'.$id.'">
                                        <input type="hidden" name="action" value="update_acomodacoes">
                                        <input type="submit" class="btn btn-primary edit" value="Editar" title="Editar esta acomodação">
                                    </form>
                                </td>
                                <td><button name="delete" class="btn btn-danger delete" type=button data-id="'.$id.'" title="Deletar esta acomodação">Deletar</button></td>  
                            </tr>
                            ';
                            $status = 'success';
                            $message = 'Dados encontrados com sucesso.';
    
                        }

                    }else {
                        
                        $output .= '
                            <tr>
                                <td colspan=8>Nenhum resultado de dados.</td>
                            </tr>
                        ';
                        $status = 'noContent';
                        $message = 'Nenhum resultado de dados.';

                    }
                break;
                
                case 'acomUnidades_select':
                case 'acomCategoria_select':
            
                    if (count($result['data'])) {

                        $count = 0;
                        foreach($result['data'] as $row) {

                            $id = $row['id'];
                            $descricao = $row['descricao'];
                            $selected = $count==0?'selected':'';
                            $output .= '<option value="'. $id.'" '.$selected.'>'.$descricao.'</option>';
                            $count++;
                        }
                        $status = 'success';
                        $message = 'Dados encontrados com sucesso.';

                    }else {
                        
                        $output .= '<option value="0">Nenhum resultado de dados</option>';
                        $status = 'noContent';
                        $message = 'Nenhum resultado de dados.';

                    }
                break;

            }

        } else {

            $output .= '
                <tr>
                    <td colspan=6>Nenhum resultado de dados.</td>
                </tr>
            ';
            $status = $result['status'];
            $message = $result['message'];

        }
        
        $responseData['status'] = $status;
        $responseData['message'] = $message;
        $responseData['data'] = $output;

        return json_encode($responseData);

    }
    
}