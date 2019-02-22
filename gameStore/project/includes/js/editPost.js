$(document).ready(function() {
    $('#newCatBtn').on('click', function(e)
    {
        e.preventDefault();
        $('#newCatDiv').removeClass('hide');
        $(this).addClass('hide');

    });
});
