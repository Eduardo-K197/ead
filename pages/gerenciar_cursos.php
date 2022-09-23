<?php
include ('lib/conexao.php');
include ('lib/protect.php');
protect(1);

$sql = "SELECT * FROM cursos";
$sql_query = $mysqli->query($sql) or dir($mysqli->error);
$num_cursos = $sql_query->num_rows;
?>
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ti-bag bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Gerenciar Cursos</h4>
                    <span>Gerencie os cursos cadastrados</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Gerenciar Cursos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Todos os Cursos</h5>
                    <span><a href="index.php?p=cadastrar_curso">Clique aqui</a>para cadastrar um curso</span>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Imagem</th>
                                <th>Titulo</th>
                                <th>Preço</th>
                                <th>Gerenciar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($num_cursos == 0) { ?>
                                <tr>
                                    <td colspan="5">Nenhum curso foi cadastrado</td>
                                </tr>
                            <?php } else {

                                while ($curso = $sql_query->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $curso['id'];?></th>
                                        <td><img src="<?php echo $curso['imagem'];?>" height="50" alt=""></td>
                                        <td><?php echo $curso['titulo'];?></td>
                                        <td>R$ <?php echo number_format($curso['preco'], 2, ',', '.');?></td>
                                        <td><a href="index.php?p=editar_curso&id=<?php echo $curso['id'];?>">Editar</a> <a href="index.php?p=deletar_curso&id=<?php echo $curso['id']; ?>">Deletar</a></td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>