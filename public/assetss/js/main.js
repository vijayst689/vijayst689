(function($){
	'use strict';
	// Mean Menu
	$('.mean-menu').meanmenu({
		meanScreenWidth: "991"
	});
	
	// Sticky, Go To Top JS
	$(window).on('scroll', function() {
		// Header Sticky JS
		if ($(this).scrollTop() >150){  
			$('.navbar-area').addClass("is-sticky");
		}
		else{
			$('.navbar-area').removeClass("is-sticky");
		};
	});


	// Others Option For Responsive JS 
	$(".others-option-for-responsive .dot-menu").on("click", function(){
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});




	// Choose Progress bar Slides JS
	$(document).ready(function(){
		progress_bar();
	});

	function progress_bar() {
		var speed = 30;
		var items = $('.progress-bar').find('.progress-bar-item');
		
		items.each(function() {
			var item = $(this).find('.progress');
			var itemValue = item.data('progress');
			var i = 0;
			var value = $(this);
			
			var count = setInterval(function(){
				if(i <= itemValue) {
					var iStr = i.toString();
					item.css({
						'width': iStr+'%'
					});
					value.find('.item-value').html(iStr +'%');
				}
				else {
					clearInterval(count);
				}
				i++;
			},speed);
		});
	}

	// Testimonial JS
	$(".testimonial-slider-info").owlCarousel({
		items:1,
		nav: true,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='ph-bold ph-arrow-left'></i>",
			"<i class='ph-bold ph-arrow-right'></i>",
		],
	});

	// Partner JS
	$(".partner-slider").owlCarousel({
		nav: false,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		responsive:{
			0:{
				items:2,
			},
			576:{
				items:3,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});

	// Categories JS
	$(".categories-slider-info").owlCarousel({
		nav: true,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: false,
		autoplayHoverPause: true,
		navText: [
			"<i class='ph-bold ph-arrow-left'></i>",
			"<i class='ph-bold ph-arrow-right'></i>",
		],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:2,
			},
			992:{
				items:3,
			},
			1200:{
				items:4,
			}
		}
	});

	// Go to Top 
	$(function(){
		// Scroll Event
		$(window).on('scroll', function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > 600) $('.go-top').addClass('active');
			if (scrolled < 600) $('.go-top').removeClass('active');
		});  
		// Click Event
		$('.go-top').on('click', function() {
			$("html, body").animate({ scrollTop: "0" },  500);
		});
	});

	// Preloader
	$(window).on('load', function() {
		$('.preloader-area').addClass('deactivate');

	});

	// Price Filter JS

	var $lowerSlider = $('#lower');
	var $upperSlider = $('#upper');

	$('#two').val($upperSlider.val());
	$('#one').val($lowerSlider.val());

	var lowerVal = parseInt($lowerSlider.val());
	var upperVal = parseInt($upperSlider.val());

	$upperSlider.on('input', function () {
		lowerVal = parseInt($lowerSlider.val());
		upperVal = parseInt($upperSlider.val());

		if (upperVal < lowerVal + 4) {
			$lowerSlider.val(upperVal - 4);
			if (lowerVal == $lowerSlider.attr('min')) {
				$upperSlider.val(4);
			}
		}
		$('#two').val($(this).val());
	});

	$lowerSlider.on('input', function () {
		lowerVal = parseInt($lowerSlider.val());
		upperVal = parseInt($upperSlider.val());

		if (lowerVal > upperVal - 4) {
			$upperSlider.val(lowerVal + 4);
			if (upperVal == $upperSlider.attr('max')) {
				$lowerSlider.val(parseInt($upperSlider.attr('max')) - 4);
			}
		}
		$('#one').val($(this).val());
	});
}(jQuery));


// Counter Js
if ("IntersectionObserver" in window) {  
	let counterObserver = new IntersectionObserver(function (entries, observer) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
			let counter = entry.target;
			let target = parseInt(counter.innerText);
			let step = target / 200;
			let current = 0;
			let timer = setInterval(function () {
				current += step;
				counter.innerText = Math.floor(current);
				if (parseInt(counter.innerText) >= target) {
				clearInterval(timer);
				}
			}, 10);
			counterObserver.unobserve(counter);
			}
		});
	});
	let counters = document.querySelectorAll(".counter");
	counters.forEach(function (counter) {
		counterObserver.observe(counter);
	});
}

// Mixitup
const getSortingId = document.getElementById('podcasts-sorting');
if (getSortingId) {
	let mixer = mixitup('.podcasts-sorting', {
		controls: {
			toggleDefault: 'none'
		}
	});
}


// ScrollCue
scrollCue.init();