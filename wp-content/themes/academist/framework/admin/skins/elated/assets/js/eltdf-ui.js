(function($){
	window.eltdfAdmin = {};
	eltdfAdmin.framework = {};

	$(document).ready(function() {
		//plugins init goes here


		if ($('.eltdf-page-form').length > 0) {
            eltdfFixHeaderAndTitle();
            initTopAnchorHolderSize();
		    eltdfScrollToAnchorSelect();
            eltdfChangedInput();
		}
    });

	function eltdfFixHeaderAndTitle () {
		var pageHeader 				= $('.eltdf-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
		var pageTitle				= $('.eltdf-page-title');
		var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
		var tabsNavWrapper			= $('.eltdf-tabs-navigation-wrapper');
		var tabsNavWrapperTop		= pageHeaderHeight;
		var tabsContentWrapper	    = $('.eltdf-tab-content');
		var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

		$(window).on('scroll load', function() {
			if($(window).scrollTop() >= pageHeaderTopPosition) {
				pageHeader.addClass('eltdf-header-fixed').css('top', parseInt(adminBarHeight));
				pageTitle.addClass('eltdf-page-title-fixed').css('top', pageTitleTopPosition);
				tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
				tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
			} else {
				pageHeader.removeClass('eltdf-header-fixed').css('top', 0);
				pageTitle.removeClass('eltdf-page-title-fixed').css('top', 0);
				tabsNavWrapper.css('marginTop', 0);
				tabsContentWrapper.css('marginTop', 0);
			}
		});
	}

	function initTopAnchorHolderSize() {
		function initTopSize() {
			var optionsPageHolder = $('.eltdf-options-page');
			var anchorAndSaveHolder = $('.eltdf-top-section-holder');
			var pageTitle = $('.eltdf-page-title');
			var tabsContentWrapper = $('.eltdf-tabs-content');

			anchorAndSaveHolder.css('width', optionsPageHolder.width() - parseInt(anchorAndSaveHolder.css('margin-left')));
			pageTitle.css('width', tabsContentWrapper.outerWidth());
		}

		initTopSize();

		$(window).on('resize', function() {
			initTopSize();
		});
	}

	function eltdfScrollToAnchorSelect() {
		var selectAnchor = $('#eltdf-select-anchor');
		selectAnchor.on('change', function() {
			var selectAnchor = $('option:selected', selectAnchor);

			if(typeof selectAnchor.data('anchor') !== 'undefined') {
				eltdScrollToPanel(selectAnchor.data('anchor'));
			}
		});
	}

	function eltdScrollToPanel(panel) {
		var pageHeader 				= $('.eltdf-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageTitle				= $('.eltdf-page-title');
		var pageTitleHeight			= pageTitle.outerHeight();

		var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

		$('html, body').animate({
			scrollTop: panelTopPosition
		}, 1000);

		return false;
	}

	function eltdfChangedInput () {
		$('.eltdf-tabs-content').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
			$('.eltdf-input-change').addClass('yes');
		});
		$('.field.switch label:not(.selected)').on('click', function() {
			$('.eltdf-input-change').addClass('yes');
		});
		$(window).on('beforeunload', function () {
			if ($('.eltdf-input-change.yes').length) {
				return 'You haven\'t saved your changes.';
			}
		});
		$('#anchornav input').on('click', function() {
			var yesInputChange = $('.eltdf-input-change.yes');
			if (yesInputChange.length) {
				yesInputChange.removeClass('yes');
			}
			var saveChanges = $('.eltdf-changes-saved');
			if (saveChanges.length) {
				saveChanges.addClass('yes');
				setTimeout(function(){saveChanges.removeClass('yes');}, 3000);
			}
		});
	}
	
})(jQuery);