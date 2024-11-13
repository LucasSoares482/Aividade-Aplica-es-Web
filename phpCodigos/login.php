<?php
// conexao.php
$host = "localhost";
$dbname = "seu_banco";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// validar.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    if (empty($usuario) || empty($senha)) {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: index.php");
        exit();
    }
    
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'];
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['erro'] = "Usuário ou senha inválidos!";
        header("Location: index.php");
        exit();
    }
}