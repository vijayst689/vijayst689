/***************************************************
==================== JS INDEX ======================
****************************************************
01. tp-brand-digi-slider-active
02. tp-testimonial-digi-slide
03. tp-portfolio-digi-slide
04. tp-hero-cpr-zoom
05. tp-service-cpr-slider
06. tp-portfolio-cpr-slide
07. tp-service-lwr-slide
08. tp-testimonial-lwr-slide
09. tp-testimonial-lwr-2-slide
10. tp-contact-med-slide-active
11. tp-testimonial-med-slide
12. tp-service-salon-slide
13. tp-testimonial-salon-slide
14. tp-testimonial-salon-2-slide
15. tp-brand-crt-slider-active
16. tp-service-it-slide
17. tp-testimonial-it-active
18. tp-portfolio-it-apps
19. tp-instagram-slide
20. tp-testimonial-pizza-2-slide
21. tp-history-pizza-slider-active
22. tp-testimonial-cpc-slider-active
23. tp-offer-cpc-slider-active
24. tp-hero-port-slide
****************************************************/

(function ($) {
	"use strict";

    ////////////////////////////////////////////////////
	// 01. tp-brand-digi-slider-active
    var tp_brand_slide = new Swiper(".tp-brand-digi-slider-active", {
        loop: true,
        freemode: true,
        slidesPerView: 'auto',
        spaceBetween: 30,
        centeredSlides: true,
        allowTouchMove: false,
        speed: 4000,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
        },
    });

	////////////////////////////////////////////////////
	// 02. tp-testimonial-digi-slide
	var slider = new Swiper('.tp-testimonial-digi-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 30,
		centeredSlides:true,
		loop: true,
		navigation: {
			nextEl: ".tp-testimonial-digi-next",
			prevEl: ".tp-testimonial-digi-prev",
		},
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


	////////////////////////////////////////////////////
	// 03. tp-portfolio-digi-slide
	var slider = new Swiper('.tp-portfolio-digi-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 30,
		loop: true,
		navigation: {
			nextEl: ".tp-testimonial-digi-next",
			prevEl: ".tp-testimonial-digi-prev",
		},
		autoplay: {
			delay: 4000,
		},
	});

	////////////////////////////////////////////////////
	// 04.  tp-hero-cpr-zoom
	var slider = new Swiper('.tp-hero-cpr-zoom', {
		slidesPerView: 1,
		speed:1500,
		spaceBetween: 0,
		loop: true,
		parallax: true,
		autoplay: {
			delay: 3500,
		},
	});


	////////////////////////////////////////////////////
	// 05. tp-service-cpr-slider
	var slider = new Swiper('.tp-service-cpr-slider', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 30,
		loop: true,
		navigation: {
			nextEl: ".tp-service-cpr-next",
			prevEl: ".tp-service-cpr-prev",
		},
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 06. tp-portfolio-cpr-slide
	var slider = new Swiper('.tp-portfolio-cpr-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 70,
		loop: true,
		autoplay: {
			delay: 4000,
		},
	});

	////////////////////////////////////////////////////
	// 07. tp-service-lwr-slide
	var slider = new Swiper('.tp-service-lwr-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 24,
		loop: true,
		navigation: {
			nextEl: ".tp-service-lwr-next",
			prevEl: ".tp-service-lwr-prev",
		},
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


	////////////////////////////////////////////////////
	// 08. tp-testimonial-lwr-slide
	var slider = new Swiper('.tp-testimonial-lwr-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 30,
		loop: true,
		navigation: {
			nextEl: ".tp-testimonial-lwr-next",
			prevEl: ".tp-testimonial-lwr-prev",
		},
		autoplay: {
			delay: 4000,
		},
	});


	////////////////////////////////////////////////////
	// 09. tp-testimonial-lwr-2-slide
	var swiper = new Swiper(".tp-testimonial-lwr-2-slide", {
		slidesPerView: 1,
		speed:1000,
		spaceBetween: 40,
		loop: true,
			pagination: {
				el: ".tp-testimonial-lwr-2-pagination",
				type: "fraction",
			},
			navigation: {
				nextEl: ".tp-testimonial-lwr-2-next",
				prevEl: ".tp-testimonial-lwr-2-prev",
			},
	  });

	////////////////////////////////////////////////////
	// 10. tp-contact-med-slide-active
	var swiper_2 = new Swiper(".tp-contact-med-slide-active", {
		spaceBetween: 5,
		speed:1000,
		loop: true,
		autoplay:true,
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 11. tp-testimonial-med-slide
	var slider = new Swiper('.tp-testimonial-med-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 24,
		loop: true,
		centeredSlides:true,
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 12. tp-service-salon-slide
	var slider = new Swiper('.tp-service-salon-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 24,
		loop: true,
		navigation: {
			nextEl: ".tp-service-salon-next",
			prevEl: ".tp-service-salon-prev",
		},
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 13. tp-testimonial-salon-slide
	var slider = new Swiper('.tp-testimonial-salon-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 24,
		loop: true,
		navigation: {
			prevEl: ".tp-testimonial-salon-prev",
			nextEl: ".tp-testimonial-salon-next",
		},
		autoplay: {
			delay: 4000,
		},
	});

	////////////////////////////////////////////////////
	// 14. tp-testimonial-salon-2-slide
	var slider = new Swiper('.tp-testimonial-salon-2-slide', {
		slidesPerView: 1,
		speed: 700,
		spaceBetween: 24,
		loop: true,
		centeredSlides:true,
		autoplay: {
			delay: 4000,
		},
		pagination: {
			el: ".tp-testimonial-salon-pagination",
			clickable: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

    ////////////////////////////////////////////////////
	// 15. tp-brand-crt-slider-active
    var tp_brand_slide = new Swiper(".tp-brand-crt-slider-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		spaceBetween: 45,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 4000,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
    });

	////////////////////////////////////////////////////
	// 16. tp-service-it-slide
	var slider = new Swiper('.tp-service-it-slide', {
		slidesPerView: 1,
		speed: 500,
		spaceBetween: 24,
		loop: true,
		navigation: {
			nextEl: ".tp-service-it-next",
			prevEl: ".tp-service-it-prev",
		},
		autoplay: {
			delay: 4000,
		  },
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'991': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	// 17. tp-testimonial-it-active
	var swiper = new Swiper(".tp-testimonial-it-active", {
		spaceBetween: 60,
		speed:1000,
		loop: true,
		autoplay:true,
		navigation: {
			nextEl: ".tp-testimonial-it-next",
			prevEl: ".tp-testimonial-it-prev",
		},
		breakpoints: {
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 18. tp-portfolio-it-appse
	var slider = new Swiper('.tp-portfolio-it-appse', {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		spaceBetween: 70,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 4000,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
		breakpoints: {
			'1200': {
				spaceBetween: 70,
			},
			'991': {
				spaceBetween: 40,
			},
			'768': {
				spaceBetween: 30,
			},
			'576': {
				spaceBetween: 20,
			},
			'0': {
				spaceBetween: 10,
			},
		},
	});

	////////////////////////////////////////////////////
	// 19. tp-instagram-slide
	var swiper = new Swiper(".tp-instagram-slide", {
		slidesPerView: 1,
		spaceBetween: 10,
		loop: true,
		breakpoints: {
			'1200': {
				slidesPerView: 5,
			},
			'991': {
				slidesPerView: 4,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 20. tp-testimonial-pizza-2-slide
	var swiper = new Swiper(".tp-testimonial-pizza-2-slide", {
		slidesPerView: 1,
		spaceBetween: 24,
		loop: true,
		breakpoints: {
			'1200': {
				slidesPerView: 2,
			},
			'991': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	
    ////////////////////////////////////////////////////
	// 21. tp-history-pizza-slider-active
    var tp_brand_slide = new Swiper(".tp-history-pizza-slider-active", {
        loop: true,
        freemode: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        allowTouchMove: false,
        speed: 4000,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
        },
    });

    ////////////////////////////////////////////////////
	// 22. tp-testimonial-cpc-slider-active
    var tp_brand_slide = new Swiper(".tp-testimonial-cpc-slider-active", {
        loop: true,
        freemode: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        allowTouchMove: false,
        speed: 4000,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
        },
    });


	////////////////////////////////////////////////////
	// 23. tp-offer-cpc-slider-active
    var tp_brand_slide = new Swiper(".tp-offer-cpc-slider-active", {
        loop: true,
        freemode: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        allowTouchMove: false,
        speed: 4000,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
        },
    });

	////////////////////////////////////////////////////
	// 24. tp-hero-port-slide
	var port_slider = new Swiper('.tp-hero-port-slide', {
		freemode: false,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
		mousewheel: {
			invert: true,
		  },
		keyboard: {
			enabled: true,
			onlyInViewport: true,
		},
		pagination: {
			el: ".tp-hero-port-pagination",
			dynamicBullets: true,
			clickable: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'991': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


})(jQuery);