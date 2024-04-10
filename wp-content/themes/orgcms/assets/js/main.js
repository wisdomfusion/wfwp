$(function () {
    // 主导航
    $('.main-menu > .menu-item').hover(function () {
        if (!$(this).is(':animated')) {
            $(this).find('.sub-menu').stop().slideDown();
        }
    }, function () {
        if (!$(this).is(':animated')) {
            $(this).find('.sub-menu').stop().slideUp();
        }
    });

    // 首页 banner 轮播
    const swiper = new Swiper('.home-slides.swiper', {
        speed: 400,
        effect: 'fade',
        // autoplay: {
        //     delay: 5000,
        // },
        loop: true,
        pagination: {
            el: '.home-slides.swiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.home-slides.swiper .swiper-button-next',
            prevEl: '.home-slides.swiper .swiper-button-prev',
        },
    });

    const imgNewsSwiper = new Swiper('.featured-news-list.swiper', {
        speed: 400,
        effect: 'fade',
        autoplay: {
            delay: 5000,
        },
        loop: true,
        pagination: {
            el: '.featured-news-list.swiper .swiper-pagination',
            clickable: true,
        }
    });

    // 首页-研究方向
    $('.research-directions .research-direction').each(function () {
        $(this).find('.more a').attr('href', $(this).find('h4 a').attr('href'));
    });

    // 当前位置
    $('.current-position .breadcrumbs .breadcrumb:not(:last-child)').after('<span class="divider">/</span>');

    // 文章中图片段落不缩进
    $('.two-col > article p').each(function () {
        if ($(this).find('img').length) {
            $(this).addClass('no-indent');
        }
    });
});