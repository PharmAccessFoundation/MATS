(function($) {
    $(function() {
        $('li.answer').hide();
        
        $('li.question').on('click', function() {
            $('li.answer:visible').slideUp('normal');
            $(this).next('li.answer').slideDown('normal');
        });
        
    });
})(jQuery);