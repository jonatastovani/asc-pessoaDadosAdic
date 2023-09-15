<!-- popUp para adicionar novo artigo -->

<div id="pop-popPhoto" class="body-popup d-flex justify-content-center align-items-center">
    
    <div class="popup" id="popPhoto">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2 id="titlePopPhoto">Seleção de Foto</h2>

            <div class="container text-center">
                <fieldset>
                    <legend>Informações</legend>
                    <span id="headerData"></span>
                </fieldset>
                <div class="d-flex justify-content-center">
                    <img id="photoPopPhoto" class="img-fluid max-height-150">
                </div>
            </div>


            <fieldset class="grupo-block">
                <legend><label for="uploaderPopPhoto">Selecione o arquivo:</label></legend>
                <input type="file" id="uploaderPopPhoto" accept="image/jpeg,image/png"><br><br>
            </fieldset>

            <div id="divimgoriginal" class="centralizado divscanvasPopPhoto" hidden>
                <div class="grupo-block">
                    <h2>Imagem original</h2><br>
                    <div id="divcanvas" class="htmlTempPopPhoto centralizado block" style="overflow: auto; max-height: 600px;"></div>
                </div>  
            </div>

            <div id="divimgpreview" class="divscanvasPopPhoto centralizado" hidden>
                <div class="grupo">
                    <h2>Imagem a ser salva</h2><br>
                    <canvas id="preview" class="foto" style="width:340px;height:460px; border: 1px solid black; box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.448); border-radius: 4px;"></canvas>
                </div>
            </div>


            <div class="ferramentas align-rig">
                <button id="downloadPhoto" class="btnsActionPopPhoto" hidden>Baixar</button>
                <button id="savePhoto" class="btnsActionPopPhoto" hidden>Salvar</button>
                <button id="cancelPopPhoto">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/popupPhotos.js"></script>