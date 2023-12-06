<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    $main_data = new Statistics();
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
<div class="modal fade" id="Modaldel" tabindex="-1" aria-labelledby="Modaldel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModaldelLabel">Вы уверены?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    Внимание! Данная процедура удалит все ваши записи за все отчётные периоды. Процесс необратим. Выполнить полное удаление?
                </div>
                <div class="">
                    <form action="engine/include/delitedata.php" method="post">
                        <input hidden type="text" value="1" name="del">
                        <button class="btn-fil" type="submit">Выполнить</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<div class="container mt-20">
    <div class="row">
        <div class="col">
            <div class="alert alert-success" role="alert">
                Выберите нужные опции
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="block-main-sett">
                <h2>Добавить отчётный год</h2>
                <hr>
                <p>Будет добавлен: <?= $main_data->monitorYear() ?> год</p>
                <form action="engine/include/addnewyear.php" method="post">
                    <input hidden class="form-control" type="number" name="new_year" value="<?= $main_data->monitorYear() ?>">
                    <button class="btn-fil" type="submit">Добавить год</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="block-main-sett">
                <h2>Сменить пароль</h2>
                <hr>
                <p style="color: red">Недоступно в данной версии</p>
                <div>Ваш логин: admin</div>
                <div>Ваш пароль: 123</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="block-main-sett">
                <h2>Стереть отчётные данные</h2>
                <hr>
                <button type="button" class="btn-fil" data-bs-toggle="modal" data-bs-target="#Modaldel">
                    Стереть
                </button>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

