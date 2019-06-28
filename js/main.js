$(window).on('keydown', function () {
    if(event.keyCode === 13) {
        $('.filter-form').submit();
    }
});