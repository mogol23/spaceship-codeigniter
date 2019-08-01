$(function(){
    function pageLoad(){

        var $widgets = $('.widget');

        /**
         * turn off .content-wrap transforms & disable sorting when widget fullscreened
         */
        $widgets.on("fullscreen.widgster", function(){
            $('.content-wrap').css({
                '-webkit-transform': 'none',
                '-ms-transform': 'none',
                transform: 'none',
                'margin': 0,
                'z-index': 2
            });
            $('.modal').css({
                'z-index': 10001
            });
            $('ul.messenger.messenger-fixed').css({
                'z-index': 10002
            });
        }).on("restore.widgster closed.widgster", function(){
            $('.content-wrap').css({
                '-webkit-transform': '',
                '-ms-transform': '',
                transform: '',
                margin: '',
                'z-index': ''
            });
            $('.modal').css({
                'z-index': 1050
            });
            $('ul.messenger.messenger-fixed').css({
                'z-index': 10000
            });
        });

        /**
         * Init all other widgets with default settings & settings retrieved from data-* attributes
         */
        $widgets.widgster();

        /**
         * Init tooltips for all widget controls on page
         */
        $('.widget-controls > a').tooltip({placement: 'bottom'});
    }
    pageLoad();
    SingApp.onPageLoad(pageLoad);
});