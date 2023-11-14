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
//	header("Location: ");
//	exit;
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
                            .estrelas_<?php echo $curso['id']; ?>{
                                display: flex;
                                font-size: 25px;
                                align-items: center;
                                justify-content: center;
                            }

                            .estrelas_<?php echo $curso['id']; ?> input[type=radio] {
                                display: none;
                            }

                            .estrelas_<?php echo $curso['id']; ?> label i.fa:before {
                                content: '\f005';
                                color: #FC0;
                            }

                            .estrelas_<?php echo $curso['id']; ?> input[type=radio]:checked ~ label i.fa:before {
                                color: #CCC;
                            }
                        </style>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="estrelas_<?php echo $curso['id']; ?>">
								<?php
								// Verifica se há uma avaliação para o usuário atual no curso
								$curso_id = $curso['id'];
								$usuario_id = $_SESSION['usuario'];
								
								$avaliacao_existente_query = $mysqli->query("SELECT qnt_estrela FROM avaliacos WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'");
								
								if ($avaliacao_existente_query->num_rows > 0) {
									// Se houver uma avaliação existente, obtenha o valor de qnt_estrela
									$avaliacao_existente = $avaliacao_existente_query->fetch_assoc();
									$qnt_estrela = $avaliacao_existente['qnt_estrela'];
									
									// Exibe as estrelas de acordo com o valor de qnt_estrela
									for ($i = 1; $i <= 5; $i++) {
										echo '<input type="radio" id="estrela' . $i . $curso_id . '" name="estrela" value="' . $i . '"';
										if ($i == $qnt_estrela) {
											echo ' checked';
										}
										echo '>';
										echo '<label for="estrela' . $i . $curso_id . '"><i class="fa"></i></label>';
									}
								} else {
									// Se não houver avaliação existente, exibe estrelas padrão
									for ($i = 1; $i <= 5; $i++) {
										echo '<input type="radio" id="estrela' . $i . $curso_id . '" name="estrela" value="' . $i . '">';
										echo '<label for="estrela' . $i . $curso_id . '"><i class="fa"></i></label>';
									}
								}
								?>
                                <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
                                <input type="submit" class="btn btn-primary btn-round" value="Avaliar" style="margin-left: 5%">
                            </div>
                        </form>
						
						<?php
						$query_avaliacao = $mysqli->query("SELECT * FROM avaliacos WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'");
						
						if ($query_avaliacao === false) {
							// Verifique se a consulta falhou
							echo "Erro na consulta SQL: " . $mysqli->error;
						} else {
							if ($query_avaliacao->num_rows > 0) {
								// Se o usuário já avaliou o curso, exiba a avaliação existente para edição
								$avaliacao_existente = $query_avaliacao->fetch_assoc();
								$avaliacao_atual = $avaliacao_existente['qnt_estrela'];
								?>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
										<?php
										$query_avaliacao = $mysqli->query("SELECT * FROM avaliacos WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'");
										$avaliacao_atual = isset($query_avaliacao) ? $query_avaliacao->fetch_assoc()['qnt_estrela'] : null;
										?>

                                        // Se houver uma avaliação armazenada no banco de dados, defina a estrela correspondente como selecionada
                                        var avaliacaoAtual = <?php echo isset($avaliacao_atual) ? $avaliacao_atual : 'null'; ?>;
                                        var cursoId = '<?php echo $curso_id; ?>';
                                        var estrelasContainer = document.querySelector('.estrelas_' + cursoId);

                                        if (avaliacaoAtual !== null) {
                                            estrelasContainer.classList.add('rated-' + avaliacaoAtual);
                                        }

                                        // Adicione um evento de clique às estrelas para atualizar o valor
                                        estrelasContainer.addEventListener('click', function (event) {
                                            if (event.target.matches('input[name="estrela"]')) {
                                                var novaAvaliacao = event.target.value;

                                                // Atualize a avaliação no banco de dados
                                                fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                                                    method: 'POST',
                                                    body: new URLSearchParams({
                                                        estrela: novaAvaliacao,
                                                        curso_id: cursoId
                                                    }),
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                    }
                                                }).then(response => response.json())
                                                    .then(data => {
                                                        console.log(data);
                                                        estrelasContainer.classList.remove('rated-1', 'rated-2', 'rated-3', 'rated-4', 'rated-5');
                                                        if (novaAvaliacao !== null) {
                                                            estrelasContainer.classList.add('rated-' + novaAvaliacao);
                                                        }
                                                    })
                                                    .catch(error => console.error('Erro:', error));
                                            }
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