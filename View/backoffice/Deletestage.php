<?php
require_once '../../Controller/Offre_stageC.php';

$offreController = new Offres_stageC();
$offreController->deleteOffrestage($_GET['id']);
header('location:listStage.php');
?>