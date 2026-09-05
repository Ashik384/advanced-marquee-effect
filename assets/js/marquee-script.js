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

    var shouldPauseOnHover = $marquee.data('marquee-pause-on-hover') === true || 
                             $marquee.data('marquee-pause-on-hover') === 'true';

    if (shouldPauseOnHover) {
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

function AmeMarqueeTeams($scope) {
    var $marquee = $scope.find('.ame-team-marquee');

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

function AmeMarqueeCTA($scope) {
    var $marquee = $scope.find('.ame-cta-marquee');

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

function AmeMarqueeWooCommerce($scope) {
    var $marquee = $scope.find('.ame-woocommerce-marquee');

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

function AmeMarqueeWooRecentOrders($scope) {
    var $marquee = $scope.find('.ame-woo-recent-orders-marquee');

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

function AmeMarqueeImageBox($scope) {
    var $marquee = $scope.find('.ame-image-box-marquee');

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

function AmeMarqueeIconBox($scope) {
    var $marquee = $scope.find('.ame-icon-box-marquee');

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

function AmeMarqueeVideoReels($scope) {
    var $marquee = $scope.find('.ame-video-marquee');

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


/* === Video Modal Lightbox === */
function parseAmeYouTubeId(url) {
    if (!url) return '';
    var m = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
    return m ? m[1] : '';
}

function parseAmeVimeoId(url) {
    if (!url) return '';
    var m = url.match(/(?:vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+))/i);
    return m ? m[m.length - 1] : '';
}

function parseAmeTikTokId(url) {
    if (!url) return '';
    // If user pasted an iframe embed code, extract src
    var iframeMatch = url.match(/src=["']([^"']+)["']/i);
    if (iframeMatch) {
        url = iframeMatch[1];
    }
    var match = url.match(/(?:video\/|player\/v1\/|embed\/v2\/|embed\/|v\/)(\d+)/i);
    if (match && match[1]) {
        return match[1];
    }
    var digitMatch = url.match(/(\d{15,22})/);
    if (digitMatch && digitMatch[1]) {
        return digitMatch[1];
    }
    return '';
}

var ameActiveReelItems = [];
var ameActiveReelIndex = 0;
var $ameActiveMarquee = null;

function getOrCreateAmeVideoModal() {
    var $modal = $('#ame-video-modal');
    if ($modal.length) {
        return $modal;
    }

    var modalHtml = 
        '<div class="ame-video-modal-backdrop" id="ame-video-modal" role="dialog" aria-modal="true">' +
            '<button type="button" class="ame-video-modal-nav ame-video-modal-prev" aria-label="Previous video" title="Previous (Left Arrow)">' +
                '<svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>' +
            '</button>' +
            '<button type="button" class="ame-video-modal-nav ame-video-modal-next" aria-label="Next video" title="Next (Right Arrow)">' +
                '<svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>' +
            '</button>' +
            '<div class="ame-video-modal-container">' +
                '<div class="ame-video-modal-topbar">' +
                    '<button type="button" class="ame-video-modal-close" aria-label="Close" title="Close (Esc)">' +
                        '<svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>' +
                    '</button>' +
                '</div>' +
                '<div class="ame-video-modal-content"></div>' +
                '<div class="ame-video-modal-footer">' +
                    '<div class="ame-video-modal-tags">' +
                        '<span class="ame-video-modal-badge"></span>' +
                        '<span class="ame-video-modal-views"></span>' +
                    '</div>' +
                    '<h3 class="ame-video-modal-title"></h3>' +
                    '<p class="ame-video-modal-caption"></p>' +
                    '<a class="ame-video-modal-author" href="" target="_self">' +
                        '<img class="ame-video-modal-author-avatar" src="" alt="" />' +
                        '<div class="ame-video-modal-author-info">' +
                            '<span class="ame-video-modal-author-name"></span>' +
                            '<span class="ame-video-modal-author-handle"></span>' +
                        '</div>' +
                    '</a>' +
                '</div>' +
            '</div>' +
        '</div>';

    $('body').append(modalHtml);
    $modal = $('#ame-video-modal');

    // Navigation buttons
    $modal.on('click', '.ame-video-modal-prev', function (e) {
        e.preventDefault();
        e.stopPropagation();
        ameVideoModalGoPrev();
    });

    $modal.on('click', '.ame-video-modal-next', function (e) {
        e.preventDefault();
        e.stopPropagation();
        ameVideoModalGoNext();
    });

    // Close on clicking close button
    $modal.on('click', '.ame-video-modal-close', function (e) {
        e.preventDefault();
        closeAmeVideoModal();
    });

    // Author link click inside modal
    $modal.on('click', '.ame-video-modal-author.has-author-link', function (e) {
        e.stopPropagation();
    });

    // Close on clicking backdrop outside container
    $modal.on('click', function (e) {
        if ($(e.target).closest('.ame-video-modal-container, .ame-video-modal-nav').length === 0) {
            closeAmeVideoModal();
        }
    });

    // Keyboard navigation (Esc, ArrowLeft, ArrowRight)
    $(document).on('keydown', function (e) {
        if (!$modal.hasClass('is-active')) return;
        if (e.key === 'Escape' || e.keyCode === 27) {
            closeAmeVideoModal();
        } else if (e.key === 'ArrowLeft' || e.keyCode === 37) {
            e.preventDefault();
            ameVideoModalGoPrev();
        } else if (e.key === 'ArrowRight' || e.keyCode === 39) {
            e.preventDefault();
            ameVideoModalGoNext();
        }
    });

    // Touch swipe gestures on mobile
    var touchStartX = 0;
    var touchStartY = 0;
    $modal.on('touchstart', function (e) {
        if (e.originalEvent.touches && e.originalEvent.touches.length) {
            touchStartX = e.originalEvent.touches[0].clientX;
            touchStartY = e.originalEvent.touches[0].clientY;
        }
    });
    $modal.on('touchend', function (e) {
        if (e.originalEvent.changedTouches && e.originalEvent.changedTouches.length) {
            var diffX = e.originalEvent.changedTouches[0].clientX - touchStartX;
            var diffY = e.originalEvent.changedTouches[0].clientY - touchStartY;
            if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY) * 1.4) {
                if (diffX < 0) {
                    ameVideoModalGoNext();
                } else {
                    ameVideoModalGoPrev();
                }
            }
        }
    });

    return $modal;
}

function ameVideoModalGoPrev() {
    if (ameActiveReelItems.length <= 1) return;
    ameActiveReelIndex = (ameActiveReelIndex - 1 + ameActiveReelItems.length) % ameActiveReelItems.length;
    renderAmeVideoModalContent(ameActiveReelItems[ameActiveReelIndex]);
}

function ameVideoModalGoNext() {
    if (ameActiveReelItems.length <= 1) return;
    ameActiveReelIndex = (ameActiveReelIndex + 1) % ameActiveReelItems.length;
    renderAmeVideoModalContent(ameActiveReelItems[ameActiveReelIndex]);
}

function renderAmeVideoModalContent(data) {
    var $modal = getOrCreateAmeVideoModal();
    var $container = $modal.find('.ame-video-modal-container');
    var $content = $modal.find('.ame-video-modal-content');
    var $badge = $modal.find('.ame-video-modal-badge');
    var $views = $modal.find('.ame-video-modal-views');
    var $title = $modal.find('.ame-video-modal-title');
    var $caption = $modal.find('.ame-video-modal-caption');
    var $author = $modal.find('.ame-video-modal-author');
    var $avatar = $modal.find('.ame-video-modal-author-avatar');
    var $authorName = $modal.find('.ame-video-modal-author-name');
    var $authorHandle = $modal.find('.ame-video-modal-author-handle');
    var $footer = $modal.find('.ame-video-modal-footer');
    var $navBtns = $modal.find('.ame-video-modal-nav');

    // Clean previous video/iframe to prevent memory leaks and ghost audio
    $content.find('video').each(function () {
        this.pause();
        this.src = '';
    });
    $content.find('iframe').attr('src', '');
    $content.empty();

    // Reset aspect ratio and type classes
    $container.removeClass('is-ratio-9-16 is-ratio-16-9 is-ratio-1-1 is-ratio-4-3 is-ratio-custom is-type-self_hosted is-type-youtube is-type-vimeo is-type-tiktok');
    $content.removeClass('ame-modal-ratio-9-16 ame-modal-ratio-16-9 ame-modal-ratio-1-1 ame-modal-ratio-4-3 ame-modal-ratio-custom');

    var ratio = data.ratio || '9-16';
    if (ratio === 'custom') {
        ratio = (data.type === 'youtube' || data.type === 'vimeo') ? '16-9' : '9-16';
    }
    $container.addClass('is-ratio-' + ratio);
    $content.addClass('ame-modal-ratio-' + ratio);

    // Navigation arrows visibility
    if (ameActiveReelItems.length > 1) {
        $navBtns.show();
    } else {
        $navBtns.hide();
    }

    var mediaHtml = '';
    var type = data.type || 'self_hosted';
    var src = data.src || '';
    $container.addClass('is-type-' + type);

    if (type === 'self_hosted') {
        if (src) {
            var posterAttr = (data.poster && data.poster.indexOf('placeholder') === -1) ? ' poster="' + data.poster + '"' : '';
            mediaHtml = '<video src="' + src + '"' + posterAttr + ' controls autoplay playsinline preload="auto"></video>';
        }
    } else if (type === 'youtube') {
        var ytId = parseAmeYouTubeId(src);
        if (ytId) {
            var embedSrc = 'https://www.youtube-nocookie.com/embed/' + ytId + '?autoplay=1&mute=0&controls=1&rel=0&playsinline=1';
            mediaHtml = '<iframe src="' + embedSrc + '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
    } else if (type === 'vimeo') {
        var vmId = parseAmeVimeoId(src);
        if (vmId) {
            var embedSrc = 'https://player.vimeo.com/video/' + vmId + '?autoplay=1&muted=0&controls=1&playsinline=1';
            mediaHtml = '<iframe src="' + embedSrc + '" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
        }
    } else if (type === 'tiktok') {
        var ttId = parseAmeTikTokId(src);
        if (!ttId || ttId === '7106594312292453678') {
            ttId = '6718335390845095173';
        }
        var embedSrc = 'https://www.tiktok.com/player/v1/' + ttId + '?autoplay=1&loop=1';
        mediaHtml = '<iframe src="' + embedSrc + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" allowfullscreen></iframe>';
    }

    if (!mediaHtml) {
        return;
    }

    $content.html(mediaHtml);

    if (type === 'self_hosted') {
        var videoEl = $content.find('video')[0];
        if (videoEl) {
            var playPromise = videoEl.play();
            if (playPromise !== undefined) {
                playPromise.catch(function () {
                    // Browser blocked unmuted autoplay; mute and retry so video runs cleanly
                    videoEl.muted = true;
                    videoEl.play().catch(function () {});
                });
            }
        }
    }

    // Badge & views tags
    if (data.badge) {
        $badge.text(data.badge).show();
    } else {
        $badge.hide();
    }

    if (data.views) {
        $views.text(data.views).show();
    } else {
        $views.hide();
    }

    // Title and caption
    $title.text(data.title || '').toggle(!!data.title);
    $caption.text(data.caption || '').toggle(!!data.caption);

    // Author / UGC info
    if (data.authorAvatar || data.authorName || data.authorHandle) {
        if (data.authorAvatar) {
            $avatar.attr('src', data.authorAvatar).show();
        } else {
            $avatar.hide();
        }
        $authorName.text(data.authorName || '').toggle(!!data.authorName);
        $authorHandle.text(data.authorHandle || '').toggle(!!data.authorHandle);

        if (data.link) {
            $author.attr('href', data.link);
            $author.attr('target', data.linkTarget || '_blank');
            if (data.linkRel) {
                $author.attr('rel', data.linkRel);
            } else {
                $author.removeAttr('rel');
            }
            $author.addClass('has-author-link');
        } else {
            $author.removeAttr('href').removeAttr('target').removeAttr('rel').removeClass('has-author-link');
        }

        $author.css('display', 'flex');
    } else {
        $author.hide();
    }

    if (data.title || data.caption || data.badge || data.views || data.authorName || data.authorAvatar) {
        $footer.show();
    } else {
        $footer.hide();
    }
}

function openAmeVideoModal(data) {
    var $modal = getOrCreateAmeVideoModal();
    renderAmeVideoModalContent(data);

    // Pause background marquee for smooth performance and lower GPU usage
    if ($ameActiveMarquee && $ameActiveMarquee.length) {
        $ameActiveMarquee.addClass('ame-marquee-is-frozen');
    }

    $('body').css('overflow', 'hidden');
    $modal.addClass('is-active');
}

function closeAmeVideoModal() {
    var $modal = $('#ame-video-modal');
    if ($modal.length) {
        $modal.removeClass('is-active');

        // Resume background marquee
        if ($ameActiveMarquee && $ameActiveMarquee.length) {
            $ameActiveMarquee.removeClass('ame-marquee-is-frozen');
            $ameActiveMarquee = null;
        }

        setTimeout(function () {
            $modal.find('.ame-video-modal-content').find('video').each(function () {
                this.pause();
                this.src = '';
            });
            $modal.find('.ame-video-modal-content').find('iframe').attr('src', '');
            $modal.find('.ame-video-modal-content').empty();
            $('body').css('overflow', '');
        }, 200);
    }
}

// Delegated click & keydown handler for popup triggers (indexes items from current marquee)
$(document).on('click keydown', '.ame-video-popup-trigger', function (e) {
    if (e.type === 'keydown') {
        if (e.key !== 'Enter' && e.key !== ' ' && e.keyCode !== 13 && e.keyCode !== 32) {
            return;
        }
    }
    e.preventDefault();
    e.stopPropagation();
    var $btn = $(this);
    var $marquee = $btn.closest('.ame-video-marquee');
    $ameActiveMarquee = $marquee;

    // Index all items from this marquee instance (excluding Swiper duplicates)
    ameActiveReelItems = [];
    var $items = $marquee.find('.ame-marquee__item:not(.swiper-slide-duplicate)');
    if (!$items.length) {
        $items = $marquee.find('.ame-marquee__item');
    }

    $items.each(function () {
        var $trig = $(this).find('.ame-video-click-layer');
        if (!$trig.length) {
            $trig = $(this).find('.ame-video-popup-trigger');
        }
        if ($trig.length) {
            ameActiveReelItems.push({
                type: $trig.data('ame-video-type') || 'self_hosted',
                src: $trig.data('ame-video-src') || '',
                poster: $trig.data('ame-video-poster') || '',
                title: $trig.data('ame-video-title') || '',
                caption: $trig.data('ame-video-caption') || '',
                badge: $trig.data('ame-video-badge') || '',
                views: $trig.data('ame-video-views') || '',
                authorName: $trig.data('ame-video-author-name') || '',
                authorHandle: $trig.data('ame-video-author-handle') || '',
                authorAvatar: $trig.data('ame-video-author-avatar') || '',
                link: $trig.data('ame-video-link') || '',
                linkTarget: $trig.data('ame-video-link-target') || '_self',
                linkRel: $trig.data('ame-video-link-rel') || '',
                ratio: $trig.data('ame-video-ratio') || '9-16'
            });
        }
    });

    var currentSrc = $btn.data('ame-video-src') || '';
    var currentTitle = $btn.data('ame-video-title') || '';
    ameActiveReelIndex = 0;

    for (var k = 0; k < ameActiveReelItems.length; k++) {
        if (ameActiveReelItems[k].src === currentSrc && ameActiveReelItems[k].title === currentTitle) {
            ameActiveReelIndex = k;
            break;
        }
    }

    var activeData = (ameActiveReelItems[ameActiveReelIndex]) ? ameActiveReelItems[ameActiveReelIndex] : {
        type: $btn.data('ame-video-type') || 'self_hosted',
        src: currentSrc,
        poster: $btn.data('ame-video-poster') || '',
        title: currentTitle,
        caption: $btn.data('ame-video-caption') || '',
        badge: $btn.data('ame-video-badge') || '',
        views: $btn.data('ame-video-views') || '',
        authorName: $btn.data('ame-video-author-name') || '',
        authorHandle: $btn.data('ame-video-author-handle') || '',
        authorAvatar: $btn.data('ame-video-author-avatar') || '',
        link: $btn.data('ame-video-link') || '',
        linkTarget: $btn.data('ame-video-link-target') || '_self',
        linkRel: $btn.data('ame-video-link-rel') || '',
        ratio: $btn.data('ame-video-ratio') || '9-16'
    };

    openAmeVideoModal(activeData);
});

// Direct author link clicks on cards should navigate without triggering popup modal
$(document).on('click', '.ame-video-author-link', function (e) {
    e.stopPropagation();
});

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

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-team-marquee.default',
        AmeMarqueeTeams
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-cta-marquee.default',
        AmeMarqueeCTA
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-image-box.default',
        AmeMarqueeImageBox
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-icon-box.default',
        AmeMarqueeIconBox
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-woocommerce.default',
        AmeMarqueeWooCommerce
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-woo-recent-orders.default',
        AmeMarqueeWooRecentOrders
    );

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/ame-marquee-video-reels.default',
        AmeMarqueeVideoReels
    );

});

})(jQuery);