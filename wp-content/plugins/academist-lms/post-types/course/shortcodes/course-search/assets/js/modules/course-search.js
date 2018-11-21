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