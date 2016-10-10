<?php

include '../configuration/configuration.php';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$mysqli->query("SET NAMES 'utf8'");

?>