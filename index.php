<?php
// Conexão com o banco de dados.
require_once "connect.php";

session_start();
if (empty($_SESSION["user"])) {
    header('Location: login.php');
}

// Recupera os nomes dos coordenadores
$stmt = $pdo->query('SELECT * FROM coordinators ORDER BY name');
$coordinators = $stmt->fetchAll();

// Recupera os nomes os minicursos.
$stmt = $pdo->query('SELECT * FROM courses INNER JOIN coordinators ON courses.coordinator_id = coordinators.id ORDER BY begin');
$courses = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <!-- Meta tag's -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Spectre CSS -->
    <link rel="stylesheet" href="css/spectre.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Default CSS -->
    <link rel="stylesheet" href="css/default.css">
</head>
<body>
<div class="empty">
    <div class="columns" style="align-items: center">
        <div class="column col-6  col-xs-12 col-sm-12 col-md-12">
            <h1 class="animated flipInX empty-title">Futxicaidada Tecnológica</h1>
        </div>
        <div class="animated fadeIn column col-6 col-xs-12 col-sm-12 col-md-12">
            <div class="empty-icon">
                <object class="empty-icon-brand" type="image/svg+xml" data="svg/brand.svg"></object>
            </div>
            <p class="empty-subtitle">Bem vindo <?php echo $_SESSION['user']['name'] ?></p>
            <p class="empty-subtitle">Clique no botão abaixo para cadastrar um novo minicurso</p>
            <div class="empty-action">
                <a class="btn btn-error" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <!-- Menu -->
    <ul class="tab">
        <li class="tab-item active">
            <a class="badge badge" href="javascript:void(0)" data-badge="999">Próximos minicursos</a>
        </li>
        <li class="tab-item">
            <a href="javascript:void(0)">Anteriores</a>
        </li>
        <li class="tab-item">
            <a id="new" href="javascript:void(0)">Adicionar minicurso</a>
        </li>
    </ul>
    <!-- Lista de minicursos -->
    <?php foreach ($courses as $course): ?>
        <div class="tile">
            <div class="tile-icon">
                <object class="example-tile-icon" type="image/svg+xml" data="svg/user%20(1).svg"></object>
            </div>
            <div class="tile-content">
                <p class="tile-title"><?= $course['title'] ?></p>
                <p class="tile-title"><?= $course['description'] ?></p>
                <p class="tile-subtitle text-gray"><?= $course['about'] ?></p>
            </div>
            <div class="tile-action">
                <button class="btn btn-success" data-course="<?= $course['id'] ?>">Atualizar</button>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- Formulário de cadastro de minicurso -->
    <div class="modal active new" id="modal-id">
        <a href="javascript:void(0)" class="modal-overlay" aria-label="Close"></a>
        <div class="modal-container">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn btn-clear float-right" aria-label="Close"></a>
                <div class="modal-title h5">Adicionar novo minicurso</div>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="form-horizontal" method="post" action="">

                        <!-- Título -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="title">Título</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="title" name="title" type="text" placeholder="Name">
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="description">Descrição</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="description" name="description" type="text"
                                       placeholder="Descrição">
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="address">Endereço</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="address" name="address" type="text"
                                       placeholder="Endereço">
                            </div>
                        </div>

                        <!-- Data e horário -->
                        <div class="form-group">
                            <!-- Início -->
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="begin">Data e hora</label>
                            </div>
                            <div class="col-3 col-sm-12">
                                <input class="form-input" id="begin" name="begin" type="text"
                                       placeholder="Data e hora de início">
                            </div>
                            <!-- Termino -->
                            <div class="col-1 col-sm-12 col-ml-auto">
                                <label class="form-label" for="finish">Até</label>
                            </div>
                            <div class="col-3 col-sm-12 col-ml-auto">
                                <input class="form-input" id="finish" name="finish" type="text"
                                       placeholder="Data e hora do termino">
                            </div>
                        </div>

                        <!-- Coordenador -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label">Coordenador</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <select class="form-select select-lg" name="coordinator_id">
                                    <?php if ($coordinators): ?>
                                        <?php foreach ($coordinators as $coordinator): ?>
                                            <option value="<?= $coordinator['id'] ?>"><?= $coordinator['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>

                        <!-- Publicar -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label">Publicar?</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <label class="form-radio">
                                    <input type="radio" name="published" value="1">
                                    <i class="form-icon"></i> Publicar
                                </label>
                                <label class="form-radio">
                                    <input type="radio" name="published" value="0" checked="">
                                    <i class="form-icon"></i> Salvar em rascunho
                                </label>
                            </div>
                        </div>


                        <!-- Sobre -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="about">Sobre</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <textarea class="form-input" id="about" name="about"
                                          placeholder="Digite mais informações sobre o minicurso"
                                          rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-3 col-sm-12"></div>
                            <div class="col-9 col-sm-12">
                                <button class="btn" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                ...
            </div>
        </div>
    </div>
</div>
<!-- Jquery -->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Jquery Mask Plugin -->
<script src="js/jquery.mask.min.js"></script>
<!-- Faker JS -->
<script src="js/faker.min.js"></script>
<!-- Default JS -->
<script src="js/default.js"></script>
</body>
</html>