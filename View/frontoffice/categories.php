<?php

include_once '../../config.php';

session_start();

if (!isset($_SESSION['name'])) {
  header('location:login.php');
}

$db = config::getConnexion();

// Récupérer les événements depuis la base de données
$query_events = $db->query("SELECT nom_cours AS title, date_cours AS start FROM event");
$events = $query_events->fetchAll(PDO::FETCH_ASSOC);

// Sélectionnez les catégories
$query = $db->query("SELECT id_categorie, nom_categorie, niveau, image_path FROM categorie");
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

// Sélectionnez le nombre de contenus pour chaque catégorie
foreach ($categories as &$categorie) {
    $id_categorie = $categorie['id_categorie'];
    $query_count = $db->prepare("SELECT COUNT(*) AS count FROM contenu WHERE categorie = :id_categorie");
    $query_count->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
    $query_count->execute();
    $result = $query_count->fetch(PDO::FETCH_ASSOC);
    $categorie['count'] = $result['count'];
}
unset($categorie); // Détruire la référence pour éviter les effets de bord

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

  <!-- Inclure les fichiers CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.css" rel="stylesheet">

  <style>
    /* CSS pour styliser les cartes des catégories */

    #about ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
    }

    #about ul li {
        flex: 0 0 calc(33.333% - 20px); /* Répartit les cartes sur 3 colonnes avec un espace de 20px entre elles */
        margin: 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        /* Ajoute une image de fond à chaque carte */
        /*background-image: url('./categorie.jpg');*/
        background-size: cover; /* Ajuste la taille de l'image pour couvrir toute la carte */
        height: 200px;
      }

    #about ul li:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);       
    }

    #about ul li a {
        display: block;
        padding: 20px;
        text-decoration: none;
        color: #fff;
    }

    #about ul li a:hover {
        color: #ff7bff;
    }

    /* Styles pour le calendrier */
    #calendar-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    #calendar {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
          
          <li><a href="offreemploi.php">Offre d'emploi</a></li>
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


    
    <main id="main">
        
    <section id="about" class="wow fadeInUp">        <!-- Afficher la liste des catégories avec des liens vers la liste des contenus de chaque catégorie -->
    <ul>
    <?php foreach ($categories as $categorie) : ?>
        <li style="background-image: url('<?php echo $categorie['image_path']; ?>');">
            <a href="listContents.php?id_categorie=<?php echo $categorie['id_categorie']; ?>">
                <?php echo $categorie['nom_categorie'] . ' - Niveau ' . $categorie['niveau']; ?>
                <span>(<?php echo $categorie['count']; ?> contenu<?php echo ($categorie['count'] > 1) ? 's' : ''; ?>)</span>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
    </section>
        <!--==========================
        Section Calendar
        ============================-->
        <section id="calendar-container">
            <div id="calendar"></div>
    </section>
    </main>

    <!--==========================
    Footer
  ============================-->
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

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              events: <?php echo json_encode($events); ?> // Ajoutez vos événements ici
          });
          calendar.render();
      });
  </script>
</body>
</html>
