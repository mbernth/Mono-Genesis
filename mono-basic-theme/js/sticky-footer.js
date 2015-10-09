jQuery(function( $ ){
		$(window).load(function() {
 
			function stickyFooter() {
				var bodyHeight = $("body").height();
				var vwptHeight = $(window).height();
				if (vwptHeight > bodyHeight) {
					$(".footer-widgets").css("position","absolute").css("bottom",50);
					$(".footer-widgets").addClass('sticky');
					$(".site-footer").css("position","absolute").css("bottom",0);
					$(".site-footer").addClass('sticky');
				}
				else {
					$(".footer-widgets").css("position","static");
					$(".footer-widgets").removeClass('sticky');
					$(".site-footer").css("position","static");
					$(".site-footer").removeClass('sticky');
				}
			} stickyFooter();
 
			/*resize*/
			var isIE8 = $.browser.msie && +$.browser.version === 8;
			if (isIE8) {
				document.body.onresize = function () {
					stickyFooter();
				};
			} else {
				$(window).resize(function () {
					stickyFooter();
				});
			}
 
			// Orientation change
			window.addEventListener("orientationchange", function() {
				stickyFooter();
			});
 
	});
});