<?php
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';
$mensagem_class = isset($_GET['mensagem_class']) ? $_GET['mensagem_class'] : '';

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
  <div class="header text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto">
          <h1 class="mb-4">Criar Notícia</h1>
          <ul class="list-inline">
            <li class="list-inline-item"><a class="text-default" href="home.php">Home
                &nbsp; &nbsp; /</a></li>
            <li class="list-inline-item text-primary">Criar Notícia</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <section class="section-sm">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">

          <div class="content mb-5">
            <h2 id="we-would-love-to-hear-from-you">Crie uma Nova
              Notícia...</h2>
            <p>Use o formulário abaixo para adicionar uma nova notícia ao
              InfoWorld. Informe todos os detalhes, como o título, conteúdo
              e a categoria da notícia. Ao enviar, a notícia será publicada
              no nosso site após revisão.</p>
          </div>

          <form method="POST" action="processar_noticia.php">
            <div class="form-group">
              <label for="title">Título da Notícia (Obrigatório)</label>
              <input type="text" name="titulo" id="title" class="form-control" placeholder="Título da Notícia" required>
            </div>
            <div class="form-group">
              <label for="author">Autor (Obrigatório)</label>
              <input type="text" name="autor" id="author" class="form-control" placeholder="Nome do Autor" required>
            </div>
            <div class="form-group">
              <label for="category">Categoria da Notícia
                (Obrigatório)</label>
              <select name="categoria" id="category" class="form-control" required>
                <option value="cinema">Cinema</option>
                <option value="esportes">Esportes</option>
                <option value="estilo_de_vida">Estilo de Vida</option>
                <option value="famosos">Famosos</option>
                <option value="jogos_digitais">Jogos Digitais</option>
                <option value="meio_ambiente">Meio Ambiente</option>
                <option value="musica">Música</option>
                <option value="tecnologia">Tecnologia</option>
              </select>
            </div>
            <div class="form-group">
              <label for="content">Conteúdo da Notícia (Obrigatório)</label>
              <textarea name="conteudo" id="content" class="form-control" rows="7"
                placeholder="Escreva o conteúdo da sua notícia..." required></textarea>
            </div>
            <div class="form-group">
              <label for="image">URL da Imagem (Obrigatório)</label>
              <input type="url" name="url" id="image" class="form-control" placeholder="URL da Imagem" required>
            </div>
            <button type="submit" class="btn btn-primary">Publicar
              Notícia</button>
          </form>
          <?php if ($mensagem): ?>
            <div class="popup <?php echo $mensagem_class; ?>" id="popupMessage">
              <?php echo $mensagem; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

  <footer class="footer" style="margin-bottom: 0px;">

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
<script>
  // Mostrar o pop-up após o carregamento da página
  window.onload = function () {
    var popup = document.getElementById("popupMessage");
    if (popup) {
      popup.style.display = "block"; // Exibe o pop-up

      // Esconde o pop-up após 5 segundos
      setTimeout(function () {
        popup.style.display = "none";
      }, 5000);
    }
  };
</script>

</html>