(function($){
    'use strict';
    $(function(){
        $('body').on('click','.cm-action',function(){
            var title = $(this).siblings('.cm-title').text();
            var description = $(this).siblings('.cm-description').text();
            var source=$(this).parent().siblings().children().attr('src');
            // var image ={
            //     'href': source,
            //     'type': 'image',
            //     'title': title,
            //     'description':description ,
            // }
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
        });
        
    });    
    
})(jQuery);