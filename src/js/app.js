var app_global = {
    init: function () {
        //this.autoMenuNav();
        this.toggleNav();
        this.scrollNav();
        this.loadVideo();
        this.init_wow();
        this.autoProgressBarText();
    },
    toggleNav: function () {
        $(".header .toggle-act,.header .bg-overlay").unbind("click").click(function (evt) {
            evt.preventDefault();
            $(".header .navbar-mobile").toggleClass("expand");
            $("body").toggleClass("active-navbar-slide ");
        });
    },
    loadVideo: function () {
        $(".banner_video source").each(function () {
            var sourceFile = $(this).attr("data-src");
            $(this).attr("src", sourceFile);
            var video = this.parentElement;
            video.load();
            video.play();
        });
    },
    scrollNav: function () {
        $("a.scroll").click(function (e) {
            var full_url = $(this).attr("data-target");
            var target_offset = $(full_url).offset();
            var target_top = target_offset.top;

            var navbar_height = $('.header .logo-wrapper').outerHeight(true);//target_top > $(window).scrollTop() ? 0 : $('.header .logo-wrapper').outerHeight(true);

            $('html,body').animate({ scrollTop: target_top - navbar_height }, 1000);

            if ($('body').hasClass("active-navbar-slide")) {
                $(".navbar-mobile .toggle-act").trigger("click");
            }

            return false;
        });
    },
    autoMenuNav: function () {
        var $window = $(window);
        var prev = $('.header .logo-wrapper').outerHeight(true);//0
        var nav = $('.header .logo-wrapper');

        $window.on('scroll', function () {
            var scrollTop = $window.scrollTop();
            nav.toggleClass('scroll-hide', scrollTop > prev);
            prev = scrollTop;
        });
    },
    init_wow: function () {
        try {
            if (typeof WOW != "undefined") {
                var wow = new WOW(
                    {
                        boxClass: 'wow',      // animated element css class (default is wow)
                        animateClass: 'animated', // animation css class (default is animated)
                        offset: 0,          // distance to the element when triggering the animation (default is 0)
                        mobile: true,       // trigger animations on mobile devices (default is true)
                        live: true,       // act on asynchronously loaded content (default is true)
                        callback: function (box) {
                            // the callback is fired every time an animation is started
                            // the argument that is passed in is the DOM node being animated
                        },
                        scrollContainer: null,    // optional scroll container selector, otherwise use window,
                        resetAnimation: true,     // reset animation on end (default is true)
                    }
                );
                wow.init();
            }
            else {
                console.log("loading wow....");
            }
        } catch (e) {

        }
    },
    autoProgressBarText: function () {
        $(".progress").each(function () {
            var $this = $(this);
            try {
                var $text = $(".progress-bar-text", $this);
                var w = $text.width() / 2.0;
                var w2 = $(".progress-bar", $this).width();

                var pos = w2 - w;
                if (pos <= 0)
                    pos = 0;
                $text.css({ 'left': pos });

                if ((w2 + w) >= $this.width()) {
                    
                    pos = 0;
                    $text.css({ 'right': pos, 'left': 'auto' });
                }
            } catch (e) {

            }
        });
    }
};

function setLanguage(lang){
	Cookies.remove('lang', { path: '/' });
	Cookies.set('lang', lang, { expires: 7, path: '/', domain:'.pocaga.io' });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function () {
    // executes when HTML-Document is loaded and DOM is ready
    app_global.init();
});

$(window).on("load", function () {
    // executes when complete page is fully loaded, including all frames, objects and images
    $('#apploader').fadeOut(100);
});