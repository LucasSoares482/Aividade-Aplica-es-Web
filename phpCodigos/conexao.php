<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistema_clientes";

try {
    $conexao = new \PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    echo "<div class='sucesso'>Conexão realizada com sucesso!</div>";
} catch(PDOException $e) {
    echo "<div class='erro'>Erro na conexão: " . $e->getMessage() . "</div>";
}
?>