<?php
// Conexão com o banco de dados.
require_once "connect.php";

session_start();
if (empty($_SESSION["user"])) {
    header('Location: login.php');
}
// print_r($_SESSION);
$stmt = $pdo->query('SELECT * FROM authors');
while ($row = $stmt->fetch()) {
    // echo $row['author_name'] . "\n";
}

// Recupera os nomes dos coordenadores
$stmt = $pdo->query('SELECT * FROM coordinators ORDER BY name');
$coordinators = $stmt->fetchAll();

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
                <button id="new" class="btn">Adicionar minicurso</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="columns">

    </div>

    <ul class="tab">
        <li class="tab-item active">
            <a class="badge" href="#tabs" data-badge="999">Próximos minicursos</a>
        </li>
        <li class="tab-item">
            <a href="#tabs">Anteriores</a>
        </li>
        <li class="tab-item">
            <a id="sync" href="#sync">Sincronizar</a>
        </li>
    </ul>

    <?php $courses = array(1, 2, 3) ?>
    <?php foreach ($courses as $course): ?>
        <div class="tile">
            <div class="tile-icon">
                <object class="example-tile-icon" type="image/svg+xml" data="svg/user%20(1).svg"></object>
            </div>
            <div class="tile-content">
                <p class="tile-title">The Avengers</p>
                <p class="tile-subtitle text-gray">
                    Earth's Mightiest Heroes joined forces to take on threats that were
                    too
                    big for any one hero to tackle...
                </p>
            </div>
            <div class="tile-action">
                <button class="btn btn-primary">Join</button>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Formulário de cadastro de minicurso -->
    <div class="modal new" id="modal-id">
        <a href="#close" class="modal-overlay" aria-label="Close"></a>
        <div class="modal-container">
            <div class="modal-header">
                <a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
                <div class="modal-title h5">Modal title</div>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="form-horizontal" action="#forms">
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="input-example-4">Name</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="input-example-4" type="text" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="input-example-5">Email</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <input class="form-input" id="input-example-5" type="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label">Gender</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <label class="form-radio">
                                    <input type="radio" name="gender"><i class="form-icon"></i> Male
                                </label>
                                <label class="form-radio">
                                    <input type="radio" name="gender" checked=""><i class="form-icon"></i> Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label">Source</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <select class="form-select select-lg">
                                    <?php if ($coordinators): ?>
                                        <?php foreach ($coordinators as $coordinator): ?>
                                            <option value="<?= $coordinator['id'] ?>"><?= $coordinator['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-9 col-sm-12 col-ml-auto">
                                <label class="form-switch">
                                    <input type="checkbox"><i class="form-icon"></i> Send me emails with news and tips
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3 col-sm-12">
                                <label class="form-label" for="input-example-6">Message</label>
                            </div>
                            <div class="col-9 col-sm-12">
                                <textarea class="form-input" id="input-example-6" placeholder="Textarea"
                                          rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-9 col-sm-12 col-ml-auto">
                                <label class="form-checkbox">
                                    <input type="checkbox"><i class="form-icon"></i> Remember me
                                </label>
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
<!-- Default JS -->
<script src="js/default.js"></script>
</body>
</html>