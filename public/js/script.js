var removeLink;

$(document).ready(function () {
    $('.remove').on('click', function(e) {
        e.preventDefault();
        var name = $(e.target).attr('data-name');
        $('#modal-username').text(name);

        removeLink = $(e.target).attr('href');
    });

    $('#modal-remove').on('click', function() {
        location.href = removeLink;
    });
});
