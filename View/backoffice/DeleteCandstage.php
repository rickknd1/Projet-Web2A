<?php
require_once '../../Controller/CandidaturestageC.php';

$candController = new CandidaturestageC();
$candController->deletecandidaturestage($_GET['candidaturestage_id']);
header('location:listCandstage.php');
?>