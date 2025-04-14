(function ($) {
function initializeMarqueeSwiper($marquee, settings) {
    if (!$marquee.length || $marquee.hasClass('swiper-initialized')) {
        return;
    }

    var $swiperWrapper = $marquee.find('.swiper-wrapper');
    var $slides = $swiperWrapper.find('.swiper-slide'); // or your custom class

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
    new Swiper($marquee[0], Object.assign({
        loop: true,
        slidesPerView: 'auto',
        autoplay: {
            delay: 0,
        },
        allowTouchMove: false,
        freeMode: true,
        freeModeMomentum: false
    }, settings));
}

function AmeMarqueeImage($scope) {
    var $marquee = $scope.find('.ame-marquee');

    var settings = {
        spaceBetween: $marquee.data('marquee-image-space'),
        speed: $marquee.data('marquee-speed'),
        direction: $marquee.data('marquee-direction'),
        autoplay: {
            delay: 0,
            reverseDirection: $marquee.data('marquee-reverse')
        }
    };

    initializeMarqueeSwiper($marquee, settings);
}

$(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-image.default',
        AmeMarqueeImage
    );
});

})(jQuery);