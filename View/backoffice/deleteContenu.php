<?php
include '../../Controller/ContenuC.php';
$ContenuC = new ContenuC();
$ContenuC->deleteContenu($_GET["id_contenu"]);
header('Location:ListContenus.php');
