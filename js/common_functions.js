
function validaCPF(NumCPF) {
    var num = String(NumCPF).replace(/\D/g, '');

    if (num.length !== 11 || /^(\d)\1*$/.test(num))
        return false;

    var sum = 0;
    for (var i = 0; i < 9; i++) {
        sum += parseInt(num.charAt(i)) * (10 - i);
    }
    var rest = sum % 11;
    var dig1 = rest < 2 ? 0 : 11 - rest;

    if (parseInt(num.charAt(9)) !== dig1)
        return false;

    sum = 0;
    for (i = 0; i < 10; i++) {
        sum += parseInt(num.charAt(i)) * (11 - i);
    }
    rest = sum % 11;
    var dig2 = rest < 2 ? 0 : 11 - rest;

    if (parseInt(num.charAt(10)) !== dig2)
        return false;

    return true;
}


function validaCNPJ(NumCNPJ) {
    var numCNPJ = String(NumCNPJ).replace(/\D/g, '');
    
    if (numCNPJ.length !== 14)
        return false;
    
    if (/^(\d)\1*$/.test(numCNPJ))
        return false;

    function calcDigVerificador(pos) {
        var Soma = 0;
        var Multiplicador = pos === 12 ? 5 : 6;
        for (var i = 0; i < pos; i++) {
            Soma += parseInt(numCNPJ.charAt(i)) * Multiplicador;
            Multiplicador--;
            if (Multiplicador < 2)
                Multiplicador = 9;
        }
        var Resto = Soma % 11;
        var DigitosVerificadores = Resto < 2 ? 0 : 11 - Resto;
        return parseInt(numCNPJ.charAt(pos)) === DigitosVerificadores;
    }
    
    return calcDigVerificador(12) && calcDigVerificador(13);
}

function mascaraTelefone(numeroEnviado, seletor) {
    let numero = numeroEnviado.replace(/\D/g, '');

    if(numero.length<11){
        $(seletor).mask('(00) 0000-00009');
    }else{
        $(seletor).mask('(00) 0 0000-0009');
    }
}

function mascaraCep(seletor) {
    
    $(seletor).mask('00.000-000');   

}

function mascaraCPF(seletor) {
    
    $(seletor).mask('000.000.000-00');

}

function mascaraCNPJ(seletor) {
    
    $(seletor).mask('00.000.000/0000-00');

}

function habilitaCamposSeletor (status, seletor) {
    let elementos = $(seletor);
    if (status) {
        elementos.removeAttr('disabled');
    } else {
        elementos.attr('disabled','disabled');
    }
}

function buscaFoto(url, seletor, urlSemFoto='../img/sem-foto.png') {
    const extensions = ['jpg', 'jpeg', 'png'];
    let foundExtension = null;

    const urlParts = url.split('.');
    if (urlParts.length > 1) {
        const lastPart = urlParts[urlParts.length - 1];
        if (extensions.includes(lastPart.toLowerCase())) {
            foundExtension = lastPart.toLowerCase();
        }
    }

    let timestamp = '?t=' + new Date().getTime();
    if (foundExtension) {
        const fullImageUrl = url;
        $(seletor).attr('src', fullImageUrl + timestamp);
    } else {

        for (const ext of extensions) {
            const imageUrl = `${url}.${ext}`;
    
            if (foundExtension) {
                break;
            }
        
            fetch(imageUrl, { method: 'HEAD' })
                .then(function (response) {
                    if (response.ok) {
                        foundExtension = ext;
                        const fullImageUrl = `${url}.${foundExtension}`;
                        $(seletor).attr('src', fullImageUrl + timestamp);
                    }
                })
        }
        
        if (!foundExtension) {
            $(seletor).attr('src', urlSemFoto + timestamp);
        }
    }
}

  
