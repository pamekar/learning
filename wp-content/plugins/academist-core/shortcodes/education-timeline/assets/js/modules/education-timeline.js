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