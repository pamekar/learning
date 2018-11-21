(function ($) {
    "use strict";

    window.eltdf = {};
    eltdf.modules = {};

    eltdf.scroll = 0;
    eltdf.window = $(window);
    eltdf.document = $(document);
    eltdf.windowWidth = $(window).width();
    eltdf.windowHeight = $(window).height();
    eltdf.body = $('body');
    eltdf.html = $('html, body');
    eltdf.htmlEl = $('html');
    eltdf.menuDropdownHeightSet = false;
    eltdf.defaultHeaderStyle = '';
    eltdf.minVideoWidth = 1500;
    eltdf.videoWidthOriginal = 1280;
    eltdf.videoHeightOriginal = 720;
    eltdf.videoRatio = 1.61;
    eltdf.animationEnd = animationEventEnd();

    eltdf.eltdfOnDocumentReady = eltdfOnDocumentReady;
    eltdf.eltdfOnWindowLoad = eltdfOnWindowLoad;
    eltdf.eltdfOnWindowResize = eltdfOnWindowResize;
    eltdf.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if (eltdf.body.hasClass('eltdf-dark-header')) {
            eltdf.defaultHeaderStyle = 'eltdf-dark-header';
        }
        if (eltdf.body.hasClass('eltdf-light-header')) {
            eltdf.defaultHeaderStyle = 'eltdf-light-header';
        }
    }

    /* 
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {

    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdfOnWindowResize() {
        eltdf.windowWidth = $(window).width();
        eltdf.windowHeight = $(window).height();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
        eltdf.scroll = $(window).scrollTop();
    }

    /* 
     Animation event end function
     */
    function animationEventEnd() {
        var el = document.createElement("animationDetector");

        var animations = {
            "animation": "animationend",
            "OAnimation": "oAnimationEnd",
            "MozAnimation": "animationend",
            "WebkitAnimation": "webkitAnimationEnd"
        }

        for (var t in animations) {
            if (el.style[t] !== undefined) {
                return animations[t];
            }
        }
    }

    //set boxed layout width variable for various calculations

    switch (true) {
        case eltdf.body.hasClass('eltdf-grid-1300'):
            eltdf.boxedLayoutWidth = 1350;
            //eltdf.gridWidth = 1300;
            break;
        case eltdf.body.hasClass('eltdf-grid-1200'):
            eltdf.boxedLayoutWidth = 1250;
            //eltdf.gridWidth = 1200;
            break;
        case eltdf.body.hasClass('eltdf-grid-1000'):
            eltdf.boxedLayoutWidth = 1050;
            //eltdf.gridWidth = 1000;
            break;
        case eltdf.body.hasClass('eltdf-grid-800'):
            eltdf.boxedLayoutWidth = 850;
            //eltdf.gridWidth = 800;
            break;
        default :
            eltdf.boxedLayoutWidth = 1150;
            //eltdf.gridWidth = 1100;
            break;
    }

    eltdf.gridWidth = function () {
        var gridWidth = 1100;

        switch (true) {
            case eltdf.body.hasClass('eltdf-grid-1300') && eltdf.windowWidth > 1400:
                gridWidth = 1300;
                break;
            case eltdf.body.hasClass('eltdf-grid-1200') && eltdf.windowWidth > 1300:
                gridWidth = 1200;
                break;
            case eltdf.body.hasClass('eltdf-grid-1000') && eltdf.windowWidth > 1200:
                gridWidth = 1200;
                break;
            case eltdf.body.hasClass('eltdf-grid-800') && eltdf.windowWidth > 1024:
                gridWidth = 800;
            default :
                break;
        }

        return gridWidth;
    };

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    eltdf.modules.common = common;

    common.eltdfFluidVideo = eltdfFluidVideo;
    common.eltdfEnableScroll = eltdfEnableScroll;
    common.eltdfDisableScroll = eltdfDisableScroll;
    common.eltdfOwlSlider = eltdfOwlSlider;
    common.eltdfInitParallax = eltdfInitParallax;
    common.eltdfInitSelfHostedVideoPlayer = eltdfInitSelfHostedVideoPlayer;
    common.eltdfSelfHostedVideoSize = eltdfSelfHostedVideoSize;
    common.eltdfPrettyPhoto = eltdfPrettyPhoto;
	common.eltdfStickySidebarWidget = eltdfStickySidebarWidget;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.setFixedImageProportionSize = setFixedImageProportionSize;
    common.eltdfInitPerfectScrollbar = eltdfInitPerfectScrollbar;

    common.eltdfOnDocumentReady = eltdfOnDocumentReady;
    common.eltdfOnWindowLoad = eltdfOnWindowLoad;
    common.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfIconWithHover().init();
	    eltdfDisableSmoothScrollForMac();
	    eltdfInitAnchor().init();
	    eltdfInitBackToTop();
	    eltdfBackButtonShowHide();
	    eltdfInitSelfHostedVideoPlayer();
	    eltdfSelfHostedVideoSize();
	    eltdfFluidVideo();
	    eltdfOwlSlider();
	    eltdfPreloadBackgrounds();
	    eltdfPrettyPhoto();
	    eltdfSearchPostTypeWidget();
	    eltdfDashboardForm();
		eltdfInitGridMasonryListLayout();
		eltdfSmoothTransition();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitParallax();
	    eltdfStickySidebarWidget().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
	    eltdfInitGridMasonryListLayout();
    	eltdfSelfHostedVideoSize();
    }
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function eltdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && eltdf.body.hasClass('eltdf-smooth-scroll')) {
			eltdf.body.removeClass('eltdf-smooth-scroll');
		}
	}
	
	function eltdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', eltdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = eltdfWheel;
		document.onkeydown = eltdfKeydown;
	}
	
	function eltdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', eltdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function eltdfWheel(e) {
		eltdfPreventDefaultValue(e);
	}
	
	function eltdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				eltdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function eltdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var eltdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			var headers = $('.eltdf-main-menu, .eltdf-mobile-nav, .eltdf-fullscreen-menu');
			
			headers.each(function(){
				var currentHeader = $(this);
				
				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.eltdf-active-item').removeClass('eltdf-active-item');
					anchor.parent().addClass('eltdf-active-item');
					
					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-eltdf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];
			
			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}
			
			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}
				
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: '50%' });
			
			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}
					
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-eltdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.eltdf-main-menu a, .eltdf-mobile-nav a, .eltdf-fullscreen-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
				
				if(anchor.length) {
					anchor.each(function(){
						var thisAnchor = $(this);
						
						if(thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}
				
				eltdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-down-up') {
				eltdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > eltdf.modules.header.stickyAppearAmount);
			}
			
			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > eltdf.scroll)) {
					eltdf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = eltdf.modules.stickyHeader.isStickyVisible ? eltdfGlobalVars.vars.eltdfStickyHeaderTransparencyHeight : eltdfPerPageVars.vars.eltdfHeaderTransparencyHeight;
			
			if (eltdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			eltdf.document.on("click", ".eltdf-main-menu a, .eltdf-fullscreen-menu a, .eltdf-btn, .eltdf-anchor, .eltdf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
					
					setActiveState(anchor);
					
					eltdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-eltdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					
					$(window).load(function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function eltdfInitBackToTop() {
		var backToTopButton = $('#eltdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			eltdf.html.animate({scrollTop: 0}, eltdf.window.scrollTop() / 3, 'easeInOutExpo');
		});
	}
	
	function eltdfBackButtonShowHide() {
		eltdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				eltdfToTopButton('off');
			} else {
				eltdfToTopButton('on');
			}
		});
	}
	
	function eltdfToTopButton(a) {
		var b = $("#eltdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function eltdfInitSelfHostedVideoPlayer() {
		var players = $('.eltdf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function eltdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.eltdf-self-hosted-video-holder .eltdf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.eltdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / eltdf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function eltdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function eltdfSmoothTransition() {

		if (eltdf.body.hasClass('eltdf-smooth-page-transitions')) {

			//check for preload animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .eltdf-smooth-transition-loader.eltdf-mimic-ajax');
				loader.css('background-color', 'transparent');
				var academistPreloader = loader.find('.eltdf-loading-academist');

				if (academistPreloader.length) {	
					var eltdfTyped = academistPreloader.find('.eltdf-loading-text');
					var eltdfCheckmark = academistPreloader.find('.eltdf-loading-checkmark');
					
					var typingPreloader = function() {
						var preloaderString = eltdfTyped.text();
						var textArray = preloaderString.split('');
						var textArrayLength = textArray.length;
						var speed = 180;
						var i = 0;
						var tempText = "";
						eltdfTyped.css('opacity', 1);
						eltdfTyped.text("");

						var preloaderInterval = setInterval(function() {
							if (i < textArrayLength) {
								tempText += textArray[i];
								eltdfTyped.text(tempText);
								i++;
							} else {
								eltdfCheckmark.addClass("eltdf-animate-checkmark");
								setTimeout(function() {
									if (window.loaded) {
										setTimeout(function() {
											academistPreloader.addClass('eltdf-loading-academist-end');
											clearInterval(preloaderInterval);
											removePreloader();
										}, 1000);
									} else {
										$(window).load(function() {
											setTimeout(function() {
												academistPreloader.addClass('eltdf-loading-academist-end');
												clearInterval(preloaderInterval);
												removePreloader();
											}, 1000);
										});
									}
								}, 200);
							}
						}, speed);      
					}
					
					setTimeout(function() {
						academistPreloader.addClass('eltdf-loading-academist-start');
					}, 1000);
					

					setTimeout(function() {
						typingPreloader();
					}, 2000);

					var hidePreloader = function() {
						loader.fadeOut(300);
					}
	
					var removePreloader = function() {
						setTimeout(function() {
							hidePreloader();
							$(window).bind("pageshow", function(event) {
								if (event.originalEvent.persisted) {
									hidePreloader();
								}
							});
						}, 2000);
					}

					$(window).load(function() {
						window.loaded = true;
					});
				}
			}

			//check for fade out animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.on('click', function (e) {
					var a = $(this);

					if ((a.parents('.eltdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.eltdf-wrapper-inner').fadeOut(1000, function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'eltdf-preload-background' class
	 */
	function eltdfPreloadBackgrounds(){
		var preloadBackHolder = $('.eltdf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('eltdf-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('eltdf-preload-background'); }); //make sure that eltdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function eltdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

    function eltdfSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.eltdf-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.eltdf-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.eltdf-post-type-search-results'),
                    searchLoading = thisSearch.find('.eltdf-search-loading'),
                    searchIcon = thisSearch.find('.eltdf-search-icon');

                searchLoading.addClass('eltdf-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function() {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('eltdf-hidden');
                    searchIcon.addClass('eltdf-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('eltdf-hidden');
                            searchIcon.removeClass('eltdf-hidden');
                        } else {
                            var ajaxData = {
                                action: 'academist_elated_search_post_types',
                                term: searchTerm,
                                postType: postType
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('eltdf-hidden');
                                        searchIcon.removeClass('eltdf-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('eltdf-hidden');
                                    searchIcon.removeClass('eltdf-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('eltdf-hidden');
                    searchIcon.removeClass('eltdf-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/*
	 ** Init Masonry List Layout
	 */
	function eltdfInitGridMasonryListLayout() {
		var holder = $('.eltdf-grid-masonry-list');
		
		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltdf-masonry-list-wrapper'),
					size = thisHolder.find('.eltdf-masonry-grid-sizer').width();
				
				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltdf-item-space',
						percentPosition: true,
						masonry: {
							columnWidth: '.eltdf-masonry-grid-sizer',
							gutter: '.eltdf-masonry-grid-gutter'
						}
					});
					
					if (thisHolder.find('.eltdf-fixed-masonry-item').length || thisHolder.hasClass('eltdf-fixed-masonry-items')) {
						setFixedImageProportionSize(masonry, masonry.find('.eltdf-item-space'), size, true);
					}
					
					setTimeout(function () {
						eltdfInitParallax();
					}, 600);
					
					masonry.isotope('layout').css('opacity', 1);
				});
			});
		}
	}
	
	/**
	 * Initializes size for fixed image proportion - masonry layout
	 */
	function setFixedImageProportionSize(container, item, size, isFixedEnabled) {
		if (container.hasClass('eltdf-masonry-images-fixed') || isFixedEnabled === true) {
			var padding = parseInt(item.css('paddingLeft'), 10),
				newSize = size - 2 * padding,
				defaultMasonryItem = container.find('.eltdf-masonry-size-small'),
				largeWidthMasonryItem = container.find('.eltdf-masonry-size-large-width'),
				largeHeightMasonryItem = container.find('.eltdf-masonry-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.eltdf-masonry-size-large-width-height');

			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));

			if (eltdf.windowWidth > 680) {
				largeWidthMasonryItem.css('height', newSize);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			} else {
				largeWidthMasonryItem.css('height', Math.round(newSize / 2));
				largeWidthHeightMasonryItem.css('height', newSize);
			}
		}
	}

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.eltdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function eltdfInitParallax(){
		var parallaxHolder = $('.eltdf-parallax-row-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url('+image+')'});
				
				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}
	
	/*
	 **  Init sticky sidebar widget
	 */
	function eltdfStickySidebarWidget(){
		var sswHolder = $('.eltdf-widget-sticky-sidebar'),
			headerHolder = $('.eltdf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];
		
		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.eltdf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;
					
					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;
					
					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();
						
						var blogHolder = mainSidebarHolder.parent().parent().find('.eltdf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}
					
					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}
		
		function initStickySidebarWidget() {
			
			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i]['object'],
						thisWidgetTopOffset = objectsCollection[i]['offset'],
						thisWidgetTopPosition = objectsCollection[i]['position'],
						thisSidebarHeight = objectsCollection[i]['height'],
						thisSidebarWidth = objectsCollection[i]['width'],
						thisSidebarHolder = objectsCollection[i]['sidebarHolder'],
						thisSidebarHolderHeight = objectsCollection[i]['sidebarHolderHeight'];
					
					if (eltdf.body.hasClass('eltdf-fixed-on-scroll')) {
						var fixedHeader = $('.eltdf-fixed-wrapper.fixed');
						
						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + eltdfGlobalVars.vars.eltdfAddForAdminBar;
						}
					} else if (eltdf.body.hasClass('eltdf-no-behavior')) {
						headerHeight = eltdfGlobalVars.vars.eltdfAddForAdminBar;
					}
					
					if (eltdf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder
						
						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - eltdfGlobalVars.vars.eltdfTopBarHeight;
						
						if ((eltdf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('eltdf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}
							
							if (eltdf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;
								
								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}
		
		return {
			init: function () {
				addObjectItems();
				initStickySidebarWidget();
				
				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}

    /**
     * Init Owl Carousel
     */
    function eltdfOwlSlider() {
        var sliders = $('.eltdf-owl-slider');
        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    owlSlider = $(this),
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = true,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
	                responsiveMargin = 0,
	                responsiveMargin1 = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateInClass = false, // keyframe css animation
	                animateOutClass = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
	                thumbnail = false,
                    thumbnailSlider,
	                sliderIsCPTList = !!slider.hasClass('eltdf-list-is-slider'),
	                sliderDataHolder = sliderIsCPTList ? slider.parent() : slider;  // this is condition for cpt to set list to be slider

	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && ! sliderIsCPTList) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsCPTList) {
		            switch (sliderDataHolder.data('number-of-columns')) {
			            case 'one':
				            numberOfItems = 1;
				            break;
			            case 'two':
				            numberOfItems = 2;
				            break;
			            case 'three':
				            numberOfItems = 3;
				            break;
			            case 'four':
				            numberOfItems = 4;
				            break;
			            case 'five':
				            numberOfItems = 5;
				            break;
			            case 'six':
				            numberOfItems = 6;
				            break;
			            default :
				            numberOfItems = 4;
				            break;
		            }
	            }
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
		            autoplayHoverPause = false;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            if (sliderDataHolder.data('slider-margin') === 'no') {
			            margin = 0;
		            } else {
			            margin = sliderDataHolder.data('slider-margin');
		            }
	            } else {
		            if(slider.parent().hasClass('eltdf-huge-space')) {
			            margin = 80;
		            } else if (slider.parent().hasClass('eltdf-large-space')) {
			            margin = 50;
		            } else if (slider.parent().hasClass('eltdf-medium-space')) {
			            margin = 40;
		            } else if (slider.parent().hasClass('eltdf-normal-space')) {
			            margin = 30;
		            } else if (slider.parent().hasClass('eltdf-small-space')) {
			            margin = 20;
		            } else if (slider.parent().hasClass('eltdf-tiny-space')) {
			            margin = 10;
		            }

	            }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.28);
		            margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateInClass = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }
	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }

	            if (sliderDataHolder.data('enable-thumbnail') === 'yes') {
                    thumbnail = true;
	            }

	            if(thumbnail && !pagination) {
                    /* page.index works only when pagination is enabled, so we add through html, but hide via css */
	                pagination = true;
                    owlSlider.addClass('eltdf-slider-hide-pagination');
                }

	            if(navigation && pagination) {
		            slider.addClass('eltdf-slider-has-both-nav');
	            }

	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }

	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems,
		            responsiveNumberOfItems5 = numberOfItems;

	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }

	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	
	            if (numberOfItems > 5) {
		            responsiveNumberOfItems5 = 5;
	            }

	            if (stagePaddingEnabled || margin > 30) {
		            responsiveMargin = 20;
		            responsiveMargin1 = 30;
	            }

	            if (margin > 0 && margin <= 30) {
		            responsiveMargin = margin;
		            responsiveMargin1 = margin;
	            }

	            slider.waitForImages(function () {
		            owlSlider = slider.owlCarousel({
			            items: numberOfItems,
			            loop: loop,
			            autoplay: autoplay,
			            autoplayHoverPause: autoplayHoverPause,
			            autoplayTimeout: sliderSpeed,
			            smartSpeed: sliderSpeedAnimation,
			            margin: margin,
			            stagePadding: stagePadding,
			            center: center,
			            autoWidth: autoWidth,
			            animateIn: animateInClass,
			            animateOut: animateOutClass,
			            dots: pagination,
			            nav: navigation,
			            navText: [
				            '<span class="eltdf-prev-icon ' + eltdfGlobalVars.vars.sliderNavPrevArrow + '"></span>',
				            '<span class="eltdf-next-icon ' + eltdfGlobalVars.vars.sliderNavNextArrow + '"></span>'
			            ],
			            responsive: {
				            0: {
					            items: responsiveNumberOfItems1,
					            margin: responsiveMargin,
					            stagePadding: 0,
					            center: false,
					            autoWidth: false
				            },
				            681: {
					            items: responsiveNumberOfItems2,
					            margin: responsiveMargin1
				            },
				            769: {
					            items: responsiveNumberOfItems2,
					            margin: responsiveMargin1
				            },
				            1025: {
					            items: responsiveNumberOfItems4
				            },
				            1281: {
					            items: responsiveNumberOfItems5
				            },
				            1367: {
					            items: numberOfItems
				            }
			            },
			            onInitialize: function () {
				            slider.css('visibility', 'visible');
				            eltdfInitParallax();
				            if (slider.find('iframe').length || slider.find('video').length) {
					            setTimeout(function(){
						            eltdfSelfHostedVideoSize();
						            eltdfFluidVideo();
					            }, 500);
				            }
                            if(thumbnail) {
                                thumbnailSlider.find('.eltdf-slider-thumbnail-item:first-child').addClass('active');
                            }
			            },
                        onRefreshed: function() {
                            if(autoWidth === true) {
                                var oldSize = parseInt(slider.find('.owl-stage').css('width'));
                                slider.find('.owl-stage').css('width', (oldSize + 1) + 'px');
                            }
                        },
                        onTranslate: function(e) {
                            if(thumbnail) {
                                var index = e.page.index + 1;
                                thumbnailSlider.find('.eltdf-slider-thumbnail-item.active').removeClass('active');
                                thumbnailSlider.find('.eltdf-slider-thumbnail-item:nth-child(' + index + ')').addClass('active');
                            }
                        },
			            onDrag: function (e) {
				            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
					            var sliderIsMoving = e.isTrigger > 0;
					
					            if (sliderIsMoving) {
						            slider.addClass('eltdf-slider-is-moving');
					            }
				            }
			            },
			            onDragged: function () {
				            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout') && slider.hasClass('eltdf-slider-is-moving')) {
					
					            setTimeout(function () {
						            slider.removeClass('eltdf-slider-is-moving');
					            }, 500);
				            }
			            }
		            });
	            });

                if(thumbnail) {
                    thumbnailSlider = slider.parent().find('.eltdf-slider-thumbnail');

                    var numberOfThumbnails = parseInt(thumbnailSlider.data('thumbnail-count'));
                    var numberOfThumbnailsClass = '';

                    switch (numberOfThumbnails % 6) {
                        case 2 :
                            numberOfThumbnailsClass = 'two';
                            break;
                        case 3 :
                            numberOfThumbnailsClass = 'three';
                            break;
                        case 4 :
                            numberOfThumbnailsClass = 'four';
                            break;
                        case 5 :
                            numberOfThumbnailsClass = 'five';
                            break;
                        case 0 :
                            numberOfThumbnailsClass = 'six';
                            break;
                        default :
                            numberOfThumbnailsClass = 'six';
                            break;
                    }

                    if(numberOfThumbnailsClass !== '') {
                        thumbnailSlider.addClass('eltdf-slider-columns-' + numberOfThumbnailsClass)
                    }

                    thumbnailSlider.find('.eltdf-slider-thumbnail-item').on('click' ,function () {
                        $(this).siblings('.active').removeClass('active');
                        $(this).addClass('active');
                        owlSlider.trigger('to.owl.carousel', [$(this).index(), sliderSpeedAnimation]);
                    });
                }
            });
        }
    }

	function eltdfDashboardForm() {
		var forms = $('.eltdf-dashboard-form');

		if (forms.length) {
			forms.each(function () {
				var thisForm = $(this),
					btnText = thisForm.find('button'),
					updatingBtnText = btnText.data('updating-text'),
					updatedBtnText = btnText.data('updated-text'),
					actionName = thisForm.data('action');

				thisForm.on('submit', function (e) {
					e.preventDefault();
					var prevBtnText = btnText.html(),
						gallery = $(this).find('.eltdf-dashboard-gallery-upload-hidden'),
						namesArray = [];

					btnText.html(updatingBtnText);

					//get data
					var formData = new FormData();

					//get files
					gallery.each(function () {
						var thisGallery = $(this),
							thisName = thisGallery.attr('name'),
							thisRepeaterID = thisGallery.attr('id'),
							thisFiles = thisGallery[0].files,
							newName;

						//this part is needed for repeater with image uploads
						//adding specific names so they can be sorted in regular files and files in repeater
						if (thisName.indexOf("[") !== '-1') {
							newName = thisName.substring(0, thisName.indexOf("[")) + '_eltdf_regarray_';

							var firstIndex = thisRepeaterID.indexOf('['),
								lastIndex = thisRepeaterID.indexOf(']'),
								index = thisRepeaterID.substring(firstIndex + 1, lastIndex);

							namesArray.push(newName);
							newName = newName + index + '_';
						} else {
							newName = thisName + '_eltdf_reg_';
						}

						//if file not sent, send dummy file - so repeater fields are sent
						if (thisFiles.length === 0) {
							formData.append(newName, new File([""], "eltdf-dummy-file.txt", {
								type: "text/plain"
							}));
						}

						for (var i = 0; i < thisFiles.length; i++) {
							var allowedTypes = ['image/png','image/jpg','image/jpeg','application/pdf'];
							//security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
							if (thisFiles[i].name.match(/\./g).length === 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
								formData.append(newName + i, thisFiles[i]);
							}
						}
					});

					formData.append('action', actionName);

					//get data from form
					var otherData = $(this).serialize();
					formData.append('data', otherData);

					$.ajax({
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						url: eltdfGlobalVars.vars.eltdfAjaxUrl,
						success: function (data) {
							var response;
							response = JSON.parse(data);

							// append ajax response html
							eltdf.modules.socialLogin.eltdfRenderAjaxResponseMessage(response);
							if (response.status === 'success') {
								btnText.html(updatedBtnText);
								window.location = response.redirect;
							} else {
								btnText.html(prevBtnText);
							}
						}
					});

					return false;
				});
			});
		}
	}

    /**
     * Init Perfect Scrollbar
     */
    function eltdfInitPerfectScrollbar() {
        var defaultParams = {
            wheelSpeed: 0.6,
            suppressScrollX: true
        };

        var eltdfInitScroll = function (holder) {
            var ps = new PerfectScrollbar(holder.selector, defaultParams);
            $(window).resize(function () {
                ps.update();
            });
        };

        return {
            init: function (holder) {
                eltdfInitScroll(holder);
            }
        };
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    eltdf.modules.blog = blog;

    blog.eltdfOnDocumentReady = eltdfOnDocumentReady;
    blog.eltdfOnWindowLoad = eltdfOnWindowLoad;
    blog.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad)
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitAudioPlayer();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
	    eltdfInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function eltdfInitAudioPlayer() {
	    var players = $('audio.eltdf-blog-audio');
	
	    if (players.length) {
		    players.mediaelementplayer({
			    audioWidth: '100%'
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function eltdfInitBlogPagination(){
		var holder = $('.eltdf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.eltdf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('eltdf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltdf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('eltdf-showing');
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'academist_elated_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('eltdf-grid-masonry-list')){
								eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								eltdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), thisHolderInner.find('.eltdf-masonry-grid-sizer').width());
							} else {
								eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								eltdfInitAudioPlayer();
								eltdf.modules.common.eltdfOwlSlider();
								eltdf.modules.common.eltdfFluidVideo();
                                eltdf.modules.common.eltdfInitSelfHostedVideoPlayer();
                                eltdf.modules.common.eltdfSelfHostedVideoSize();
								
								if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
									eltdf.modules.common.eltdfStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('eltdf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.eltdf-blog-pag-load-more').hide();
			}
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
	"use strict";
	
	var footer = {};
    eltdf.modules.footer = footer;
	
	footer.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	 
	function eltdfOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .eltdf-footer-uncover');

		if (uncoverFooter.length && !eltdf.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.eltdf-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.eltdf-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	eltdf.modules.header = header;
	
	header.eltdfSetDropDownMenuPosition     = eltdfSetDropDownMenuPosition;
	header.eltdfSetDropDownWideMenuPosition = eltdfSetDropDownWideMenuPosition;
	
	header.eltdfOnDocumentReady = eltdfOnDocumentReady;
	header.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfSetDropDownMenuPosition();
		setTimeout(function(){
			eltdfDropDownMenu();
		}, 100);
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function eltdfSetDropDownMenuPosition() {
		var menuItems = $('.eltdf-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = eltdf.windowWidth - menuItemPosition;
				
				if (eltdf.body.hasClass('eltdf-boxed')) {
					menuItemFromLeft = eltdf.boxedLayoutWidth - (menuItemPosition - (eltdf.windowWidth - eltdf.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function eltdfSetDropDownWideMenuPosition(){
		var menuItems = $(".eltdf-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
                var menuItem = $(this);
				var menuItemSubMenu = menuItem.find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(eltdf.body.hasClass('eltdf-boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.eltdf-boxed .eltdf-wrapper .eltdf-wrapper-inner').outerWidth();
						left_position = left_position - (eltdf.windowWidth - boxedWidth) / 2;
						menuItemSubMenu.css({'left': -left_position, 'width': boxedWidth});

					} else if(eltdf.body.hasClass('eltdf-wide-dropdown-menu-in-grid')) {
                        //wide dropdown in grid case
                        menuItemSubMenu.css({'left': -left_position + (eltdf.windowWidth - eltdf.gridWidth()) / 2, 'width': eltdf.gridWidth()});

                    }
                    else {
                        //wide dropdown full width case
                        menuItemSubMenu.css({'left': -left_position, 'width': eltdf.windowWidth});

					}
				}
			});
		}
	}
	
	function eltdfDropDownMenu() {
		var menu_items = $('.eltdf-drop-down > ul > li');
		
		menu_items.each(function() {
			var thisItem = $(this);
			
			if(thisItem.find('.second').length) {
				var dropDownHolder = thisItem.find('.second'),
					dropDownHolderHeight = !eltdf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;
				
				if(thisItem.hasClass('wide')) {
					var tallest = 0,
						dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');
					
					dropDownSecondItem.each(function() {
						var thisHeight = $(this).outerHeight();
						
						if(thisHeight > tallest) {
							tallest = thisHeight;
						}
					});
					
					dropDownSecondItem.css('height', '').height(tallest);
					
					if (!eltdf.menuDropdownHeightSet) {
						dropDownHolderHeight = dropDownHolder.outerHeight();
					}
				}
				
				if (!eltdf.menuDropdownHeightSet) {
					dropDownHolder.height(0);
				}
				
				if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					thisItem.on("touchstart mouseenter", function() {
						dropDownHolder.css({
							'height': dropDownHolderHeight,
							'overflow': 'visible',
							'visibility': 'visible',
							'opacity': '1'
						});
					}).on("mouseleave", function() {
						dropDownHolder.css({
							'height': '0px',
							'overflow': 'hidden',
							'visibility': 'hidden',
							'opacity': '0'
						});
					});
				} else {
					if (eltdf.body.hasClass('eltdf-dropdown-animate-height')) {
						var animateConfig = {
							interval: 0,
							over: function () {
								setTimeout(function () {
									dropDownHolder.addClass('eltdf-drop-down-start').css({
										'visibility': 'visible',
										'height': '0',
										'opacity': '1'
									});
									dropDownHolder.stop().animate({
										'height': dropDownHolderHeight
									}, 400, 'easeInOutQuint', function () {
										dropDownHolder.css('overflow', 'visible');
									});
								}, 100);
							},
							timeout: 100,
							out: function () {
								dropDownHolder.stop().animate({
									'height': '0',
									'opacity': 0
								}, 100, function () {
									dropDownHolder.css({
										'overflow': 'hidden',
										'visibility': 'hidden'
									});
								});
								
								dropDownHolder.removeClass('eltdf-drop-down-start');
							}
						};
						
						thisItem.hoverIntent(animateConfig);
					} else {
						var config = {
							interval: 0,
							over: function () {
								setTimeout(function () {
									dropDownHolder.addClass('eltdf-drop-down-start').stop().css({'height': dropDownHolderHeight});
								}, 150);
							},
							timeout: 150,
							out: function () {
								dropDownHolder.stop().css({'height': '0'}).removeClass('eltdf-drop-down-start');
							}
						};
						
						thisItem.hoverIntent(config);
					}
				}
			}
		});
		
		$('.eltdf-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		eltdf.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function eltdfOnDocumentReady() {
        eltdfLikes();
    }

    function eltdfLikes() {
        $(document).on('click','.eltdf-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'academist_elated_like',
                likes_id: id,
                type: type
            };

            var like = $.post(eltdfGlobalVars.vars.eltdfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
    "use strict";

    var sidearea = {};
    eltdf.modules.sidearea = sidearea;

    sidearea.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function eltdfSideArea() {
		var wrapper = $('.eltdf-wrapper'),
			sideMenu = $('.eltdf-side-menu'),
			sideMenuButtonOpen = $('a.eltdf-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (eltdf.body.hasClass('eltdf-side-menu-slide-from-right')) {
			$('.eltdf-cover').remove();
			cssClass = 'eltdf-right-side-menu-opened';
			wrapper.prepend('<div class="eltdf-cover"/>');
			slideFromRight = true;
		} else if (eltdf.body.hasClass('eltdf-side-menu-slide-with-content')) {
			cssClass = 'eltdf-side-menu-open';
			slideWithContent = true;
		} else if (eltdf.body.hasClass('eltdf-side-area-uncovered-from-content')) {
			cssClass = 'eltdf-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.eltdf-side-menu-button-opener, a.eltdf-close-side-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!sideMenuButtonOpen.hasClass('opened')) {
		        sideMenuButtonOpen.addClass('opened');
		        eltdf.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.eltdf-wrapper .eltdf-cover').on('click', function () {
				        eltdf.body.removeClass('eltdf-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(eltdf.scroll - currentScroll) > 400) {
				        eltdf.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            sideMenuButtonOpen.removeClass('opened');
	            eltdf.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        sideMenuButtonOpen.removeClass('opened');
			        eltdf.body.removeClass('eltdf-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);

(function ($) {
	"use strict";
	
	var subscribePopup = {};
	eltdf.modules.subscribePopup = subscribePopup;
	
	subscribePopup.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfSubscribePopup();
	}
	
	function eltdfSubscribePopup() {
		var popupOpener = $('.eltdf-subscribe-popup-holder'),
			popupClose = $('.eltdf-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.eltdf-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('eltdf-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.eltdf-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('eltdf-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('eltdf-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (eltdf.body.hasClass('eltdf-sp-opened')) {
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				} else {
					eltdf.body.addClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						eltdf.body.removeClass('eltdf-sp-opened');
						eltdf.modules.common.eltdfEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var title = {};
    eltdf.modules.title = title;

    title.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function eltdfParallaxTitle() {
		var parallaxBackground = $('.eltdf-title-holder.eltdf-bg-parallax');
		
		if (parallaxBackground.length > 0 && eltdf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('eltdf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(eltdf.scroll * parallaxRate),
				adminBarHeight = eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - eltdf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(eltdf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - eltdf.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

(function($) {
    'use strict';

    var woocommerce = {};
    eltdf.modules.woocommerce = woocommerce;

    woocommerce.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitQuantityButtons();
        eltdfInitSelect2();
	    eltdfInitSingleProductLightbox();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function eltdfInitQuantityButtons() {
		$(document).on('click', '.eltdf-quantity-minus, .eltdf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.eltdf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('eltdf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function eltdfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.eltdf-woocommerce-page .eltdf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function eltdfInitSingleProductLightbox() {
		var item = $('.eltdf-woo-single-page.eltdf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof eltdf.modules.common.eltdfPrettyPhoto === "function") {
				eltdf.modules.common.eltdfPrettyPhoto();
			}
		}
	}

})(jQuery);
(function($) {
    "use strict";

    var blogListSC = {};
    eltdf.modules.blogListSC = blogListSC;
    
    blogListSC.eltdfOnWindowLoad = eltdfOnWindowLoad;
    blogListSC.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(window).load(eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitBlogListShortcodePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
        eltdfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function eltdfInitBlogListShortcodePagination(){
        var holder = $('.eltdf-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.eltdf-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;

            if(!thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.eltdf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('eltdf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.eltdf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
                    thisHolder.addClass('eltdf-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('eltdf-showing');
                }

                var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'academist_elated_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('eltdf-bl-masonry')){
                                    eltdfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    eltdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                                        eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('eltdf-bl-masonry')){
                                    eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                                        eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('eltdf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.eltdf-blog-pag-load-more').hide();
            }
        };

        var eltdfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.eltdf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.eltdf-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.eltdf-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.eltdf-pag-next a');

            standardPagNumericItem.removeClass('eltdf-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('eltdf-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var eltdfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
            thisHolder.removeClass('eltdf-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                    eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var eltdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
            thisHolder.removeClass('eltdf-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('eltdf-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                    eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    eltdf.modules.headerMinimal = headerMinimal;
	
	headerMinimal.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function eltdfFullscreenMenu() {
	    var popupMenuOpener = $( 'a.eltdf-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".eltdf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.eltdf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.eltdf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.eltdf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.eltdf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.eltdf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(popupMenuHolderOuter);

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(eltdf.windowHeight);
            });

            if (eltdf.body.hasClass('eltdf-fade-push-text-right')) {
                cssClass = 'eltdf-push-nav-right';
                fadeRight = true;
            } else if (eltdf.body.hasClass('eltdf-fade-push-text-top')) {
                cssClass = 'eltdf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('eltdf-fm-opened')) {
                    popupMenuOpener.addClass('eltdf-fm-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-fade-out').addClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in');
                    eltdf.body.removeClass(cssClass);
                    eltdf.modules.common.eltdfDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('eltdf-fm-opened');
                            eltdf.body.removeClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                            eltdf.body.addClass(cssClass);
                            eltdf.modules.common.eltdfEnableScroll();

                            $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('eltdf-fm-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                    eltdf.body.addClass(cssClass);
                    eltdf.modules.common.eltdfEnableScroll();

                    $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent(),
					thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(thisItemParentSiblingsWithDrop.length === 0) {
			                submenu.slideDown(400, 'easeInOutQuint');
		                } else {
							thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which === 1) {
                        popupMenuOpener.removeClass('eltdf-fm-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-menu-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                        eltdf.body.addClass(cssClass);
                        $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        eltdf.modules.common.eltdfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    eltdf.modules.headerVertical = headerVertical;
	
	headerVertical.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var eltdfVerticalMenu = function() {
	    var verticalMenuObject = $('.eltdf-vertical-menu-area');

	    /**
	     * Checks if vertical area is scrollable (if it has eltdf-with-scroll class)
	     *
	     * @returns {bool}
	     */
	    var verticalAreaScrollable = function () {
		    return verticalMenuObject.hasClass('eltdf-with-scroll');
	    };
	
	    /**
	     * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
	     */
	    var initNavigation = function () {
		    var verticalNavObject = verticalMenuObject.find('.eltdf-vertical-menu');

		    if (verticalNavObject.hasClass('eltdf-vertical-dropdown-below')) {
				dropdownClickToggle();
			} else if (verticalNavObject.hasClass('eltdf-vertical-dropdown-side')) {
				dropdownFloat();
			}
		
		    /**
		     * Initializes click toggle navigation type. Works the same for touch and no-touch devices
		     */
		    function dropdownClickToggle() {
			    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
			
			    menuItems.each(function () {
				    var elementToExpand = $(this).find(' > .second, > ul');
				    var menuItem = this;
				    var dropdownOpener = $(this).find('> a');
				    var slideUpSpeed = 'fast';
				    var slideDownSpeed = 'slow';
				
				    dropdownOpener.on('click tap', function (e) {
					    e.preventDefault();
					    e.stopPropagation();
					
					    if (elementToExpand.is(':visible')) {
						    $(menuItem).removeClass('open');
						    elementToExpand.slideUp(slideUpSpeed);
					    } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('eltdf-vertical-menu')) {
						    $(this).parent().parent().children().removeClass('open');
						    $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    } else {
						
						    if (!$(this).parents('li').hasClass('open')) {
							    menuItems.removeClass('open');
							    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    if ($(this).parent().parent().children().hasClass('open')) {
							    $(this).parent().parent().children().removeClass('open');
							    $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    }
				    });
			    });
		    }


			/**
			 * Initializes click float navigation type
			 */
			function dropdownFloat() {
				var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
				var allDropdowns = menuItems.find(' > .second > .inner > ul, > ul');

				menuItems.each(function() {
					var elementToExpand = $(this).find(' > .second > .inner > ul, > ul');
					var menuItem = this;

					if(Modernizr.touch) {
						var dropdownOpener = $(this).find('> a');

						dropdownOpener.on('click tap', function(e) {
							e.preventDefault();
							e.stopPropagation();

							if(elementToExpand.hasClass('eltdf-float-open')) {
								elementToExpand.removeClass('eltdf-float-open');
								$(menuItem).removeClass('open');
							} else {
								if(!$(this).parents('li').hasClass('open')) {
									menuItems.removeClass('open');
									allDropdowns.removeClass('eltdf-float-open');
								}

								elementToExpand.addClass('eltdf-float-open');
								$(menuItem).addClass('open');
							}
						});
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$(this).hoverIntent({
							over: function() {
								elementToExpand.addClass('eltdf-float-open');
								$(menuItem).addClass('open');
							},
							out: function() {
								elementToExpand.removeClass('eltdf-float-open');
								$(menuItem).removeClass('open');
							},
							timeout: 300
						});
					}
				});
			}
	    };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                eltdf.modules.common.eltdfInitPerfectScrollbar().init(verticalMenuObject);
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();
                }
            }
        };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	eltdf.modules.mobileHeader = mobileHeader;
	
	mobileHeader.eltdfOnDocumentReady = eltdfOnDocumentReady;
	mobileHeader.eltdfOnWindowResize = eltdfOnWindowResize;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).resize(eltdfOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdfOnDocumentReady() {
		eltdfInitMobileNavigation();
		eltdfInitMobileNavigationScroll();
		eltdfMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function eltdfOnWindowResize() {
		eltdfInitMobileNavigationScroll();
	}
	
	function eltdfInitMobileNavigation() {
		var navigationOpener = $('.eltdf-mobile-header .eltdf-mobile-menu-opener'),
			navigationHolder = $('.eltdf-mobile-header .eltdf-mobile-nav'),
			dropdownOpener = $('.eltdf-mobile-nav .mobile_arrow, .eltdf-mobile-nav h6, .eltdf-mobile-nav a.eltdf-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('eltdf-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('eltdf-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this);
				
				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
					
					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');
						
						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('eltdf-opened');
						} else {
							thisItemParent.addClass('eltdf-opened');
							
							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							} else {
								thisItemParent.siblings().removeClass('eltdf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							}
						}
					}
				});
			});
		}
		
		$('.eltdf-mobile-nav a, .eltdf-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("eltdf-mobile-menu-opened");
			}
		});
	}
	
	function eltdfInitMobileNavigationScroll() {
		if (eltdf.windowWidth <= 1024) {
			var mobileHeader = $('.eltdf-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.eltdf-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = eltdf.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

			navigationHolder.height(scrollHeight);

			if ( navigationHolder.length ) {
				eltdf.modules.common.eltdfInitPerfectScrollbar().init(navigationHolder);
			}
		}
	}
	
	function eltdfMobileHeaderBehavior() {
		var mobileHeader = $('.eltdf-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.eltdf-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (eltdf.body.hasClass('eltdf-content-is-behind-header') && mobileHeaderHeight > 0 && eltdf.windowWidth <= 1024) {
			$('.eltdf-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (eltdf.body.hasClass('eltdf-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('eltdf-animate-mobile-header');
				} else {
					mobileHeader.removeClass('eltdf-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('eltdf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.eltdf-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    eltdf.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    if(eltdf.windowWidth > 1024) {
		    eltdfHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdfHeaderBehaviour() {
        var header = $('.eltdf-page-header'),
	        stickyHeader = $('.eltdf-sticky-header'),
            fixedHeaderWrapper = $('.eltdf-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.eltdf-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.eltdf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - eltdfGlobalVars.vars.eltdfAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-up'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(eltdfGlobalVars.vars.eltdfTopBarHeight) + parseInt(eltdfGlobalVars.vars.eltdfLogoAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfMenuAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
                        eltdf.body.removeClass('eltdf-sticky-header-appear');
                    } else {
                        eltdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    eltdf.body.addClass('eltdf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-down-up'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-sticky-header-on-scroll-down-up';

                if(eltdfPerPageVars.vars.eltdfStickyScrollAmount !== 0){
                    eltdf.modules.stickyHeader.stickyAppearAmount = parseInt(eltdfPerPageVars.vars.eltdfStickyScrollAmount);
                } else {
                    eltdf.modules.stickyHeader.stickyAppearAmount = parseInt(eltdfGlobalVars.vars.eltdfTopBarHeight) + parseInt(eltdfGlobalVars.vars.eltdfLogoAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(eltdf.scroll < eltdf.modules.stickyHeader.stickyAppearAmount) {
                        eltdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
	                    eltdf.body.removeClass('eltdf-sticky-header-appear');
                    }else{
                        eltdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    eltdf.body.addClass('eltdf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltdf.body.hasClass('eltdf-fixed-on-scroll'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(eltdf.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                eltdf.body.removeClass('eltdf-fixed-header-appear');
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                eltdf.body.addClass('eltdf-fixed-header-appear');
		                header.css('margin-bottom', fixedMenuAreaHeight + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var searchCoversHeader = {};
    eltdf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfSearchCoversHeader();
    }

    /**
     * Init Search Types
     */
    function eltdfSearchCoversHeader() {
        if (eltdf.body.hasClass('eltdf-search-covers-header')) {

            var searchOpener = $('a.eltdf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.each(function () {
                    var thisOpener = $(this);
                    thisOpener.on('click', function (e) {
                        e.preventDefault();

                        var thisSearchOpener = $(this),
                            searchFormHeight,
                            searchFormHeaderHolder = $('.eltdf-page-header'),
                            searchFormTopHeaderHolder = $('.eltdf-top-bar'),
                            searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.eltdf-fixed-wrapper.fixed'),
                            searchFormMobileHeaderHolder = $('.eltdf-mobile-header'),
                            searchForm = $('.eltdf-search-cover'),
                            searchFormIsInTopHeader = !!thisSearchOpener.parents('.eltdf-top-bar').length,
                            searchFormIsInFixedHeader = !!thisSearchOpener.parents('.eltdf-fixed-wrapper.fixed').length,
                            searchFormIsInStickyHeader = !!thisSearchOpener.parents('.eltdf-sticky-header').length,
                            searchFormIsInMobileHeader = !!thisSearchOpener.parents('.eltdf-mobile-header').length;

                        searchForm.removeClass('eltdf-is-active');

                        //Find search form position in header and height
                        if (searchFormIsInTopHeader) {
                            searchFormHeight = searchFormTopHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.eltdf-search-cover').addClass('eltdf-is-active eltdf-opener-in-top-header');
                            
                        } else if (searchFormIsInFixedHeader) {
                            searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.eltdf-search-cover').addClass('eltdf-is-active');

                        } else if (searchFormIsInStickyHeader) {
                            searchFormHeight = searchFormHeaderHolder.find('.eltdf-sticky-header').outerHeight();
                            searchFormHeaderHolder.children('.eltdf-search-cover').addClass('eltdf-is-active');

                        } else if (searchFormIsInMobileHeader) {
                            if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                                searchFormHeight = searchFormMobileHeaderHolder.children('.eltdf-mobile-header-inner').outerHeight();
                            } else {
                                searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                            }

                            searchFormMobileHeaderHolder.find('.eltdf-search-cover').addClass('eltdf-is-active');

                        } else {
                            searchFormHeight = searchFormHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.eltdf-search-cover').addClass('eltdf-is-active');
                        }

                        if (searchForm.hasClass('eltdf-is-active')) {
                            searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                        }

                        searchForm.find('.eltdf-search-close').on('click', function (e) {
                            e.preventDefault();
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('eltdf-opener-in-top-header')) {
                                    searchForm.removeClass('eltdf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('eltdf-is-active');
                        });

                        searchForm.blur(function () {
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('eltdf-opener-in-top-header')) {
                                    searchForm.removeClass('eltdf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('eltdf-is-active');
                        });

                        $(window).scroll(function () {
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('eltdf-opener-in-top-header')) {
                                    searchForm.removeClass('eltdf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('eltdf-is-active');
                        });
                    });
                });
            }
        }
    }

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreen = {};
    eltdf.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function eltdfSearchFullscreen() {
        if ( eltdf.body.hasClass( 'eltdf-fullscreen-search' ) ) {

            var searchOpener = $('a.eltdf-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.eltdf-fullscreen-search-holder'),
                    searchClose = $('.eltdf-search-close');

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('eltdf-animate')) {
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-out');
                        eltdf.body.removeClass('eltdf-search-fade-in');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    } else {
                        eltdf.body.addClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.removeClass('eltdf-search-fade-out');
                        searchHolder.addClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').focus();
                        }, 900);

                        eltdf.modules.common.eltdfDisableScroll();
                    }

                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.addClass('eltdf-search-fade-out');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".eltdf-form-holder-inner");

                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            e.preventDefault();
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            searchHolder.removeClass('eltdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            }, 300);

                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            searchHolder.removeClass('eltdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            }, 300);

                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.eltdf-fullscreen-search-holder .eltdf-search-field'),
                    inputSearchLine = $('.eltdf-fullscreen-search-holder .eltdf-field-holder .eltdf-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreenWithSidebar = {};
    eltdf.modules.searchFullscreenWithSidebar = searchFullscreenWithSidebar;

    searchFullscreenWithSidebar.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfSearchFullscreenWithSidebar();
    }
    
	/**
	 * Init Search Types
	 */
	function eltdfSearchFullscreenWithSidebar() {
        if ( eltdf.body.hasClass( 'eltdf-fullscreen-search-with-sidebar' ) ) {
            var searchOpener = $('a.eltdf-search-opener');

            if (searchOpener.length > 0) {
                var searchHolder = $('.eltdf-fullscreen-with-sidebar-search-holder'),
                    searchClose = $('.eltdf-search-close');

                eltdf.modules.common.eltdfInitPerfectScrollbar().init(searchHolder);

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('eltdf-animate')) {
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-out');
                        eltdf.body.removeClass('eltdf-search-fade-in');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    } else {
                        eltdf.body.addClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.removeClass('eltdf-search-fade-out');
                        searchHolder.addClass('eltdf-animate');

                        setTimeout(function () {
                           searchHolder.find('.eltdf-search-field').focus();
                        }, 900);

                        eltdf.modules.common.eltdfDisableScroll();
                    }
                    
                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.addClass('eltdf-search-fade-out');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    });
                    
                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            searchHolder.removeClass('eltdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            }, 300);

                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    });
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchSlideFromHB = {};
    eltdf.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function eltdfSearchSlideFromHB() {
        if ( eltdf.body.hasClass( 'eltdf-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.eltdf-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(eltdf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (eltdf.body.hasClass('eltdf-boxed') && eltdf.windowWidth > 1024) {
                        searchIconPosition -= parseInt((eltdf.windowWidth - $('.eltdf-boxed .eltdf-wrapper .eltdf-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.eltdf-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.eltdf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.eltdf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.eltdf-mobile-header'),
                        searchForm = $('.eltdf-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.eltdf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.eltdf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.eltdf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.eltdf-mobile-header').length;

                    searchForm.removeClass('eltdf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.eltdf-slide-from-header-bottom-holder').addClass('eltdf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + eltdfGlobalVars.vars.eltdfAddForAdminBar;
                        searchFormHeaderHolder.children('.eltdf-slide-from-header-bottom-holder').addClass('eltdf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = eltdfGlobalVars.vars.eltdfStickyHeaderHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar;
                        searchFormHeaderHolder.children('.eltdf-slide-from-header-bottom-holder').addClass('eltdf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.eltdf-mobile-header-inner').outerHeight() + eltdfGlobalVars.vars.eltdfAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.eltdf-slide-from-header-bottom-holder').addClass('eltdf-is-active');

                    } else {
                        searchFormHeaderHolder.children('.eltdf-slide-from-header-bottom-holder').addClass('eltdf-is-active');
                    }

                    if (searchForm.hasClass('eltdf-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var searchSlideFromWT = {};
    eltdf.modules.searchSlideFromWT = searchSlideFromWT;

    searchSlideFromWT.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSearchSlideFromWT();
    }
	
	/**
	 * Init Search Types
	 */
	function eltdfSearchSlideFromWT() {
        if ( eltdf.body.hasClass( 'eltdf-search-slides-from-window-top' ) ) {
            var searchOpener = $('a.eltdf-search-opener');

            if ( searchOpener.length > 0 ) {
                var searchForm = $('.eltdf-search-slide-window-top'),
                    searchClose = $('.eltdf-search-close');

                searchOpener.on('click', function(e) {
                    e.preventDefault();

                    if ( searchForm.height() === "0") {
                        $('.eltdf-search-slide-window-top input[type="text"]').focus();
                        //Push header bottom
                        eltdf.body.addClass('eltdf-search-open');
                    } else {
                        eltdf.body.removeClass('eltdf-search-open');
                    }

                    $(window).scroll(function() {
                        if ( searchForm.height() !== '0' && eltdf.scroll > 50 ) {
                            eltdf.body.removeClass('eltdf-search-open');
                        }
                    });

                    searchClose.on('click', function(e){
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-search-open');
                    });
                });
            }
		}
	}

})(jQuery);

(function ($) {
	'use strict';
	
	var rating = {};
	eltdf.modules.rating = rating;

    rating.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCommentRating();
	}
	
	function eltdfInitCommentRating() {
		var ratingHolder = $('.eltdf-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

		ratingHolder.each(function() {
		    var thisHolder = $(this),
                ratingInput = thisHolder.find('.eltdf-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.eltdf-star-rating');

                addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.change(function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
	}
	
})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    eltdf.modules.portfolio = portfolio;
	
    portfolio.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
    $(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfPortfolioSingleFollow().init();
	}
	
	var eltdfPortfolioSingleFollow = function () {
		var info = $('.eltdf-follow-portfolio-info .eltdf-portfolio-single-holder .eltdf-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.eltdf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .eltdf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}
		
		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (eltdf.scroll >= infoHolderOffset - headerHeight - eltdfGlobalVars.vars.eltdfAddForAdminBar - constant) {
					var marginTop = eltdf.scroll - infoHolderOffset + eltdfGlobalVars.vars.eltdfAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};
		
		var recalculateInfoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				//Calculate header height if header appears
				if (eltdf.scroll > 0 && header.length) {
					headerHeight = header.height();
				}
				
				var headerMixin = headerHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar + constant;
				if (eltdf.scroll >= infoHolderOffset - headerMixin) {
					if (eltdf.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
						info.stop().animate({
							marginTop: (eltdf.scroll - infoHolderOffset + headerMixin + 2 * constant)
						});
						//Reset header height
						headerHeight = 0;
					} else {
						info.stop().animate({
							marginTop: mediaHolderHeight - infoHolderHeight
						});
					}
				} else {
					info.stop().animate({
						marginTop: 0
					});
				}
			}
		};
		
		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	eltdf.modules.accordions = accordions;
	
	accordions.eltdfInitAccordions = eltdfInitAccordions;
	
	
	accordions.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function eltdfInitAccordions(){
		var accordion = $('.eltdf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('eltdf-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('eltdf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.eltdf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	eltdf.modules.animationHolder = animationHolder;
	
	animationHolder.eltdfInitAnimationHolder = eltdfInitAnimationHolder;
	
	
	animationHolder.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function eltdfInitAnimationHolder(){
		var elements = $('.eltdf-grow-in, .eltdf-fade-in-down, .eltdf-element-from-fade, .eltdf-element-from-left, .eltdf-element-from-right, .eltdf-element-from-top, .eltdf-element-from-bottom, .eltdf-flip-in, .eltdf-x-rotate, .eltdf-z-rotate, .eltdf-y-translate, .eltdf-fade-in, .eltdf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	eltdf.modules.button = button;
	
	button.eltdfButton = eltdfButton;
	
	
	button.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var eltdfButton = function() {
		//all buttons on the page
		var buttons = $('.eltdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	eltdf.modules.countdown = countdown;
	
	countdown.eltdfInitCountdown = eltdfInitCountdown;
	
	
	countdown.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function eltdfInitCountdown() {
		var countdowns = $('.eltdf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	eltdf.modules.counter = counter;
	
	counter.eltdfInitCounter = eltdfInitCounter;
	
	
	counter.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function eltdfInitCounter() {
		var counterHolder = $('.eltdf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.eltdf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('eltdf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	eltdf.modules.customFont = customFont;
	
	customFont.eltdfCustomFontResize = eltdfCustomFontResize;
	customFont.eltdfCustomFontTypeOut = eltdfCustomFontTypeOut;
	
	
	customFont.eltdfOnDocumentReady = eltdfOnDocumentReady;
	customFont.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function eltdfCustomFontResize() {
		var holder = $('.eltdf-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.eltdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.eltdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.eltdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function eltdfCustomFontTypeOut() {
		var eltdfTyped = $('.eltdf-cf-typed');
		
		if (eltdfTyped.length) {
			eltdfTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.eltdf-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.eltdf-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.eltdf-cf-typed-1').text(),
					string_2 = thisTyped.find('.eltdf-cf-typed-2').text(),
					string_3 = thisTyped.find('.eltdf-cf-typed-3').text(),
					string_4 = thisTyped.find('.eltdf-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var timeline = {};
	eltdf.modules.timeline = timeline;
	
	timeline.eltdfTimeline = eltdfTimeline;
	
	timeline.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfTimeline();
	}
	
	/**
	 * Timeline animation
	 * @type {Function}
	 */
	function eltdfTimeline() {
		var itemTimeline = $('.eltdf-tml-item-holder');
		
		if (itemTimeline.length) {
			itemTimeline.each(function () {
				var thisTimeline = $(this);
				
				setTimeout(function () {
					thisTimeline.appear(function () {
						thisTimeline.addClass('eltdf-appeared');
					}, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
				}, 500 * thisTimeline.index());
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	eltdf.modules.elementsHolder = elementsHolder;
	
	elementsHolder.eltdfInitElementsHolderResponsiveStyle = eltdfInitElementsHolderResponsiveStyle;
	elementsHolder.eltdfInitElementsHolderUncovering = eltdfInitElementsHolderUncovering;
	
	elementsHolder.eltdfOnDocumentReady = eltdfOnDocumentReady;
	elementsHolder.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).load(eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitElementsHolderResponsiveStyle();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
	    eltdfInitElementsHolderUncovering();
	}
	
	
	/*
	 **	Elements Holder responsive style
	 */
	function eltdfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.eltdf-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.eltdf-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.eltdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.eltdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
                if (typeof eltdf.modules.common.eltdfOwlSlider === "function") {
					// add delay to properly reinit carousel inside elements holder
                    setTimeout(eltdf.modules.common.eltdfOwlSlider(), 600);
                }
			});
		}
	}
	
	/**
	 * Initializes Elements Holder Uncovering Effect
	 */
	function eltdfInitElementsHolderUncovering(){

		var uncoveringHolder = $('.eltdf-eh-uncovering-effect');
		
		if(uncoveringHolder.length && !eltdf.htmlEl.hasClass('touch')){
			uncoveringHolder.each(function() {
				var thisUncoveringHolder = $(this);

				thisUncoveringHolder.appear(function() {
			      	// this element is now inside browser viewport
			     	thisUncoveringHolder.addClass('eltdf-eh-uncovering-animate');
			    }, {accX: 0, accY: -100});
			})
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	eltdf.modules.googleMap = googleMap;
	
	googleMap.eltdfShowGoogleMap = eltdfShowGoogleMap;
	
	
	googleMap.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function eltdfShowGoogleMap(){
		var googleMap = $('.eltdf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.eltdf-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "eltdf-map-"+ uniqueId;
				
				eltdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function eltdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'eltdf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('eltdf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			eltdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function eltdfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	eltdf.modules.icon = icon;
	
	icon.eltdfIcon = eltdfIcon;
	
	
	icon.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIcon = function() {
		var icons = $('.eltdf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('eltdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.eltdf-icon-animation-holder').addClass('eltdf-icon-animation-show');
				}, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.eltdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	eltdf.modules.iconListItem = iconListItem;
	
	iconListItem.eltdfInitIconList = eltdfInitIconList;
	
	
	iconListItem.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var eltdfInitIconList = function() {
		var iconList = $('.eltdf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('eltdf-appeared');
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	eltdf.modules.pieChart = pieChart;
	
	pieChart.eltdfInitPieChart = eltdfInitPieChart;
	
	
	pieChart.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function eltdfInitPieChart() {
		var pieChartHolder = $('.eltdf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.eltdf-pc-percentage'),
					barColor = '#ff1949',
					trackColor = '#fff',
					lineWidth = 4,
					size = 208;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.eltdf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	eltdf.modules.process = process;
	
	process.eltdfInitProcess = eltdfInitProcess;
	
	
	process.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function eltdfInitProcess() {
		var holder = $('.eltdf-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('eltdf-process-appeared');
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	eltdf.modules.progressBar = progressBar;
	
	progressBar.eltdfInitProgressBars = eltdfInitProgressBars;
	
	
	progressBar.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function eltdfInitProgressBars() {
		var progressBar = $('.eltdf-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.eltdf-pb-content'),
					progressBar = thisBar.find('.eltdf-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					eltdfInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('eltdf-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function eltdfInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var splitScrollingSection = {};
	eltdf.modules.splitScrollingSection = splitScrollingSection;

	splitScrollingSection.eltdfInitSplitScrollingSection = eltdfInitSplitScrollingSection;


	splitScrollingSection.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).ready(eltdfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitSplitScrollingSection();
	}

	/**
	 * Split Scrolling Sections Shortcode
	 */
	function eltdfInitSplitScrollingSection() {
		var splitScrollingHolder = $('.eltdf-split-scrolling-section');


		if(splitScrollingHolder.length){
			splitScrollingHolder.each(function() {

				var thisElementsHolder = $(this),
					rightSection = thisElementsHolder.find('.eltdf-sss-ms-right .eltdf-sss-ms-section'),
					leftSection = thisElementsHolder.find('.eltdf-sss-ms-left');

				leftSection.css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );
				leftSection.find('.eltdf-item-image img').css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );

				if($(window).width() > 1024){
					splitScrollingHolder.css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );

                    eltdf.modules.common.eltdfInitPerfectScrollbar().init(rightSection);
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	eltdf.modules.tabs = tabs;
	
	tabs.eltdfInitTabs = eltdfInitTabs;
	
	
	tabs.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function eltdfInitTabs(){
		var tabs = $('.eltdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.eltdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.eltdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.eltdf-tabs a.eltdf-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var portfolioList = {};
    eltdf.modules.portfolioList = portfolioList;

    portfolioList.eltdfOnWindowLoad = eltdfOnWindowLoad;
    portfolioList.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(window).load(eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitPortfolioFilter();
        eltdfInitPortfolioListAnimation();
	    eltdfInitPortfolioPagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
	    eltdfInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function eltdfInitPortfolioListAnimation(){
        var portList = $('.eltdf-portfolio-list-holder.eltdf-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.eltdf-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('eltdf-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('eltdf-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function eltdfInitPortfolioFilter(){
        var filterHolder = $('.eltdf-portfolio-list-holder .eltdf-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.eltdf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.eltdf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('eltdf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.eltdf-pl-filter:first').addClass('eltdf-pl-current');
	            
	            if(thisPortListHolder.hasClass('eltdf-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.eltdf-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.eltdf-pl-filter').removeClass('eltdf-pl-current');
                    thisFilter.addClass('eltdf-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                eltdfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.eltdf-pl-inner').isotope({ filter: filterValue });
	                    eltdf.modules.common.eltdfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function eltdfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'academist_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.eltdf-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('eltdf-showing eltdf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width());
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    eltdfInitPortfolioListAnimation();
	                                eltdf.modules.common.eltdfInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');
                            eltdfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function eltdfInitPortfolioPagination(){
		var portList = $('.eltdf-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.eltdf-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.eltdf-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisPortList.hasClass('eltdf-pl-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
				thisPortList.addClass('eltdf-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.eltdf-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
					loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
					thisPortList.addClass('eltdf-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'academist_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('eltdf-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							eltdfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter')) {
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									eltdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
								    if(pagedLink === 1) {
                                        eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        eltdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter') && pagedLink !== 1) {
									eltdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        eltdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        eltdfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('eltdf-pl-infinite-scroll-started')) {
							thisPortList.removeClass('eltdf-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.eltdf-pl-load-more-holder').hide();
			}
		};
		
		var eltdfInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.eltdf-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltdf-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltdf-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltdf-pag-next a');
			
			standardPagNumericItem.removeClass('eltdf-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('eltdf-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var eltdfInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			eltdfInitPortfolioListAnimation();
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisPortListInner.append(responseHtml);
			eltdfInitPortfolioListAnimation();
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsSlider = {};
    eltdf.modules.testimonialsSlider = testimonialsSlider;

    testimonialsSlider.eltdfInitTestimonials = eltdfInitTestimonialsSlider;


    testimonialsSlider.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).load(eltdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitTestimonialsSlider();
    }

    /**
     * Init testimonials slider shortcode
     */
    function eltdfInitTestimonialsSlider() {
        var testimonials = $('.eltdf-testimonials-holder.eltdf-testimonials-slider');

        if(testimonials.length){
            testimonials.each(function(){
                var testimonial = $(this),
                    testimonialHolder = testimonial.find('.eltdf-custom-testimonials-slider-holder'),
                    testimonialSlider = testimonialHolder.find('.eltdf-custom-testimonials-slider'),
                    sliderItem = testimonialSlider.find('.eltdf-slider-item'),
                    sliderNav = testimonialHolder.find(".eltdf-testimonials-slider-nav"),
                    testimonialDivs = sliderItem.find(".eltdf-testimonial-image, .eltdf-testimonial-text-holder"),
                    btnNext = sliderNav.find('.eltdf-btn-ts-next'),
                    btnPrev = sliderNav.find('.eltdf-btn-ts-prev'),
                    slideIndex = 0,
                    slideCount = sliderItem.length-1,
                    autoplayTimeout,
                    autoplayInterval,
                    autoplaySpeed = 4000,
                    autoplayTimeoutTime = 3000;

                // Function to calculate slider height
                function eltdfTestimonialsSliderCalcHeight() {
                    var highestHeight = 0;

                    testimonialDivs.each(function(){
                        var currentHeight = $(this).height();
                        if(currentHeight > highestHeight){
                            highestHeight = currentHeight;
                        }
                    });

                    if (testimonial.hasClass('eltdf-testimonials-simple')) {
                        highestHeight += 45;
                    }
            
                    testimonialHolder.css('height', highestHeight);
                }

                // Function to reset autoplay interval and timeout
                function resetTimeouts() {
                    clearTimeout(autoplayTimeout);
                    clearInterval(autoplayInterval);
                    autoplayTimeout = setTimeout(function() {
                        autoplayInterval = setInterval(function() {
                            goNext();
                        }, autoplaySpeed);
                    }, autoplayTimeoutTime);
                }

                // Function to go to next slide
                function goNext() {
                    sliderNav.addClass("eltdf-disabled-nav");
                    // Clean slider items classes
                    sliderItem.removeClass('eltdf-animate-right');
                    var tempCurrent = testimonialSlider.find('.eltdf-slider-item-'+ slideIndex);
                    // Push current item left
                    tempCurrent.removeClass('eltdf-animate-left').addClass('eltdf-push-active-left');

                    setTimeout(function() {
                        tempCurrent.removeClass('eltdf-push-active-left');
                        sliderNav.removeClass("eltdf-disabled-nav");
                    }, 600);

                    // Increment slide index
                    slideIndex++;
                    if( slideIndex > slideCount) {
                        slideIndex = 0;
                    }

                    // Animate new curent item left
                    testimonialSlider.find('.eltdf-slider-item-'+ slideIndex).addClass('eltdf-animate-left');
                }

                // Function to go to previous slide
                function goPrev() {
                    sliderNav.addClass("eltdf-disabled-nav");
                    // Clean slider items classes
                    sliderItem.removeClass('eltdf-animate-left');
                    var tempCurrent = testimonialSlider.find('.eltdf-slider-item-'+ slideIndex);
                    // Push current item right
                    tempCurrent.removeClass('eltdf-animate-right').addClass('eltdf-push-active-right');

                    setTimeout(function() {
                        tempCurrent.removeClass('eltdf-push-active-right');
                        sliderNav.removeClass("eltdf-disabled-nav");
                    }, 600);

                    // Decrement slide index
                    slideIndex--;
                    if( slideIndex < 0) {
                        slideIndex = slideCount;
                    }

                    // Animate new curent item right
                    testimonialSlider.find('.eltdf-slider-item-'+ slideIndex).addClass('eltdf-animate-right');
                }

                btnNext.on("click", function() {
                    goNext();
                    resetTimeouts();
                });

                btnPrev.on("click", function() {
                    goPrev();
                    resetTimeouts();
                });

                $(window).on('resize', function(){
                    eltdfTestimonialsSliderCalcHeight();
                });

                testimonialHolder.waitForImages(function() {
                    eltdfTestimonialsSliderCalcHeight();
                    autoplayInterval = setInterval(function() {
                        goNext();
                    }, autoplaySpeed);
                });
            });
        }
    }

})(jQuery);