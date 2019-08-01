
$(function(){
    function pageLoad(){
        var theme = 'air';

        $.globalMessenger({ theme: theme });
        Messenger.options = { theme: theme  };

        // Messenger().post("Thanks for checking out Messenger!");

        var loc = ['top', 'right'];

        var update = function(){
            var classes = 'messenger-fixed';

            for (var i=0; i < loc.length; i++)
                classes += ' messenger-on-' + loc[i];

            $.globalMessenger({ extraClasses: classes, theme: theme  });
            Messenger.options = { extraClasses: classes, theme: theme };
        };

        update();
       
    }
    pageLoad();
    SingApp.onPageLoad(pageLoad);
});