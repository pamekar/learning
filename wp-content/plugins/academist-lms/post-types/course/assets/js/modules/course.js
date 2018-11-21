(function($) {
    'use strict';

    var course = {};
    eltdf.modules.course = course;

	course.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
	    eltdfInitCoursePopup();
	    eltdfInitCoursePopupClose();
	    eltdfCompleteItem();
	    eltdfRetakeCourse();
	    eltdfSearchCourses();
    }

    function eltdfInitCoursePopup(){
	    var elements = $('.eltdf-element-link-open');
	    var popup = $('.eltdf-course-popup');
	    var popupContent = $('.eltdf-popup-content');

        if(elements.length){
	        elements.each(function(){
				var element = $(this);
		        element.on('click', function(e){
			        e.preventDefault();
			        if(!popup.hasClass('eltdf-course-popup-opened')){
				        popup.addClass('eltdf-course-popup-opened');
				        eltdf.modules.common.eltdfDisableScroll();
			        }
			        var courseId = 0;
			        if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
				        courseId = element.data('course-id');
			        }
			        eltdfLoadElementItem(element.data('item-id'),courseId, popupContent);
		        });
	        });
        }
    }
	function eltdfInitCourseItemsNavigation(){
		var elements = $('.eltdf-course-popup-navigation .eltdf-element-link-open');
		var popupContent = $('.eltdf-popup-content');

		if(elements.length){
			elements.each(function(){
				var element = $(this);
				element.on('click', function(e){
					e.preventDefault();
					var courseId = 0;
					if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
						courseId = element.data('course-id');
					}
					eltdfLoadElementItem(element.data('item-id'),courseId, popupContent);
				});
			});
		}
	}

	function eltdfInitCoursePopupClose(){
		var closeButton = $('.eltdf-course-popup-close');  
		var popup = $('.eltdf-course-popup');
		if(closeButton.length){
			closeButton.on('click', function(e){
				e.preventDefault();
				popup.removeClass('eltdf-course-popup-opened');
				location.reload();
			});
		}
	}

	function eltdfLoadElementItem(id ,courseId, container){
        var preloader = container.prevAll('.eltdf-course-item-preloader');
        preloader.removeClass('eltdf-hide');
		var ajaxData = {
			action: 'academist_lms_load_element_item',
			item_id : id,
			course_id : courseId
		};
		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: eltdfGlobalVars.vars.eltdfAjaxUrl,
			success: function (data) {
				var response = JSON.parse(data);
				if(response.status === 'success'){
					container.html(response.data.html);
					eltdfInitCourseItemsNavigation();
					eltdfCompleteItem();
					eltdfSearchCourses();
                    eltdf.modules.quiz.eltdfStartQuiz();
                    preloader.addClass('eltdf-hide');
                    eltdfPopupScroll();
				} else {
                    alert("An error occurred");
                    preloader.addClass('eltdf-hide');
                }
			}
		});
	}

	function eltdfCompleteItem(){
		$('.eltdf-lms-complete-item-form').on('submit',function(e) {
			e.preventDefault();
			
			var form = $(this);
			var itemID = $(this).find( "input[name$='academist_lms_item_id']").val();
			var formData = form.serialize();
			var ajaxData = {
				action: 'academist_lms_complete_item',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: eltdfGlobalVars.vars.eltdfAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status === 'success'){

						form.replaceWith(response.data['content_message']);
						var elements =  $('.eltdf-section-element.eltdf-section-lesson');
						elements.each(function () {
							if($(this).data('section-element-id') === itemID){
								$(this).addClass('eltdf-item-completed')
							}
						})
					}
				}
			});
		});
	}

	function eltdfRetakeCourse(){
		$('.eltdf-lms-retake-course-form').on('submit',function(e) {
			e.preventDefault();
			
			var form = $(this);
			var formData = form.serialize();
			var ajaxData = {
				action: 'academist_lms_retake_course',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: eltdfGlobalVars.vars.eltdfAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status === 'success'){
						alert(response.message);
                        location.reload();
					}
				}
			});
		});
	}

	function eltdfPopupScroll(){
        var mainHolder = $('.eltdf-course-popup');

        /* Content items */
        var content = $('.eltdf-popup-content');
        var contentHolder = $('.eltdf-course-popup-inner');
        var contentHeading = $('.eltdf-popup-heading');

        /* Navigation items */
        var navigationHolder = $('.eltdf-course-popup-items');
        var navigationWrapper = $('.eltdf-popup-info-wrapper');
        var searchHolder = $('.eltdf-lms-search-holder');

        if(eltdf.windowWidth > 1024) {
            if (content.length) {
                content.height(mainHolder.height() - contentHeading.outerHeight());
                eltdf.modules.common.eltdfInitPerfectScrollbar().init(content);
            }

            if (navigationHolder.length) {
                navigationHolder.height(mainHolder.height() - parseInt(navigationWrapper.css('padding-top')) - parseInt(navigationWrapper.css('padding-bottom')) - searchHolder.outerHeight(true));
                eltdf.modules.common.eltdfInitPerfectScrollbar().init(navigationHolder);
            }
        } else {
            var contentToScroll = contentHolder.find('.eltdf-grid-row');
            contentToScroll.height(mainHolder.height());
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(contentToScroll);
        }

		return true
	}

	function eltdfSearchCourses(){
	    var courseSearchHolder = $('.eltdf-lms-search-holder');

        if (courseSearchHolder.length) {
            courseSearchHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.eltdf-lms-search-field'),
                    resultsHolder = thisSearch.find('.eltdf-lms-search-results'),
                    searchLoading = thisSearch.find('.eltdf-search-loading'),
                    searchIcon = thisSearch.find('.eltdf-search-icon');

                searchLoading.addClass('eltdf-hidden');

                var keyPressTimeout;

                searchField.on('keyup paste', function(e) {
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
                                action: 'academist_lms_search_courses',
                                term: searchTerm
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

})(jQuery);