<?php
session_start();
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode('/', trim($url, '/'));
require_once ('engine/classes/Engine.php');
//$security->banUser($_SESSION['user_id']);

//Шапка
require_once ('tpl/header.php');

if ($_SERVER['REQUEST_URI'] == '/' or $_SERVER['REQUEST_URI'] == '') {
    require_once ('tpl/index.php');
}
elseif ($_SERVER['REQUEST_URI'] == '/exit') {
    require_once('tpl/exit.php');
}

elseif ('/main' == '/'.$url[0]) {

    require_once('tpl/main.php');
}
elseif ('/settings' == '/'.$url[0]) {

    require_once('tpl/settings.php');
}
elseif ('/update' == '/'.$url[0]) {

    require_once('tpl/update.php');
}
elseif ('/about' == '/'.$url[0]) {

    require_once('tpl/about.php');
}
elseif ('/exit' == '/'.$url[0]) {

    require_once('tpl/exit.php');
}

elseif ('/err' == '/'.$url[0]) {

    require_once('tpl/error.php');
}
else
    require_once('tpl/error.php');
?>

<?php
//Футер
require_once ('tpl/footer.php');
?>
