$(document).ready(function () {

    var alert = new Alert('#notifications');

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

            alert.success('Gracias por votar!');

            var voteCount = ticket.find('.votes-count');
            var votes = parseInt(voteCount.text().split(' ')[0]);
            votes++;

            voteCount.text(votes == 1 ? '1 voto' : votes + ' votos');
        }).fail(function () {
            // print error message
            button.removeClass('hide');

            alert.error('Ocurrio un error!');
        });
    });

    $('.btn-unvote').click(function (e) {
        e.preventDefault();

        var form = $('#form-unvote');

        var button = $(this);
        var ticket = button.closest('.ticket');
        var id = ticket.data('id');

        var action = form.prop('action').replace(':id', id);

        button.addClass('hide');

        $.post(action, form.serialize(), function (response) {
            // alert
            // update count votes
            ticket.find('.btn-vote').removeClass('hide');

            alert.success('Voto eliminado!');

            var voteCount = ticket.find('.votes-count');
            var votes = parseInt(voteCount.text().split(' ')[0]);
            votes--;

            voteCount.text(votes <= 1 ? votes + ' voto' : votes + ' votos');
        }).fail(function () {
            // print error message
            button.removeClass('hide');

            alert.error('Ocurrio un error!');
        });
    });

});