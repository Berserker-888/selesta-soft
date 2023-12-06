<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="/"><img class="page-stop_logo" src="/tpl/img/logo.png" alt=""></a>
        </div>
    </div>
    <div class="page-stop_info">
        <div class="row">
            <div class="col-md-12">
                <?php if ($security->ban_user_global==0 or $security->status_global==0) :?>
                <p>У вас нет доступа к данной странице</p>
                <?php endif; ?>
                <?php if ($security->ban_user_global==1) :?>
                    <p>Ваш аккаунт заблокирован</p>
                    <p class="ban-exit"><a href="/exit">Выйти</a></p>
                <?php endif; ?>
                <img class="page-stop_info__img" src="/tpl/img/stop.png" alt="">
            </div>
        </div>
    </div>
</div>