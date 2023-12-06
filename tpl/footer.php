<?php
// если пользователь не авторизован, то скрыть от него все скрипты ajax
?>
<?php if ($_SESSION['user_id']!="") :?>
<footer>

            <div>
                <div class="toppage-on"><a href="#toppage">&#9650; Наверх</a></div>
            </div>
            <div class="col-md-12">
                <div class="footer">
                    <div class="footer-text">
                        2023
                    </div>
                </div>
            </div>
</footer>

<script src="/tpl/js/daterangepicker.js"></script>
<script src="/tpl/js/jquery.maskedinput.js"></script>
<script src="/tpl/js/bootstrap.bundle.min.js"></script>
<script src="/tpl/js/owl.carousel.min.js"></script>


<script>
    $(document).bind("ajaxSend", function(){
        $("#loading-indicator").show();
    }).bind("ajaxComplete", function(){
        $("#loading-indicator").hide();
    });

    $("submit").click(function(event) {
        $.post( "/echo/json/", { delay: 0 } );
    });
</script>


<script>
    window.onload = function () {
        document.body.classList.add('loaded_hiding');
        window.setTimeout(function () {
            document.body.classList.add('loaded');
            document.body.classList.remove('loaded_hiding');
        }, 500);
    }
</script>

<script>
jQuery(function(f){
    let element = f('.toppage-on');
    f(window).scroll(function(){
    element['fade'+ (f(this).scrollTop() > 200 ? 'In': 'Out')](500);
     });
});
</script>




<?php endif; ?>

</body>
</html>