<?php

include ('lib/conexao.php');
include ('lib/protect.php');
protect(0);

if (!isset($_SESSION))
    session_start();

$pagina = "inicial.php";
if (isset($_GET['p'])) {
    $pagina = $_GET['p'] . ".php";
}
$id_usuario = $_SESSION['usuario'];
$sql_query_admin = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id_usuario'") or die($mysqli->error);
$dados_usuario = $sql_query_admin->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>THE NEW SCHOOl </title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
          content="flat ui, admin  Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- referencia para os icones de sol e lua serem bem carregados -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<!-- aqui se inicia o style de tudo que fiz botão de mudança de tema e imagem de fundo --> 
    <style>

        .checkbox {
        opacity: 0;
        position: absolute;
        }

        .label {
        background-color: #111;
        border-radius: 50px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 5px;
        position: relative;
        height: 26px;
        width: 50px;
        transform: scale(1);
        margin-top: 28px;
        }


        .label .ball {
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        height: 22px;
        width: 22px;
        transform: translateX(0px);
        transition: transform 0.2s linear;
        }

        .checkbox:checked + .label .ball {
        transform: translateX(24px);
        } 

        .fa-moon {
        color: #f1c40f;
        }

        .fa-sun {
        color: #f39c12;
        }
        .theme-loader{
            background-color:#B5BEC6
        }
    </style>

<!-- script para usar o Glanguage para tradução -->
<script>window.gtranslateSettings = {"default_language":"pt","languages":["pt","en"],"wrapper_selector":".gtranslate_wrapper","alt_flags":{"en":"usa","pt":"brazil"}}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/flags.js" defer></script>
</head>

<body data-translate>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="ti-menu"></i>
                    </a>
                    <a class="mobile-search morphsearch-search" href="#!">
                        <i class="ti-search"></i>
                    </a>
                    <a href="index.php?p=inicial">
                        <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo"/>
                    </a>
                    <a class="mobile-options">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                        </li>
                    </ul>
                    

                    <ul class="nav-right">  
                    <!-- bloco de traduçao da pagina -->
                        <li>
                            <div class="gtranslate_wrapper"></div>
                        </li>
                        <!-- fim do bloco de tradução -->

                        <!-- botao da mudança de tema  -->
                        <li class="">
                            <div>
                            <input type="checkbox" class="checkbox" id="chk" />
                                <label class="label" for="chk">
                                    <i class="fas fa-sun"></i>
                                    <i class="fas fa-moon"></i>
                                    <div class="ball"></div>
                                </label>
                            </div>
                        </li>
                        <!-- fim do botao de mudança de tema -->
                        
                        <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { ?>
                        <li class="header-notification">
                            <a href="#!">
                                <i class="ti-money"></i>
                                <span class="badge bg-c-pink"></span> <?php echo number_format($dados_usuario['creditos'], 2, ',', '.');?>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="user-profile header-notification">
                            <a href="#!">
                                <span><?php echo $dados_usuario['nome'];?></span>
                                <i class="ti-angle-down"></i>
                            </a>
                            <ul class="show-notification profile-notification">
                                <li>
                                    <a href="index.php?p=perfil">
                                        <i class="ti-user"></i> Perfil
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php">
                                        <i class="ti-layout-sidebar-left"></i> Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="">
                            <div class="main-menu-content">
                                <ul>
                                    <li class="more-details">
                                        <a href="#"><i class="ti-user"></i>View Profile</a>
                                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                                        <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { ?>
                        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="">
                                <a href="index.php">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?p=loja_cursos">
                                    <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Loja de Cursos</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?p=meus_cursos">
                                    <span class="pcoded-micon"><i class="ti-control-play"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Meus Cursos</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="logout.php">
                                    <span class="pcoded-micon"><i class="ti-arrow-left"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <?php }else { ?>
                        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms" menu-title-theme="theme1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Menu</font></font></div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="">
                                <a href="index.php">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Página Inicial</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?p=gerenciar_cursos">
                                    <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Cursos</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?p=gerenciar_usuarios">
                                    <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Gerenciar Usuario</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?p=relatorio">
                                    <span class="pcoded-micon"><i class="ti-files"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Relatórios</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="logout.php">
                                    <span class="pcoded-micon"><i class="ti-arrow-left"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Sair</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <?php } ?>
                    </div>
                </nav>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">
                                <?php include('pages/' . $pagina); ?>
                            </div>
                        </div>
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="assets/js/classie/classie.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/js/script.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>


<!-- inicio do script do tema -->
<script type="text/javascript">
    function toggleTheme() {
        console.log("toggleTheme chamada");

        var currentTheme = localStorage.getItem('theme');
        var newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        var layout = $('.pcoded').attr("layout-type");
        if (layout === 'dark') {
            $('.pcoded').attr("layout-type", "light");
            $('.pcoded-header').attr("header-theme", "theme1");
            $('.pcoded-navbar').attr("navbar-theme", "themelight1");
            $('.navbar-logo').attr("logo-theme", "theme3");
            $('.pcoded-navbar').css("color", "#000");
            $('.main-body .page-wrapper .page-header-title h4').css('color', '#303548');//cor do titulo que nao muda com essa funçao por isso adicionei essa que muda diretamente 
            $('span').css('color', '#303548');
            $('a').css('color', '#303548');
            $('ul.show-notification.profile-notification a').css('color','#303548');
            $('.btn-inverse').removeClass('btn-inverse').addClass('btn-white');
            localStorage.setItem('theme', 'light'); // Armazena o tema no localStorage
        } else {
            $('.pcoded').attr("layout-type", "dark");
            $('.pcoded-header').attr("header-theme", "theme6");
            $('.pcoded-navbar').attr("navbar-theme", "theme1");
            $('.navbar-logo').attr("logo-theme", "theme6");
            $('.pcoded-navbar').css("color", "#fff");
            $('.main-body .page-wrapper .page-header-title h4').css('color', '#fff');
            $('span').css('color', '#fff');
            $('a').css('color', '#ffffff');
            $('ul.show-notification.profile-notification a').css('color','#303548');
            $('.btn-white').removeClass('btn-white').addClass('btn-inverse');
            localStorage.setItem('theme', newTheme);

        }
        
    }

    function applyTheme() {
    var currentTheme = localStorage.getItem('theme');
    var layout = $('.pcoded').attr("layout-type");
    
    if (currentTheme === 'dark') {
        $('.pcoded').attr("layout-type", "dark");
        $('.pcoded-header').attr("header-theme", "theme6");
        $('.pcoded-navbar').attr("navbar-theme", "theme1");
        $('.navbar-logo').attr("logo-theme", "theme6");
        $('.pcoded-navbar').css("color", "#fff");
        $('.main-body .page-wrapper .page-header-title h4').css('color', '#fff');
        $('span').css('color', '#fff');
        $('a').css('color', '#ffffff');
        $('ul.show-notification.profile-notification a').css('color','#303548');
        $('.btn-white').removeClass('btn-white').addClass('btn-inverse');
    } else {
        $('.pcoded').attr("layout-type", "light");
        $('.pcoded-header').attr("header-theme", "theme1");
        $('.pcoded-navbar').attr("navbar-theme", "themelight1");
        $('.navbar-logo').attr("logo-theme", "theme3");
        $('.pcoded-navbar').css("color", "#000");
        $('.main-body .page-wrapper .page-header-title h4').css('color', '#303548');
        $('span').css('color', '#303548');
        $('a').css('color', '#303548');
        $('ul.show-notification.profile-notification a').css('color','#303548');
        $('.btn-inverse').removeClass('btn-inverse').addClass('btn-white');
    }

}

$(document).ready(function () {
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        applyTheme(); // Aplicar o tema salvo ao carregar a página
    }

    const chk = document.getElementById('chk');
        if (savedTheme) {
            document.body.classList.add(savedTheme); // Adiciona a classe do tema salvo ao corpo do documento
            chk.checked = savedTheme === 'dark'; // Marca o checkbox se o tema salvo for escuro
        }
        chk.addEventListener('change', () => {
        toggleTheme();
    });
});


</script>

<!-- fim do script do tema  -->
</body>

</html>
