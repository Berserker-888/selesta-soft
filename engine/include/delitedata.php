<?php
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

$del = $_POST['del'];

if (!empty($del)) {
    $del_act = new Statistics();
    $del_act->delData();
}


