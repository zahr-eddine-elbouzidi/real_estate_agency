/*global jQuery */
(function($) {
    "use strict";
    jQuery(document).ready(function($) {
        /*--------------------------
            01. Background Image JS
        ---------------------------*/
        const bgSelector = $("[data-bg]");
        bgSelector.each(function(index, elem) {
            let element = $(elem),
                bgSource = element.data('bg');
            element.css('background-image', 'url(' + bgSource + ')');
        });

        /*---------------------------------
            02. OffCanvas Show Hide JS
        -----------------------------------*/
        const offCanvasWrapper = ".offCanvas-wrapper",
            btnOpen = $(".btn-open"),
            btnClose = $(".btn-close");

        btnOpen.on('click', function() {
            let dataSrc = '.' + $(this).data('src');
            $(offCanvasWrapper + dataSrc).addClass("show");
            $("body").addClass("fix");

            console.log(offCanvasWrapper + dataSrc);
        });

        btnClose.on('click', function() {
            $(offCanvasWrapper).removeClass("show");

            setTimeout(function() {
                $("body").removeClass("fix");
            }, 2000);
        });

        /*---------------------------------
            03. Sticky Header JS
        -----------------------------------*/
        const headroom = $(".sticky-header");
        headroom.headroom({
            offset: 205,
            tolerance: 5,
            classes: {
                initial: "headroom",
                pinned: "slideDown",
                unpinned: "slideUp",
                notTop: "is-sticky"
            }
        });

        /*-----------------------------------------
            04. Vertical DropDown Menu Expand JS
        ------------------------------------------*/
        let $verticalNav = $('.main-nav.vertical'),
            $$verticalNavSubMenu = $verticalNav.find('.sub-nav');

        $$verticalNavSubMenu.slideUp();
        $verticalNav.on('click', 'li a', function(e) {
            let $this = $(this);
            if ($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-submenu)\b/)) {
                e.preventDefault();
                if ($this.siblings('ul:visible').length) {
                    $this.parent('li').removeClass('active');
                    $this.siblings('ul').slideUp();
                } else {
                    $this.parent('li').addClass('active');
                    $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
                    $this.closest('li').siblings('li').find('ul:visible').slideUp();
                    $this.siblings('ul').slideDown();
                }
            }
        });

        /*------------------------------------
            05. Vertical Sub Menu Animation
        --------------------------------------*/
        let menuItem = $(".main-nav.vertical > li"),
            offCanvas = $(".offCanvas-wrapper.popup-menu"),
            transitionDelay = [];
        for (let i = 1, j = 7; i <= menuItem.length; i++, j++) {
            $('.main-nav.vertical > li:nth(' + i + ')').css('transition-delay', j / 10 + 's');

            transitionDelay[i - 1] = j;
            offCanvas.css('-webkit-transition-delay', (transitionDelay[transitionDelay.length - 1] + 3) / 10 + 's');
        }

        /*------------------------------------
            06. Instagram Instafeed JS
        --------------------------------------*/
        let activeId = $(".instagram-gallery");
        let myTemplate = '<div class="instagram-item">';
        myTemplate += '<a href="{{link}}" target="_blank" id="{{id}}"><img src="{{image}}"  alt="{{id}}"/></a>';
        myTemplate += '<div class="instagram-hvr-content">';
        myTemplate += '<span class="tottallikes"><i class="fa fa-heart"></i>{{likes}}</span>';
        myTemplate += '<span class="totalcomments"><i class="fa fa-comments"></i>{{comments}}</span>';
        myTemplate += '</div>';
        myTemplate += '</div>';

        if (activeId.length) {
            activeId.each(function() {
                let $this = $(this),
                    $id = $this.attr('id'),
                    limit = activeId.data("limit") ? activeId.data("limit") : 6,
                    $feed = new Instafeed({
                        target: $id,
                        limit: limit,
                        template: myTemplate,
                        accessToken: "IGQVJWRlI0cGpSWm44eW9qSklnV1hIclZArNi1zbW5xZAVZAZAYXVoYUo0TUtwNDNMQ2o5VzBxRDNTa1lNSHVzVHBWSEtSZAFR3NmlkSWlxZAlUwN2RBRjc2YWVwYWR4QldENFRLUDlCanpCNTBTOS1VMXh6LQZDZD"
                    });
                $feed.run();
            });
        }

        /*------------------------------
            07. Responsive Slicknav JS
        --------------------------------*/
        $('.main-nav:not(.vertical)').slicknav({
            appendTo: '.responsive-mobile-menu',
            closeOnClick: true,
            removeClasses: true,
            closedSymbol: '<i class="icon-arrows-plus"></i>',
            openedSymbol: '<i class="icon-arrows-minus"></i>'
        });

        /*---------------------------
            08. Magnific Popup JS
         ------------------------------*/
        // For Video Popup
        const videopopup = $(".btn-video-popup");
        videopopup.magnificPopup({
            type: 'iframe',
            mainClass: 'ht-mfp zoom-animate',
            removalDelay: 800,
            closeBtnInside: false
        });

        // For Image Gallery Popup
        const imgGallery = $(".image-gallery-popup");
        imgGallery.magnificPopup({
            delegate: '[data-mfp-src]',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'ht-mfp mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 400,
                opener: function(element) {
                    return element.find('img');
                }
            }
        });

        // Custom Gallery on Button Click
        const galleryBtnPopup = $(".btn-gallery-popup");
        galleryBtnPopup.on('click', function(event) {
            event.preventDefault();

            const gallery = $(this).attr('href');

            $(gallery).magnificPopup({
                delegate: '[data-mfp-src]',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'ht-mfp zoom-animate mfp-img-mobile',
                removalDelay: 800,
                image: {
                    verticalFit: true
                },
                gallery: {
                    enabled: true
                }
            }).magnificPopup('open');
        });


        // For Single Image Popup
        const imgpopup = $(".btn-img-popup");
        imgpopup.magnificPopup({
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'ht-mfp zoom-animate',
            removalDelay: 800
        });

        /*------------------------------
            09. Counter Odometer JS
        --------------------------------*/

        $('.odometer').each(function() {
            $(this).appear(function() {
                const $this = $(this),
                    $dataValue = $this.data('count');

                setTimeout(function() {
                    $this.html($dataValue);
                }, 800);
            })
        });

        /*------------------------------
            10. Pie Chart JS
        --------------------------------*/

        const chartSelector = $(".ht-pie-chart");
        chartSelector.each(function() {
            $(this).appear(function() {
                let $this = $(this),
                    amount = '<span class="progressbar-percent">' + $this.data('percent') + '%</span>';
                $this.html(amount);
                $this.easyPieChart({
                    trackColor: "#F9F9F9",
                    scaleColor: false,
                    lineWidth: 6
                });
            })
        });

        /*------------------------------
            11. Progressbar JS
        --------------------------------*/
        const progressBar = $(".progress-line-bar");
        progressBar.appear(function() {
            progressBar.each(function(index, elem) {
                let elementItem = $(elem),
                    skillBarAmount = elementItem.data('percent');
                elementItem.animate({
                    width: skillBarAmount
                }, 800);
                elementItem.closest('.progressbar-item').find('.percent').text(skillBarAmount);
                elementItem.closest('.progressbar-item').find('.progress-info').css('width', skillBarAmount);
            });
        });

        /*------------------------------
            12. FullPage JS
        --------------------------------*/
        const fullPageSelector = $(".fullPage"),
            header = $(".header-presentation"),
            footer = $(".footer-presentation"),
            windowWidth = $(window).width();

        if (fullPageSelector.length && windowWidth > 767) {
            fullPageSelector.fullpage({
                navigation: true,
                paddingTop: '0px',
                paddingBottom: '0px',
                lockAnchors: false,
                sectionSelector: '.section',
                afterLoad: function() {
                    const activeSection = $('.fp-section.active'),
                        mode = activeSection.data('skin') === 'dark' ? 'is-sticky' : ' ';

                    header.removeClass('is-sticky').addClass(mode);
                    footer.removeClass('light dark').addClass(activeSection.data('skin'));
                    $("#fp-nav").removeClass('light dark').addClass(activeSection.data('skin'));
                }
            });
        }

        /*-------------------------
          13. Contact Map JS
        -----------------------------*/
        const map_id = $('#map');
        if (map_id.length > 0) {
            const $lat = map_id.data('lat'),
                $lng = map_id.data('lng'),
                $zoom = map_id.data('zoom'),
                $maptitle = map_id.data('maptitle'),
                $mapaddress = map_id.data('mapaddress'),
                mymap = L.map('map').setView([$lat, $lng], $zoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map',
                maxZoom: 14,
                minZoom: 2,
                id: 'mapbox.streets',
                scrollWheelZoom: false,
                accessToken: 'sk.eyJ1IjoicmFqdWh0IiwiYSI6ImNqdHk5dGdpYzJqM3A0NGxsYmI3NmhnN3EifQ.kNdHkgfVGmSz6XPmmfG02A'
            }).addTo(mymap);

            const marker = L.marker([$lat, $lng]).addTo(mymap);
            mymap.zoomControl.setPosition('bottomright');
            mymap.scrollWheelZoom.disable();
        }

        /*---------------------
          14. Parallax JS
        ----------------------*/
        $('.parallax').jarallax({
            speed: 0.2
        });

        /*------------------------------
            15. Ajax Contact Form JS
        --------------------------------*/
        const form = $('#contact-form');
        const formNotification = $('.form-notification');

        $(form).submit(function(e) {
            e.preventDefault();
            const formData = form.serialize();
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData
            }).done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                $(formNotification).removeClass('alert alert-danger mt-3 mb-0');
                $(formNotification).addClass('alert alert-success fade show mt-3 mb-0');

                // Set the message text.
                formNotification.html("<button type='button' class='close' data-dismiss='alert'>&times;</button>");
                formNotification.append(response);

                // Clear the form.
                $('#contact-form input,#contact-form textarea').val('');
            }).fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(formNotification).removeClass('alert alert-success mt-3 mb-0');
                $(formNotification).addClass('alert alert-danger fade show mt-3 mb-0');

                // Set the message text.
                if (data.responseText !== '') {
                    formNotification.html("<button type='button' class='close' data-dismiss='alert'>&times;</button>");
                    formNotification.append(data.responseText);
                } else {
                    $(formNotification).text('Oops! An error occurred and your message could not be sent.');
                }
            });
        });

        /*------------------------------
            16. MultiScroll JS
        --------------------------------*/
        const splitWrapper = $('#multiscroll');
        if (splitWrapper.length) {
            splitWrapper.multiscroll({
                css3: true,
                navigation: true,
                loopBottom: true,
                loopTop: true,
                navigationPosition: 'left',
                afterRender: function() {
                    const header = $('.header').outerHeight();
                    $(".service-split-wrapper").css('height', 'calc(100vh - ' + header + 'px)');
                    $('.service-split-content').css('margin-top', '-' + header + '+px');
                }
            });
        }

        /*------------------------------
            17. Nice Select JS
        --------------------------------*/
        $('select').niceSelect();

        /*------------------------------
            18. Scroll Top JS
        --------------------------------*/
        $(".btn-scroll-top").on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 1500);
        });

        /*------------------------------------
          18. Product Quantity JS
        -------------------------------------*/

        var proQty = $(".pro-qty");
        proQty.append('<a href="#" class="inc qty-btn">+</a>');
        proQty.append('<a href="#" class= "dec qty-btn">-</a>');
        $('.qty-btn').on('click', function(e) {
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });

        /*--------------------------------------
          19. Checkout Page Checkbox Accordion
        ----------------------------------------*/
        $("#create_pwd").on("change", function() {
            $(".account-create").slideToggle("100");
        });

        $("#ship_to_different").on("change", function() {
            $(".ship-to-different").slideToggle("100");
        });

        /*-------------------------
          20. Countdown JS
        -----------------------------*/
        $(".ht-countdown").each(function(index, element) {
            let $element = $(element),
                $date = $element.data('date');

            $element.countdown($date, function(event) {
                let $this = $(this).html(event.strftime('' +
                    '<div class="countdown-item"><span class="countdown-item__time">%D</span><span class="countdown-item__label">Days</span></div>' +
                    '<div class="countdown-item"><span class="countdown-item__time">%H</span><span class="countdown-item__label">Hours</span></div>' +
                    '<div class="countdown-item"><span class="countdown-item__time">%M</span><span class="countdown-item__label">Minutes</span></div>' +
                    '<div class="countdown-item"><span class="countdown-item__time">%S</span><span class="countdown-item__label">Seconds</span></div>'));
            });
        });


        /*---------------------------------------
           All Slick Slider Activation JS
        -----------------------------------------*/

        // Home Agency Portfolio Testimonial
        const testSlider = $(".testimonial-slider"),
            testSliderThumb = $('.testimonial-thumb');

        testSlider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            fade: false,
            asNavFor: '.slider-nav'
        });

        testSliderThumb.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false
        });

        // Brand Logo Carousel Slider JS
        const brandCarousel = $(".brand-logo-content");

        brandCarousel.slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            dots: false,
            fade: false,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                }
            ]
        });

        // Product Carousel Slider JS
        const proCarousel = $(".product-carousel");
        proCarousel.slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: true,
            nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
            prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
            dots: false,
            fade: false,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 501,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // Multipurpose Home Portfolio Carousel JS
        const proMultiCarousel = $(".portfolio-multipurpose-carousel");
        proMultiCarousel.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: false,
            nextArrow: '<button class="slick-next"><i class="icon-arrows-right"></i></button>',
            prevArrow: '<button class="slick-prev"><i class="icon-arrows-left"></i></button>',
            dots: true,
            fade: false
        });

        // Home Multipurpose Testimonial JS
        const multiTestSlider = $(".multipurpose-testimonial-slider");
        multiTestSlider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            fade: false
        });


        // Home Marketing Agency Case Study JS
        const caseStudyCarousel = $(".case-study-carousel");
        caseStudyCarousel.slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            dots: true,
            fade: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 501,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // Home Side Menu Service JS
        const serviceCarousel = $(".service-carousel");
        serviceCarousel.slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            dots: false,
            fade: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 501,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // Portfolio Details Slider JS
        const portDetailsThumb = $(".portfolio-details-thumb--slider");
        portDetailsThumb.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true
        });

        // Element Image Carousel
        const elementCarousel = $(".element-carousel");
        elementCarousel.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<button class="slick-next"><i class="icon-arrows-right"></i></button>',
            prevArrow: '<button class="slick-prev"><i class="icon-arrows-left"></i></button>',
            dots: true
        });

        // Home Multipurpose Slider JS
        const homeMultipurpose = $(".slider-activation");
        homeMultipurpose.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<button class="slick-next"><i class="icon-arrows-right"></i></button>',
            prevArrow: '<button class="slick-prev"><i class="icon-arrows-left"></i></button>',
            dots: true,
            customPaging: function(slider, i) {
                return (i + 1) + '/' + slider.slideCount;
            }
        });

    }); //End Ready Function

    jQuery(window).on('scroll', function() {
        //Scroll top Hide Show
        if ($(window).scrollTop() >= 400) {
            $('.btn-scroll-top').addClass('show');
        } else {
            $('.btn-scroll-top').removeClass('show');
        }
    }); // End Scroll Function

    jQuery(window).on('load', function() {
        // Masonry Grid JS
        $(".masonry-grid").isotope();

        /*-------------------------
          Portfolio Filter JS
        --------------------------*/
        const activeId = $(".filter-menu li");
        $(".filter-content").isotope();
        activeId.on('click', function() {
            const $this = $(this),
                filterValue = $this.data('filter');

            $(".filter-content").isotope({
                filter: filterValue
            });

            activeId.removeClass('active');
            $this.addClass('active');
        });

        // Remove Preloader Active Class
        $('body').removeClass('preloader-active');
    }); // End Load Function
}(jQuery));