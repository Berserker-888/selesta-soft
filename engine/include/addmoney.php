<?php
session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

   // $add_date = $_POST['add_date'];
    $add_coming= strip_tags(htmlspecialchars($_POST['add_coming']));
    $add_expenses= strip_tags(htmlspecialchars($_POST['add_expenses']));
    $add_type= $_POST['add_type'];
    $add_comment= $_POST['add_comment'];

$add_day= $_POST['add_day'];
$add_month= $_POST['add_month'];
$add_year= $_POST['add_year'];

    if (empty($add_coming)) {
        $add_coming = 0;
    }
    if ($add_coming < 0) {
        $add_coming = 0;
    }

    if (empty($add_expenses)) {
        $add_expenses = 0;
    }
    if ($add_expenses < 0) {
        $add_expenses = 0;
    }
    if ($add_comment == "") {
        $add_comment = "Данные не указаны";
    }
    $balance = $add_coming - $add_expenses;

   // $add_date = explode('.', trim($_POST['add_date'], '.'));

    $add_date = [
        "0" => $add_day,
        "1" => $add_month,
        "2" => $add_year
    ];

    $addmanager = new Statistics();
    $addmanager->addStatistics($add_date,$add_coming,$add_expenses,$add_type,$balance,$add_comment);



