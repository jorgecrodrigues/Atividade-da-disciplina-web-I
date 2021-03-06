<?php
/**
 * Created by PhpStorm.
 * User: Jorge Rodrigues
 * Date: 18/10/18
 * Time: 15:27
 */

// Conexão com o banco de dados.
require_once "connect.php";


if (key_exists('id', $_GET)) {
    // O identificador
    $id = ((int)$_GET['id']);
    // Procura um resgistro
    $sql = "SELECT courses.id, coordinator_id, title, description, address, begin , finish, about, published, name FROM courses INNER JOIN coordinators ON courses.coordinator_id = coordinators.id WHERE courses.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    // Recupera os nomes dos coordenadores
    $resultado = $pdo->query('SELECT * FROM coordinators ORDER BY name');
    $coordinators = $resultado->fetchAll();
}
?>
<?php foreach ($stmt as $course): ?>

    <input id="id" hidden value="<?= $course['id'] ?>">
    <!-- Título -->
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="title">Título</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" id="title" name="title" type="text" placeholder="Name"
                   value="<?= $course['title'] ?>">
        </div>
    </div>

    <!-- Descrição -->
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="description">Descrição</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" id="description" name="description" type="text"
                   placeholder="Descrição" value="<?= $course['description'] ?>">
        </div>
    </div>

    <!-- Endereço -->
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="address">Endereço</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" id="address" name="address" type="text"
                   placeholder="Endereço" value="<?= $course['address'] ?>">
        </div>
    </div>

    <!-- Data e horário -->
    <div class="form-group">
        <!-- Início -->
        <div class="col-3 col-sm-12">
            <label class="form-label" for="begin">Data e hora</label>
        </div>
        <div class="col-3 col-sm-12">
            <input class="form-input beginMask" id="begin" name="begin" type="text"
                   placeholder="Data e hora de início" value="<?= date('d/m/Y H:i', strtotime($course['begin'])) ?>">
        </div>
        <!-- Termino -->
        <div class="col-1 col-sm-12 col-ml-auto">
            <label class="form-label" for="finish">Até</label>
        </div>
        <div class="col-3 col-sm-12 col-ml-auto">
            <input class="form-input finishMask" id="finish" name="finish" type="text"
                   placeholder="Data e hora do termino"
                   value="<?= date('d/m/Y H:i', strtotime($course['finish'])) ?>">
        </div>
    </div>

    <!-- Coordenador -->
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label">Coordenador</label>
        </div>
        <div class="col-9 col-sm-12">
            <select id="coordinator_id" class="form-select select-lg" name="coordinator_id">
                <?php if ($coordinators): ?>
                    <?php foreach ($coordinators as $coordinator): ?>
                        <option value="<?= $coordinator['id'] ?>"
                            <?= $coordinator['id'] == $course['coordinator_id'] ? 'selected' : '' ?>>
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
                <input type="radio" name="published" value="1" <?= $course['published'] == 1 ? "checked" : "" ?>>
                <i class="form-icon"></i> Publicado
            </label>
            <label class="form-radio">
                <input type="radio" name="published" value="0" <?= $course['published'] == 0 ? "checked" : "" ?>>
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
                                          rows="3"><?= $course['about'] ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-3 col-sm-12"></div>
        <div class="col-9 col-sm-12">
            <button class="btn" type="submit">Salvar Alterações</button>
        </div>
    </div>
<?php endforeach; ?>
