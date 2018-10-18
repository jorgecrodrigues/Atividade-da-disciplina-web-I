<?php
// Conexão com o banco de dados.
require_once "connect.php";

session_start();
if(empty($_SESSION["user"])) {
    header('Location: login.php');
}


print_r($_SESSION);

$stmt = $pdo->query('SELECT * FROM authors');
while ($row = $stmt->fetch()) {
    echo $row['author_name'] . "\n";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>