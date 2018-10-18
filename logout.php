<?php
/**
 * Created by PhpStorm.
 * User: Jorge Rodrigues
 * Date: 17/10/18
 * Time: 07:28
 */

session_start();

if (isset($_SESSION["user"]) && is_array($_SESSION["user"])) {
    // Apaga todas as variáveis da sessão
    $_SESSION = array();
    // Por último, destrói a sessão
    session_destroy();
}

header('Location: login.php');