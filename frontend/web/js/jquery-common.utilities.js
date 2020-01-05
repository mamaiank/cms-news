function bxsliderCarousel() {
	$('.bxslider-carousel').bxSlider({
		controls: false,
	  	minSlides: 3,
	  	maxSlides: 4,
	  	slideWidth: 72,
	  	slideMargin: 10
	});
}

function goBack() {
    window.history.back();
}

function bxslideText() {
	$('.bxslider-text').bxSlider({auto: false,
		auto: true,
		autoHover: true,
		controls: false,
		pager: false,
		mode: 'vertical',
		easing: 'easeOutElastic',
		slideMargin: 5
	});
}

function slidePromo() {
	$('.slide-promo').bxSlider({
		controls: true,
		pager: false,
	    slideWidth: 360,
	    minSlides: 1,
	    maxSlides: 3,
	    slideMargin: 30,
	    //nextSelector: '#slider-next',
		//prevSelector: '#slider-prev',
		//nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		//prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
	  });
}