//PopUp Video
$(document).ready(function() {

    $('.free_video_popup').magnificPopup({
        type: 'iframe',
        // other options
        iframe: {
            markup: '<div class="mfp-iframe-scaler">'+
                      '<div class="mfp-close"></div>'+
                      '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>', 
          
            patterns: {
              youtube: {
                index: 'youtube.com/', 
          
                id: 'v=',

                src: 'https://www.youtube.com/embed/%id%' 
              },
             
          
            },
          
            srcAction: 'iframe_src', 
          }
      });
      
});
