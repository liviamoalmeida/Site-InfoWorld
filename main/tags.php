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

if (isset($_GET['categoria'])) {
  $categoria = $conn->real_escape_string($_GET['categoria']);

  $sql = "SELECT id, titulo, autor, url_imagem, conteudo, data_publicacao 
          FROM noticias 
          WHERE categoria = '$categoria' 
          ORDER BY data_publicacao DESC";
  $result = $conn->query($sql);
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
  <section class="section">
    <div class="py-4"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
          <?php if (isset($_GET['categoria'])) {
            $categoria = str_replace('_', ' ', $conn->real_escape_string($_GET['categoria']));
            echo "<h1 class='h2 mb-4'>Mostrando itens da categoria: <mark>$categoria</mark></h1>";
          } ?>

          <?php if ($result && $result->num_rows > 0): ?>
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
                  </ul>
                  <p><?= htmlspecialchars(substr($row['conteudo'], 0, 150)) ?>...</p>
                  <a href="post-details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary">Leia Mais</a>
                </div>
              </article>
            <?php endwhile; ?>
          <?php else: ?>
            <p>Nenhuma notícia encontrada para esta categoria.</p>
          <?php endif; ?>

        </div>
        <aside class="col-lg-4 sidebar-inner">


          <!-- Promotion -->
          <div class="promotion">
            <img src="images/promotion.jpg" class="img-fluid w-100">
            <div class="promotion-content">
              <h5 class="text-white mb-3">Anuncie Conosco!</h5>
              <p class="text-white mb-4">Destaque sua marca para milhares de leitores. Anuncie no nosso site e conquiste
                novos clientes hoje mesmo!</p>
              <a href="https://themefisher.com/" class="btn btn-primary">Comece Agora</a>
            </div>
          </div>

          <!-- Search -->

          <div class="widget">
            <h4 class="widget-title"><span>Nunca perca uma notícia</span></h4>
            <form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank" class="widget-search">
              <input class="mb-3" id="search-query" name="s" type="search" placeholder="Seu E-mail">
              <i class="ti-email"></i>
              <button type="submit" class="btn btn-primary btn-block" name="subscribe">Inscreva-se</button>
              <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
              </div>
            </form>
          </div>

          <!-- tags -->
          <div class="widget">
            <h4 class="widget-title"><span>Tags</span></h4>
            <ul class="list-inline widget-list-inline">
              <li class="list-inline-item"><a href="tags.php?categoria=Cinema">Cinema</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Esportes">Esportes</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Estilo_de_Vida">Estilo de Vida</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Famosos">Famosos</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Jogos_Digitais">Jogos Digitais</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Meio_Ambiente">Meio Ambiente</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Música">Música</a></li>
              <li class="list-inline-item"><a href="tags.php?categoria=Tecnologia">Tecnologia</a></li>
            </ul>
          </div>
          <!-- recent post -->
          <div class="widget">
            <h4 class="widget-title">Recentes</h4>

            <!-- post-item -->
            <?php
            // Certifique-se de que $conn foi criado antes deste trecho e ainda está aberto.
            
            // Consulta para buscar as 2 notícias mais recentes
            $sql = "SELECT id, titulo, url_imagem, data_publicacao FROM noticias ORDER BY data_publicacao DESC LIMIT 3";
            $result = $conn->query($sql);

            // Verifica se a consulta foi executada com sucesso
            if ($result && $result->num_rows > 0):
              while ($row = $result->fetch_assoc()):
                ?>
                <article class="widget-card">
                  <div class="d-flex">
                    <img class="card-img-sm" src="<?= htmlspecialchars($row['url_imagem']) ?>" alt="Imagem da notícia">
                    <div class="ml-3">
                      <h5>
                        <a class="post-title" href="post-details.php?id=<?= $row['id'] ?>">
                          <?= htmlspecialchars($row['titulo']) ?>
                        </a>
                      </h5>
                      <ul class="card-meta list-inline mb-0">
                        <li class="list-inline-item mb-0">
                          <i class="ti-calendar"></i>
                          <?= date('d M, Y', strtotime($row['data_publicacao'])) ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </article>
                <?php
              endwhile;
            else:
              echo "<p>Nenhuma notícia recente encontrada.</p>";
            endif;
            ?>
          </div>

          <!-- Social -->
          <div class="widget">
            <h4 class="widget-title"><span>Redes Sociais</span></h4>
            <ul class="list-inline widget-social">
              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-instagram"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>
            </ul>
          </div>
        </aside>

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

<?php
$conn->close();
?>

</html>