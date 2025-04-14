(function ($) {
    function initMarqueeSwiper($scope) {
        var $marquee = $scope.find('.ame-marquee');

        if (!$marquee.length || $marquee.hasClass('swiper-initialized')) {
            return;
        }

        var $marquee_speed = $marquee.data('marquee-speed');
        var $marquee_direction = $marquee.data('marquee-direction');
        var $marquee_reverse = $marquee.data('marquee-reverse');

        var $swiperWrapper = $marquee.find('.swiper-wrapper');
        var $slides = $swiperWrapper.find('.ame-marquee__item');

        // 👇 Clone slides if less than or equal to 3 for smooth scrolling
        if ($slides.length > 0 && $slides.length <= 4) {
            var cloneCount = Math.ceil(8 / $slides.length);
            for (var i = 0; i < cloneCount; i++) {
                $slides.each(function () {
                    $swiperWrapper.append($(this).clone());
                });
            }
        }

        // ✅ Initialize Swiper after cloning
        new Swiper($marquee[0], {
            loop: true,
            slidesPerView: 'auto', // 👈 This is essential
            spaceBetween: 20,
            speed: $marquee_speed,
            direction: $marquee_direction,
            autoplay: false,
            allowTouchMove: false,
            freeMode: true, // 👈 Enables continuous non-snapping flow
            freeModeMomentum: false, // 👈 Prevents snapping in free mode
            breakpoints: {
                320: { spaceBetween: 10 },
                640: { spaceBetween: 15 },
                1024: { spaceBetween: 20 }
            }
        });
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/ame-marquee-image.default',
            initMarqueeSwiper
        );
    });

})(jQuery);
