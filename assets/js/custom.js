(function($){
    'use strict';
    $(function(){
        $('body').on('click','.cm-action',function(){
            var title = $(this).siblings('.cm-title').text();
            var description = $(this).siblings('.cm-description').text();
            var source=$(this).parent().siblings().children().attr('src');
            var image={
                'title': title,
                'description':description ,
            }
            var elementobj = (source === undefined)?image:Object.assign({'href': source,'type': 'image'},image);
            const content = GLightbox({
                elements: [
                   elementobj,
                ],
                autoplayVideos: true,
            });
                content.open();
        });
        
    });    
    
})(jQuery);