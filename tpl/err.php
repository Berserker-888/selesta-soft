<div class="container">
    <div class="row">
        <div class="col">
            <div class="err-block">
                <?php
                if ($err==1) {
                    echo "У вас нет доступа к странице (ошибка 1)";
                }
                else
                    echo "Неизвестная ошибка";
                ?>
            </div>
        </div>
    </div>
</div>