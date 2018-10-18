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
    $sql = "SELECT * FROM courses INNER JOIN coordinators ON courses.coordinator_id = coordinators.id WHERE courses.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $course = $stmt->fetch();
    var_dump($course);
}
