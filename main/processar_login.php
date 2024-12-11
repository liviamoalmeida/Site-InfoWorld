<?php
// Inicializar variáveis de mensagem
$mensagem = '';
$mensagem_class = '';

// Credenciais corretas
$login_correto = 'admin';
$senha_correta = '1234';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if ($login === $login_correto && $senha === $senha_correta) {
        // Login correto, redirecionar para a página de criação de notícias
        header('Location: criar-noticia.php');
        exit;
    } else {
        // Credenciais incorretas
        $mensagem = 'Login ou senha incorretos!';
        $mensagem_class = 'error';
    }
}

// Redirecionar de volta para a página de login com a mensagem de erro
header("Location: login.php?mensagem=" . urlencode($mensagem) . "&mensagem_class=$mensagem_class");
exit;
?>
