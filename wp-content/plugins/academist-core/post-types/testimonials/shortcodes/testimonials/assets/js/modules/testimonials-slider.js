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