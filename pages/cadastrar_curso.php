<?php

include ('lib/conexao.php');
include ('lib/upload.php');
include ('lib/protect.php');
protect(1);

if (isset($_POST['enviar'])){
    $titulo = $mysqli->real_escape_string($_POST['titulo']);
    $descricao_curta = $mysqli->real_escape_string($_POST['descricao_curta']);
    $preco = $mysqli->real_escape_string($_POST['preco']);
    $conteudo = $mysqli->real_escape_string($_POST['conteudo']);

    $erro = array();
    if (empty($titulo))
        $erro[] = "Preencha o titulo";

    if (empty($descricao_curta))
        $erro[] = "Preencha a descrição curta";

    if (empty($preco))
        $erro[] = "Preencha o preço";

    if (empty($conteudo))
        $erro[] = "Preencha o conteúdo";

    if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0)
        $erro[] = "Selecione uma imagem para o conteúdo";

    if (count($erro) == 0){
        $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
            if ($deu_certo !== false){

                $sql = "INSERT INTO cursos ( titulo , descricao_curta , conteudo , data_cadastro , preco , imagem ) VALUES (
                    '$titulo',
                    '$descricao_curta',
                    '$conteudo',
                    NOW(),
                    '$preco' ,
                    '$deu_certo'
                    )";
                $inserido = $mysqli->query($sql);
                if (!$inserido)
                    $erro[] = "Falha ao inserir no banco dedados";
                else{
                    die("<script>location.href=\"index.php?p=gerenciar_cursos\";</script>");
                }

            }else
                $erro[] = "Falha ao enviar a imagem: " . $mysqli->error;
    }
}

?>
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="page-header-title">
                <i class="ti-bag bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Cadastrar Curso</h4>
                    <span>Preencha as informações e clique em salvar</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="index.php?p=gerenciar_cursos">Gerenciar Cursos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="index.php?p=cadastrar_curso">
                            Cadastrar Cursos
                        </a>
                    </li>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($erro) && count($erro) > 0){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($erro as $e) {echo "$e<br>";} ?>
                </div>
            <?php
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h5>Formulário de cadastro</h5>
                </div>
                <div class="card-block">
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Título</label>
                                    <input class="form-control" name="titulo" type="text">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Descrição Curta</label>
                                    <input class="form-control" name="descricao_curta" type="text">
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Imagem</label>
                                    <input class="form-control" name="imagem" type="file">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Preço</label>
                                    <input class="form-control" name="preco" type="text">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">contéudo</label>
                                    <textarea name="conteudo" class="form-control" rows="10" id=""></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a href="index.php?p=gerenciar_cursos" type="button" class="btn  btn-success btn-round"><i class="ti-arrow-left">
                                        Voltar</i></a>
                                <button name="enviar" value="1" type="submit" class="btn  btn-primary btn-round float-right"><i class="ti-save">
                                        Salvar</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>