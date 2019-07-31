(function($) {
	var UndiscoveredTheme = {
		init: function(){
			this.nav();
			this.backToTop();
			this.initGallery();
		},

		nav: function(){
			$('.main-navigation .menu').slicknav({
				label: ''
			});
		},

		backToTop: function(){
			$().UItoTop({
				inDelay: 300,
				outDelay: 200,
				scrollSpeed: 350,
				text: ''
			});
		},

		initGallery: function(){
			$('.gallery').bxSlider({
				slideSelector: '.gallery-item',
				pager: false
			});
		}
	};
	// $(document).ready(function($) {
	// 	$(document).on('click' , '.click-on' , function(e){
	// 		e.preventDefault();
	// 		alert(0);
	// 		$(this).size(5)
	// 	})
	// });
	$(document).ready(function($) {
		UndiscoveredTheme.init();
	});
})(jQuery);
