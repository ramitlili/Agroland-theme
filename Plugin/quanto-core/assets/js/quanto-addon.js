(function ($) {
    'use strict';

    /* ---------------------------------------------

    -- Service Slider

    --------------------------------------------- */
    /* is_exist() */
    jQuery.fn.is_exist = function () {
        return this.length;
    };

    $(window).load(function () {});

    // QuantoGlobal js
    var QuantoGlobal = function ($scope) {

        $(document).ready(function () {
            // Set default GSAP configuration
            gsap.defaults({
                ease: "power2.out",
                duration: 0.5,
            });
            
            // Get all target boxes and create overlays
            $('.active-overly, .process-box').each(function () {
                var $box = $(this);
                var $overlay = $('<div class="hover-overlay"></div>');
                $box.prepend($overlay);
                // Initial setup - hide the overlay
                gsap.set($overlay, {
                    autoAlpha: 0,
                    y: 0,
                    x: 0,
                });
                var getDirection = function ($box, event) {
                    var rect = $box[0].getBoundingClientRect();
                    var mouseX = event.clientX - rect.left;
                    var mouseY = event.clientY - rect.top;
                    var centerX = rect.width / 2;
                    var centerY = rect.height / 2;
                    var relativeX = mouseX - centerX;
                    var relativeY = mouseY - centerY;
                    var angle = Math.atan2(relativeY, relativeX);
                    var degrees = angle * (180 / Math.PI);
                    if (degrees >= -45 && degrees <= 45) return "right";
                    if (degrees > 45 && degrees <= 135) return "bottom";
                    if (degrees > 135 || degrees <= -135) return "left";
                    return "top";
                };
                var getAnimationProps = function (direction, isEntering) {
                    var animProps = {
                        autoAlpha: isEntering ? 1 : 0,
                        x: 0,
                        y: 0,
                    };
                    var distance = 100;
                    switch (direction) {
                        case "right":
                            animProps[isEntering ? "startX" : "x"] = distance + "%";
                            break;
                        case "left":
                            animProps[isEntering ? "startX" : "x"] = -distance + "%";
                            break;
                        case "bottom":
                            animProps[isEntering ? "startY" : "y"] = distance + "%";
                            break;
                        case "top":
                            animProps[isEntering ? "startY" : "y"] = -distance + "%";
                            break;
                    }
                    return animProps;
                };
                $box.on("mouseenter", function (e) {
                    var direction = getDirection($box, e);
                    var animProps = getAnimationProps(direction, true);
                    gsap.fromTo(
                        $overlay,
                        {
                            autoAlpha: 0,
                            x: animProps.startX || 0,
                            y: animProps.startY || 0,
                        },
                        {
                            duration: 0.5,
                            autoAlpha: 1,
                            x: 0,
                            y: 0,
                            ease: "power2.out",
                        }
                    );
                });
                $box.on("mouseleave", function (e) {
                    var direction = getDirection($box, e);
                    var animProps = getAnimationProps(direction, false);
                    gsap.to($overlay, {
                        duration: 0.5,
                        ...animProps,
                        ease: "power2.in",
                    });
                });
            });
            
        }); 


        // Apply no-border class to submenu links
        document.querySelectorAll(".sub-menu li.menu-item-has-children > a").forEach(function (menuItem) {
            menuItem.classList.add("no-border");
        });

        // Odometer Counter
        $(".counter-item").each(function () {
            var $counterItem = $(this);
            $counterItem.isInViewport(function (status) {
                if (status === "entered") {
                    $counterItem.find(".odometer").each(function () {
                    var el = this;
                    el.innerHTML = el.getAttribute("data-odometer-final");
                    });
                }
            });
        });

    };

    
    // ========================== Animi Global JS =========================== //
    var QuantoAnimi = function ($scope) {
        // fade anim
        let $fadeArrayItems = $scope.find(".fade-anim");
        
        if ($fadeArrayItems.length > 0) {
            $fadeArrayItems.each(function () { 
                let $item = $(this);
                let fadeDirection = $item.attr("data-direction") || "bottom";
                let onscrollValue = parseInt($item.attr("data-on-scroll")) || 1;
                let durationValue = parseFloat($item.attr("data-duration")) || 1.15;
                let fadeOffset = parseFloat($item.attr("data-offset")) || 50;
                let delayValue = parseFloat($item.attr("data-delay")) || 0.15;
                let easeValue = $item.attr("data-ease") || "power2.out";
    
                let animationSettings = {
                    opacity: 0,
                    ease: easeValue,
                    duration: durationValue,
                    delay: delayValue,
                };
    
                if (fadeDirection === "top") animationSettings["y"] = -fadeOffset;
                else if (fadeDirection === "left") animationSettings["x"] = -fadeOffset;
                else if (fadeDirection === "bottom") animationSettings["y"] = fadeOffset;
                else if (fadeDirection === "right") animationSettings["x"] = fadeOffset;
    
                if (onscrollValue === 1) {
                    animationSettings["scrollTrigger"] = {
                        trigger: $item[0],
                        start: "top 85%",
                    };
                }
                gsap.from($item[0], animationSettings);
            });
        }

        // move anim
        let text_animation = $scope.find('.move-anim');

        if (text_animation.length) {
            text_animation.each(function () {
                var splitTextLine = $(this);
                var delay_value = 0.1;

                if (splitTextLine.data('delay')) {
                    delay_value = splitTextLine.data('delay');
                }

                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: splitTextLine[0],
                        start: 'top 85%',
                        duration: 1.3,
                        scrub: false,
                        markers: false,
                        toggleActions: 'play none none none',
                    },
                });

                const itemSplitted = new SplitText(splitTextLine[0], {
                    type: 'lines',
                });

                gsap.set(splitTextLine[0], {
                    perspective: 400,
                });

                itemSplitted.split({
                    type: 'lines',
                });

                tl.from(itemSplitted.lines, {
                    duration: 1,
                    delay: delay_value,
                    opacity: 0,
                    rotationX: -80,
                    force3D: true,
                    transformOrigin: 'top center -50',
                    stagger: 0.1,
                });
            });
        }
    }


    // Mobile Js
    var Mobile_Menu_js = function ($scope) {
        $.fn.vsmobilemenu = function (options) {
            var opt = $.extend({
                menuToggleBtn: ".quanto-menu-toggle",
                bodyToggleClass: "quanto-body-visible",
                subMenuClass: "quanto-submenu",
                subMenuParent: "quanto-item-has-children",
                subMenuParentToggle: "quanto-active",
                meanExpandClass: "quanto-mean-expand",
                appendElement: '<span class="quanto-mean-expand"></span>',
                subMenuToggleClass: "quanto-open",
                toggleSpeed: 400,
              },
              options
            );
        
            return this.each(function () {
                var menu = $(this); // Select menu
        
                // Menu Show & Hide
                function menuToggle() {
                    menu.toggleClass(opt.bodyToggleClass);
            
                    // collapse submenu on menu hide or show
                    var subMenu = "." + opt.subMenuClass;
                    $(subMenu).each(function () {
                    if ($(this).hasClass(opt.subMenuToggleClass)) {
                        $(this).removeClass(opt.subMenuToggleClass);
                        $(this).css("display", "none");
                        $(this).parent().removeClass(opt.subMenuParentToggle);
                    }
                    });
                }
        
                // Class Set Up for every submenu
                menu.find("li").each(function () {
                    var submenu = $(this).find("ul");
                    submenu.addClass(opt.subMenuClass);
                    submenu.css("display", "none");
                    submenu.parent().addClass(opt.subMenuParent);
                    submenu.prev("a").append(opt.appendElement);
                    submenu.next("a").append(opt.appendElement);
                });

                function toggleDropDown($element) {
                    var $submenu = $element.next("ul");

                    if ($submenu.length === 0) {
                        $submenu = $element.prev("ul"); // Fallback if .mean-expand is after the link
                    }

                    if ($submenu.length > 0) {
                        var $parent = $element.parent();
                        var $siblings = $parent.siblings();

                        // Close only sibling submenus
                        $siblings.find("ul." + opt.subMenuClass).slideUp(opt.toggleSpeed).removeClass(opt.subMenuToggleClass);
                        $siblings.removeClass(opt.subMenuParentToggle);

                        // Toggle current submenu
                        $parent.toggleClass(opt.subMenuParentToggle);
                        $submenu.slideToggle(opt.toggleSpeed).toggleClass(opt.subMenuToggleClass);
                    }
                }

        
                // Submenu toggle Button
                menu.find("." + opt.meanExpandClass).each(function () {
                    $(this).on("click", function (e) {
                        e.preventDefault();
                        toggleDropDown($(this).parent());
                    });
                });

                // Menu Show & Hide On Toggle Btn click
                $(opt.menuToggleBtn).each(function () {
                    $(this).on("click", function () {
                    menuToggle();
                    });
                });

                // Hide Menu On out side click
                menu.on("click", function (e) {
                    e.stopPropagation();
                    menuToggle();
                });
            
                // Stop Hide full menu on menu click
                menu.find("div").on("click", function (e) {
                    e.stopPropagation();
                });
            });
        };
        $(".quanto-menu-wrapper").vsmobilemenu();

    };



    // Hero Js
    var Hero_js = function ($scope) {
        function animateBackground() {
            if (document.querySelector('.hero5-bg')) {
                gsap.set('.hero5-bg', { top: '-300px', scale: 0.5 });
                gsap.to('.hero5-bg', {
                    duration: 2,
                    top: '0px',
                    scale: 1,
                    ease: 'power2.out',
                    delay: 0.6
                });
            }
        }
        animateBackground();

        // Animation Word
        let animation_word_anim_items = document.querySelectorAll('.word-anim');

        animation_word_anim_items.forEach((word_anim_item) => {
            var stagger_value = 0.04;
            var translateX_value = false;
            var translateY_value = false;
            var onscroll_value = 1;
            var data_delay = 0.1;
            var data_duration = 0.75;

            if (word_anim_item.getAttribute('data-stagger')) {
                stagger_value = word_anim_item.getAttribute('data-stagger');
            }
            if (word_anim_item.getAttribute('data-translateX')) {
                translateX_value = word_anim_item.getAttribute('data-translateX');
            }

            if (word_anim_item.getAttribute('data-translateY')) {
                translateY_value = word_anim_item.getAttribute('data-translateY');
            }

            if (word_anim_item.getAttribute('data-on-scroll')) {
                onscroll_value = word_anim_item.getAttribute('data-on-scroll');
            }
            if (word_anim_item.getAttribute('data-delay')) {
                data_delay = word_anim_item.getAttribute('data-delay');
            }
            if (word_anim_item.getAttribute('data-duration')) {
                data_duration = word_anim_item.getAttribute('data-duration');
            }

            if (onscroll_value == 1) {
                if (translateX_value && !translateY_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: data_duration,
                        x: translateX_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                        delay: data_delay,
                        scrollTrigger: {
                            trigger: word_anim_item,
                            start: 'top 90%',
                        },
                    });
                }

                if (translateY_value && !translateX_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        y: translateY_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                        scrollTrigger: {
                            trigger: word_anim_item,
                            start: 'top 90%',
                        },
                    });
                }

                if (translateY_value && translateX_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        x: translateX_value,
                        y: translateY_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                        scrollTrigger: {
                            trigger: word_anim_item,
                            start: 'top 90%',
                        },
                    });
                }

                if (!translateX_value && !translateY_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        x: 20,
                        autoAlpha: 0,
                        stagger: stagger_value,
                        scrollTrigger: {
                            trigger: word_anim_item,
                            start: 'top 85%',
                        },
                    });
                }
            } else {
                if (translateX_value > 0 && !translateY_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        x: translateX_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                    });
                }

                if (translateY_value > 0 && !translateX_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        y: translateY_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                    });
                }

                if (translateY_value > 0 && translateX_value > 0) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        x: translateX_value,
                        y: translateY_value,
                        autoAlpha: 0,
                        stagger: stagger_value,
                    });
                }

                if (!translateX_value && !translateY_value) {
                    let split_word = new SplitText(word_anim_item, {
                        type: 'chars, words',
                    });
                    gsap.from(split_word.words, {
                        duration: 1,
                        delay: data_delay,
                        x: 20,
                        autoAlpha: 0,
                        stagger: stagger_value,
                    });
                }
            }
        });
    };


    // Project_Slider Js
    var Project_Slider_js = function ($scope) {
        let device_width = window.innerWidth;
        let horizontalSection = document.querySelector(".horizontal-scroll");
        if (device_width > 1199 && horizontalSection) {
            gsap.to(horizontalSection, {
                x: () => horizontalSection.scrollWidth * -1,
                xPercent: 100,
                scrollTrigger: {
                    trigger: horizontalSection,
                    start: "center center",
                    end: "+=3000px",
                    pin: horizontalSection,
                    scrub: true,
                    invalidateOnRefresh: true,
                },
            });
        }

        // Project Slider Two
        const quantoProjectSlider = document.querySelector(".quanto-project__slider");
        const quantoProjectSliderNavigation = document.querySelector(
            ".quanto-project__slider-navigation"
        );

        if (quantoProjectSlider && quantoProjectSliderNavigation) {
            var swiper = new Swiper(quantoProjectSlider, {
                slidesPerView: 1,
                loop: true,
                spaceBetween: 15,
                navigation: {
                    nextEl: quantoProjectSliderNavigation.querySelector(".next-btn"),
                    prevEl: quantoProjectSliderNavigation.querySelector(".prev-btn"),
                },
                breakpoints: {
                    576: {
                    spaceBetween: 20,
                    slidesPerView: 1.3,
                    },
                    768: {
                    spaceBetween: 25,
                    slidesPerView: 1.5,
                    },
                    992: {
                    spaceBetween: 30,
                    slidesPerView: 2,
                    },
                    1200: {
                    spaceBetween: 40,
                    slidesPerView: 2.3,
                    },
                },
            });
        }

        // Image Reveal Animation
        let tp_img_reveal = $scope[0].querySelectorAll('.img_reveal');

        tp_img_reveal.forEach((image) => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: image,
                    start: 'top 70%',
                },
            });

            tl.set(image, { autoAlpha: 1 });
            tl.from(image, 1, {
                xPercent: -100,
                ease: Power2.out,
            });
            tl.from(image, 1.5, {
                xPercent: 100,
                scale: 1.5,
                delay: -1.5,
                ease: Power2.out,
            });
        });
    };


    // Animation Title js
    var Animation_Title_js = function ($scope) {
        // Select the target element within this widget's scope
        const target = $scope.find(".text_invert");

        if (!target.length) return;

        // Create the SplitText instance
        const splitt = new SplitText(target, { type: "lines" });

        // Set initial styles for the lines
        gsap.set(splitt.lines, {
            color: "#ddd",
            overflow: "hidden",
        });

        // Animate each line on scroll
        splitt.lines.forEach((line) => {
            gsap.to(line, {
                color: "#000000",
                duration: 1,
                ease: "power2.out",
                backgroundPositionX: 0,
                scrollTrigger: {
                    trigger: line,
                    scrub: true,
                    start: "top 55%",
                    end: "bottom center",
                },
            });
        });
    };


    // Scroll Video js
    var Scroll_Video_js = function ($scope) {
        const $video = $("#quanto-video-2");
        const $playBtn = $(".play-btn");
        if ($video.length && $playBtn.length) {
            $video[0].pause();
            $playBtn.on("click", function () {
                $video[0].play();
                $playBtn.addClass("disabled");
                $video.addClass("pointer");
            });
            $video.on("click", function () {
                if ($playBtn.hasClass("disabled")) {
                $video[0].pause();
                $playBtn.removeClass("disabled");
                $video.removeClass("pointer");
                }
            });
        };
    };

    // Project Js
    var Project_js = function ($scope) {
        // Image Reveal Animation
        let tp_img_reveal = $scope[0].querySelectorAll('.img_reveal');

        tp_img_reveal.forEach((image) => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: image,
                    start: 'top 70%',
                },
            });

            tl.set(image, { autoAlpha: 1 });
            tl.from(image, 1, {
                xPercent: -100,
                ease: Power2.out,
            });
            tl.from(image, 1.5, {
                xPercent: 100,
                scale: 1.5,
                delay: -1.5,
                ease: Power2.out,
            });
        });
    };

    
    // Animation Image Js
    var Animation_Image_Js = function ($scope) {
        let tp_img_reveal = $scope[0].querySelectorAll('.img_reveal');

        tp_img_reveal.forEach((image) => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: image,
                    start: 'top 70%',
                },
            });

            tl.set(image, { autoAlpha: 1 });
            tl.from(image, 1, {
                xPercent: -100,
                ease: Power2.out,
            });
            tl.from(image, 1.5, {
                xPercent: 100,
                scale: 1.5,
                delay: -1.5,
                ease: Power2.out,
            });
        });
    };

    var QuantoTestimonial = function () {
        $(document).ready(function () {
            // ========================== Testimonial3 Slider ===========================
            const $testimonial3Element = $('.testimonial3-slider');
            const $testimonial3NextButton = $('.testimonial3-navigation > .next-btn');
            const $testimonial3PrevButton = $('.testimonial3-navigation > .prev-btn');

            if ($testimonial3Element.length && $testimonial3NextButton.length && $testimonial3PrevButton.length) {
                const testimonial3Slider = new Swiper($testimonial3Element[0], {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: $testimonial3NextButton[0],
                        prevEl: $testimonial3PrevButton[0],
                    },
                    loop: true,
                });
            }

            // ========================== Testimonial2 Slider ===========================
            const $testimonial2Element = $('.quanto-testimonial2__slider');

            if ($testimonial2Element.length) {
                const testimonial2Slider = new Swiper($testimonial2Element[0], {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 10,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 25,
                        },
                        1200: {
                            spaceBetween: 30,
                            slidesPerView: 2,
                        },
                        1400: {
                            spaceBetween: 40,
                            slidesPerView: 2.5,
                        },
                    },
                });
            }
        });
    };

    // ========================== Video Box =========================== //
    var QuantoVideo = function () {
        const $video = $("#quanto-video-2");
        const $playBtn = $(".play-btn");
        if ($video.length && $playBtn.length) {
            $video[0].pause();
            $playBtn.on("click", function () {
                $video[0].play();
                $playBtn.addClass("disabled");
                $video.addClass("pointer");
            });
            $video.on("click", function () {
                if ($playBtn.hasClass("disabled")) {
                $video[0].pause();
                $playBtn.removeClass("disabled");
                $video.removeClass("pointer");
                }
            });
        };

        // Hero Video Animation (jQuery)
        const $heroThumb = $(".quanto-hero__thumb");
        if ($heroThumb.length) {
            let mm = gsap.matchMedia();
                mm.add("(min-width: 768px)", () => {
                const $videoWrapper = $heroThumb.find(".video-wrapper");
                if ($videoWrapper.length) {
                let tp_hero = gsap.timeline({
                    scrollTrigger: {
                    trigger: $heroThumb[0],
                    start: "top 70",
                    pin: true,
                    markers: false,
                    scrub: 1,
                    pinSpacing: true,
                    end: "bottom top",
                    },
                });
                tp_hero.to($videoWrapper[0], {
                    width: "100%",
                    duration: 1.5,
                    ease: "power2.inOut",
                });
                return () => {
                    tp_hero.kill();
                };
                }
            });
        }
    };

    // ================= Process Slider ================== //
    var QuantoProcess = function () {
        let $horizontalSection = $(".horizontal-scroll");
        if ($(window).width() > 1199 && $horizontalSection.length) {
        gsap.to($horizontalSection, {
            x: function () {
            return -$horizontalSection[0].scrollWidth;
            },
            xPercent: 100,
            scrollTrigger: {
            trigger: $horizontalSection[0],
            start: "center center",
            end: "+=1875px",
            pin: $horizontalSection[0],
            scrub: true,
            invalidateOnRefresh: true,
            },
        });
        }
    };


    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/global", QuantoGlobal);
        elementorFrontend.hooks.addAction("frontend/element_ready/widget", QuantoAnimi);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_menu.default', Mobile_Menu_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_hero.default', Hero_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_project_slider.default', Project_Slider_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_animation_title.default', Animation_Title_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_scroll_down.default', Scroll_Video_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_project.default', Project_js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_animation_image.default', Animation_Image_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_testimonial.default', QuantoTestimonial);
        elementorFrontend.hooks.addAction('frontend/element_ready/video_box.default', QuantoVideo);
        elementorFrontend.hooks.addAction('frontend/element_ready/quanto_process.default', QuantoProcess);

    });
})(jQuery);
