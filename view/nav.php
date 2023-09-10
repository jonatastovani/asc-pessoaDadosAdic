<?php

switch ($disabled) {
    case "home":
        $disabled_home = " disabled ";
        break;
    case "socio":
        $disabled_socio = " disabled ";
        break;
    case "relat":
        $disabled_relat = " disabled ";
        break;
    case "hospe":
        $disabled_hospe = " disabled ";
        break;
    case "usu":
        $disabled_usu = " disabled ";
        break;
    case "manut":
        $disabled_manut = " disabled ";
        break;
}

$array_image = array(
    "/img/icon_hospedagem.png",
    "/img/icon_inicio.png",
    "/img/icon_termino.png",
    "/img/icon_feriado.png",
    "/img/icon_fim_semana.png",
    "/img/icon_white.png",
);


?>
<!-- 
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Logo</h5>
    <nav class="my-2 my-md-0 mr-md-3">       
        
        <a class="p-2 text-dark <?php echo $disabled_socio;?> dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro de Sócios</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item <?php echo $disabled_socio;?> dropdown-toggle" id="sub01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dados Pessoais</a>
            <div class="submenu dropdown-menu" aria-labelledby="sub01">
                <a class="dropdown-item" href="#">Dados profissionais</a>
                <a class="dropdown-item" href="#">Dados de cobrança</a>
                <a class="dropdown-item" href="#">Contatos de emergência</a>
            </div>
            <a class="dropdown-item" href="#">Função</a>
            
            <a class="dropdown-item <?php echo $disabled_socio;?> dropdown-toggle" id="sub02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Emissão de cartões</a>
            <div class="submenu dropdown-menu" aria-labelledby="sub02">
                <a class="dropdown-item" href="#">Cartão social</a>    
                <a class="dropdown-item" href="#">Acesso temporário</a>    
                <a class="dropdown-item" href="#">Cartão estacionamento</a>    
                <a class="dropdown-item" href="#">Temporários</a>    
            </div>            

        </div>              

    </nav>
    
</div>  -->


<nav class="navbar navbar-expand-lg navbar-light bg-light p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h5 class="my-0 mr-md-auto font-weight-normal">Logo</h5>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">    
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link <?php echo $disabled_home;?>" href="../index.php">Home</a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro de Sócios</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Dados Pessoais</a></li>
                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Dados Adicionais</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Dados Profissionais</a></li>
                            <li><a class="dropdown-item" href="#">Dados de Cobrança</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-item" href="/view/pessoasContEmerg.php">Contatos de emergência</a></li>
                    <li><a class="dropdown-item" href="#">Função</a></li>                    
                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Emissão de cartões</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Cartão social</a></li>
                            <li><a class="dropdown-item" href="#">Acesso temporário</a></li>
                            <li><a class="dropdown-item" href="#">Cartão estacionamento</a></li>
                            <li><a class="dropdown-item" href="#">Temporários</a></li>
                        </ul>
                    </li>
                </ul>
            </li>            


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cobrança</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    <li><a class="dropdown-item" href="#">Débitos dos sócios</a></li>
                    <li><a class="dropdown-item" href="#">Gerar boleto/débito avulso</a></li>
                    <li><a class="dropdown-item" href="#">Consultar boletos</a></li>
                    <li><a class="dropdown-item" href="#">Consumo de produtos</a></li>
                    <li><a class="dropdown-item" href="#">Ordem de desconto</a></li>
                    <li><a class="dropdown-item" href="#">Enviar boletos por e-mail</a></li>
                </ul>
            </li>   
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relatórios</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">                    
                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Cadastro</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Aniversariantes do mês sócios</a></li>
                            <li><a class="dropdown-item" href="#">Dados de Cobrança</a></li>
                        </ul>
                    </li>                    
                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Cobranças</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Débitos dos sócios</a></li>
                            <li><a class="dropdown-item" href="#">Débitos dos sócios agrupados por mês</a></li>
                        </ul>
                    </li>               
                </ul>
            </li> 

            <li class="nav-item">
                <a class="nav-link <?php echo $disabled_hospe;?>" href="/view/booking_calendar.php">Hospedagem</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link <?php echo $disabled_hospe;?>" href="#">Usuário</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link<?php echo $disabled_manut;?>" href="#">Manutenção</a>
            </li>            
        </ul>        
        <a class="btn btn-outline-primary" href="">Sign up</a>
  </div>
</nav>