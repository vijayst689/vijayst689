/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. back-to-top
03. Common Js
04. Nice Select Js
05. Masonary Js
06. magnificPopup img view
07. magnificPopup video view
07. magnificPopup video view
08. Counter Js
09. mobile menu Js
10. for header lang
11. subscribe-popup
12. Search Js
13. Mouse Custom Cursor
14. tp-custom-accordion
15. Jquery Appear raidal
16. odometer Active
17. One Page Scroll Js
18. tp-header-sticky
19. tp-header-height
20. Parallax Js
21. Image tilt 3d effect using atropos
22. jarallax Js
23. custom animetion Js
****************************************************/

(function ($) {
	"use strict";

	var windowOn = $(window);
	////////////////////////////////////////////////////
	// 01. PreLoader Js
	$(window).on('load', function () {
		$(".preloader").fadeOut(500);
	});

	////////////////////////////////////////////////////
	// 02. back-to-top
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 300) {
			$('.back-to-top-wrapper').addClass('back-to-top-btn-show');
		} else {
			$('.back-to-top-wrapper').removeClass('back-to-top-btn-show');
		}
	});


	$('#back_to_top').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop:0}, '300');
	});

	// offcanvas
	$(".tp-offcanvas-open-btn").on("click", function () {
		$(".tp-offcanvas-area").addClass("opened");
		$(".body-overlay").addClass("opened");
	});
	$(".tp-offcanvas-close-btn").on("click", function () {
		$(".tp-offcanvas-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});

	// // 09. Body overlay Js
	$(".body-overlay").on("click", function () {
		$(".tp-offcanvas-area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 03. Common Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width") + "px");
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	$("[data-text-color]").each(function () {
		$(this).css("color", $(this).attr("data-text-color"));
	});


	////////////////////////////////////////////////////
	// 04. Nice Select Js
	$('.select').niceSelect();


	////////////////////////////////////////////////////
	// 05. Masonary Js
	$('.grid').imagesLoaded(function () {
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				columnWidth: '.grid-item',
			}
		});

		// filter items on button click
		$('.masonary-menu').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
		});

		//for menu active class
		$('.masonary-menu button').on('click', function (event) {
			$(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
			event.preventDefault();
		});

	});


	////////////////////////////////////////////////////
	// 06. magnificPopup img view
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	////////////////////////////////////////////////////
	// 07. magnificPopup video view
	$(".popup-video").magnificPopup({
		type: "iframe",
	});


	////////////////////////////////////////////////////
	// 09. mobile menu Js
	var tpMenuWrap = $('.tp-mobile-menu-active > ul').clone();
	var tpSideMenu = $('.tp-offcanvas-menu nav');
	tpSideMenu.append(tpMenuWrap);
	if ($(tpSideMenu).find('.tp-submenu').length != 0) {
		$(tpSideMenu).find('.tp-submenu').parent().append('<button class="tp-menu-close"><i class="far fa-chevron-right"></i></button>');
	}
	var sideMenuList = $('.tp-offcanvas-menu nav > ul > li button.tp-menu-close, .tp-offcanvas-menu nav > ul li.has-dropdown > a');
	$(sideMenuList).on('click', function (e) {
		e.preventDefault();
		if (!($(this).parent().hasClass('active'))) {
			$(this).parent().addClass('active');
			$(this).siblings('.tp-submenu').slideDown();
		} else {
			$(this).siblings('.tp-submenu').slideUp();
			$(this).parent().removeClass('active');
		}
	});

	////////////////////////////////////////////////////
	// 10. for header lang
	if ($("#tp-header-lang-toggle").length > 0) {
		$(document).on('click', function (e) {
			if ($(e.target).closest("#tp-header-lang-toggle").length > 0) {
				$(".tp-lang-list").toggleClass("tp-lang-list-open");
			} else {
				$(".tp-lang-list").removeClass("tp-lang-list-open");
			}
		});
	}
	

	////////////////////////////////////////////////////
	// 11. subscribe-popup
	if ($('.subscribe-popup').length) {

		function showPopup(){
			const timeLimit = 5
			let i=0;
			const timer = setInterval(function(){
				i++;
				if(i == timeLimit){
					clearInterval(timer);
					$(".subscribe-popup").addClass("show");
				} 
			}, 1000);
		}

		$(window).on('load', function(){
			showPopup();
		})
		
		$(".close").on("click", function () {
			$(".subscribe-popup").removeClass("show");
		});
	}

	////////////////////////////////////////////////////
	// 12. Search Js
	$(".search-click").on("click", function () {
		$(".tp-search-form-toggle,.body-overlay").addClass("active");
	});

	$(".tp-search-close,.body-overlay").on("click", function () {
		$(".tp-search-form-toggle,.body-overlay").removeClass("active");
	});


	//////////////////////////////////
	// 13. Mouse Custom Cursor
	function tpCursor() {
		var myCursor = $(".mouseCursor");
		if (myCursor.length) {
			if ($("body").length > 0) {
				const $cursorInner = $(".cursor-inner");
				const $cursorOuter = $(".cursor-outer");
			
				let mouseX = 0, 
					mouseY = 0, 
					isMoving = false;
			
				$(window).on("mousemove", function (event) {
					if (!isMoving) {
						$cursorOuter.css("transform", `translate(${event.clientX}px, ${event.clientY}px)`);
						$cursorInner.css("transform", `translate(${event.clientX}px, ${event.clientY}px)`);
						mouseX = event.clientX;
						mouseY = event.clientY;
					}
				});
			
				$("body").on("mouseenter", "button, a, .cursor-pointer", function () {
					$cursorInner.addClass("cursor-hover");
					$cursorOuter.addClass("cursor-hover");
				});
			
				$("body").on("mouseleave", "button, a, .cursor-pointer", function () {
					if (!$(this).is("a, button") || !$(this).closest(".cursor-pointer").length) {
						$cursorInner.removeClass("cursor-hover");
						$cursorOuter.removeClass("cursor-hover");
					}
				});
			
				$cursorInner.css("visibility", "visible");
				$cursorOuter.css("visibility", "visible");
			}
		}
	}
	tpCursor();

	$(".tp-cursor-point-area").on("mouseenter", function () {
		$(".mouseCursor").addClass("cursor-big");
	}).on("mouseleave", function(){
		$(".mouseCursor").removeClass("cursor-big");
	});
		

	//////////////////////////////////
	// 14. tp-custom-accordion

	$('.tp-custom-accordion .accordion-items').on("click", function(){
		$(this).addClass('tp-faq-active').siblings().removeClass('tp-faq-active');
	});



	////////////////////////////////////////////////////
	// 17. One Page Scroll Js
	function scrollNav() {
		$('.tp-onepage-menu li a').on("click", function(){
		  $(".tp-onepage-menu li a.active").removeClass("active");     
		  $(this).addClass("active");
		  
		  $('html, body').stop().animate({
			scrollTop: $($(this).attr('href')).offset().top - 96
		  }, 300);
		  return false;
		});
	  }
	scrollNav();

	////////////////////////////////////////////////////
	// 18. tp-header-sticky
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 400) {
			$("#tp-header-sticky").removeClass("tp-header-sticky");
		} else {
			$("#tp-header-sticky").addClass("tp-header-sticky");
		}
	});

	////////////////////////////////////////////////////
	// 19. tp-header-height
	if ($('.tp-header-height').length > 0) {
			
		$(".tp-header-height").each(function () {
			$(this).css({
				'height' : $(this).height()
			});
		});
	}

	////////////////////////////////////////////////////
	// 20. Parallax Js
	if ($('.scene').length > 0) {
		$('.scene').parallax({
			scalarX: 5.0,
			scalarY: 5.0,
		});
	};
	if ($('.scene-y').length > 0) {
		$('.scene-y').parallax({
			scalarY: 5.0,
			scalarX: 0,
		});
	};

	////////////////////////////////////////////////////
	// 21. Image tilt 3d effect using atropos

    var atroposItems = document.querySelectorAll("[data-atropos]");
    function initAtropos() {
        if (atroposItems.length && $(window).width() > 1199) {
            atroposItems.forEach(function (atroposItem) {
                var myAtropos = Atropos({ el: atroposItem });
            });
        }
    }
    if (typeof Atropos !== "undefined" && Atropos !== null) {
        initAtropos();
    }
    function destroyAtropos() {
        if (atroposItems.length && $(window).width() > 1199) {
            atroposItems.forEach(function (atroposItem) {
                if (atroposItem.__atropos__) {
                    atroposItem.__atropos__.destroy();
                }
            });
        }
    }
    var getElementsInArea = (function (docElm) {
        var viewportHeight = docElm.clientHeight;
        return function (e, opts) {
            var found = [],
                i;
            if (e && e.type == "resize") {
                viewportHeight = docElm.clientHeight;
            }
            for (i = opts.elements.length; i--; ) {
                var elm = opts.elements[i],
                    pos = elm.getBoundingClientRect(),
                    topPerc = (pos.top / viewportHeight) * 100,
                    bottomPerc = (pos.bottom / viewportHeight) * 100,
                    middle = (topPerc + bottomPerc) / 2,
                    inViewport = middle > opts.zone[1] && middle < 100 - opts.zone[1];
                elm.classList.toggle(opts.markedClass, inViewport);
                if (inViewport) {
                    found.push(elm);
                }
            }
        };
    })(document.documentElement);
 
	////////////////////////////////////////////////////
	// 22. jarallax Js
	if ($('.jarallax').length > 0) {
		$('.jarallax').jarallax({
			speed: 0.2,
			imgWidth: 1200,
			imgHeight: 520,
		});
	};


	////////////////////////////////////////////////////
	// 23. custom animetion Js


	    // custom-variables
		var animeBreakPoint = 1199;
		$(".vertical-counter, .counter, .progress-bar, .pie-chart-style-01, .attractive-hover, .splitting-animation, .section-dark, footer, [data-anime], [data-fancy-text]").each(function () {
			$(this).appear().trigger("resize");
		});
	
		// custom-function
		function getWindowHeight() {
			return $(window).height();
		}
		function getWindowWidth() {
			return $(window).width();
		}
	
		// animeAnimation-active
		function animeAnimation(target, options) {
			let child = target;
			let staggerValue = options.staggervalue || 0;
			let delay = options.delay || 0;
			let anime_animation = anime.timeline();
			function applyTransitionStyles(elements) {
				for (let i = 0; i < elements.length; i++) {
					const element = elements[i];
					element.style.transition = "none";
					if (options.willchange) {
						element.style.willChange = "transform";
					}
				}
			}
			if (options.el === "childs") {
				child = target.children;
				applyTransitionStyles(target.children);
			}
			if (options.el === "lines") {
				function lineSplitting() {
					const lines = Splitting({ target: target, by: "lines" });
					const line = lines[0].lines.map((item) => item.map((i) => i.innerHTML).join(" "));
					target.innerHTML = line.map((item) => `<span class="d-inline-flex">${item}</span>`).join(" ");
				}
				lineSplitting();
				applyTransitionStyles(target.children);
				child = target.children;
			}
			if (options.el === "words") {
				function lineSplitting() {
					const words = Splitting({ target: target, by: "words" });
					const word = words[0].words.join(" ");
				}
				lineSplitting();
				applyTransitionStyles(target.children);
				child = target.children;
			}
			if (options.perspective) {
				target.style.perspective = `${options.perspective}px`;
			}
			if (options.willchange) {
				target.style.willChange = options.willchange;
			}
			anime_animation.add({
				targets: child,
				...options,
				delay: anime.stagger(staggerValue, { start: delay }),
				complete: function () {
					if (options.el) {
						target.classList.add("anime-child");
						target.classList.add("anime-complete");
						for (let i = 0; i < target.children.length; i++) {
							const element = target.children[i];
							element.style.removeProperty("opacity");
							element.style.removeProperty("transform");
							element.style.removeProperty("transition");
							if (target.classList.contains("grid")) {
								element.style.transition = "none";
							}
						}
						if (options.el === "lines") {
							for (let i = 0; i < target.children.length; i++) {
								const element = target.children[i];
								element.classList.remove("d-inline-flex");
								element.classList.add("d-inline");
								element.style.willChange = "inherit";
							}
						}
					} else {
						target.classList.add("anime-complete");
						target.style.removeProperty("opacity");
						target.style.removeProperty("transform");
						target.style.removeProperty("transition");
					}
				},
			});
		}
		
		const $dataAnimeElements = $("[data-anime]:not(.swiper [data-anime])");
		$dataAnimeElements.each(function () {
			const $self = $(this);
			const animeOptions = $self.data("anime");
			if (animeOptions && getWindowWidth() > animeBreakPoint) {
				try {
					const effect = animeOptions.effect && animeOptions.effect.toLowerCase();
					$self.on("appear", function () {
						if (!$self.hasClass("appear")) {
							$self.addClass("appear");
							if (effect === "slide") {
								slideAnimation(this, animeOptions);
							} else {
								animeAnimation(this, animeOptions);
							}
						}
						if ($self.hasClass("grid")) {
							$self.find(".grid-sizer").removeAttr("style");
						}
					});
				} catch (error) {
					console.error("Error parsing anime options:", error);
				}
			} else {
				$self.removeAttr("data-anime");
				$("body").addClass("no-animation");
			}
		});

	
		// counter-area-start
		$(".vertical-counter").each(function () {
			var _this = $(this),
				counterValue = _this.attr("data-to"),
				individualValue = counterValue.toString().split(""),
				valueLength = counterValue.length;
			for (var i = 0; i < valueLength; i++) {
				_this.append('<span class="vertical-counter-number"><ul><li>0</li><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li></ul></span>');
			}
			_this.find(".vertical-counter-number").each(function (index) {
				$(this).attr("data-to", individualValue[index]);
			});
		});
	
		if ($(".vertical-counter").length) {
			function calculateHeight() {
				$(".vertical-counter").each(function () {
					var _this = $(this),
						divHeight = _this.find(".vertical-counter-number").find("li").height();
					$(this).height(divHeight);
				});
			}
			calculateHeight();

			$(window).on('resize', function(){
				calculateHeight();
			})

			$(document).on("appear", ".vertical-counter", function (e) {
				if (!$(this).hasClass("appear")) {
					$(this).addClass("appear");
					if ($(window).scrollTop() + getWindowHeight() >= $(".vertical-counter").offset().top) {
						$(this).find(".vertical-counter-number").each(function () {
							var _this = $(this),
								value = _this.attr("data-to");
							if (value <= 9) {
								anime({ targets: this.querySelector("ul"), translateY: [0, `${-value * 10}%`], duration: 2000, easing: "easeOutCubic" });
							}
						});
					}
				}
			});
			$('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
				let hrefT = $(this).attr("href");
				let activeTabPane = $(`${hrefT}`);
				activeTabPane.find(".vertical-counter").each(function () {
					var _this = $(this),
						value = _this.attr("data-to"),
						divHeight = _this.find("li").height();
					_this.height(divHeight);
					if (value <= 9) {
						_this.find("ul").css({ transform: "translateY(-" + value * 10 + "%)" });
					}
				});
			});
		}
		
		// progress-bar-start
		if ($(".progress-bar").length) {
			$(document).on("appear", ".progress-bar", function (e) {
				if (!$(this).hasClass("appear")) {
					$(this).addClass("appear");
					var total = $(this).attr("aria-valuenow"),
						delay = 300;
					$(this).animate(
						{ width: total + "%" },
						{
							duration: delay,
							easing: "swing",
							progress: function (animation, progress, msRemaining) {
								var counter = Number(total * progress);
							},
						}
					);
				}
			});
		}
	
		// pie-chart-style-01
		if ($(".pie-chart-style-01").length) {
			if (typeof $.fn.easyPieChart === "function") {
				var color1, color2;
				$(document.body).on("appear", ".pie-chart-style-01", function (e) {
					$(".pie-chart-style-01").easyPieChart({
						trackColor: "#232323",
						scaleColor: "",
						lineCap: "round",
						lineWidth: 10,
						size: 90,
						barColor: function () {
							color1 = $(this.el).attr("data-start-color") || $(this.el).attr("data-bar-color") || "#000";
							color2 = $(this.el).attr("data-end-color") || $(this.el).attr("data-bar-color") || "#000";
							var ctx = this.renderer.getCtx();
							var canvas = this.renderer.getCanvas();
							var gradient = ctx.createLinearGradient(0, 0, canvas.width, 270);
							gradient.addColorStop(0.2, color1);
							gradient.addColorStop(0, color2);
							return gradient;
						},
						animate: { duration: 2000, enabled: true },
						onStep: function (from, to, percent) {
							$(this.el).find(".percent").text(Math.round(percent) + "%");
						},
					});
				});
			}
		}


	
})(jQuery);