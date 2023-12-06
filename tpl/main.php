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
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="ModalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAddLabel">Добавить запись</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="add_note">
                    <form action="engine/include/addmoney.php" method="post">
                        <div class="add_note__date">
                            <div>
                                <select name="add_day" class="form-select">
                                    <?php $table_stat->daySelect() ?>
                                </select>
                            </div>
                            <div>
                                <select name="add_month" class="form-select">
                                    <?php $table_stat->monthSelect() ?>
                                </select>
                            </div>
                            <div>
                                <select name="add_year" class="form-select">
                                    <?php $table_stat->yearSelect(); ?>
                                </select>
                            </div>
                        </div>
                        <!--<input type="text" required class="form-control date" name="add_date" value="<?/*= date('d.m.Y');*/?>">-->
                        <input type="text" pattern="[0-9]{,3}" id="numberField" class="form-control price-mask1" name="add_coming" placeholder="Приход*">
                        <input type="text" class="form-control price-mask1" id="numberField2" name="add_expenses" placeholder="Расход*">
                        <select name="add_type" class="form-select">
                            <option value="1" selected>Переменные</option>
                            <option value="2">Постоянные</option>
                        </select>
                        <textarea class="form-control" name="add_comment" id="" cols="30" rows="10" placeholder="Статьи расходов или комментарий к операции..."></textarea>
                        <p class="modal-form__mini-note">* - по-умолчанию значение равно 0</p>
                        <div class="modal-form_btn">
                            <button type="submit" class="btn-modal">Принять</button>
                            <button type="button" class="btn-modal__close" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-20">
    <div class="row">
        <div class="col-lg-10">
            <div class="block-main">
                <div class="app-chart__canvas">
                    <canvas id="myChart" width="500" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="block-main">
                <div>
                    <h2 class="filt-title">Фильтр</h2>
                    <form class="f-fil" action="engine/include/edityear.php" method="post"">
                    <select class="form-select" name="edit_year">
                        <?php $table_stat->yearSelect(); ?>
                    </select>
                    <button type="submit" class="btn-fil">Установить год</button>
                    </form>
                </div>
                <div>
                    <form class="f-fil" action="engine/include/editdate.php" method="post">
                        <select class="form-select" name="edit_month">
                            <?php $table_stat->monthSelect() ?>
                        </select>
                        <button type="submit" class="btn-fil">Установить месяц</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="block-main mt-20 block-main__money">
                <p>Баланс</p>
                <p><?= $table_stat->comingMonthSumEnd(); ?>р</p>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="block-main mt-20 block-main__money block-main__money-expenses">
                <p>Расход</p>
                <p><?= $table_stat->expensesMonthSum(); ?>р</p>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="block-main mt-20 block-main__money block-main__money-neitr">
                <p>Приход</p>
                <p><?= $table_stat->comingMonthSum(); ?>р</p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="block-main mt-20 block-main__money block-main__money-neitr">
                <p>Переменные расходы</p>
                <p><?= $table_stat->monthSumTypePostRez(); ?>р</p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="block-main mt-20 block-main__money block-main__money-neitr">
                <p>Постоянные расходы</p>
                <p><?= $table_stat->monthSumTypePerRez(); ?>р</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-20">

    <div class="row">
        <div class="col-lg-2">
            <div class="block-main">
                <p><img src="tpl/img/calendar.png" alt=""><span class="date-title"><?= $userFil->userInfoAll()['user_month']." ".$userFil->userInfoAll()['year_main']; ?></span></p>
            </div>
           <div class="block-main mt-20">
               <button type="button" class="btn-fil" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                   Добавить
               </button>
           </div>
        </div>

        <div class="col-lg-10">
           <div class="block-main">
               <?php if (empty($table_stat->balanceFil())) :?>
                <div class="block-main__alarm">
                    По выбранному периоду отчётность не ведётся. Вы можете внести новые данные, нажав кнопку "Добавить"
                </div>
               <?php endif; ?>

               <?php if (!empty($table_stat->balanceFil())) :?>
               <table class="table table-striped table-hover">
                   <thead>
                   <tr class="table-head">
                       <th scope="col">Дата</th>
                       <th scope="col">Приход</th>
                       <th scope="col">Расход</th>
                       <th scope="col">Баланс</th>
                       <th scope="col">Инфо</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $table_stat->tableStatistics(); ?>
                   </tbody>
               </table>
               <?php endif; ?>
           </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            datasets: [{
                label: 'Баланс, руб',
                data: ["<?= $table_stat->mainGrafik()["sum_m_1"] ?>", "<?= $table_stat->mainGrafik()["sum_m_2"] ?>", "<?= $table_stat->mainGrafik()["sum_m_3"] ?>", "<?= $table_stat->mainGrafik()["sum_m_4"] ?>", "<?= $table_stat->mainGrafik()["sum_m_5"] ?>", "<?= $table_stat->mainGrafik()["sum_m_6"] ?>", "<?= $table_stat->mainGrafik()["sum_m_7"] ?>", "<?= $table_stat->mainGrafik()["sum_m_8"] ?>", "<?= $table_stat->mainGrafik()["sum_m_9"] ?>", "<?= $table_stat->mainGrafik()["sum_m_10"] ?>", "<?= $table_stat->mainGrafik()["sum_m_11"] ?>", "<?= $table_stat->mainGrafik()["sum_m_12"] ?>"],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
        document.getElementById("numberField").oninput = function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        };
        document.getElementById("numberField2").oninput = function() {
            this.value = this.value.replace(/[^0-9]/g, '');
</script>

<?php endif; ?>