<?php
include '../../Controller/EventC.php';

$error = "";

$event = null;

$EventC = new EventC();
if (
	isset($_POST["nom_cours"]) &&
	isset($_POST["date_cours"])
) {
	if (
		!empty($_POST['nom_cours']) &&
		!empty($_POST["date_cours"])
	) {
		$event = new Event(
			null,
			$_POST['nom_cours'],
			$_POST['date_cours']
		);
		$EventC->addEvent($event);
		header('Location: listEvents.php');
	} else
		$error = "Missing information";
}

?>

<!DOCTYPE html>

<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>Ajouter un événement</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
</head>

<body>
	<!-- <div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div> -->


	<div class="header">
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>
			<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here" />
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text" />
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo1.jpg" alt="" />
										<h3>Lea R. Frith</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo2.jpg" alt="" />
										<h3>Erik L. Richards</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo3.jpg" alt="" />
										<h3>John Doe</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo4.jpg" alt="" />
										<h3>Renee I. Hansen</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="" />
										<h3>Vicki M. Coleman</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing
											elit, sed...
										</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="" />
						</span>
						<span class="user-name">ECC</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.php"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.php"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="" />
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">
						Reset Settings
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/ecc-logo.svg" alt="" class="dark-logo" />
				<img src="vendors/images/ecc-logo-white.svg" alt="" class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">


					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-file-earmark-text"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">

							<li><a href="busers.php">Utilisateurs</a></li>
							<li><a href="listOfr.php">emploi</a></li>
							<li><a href="listCategorie.php">Catégories contenue</a></li>
							<li><a href="listContenus.php">Cours</a></li>
							<li><a href="listEvents.php">Evennements</a></li>
							<li><a href="listStage.php">stage</a></li>

						</ul>
					</li>


					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-back"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.php">Blank</a></li>
							<li><a href="contact-directory.php">Contact Directory</a></li>
							<li><a href="blog.php">Blog</a></li>
							<li><a href="blog-detail.php">Blog Detail</a></li>
							<li><a href="product.php">Product</a></li>
							<li><a href="product-detail.php">Product Detail</a></li>
							<li><a href="faq.php">FAQ</a></li>
							<li><a href="profile.php">Profile</a></li>
							<li><a href="gallery.php">Gallery</a></li>
							<li><a href="pricing-table.php">Pricing Tables</a></li>
						</ul>
					</li>

					<li>
						<a href="sitemap.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-diagram-3"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li>
						<a href="chat.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-chat-right-dots"></span><span class="mtext">Chat</span>
						</a>
					</li>
					<li>
						<a href="invoice.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					>

				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="row">
					<div class="col-md-6 col-sm-12">

						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="index.php">Acceuil</a>
								</li>
								<li class="breadcrumb-item">
									<a href="lisEvents.php">Evennements</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Ajout
								</li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<div id="error">
				<?php echo $error; ?>
			</div>

			<form action="" method="POST" onsubmit="return(valideform());">
				<table border="1" align="center">

					<tr>
						<td>
							<label for="nom_cours">Nom du cours:
							</label>
						</td>
						<td><input type="text" id="nom_cours" name="nom_cours">
							<span id="NomcoursMessage" style="color: red;"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="date_cours">Date du cours:</label>
						</td>
						<td>
							<input type="date" id="date_cours" name="date_cours">
						</td>
					</tr>
					<tr align="center">
						<td>
							<input type="submit" value="Save">
						</td>
						<td>
							<input type="reset" value="Reset">
						</td>
					</tr>
				</table>
			</form>

		</div>
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe class="w-100 border-0" src="https://embed.lottiefiles.com/animation/31548"></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Open source
					<span role="img" aria-label="gratitude">❤️</span>
				</h3>
				<div class="pb-2">
					<a class="github-button" href="https://github.com/dropways/deskapp" data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star dropways/deskapp dashboard on GitHub">Star</a>
					<a class="github-button" href="https://github.com/dropways/deskapp/fork" data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-repo-forked" data-size="large" data-show-count="true" aria-label="Fork dropways/deskapp dashboard on GitHub">Fork</a>
				</div>
			</div>
			<div class="text-center mb-1">
				<div>
					<a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-light btn-block btn-sm">
						<span class="text-danger weight-600">STAR US</span>
						<span class="weight-600">ON GITHUB</span>
						<i class="fa fa-github"></i>
					</a>
				</div>
				<script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
			</div>
			<a href="https://github.com/dropways/deskapp" target="_blank" class="btn btn-success btn-sm mb-0 mb-md-3 w-100">
				DOWNLOAD
				<i class="fa fa-download"></i>
			</a>
			<p class="font-14 text-center mb-1 d-none d-md-block">
				Available in the following technologies:
			</p>
			<div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
				<i class="fa fa-html5"></i>
			</div>
		</div>

		<!-- welcome modal end -->
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="vendors/scripts/dashboard3.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<script>
			function verif_alphanumerique(text) {
				// Utilisez l'expression régulière qui accepte les caractères alphanumériques ainsi que les caractères accentués
				return /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/.test(text);
			}
			// Ajoutez un gestionnaire d'événements pour détecter les changements dans la zone de texte
			document.getElementById("nom_cours").addEventListener("input", function() {
				// Récupérez le contenu de la zone de texte
				var text = this.value;
				// Vérifiez si le contenu est valide
				if (verif_alphanumerique(text)) {
					// Si le contenu est valide, réinitialisez le style
					this.style.backgroundColor = "#ffffff"; // Réinitialisez la couleur de fond à blanc
					// Réinitialisez le message à côté de la zone de texte
					document.getElementById("NomcoursMessage").textContent = ""; // Supprimez le message d'erreur
				} else {
					// Si le contenu n'est pas valide, conservez la couleur de fond rouge
					// Pas besoin de modifier le message ici car il sera mis à jour lors de la validation du formulaire
				}
			});


			function valideform() {
				var Nomcours = document.getElementById("nom_cours").value;
				var NomcoursMessage = document.getElementById("NomcoursMessage");


				// Vérifiez le Nom categorieMessage et appliquez un style à la zone de texte et affichez le message d'alerte dans le span
				if (!verif_alphanumerique(Nomcours)) {
					document.getElementById("nom_cours").style.backgroundColor = "red";
					NomcoursMessage.textContent = "Nom cours invalide";
					return false;
				} else {
					// Réinitialisez le style de la zone de texte et effacez le message d'alerte
					document.getElementById("nom_cours").style.backgroundColor = "";
					NomcoursMessage.textContent = "";
					return true;
				}
			}
		</script>

</body>

</html>