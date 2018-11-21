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