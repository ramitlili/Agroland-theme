function _typeof(e) {
    return (
        (_typeof =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                ? function (e) {
                      return typeof e;
                  }
                : function (e) {
                      return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e;
                  }),
        _typeof(e)
    );
}
!(function (e) {

    var t = e("#wpadminbar").height();
    (e.fn.mas_tilt = function (t) {
        var n = this;
        (this.settings = e.extend({ maxTilt: 20, perspective: 1e3, easing: "cubic-bezier(.03,.98,.52,.99)", scale: 1, speed: 3e3, reset: !0 }, t)),
            e(this).css({ transition: "all ".concat(this.settings.speed, "ms ").concat(this.settings.easing) }),
            e(this).each(function (t, i) {
                e(i).mousemove(function (t) {
                    var o = window.innerWidth / 2,
                        r = window.innerHeight / 2,
                        s = t.clientX - o,
                        a = ((t.clientY - r) / r) * n.settings.maxTilt,
                        l = (-s / o) * n.settings.maxTilt;
                    e(i).css({
                        transform: "perspective("
                            .concat(n.settings.perspective, "px) rotateX(")
                            .concat(a, "deg) rotateY(")
                            .concat(l, "deg) scale3d(")
                            .concat(n.settings.scale, ",")
                            .concat(n.settings.scale, ",")
                            .concat(n.settings.scale, ")"),
                    });
                }),
                    n.settings.reset &&
                        e(i).mouseleave(function (t) {
                            e(i).css({ transform: "" });
                        });
            });
    }),
   
    e(window).on("elementor/frontend/init", function () {
    
        e(window).width();

        var t = elementorFrontend.config.responsive.activeBreakpoints,
            n = elementorModules.frontend.handlers.Base;

            if ("object" === ("undefined" == typeof gsap ? "undefined" : _typeof(gsap))) {
                var i = gsap.matchMedia(),
                    r = n.extend({
                        bindEvents: function () {
                            this.run();
                        },
                        run: function () {
                            
                            if (this.getElementSettings("mas_enable_hover_image")) {
                                if (this.isEdit && !this.getElementSettings("mas_enable_hover_image_editor")) return;
                                var t = e(this.$element);
                                0 === t.find(".mas-image-hover").length && t.append('<div class="mas-image-hover"></div>');
                                setTimeout(function () {
                                    var n = e(t.find(".mas-image-hover"));
                                    e(t).mouseenter(function () {
                                        gsap.to(n, { delay: 0, duration: 0, autoAlpha: 1 });
                                    });
                                    e(t).mouseleave(function () {
                                        gsap.to(n, { delay: 0, duration: 0, autoAlpha: 0 });
                                    });
                                    e(t).mousemove(function (e) {
                                        var i = t[0].getBoundingClientRect(),
                                            o = e.clientX - i.x,
                                            r = e.clientY - i.y;
                                        gsap.set(n, { delay: 0, duration: 0, x: o, y: r });
                                    });
                                }, 100);
                            }
                        },
                    }),
                    s = n.extend({
                        bindEvents: function () {
                            this.run();
                        },
                        run: function () {
                            if (this.getElementSettings("mas_enable_cursor_hover_effect")) {
                                var t = this.getID(),
                                    n = this.getElementSettings("mas_enable_cursor_hover_effect_text"),
                                    i = e(".mas-hover-cursor-effect.active-".concat(t));
                                if (this.isEdit && !this.getElementSettings("mas_enable_cursor_hover_effect_editor")) return void i.css({ display: "none" });
                                i.css({ display: "flex" });
                                if (!e(".mas-hover-cursor-effect.active-".concat(t)).length) {
                                    e("body").prepend('<div class="mas-hover-cursor-effect active-'.concat(t, '"></div>'));
                                }
                                i = e(".mas-hover-cursor-effect.active-".concat(t));
                                var o = e(this.$element);
                                "mas--a-portfolio" === this.getWidgetType() && (o = e(this.findElement("article")));
                                gsap.set(i, { xPercent: -50, yPercent: -50, scale: 0 });
                                var r = gsap.quickTo(i, "x", { duration: 0.6, ease: "expo" }),
                                    s = gsap.quickTo(i, "y", { duration: 0.6, ease: "expo" }),
                                    a = gsap.timeline({ paused: !0 });
                                a.to(i, { scale: 1, opacity: 1, duration: 0.5, ease: "expo.inOut" });
                                e(document).mousemove(function (e) {
                                    r(e.clientX);
                                    s(e.clientY);
                                });
                                e(o).mouseenter(function () {
                                    a.play();
                                    i.html(n);
                                });
                                e(o).mouseleave(function () {
                                    a.reverse();
                                });
                            }
                        },
                    });
            elementorFrontend.hooks.addAction("frontend/element_ready/container", function (e) {
                elementorFrontend.elementsHandler.addHandler(r, { $element: e });
                elementorFrontend.elementsHandler.addHandler(s, { $element: e });
            });
        }

        var y = n.extend({
            run: function () {
                if ("yes" === this.getElementSettings("mas_enable_tilt")) {
                    var e = {},
                        t = this.getElementSettings("mas_max_tilt"),
                        n = this.getElementSettings("mas_tilt_perspective"),
                        i = this.getElementSettings("mas_tilt_scale"),
                        o = this.getElementSettings("mas_tilt_speed");
                    t && (e.maxTilt = t), t && (e.perspective = n), t && (e.scale = i), t && (e.speed = o), this.$element.mas_tilt(e);
                }
            },
            bindEvents: function () {
                this.run();
            },
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/widget", function (e) {
            elementorFrontend.elementsHandler.addHandler(y, { $element: e });
        }),
            elementorFrontend.hooks.addAction("frontend/element_ready/container", function (e) {
                elementorFrontend.elementsHandler.addHandler(y, { $element: e });
            });

    });
    
})(jQuery);



// animation effect
!(function (t) {
    t(window).on("elementor/frontend/init", function () {
        // gsap.registerPlugin(ScrollTrigger);
        var e = t(window).width(),
            n = elementorFrontend.config.responsive.activeBreakpoints,
            i = elementorModules.frontend.handlers.Base,
            o = 1.35,
            s = !1;
           console.log(MAS_ADDONS_JS.smoothScroller);
            if (
                (null !== MAS_ADDONS_JS.smoothScroller && ((o = MAS_ADDONS_JS.smoothScroller.smooth), (s = "on" === MAS_ADDONS_JS.smoothScroller.mobile)),
                "function" == typeof ScrollSmoother && "object" === ("undefined" == typeof gsap ? "undefined" : _typeof(gsap)))
            ) {
                var a = gsap.matchMedia();
                if (s) ScrollSmoother.create({ smooth: o, effects: !0, smoothTouch: 0.1, normalizeScroll: !1, ignoreMobileResize: !0 });
                else
                    a.add("(min-width: 768px)", function () {
                        ScrollSmoother.create({ smooth: o, effects: !0, smoothTouch: 0.1, normalizeScroll: !1, ignoreMobileResize: !0 });
                    });
            }
        if ("object" === ("undefined" == typeof gsap ? "undefined" : _typeof(gsap))) {
            var r = gsap.matchMedia(),
                l = i.extend({
                    bindEvents: function () {
                        this.run();
                    },
                    run: function () {
                        this.fade_animation(), "widget" === this.getElementType() && (this.text_animation(),this.image_animation());
                    },
                    
                    fade_animation: function () {
                        var t = this;
                        if ("fade" === this.getElementSettings("mas-animation") && (!this.isEdit || this.getElementSettings("mas_enable_animation_editor"))) {
                            var e = this.getElementSettings("fade-from"),
                                i = this.getElementSettings("on-scroll"),
                                o = this.getElementSettings("data-duration"),
                                s = this.getElementSettings("fade-offset"),
                                a = this.getElementSettings("delay"),
                                l = this.getElementSettings("ease"),
                                c = "all";
                            if (this.getElementSettings("fade_animation_breakpoint")) {
                                var g = n[this.getElementSettings("fade_animation_breakpoint")].value;
                                c = "min" === this.getElementSettings("fade_breakpoint_min_max") ? "min-width: " + g + "px" : "max-width: " + g + "px";
                            }
                            var m = { opacity: 0, ease: l, duration: o, delay: a };
                            "top" === e && (m.y = -s),
                                "bottom" === e && (m.y = s),
                                "left" === e && (m.x = -s),
                                "right" === e && (m.x = s),
                                i && (m.scrollTrigger = { trigger: this.$element, start: "top 85%" }),
                                this.$element.css("transition", "none"),
                                "all" === c
                                    ? gsap.from(this.$element, m)
                                    : r.add("(".concat(c, ")"), function () {
                                          return gsap.from(t.$element, m), function () {};
                                      });
                        }
                    },
                    image_animation: function () {
                       
                        if ("scale" === this.getElementSettings("mas-image-animation")) {
                            var a = this.findElement("img"),
                                r = this.getElementSettings("mas-animation-start");
                            "custom" === this.getElementSettings("mas-animation-start") && (r = this.getElementSettings("mas_animation_custom_start")),
                                gsap.set(a, { scale: this.getElementSettings("mas-scale-start") }),
                                gsap.to(a, { scrollTrigger: { trigger: this.$element, start: r, scrub: !0 }, scale: this.getElementSettings("mas-scale-end"), ease: this.getElementSettings("image-ease") }),
                                a.parent().css("overflow", "hidden");
                        }
                        if ("stretch" === this.getElementSettings("mas-image-animation")) {
                            var l = this.findElement("img"),
                                c = this.findElement("img").parent();
                            c.css("padding-bottom", "395px"),
                                gsap.timeline({ scrollTrigger: { trigger: c, start: "top top", pin: !0, scrub: 1, pinSpacing: !1, end: "bottom bottom+=100" } }).to(l, { width: "100%", borderRadius: "0px" }),
                                c.css("transition", "none");
                        }
                    },
                    text_animation: function () {
                        var e = "all";
                        if (this.getElementSettings("text_animation_breakpoint")) {
                            var i = n[this.getElementSettings("text_animation_breakpoint")].value;
                            e = "min" === this.getElementSettings("text_breakpoint_min_max") ? "min-width: " + i + "px" : "max-width: " + i + "px";
                        }
                        if ("char" === this.getElementSettings("mas_text_animation") || "word" === this.getElementSettings("mas_text_animation")) {
                            var o = this.getElementSettings("text_duration"),
                                s = this.getElementSettings("text_stagger"),
                                a = this.getElementSettings("text_translate_x"),
                                l = this.getElementSettings("text_translate_y"),
                                c = this.getElementSettings("text_on_scroll"),
                                g = this.getElementSettings("text_delay"),
                                m = this.findElement(".elementor-widget-container").children().length,
                                d = t(this.findElement(".elementor-widget-container").children()[m - 1]),
                                f = { duration: o, autoAlpha: 0, delay: g, stagger: s };
                            a && (f.x = a), l && (f.y = l), c && (f.scrollTrigger = { trigger: d, start: "top 90%" });
                            var h = new SplitText(d, { type: "chars, words" }),
                                p = h.chars;
                            "word" === this.getElementSettings("mas_text_animation") && (p = h.words),
                                "all" === e
                                    ? gsap.from(p, f)
                                    : r.add("(".concat(e, ")"), function () {
                                          return (
                                              gsap.from(p, f),
                                              function () {
                                                  p.revert();
                                              }
                                          );
                                      });
                        }
                        if ("text_move" === this.getElementSettings("mas_text_animation")) {
                            var u = this.getElementSettings("text_duration"),
                                _ = this.getElementSettings("text_delay"),
                                S = this.getElementSettings("text_stagger"),
                                v = this.getElementSettings("text_on_scroll"),
                                E = this.getElementSettings("text_rotation_di"),
                                w = this.getElementSettings("text_rotation"),
                                y = this.getElementSettings("text_transform_origin"),
                                x = {},
                                b = this.findElement(".elementor-widget-container").children().length,
                                k = t(this.findElement(".elementor-widget-container").children()[b - 1]);
                            k.hasClass("mas--text") && k.children().length && (k = k.children());
                            var T = { duration: u, delay: _, opacity: 0, force3D: !0, transformOrigin: y, stagger: S };
                            if (
                                ("x" === E && (T.rotationX = w),
                                "y" === E && (T.rotationY = w),
                                v && (x.scrollTrigger = { trigger: k, duration: 2, start: "top 90%", end: "bottom 60%", scrub: !1, markers: !1, toggleActions: "play none none none" }),
                                "all" === e)
                            ) {
                                var F = gsap.timeline(x),
                                    C = new SplitText(k, { type: "lines" });
                                gsap.set(k, { perspective: 400 }), C.split({ type: "lines" }), F.from(C.lines, T);
                            } else
                                r.add("(".concat(e, ")"), function () {
                                    var t = gsap.timeline(x),
                                        e = new SplitText(k, { type: "lines" });
                                    return (
                                        gsap.set(k, { perspective: 400 }),
                                        e.split({ type: "lines" }),
                                        t.from(e.lines, T),
                                        function () {
                                            e.revert(), t.revert();
                                        }
                                    );
                                });
                        }
                        if ("text_reveal" === this.getElementSettings("mas_text_animation")) {
                            var D = this.getElementSettings("text_duration"),
                                A = this.getElementSettings("text_on_scroll"),
                                $ = this.getElementSettings("text_stagger"),
                                O = this.getElementSettings("text_delay"),
                                P = this.findElement(".elementor-widget-container").children().length,
                                j = t(this.findElement(".elementor-widget-container").children()[P - 1]),
                                H = new SplitText(j, { type: "lines,words,chars", linesClass: "anim-reveal-line" }),
                                M = { duration: D, delay: O, ease: "circ.out", y: 80, stagger: $, opacity: 0 };
                            A && (M.scrollTrigger = { trigger: j, start: "top 85%" }),
                                "all" === e
                                    ? gsap.from(H.chars, M)
                                    : r.add("(".concat(e, ")"), function () {
                                          return (
                                              gsap.from(H.chars, M),
                                              function () {
                                                  H.revert();
                                              }
                                          );
                                      });
                        }
                        if ("text_invert" === this.getElementSettings("mas_text_animation")) {
                            var z = this.findElement(".elementor-widget-container").children().length,
                                J = t(this.findElement(".elementor-widget-container").children()[z - 1]),
                                N = J.css("color");
                            if (
                                ((N = (function (t, e, n) {
                                    (t /= 255), (e /= 255), (n /= 255);
                                    var i = Math.max(t, e, n),
                                        o = i - Math.min(t, e, n),
                                        s = o ? (i === t ? (e - n) / o : i === e ? 2 + (n - t) / o : 4 + (t - e) / o) : 0;
                                    return [60 * s < 0 ? 60 * s + 360 : 60 * s, 100 * (o ? (i <= 0.5 ? o / (2 * i - o) : o / (2 - (2 * i - o))) : 0), (100 * (2 * i - o)) / 2];
                                })((N = (N = N.toString()).match(/(\d+)/g))[0], N[1], N[2])),
                                (N = "".concat(N[0].toFixed(1), ", ").concat(N[1].toFixed(1), "%, ").concat(N[2].toFixed(1), "%")),
                                J.css("--text-color", N),
                                "all" === e)
                            )
                                new SplitText(J, { type: "lines", linesClass: "invert-line" }).lines.forEach(function (t) {
                                    gsap.to(t, { backgroundPositionX: 0, ease: "none", scrollTrigger: { trigger: t, scrub: 1, start: "top 85%", end: "bottom center" } });
                                });
                            else
                                r.add("(".concat(e, ")"), function () {
                                    var t = new SplitText(J, { type: "lines", linesClass: "invert-line" });
                                    return (
                                        t.lines.forEach(function (t) {
                                            gsap.to(t, { backgroundPositionX: 0, ease: "none", scrollTrigger: { trigger: t, scrub: 1, start: "top 85%", end: "bottom center" } });
                                        }),
                                        function () {
                                            t.revert();
                                        }
                                    );
                                });
                        }
                    }
                    
                });
                elementorFrontend.hooks.addAction("frontend/element_ready/widget", function (t) {
                    elementorFrontend.elementsHandler.addHandler(l, { $element: t });
                }),
                elementorFrontend.hooks.addAction("frontend/element_ready/container", function (t) {
                    elementorFrontend.elementsHandler.addHandler(l, { $element: t });
                });
           
        }

        var g = i.extend({
            bindEvents: function () {
                this.run();
            },
            run: function () {
                var e = this;
                this.getElementSettings("mas_enable_popup") &&
                    (this.isEdit && !this.getElementSettings("mas_enable_popup_editor") && t.magnificPopup.close({ items: { src: t('<div id="mas--popup" class="wcp--popup"></div>'), type: "inline" } }),
                    this.$element.on("click", function (t) {
                        t.preventDefault(), (e.isEdit && !e.getElementSettings("mas_enable_popup_editor")) || e.ajax_call();
                    }));
            },
            ajax_call: function () {
                var e = this.getElementSettings("popup_animation"),
                    n = this.getElementSettings("popup_animation_delay");
                t.ajax({
                    url: MAS_ADDONS_JS.ajaxUrl,
                    data: { 
                        action: "mas_load_popup_content", 
                        widget_id: this.getID(),
                        post_id: MAS_ADDONS_JS.post_id, 
                        nonce: MAS_ADDONS_JS._wpnonce },
                    dataType: "json",
                    type: "POST",
                    success: function (i) {
                        var o = {
                            removalDelay: n,
                            items: { src: t('<div id="mas--popup" class="wcp--popup  mfp-with-anim" >'.concat(i.html, "</div>")), type: "inline" },
                            callbacks: {
                                beforeOpen: function () {
                                    this.st.mainClass = e;
                                },
                            },
                        };
                        t.magnificPopup.open(o);
                    },
                });
            },
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/container", function (t) {
            elementorFrontend.elementsHandler.addHandler(g, { $element: t });
        });
        
    });
})(jQuery);

(function ($) {
    $(window).on("elementor/frontend/init", function () {
        var e = $(window).width(),
            n = elementorFrontend.config.responsive.activeBreakpoints,
            i = elementorModules.frontend.handlers.Base,
            o = 1.35,
            s = false;

        if (typeof gsap === "object") {
            var r = gsap.matchMedia(),
                l = i.extend({
                    bindEvents: function () {
                        this.run();
                    },
                    run: function () {
                      
                        if (this.getElementType() === "widget") {
                           
                            this.image_animation();
                        }
                    },
                    image_animation: function () {
                        if ("reveal" === this.getElementSettings("mas-image-animation")) {
                            var parentElement = this.findElement("img").parent(),
                                element = this.$element;

                            parentElement.parent().css("overflow", "hidden");
                            parentElement.css({
                                overflow: "hidden",
                                display: "block",
                                visibility: "hidden",
                                transition: "none",
                            });

                            var imageEase = this.getElementSettings("image-ease"),
                                animationClassAdded = false,
                                animationClass = "";

                            ["effect-zoom-in", "effect-zoom-out", "left-move", "right-move"].forEach(function (effect) {
                                if (element.hasClass("mas--image-" + effect)) {
                                    animationClassAdded = true;
                                    animationClass = "mas--image-" + effect;
                                    element.removeClass(animationClass);
                                }
                            });

                            parentElement.each(function () {
                                var parent = $(this);
                                var image = parent.find("img");
                                var animationTimeline = gsap.timeline({
                                    scrollTrigger: {
                                        trigger: parent[0],
                                        start: "top 50%",
                                    },
                                });

                                animationTimeline.set(parent, { autoAlpha: 1 });
                                animationTimeline.from(parent, 1.5, {
                                    xPercent: -100,
                                    ease: imageEase,
                                    onComplete: function () {
                                        if (animationClassAdded) {
                                            element.addClass(animationClass);
                                            animationClassAdded = false;
                                        }
                                    },
                                });
                                animationTimeline.from(image, 1.5, {
                                    xPercent: 100,
                                    scale: 1.3,
                                    delay: -1.5,
                                    ease: imageEase,
                                });
                            });
                        }
                    },
                });

            elementorFrontend.hooks.addAction("frontend/element_ready/widget", function (t) {
                elementorFrontend.elementsHandler.addHandler(l, { $element: t });
            });
            elementorFrontend.hooks.addAction("frontend/element_ready/container", function (t) {
                elementorFrontend.elementsHandler.addHandler(l, { $element: t });
            });
        }
    });
})(jQuery);
