<?php
// Incluir a conexão com o banco de dados
include('conexao.php');

// Inicializar uma variável para armazenar a mensagem
$mensagem = "";
$mensagem_class = "";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $conteudo = $_POST['conteudo'];
    $url_imagem = isset($_POST['url']) ? $_POST['url'] : null; // Verifica se a URL foi preenchida

    // Preparar a query para inserir os dados
    $sql = "INSERT INTO noticias (titulo, autor, categoria, conteudo, url_imagem)
            VALUES (?, ?, ?, ?, ?)";

    // Preparar a instrução para evitar SQL Injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $titulo, $autor, $categoria, $conteudo, $url_imagem);

        // Executar a query
        if ($stmt->execute()) {
            $mensagem = "Notícia publicada com sucesso!";
            $mensagem_class = "success"; // Cor verde
        } else {
            $mensagem = "Erro ao publicar a notícia: " . $stmt->error;
            $mensagem_class = "error"; // Cor vermelha
        }

        // Fechar a instrução
        $stmt->close();
    } else {
        $mensagem = "Erro ao preparar a query: " . $conn->error;
        $mensagem_class = "error"; // Cor vermelha
    }

    // Fechar a conexão
    $conn->close();

    // Redirecionar para a página do formulário com a mensagem de resultado
    header("Location: criar-noticia.php?mensagem=$mensagem&mensagem_class=$mensagem_class");
    exit();
}
?>