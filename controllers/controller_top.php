<?php

if (!isset($_POST) && !isset($_GET))
	die('Erreur : le formulaire ne contient aucune données');

include '../dal/dal_prm.php';

?>