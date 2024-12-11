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
</head>
<style>
    .popup {
        display: block;
        width: fit-content; /* Ajusta o tamanho para caber no texto */
        max-width: 80%; /* Limita a largura da mensagem */
        margin: 20px auto; /* Centraliza horizontalmente */
        padding: 10px 20px;
        text-align: center; /* Centraliza o texto */
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .popup.success {
        border-color: green;
        color: green;
    }

    .popup.error {
        border-color: red;
        color: red;
    }
</style>


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
          <h1 class="mb-4">Login</h1>
          <ul class="list-inline">
            <li class="list-inline-item"><a class="text-default" href="home.php">Home
                &nbsp; &nbsp; /</a></li>
            <li class="list-inline-item text-primary">Login</li>
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
            <h2>Login do Administrador</h2>
            <p>Digite suas credenciais para acessar a área de administração.</p>
          </div>

          <form method="POST" action="processar_login.php">
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" name="login" id="login" class="form-control" placeholder="Digite seu login" required>
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha"
                required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
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
  // Exibe o pop-up ao carregar a página
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