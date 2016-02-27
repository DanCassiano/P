;
(function($) {
    var defaults = {
        position: 'bottom',
        height: '5px',
        col_1: '#159756',
        col_2: '#da4733',
        col_3: '#3b78e7',
        col_4: '#fdba2c',
        fadeIn: 200,
        fadeOut: 200,
        lincar: null
    }
    $.materialPreloader = function(options) {
        var settings = $.extend({}, defaults, options);

         if( settings.lincar != null)
         {
            posicao = 'position:absolute;';
         }
         else
         {
            posicao = 'position:fixed;';            
         }  

        $template =
            "<div id='materialPreloader' class='load-bar' style='height:" +
            settings.height + ";display:none; " +  posicao  + settings.position +
            ":0px'><div class='load-bar-container'><div class='load-bar-base base1' style='background:" +
            settings.col_1 +
            "'><div class='color red' style='background:" + settings.col_2 +
            "'></div><div class='color blue' style='background:" +
            settings.col_3 +
            "'></div><div class='color yellow' style='background:" +
            settings.col_4 +
            "'></div><div class='color green' style='background:" +
            settings.col_1 +
            "'></div></div></div> <div class='load-bar-container'><div class='load-bar-base base2' style='background:" +
            settings.col_1 +
            "'><div class='color red' style='background:" + settings.col_2 +
            "'></div><div class='color blue' style='background:" +
            settings.col_3 +
            "'></div><div class='color yellow' style='background:" +
            settings.col_4 +
            "'></div> <div class='color green' style='background:" +
            settings.col_1 + "'></div> </div> </div> </div>";

            
            if( settings.lincar != null)
            {                
                $( settings.lincar ).prepend($template);
            }
            else
            {             
                $('body').prepend($template);
            }
            
        this.on = function() {
            $('#materialPreloader').fadeIn(settings.fadeIn);
        }
        this.off = function() {
            $('#materialPreloader').fadeOut(settings.fadeOut);
        }
    }

      $.wait = function( seconds , callback )
    {
        if( callback == null || callback == undefined )
        {
            callback = function(){ console.log( 'Espere' ) };
        }
       return window.setTimeout( callback, seconds * 1000 );
    }
}(jQuery));
