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