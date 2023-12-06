<?php

if ($err=1) {
    $err_mess="Ошибка доступа";
}
elseif ($err=22) {
    $err_mess="Ошибка доступа";
}
elseif ($err=2) {
    $err_mess="Ошибка доступа";
}
else
    $err_mess="Ошибка доступа";
?>

<div class="container">
    <div class="page-stop_info">
        <div class="row">
            <div class="col-md-12 text-center">
                <?= $err_mess ?>
                <p class="ban-exit"><a href="/">На главную</a></p>
                <img class="page-stop_info__img" src="/tpl/img/stop.png" alt="">
            </div>
        </div>
    </div>
</div>
