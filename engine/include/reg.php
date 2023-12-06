<?php
session_start();
if ($_POST['login']=='') {
    header( 'Location: /error/formerror', true, 303 );
    die;
}
require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

$login1 = strip_tags($_POST['login']);
$login1 = htmlspecialchars($login1);

$password_post = strip_tags($_POST['pass']);
$password_post = htmlspecialchars($password_post);

$regUser = new RegUser();
$regUser->chekInfo($login1,$password_post);