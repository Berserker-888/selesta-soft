<?php
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

$year = $_POST['edit_year'];

$year_edit = new Statistics();
$year_edit->editYear($year);



