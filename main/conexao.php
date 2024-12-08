<?php
// Dados de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";  // Alterar para o seu nome de usuário
$senha = "";        // Alterar para a sua senha
$banco = "test";    // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
