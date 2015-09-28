// Image Section Height
var windowHeight = $( window ).height();

				$( '.image-section' ) .css({'height': windowHeight +'px'});
		
				$( window ).resize(function(){
	
				var windowHeight = $( window ).height();
			
				$( '.image-section' ) .css({'height': windowHeight +'px'});
	
});
		