<?php
include("lib/conexao.php");

protect(0);

if (!isset($_SESSION)) {
	session_start();
}

$id_usuario = $_SESSION['usuario'];
$cursos_query = $mysqli->query("SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);

// Consulta para obter a média de estrelas para cada curso
$avaliacoes_query = $mysqli->query("SELECT curso_id, AVG(qnt_estrela) as media_estrelas FROM avaliacos GROUP BY curso_id") or die($mysqli->error);

// Criar um array associativo para armazenar as médias de estrelas por curso
$media_estrelas = [];
while ($row = $avaliacoes_query->fetch_assoc()) {
	$media_estrelas[$row['curso_id']] = $row['media_estrelas'];
}

if (!empty($_POST['estrela'])) {
	$estrela = $mysqli->real_escape_string($_POST['estrela']);
	$curso_id = $mysqli->real_escape_string($_POST['curso_id']);
	$usuario_id = $id_usuario;
	
	// Verificar se o usuário já avaliou o curso
	$avaliacao_existente_query = $mysqli->query("SELECT * FROM avaliacos WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'");
	
	if ($avaliacao_existente_query->num_rows > 0) {
		// Se o usuário já avaliou o curso, atualize a avaliação existente
		$mysqli->query("UPDATE avaliacos SET qnt_estrela = '$estrela' WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'");
	} else {
		// Caso contrário, insira uma nova avaliação
		$mysqli->query("INSERT INTO avaliacos (qnt_estrela, created, curso_id, usuario_id) VALUES ('$estrela', NOW(), '$curso_id', '$usuario_id')");
	}
	
	// Redirecione para evitar envios duplicados ao atualizar a página
	// header("Location: ".$_SERVER['PHP_SELF']);exit;
}

if (isset($_SESSION['msg'])) {
	echo $_SESSION['msg'] . "<br><br>";
	unset($_SESSION['msg']);
}
?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ti-control-play bg-c-green"></i>
                <div class="d-inline">
                    <h4>Meus Cursos</h4>
                    <span>Estes são os cursos que você já possui</span>
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
                    <li class="breadcrumb-item">Meus Cursos</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
	    <?php while ($curso = $cursos_query->fetch_assoc()) { ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo $curso['titulo']; ?></h5>
                    </div>
                    <div class="card-block">
                        <img src="<?php echo $curso['imagem']; ?>" class="img-fluid mb-3" alt="">
                        <p>
						    <?php echo $curso['descricao_curta']; ?>
                        </p>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                        <style>
                            .estrelas{
                                display: flex;
                                font-size: 25px;
                                align-items: center;
                                justify-content: center;
                            }

                            .estrelas input[type=radio] {
                                display: none;
                            }

                            .estrelas label i.fa:before {
                                content: '\f005';
                                color: #FC0;
                            }

                            .estrelas input[type=radio]:checked ~ label i.fa:before {
                                color: #CCC;
                            }
                        </style>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="estrelas">
                                <input type="radio" id="vazio<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="" checked>
                                <label for="estrela_um<?php echo $curso['id']; ?>"><i class="fa"></i></label>
                                <input type="radio" id="estrela_um<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="1">
                                <label for="estrela_dois<?php echo $curso['id']; ?>"><i class="fa"></i></label>
                                <input type="radio" id="estrela_dois<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="2">
                                <label for="estrela_tres<?php echo $curso['id']; ?>"><i class="fa"></i></label>
                                <input type="radio" id="estrela_tres<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="3">
                                <label for="estrela_quatro<?php echo $curso['id']; ?>"><i class="fa"></i></label>
                                <input type="radio" id="estrela_quatro<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="4">
                                <label for="estrela_cinco<?php echo $curso['id']; ?>"><i class="fa"></i></label>
                                <input type="radio" id="estrela_cinco<?php echo $curso['id']; ?>" name="estrela"<?php echo $curso['id']; ?> value="5">
                                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                            </div>
                            <input type="submit" class="btn form-control btn-primary btn-round" value="Avaliar">
                        </form>
					    <?php
					    $curso_id = $curso['id'];
					    $usuario_id = $_SESSION['usuario'];
					    $query_avaliacao = $mysqli->query("SELECT * FROM avaliacos WHERE curso_id = $curso_id AND usuario_id = $usuario_id");
					    
					    if ($query_avaliacao === false) {
						    // Verifique se a consulta falhou
						    echo "Erro na consulta SQL: " . $mysqli->error;
					    } else {
						    if ($query_avaliacao->num_rows > 0) {
							    // Se o usuário já avaliou o curso, exiba a avaliação existente para edição
							    $avaliacao_existente = $query_avaliacao->fetch_assoc();
							    $avaliacao_atual = $avaliacao_existente['qnt_estrela'];
							    ?>
                                
                                <script>// Verifica se a avaliação já está armazenada no localStorage
                                var avaliacaoAtual = localStorage.getItem('avaliacaoAtual<?php echo $curso['id']; ?>');
                                if (avaliacaoAtual !== null) {
                                    // Se a avaliação existe no localStorage, defina a estrela correspondente como selecionada
                                    document.querySelector('#vazio<?php echo $curso['id']; ?>').checked = true;
                                    document.querySelector('#estrela' + avaliacaoAtual + '<?php echo $curso['id']; ?>').checked = true;
                                    }
                                </script>

                                <script>
                                while true
                                 document.querySelectorAll('input[name="estrela<?php echo $curso['id']; ?>"]').forEach(function(input) {
                                    input.addEventListener('change', function() {
                                        var estrelaSelecionada = this.value;
                                        localStorage.setItem('avaliacaoAtual<?php echo $curso['id']; ?>', estrelaSelecionada);
                                    });
                                });
                                </script>

							    <?php
						    }
					    }
					    ?>
                        <form action="index.php">
                            <input type="hidden" name="p" value="acessar">
                            <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
                            <button type="submit" class="btn form-control btn-primary btn-round">Acessar</button>
                        </form>
                    </div>
                </div>
            </div>
	    <?php } ?>
    </div>
</div>