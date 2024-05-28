<?php

include_once '../../config.php';
session_start();

if (!isset($_SESSION['name'])) {
  header('location:login.php');
}

$db = config::getConnexion();

$query = $db->query("SELECT id_contenu, titre, description, fichier, video FROM contenu where id_contenu=".$_GET["id_contenu"]);
$content = $query->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <style>
    /* CSS pour styliser la section "about" */
#about {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#about h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

#about .p1 {
    color: #666;
    font-size: 16px;
    margin-bottom: 5px;
}

#about iframe {
    width: 100%;
    max-width: 560px;
    height: 315px;
    border: none;
    margin-bottom: 10px;
}

#about a {
    color: #007bff;
    text-decoration: none;
}

#about a:hover {
    text-decoration: underline;
}

  </style>
</head>
<body id="body">
    <!--==========================
    Top Bar
  ============================-->

<!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body"><img src="img/logo-lg.png"  title="" /></h1>
       
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
        <li ><a href="offreemploi.php">Offre d'emploi</a></li>
          <li><a href="offrestage.php">Stage</a></li>
          <li class="menu-active"><a href="categories.php">Formation</a></li>
          <li>
            <button class="btn-login-signup"><a href="index.php" class="btn-login">Se deconnecter</a></button>

            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
              <span class="user-name"><?php echo $_SESSION['name'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
              <a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
              <a class="dropdown-item" href="profile.php"><i class="dw dw-settings2"></i> Setting</a>
              <a class="dropdown-item" href="faq.php"><i class="dw dw-help"></i> Help</a>
              <a class="dropdown-item" href="login.php"><i class="dw dw-logout"></i> Log Out</a>
            </div>

        </ul>
        <div class="user-info-dropdown">



        </div>
      </nav><!-- #nav-menu-container -->
      
    </div>
  </header><!-- #header -->
  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-content">
    <div class="intro-content">
      <h2>Bonjour <br><span><?php echo $_SESSION['name'] ?>!</span></h2>

    </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('img/intro-carousel/1.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/2.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/3.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/4.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/5.jpg');"></div>
    </div>

  </section><!-- #intro -->

    
    <main id="main">
        
    <section id="about" class="wow fadeInUp">
    <h2><?php echo $content['titre']; ?></h2>
        <!-- Afficher les détails du contenu -->
        <p class="p1">Description : <?php echo $content['description']; ?></p>
        <p class="p1">Vidéo : <iframe width="560" height="315" src="<?php echo $content['video']; ?>" frameborder="0" allowfullscreen></iframe></p>
        <embed src="<?php echo $content['fichier']; ?>" width="1000" height="800" type="application/pdf">
        <p class="p1">Fichier : <a href="<?php echo $content['fichier']; ?>"><?php echo $content['fichier']; ?></a></p>
    </section><!-- #about --> 
    </main>

    <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
        <a href="https://bootstrapmade.com/">Free Bootstrap Templates</a> by BootstrapMade
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>
</html>
