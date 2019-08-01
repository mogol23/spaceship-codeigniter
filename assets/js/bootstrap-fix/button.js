/**
 * In origin Button.js 'change' event triggers on "label" tag. So we use this function to trigger 'change' event on "input" tag
 * 
 * https://github.com/vlastikcz/bootstrap/commit/e47474e51866b5749f34845060ad6adae725b3f2
 */
!function($) {
    $(document).on('change', '[data-toggle="buttons"] > label', function(e){
        var $input = $(e.target).find('input');
        $input.trigger('change');
    });
}(jQuery);