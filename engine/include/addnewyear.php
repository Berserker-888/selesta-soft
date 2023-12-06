<?php
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

$new_year = $_POST['new_year'];
$newyear = new Statistics();
$newyear->addNewYear($new_year);



