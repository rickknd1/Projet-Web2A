<?php
include '../../Controller/EventC.php';
$EventC = new EventC();
$EventC->deleteEvent($_GET["id_event"]);
header('Location:listEvents.php');
