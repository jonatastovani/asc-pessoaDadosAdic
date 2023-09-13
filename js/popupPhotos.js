let strCPFfoto = 0;
let idPhoto = 0;
let arrHeaderData = [];

$(document).ready(function(){

    function setInfo(arrInfoFoto) {
        arrHeaderData = arrInfoFoto.arrHeaderData;
        idPhoto = arrInfoFoto.idPhoto;
    }

    function openPopPhoto(){
        clearPopPhoto();
        if(idPhoto>0){
            fillHeaderDataPopPhoto();
            $("#pop-popfotovisitante").addClass("active");
            $("#pop-popfotovisitante").find(".popup").addClass("active");
            $('#cpfpopfotovisitante').focus();
        }
    }
    //Fechar pop-up Artigo
    $("#pop-popfotovisitante").find(".close-btn").on("click",function(){
        fecharPopFotoVisitante();
    })
    function fecharPopFotoVisitante(){
        $("#pop-popfotovisitante").removeClass("active");
        $("#pop-popfotovisitante").find(".popup").removeClass("active");
        idPhoto = 0;
        strCPFfoto = 0;
    }

    $('#cancelPopPhoto').click(()=>{
        fecharPopFotoVisitante();
    })

    function clearPopPhoto(){
        $('.divscanvasPopPhoto').attr('hidden','hidden');
        $('.htmlTempPopPhoto').html('');
        $('.btnsActionPopPhoto').attr('hidden','hidden').off('click');
        $('#uploaderPopPhoto').val('');
    }

    function fillHeaderDataPopPhoto(){
        let legendTitle = arrHeaderData.legendTitle?arrHeaderData.legendTitle:'Seleção de Foto';

        let htmlHeader = '<div class="row"><div class="col-12"><div class="card"><div class="card-body">';

        arrHeaderData.fields.forEach(element => {
            htmlHeader += '<p><b>'+element.label+':</b> '+element.info+'</p>';
        });

        htmlHeader += '</div></div></div></div>';

        $('#legendTitle').val(legendTitle);
        $('#headerData').html(htmlHeader);
        
        checkImage(arrHeaderData.pathPhoto);
    }

    function checkImage(url) {
        fetch(url, { method: 'HEAD' })
            .then(function (response) {
                if (response.ok) {
                    $('#photoPopPhoto').attr('src', url);
                } else {
                    $('#photoPopPhoto').attr('src', '../img/sem-foto.png');
                }
            })
            .catch(function (error) {
            console.log('Erro ao verificar a imagem:', error);
        });
    }
      
    const preview = $('#preview')[0];
    preview.width = 340;
    preview.height = 480;

    const reader = new FileReader();
    const img = new Image();

    const loadImage = (e)=>{
        reader.onload = ()=>{
            img.onload = ()=>{
                $('.btnsActionPopPhoto').attr('hidden','hidden').off('click');
                $('#divcanvas').html('<canvas id="canvas"></canvas>');
                const canvas = $('#canvas')[0];
                const ctx = canvas.getContext('2d');
                $('#divimgoriginal').removeAttr('hidden');

                //Limpar preview
                let ctxpreview = preview.getContext('2d');
                ctxpreview.clearRect(0, 0, preview.width, preview.height);

                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img,0,0);
                $('#divimgpreview').attr('hidden','hidden');

                $('#canvas').Jcrop({
                    onChange: updatePreview,
                    onSelect: updatePreview,
                    allowSelect: true,
                    allowMove: true,
                    allowResize: true,
                    aspectRatio: 3/4
                });
                
            };
            img.src = reader.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    };

    const imageLoader = $('#uploaderPopPhoto')[0];
    imageLoader.addEventListener('change',loadImage);

    function downloadFotoVisitante(){
        const image = preview.toDataURL();
        const link = document.createElement('a');
        link.href = image;
        link.download = strCPFfoto+'.jpg';
        link.click();
    }

    function updatePreview(c) {
        if (parseInt(c.w) > 0) {
            // Show image preview
            var imageObj = $("#canvas")[0];
            var canvas = $("#preview")[0];
            var context = canvas.getContext("2d");
            
            // console.log(c)
            if (imageObj != null && c.w != 0 && c.h != 0) {
                context.drawImage(imageObj, Math.floor(c.x), Math.floor(c.y), Math.floor(c.w), Math.floor(c.h), 0, 0, canvas.width, canvas.height);
            }

            inserirCPFFoto(canvas);

            if($('#divimgpreview').attr('hidden')=='hidden'){
                $('#divimgpreview').removeAttr('hidden');
            }

            if($('#downloadPhoto').attr('hidden')=='hidden'){
                $('#downloadPhoto').removeAttr('hidden');
                $('#downloadPhoto').click(()=>{
                    downloadFotoVisitante();
                });
            }

            if($('#savePhoto').attr('hidden')=='hidden'){
                $('#savePhoto').removeAttr('hidden');
                
                $('#savePhoto').click(()=>{
                    salvarPopFotoVisisante();
                });
            }
        }
    }

    function inserirCPFFoto(canvas) {
        var fontSizeCPF = 30;
        var color = 'white';
        var ctx = canvas.getContext('2d')

        var i = canvas.width;
        //Colocar faixa de fundo somente atás das letras
        /*var i = string.length;
        i = i*fontSize*0.62;
        if (i > canvas.width) {
        i = canvas.width;
        }*/

        ctx.fillStyle = "RGBA(0, 0, 0, 0.8)"; // Fundo preto
        //ctx.fillStyle = "RGBA(255, 255, 255, 0.8)"; // Fundo branco
        //ctx.fillRect(canvas.width / 2 - i / 2,canvas.height / 2 - (fontSize * 1.5) / 2, i, (fontSize * 1.5) ); // Centralização da faixa
        ctx.fillRect(canvas.width / 2 - i / 2,canvas.height - 30 - (fontSizeCPF * 1.5) / 2, i, (fontSizeCPF * 1.5) );
        ctx.font = fontSizeCPF.toString() + "px monospace";
        ctx.fillStyle = color;
        ctx.textBaseline = "middle";
        ctx.textAlign = "center";

        ctx.fillText(strCPFfoto, canvas.width / 2, canvas.height - 30);
    }

    function salvarPopFotoVisisante(){

        var fotos = [];
        // var canvas = document.querySelectorAll('.foto');
        // for(var i=0;i<canvas.length;i++){
        //     fotos.push({
        //         nome: retornaSomenteNumeros("429.712.118-27"),
        //         imagem: canvas[i].toDataURL()
        //     })
        // }

        var canvas = $('#preview')[0];
        fotos.push({
            nome: 1,
            imagem: canvas.toDataURL()
        })

        // console.log(fotos);

        $.ajax({
            url: 'ajax/inserir_alterar/salvar_foto_servidor.php',
            method: 'POST',
            //Insere os dados no data. key: value. Pode fazer o data fora daqui e depois inserir a variável para atribuir no data.
            data: {tipo: 2, cpfvisitante: strCPFfoto, fotos: fotos},
            //json é uma linguagem que ambos se entendem. Tanto javascript quanto PHP.
            dataType: 'json',
            async: false
        }).done(function(result){
            //console.log(result)

            if(result.MENSAGEM){
                inserirMensagemTela(result.MENSAGEM);
            }else{
                inserirMensagemTela(result.OK);
                if($('#fotovisita1').length>0){
                    atualizaFotoVisitante();
                }
                fecharPopFotoVisitante();
            }
        });
    }

});