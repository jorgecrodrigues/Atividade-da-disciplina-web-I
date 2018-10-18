<?php
// Define o timezone
date_default_timezone_set('America/Cuiaba');
// Inicia a sessão.
session_start();
// Conexão com o banco de dados.
require_once "connect.php";
// Verifica se o usuário foi autenticado.
if (empty($_SESSION["user"])) {
    header('Location: login.php');
}
/**
 * Verifica se existem campos com valores
 *
 * @param $field
 * @return string
 */
function old($field)
{
    if ($_POST && array_key_exists($field, $_POST)) {
        return $_POST[$field];
    }
    return '';
}

// Recupera os nomes dos coordenadores
$stmt = $pdo->query('SELECT * FROM coordinators ORDER BY name');
$coordinators = $stmt->fetchAll();
// Recupera os nomes os minicursos.
$now = date('Y-m-d H:i');

if (key_exists('b', $_GET)) {
    $sql = "SELECT * FROM courses INNER JOIN coordinators ON courses.coordinator_id = coordinators.id WHERE finish <= :now";
} else {
    $sql = "SELECT * FROM courses INNER JOIN coordinators ON courses.coordinator_id = coordinators.id WHERE finish >= :now";
}
$stmt = $pdo->prepare($sql);
$stmt->execute(['now' => $now]);
$courses = $stmt->fetchAll();

// Salva um minicurso.
if ($_POST) {
    // Faz a validação dos campos
    $fields = [
        'title', 'description', 'address', 'begin', 'finish', 'coordinator_id', 'published', 'about'
    ];
    foreach ($fields as $field) {
        if (!array_key_exists($field, $_POST)) {
            $error = "O campo $field é obrigatório";
            // $error = "Todos os campos são obrigatórios";
            break;
        }
    }
    // CONVERTE AS DATAS
    $_POST['begin'] = date_create_from_format('d/m/Y H:i', $_POST['begin'])->format('Y-m-d H:i:s');
    $_POST['finish'] = date_create_from_format('d/m/Y H:i', $_POST['finish'])->format('Y-m-d H:i:s');

    $data = $_POST;
    if (!isset($error)) {
        try {
            $sql = "INSERT INTO courses (title, description, address, begin, finish, coordinator_id, published, about) VALUES (:title, :description, :address, :begin, :finish, :coordinator_id, :published, :about)";
            $pdo->prepare($sql)->execute($data);
        } catch (PDOException $exception) {

        }
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
}
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
        <?php if (key_exists('b', $_GET)): ?>
            <li class="tab-item">
                <a class="" href="?a">Próximos minicursos</a>
            </li>
            <li class="tab-item active">
                <a class="badge badge" href="javascript:void(0)" data-badge="<?= count($courses) ?>">
                    Anteriores
                </a>
            </li>
        <?php else: ?>
            <li class="tab-item active">
                <a class="badge badge" href="javascript:void(0)" data-badge="<?= count($courses) ?>">
                    Próximos minicursos
                </a>
            </li>
            <li class="tab-item">
                <a href="?b">Anteriores</a>
            </li>
        <?php endif; ?>
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
    <div class="modal new <?= isset($error) ? 'active' : '' ?>">
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
                                <input class="form-input" id="title" name="title" type="text" placeholder="Name"
                                       value="<?= old('title') ?>">
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="description">Descrição</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="description" name="description" type="text"
                                       placeholder="Descrição" value="<?= old('description') ?>">
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="address">Endereço</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="address" name="address" type="text"
                                       placeholder="Endereço" value="<?= old('address') ?>">
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
                                       placeholder="Data e hora de início" value="<?= old('begin') ?>">
                            </div>
                            <!-- Termino -->
                            <div class="col-1 col-sm-12 col-ml-auto">
                                <label class="form-label" for="finish">Até</label>
                            </div>
                            <div class="col-3 col-sm-12 col-ml-auto">
                                <input class="form-input" id="finish" name="finish" type="text"
                                       placeholder="Data e hora do termino" value="<?= old('finish') ?>">
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
                                            <option value="<?= $coordinator['id'] ?>"
                                                <?= old('coordinator_id') == $coordinator['id'] ? 'selected' : '' ?>>
                                                <?= $coordinator['name'] ?>
                                            </option>
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
                                          rows="3"><?= old('about') ?></textarea>
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
                <?php if (isset($error)): ?>
                    <div class="text-error text-center"><?= $error ?></div>
                <?php endif; ?>
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