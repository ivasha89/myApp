$(document).ready(function () {
    $('.stts').each(function (j, element) {
        $(element).click(function () {
            var name = $(this).parent().attr('title');
            var id = $(this).parent().attr('id');
            var date = $(this).attr('id');
            $('.modal-title').html(name);
            for (k = 0; k < date; k++) {
                for (i = 0; i < 7; i++) {
                    var statuses = $('.sts' + id + [i] + [k]).attr('title');
                    $('.st' + [i] + [k]).html(statuses);
                }
            }
            $('#statuses').modal('show');
        });
    });
});