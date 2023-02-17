(function($){
    'use strict';
    $(function(){
        $('body').on('click','.cm-action',function(){
            $(this).addClass("clickable");
            var title = $('.clickable').siblings('.cm-title').text();
            var description = $('.clickable').siblings('.cm-description').text();
            var source=$('.clickable').parent().siblings().children().attr('src');
            const content = GLightbox({
                elements: [
                    {
                        'href': source,
                        'type': 'image',
                        'title': title,
                        'description':description ,
                    },
                ],
                autoplayVideos: true,
            });
                content.open();
                $(this).removeClass("clickable");
        });
        
    });    
    
})(jQuery);