(function ($) {
function initializeMarqueeSwiper($marquee, settings) {
    if (!$marquee.length || $marquee.hasClass('swiper-initialized')) {
        return;
    }

    var $swiperWrapper = $marquee.find('.ame-marquee__items');
    var $slides = $swiperWrapper.find('.ame-marquee__item'); // or your custom class

    // Clone slides for smooth looping if needed
    if ($slides.length > 0 && $slides.length <= 4) {
        var cloneCount = Math.ceil(8 / $slides.length);
        for (var i = 0; i < cloneCount; i++) {
            $slides.each(function () {
                $swiperWrapper.append($(this).clone());
            });
        }
    }

    // Initialize Swiper with merged settings
    var swiper = new Swiper($marquee[0], Object.assign({
        loop: true,
        slidesPerView: 'auto',
        allowTouchMove: false,
        freeMode: false,
        freeModeMomentum: false,
        autoplay: settings.autoplay || false
    }, settings));

    if ($marquee.data('marquee-pause-on-hover') === true || $marquee.data('marquee-pause-on-hover') === 'true') {
        $marquee.on('mouseenter', function () {
            if (swiper && swiper.autoplay) {
                swiper.autoplay.stop();
                swiper.setTranslate(swiper.getTranslate()); // Immediate stop
            }
        });
    
        $marquee.on('mouseleave', function () {
            if (swiper && swiper.autoplay) {
                swiper.slideTo(swiper.activeIndex); // Resume from exact place
                swiper.autoplay.start();
            }
        });
    }
}

function AmeMarqueeImage($scope) {
    var $marquee = $scope.find('.ame-image-marquee');

    var settings = {
        autoplay: {
            delay: 0, 
            reverseDirection: $marquee.data('marquee-reverse')
        },
        spaceBetween: $marquee.data('marquee-image-space'),
        speed: $marquee.data('marquee-speed'),
        direction: $marquee.data('marquee-direction'),
    };

    initializeMarqueeSwiper($marquee, settings);
}

function AmeMarqueePost($scope) {
    var $marquee = $scope.find('.ame-post-marquee');

    var settings = {
        autoplay: {
            delay: 0, 
            reverseDirection: $marquee.data('marquee-reverse')
        },
        spaceBetween: $marquee.data('marquee-image-space'),
        speed: $marquee.data('marquee-speed'),
        direction: $marquee.data('marquee-direction'),
    };

    initializeMarqueeSwiper($marquee, settings);
}

function AmeMarqueeTestimonials($scope) {
    var $marquee = $scope.find('.ame-testimonial-marquee');

    var settings = {
        autoplay: {
            delay: 0,
            reverseDirection: $marquee.data('marquee-reverse')
        },
        spaceBetween: $marquee.data('marquee-image-space'),
        speed: $marquee.data('marquee-speed'),
        direction: $marquee.data('marquee-direction'),
    };

    initializeMarqueeSwiper($marquee, settings);
}

$(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-image.default',
        AmeMarqueeImage
    );

    // Hook for post marquee widget
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-post.default',
        AmeMarqueePost
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-testimonials-marquee.default',
        AmeMarqueeTestimonials
    );

});

})(jQuery);