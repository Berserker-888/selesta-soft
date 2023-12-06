<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'].'/engine/classes/Engine.php');

$login_room = strip_tags($_POST['login']);
$login_room = htmlspecialchars($login_room);

$password_room = strip_tags($_POST['pass']);
$password_room = htmlspecialchars($password_room);

$authUser = new AuthRoom();
$authUser->chekInfoRoom($login_room,$password_room);
