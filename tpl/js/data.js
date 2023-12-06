
    $(document).ready(function () {
    $('.ajax_form').submit(function (event) {
        event.preventDefault();
        var $form = $(this),
            formAction = $form.attr('action'),
            formData = $form.serialize();

        $.ajax({
            url: formAction,
            type: 'POST',
            data: formData,
            success: function (data, status, xhr) {
                $('.rezult1').html(data);
            }
        });
    });
});

    $(document).ready(function () {
    $('.ajax_form_search').submit(function (event) {
        event.preventDefault();
        var $form = $(this),
            formAction = $form.attr('action'),
            formData = $form.serialize();

        $.ajax({
            url: formAction,
            type: 'POST',
            data: formData,
            success: function (data, status, xhr) {
                $('.rezult1').html(data);
            }
        });
    });
});

