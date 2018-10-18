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
                <button class="btn">Send a message</button>
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
    </ul>

    <?php $courses = array(1, 2, 3) ?>
    <?php foreach ($courses as $course): ?>
        <div class="tile">
            <div class="tile-icon">
                <object class="example-tile-icon" type="image/svg+xml" data="svg/studying.svg"></object>
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
</div>
</body>
</html>