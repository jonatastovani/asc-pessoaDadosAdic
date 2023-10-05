const idpessoa = parseInt($('#id_pessoaDadosAdic').val());
let iddadosadic = null;

$(document).ready(function(){

    if (typeof idpessoa === 'number' && idpessoa > 0) {
        getData('pessoasCadHeader', '?action=get_header_pessoasCad&idPessoa='+idpessoa);
    } else {
        console.log('Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.');
        console.log('ID informado = '+idpessoa);
        $('#headerPessoa').html("<p>Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.</p>");
        $('#form1').attr('hidden', 'hidden');
    }

    function getData(type, param) {

        $.ajax({
            url:"../api/getdataGeral.php",
            method:"POST",
            data: { type:type, param:param },
            dataType: "json",
            success: function(response){

                console.log(response)
                switch (response.status) {
                    case 'success':
                        $('#headerPessoa').html(response.data);
                        getDataDados ();
                    break;
                
                    default:
                        console.log('Erro: ' + response.message);
                        $('#headerPessoa').html(`<p>${response.message}</p>`);
                        blockForm();
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
            data:{idPessoa:idpessoa,action:action},
            dataType:"json",
            async: false,
            success:function(response) {
                
                switch (response.status) {
                    case 'noContent':
                        iddadosadic = null;
                        $('#id_dadosAdic').val('');
                        $('#action').val('insert_pessoasDadosAdic');
                        break;

                    case 'success':

                        iddadosadic = response.data.id;
                        $('#id_dadosAdic').val(response.data.id);
                        $('#action').val('update_pessoasDadosAdic');

                        $('#end_cep').val(response.data.end_cep);
                        $('#end_logr').val(response.data.end_logr);
                        $('#end_num').val(response.data.end_num);
                        $('#end_ref').val(response.data.end_ref);
                        $('#end_bair').val(response.data.end_bair);
                        $('#end_cid').val(response.data.end_cid);
                        $('#end_est').val(response.data.end_est);
                        $('#tel1').val(response.data.tel1);
                        $('#tel2').val(response.data.tel2);
                        $('#tel3').val(response.data.tel3);
                        $('#doc').val(response.data.doc);
                        $('#tipo_doc').val(response.data.tipo_doc);
                        $('#rg').val(response.data.rg);
                        $('#oe').val(response.data.oe);
                        $('#nacio').val(response.data.nacio);
                        $('#natur').val(response.data.natur);
                        $('#est_civ').val(response.data.est_civ);
                        $('#escol').val(response.data.escol);
                        $('#data_nasc').val(response.data.data_nasc);
                        $('#situacao').val(response.data.situacao);
                        $('#data_falec').val(response.data.data_falec!='0000-00-00'?response.data.data_falec:'');
                        $('#email_pess').val(response.data.email_pess);
                        $('#sexo').val(response.data.sexo);
                        $('#email_bol').val(response.data.email_bol);
                        $('#email_adic').val(response.data.email_adic);
                        $('#trat_pess').val(response.data.trat_pess);
                        $('#socio_cons').val(response.data.socio_cons);
                        $('#data_vinc').val(response.data.data_vinc!='0000-00-00'?response.data.data_vinc:'');
                        $('#data_ret_sit').val(response.data.data_ret_sit!='0000-00-00'?response.data.data_ret_sit:'');
                        $('#sit_ret').val(response.data.sit_ret);
                        $('#quadro').val(response.data.quadro);
                        $('#matr_opc').val(response.data.matr_opc);
                        $('#data_desl').val(response.data.data_desl!='0000-00-00'?response.data.data_desl:'');
                        $('#termo').val(response.data.termo);
                        $('#obs').val(response.data.obs);

                        buscaFoto(`../img/fotos/pessoas/${idpessoa}`,'#fotoPessoa');

                        executeMask();
                        break;

                    default:
                        blockForm();

                        console.log('Erro: ' + response.message);
                        alert(response.message);

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

        var form1 = $(this).serialize();

        $.ajax({
            url: "../api/savePessoasDadosAdic.php",
            method:"POST",
            data: form1,
            dataType: 'json',
            success:function(response) {

                switch (response.status) {
                    case 'success':
                    case 'conflict':
                        alert(response.message);
                    break;

                    default: 
                        console.log('Erro: ' + response.message);
                        alert("Houve um erro ao realizar o salvamento.");

                }

            },
            error: function(result) {
                console.log('Erro: ' + result.message);
                alert("Houve um erro ao realizar o salvamento. " + result.message);
    }
        });				
        
    });
        
    function verificacoes() {
        let arrMensagens = [];
        let id = $('#action').val()=='update_pessoasDadosAdic'?iddadosadic:null

        let arrConsultas = [{
            nomeConsulta: 'ID Pessoa',
            messageConflict: 'Já consta em nossos cadastros dados pessoais da pessoa em tela. Atualize a página e altere as informações caso seja necessário.',
            arrData: {
                action: 'pessoasDadosAdic_one',
                key: 'idPessoa',
                value: idpessoa,
            }
        }, {
            nomeConsulta: 'Documento',
            messageConflict: 'O documento '+$('#lbldoc').html()+' informado já consta em nossos cadastros.',
            arrData: {
                action: 'docPessoasDadosAdic_one',
                key: 'doc',
                value: $('#doc').val(),
            }
        }, {
            nomeConsulta: 'Email',
            messageConflict: 'O email informado já consta em nossos cadastros.',
            arrData: {
                action: 'emailPessoasDadosAdic_one',
                key: 'email_pess',
                value: $('#email_pess').val()
            }
        }]  

        arrConsultas.forEach(verif => {
            let response = verificaDadosDuplicados(verif.arrData);

            switch (response.status) {
                case 'success':
                    if (response.data.length>0) {
                        if (id!=null && response.data[0].id != id){
                            arrMensagens.push(verif.messageConflict);
                        }
                    }
                break;
                
                case 'noContent':
                break;

                default: 
                    console.log(verif.nomeConsulta+': Erro -> ' + response.message);
                    // alert("Houve um erro ao realizar a consulta.");
                    arrMensagens.push(`Consulta: ${verif.nomeConsulta} -> ${response.message}`);

            }
        });

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
        if(!['M','F'].includes(conteudoVerificar)) {
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
        
        let arrData = {
            action: arrParams.action
        };
        arrData[arrParams.key] = arrParams.value;

        let retorno = {
            status: 'notFound',
            message: 'A consulta não foi realizada.'
        };

        $.ajax({
            url:"../api/savePessoasDadosAdic.php",
            method:"POST",
            data:arrData,
            dataType:"json",
            async: false,
            success:function(response)
            {
                retorno = response;
            },
            error: function(result) {
                retorno = result;
                console.log(result);
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

    function blockForm() {
        $('#form1 :input').prop('disabled', true);
    }
    
    function buscandoCEP (cep=null) {
        if (cep==null || cep.replace(/\D/g, '').length!=8){
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

            $(elementoFoco).focus();
        } else {
            $('#action').val()=='insert_pessoasDadosAdic'?$('#end_logr').focus():$('#tel1').focus();
        }
    }

    $('#select_photo').on('click', function(event){

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

    $('#remove_photo').on('click', function(event){

        let arrData = [{
            idsPhotos: [idpessoa],
            pathFolder: '../img/fotos/pessoas',
            idImg: '.clsfotoPessoa'
        }];
        deletePopPhoto(arrData);
        
    });

    $('#tipo_doc').trigger('change');

    executeMask();
});

