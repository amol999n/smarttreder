(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    var iScrollPos = 0;
    var loadType, loadButton, loader, pageNo, loading, morePost, scrollHandling;

    n.mobileMenu = {
        init: function () {
            this.toggleMenu(), this.menuMobile(), this.menuArrow()
        },
        toggleMenu: function () {
            e('#masthead').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                    e("#masthead").removeClass('menu-active');
                } else {
                    ethis.slideDown('300');
                    e("#masthead").addClass('menu-active');
                }
                e('.ham').toggleClass('exit');
            });
            e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li'),
                    esub_menu = eparent.find('> .sub-menu');
                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });

            e('.skip-link-menu-start').focus(function(){

                if( e('.ham').hasClass('exit') ){
                    e('#primary-menu li:last-child a').focus();
                }

            });

            e('.skip-link-menu-end').focus(function(){

                if( e('.ham').hasClass('exit') ){
                    e('.toggle-menu').focus();
                }

            });

            // Action On Esc Button
            e(document).keyup(function(j) {
                if (j.key === "Escape") { // escape key maps to keycode `27`

                    if( e('.ham').hasClass('exit') ){

                        var ethis = e('.main-navigation .menu .menu-mobile');
                        if (ethis.css('display') == 'block') {
                            ethis.slideUp('300');
                            e("#masthead").removeClass('menu-active');
                        } else {
                            ethis.slideDown('300');
                            e("#masthead").addClass('menu-active');
                        }
                        e('.ham').toggleClass('exit');

                        e('.toggle-menu').focus();

                    }

                }
            });

        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }
        },
        menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
                }
            }
        },
        n.twp_preloader = function () {
            e(window).load(function () {
                e("body").addClass("page-loaded");
            });
        },
        n.TwpReveal = function () {
            e('.icon-search').on('click', function (event) {

                e('body').toggleClass('reveal-search');

                setTimeout(function(){ 

                    e('.close-popup-1').focus();

                }, 300);

            });

            e('.skip-link-search-start').focus(function(){
                e('.close-popup-1').focus();
            });

            e('.skip-link-search-end').focus(function(){
                e('.popup-search .search-field').focus();
            });

            e('.close-popup-1').on('click', function (event) {

                e('body').removeClass('reveal-search');

                setTimeout(function(){ 

                    e('.icon-search').focus();

                }, 300);
                
            });

            e('#contact-reveal').on('click', function(event) {
                e('body').toggleClass('reveal-box');
            });

            e('.close-popup-2').on('click', function(event) {
                e('body').removeClass('reveal-box');
            });

            // Action On Esc Button
            e(document).keyup(function(j) {
                if (j.key === "Escape") { // escape key maps to keycode `27`

                    if( e('body').hasClass('reveal-search') ){

                        e('body').toggleClass('reveal-search');
                    
                        setTimeout(function(){ 

                            e('.icon-search').focus();

                        }, 300);

                    }

                }
            });

        },
        n.TwpHeadroom = function () {
            e("#nav-affix").headroom({
                "tolerance": 0,
                "offset": 164,
                "classes": {
                    "initial": "animated",
                    "pinned": "slideDown",
                    "unpinned": "slideUp",
                    "top": "headroom--top",
                    "notTop": "headroom--not-top"
                }
            });
        },
        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                if( src ){
                    e(this).css('background-image', 'url(' + src + ')').children('img').hide();
                }
            });
        },
        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },
        n.TwpSlider = function () {
            e(".gallery-columns-1").each(function () {
                e(this).owlCarousel({
                    loop: (e('.gallery-columns-1').children().length) == 1 ? false : true,
                    margin: 3,
                    autoplay: 5000,
                    nav: true,
                    navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
                    items: 1
                });
            });

            e(".testmonial-slider").owlCarousel({
                loop: (e('.testmonial-slider').children().length) == 1 ? false : true,
                items: 3,
                autoplay: 2500,
                autoplayHoverPause: true,
                margin: 30,
                dots: true,
                nav: false,
                responsive: {
                    1600: {
                        items: 4,
                    },
                    1280: {
                        items: 3,
                    },
                    980: {
                        items: 3,
                    },
                    600: {
                        items: 2,
                    },
                    320: {
                        items: 1,
                    },
                }
            });
        },

        n.MagnificPopup = function () {
            e('.gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });

            e('.zoom-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return item.el.attr('title');
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        },
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e(".scroll-up").fadeIn(300);
            } else {
                e(".scroll-up").fadeOut(300);
            }
        },
        n.scroll_up = function () {
            e(".scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 700);
                return false;
            });
        },

        n.twp_matchheight = function () {
            jQuery('.theiaStickySidebar', 'body').parent().theiaStickySidebar({
                additionalMarginTop: 30
            });
        },
        n.setLoadPostDefaults = function () {
            if(  e('.load-more-posts').length > 0 ){
                loadButton = e('.load-more-posts');
                loader = e('.load-more-posts .ajax-loader');
                loadType = loadButton.attr('data-load-type');
                pageNo = 2;
                loading = false;
                morePost = true;
                scrollHandling = {
                    allow: true,
                    reallow: function() {
                        scrollHandling.allow = true;
                    },
                    delay: 400
                };
            }
        },

        n.fetchPostsOnScroll = function () {
            if(  e('.load-more-posts').length > 0 && 'scroll' === loadType ){
                var iCurScrollPos = e(window).scrollTop();
                if( iCurScrollPos > iScrollPos ){
                    if( ! loading && scrollHandling.allow && morePost ) {
                        scrollHandling.allow = false;
                        setTimeout(scrollHandling.reallow, scrollHandling.delay);
                        var offset = e(loadButton).offset().top - e(window).scrollTop();
                        if( 2000 > offset ) {
                            loading = true;
                            n.ShowPostsAjax(loadType);
                        }
                    }
                }
                iScrollPos = iCurScrollPos;
            }
        },

        n.fetchPostsOnClick = function () {
            if( e('.load-more-posts').length > 0 && 'click' === loadType ){
                e('.load-more-posts a').on('click',function (event) {
                    event.preventDefault();
                    n.ShowPostsAjax(loadType);
                });
            }
        },

        n.ShowPostsAjax = function (loadType) {
            e.ajax({
                type : 'GET',
                url : businessStartupVal.ajaxurl,
                data : {
                    action : 'multipurpose_business_load_more',
                    nonce: businessStartupVal.nonce,
                    page: pageNo,
                    post_type: businessStartupVal.post_type,
                    search: businessStartupVal.search,
                    cat: businessStartupVal.cat,
                    taxonomy: businessStartupVal.taxonomy,
                    author: businessStartupVal.author,
                    year: businessStartupVal.year,
                    month: businessStartupVal.month,
                    day: businessStartupVal.day
                },
                dataType:'json',
                beforeSend: function() {
                    loader.addClass('ajax-loader-enabled');
                },
                success : function( response ) {
                    loader.removeClass('ajax-loader-enabled');
                    if(response.success){
                        e('.multipurpose-business-posts-lists').append( response.data.content );

                        pageNo++;
                        loading = false;
                        if(!response.data.more_post){
                            morePost = false;
                            loadButton.fadeOut();
                        }

                        /*For audio and video to work properly after ajax load*/
                        e('video, audio').mediaelementplayer({ alwaysShowControls: true });
                        /**/
                        e(".gallery-columns-1").owlCarousel({
                            loop: (e('.gallery-columns-1').children().length) == 1 ? false : true,
                            margin: 3,
                            autoplay: 5000,
                            nav: true,
                            navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
                            items: 1
                        });
                    }else{
                        loadButton.fadeOut();
                    }
                }
            });
        },

        n.parellex = function () {
            e.stellar({
                horizontalScrolling: false,
                verticalOffset: 0,
                responsive: true
            });
        },




        // tooglemap //
        n.tooglemap = function () {
            e(".map-container").click(function () {
                e(this).toggleClass("js-active");
                e(this).find(".map-toggle-open").toggle();
                e(this).find(".map-toggle-close").toggle();
            });
        },

        // init Isotope
        n.twp_isotope = function () {

            e('.masonry').imagesLoaded(function () {

                var emasonry = e('.masonry').isotope({
                    itemSelector: '.masonry-item',
                    masonry: {
                    }
                });

                // filter items on button click
                e('.filter-group').on( 'click', 'li span', function() {
                    var filterValue = e(this).attr('data-filter');
                    emasonry.isotope({ filter: filterValue });
                });

            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.TwpReveal(), n.TwpHeadroom(), n.twp_preloader(), n.DataBackground(), n.InnerBanner(), n.TwpSlider(), n.MagnificPopup(), n.scroll_up(), n.twp_matchheight(), n.parellex(), n.tooglemap(), n.twp_isotope(), n.setLoadPostDefaults(), n.fetchPostsOnClick();
        }),
        e(window).scroll(function () {
            n.show_hide_scroll_top(), n.fetchPostsOnScroll();
        }),
        e(window).resize(function () {
            n.mobileMenu.menuMobile();
        })
})(jQuery);