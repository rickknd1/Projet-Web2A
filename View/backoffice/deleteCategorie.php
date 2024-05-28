<?php
include '../../Controller/CategorieC.php';
$CategorieC = new CategorieC();
$CategorieC->deleteCategorie($_GET["id_categorie"]);
header('Location:ListCategorie.php');
