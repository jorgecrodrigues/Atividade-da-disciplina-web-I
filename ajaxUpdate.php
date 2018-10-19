<?php
/**
 * Created by PhpStorm.
 * User: Jorge Rodrigues
 * Date: 18/10/18
 * Time: 18:27
 */

// Conexão com o banco de dados.
require_once "connect.php";


if ($_POST) {

    // CONVERTE AS DATAS
    $_POST['begin'] = date('Y-m-d H:i', strtotime($_POST['begin']));
    $_POST['finish'] = date('Y-m-d H:i', strtotime($_POST['finish']));

    $sql = "update courses set coordinator_id = :coordinator_id, title = :title, description = :description, address = :address, begin = :begin, about = :about, published = :published, finish = :finish where id = :id";
    $alteracao = $pdo->prepare($sql);
    $alteracao->bindValue(":id", $_POST['id']);
    $alteracao->bindValue(":coordinator_id", $_POST['coordinator_id']);
    $alteracao->bindValue(":title", $_POST['title']);
    $alteracao->bindValue(":description", $_POST['description']);
    $alteracao->bindValue(":address", $_POST['address']);
    $alteracao->bindValue(":begin", $_POST['begin']);
    $alteracao->bindValue(":finish", $_POST['finish']);
    $alteracao->bindValue(":about", $_POST['about']);
    $alteracao->bindValue(":published", $_POST['published']);
    $alteracao->execute();
}
?>