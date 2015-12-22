$(document).ready(function () {

    $('.btn-vote').click(function (e) {
        e.preventDefault();

        var form = $('#form-vote');

        var button = $(this);
        var ticket = button.closest('.ticket');
        var id = ticket.data('id');

        var action = form.prop('action').replace(':id', id);

        button.addClass('hide');

        $.post(action, form.serialize(), function (response) {
            // alert
            // update count votes
            ticket.find('.btn-unvote').removeClass('hide');
        }).fail(function () {
            // print error message
            button.removeClass('hide');
        });
    });
});