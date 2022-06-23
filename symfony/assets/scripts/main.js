'use strict';

import './extra';

const w = window;
const showLoader = w.showLoader;
const hideLoader = w.hideLoader;

const $ = w.$ || w.jQuery;
const jQuery = $;

const markup = `
<div class="mfp-figure">
    <div class="mfp-close"></div>
    <div class="cocoen">
        <div class="mfp-img"></div>
        <div class="mfp-after-img"></div>
    </div>

    <div class="mfp-bottom-bar">
        <div class="mfp-title"></div>
        <div class="mfp-counter"></div>
    </div>
</div>
`;

function min(a, b) {
    return a > b ? a : b;
}

const _magnificPopupSettings = {
    type: 'image',
    callbacks: {
        markupParse: function(template, values, item) {
            const container = $(template);
            container.find('.mfp-img').replaceWith(values.img_replaceWith);
            const aHref = $(item.el);
            const afterUrl = aHref.data('afterbg');
            if (!afterUrl) {
                showLoader(0);
                const _beforeImg = container.find('.mfp-img')[0];
                setTimeout(() => {
                    $(_beforeImg).css({'maxHeight': '85vh', maxWidth: '-webkit-fill-available', width: '100%', height: '85vh'});
                });
                setTimeout(() => {
                    hideLoader(200);
                }, 200);
                return;
            }
        },
    },
    image: {
        markup,
        cursor: 'mfp-zoom-out-cur',
        titleSrc: 'title',
        verticalFit: true,
        tError: '<a href="%url%">The image</a> could not be loaded.',
    },
    closeOnBgClick: false,
    closeBtnInside: false,
    gallery: {
        tPrev: 'Previous (Left arrow key)',
        tNext: 'Next (Right arrow key)',
        enabled: true,
    },
};


$(window).on('load', function () {
    /*------------------
        Preloder
    --------------------*/
    $(".loader").fadeOut();

    /*------------------
        Masonry
    --------------------*/
    $('.filter-controls li').on('click', function () {
        $('.filter-controls li').removeClass('active');
        $(this).addClass('active');
    });

    if ($('.blog_row').length > 0) {
        $('.blog_row').masonry();
    }

});

(function ($) {
    /*-------------------
        Header Sticky
    --------------------*/
    $(window).on('scroll resize', function (e) {
        $('main__menu').removeClass('menu--hide');
        if ($(this).scrollTop() > 83) {
            $('.header').addClass('sticky');
            $('body').addClass('pt83');
        } else {
            $('.header').removeClass('sticky');
            $('body').removeClass('pt83');
        }
        e.preventDefault();
    });


    /*-------------------
        Albums Slider
    -------------------*/
    const sync1 = $(".album__slider");
    const sync2 = $(".album_thumb_slider");
    const syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        autoplay: false,
    }).on('changed.owl.carousel', syncPosition);

    sync2.on('initialized.owl.carousel', function () {
        sync2.find(".owl-item").eq(0).addClass("current");
    }).owlCarousel({
        dots: false,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        autoplay: false,
        smartSpeed: 200,
        slideSpeed: 500,
        margin: 20,
        responsiveRefreshRate: 100,
        items: 8,
        slideBy: 8,
        responsive: {
            0: {
                items: 2,
                slideBy: 2,
            },
            480: {
                items: 4,
                slideBy: 4,
            },
            768: {
                items: 6,
                slideBy: 6,
            },
            992: {
                items: 8,
                slideBy: 8,
            }
        }
    }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });

    /*-------------------
        Magnific Popup
    -------------------*/
    $('.gallery_img').magnificPopup(_magnificPopupSettings);
})(jQuery);

$(window).on('load', function() {
    /*------------------
        Preloder
    --------------------*/
    $(".loader").fadeOut();
    $("#preloder").delay(400).fadeOut("slow");

});


(function($) {

    /*------------------
        Background set
    --------------------*/
    /*------------------
        Background set
    --------------------*/
    $('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });


    $('.review-slider').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        autoplay: true
    });

    $('.progress-bar-style').each(function() {
        var progress = $(this).data("progress");
        var prog_width = progress + '%';
        if (progress <= 100) {
            $(this).append('<div class="bar-inner" style="width:' + prog_width + '"><span>' + prog_width + '</span></div>');
        }
        else {
            $(this).append('<div class="bar-inner" style="width:100%"><span>' + prog_width + '</span></div>');
        }
    });


    $('.lan-prog').each(function() {
        var progress = $(this).data("lanprogesss");
        var ele      = '<span></span>';
        var ele_fade = '<span class="fade-ele"></span>';

        for (var i = 1; i <= 5; i++) {
            if(i <= progress){
                $(this).append(ele);
            } else {
                $(this).append(ele_fade);
            }
        }
    });


    /*------------------
        Popup
    --------------------*/
    $('.portfolio-item .port-pic').magnificPopup({
        type: 'image',
        mainClass: 'img-popup-warp',
        removalDelay: 500,
    });


    console.log($().cirecleProgress);
    if($().circleProgress){
        //Set progress circle 1
        const val1 = ($('#progress1').data('value') || 0) / 100;
        const val2 = ($('#progress2').data('value') || 0) / 100;
        $("#progress1").circleProgress({
            value: val1,
            size: 175,
            thickness: 2,
            fill: "#40424a",
            emptyFill: "rgba(0, 0, 0, 0)"
        });
        //Set progress circle 2
        $("#progress2").circleProgress({
            value: val2,
            size: 175,
            thickness: 2,
            fill: "#40424a",
            emptyFill: "rgba(0, 0, 0, 0)"
        });
    }

})(jQuery);