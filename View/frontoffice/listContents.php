<?php

include_once '../../config.php';
session_start();

if (!isset($_SESSION['name'])) {
  header('location:login.php');
}

$db = config::getConnexion();

$query = $db->query("SELECT id_contenu, titre, description, fichier, video, image_path FROM contenu where categorie=".$_GET["id_categorie"]);
$contents = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $db->query("SELECT nom_categorie, niveau, image_path FROM categorie where id_categorie=".$_GET["id_categorie"]);
$categorie = $query->fetch(PDO::FETCH_ASSOC);
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
/* CSS pour styliser la liste de contenus sous forme de cartes */
    /* CSS pour styliser la liste de contenus sous forme de cartes */
    #main ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
    }

    #main ul li {
        flex: 0 0 calc(33.333% - 20px); /* Répartit les cartes sur 3 colonnes avec un espace de 20px entre elles */
        margin: 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        /* Ajoute une image de fond à chaque carte */
        /*background-image: url('./cours.jpg');*/
        background-size: cover; /* Ajuste la taille de l'image pour couvrir toute la carte */
        height: 200px;
      }

    #main ul li:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    #main ul li a {
        display: block;
        padding: 20px;
        text-decoration: none;
        color: #fff;
    }

    #main ul li a:hover {
        color: #ff7bff;
    }
  </style>
</head>
<body id="body">
    <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      
    </div>
  </section>
<!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="home.php"><img src="img/logo-lg.png"  title="" /></h1>
       
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
    <!-- Afficher la liste des contenus pour la catégorie donnée -->
    <ul id="listc"> <!-- Ajout de l'ID "listc" -->
        <?php foreach ($contents as $content) : ?>
          <li style="background-image: url('<?php echo $content['image_path']; ?>');">
                <a href="content.php?id_contenu=<?php echo $content['id_contenu']; ?>"><?php echo $content['titre']; ?></a>
            </li><!-- Correction de la balise fermante -->
        <?php endforeach; ?>
    </ul>
</main>

<footer id="footer">
<div class="container">
  <div class="row">
    <div class="col-lg-6 text-lg-left text-center">
      <div class="footer-logo">
        <a href="#body"><img src="img/logo.png" alt="" class="img-fluid"></a>
      </div>
      <p><span style="color: aliceblue;">Meilleures Plateforme de Recrutement - Trouvez les meilleurs talents et les meilleures opportunités professionnelles.</span></p>
    </div>
    <div class="col-lg-6">
      <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
        <a href="#intro" class="scrollto">Accueil</a>
        <br>
        <a href="#about" class="scrollto">À Propos</a><br>
        <a href="#services" class="scrollto">Services</a><br>
        <a href="#portfolio" class="scrollto">Portefeuille</a><br>
        <a href="#contact" class="scrollto">Contactez-nous</a><br>
      </nav>
    </div>
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
