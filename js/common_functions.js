
function mascaraTelefone(numeroEnviado, seletor) {
    let numero = numeroEnviado.replace(/\D/g, '');

    if(numero.length<11){
        $(seletor).mask('(00) 0000-00009');
    }else{
        $(seletor).mask('(00) 0 0000-0009');
    }
}

function habilitaCamposSeletor (status, seletor) {
    let elementos = $(seletor);
    if (status) {
        elementos.removeAttr('disabled');
    } else {
        elementos.attr('disabled','disabled');
    }
}
