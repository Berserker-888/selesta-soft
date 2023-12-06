<?php
session_start();
?>

<?php if (empty($_SESSION['user_id'])) : ?>

<div class="main-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card card-form">
                    <div class="card-header">
                        <h1 class="portal-form_tittle text-center">Авторизация</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-bg">
                            <form class="text-center main-form" method="post" id="formID" action="/engine/include/auth.php">
                                <div class="form-group form-index-inp">
                                    <input type="text" class="form-control form-control-sm" name="login" placeholder="Логин">
                                </div>
                                <div class="form-group form-index-inp">
                                    <input type="password" class="form-control form-control-sm" name="pass" placeholder="Пароль">
                                </div>
                                <button type="submit" class="login-btn">Войти</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <hr style="margin-top: 50px">
            <p>Управление и статистика личных финансов</p>
        </div>

<?php endif; ?>
<?php if (!empty($_SESSION['user_id'])) : ?>
    <?php
    echo "<script>self.location='/main';</script>";
    ?>
<?php endif; ?>

<?php if (1==2) :?>
<!--Техническая регистрация для смены пароля, для открытие формы нужно изменить уравнение на верное-->
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-md-5">
                <div class="form-bg">
                    <h1>Регистрация</h1>
                    <form class="text-center main-form" method="post" id="formID" action="/engine/include/reg.php">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="login" placeholder="Логин">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" name="pass" placeholder="Пароль">
                        </div>
                        <button type="submit" class="login-btn">Регистрация</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

</div>

