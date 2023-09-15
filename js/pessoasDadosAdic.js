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
            async: false,
            success:function(data) {
                
                if (data[0].success) {
                    iddadosadic = null;
                    $('#id_dadosAdic').val('');
                    $('#action').val('insert_pessoasDadosAdic');
                
                } else {
                
                    iddadosadic = data[0].id;
                    $('#id_dadosAdic').val(data[0].id);
                    $('#action').val('update_pessoasDadosAdic');

                    $('#end_cep').val(data[0].end_cep);
                    $('#end_logr').val(data[0].end_logr);
                    $('#end_num').val(data[0].end_num);
                    $('#end_ref').val(data[0].end_ref);
                    $('#end_bair').val(data[0].end_bair);
                    $('#end_cid').val(data[0].end_cid);
                    $('#end_est').val(data[0].end_est);
                    $('#tel1').val(data[0].tel1);
                    $('#tel2').val(data[0].tel2);
                    $('#tel3').val(data[0].tel3);
                    $('#doc').val(data[0].doc);
                    $('#tipo_doc').val(data[0].tipo_doc);
                    $('#rg').val(data[0].rg);
                    $('#oe').val(data[0].oe);
                    $('#nacio').val(data[0].nacio);
                    $('#natur').val(data[0].natur);
                    $('#est_civ').val(data[0].est_civ);
                    $('#escol').val(data[0].escol);
                    $('#data_nasc').val(data[0].data_nasc);
                    $('#situacao').val(data[0].situacao);
                    $('#data_falec').val(data[0].data_falec!='0000-00-00'?data[0].data_falec:'');
                    $('#email_pess').val(data[0].email_pess);
                    $('#sexo').val(data[0].sexo);
                    $('#email_bol').val(data[0].email_bol);
                    $('#email_adic').val(data[0].email_adic);
                    $('#trat_pess').val(data[0].trat_pess);
                    $('#socio_cons').val(data[0].socio_cons);
                    $('#data_vinc').val(data[0].data_vinc!='0000-00-00'?data[0].data_vinc:'');
                    $('#data_ret_sit').val(data[0].data_ret_sit!='0000-00-00'?data[0].data_ret_sit:'');
                    $('#sit_ret').val(data[0].sit_ret);
                    $('#quadro').val(data[0].quadro);
                    $('#matr_opc').val(data[0].matr_opc);
                    $('#data_desl').val(data[0].data_desl!='0000-00-00'?data[0].data_desl:'');
                    $('#termo').val(data[0].termo);
                    $('#obs').val(data[0].obs);

                    buscaFoto(`../img/fotos/pessoas/${idpessoa}`,'#fotoPessoa');

                    executeMask();
                }

            },
            error: function(result) {
                // alert ('Erro: ' + result.error);
                console.log(result);					
            }
        });

    }

    $('#form1').on('submit', function(event){
        event.preventDefault();			
        
        let verifica = verificacoes();
        if (verifica != true) {
            return alert(verifica);
        }

        const camposDesabled = $(this).find('.grupoCEP');
        camposDesabled.prop('disabled', false);
        var form1 = $(this).serialize();
        camposDesabled.prop('disabled', true);

        $.ajax({
            url: "../api/savePessoasDadosAdic.php",
            method:"POST",
            data:form1,
            success:function(data) {

                if (data === 'error2') {
                    alert("Os dados enviados já encontram-se cadastrados no nosso Banco de Dados! Revise as informações ou edite o cadastro existente.");
                } else if (data === 'insert') {
                    alert("Dados inseridos!");

                } else if (data === 'update') {
                    alert("Dados atualizados!");
                }
            }
        });				
        
    });
        
    function verificacoes() {
        let arrMensagens = [];

        let arrData = {
            action: 'idPessoaPessoasDadosAdic_one',
            key: 'id_pessoa',
            value: idpessoa,
            id: $('#action').val()=='update_pessoasDadosAdic'?idpessoa:null
        }
        if (verificaDadosDuplicados(arrData)!=false) {
            arrMensagens.push('Já consta em nossos cadastros dados pessoais da pessoa em tela. Atualize a página e altere as informações caso seja necessário.')
        }
            
        arrData = {
            action: 'docPessoasDadosAdic_one',
            key: 'doc',
            value: $('#doc').val(),
            id: $('#action').val()=='update_pessoasDadosAdic'?idpessoa:null
        }

        if (verificaDadosDuplicados(arrData)!=false) {
            arrMensagens.push('O documento '+$('#lbldoc').html()+' informado já consta em nossos cadastros.')
        }
            
        arrData = {
            action: 'emailPessoasDadosAdic_one',
            key: 'email_pess',
            value: $('#email_pess').val(),
            id: $('#action').val()=='update_pessoasDadosAdic'?idpessoa:null
        }

        if (verificaDadosDuplicados(arrData)!=false) {
            arrMensagens.push('O email informado já consta em nossos cadastros.')
        }
            
        let conteudoVerificar = $('#doc').val().replace(/\D/g, '');
        if ($('#tipo_doc').val()=='cpf') {
            if(conteudoVerificar.length!=11 || validaCPF(conteudoVerificar)!==true) {
                arrMensagens.push('O CPF informado está incorreto.');
            }
        } else if ($('#tipo_doc').val()=='cnpj') {
            if(conteudoVerificar.length!=14 || validaCNPJ(conteudoVerificar)!==true) {
                arrMensagens.push('O CNPJ informado está incorreto.');
            }
        }
        
        conteudoVerificar = $('#end_cep').val().replace(/\D/g, '');
        if(conteudoVerificar.length!=8) {
            arrMensagens.push('O CEP informado está incompleto.');
        }

        conteudoVerificar = $('#sexo').val();
        if(!('M','F').includes(conteudoVerificar)) {
            arrMensagens.push('Informe M ou F no campo Sexo.');
        }

        let strMensagem='';
        if(arrMensagens.length)
            strMensagem = 'Algumas coisas precisam ser resolvidas antes de prosseguir-mos:\r';
            arrMensagens.forEach(mensagem => {
                strMensagem += `\r${mensagem}`;
            });
        
        return strMensagem!=''?strMensagem:true;
        
    }

    function verificaDadosDuplicados(arrParams){
        let id = null;
        if(arrParams.id){
            id = arrParams.id;
        }
        
        let arrdata = {
            action: arrParams.action
        }
        arrdata[arrParams.key] = arrParams.value;

        let retorno = true;

        $.ajax({
            url:"../api/savePessoasDadosAdic.php",
            method:"POST",
            data:arrdata,
            dataType:"json",
            async: false,
            success:function(data)
            {
                if (data.length>0) {
                    if (id!=null && data[0].id == id){
                        retorno = false;
                    }
                }else {
                    retorno = false;
                }
            },
            error: function(result) {
                console.log(result);					
                retorno = true;
            }
        });

        return retorno;
    }

    $('.clstelefone').on('blur', function(){
        mascaraTelefone($(this).val(),'#'+this.id);
    })
   
    $('#end_cep').on('blur', function(){

        mascaraCep('#'+this.id);
        
    })
   
    $('#end_cep').on('change', function() {
        
        if (this.value.replace(/\D/g, '').length==8) {
            buscandoCEP(this.value);
        } else {
            buscandoCEP(null);
        }

    });

    $('#doc').on('blur', function(){

        if ($('#tipo_doc').val()=='cpf') {
            mascaraCPF('#'+this.id);
            $('#lbldoc').html('CPF:');
        } else if ($('#tipo_doc').val()=='cnpj') {
            mascaraCNPJ('#'+this.id);
            $('#lbldoc').html('CNPJ:');
        }
        
    })

    $('#sexo').on('keyup', function(){
        this.value = this.value.toUpperCase();
    })

    $('#tipo_doc').on('change', function(){

        $('#doc').blur();

    })
   
    function executeMask() {
        $('#doc').trigger('blur');
        $('#end_cep').trigger('blur');
        $('#end_cep').trigger('change');
        $('.clstelefone').trigger('blur');
    }

    function buscandoCEP (cep=null) {
        if (cep==null || cep.replace(/\D/g, '').length!=8){
            habilitaCamposSeletor(true,'.grupoCEP');
            return;
        }
        
        let consulta = buscarCEP(cep);

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

    $('#select_photo').on('click', function(event){
        event.preventDefault();

        let arrHeaderData = [{
            title: 'Foto de Cliente',
            fields : [{
                label: 'Nome',
                info: $('#nomePessoa').html(),
            }, {
                label: 'Matrícula',
                info: $('#matrPessoa').html()
            }]
        }];
        let arrInfoPopPhoto = [{
            arrHeaderData: arrHeaderData,
            idPhoto: idpessoa,
            idImgUpdate: '.clsfotoPessoa',
            pathFolder: '../img/fotos/pessoas'
        }]
        openPopPhoto(arrInfoPopPhoto);
    });

    $('#tipo_doc').trigger('change');

    executeMask();
});

