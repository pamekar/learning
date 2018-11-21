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
(function($) {
    'use strict';

    var question = {};
    eltdf.modules.question = question;

    question.eltdfQuestionHint = eltdfQuestionHint;
    question.eltdfQuestionCheck = eltdfQuestionCheck;
    question.eltdfQuestionChange = eltdfQuestionChange;
    question.eltdfQuestionAnswerChange = eltdfQuestionAnswerChange;
    question.eltdfValidateAnswer = eltdfValidateAnswer;
    question.eltdfQuestionSave = eltdfQuestionSave;

    question.eltdfOnDocumentReady = eltdfOnDocumentReady;
    question.eltdfOnWindowLoad = eltdfOnWindowLoad;
    question.eltdfOnWindowResize = eltdfOnWindowResize;
    question.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfQuestionHint();
        eltdfQuestionCheck();
        eltdfQuestionChange();
        eltdfQuestionAnswerChange();
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

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {

    }

    function eltdfQuestionAnswerChange() {
        var answersHolder = $('.eltdf-question-answers');
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');
        var checkForm = $('.eltdf-lms-question-actions-check-form');
        var nextForm = $('.eltdf-lms-question-next-form');
        var prevForm = $('.eltdf-lms-question-prev-form');
        var finishForm = $('.eltdf-lms-finish-quiz-form');

        radios.change(function() {
            checkForm.find('input[name=academist_lms_question_answer]').val(this.value);
            nextForm.find('input[name=academist_lms_question_answer]').val(this.value);
            prevForm.find('input[name=academist_lms_question_answer]').val(this.value);
            finishForm.find('input[name=academist_lms_question_answer]').val(this.value);
        });

        checkboxes.on('change', function() {
            var values = $('input[type=checkbox]:checked').map(function() {
                return this.value;
            }).get().join(',');
            checkForm.find('input[name=academist_lms_question_answer]').val(values);
            nextForm.find('input[name=academist_lms_question_answer]').val(values);
            prevForm.find('input[name=academist_lms_question_answer]').val(values);
            finishForm.find('input[name=academist_lms_question_answer]').val(values);
        }).change();

        textbox.on("change paste keyup", function() {
            checkForm.find('input[name=academist_lms_question_answer]').val($(this).val());
            nextForm.find('input[name=academist_lms_question_answer]').val($(this).val());
            prevForm.find('input[name=academist_lms_question_answer]').val($(this).val());
            finishForm.find('input[name=academist_lms_question_answer]').val($(this).val());
        });
    }

    function eltdfUpdateQuestionPosition(questionPosition) {
        var positionHolder = $('.eltdf-question-number-completed');
        positionHolder.text(questionPosition);
    }

    function eltdfUpdateQuestionId(questionId) {
        var finishForm = $('.eltdf-lms-finish-quiz-form');
        finishForm.find('input[name=academist_lms_question_id]').val(questionId);
    }

    function eltdfValidateAnswer(answersHolder, result, originalResult, answerChecked) {
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');

        if(answerChecked === 'yes') {
            answersHolder.find('input').prop("disabled", true);
            if (radios.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val === true) {
                        input.parent().addClass('eltdf-true');
                    } else {
                        input.parent().addClass('eltdf-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val === true) {
                        input.parent().addClass('eltdf-base-true');
                    }
                });
            }

            if (checkboxes.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val === true) {
                        input.parent().addClass('eltdf-true');
                    } else {
                        input.parent().addClass('eltdf-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val === true) {
                        input.parent().addClass('eltdf-base-true');
                    }
                });
            }

            if (textbox.length) {
                if (result) {
                    textbox.parent().addClass('eltdf-true');
                } else {
                    textbox.parent().addClass('eltdf-false');
                    textbox.parent().append('<p class="eltdf-base-answer">' + originalResult + '</p>');
                }
            }
        }
    }

    function eltdfQuestionHint() {
        var answersHolder = $('.eltdf-question-answer-wrapper');
        $('.eltdf-lms-question-actions-hint-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=academist_lms_time_remaining]');
            formData += '&academist_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'academist_lms_check_question_hint',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status === 'success'){
                        answersHolder.append(response.data.html);
                    }
                }
            });
        });
    }

    function eltdfQuestionCheck() {
        var answersHolder = $('.eltdf-question-answer-wrapper');
        $('.eltdf-lms-question-actions-check-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=academist_lms_time_remaining]');
            formData += '&academist_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'academist_lms_check_question_answer',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status === 'success'){
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        eltdfValidateAnswer(answersHolder, result, originalResult, answerChecked);
                    }
                }
            });
        });
    }

    function eltdfQuestionChange() {
        var questionHolder = $('.eltdf-quiz-question-wrapper');
        $('.eltdf-lms-question-prev-form, .eltdf-lms-question-next-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=academist_lms_time_remaining]');
            var retakeId = $('input[name=academist_lms_retake_id]');
            formData += '&academist_lms_time_remaining=' + timeRemaining.val();
            formData += '&academist_lms_retake_id=' + retakeId.val();
            var ajaxData = {
                action: 'academist_lms_change_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status === 'success'){
                        questionHolder.html(response.data.html);
                        var answersHolder = $('.eltdf-question-answer-wrapper');
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        eltdfQuestionHint();
                        eltdfQuestionCheck();
                        eltdfQuestionChange();
                        eltdfQuestionAnswerChange();
                        eltdfUpdateQuestionPosition(response.data.question_position);
                        eltdfUpdateQuestionId(response.data.question_id);
                        eltdfValidateAnswer(answersHolder, result, originalResult, answerChecked);
                        eltdf.modules.quiz.eltdfFinishQuiz();
                    }
                }
            });
        });
    }

    function eltdfQuestionSave() {
        $(window).unload(function() {
            var form = $('.eltdf-lms-question-next-form');
            if(!form.length) {
                form = $('eltdf-lms-question-prev-form');
            }
            var formData = form.serialize();
            var timeRemaining = $('input[name=academist_lms_time_remaining]');
            var retakeId = $('input[name=academist_lms_retake_id]');
            formData += '&academist_lms_time_remaining=' + timeRemaining.val();
            formData += '&academist_lms_retake_id=' + retakeId.val();
            console.log(formData);
            var ajaxData = {
                action: 'academist_lms_save_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                async: false,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var quiz = {};
    eltdf.modules.quiz = quiz;

    quiz.eltdfStartQuiz = eltdfStartQuiz;
    quiz.eltdfFinishQuiz = eltdfFinishQuiz;

    quiz.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfStartQuiz();
        eltdfFinishQuiz();
    }

    function eltdfStartQuiz(){
        var popupContent = $('.eltdf-quiz-single-holder'),
            preloader = $('.eltdf-course-item-preloader');
        
        $('.eltdf-lms-start-quiz-form').on('submit',function(e) {
            e.preventDefault();
            preloader.removeClass('eltdf-hide');
            var form = $(this);
            var formData = form.serialize();
            var ajaxData = {
                action: 'academist_lms_start_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status === 'success'){
                        var questionId = response.data.question_id;
                        var quizId = response.data.quiz_id;
                        var courseId = response.data.course_id;
                        var retake = response.data.retake;
                        eltdfLoadQuizQuestion(questionId, quizId, courseId, retake, popupContent);
                        eltdf.modules.question.eltdfQuestionSave();
                    } else {
                        alert("An error occurred");
                        preloader.addClass('eltdf-hide');
                    }
                }
            });
        });
    }

    function eltdfLoadQuizQuestion(questionId ,quizId, courseId, retake, container){
        var preloader = $('.eltdf-course-item-preloader');
        var ajaxData = {
            action: 'academist_lms_load_first_question',
            question_id : questionId,
            quiz_id : quizId,
            course_id : courseId,
            retake : retake
        };
        
        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: eltdfGlobalVars.vars.eltdfAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                if(response.status === 'success'){
                    container.html(response.data.html);
                    eltdf.modules.question.eltdfQuestionHint();
                    eltdf.modules.question.eltdfQuestionCheck();
                    eltdf.modules.question.eltdfQuestionChange();
                    eltdf.modules.question.eltdfQuestionAnswerChange();
                    eltdfFinishQuiz();

                    var answersHolder = $('.eltdf-question-answer-wrapper');
                    var result = response.data.result;
                    var originalResult = response.data.original_result;
                    var answerChecked = response.data.answer_checked;
                    eltdf.modules.question.eltdfValidateAnswer(answersHolder, result, originalResult, answerChecked);

                    var timerHolder = $('#eltdf-quiz-timer');
                    var duration = timerHolder.data('duration');
                    var timeRemaining = $('input[name=academist_lms_time_remaining]');
                    timerHolder.vTimer('start', {duration: duration})
                        .on('update', function (e, remaining) {
                            // total seconds
                            var seconds = remaining;
                            // calculate seconds
                            var s = seconds % 60;
                            // add leading zero to seconds if needed
                            s = s < 10 ? "0" + s : s;
                            // calculate minutes
                            var m = Math.floor(seconds / 60) % 60;
                            // add leading zero to minutes if needed
                            m = m < 10 ? "0" + m : m;
                            // calculate hours
                            var h = Math.floor(seconds / 60 / 60);
                            h = h < 10 ? "0" + h : h;
                            var time = h + ":" + m + ":" + s;
                            timerHolder.text(time);
                            timeRemaining.val(remaining);
                        })
                        .on('complete', function () {
                            $('.eltdf-lms-finish-quiz-form').submit();
                        });
                    preloader.addClass('eltdf-hide');
                } else {
                    alert("An error occurred");
                    preloader.addClass('eltdf-hide');
                }
            }
        });
    }

    function eltdfFinishQuiz(){
        var popupContent = $('.eltdf-quiz-single-holder'),
            preloader = $('.eltdf-course-item-preloader');
        
        $('.eltdf-lms-finish-quiz-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=academist_lms_time_remaining]');
            formData += '&academist_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'academist_lms_finish_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status === 'success'){
                        popupContent.replaceWith(response.data.html);
                        eltdfStartQuiz();
                        preloader.addClass('eltdf-hide');
                    } else {
                        alert("An error occurred");
                        preloader.addClass('eltdf-hide');
                    }
                }
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var courseList = {};
    eltdf.modules.courseList = courseList;

    courseList.eltdfOnDocumentReady = eltdfOnDocumentReady;
    courseList.eltdfOnWindowLoad = eltdfOnWindowLoad;
    courseList.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitCourseList();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
		eltdfInitCourseFilter();
        eltdfInitCourseListAnimation();
        eltdfInitCoursePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
        eltdfInitCoursePagination().scroll();
    }

    /**
     * Initializes course pagination functions
     */
    function eltdfInitCoursePagination(){
        var courseList = $('.eltdf-course-list-holder');

        var initStandardPagination = function(thisCourseList) {
            var standardLink = thisCourseList.find('.eltdf-cl-standard-pagination li');

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

                        initMainPagFunctionality(thisCourseList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisCourseList) {
            var loadMoreButton = thisCourseList.find('.eltdf-cl-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisCourseList);
            });
        };

        var initInifiteScrollPagination = function(thisCourseList) {
            var courseListHeight = thisCourseList.outerHeight(),
                courseListTopOffest = thisCourseList.offset().top,
                courseListPosition = courseListHeight + courseListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;

                console.log('a' + courseListHeight);
                console.log('b' + courseListTopOffest);
                console.log('c' + courseListPosition);
                console.log('d' + eltdf.scroll + eltdf.windowHeight);


            if(!thisCourseList.hasClass('eltdf-cl-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > courseListPosition) {
                initMainPagFunctionality(thisCourseList);
            }
        };

        var initMainPagFunctionality = function(thisCourseList, pagedLink) {
            var thisCourseListInner = thisCourseList.find('.eltdf-cl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisCourseList.data('max-num-pages') !== 'undefined' && thisCourseList.data('max-num-pages') !== false) {
                maxNumPages = thisCourseList.data('max-num-pages');
            }

            if(thisCourseList.hasClass('eltdf-cl-pag-standard')) {
                thisCourseList.data('next-page', pagedLink);
            }

            if(thisCourseList.hasClass('eltdf-cl-pag-infinite-scroll')) {
                thisCourseList.addClass('eltdf-cl-infinite-scroll-started');
            }

            var loadMoreData = eltdf.modules.common.getLoadMoreData(thisCourseList),
                loadingItem = thisCourseList.find('.eltdf-cl-loading');

            nextPage = loadMoreData.nextPage;

            if(nextPage <= maxNumPages || maxNumPages === 0){
                if(thisCourseList.hasClass('eltdf-cl-pag-standard')) {
                    loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
                    thisCourseList.addClass('eltdf-cl-pag-standard-animate');
                } else {
                    loadingItem.addClass('eltdf-showing');
                }

                var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreData, 'academist_lms_course_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                    success: function (data) {
                        if(!thisCourseList.hasClass('eltdf-cl-pag-standard')) {
                            nextPage++;
                        }

                        thisCourseList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html,
                            minValue = response.minValue,
                            maxValue = response.maxValue;

                        if(thisCourseList.hasClass('eltdf-cl-pag-standard') || pagedLink === 1) {
                            eltdfInitStandardPaginationLinkChanges(thisCourseList, maxNumPages, nextPage);
                            eltdfInitHtmlGalleryNewContent(thisCourseList, thisCourseListInner, loadingItem, responseHtml);
                            eltdfInitPostsCounterChanges(thisCourseList, minValue, maxValue);
                        } else {
                            eltdfInitAppendGalleryNewContent(thisCourseListInner, loadingItem, responseHtml);
                            eltdfInitPostsCounterChanges(thisCourseList, 1, maxValue);
                        }

                        if(thisCourseList.hasClass('eltdf-cl-infinite-scroll-started')) {
                            thisCourseList.removeClass('eltdf-cl-infinite-scroll-started');
                        }
                    }
                });
            }

            if(pagedLink === 1) {
                thisCourseList.find('.eltdf-cl-load-more-holder').show();
            }

            if(nextPage === maxNumPages){
                thisCourseList.find('.eltdf-cl-load-more-holder').hide();
            }
        };

        var eltdfInitStandardPaginationLinkChanges = function(thisCourseList, maxNumPages, nextPage) {
            var standardPagHolder = thisCourseList.find('.eltdf-cl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.eltdf-cl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.eltdf-cl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.eltdf-cl-pag-next a');

            standardPagNumericItem.removeClass('eltdf-cl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('eltdf-cl-pag-active');

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

        var eltdfInitPostsCounterChanges = function(thisCourseList, minValue, maxValue) {
            var postsCounterHolder = thisCourseList.find('.eltdf-course-items-counter');
            var minValueHolder = postsCounterHolder.find('.counter-min-value');
            var maxValueHolder = postsCounterHolder.find('.counter-max-value');
            minValueHolder.text(minValue);
            maxValueHolder.text(maxValue);
        };

        var eltdfInitHtmlGalleryNewContent = function(thisCourseList, thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
            thisCourseListInner.waitForImages(function() {
                thisCourseList.removeClass('eltdf-cl-pag-standard-animate');
                thisCourseListInner.html(responseHtml);
                thisCourseListInner.css('height', 'auto');
                eltdfInitCourseListAnimation();
                eltdf.modules.common.eltdfInitParallax();
            });
        };

        var eltdfInitAppendGalleryNewContent = function(thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing');
            thisCourseListInner.waitForImages(function() {
                thisCourseListInner.append(responseHtml);
                eltdfInitCourseListAnimation();
                eltdf.modules.common.eltdfInitParallax();
            });
        };

        return {
            init: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('eltdf-cl-pag-standard')) {
                            initStandardPagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('eltdf-cl-pag-load-more')) {
                            initLoadMorePagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('eltdf-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            scroll: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('eltdf-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            getMainPagFunction: function(thisCourseList, paged) {
                initMainPagFunctionality(thisCourseList, paged);
            }
        };
    }

	/**
	 * Initializes course masonry filter
	 */
	function eltdfInitCourseFilter(){
		var filterHolder = $('.eltdf-cl-has-filter-category .eltdf-cl-filter-holder');

		if(filterHolder.length){
			filterHolder.each(function(){
				var thisFilterHolder = $(this),
					thisPortListHolder = thisFilterHolder.closest('.eltdf-course-list-holder'),
					thisPortListInner = thisPortListHolder.find('.eltdf-cl-inner'),
					portListHasLoadMore = thisPortListHolder.hasClass('eltdf-cl-pag-load-more') ? true : false;

				thisFilterHolder.find('.eltdf-cl-filter:first').addClass('eltdf-cl-current');

				if(thisPortListHolder.hasClass('eltdf-cl-gallery')) {
					thisPortListInner.isotope();
				}

				thisFilterHolder.find('.eltdf-cl-filter').on('click', function(){
					var thisFilter = $(this),
						filterValue = thisFilter.attr('data-filter'),
						filterClassName = filterValue.length ? filterValue.substring(1) : '',
						portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

					thisFilter.parent().children('.eltdf-cl-filter').removeClass('eltdf-cl-current');
					thisFilter.addClass('eltdf-cl-current');

					if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
						eltdfInitLoadMoreItemsCourseFilter(thisPortListHolder, filterValue, filterClassName);
					} else {
						filterValue = filterValue.length === 0 ? '*' : filterValue;

						thisFilterHolder.parent().children('.eltdf-cl-inner').isotope({ filter: filterValue });
						eltdf.modules.common.eltdfInitParallax();
					}
				});
			});
		}
	}

    /**
     * Initializes course list article animation
     */
    function eltdfInitCourseListAnimation(){
        var courseList = $('.eltdf-course-list-holder.eltdf-cl-has-animation');

        if(courseList.length){
            courseList.each(function(){
                var thisCourseList = $(this).children('.eltdf-cl-inner');

                thisCourseList.children('article').each(function(l) {
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

    function eltdfInitCourseList() {
        var courseLists = $('.eltdf-course-list-holder');
        if (courseLists.length) {
            courseLists.each(function () {
                var thisList = $(this);
                if (thisList.hasClass('eltdf-cl-has-filter')) {
                    eltdfInitCourseLayoutChange(thisList);
                    eltdfInitCourseLayoutOrdering(thisList);
                }
            })
        }
    }

    function eltdfInitCourseLayoutOrdering(thisList) {
        var filter = thisList.find('.eltdf-cl-filter-holder .eltdf-course-order-filter');
        filter.select2({
            minimumResultsForSearch: -1
        }).on('select2:select', function (evt) {
            var dataAtts = evt.params.data.element.dataset;
            var type = dataAtts.type;
            var order = dataAtts.order;
            thisList.data('orderby', type);
            thisList.data('order', order);
            thisList.data('next-page', 1);
            eltdfInitCoursePagination().getMainPagFunction(thisList, 1);
        });
    }

    function eltdfInitCourseLayoutChange(thisList) {
        var filter = thisList.find('.eltdf-cl-filter-holder .eltdf-course-layout-filter'),
            filterElements = filter.find('span');
        
        if (filter.length > 0) {
            filterElements.on('click', function() {
                filterElements.removeClass('eltdf-active');
                var thisFilter = $(this);
                thisFilter.addClass('eltdf-active');
                var type = thisFilter.data('type');
                thisList.removeClass('eltdf-cl-gallery eltdf-cl-simple');
                thisList.addClass('eltdf-cl-' + type);
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var courseSearch = {};
    eltdf.modules.courseSearch = courseSearch;

    courseSearch.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
	    eltdfInitAdvancedCourseSearch();
    }

    function eltdfInitAdvancedCourseSearch() {
        var advancedCoursSearches = $('.eltdf-advanced-course-search');
        if (advancedCoursSearches.length) {
            advancedCoursSearches.each(function () {
                var thisSearch = $(this);
                var select = thisSearch.find('select');
                if(select.length) {
                    select.select2({
                        minimumResultsForSearch: -1
                    });
                }
            })
        }
    }

})(jQuery);