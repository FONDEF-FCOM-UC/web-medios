(function($) {
    $(document).on("click", ".close", function (event) {
        event.preventDefault();
        $(this).closest('.story').remove();
        window.stop();
    } );
})(jQuery);
