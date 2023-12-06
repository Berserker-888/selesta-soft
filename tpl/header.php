<?php
if ($_SERVER['REQUEST_URI']=='/' or $_SERVER['REQUEST_URI']=='') {
    $site_title="Домашняя бухгалтерия";
}
elseif ($_SERVER['REQUEST_URI']=='/main') {
    $site_title="Управление и статистика";
}
elseif ($_SERVER['REQUEST_URI']=='/settings') {
    $site_title="Настройки";
}
elseif ($_SERVER['REQUEST_URI']=='/update') {
    $site_title="Обновление платформы";
}
elseif ($_SERVER['REQUEST_URI']=='/about') {
    $site_title="О системе";
}
else
    $site_title="Домашняя бухгалтерия";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/tpl/img/ico.png">
    <link rel="stylesheet" href="/tpl/css/bootstrap.css">
    <link rel="stylesheet" href="/tpl/css/style.css">
    <link rel="stylesheet" href="/tpl/fonts/fonts.css">
    <link rel="stylesheet" href="/tpl/css/daterangepicker.css">
    <script src="/tpl/js/jquery-3.6.0.min.js"></script>
    <title><?= $site_title ?></title>
</head>
<body>
<?php if (empty($_SESSION['user_id'])) :?>
<div class="main-h-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Домашняя бухгалтерия</h1>
                <div class="main-h-title">Версия: 1</div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (!empty($_SESSION['user_id'])) :?>
<div class="preloader">
    <div class="preloader__image"></div>
</div>

<div class="navbar-main">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/main">Домашняя бухгалтерия<br><span>версия 1</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/main">Главная</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Опции
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/settings">Настройки</a></li>
                                <li><a class="dropdown-item" href="/update">Обновление</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/about">Информация о системе</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Выход
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/exit">Выйти из профиля</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div id="toppage"></div>
<?php endif; ?>
