(function($) {
    "use strict";
    $(document).ready(function() {
        
        $('#home').css({
            'height': (($(window).height() - 118)) + 'px'
        });
        $(window).resize(function() {
            $('#home').css({
                'height': (($(window).height() - 118)) + 'px'
            });
        });
        $('a[href^=#welcome]').on("click", function() {
            var t = $(this.hash);
            var t = t.length && t || $('[name=' + this.hash.slice(1) + ']');
            if (t.length) {
                var tOffset = (t.offset().top - 65);
                $('html,body').animate({
                    scrollTop: tOffset
                }, 'slow');
                return false;
            }
        });
        $('#slides').superslides({
            play: 5000,
            animation_speed: 2000,
            animation: 'fade',
            pagination: false
        });
        $(function() {
            var list_slideshow = $(".slider-offers ul"),
                listItems = list_slideshow.children('li'),
                listLen = listItems.length,
                i = 0,
                changeList = function() {
                    listItems.eq(i).fadeOut(1000, function() {
                        i += 1;
                        if (i === listLen) {
                            i = 0;
                        }
                        listItems.eq(i).fadeIn(1000);
                    });
                };
            listItems.not(':first').hide();
            setInterval(changeList, 5000);
        });
        $("blockquote").prepend("<span class='quote'><i class='fa fa-quote-right'></i></span>");
        $("#featured-posts .owl-carousel").owlCarousel({
            items: 4,
            margin: 30,
            loop: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 1500,
            nav: true,
            navText: ['<a class="btn btn-primary"><i class="fa fa-caret-left"></i></a>', '<a class="btn btn-primary"><i class="fa fa-caret-right"></i></a>'],
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                },
                991: {
                    items: 4
                }
            }
        });
        $("#featured-teachers .owl-carousel").owlCarousel({
            items: 4,
            margin: 30,
            loop: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 1500,
            nav: true,
            navText: ['<a class="btn btn-primary"><i class="fa fa-caret-left"></i></a>', '<a class="btn btn-primary"><i class="fa fa-caret-right"></i></a>'],
            responsive: {
                0: {
                    items: 1
                },
                481: {
                    items: 2
                },
                767: {
                    items: 3
                },
                991: {
                    items: 4
                }
            }
        });
        $("#recent-posts .owl-carousel").owlCarousel({
            items: 2,
            margin: 30,
            loop: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 1500,
            nav: true,
            navText: ['<a class="btn btn-primary"><i class="fa fa-caret-left"></i></a>', '<a class="btn btn-primary"><i class="fa fa-caret-right"></i></a>'],
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                }
            }
        });
        $("#teachers-reviews .owl-carousel").owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            items: 1,
            loop: true,
            autoplay: true,
            dots: false,
            smartSpeed: 450
        });
        $("#about-reviews .owl-carousel").owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            items: 1,
            loop: true,
            autoplay: true,
            dots: false,
            smartSpeed: 450
        });
        $('#teachers-reviews').parallax("100%", -0.3);
        $('#about-reviews').parallax("100%", -0.3);
        $('#search').parallax("100%", -0.3);
        $('#newsletter').parallax("100%", -0.3);
        var $container = $('.masonry');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.item'
            });
        });
        $('.fancybox').fancybox({
            openEffect: 'none'
        });
        $('.progress .progress-bar').progressbar();
        if ($(window).width() > 767) {
            var config = {
                after: '0s',
                enter: 'top',
                move: '50px',
                over: '0.66s',
                easing: 'ease-in-out',
                viewportFactor: 0.33,
                reset: false,
                init: true
            };
            window.scrollReveal = new scrollReveal({
                reset: true
            });
        }
    })
})(jQuery);