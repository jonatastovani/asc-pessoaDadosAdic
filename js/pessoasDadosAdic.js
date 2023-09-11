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
                if (data[0].success) {
                    iddadosadic = null;
                    $('#id_dadosAdic').val('');
                    $('#action').val('insert_pessoasDadosAdic');
                
                } else {
                    console.log("entrou no segundo")
                    iddadosadic = data[0].id;
                    $('#id_dadosAdic').val(data[0].id);
                    $('#action').val('update_pessoasDadosAdic');

                    $('#end_cep').val(data[0].end_cep).trigger('change');
                    $('#end_logr').val(data[0].end_logr);
                    $('#end_num').val(data[0].end_num);
                    $('#end_ref').val(data[0].end_ref);
                    $('#end_bair').val(data[0].end_bair);
                    $('#end_cid').val(data[0].end_cid);
                    $('#end_est').val(data[0].end_est);
                    $('#tel1').val(data[0].tel1).trigger('blur');
                    $('#tel2').val(data[0].tel2).trigger('blur');
                    $('#tel3').val(data[0].tel3).trigger('blur');
                    $('#tipo_doc').val(data[0].tipo_doc).trigger('change');
                    $('#doc').val(data[0].doc);
                    $('#rg').val(data[0].rg);
                    $('#oe').val(data[0].oe);
                    $('#nacio').val(data[0].nacio);
                    $('#natur').val(data[0].natur);
                    $('#est_civ').val(data[0].est_civ);
                    $('#escol').val(data[0].escol);
                    $('#data_nasc').val(data[0].data_nasc);
                    $('#situacao').val(data[0].situacao);
                    $('#data_falec').val(data[0].data_falec!='0000-00-00'?data[0].data_falec:'');
                    $('#email').val(data[0].email);
                    $('#sexo').val(data[0].sexo);
                    $('#email_bol').val(data[0].email_bol);
                    $('#email_adic').val(data[0].email_adic);
                    $('#trat_pess').val(data[0].trat_pess);
                    $('#socio_cons').val(data[0].socio_cons);
                    $('#data_vinc').val(data[0].data_vinc!='0000-00-00'?data[0].data_vinc:'');
                    $('#data_ret_sit').val(data[0].data_ret_sit!='0000-00-00'?data[0].data_ret_sit:'');
                    $('#sit_ret').val(data[0].sit_ret);
                    $('#quadro').val(data[0].quadro);
                    $('#matric_opc').val(data[0].matric_opc);
                    $('#data_desl').val(data[0].data_desl!='0000-00-00'?data[0].data_desl:'');
                    $('#termo').val(data[0].termo);
                    $('#obs').val(data[0].obs);

                    $('#end_cep').mask('00.000-000');

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
        
        // let verifica = verificacoes();
        // if (verifica != true) {
        //     return alert(verifica);
        // }

        const camposDesabled = $(this).find('.grupoCEP');
        camposDesabled.prop('disabled', false);
        var form1 = $(this).serialize();
        camposDesabled.prop('disabled', true);
        console.log(form1)

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
    
    
    // function verificacoes() {
    //     let arrMensagens = [];



    //     let strMensagem='';
    //     if(arrMensagens.length)
    //         strMensagem = 'Algumas coisas precisam ser resolvidas antes de prosseguir-mos:\n';
    //         arrMensagens.forEach(mensagem => {
    //             strMensagem += `\n${mensagem}`;
    //         });
        
    //     return strMensagem!=''?strMensagem:true;
        
    // }

    $('.clstelefone').on('blur', function(){
        mascaraTelefone($(this).val(),'#'+this.id);
    })
   
    $('#tipo_doc').on('change', function(){
        if ($('#tipo_doc').val()=='cpf') {
            $('#doc').mask('000.000.000-00');
        } else if ($('#tipo_doc').val()=='cnpj') {
            $('#doc').mask('00.000.000/0000-00');
        }
    })
   
    $('#end_cep').on('change', function() {
        if (this.value.length==10) {
            buscandoCEP(this.value);
            console.log('Entrou consulta')
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

    $('#end_cep').mask('00.000-000');
    $('#tipo_doc').trigger('change');
    
});