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