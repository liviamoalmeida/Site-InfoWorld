<?php
// Função para formatar a categoria
function formatarCategoria($categoria)
{
  // Substitui underscores por espaços
  $categoria = str_replace('_', ' ', $categoria);

  // Coloca a primeira letra de cada palavra em maiúscula
  $categoria = ucwords($categoria);

  return $categoria;
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
            <li class="list-inline-item"><a href="login.php">Área da Administração</a></li>          
        </div>
    </div>
    </nav>
    </div>
  </header>
  <!-- /navigation -->

  <!-- start of banner -->
  <div class="banner text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto">
          <h1 class="mb-5">O que você gostaria <br> de ler hoje?</h1>
          <ul class="list-inline widget-list-inline">
            <li class="list-inline-item"><a href="tags.php?categoria=Cinema">Cinema</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Esportes">Esportes</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Estilo_de_Vida">Estilo de Vida</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Famosos">Famosos</a></li><br>
            <li class="list-inline-item"><a href="tags.php?categoria=Jogos_Digitais">Jogos Digitais</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Meio_Ambiente">Meio Ambiente</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Música">Música</a></li>
            <li class="list-inline-item"><a href="tags.php?categoria=Tecnologia">Tecnologia</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end of banner -->

  <section class="section pb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-5">
          <?php
          // Conexão com o banco de dados
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "test";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
          }

          // Consulta para buscar uma notícia recomendada
          $sql = "SELECT id, titulo, autor, categoria, conteudo, url_imagem, data_publicacao 
        FROM noticias 
        WHERE recomendada = 1 
        ORDER BY data_publicacao DESC 
        LIMIT 1";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $noticia = $result->fetch_assoc();
            ?>
            <h2 class="h5 section-title">Recomendados</h2>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="<?= htmlspecialchars($noticia['url_imagem']) ?>" class="card-img-top" alt="Imagem da notícia">
              </div>

              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="post-details.php?id=<?= $noticia['id'] ?>">
                    <?= htmlspecialchars(substr($noticia['titulo'], 0, 30)) ?>...</p>

                  </a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="#" class="card-meta-author">
                      <img src="images/author.jpg" alt="<?= htmlspecialchars($noticia['autor']) ?>">
                      <span><?= htmlspecialchars($noticia['autor']) ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"></i>
                    <?= date('d M, Y', strtotime($noticia['data_publicacao'])) ?>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item">
                          <a href="tags.php?categoria=<?= urlencode($noticia['categoria']) ?>">
                            <?= htmlspecialchars(ucwords(str_replace('_', ' ', $noticia['categoria']))) ?>
                          </a>
                        </li>
                      </ul>

                    </ul>
                  </li>
                </ul>
                <p><?= htmlspecialchars(substr($noticia['conteudo'], 0, 50)) ?>...</p>
                <a href="post-details.php?id=<?= $noticia['id'] ?>" class="btn btn-outline-primary">Leia Mais</a>
              </div>
            </article>
            <?php
          } else {
            echo "<p>Nenhuma notícia recomendada encontrada.</p>";
          }

          $conn->close();
          ?>

        </div>
        <div class="col-lg-4 mb-5">
          <h2 class="h5 section-title">Tendências</h2>
          <?php
          // Conexão com o banco
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "test";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
          }

          // Consulta para buscar as 3 notícias mais populares
          $sql = "SELECT id, titulo, url_imagem, data_publicacao 
            FROM noticias 
            ORDER BY visualizacoes DESC 
            LIMIT 3";
          $result = $conn->query($sql);

          if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()): ?>
              <article class="card mb-4">
                <div class="card-body d-flex">
                  <img class="card-img-sm" src="<?= htmlspecialchars($row['url_imagem']) ?>" alt="Imagem da notícia">
                  <div class="ml-3">
                    <h4>
                      <a href="post-details.php?id=<?= $row['id'] ?>" class="post-title">
                        <?= htmlspecialchars(strlen($row['titulo']) > 15 ? substr($row['titulo'], 0, 15) . '...' : $row['titulo']) ?>
                      </a>

                    </h4>
                    <ul class="card-meta list-inline mb-0">
                      <li class="list-inline-item mb-0">
                        <i class="ti-calendar"></i>
                        <?= date('d M, Y', strtotime($row['data_publicacao'])) ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </article>
            <?php endwhile;
          else: ?>
            <p>Nenhuma notícia encontrada.</p>
          <?php endif;

          $conn->close();
          ?>
        </div>


        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Conexão falhou: " . $conn->connect_error);
        }

        // Consulta para buscar uma notícia (sem filtro de recomendada)
        $sql = "SELECT id, titulo, autor, categoria, conteudo, url_imagem, data_publicacao 
        FROM noticias 
        ORDER BY data_publicacao DESC 
        LIMIT 1";  // Ou outro critério que você deseje para pegar uma notícia diferente
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $noticia = $result->fetch_assoc();
          ?>
          <div class="col-lg-4 mb-5">
            <h2 class="h5 section-title">Popular</h2>
            <article class="card">
              <div class="post-slider slider-sm">
                <img src="<?= htmlspecialchars($noticia['url_imagem']) ?>" class="card-img-top" alt="Imagem da notícia">
              </div>
              <div class="card-body">
                <h3 class="h4 mb-3">
                  <a class="post-title" href="post-details.php?id=<?= $noticia['id'] ?>">
                    <?= htmlspecialchars(substr($noticia['titulo'], 0, 55)) ?>...
                  </a>
                </h3>
                <ul class="card-meta list-inline">
                  <li class="list-inline-item">
                    <a href="#" class="card-meta-author">
                      <img src="images/author.jpg" alt="<?= htmlspecialchars($noticia['autor']) ?>">
                      <span><?= htmlspecialchars($noticia['autor']) ?></span>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <i class="ti-calendar"></i>
                    <?= date('d M, Y', strtotime($noticia['data_publicacao'])) ?>
                  </li>
                  <li class="list-inline-item">
                    <ul class="card-meta-tag list-inline">
                      <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item">
                          <a href="tags.php?categoria=<?= urlencode($noticia['categoria']) ?>">
                            <?= htmlspecialchars(ucwords(str_replace('_', ' ', $noticia['categoria']))) ?>
                          </a>
                        </li>
                      </ul>

                    </ul>
                  </li>
                </ul>
                <p><?= htmlspecialchars(substr($noticia['conteudo'], 0, 50)) ?>...</p>
                <a href="post-details.php?id=<?= $noticia['id'] ?>" class="btn btn-outline-primary">Leia Mais</a>
              </div>
            </article>
          </div>
          <?php
        } else {
          echo "<p>Nenhuma notícia encontrada.</p>";
        }

        $conn->close();
        ?>


      </div>
      <div class="col-12">
        <div class="border-bottom border-default"></div>
      </div>
    </div>
    </div>
  </section>
  <?php
  // Conexão com o banco
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
  }

  // Consulta para buscar as 3 notícias mais recentes
  $sql = "SELECT id, titulo, autor, categoria, conteudo, url_imagem, data_publicacao 
        FROM noticias 
        ORDER BY data_publicacao DESC 
        LIMIT 3";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0): ?>
    <section class="section-sm">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-5 mb-lg-0">
            <h2 class="h5 section-title">Recentes</h2>
            <?php while ($row = $result->fetch_assoc()): ?>
              <article class="card mb-4">
                <div class="post-slider">
                  <img src="<?= htmlspecialchars($row['url_imagem']) ?>" class="card-img-top" alt="Imagem da notícia">
                </div>
                <div class="card-body">
                  <h3 class="mb-3">
                    <a class="post-title" href="post-details.php?id=<?= $row['id'] ?>">
                      <?= htmlspecialchars($row['titulo']) ?>
                    </a>
                  </h3>
                  <ul class="card-meta list-inline">
                    <li class="list-inline-item">
                      <a href="#" class="card-meta-author">
                        <img src="images/author.jpg" alt="<?= htmlspecialchars($row['autor']) ?>">
                        <span><?= htmlspecialchars($row['autor']) ?></span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <i class="ti-calendar"></i>
                      <?= date('d M, Y', strtotime($row['data_publicacao'])) ?>
                    </li>
                    <li class="list-inline-item">
                      <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item">
                          <a href="#"><?= formatarCategoria(htmlspecialchars($row['categoria'])) ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <p><?= htmlspecialchars(substr($row['conteudo'], 0, 150)) ?>...</p>
                  <a href="post-details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary">Leia Mais</a>
                </div>
              </article>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
    <p class="text-center">Nenhuma notícia encontrada.</p>
  <?php endif;

  $conn->close();
  ?>

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

</html>