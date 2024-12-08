<?php
// Inclui o arquivo de conexão com o banco de dados
require 'conexao.php';

// Recupera o ID da notícia via GET
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($post_id > 0) {
  // Consulta a notícia no banco de dados
  $sql = "SELECT id, titulo, autor, categoria, conteudo, url_imagem, data_publicacao FROM noticias WHERE id = $post_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $noticia = $result->fetch_assoc();
  } else {
    die("Notícia não encontrada.");
  }
} else {
  die("ID inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>InfoWorld - As notícias que você precisa saber</title>

  <!-- plugins -->

  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css" media="screen">

  <!--Favicon-->
  <link rel="icon" href="https://img.icons8.com/glyph-neue/64/e7272d/internet.png" type="image/png">

<body>
  <!-- navigation -->
  <header class="navigation fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="home.php">
          <h1 style="font-size: 25px;">InfoWorld</h1>
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="advertise.html">Anunciar</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contato</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="about-me.html">Nossa Equipe</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <!-- /navigation -->

  <div class="py-4"></div>
  <section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class=" col-lg-9   mb-5 mb-lg-0">
          <article>
            <!-- Imagem -->
            <div class="post-slider mb-4">
              <img src="<?php echo htmlspecialchars($noticia['url_imagem']); ?>" class="card-img"
                alt="Imagem da Notícia">
            </div>

            <!-- Título -->
            <h1 class="h2"><?php echo htmlspecialchars($noticia['titulo']); ?></h1>

            <!-- Autor, Data e Categoria -->
            <ul class="card-meta my-3 list-inline">
              <li class="list-inline-item">
                <a href="#" class="card-meta-author">
                  <span><?php echo htmlspecialchars($noticia['autor']); ?></span>
                </a>
              </li>
              <li class="list-inline-item">
                <i class="ti-calendar"></i>
                <?php echo isset($noticia['data_publicacao']) ? date("d/m/Y", strtotime($noticia['data_publicacao'])) : "Data não disponível"; ?>
              </li>
              <li class="list-inline-item">
                <ul class="card-meta-tag list-inline">
                  <li class="list-inline-item">
                    <a href="tags.php?categoria=<?php echo urlencode($noticia['categoria']); ?>">
                      <?php
                      // Formata a categoria: Substitui "_" por espaço e transforma a inicial de cada palavra em maiúscula
                      echo htmlspecialchars(ucwords(str_replace('_', ' ', $noticia['categoria'])));
                      ?>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>

            <!-- Conteúdo -->
            <div class="content">
              <?php echo nl2br(htmlspecialchars($noticia['conteudo'])); ?>
            </div>
          </article>
        </div>

        <?php
        // Conectar ao banco de dados
        include('conexao.php');

        // Em vez de $_GET['post_id'], use $_GET['id']
        if (isset($_GET['id'])) {
          $post_id = $_GET['id']; // Agora, o código vai pegar o 'id' da URL
        } else {
          echo "Erro: ID do post não fornecido!";
          exit; // Se o 'id' não for passado na URL, o script será interrompido
        }


        // Se o formulário for enviado, insere o comentário no banco
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $nome = $_POST['nome'];
          $email = $_POST['email'];
          $comentario = $_POST['comentario'];

          // Evitar injeção de SQL
          $nome = mysqli_real_escape_string($conn, $nome);
          $email = mysqli_real_escape_string($conn, $email);
          $comentario = mysqli_real_escape_string($conn, $comentario);

          // Inserir comentário no banco de dados
          $sql = "INSERT INTO comentarios (noticia_id, nome, email, comentario) 
            VALUES ('$post_id', '$nome', '$email', '$comentario')";

          if (mysqli_query($conn, $sql)) {
            $mensagem = "Comentário enviado com sucesso!";
          } else {
            $mensagem = "Erro ao enviar comentário: " . mysqli_error($conn);
          }
        }

        // Buscar os comentários existentes para o post
        $sql_comentarios = "SELECT * FROM comentarios WHERE noticia_id = '$post_id' ORDER BY data_comentario DESC";
        $resultado_comentarios = mysqli_query($conn, $sql_comentarios);
        ?>

        <div class="col-lg-9 col-md-12">
          <div class="mb-5 border-top mt-4 pt-5">
            <h3 class="mb-4">Comentários</h3>

            <?php
            // Exibir mensagens de sucesso ou erro
            if (isset($mensagem)) {
              echo "<div class='alert alert-info'>$mensagem</div>";
            }

            // Exibir os comentários
            while ($comentario = mysqli_fetch_assoc($resultado_comentarios)) {
              echo "
            <div class='media d-block d-sm-flex mb-4 pb-4'>
                <a class='d-inline-block mr-2 mb-3 mb-md-0' href='#'>
                    <img src='images/post/user-01.jpg' class='mr-3 rounded-circle' style='height:30px;' alt>
                </a>
                <div class='media-body'>
                    <a href='#' class='h4 d-inline-block mb-3'>{$comentario['nome']}</a>
                    <p>{$comentario['comentario']}</p>
                    <span class='text-black-800 mr-3 font-weight-600'>" . date('F j, Y \a\t h:i A', strtotime($comentario['data_comentario'])) . "</span>
                </div>
            </div>
            ";
            }
            ?>
          </div>

          <div>
            <h3 class="mb-4">Deixe uma resposta</h3>
            <form method="POST">
              <div class="row">
                <div class="form-group col-md-12">
                  <textarea class="form-control shadow-none" name="comentario" rows="7" required></textarea>
                </div>
                <div class="form-group col-md-6">
                  <input class="form-control shadow-none" type="text" name="nome" placeholder="Nome" required>
                </div>
                <div class="form-group col-md-6">
                  <input class="form-control shadow-none" type="email" name="email" placeholder="Email" required>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Comentar</button>
            </form>
          </div>
        </div>

      </div>
    </div>

    </div>
    </div>
  </section>

  <footer class="footer">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 text-center text-md-left mb-4">
          <ul class="list-inline footer-list mb-0">
            <li class="list-inline-item"><a href="privacy-policy.html">Política de Privacidade</a></li>
            <li class="list-inline-item"><a href="terms-conditions.html">Termos e Condições</a></li>
          </ul>
        </div>
        <div class="col-md-5 text-md-right text-center mb-4">
          <ul class="list-inline footer-list mb-0">

            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-instagram"></i></a></li>


            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

          </ul>
        </div>
        <div class="col-12">
          <div class="border-bottom border-default"></div>
        </div>
      </div>
    </div>
  </footer>
  <!-- JS Plugins -->
  <script src="plugins/jQuery/jquery.min.js"></script>

  <script src="plugins/bootstrap/bootstrap.min.js"></script>

  <script src="plugins/slick/slick.min.js"></script>

  <script src="plugins/instafeed/instafeed.min.js"></script>

  <!-- Main Script -->
  <script src="js/script.js"></script>
</body>

</html>