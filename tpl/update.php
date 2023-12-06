<?php
session_start();
if (!empty($_SESSION['user_id'])) {
$table_stat = new Statistics();
$userFil = new UserInfo();
}
?>
<?php if (empty($_SESSION['user_id'])) : ?>
    <?php
    $err=1;
    require_once('tpl/err.php');
    ?>
<?php endif; ?>

<?php if (!empty($_SESSION['user_id'])) : ?>
<div class="container">
    <div class="alert alert-success" role="alert">
        Функционал находится в разработке
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="">
                <div class="block-main-sett">
                    <div class="">
                        Проверка сервера обновлений...
                    </div>
                    <div style="color: red">
                        Функция недоступна в данной версии приложения
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="">
                <div class="block-main-sett">
                    <div class="">
                        Ручнное обновление
                    </div>
                    <div class="">
                        <p>Загрузите файл обновлений</p>
                        <form action="">
                            <input disabled type="file">
                        </form>
                        <div style="color: red">
                            Функция недоступна в данной версии приложения
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>