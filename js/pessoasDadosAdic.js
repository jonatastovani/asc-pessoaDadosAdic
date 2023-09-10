const idpessoa = parseInt($('#id_pessoaDadosAdic').val());
let iddadosadic = null;

$(document).ready(function(){

    if (typeof idpessoa === 'number' && idpessoa > 0) {
        getData('pessoasCadHeader', '?action=get_header_pessoasCad&id='+idpessoa);
        getDataDados();
    } else {
        console.log('Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.');
        console.log('ID informado = '+idpessoa);
        $('#headerPessoa').html("<p>Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.</p>");
        $('#form1').attr('hidden', 'hidden');
    }

    function Reset() {

        $('#form1')[0].reset();
        $('#end_cep')[0].focus();

    }
    
    function getData(type, param) {

        $.ajax({
            url:"../api/getdataGeral.php",
            data: { type:type, param:param },
            dataType: "json",
            success: function(response){

                if (response.status === 'success') {
                    $('#headerPessoa').html(response.data);
                } else {
                    let html = 'Erro: ' + response.message;

                    if ($('#headerPessoa').find('.card-body').length){
                        $('#headerPessoa').html(html);
                    } else {
                        $('#headerPessoa').append(html);
                    }
                    $('#form1').attr('hidden', 'hidden');
            
                }

            },
            error: function (error) {
                console.log(error)
                alert('Erro na requisição AJAX.');
            }
        })
    }

    function getDataDados () {
        
        let action = 'pessoasDadosAdic_one';
        
        $.ajax({
            url:"../api/savePessoasDadosAdic.php",
            method:"POST",
            data:{id:idpessoa,action:action},
            dataType:"json",
            success:function(data) {
                
                console.log(data);
                if (data.success) {
                    iddadosadic = null;
                    $('#id_dadosAdic').val('');
                    $('#action').val('insert_pessoasDadosAdic');

                } else {
                    iddadosadic = data.id;
                    $('#id_dadosAdic').val(data.id);
                    $('#action').val('update_pessoasDadosAdic');

                    $('#end_cep').val(data.fam1);
                    $('#end_logr').val(data.end_logr);
                    $('#end_num').val(data.end_num);
                    $('#end_ref').val(data.end_ref);
                    $('#end_bair').val(data.end_bair);
                    $('#end_cid').val(data.end_cid);
                    $('#end_est').val(data.end_est);
                    $('#tel1').val(data.tel1).trigger('blur');
                    $('#tel2').val(data.tel2).trigger('blur');
                    $('#tel3').val(data.tel3).trigger('blur');
                    $('#tipo_doc').val(data.tipo_doc).trigger('change');
                    $('#doc').val(data.doc);
                    $('#rg').val(data.rg);
                    $('#oe').val(data.oe);
                    $('#nacio').val(data.nacio);
                    $('#natur').val(data.natur);
                    $('#est_civ').val(data.est_civ);
                    $('#escol').val(data.escol);
                    $('#data_nasc').val(data.data_nasc);
                    $('#situacao').val(data.situacao);
                    $('#data_falec').val(data.data_falec);
                    $('#email').val(data.email);
                    $('#sexo').val(data.sexo);
                    $('#email_bol').val(data.email_bol);
                    $('#email_adic').val(data.email_adic);
                    $('#trat_pess').val(data.trat_pess);
                    $('#socio_cons').val(data.socio_cons);
                    $('#data_vinc').val(data.data_vinc);
                    $('#data_ret_sit').val(data.data_ret_sit);
                    $('#sit_ret').val(data.sit_ret);
                    $('#quadro').val(data.quadro);
                    $('#matric_opc').val(data.matric_opc);
                    $('#data_desl').val(data.data_desl);
                    $('#termo').val(data.termo);
                    $('#obs').val(data.obs);
                }

            },
            error: function(result) {
                // alert ('Erro: ' + result.error);
                console.log(result);					
            }
        });
    }

    $(document).on('click', '#cancel', function(){
        
        Reset();

    });
    
    $('#form1').on('submit', function(event){
        event.preventDefault();			
        
        let verifica = verificacoes();
        if (verifica != true) {
            return alert(verifica);
        }

        var form1 = $(this).serialize();

        $.ajax({
            url: "../api/savePessoasDadosAdic.php",
            method:"POST",
            data:form1,
            success:function(data)
            {
                
                if (data === 'error2') {
                    alert("Os dados enviados já encontram-se cadastrados no nosso Banco de Dados! Revise as informações ou edite o cadastro existente.");
                } else if (data === 'update') {
                    alert("Dados atualizados!");
                }

            }
        });				
        
    });
    
    
    function verificacoes() {
        let arrMensagens = [];

        let arrRelacoes = [];

        arrRelacoes.push(
            {campoNome: '#fam1', campoTel: '#telfam1', nomeContato: 'Familiar 1'},
            {campoNome: '#fam2', campoTel: '#telfam2', nomeContato: 'Familiar 2'},
            {campoNome: '#medic', campoTel: '#telmedic', nomeContato: 'Médico'}
        );

        arrRelacoes.forEach(relacao => {
            let campoTel = $(relacao.campoTel).val().replace(/\D/g, '').trim().length;
            let campoNome = $(relacao.campoNome).val().trim().length;

            if ((campoNome>0 && campoTel==0) || (campoNome==0 && campoTel>0 || (campoNome>0 && campoTel<8))){
                arrMensagens.push('Os dados referentes ao "' + relacao.nomeContato + '" precisa ser preenchido corretamente.');
            }
        });

        if (arrMensagens.length){
            arrMensagens.push('\nAtênte-se ao mínimo de 8 dígitos do telefone e ao nome do contato.')
        }
        
        let strMensagem='';
        if(arrMensagens.length)
            strMensagem = 'Algumas coisas precisam ser resolvidas antes de prosseguir-mos:\n';
            arrMensagens.forEach(mensagem => {
                strMensagem += `\n${mensagem}`;
            });
        
        return strMensagem!=''?strMensagem:true;
        
    }

    $('.clstelefone').on('blur', function(){
        mascaraTelefone($(this).val(),'#'+this.id);
    })
   
    $('#tipo_doc').on('change', function(){
        if ($('#tipo_doc').val()=='cpf') {
            $('#doc').mask('000.000.000-00');
        }else {
            $('#doc').mask('00.000.000/0000-00');
        }
    })
   
    $('#end_cep').on('change', function() {
        if (this.value.length==10) {
            buscandoCEP(this.value);
        } else {
            buscandoCEP(null);
        }
    });

    function buscandoCEP (cep=null) {
        if (cep==null || cep.length!=10){
            habilitaCamposSeletor(true,'.grupoCEP');
            return;
        }
        
        let consulta = buscarCEP(cep);
        // console.log(consulta);
        if (typeof consulta === 'object' && !Array.isArray(consulta)) {
            let elementoFoco = $('#end_logr').val().length==0 || 
                $('#end_logr').val()!=consulta.logradouro?'#end_num':'#tel1';

            $('#end_logr').val(consulta.logradouro);
            $('#end_bair').val(consulta.bairro);
            $('#end_cid').val(consulta.localidade);
            $('#end_est').val(consulta.uf);

            habilitaCamposSeletor(false,'.grupoCEP');
            $(elementoFoco).focus();
        } else {
            habilitaCamposSeletor(true,'.grupoCEP');
            $('#action').val()=='insert_pessoasDadosAdic'?$('#end_logr').focus():$('#tel1').focus();
        }
    }

    function executeMask() {
        $('#end_cep').mask('00.000-000');
    }
    
    executeMask();

});