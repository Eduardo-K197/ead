<?php
    $msg = false;
    if (isset($_POST['email'])){
        include ('lib/conexao.php');
        include ('lib/generateRandomString.php');
        include ('lib/mail.php');

	    $email = $mysqli->real_escape_string($_POST['email']);
	    $sql_query = $mysqli->query("SELECT id, nome From usuarios WHERE email = '$email'");
        $result = $sql_query->fetch_assoc();

        if($result['id']){

	        $nova_senha = generateRandomString(6);
	        $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);;
            $id_usuario = $result['id'];
	        $mysqli->query("UPDATE usuarios SET senha = '$nova_senha_criptografada' WHERE id = '$id_usuario'");

            $destinatario = $email;
            $assunto = "Sua nova senha na plataforma EAD";
            $mensagemHTML = "<h1>Olá " . $result['nome'] . "</h1> <p>Uma nova senha foi definida para a sua conta.</p><p><b>Nova senha: </b>" . $nova_senha . "</p>";
            $nome_detino = $result['nome'];
            enviar_email($destinatario, $assunto, $mensagemHTML, $nome_detino);

	        $msg = "Se o seu e-mail existir no banco de dados, uma nova senha será enviada para ele.";
        }else{
            $msg = "Se o seu e-mail existir no banco de dados, uma nova senha será enviada para ele.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Esqueceu sua senha?</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
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
     <!-- referencia para os icones de sol e lua serem bem carregados -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<!-- style do botao de troca de tema e do background -->
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
    .common-img-bg {
         background-image: url('./assets/images/bg.jpg')!important;
         background-size:cover
    }
    .common-img-bg {
        height: 100%;
        position: fixed;
        width: 100%;
        min-height: 100vh;
    }
    .dark-mode .common-img-bg { 
        background-image: url('./bg2.avif')!important;
        background-size:cover!important;
        background-repeat: no-repeat!important;
    }




</style>
<!-- fim do style para a troca de tema  -->
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-dark common-img-bg"><!---aqui mudei o back ground da pagina de esqueci a senha -->
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form method="post" class="md-float-material">
                            <div class="text-center">
                                <img height="60" src="assets/images/auth/logo-dark.png" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Esqueceu sua senha?</h3>
                                    </div>
                                        <!-- botao da troca de tema  -->                                    
                                    <div>
                                            <input type="checkbox" class="checkbox" id="chk" />
                                                <label class="label" for="chk">
                                                    <i class="fas fa-sun"></i>
                                                    <i class="fas fa-moon"></i>
                                                    <div class="ball"></div>
                                                </label>
                                            </div>
                                       <!-- fim do botao troca de tema -->
                                </div>
                                <hr/>
	                            <?php if($msg !== false) {
		                            ?>
                                    <div class="alert alert-success" role="alert">
			                            <?php echo $msg;?>
                                    </div>
		                            <?php
	                            }
	                            ?>
                                <p style="color: black"><b>Digite seu e-mail e a senha será enviada para ele.</b></p>
                                <div class="input-group">
                                    <input name="email" type="email" class="form-control" placeholder="Seu endereço de email">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-12 col-xs-12 forgot-phone">
                                        <a href="login.php" class="text-right f-w-600 text-inverse"> Voltar</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-inverse btn-md btn-block waves-effect text-center m-b-20">Enviar minha senha</button> <!---cor do botao de enviar-->
                                    </div>
                                </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
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
    <script type="text/javascript" src="assets/js/common-pages.js"></script>
<!-- script da troca de tema para identificar qual o ultimo tema de preferenca que esta no local storage -->
    <script>
        $(document).ready(function() {
            // Verificar se o tema está salvo no localStorage
            if(localStorage.getItem('theme') === 'dark') {
                $('body').addClass('dark-mode');
                $('#chk').prop('checked', true); // Marcar o checkbox se o tema for escuro
            }

            // Adicionar ou remover a classe dark-mode ao clicar no checkbox
            $('#chk').change(function() {
                if (this.checked) {
                    $('body').addClass('dark-mode');
                    localStorage.setItem('theme', 'dark'); // Salvar tema no localStorage
                } else {
                    $('body').removeClass('dark-mode');
                    localStorage.setItem('theme', 'light'); // Salvar tema no localStorage
                }
            });
        });
    </script>
<!-- fim do script da troca de tema  -->
</body>

</html>
