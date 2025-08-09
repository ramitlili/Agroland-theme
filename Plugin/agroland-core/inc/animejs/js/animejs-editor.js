$(window).on('elementor:init', function () {
    var applyAnimeAttributes = function (model, $element) {
        var settings = model.get('settings').attributes;
    
        if (settings.animejs_animation_type !== 'disable') {
            var dataAnimeString = generateDataAnimeString(settings);
    
            var $targetElement;
            if ($element.hasClass('elementor-widget')) {
                $targetElement = $element.find('> .elementor-widget-container');
            } else if ($element.hasClass('e-con')) {
                $targetElement = $element.find('> .e-con-inner');
            } else {
                $targetElement = $element;
            }
    
            $targetElement.attr('data-anime', dataAnimeString);
            $targetElement.addClass('animejs-element');
    
            // Add device information
            if (settings.animejs_devices && settings.animejs_devices.length > 0) {
                $targetElement.attr('data-anime-devices', settings.animejs_devices.join(','));
            } else {
                $targetElement.removeAttr('data-anime-devices');
            }
    
            // Apply animation only if the current device is allowed
            if (isDeviceAllowed(settings.animejs_devices)) {
                runAnimation($targetElement);
            } else {
                removeAnimeAttributes($targetElement);
            }
        } else {
            removeAnimeAttributes($element.find('> .elementor-widget-container, > .e-con-inner'));
        }
    };

    var removeAnimeAttributes = function ($element) {
        $element.removeAttr('data-anime');
        $element.removeAttr('data-anime-devices');
        $element.removeClass('animejs-element');

        // Stop and reset the animation
        const instance = $element[0].animeInstance;
        if (instance) {
            instance.pause();
            instance.reset();
            instance.remove();
            anime.remove($element[0]);
        }

        // Reset inline styles
        $element.css({
            opacity: '',
            transform: ''
        });
    };

    var destroyScrollMagic = function ($element, settings) {
        if (settings.animejs_animation_type !== 'onscroll') {
            // Stop and destroy ScrollMagic scene and controller
            const scrollMagicScene = $element[0].animeScrollMagicScene;
            const scrollMagicController = $element[0].animeScrollMagicController;
            if (scrollMagicScene && scrollMagicController) {
                scrollMagicScene.off('progress');
                scrollMagicScene.remove();
                scrollMagicController.destroy(true);
                $element[0].animeScrollMagicScene = null;
                $element[0].animeScrollMagicController = null;
            }
        }
    };

    var isDeviceAllowed = function (devices) {
        if (!devices || devices.length === 0) return true; // If no devices specified, allow all
        var currentDevice = getCurrentDevice();
        return devices.includes(currentDevice);
    };

    var getCurrentDevice = function () {
        var windowWidth = window.innerWidth;
        if (windowWidth < 767) return 'mobile';
        if (windowWidth < 1023) return 'tablet';
        return 'desktop';
    };

    var runAnimation = function ($element) {
        // Here you would typically call your animation function
        console.log('Running animation for', $element);
        // In a real scenario, you'd call something like:
        // AnimeJSHelper.applyAnimation($element);
    };

    elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {
        if(view.$el.hasClass('animejs-onview') || view.$el.hasClass('animejs-onscroll')) {
            applyAnimeAttributes(model, view.$el);
            destroyScrollMagic(view.$el, model.get('settings').attributes);
        } else {
            removeAnimeAttributes(view.$el);
            destroyScrollMagic(view.$el, model.get('settings').attributes);
        }
    });

    elementor.hooks.addAction('panel/open_editor/container', function (panel, model, view) {
        if(view.$el.hasClass('animejs-onview') || view.$el.hasClass('animejs-onscroll')) {
            applyAnimeAttributes(model, view.$el);
            destroyScrollMagic(view.$el, model.get('settings').attributes);
        } else {
            removeAnimeAttributes(view.$el);
            destroyScrollMagic(view.$el, model.get('settings').attributes);
        }
    });
});

function generateDataAnimeString(settings) {
    var dataAnime = [];

    if (settings.animejs_onscroll_viewport === 'top') {
        settings.animejs_onscroll_viewport = 0;
    } else if (settings.animejs_onscroll_viewport === 'center') {
        settings.animejs_onscroll_viewport = 0.5;
    } else {
        settings.animejs_onscroll_viewport = 1;
    }

    if (settings.animejs_animation_type === 'onview') {
        dataAnime.push("onview: " + settings.animejs_onview_trigger_viewport);
        if (settings.animejs_onview_repeat === 'yes') {
            dataAnime.push("loop: true");
        } else {
            dataAnime.push("loop: false");
        }
        if (settings.animejs_onview_direction === 'alternate') {
            dataAnime.push("direction: alternate");
        } else if (settings.animejs_onview_direction === 'reverse') {
            dataAnime.push("direction: reverse");
        }
    } else if (settings.animejs_animation_type === 'onscroll') {
        dataAnime.push("onscroll: " + (settings.animejs_onscroll_scene ? settings.animejs_onscroll_scene : 'true'));
        dataAnime.push("onscroll-trigger: " + settings.animejs_onscroll_viewport);
        dataAnime.push("onscroll-duration: " + settings.animejs_onscroll_duration.size + "%");
        dataAnime.push("onscroll-offset: " + settings.animejs_onscroll_offset);
    }

    if (settings.animejs_onview_targets) {
        dataAnime.push("targets: " + settings.animejs_onview_targets);
    }

    var properties = ['opacity', 'translateX', 'translateY', 'scale', 'rotate', 'skew'];
    properties.forEach(function (prop) {
        var from = settings["animejs_animation_from_" + prop];
        var to = settings["animejs_animation_to_" + prop];
        if (from !== '' && to !== '') {
            dataAnime.push(prop + ": [" + from + ", " + to + "]");
        } else if (from !== '') {
            dataAnime.push(prop + ": " + from);
        } else if (to !== '') {
            dataAnime.push(prop + ": " + to);
        }
    });

    var easing = settings.animejs_animation_type === 'onview' ? settings.animejs_animation_easing : 'linear';
    if (easing === 'custom') {
        easing = settings.animejs_animation_easing_custom;
    }
    dataAnime.push("easing: '" + easing + "'");

    dataAnime.push("duration: " + settings.animejs_animation_speed);
    dataAnime.push("delay: " + settings.animejs_animation_delay);

    if (settings.animejs_onview_targets && settings.animejs_onview_staggering) {
        var stagger = "anime.stagger(" + settings.animejs_onview_staggering;
        if (settings.animejs_onview_staggering_start_after) {
            stagger += ", {start: " + settings.animejs_onview_staggering_start_after;
            if (settings.animejs_onview_staggering_from && settings.animejs_onview_staggering_from !== 'first') {
                stagger += ", from: '" + settings.animejs_onview_staggering_from + "'";
            }
            stagger += "}";
        }
        stagger += ")";
        dataAnime.push("delay: " + stagger);
    }

    return dataAnime.join('; ');
}