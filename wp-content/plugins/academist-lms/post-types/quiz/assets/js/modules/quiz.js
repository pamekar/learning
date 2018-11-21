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