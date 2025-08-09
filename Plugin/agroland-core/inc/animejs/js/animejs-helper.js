const $ = typeof jQuery !== 'undefined' ? jQuery : null;
const { typesTesters, typesParsers } = dataAttrHelpers;

const parseDataAttr = (dataAttr, types) => {
    const options = {};
    for (const row of dataAttr.split(';')) {
        const match = row.trim().match(/^(.*?):([\s\S]*)$/);
        if (!match) continue;
        let [key, value] = [match[1], match[2]].map(a => a.trim());
        if (aliases[key]) {
            key = aliases[key];
        }
        for (const type in types) {
            if (types[type].includes(key) && typesTesters[type](value)) {
                value = typesParsers[type](value);
                break;
            }
        }
        if (typeof value === 'string') {
            if (/^(\[|\{|anime\.|"|')/.test(value)) {
                value = new Function(`return (${value})`)();
            }
        }
        const parts = key.split('-');
        let opts = options;
        parts.forEach((part, i) => {
            if (i < parts.length - 1) {
                opts[part] = opts[part] || {};
                opts = opts[part];
            } else {
                opts[part] = value;
            }
        });
    }
    return options;
};

const dataAnimeAttrType = {
    string: [
        "targets",
        "onscroll",
        "onscroll-target",
    ],
    number: [
        "onview",
    ],
    boolean: [
        "loop",
        "onclick",
        "onview",
        "autoplay",
        "onscroll",
        "onscroll-target",
        "onscroll-pen",
    ]
};

const aliases = {
    'onscroll': 'onscroll-target',
    'onscroll-trigger': 'onscroll-triggerHook',
};

const runInstance = (el, instance, direction = 'restart') => {
    if (direction === 'alternate') {
        if (!el.animeToggleOpen) {
            if (instance.reversed) {
                instance.reverse();
            }
        } else {
            if (!instance.reversed) {
                instance.reverse();
            }
        }
        el.animeToggleOpen = !el.animeToggleOpen;
        instance.play();
    } else if (direction === 'restart') {
        instance.restart();
    } else if (direction === 'reset') {
        instance.reset();
    } else {
        throw 'invalid direction';
    }
};

const loadingPromise = new Promise(r => {
    document.addEventListener('DOMContentLoaded', e => {
        setTimeout(() => {
            r(true);
        }, 1000 + 300);
    });
});

const runHelper = async (el, options, instance) => {
    const run = (direction = 'restart') => {
        runInstance(el, instance, direction);
    };
    let autoRun = options.autoplay !== false;
    if (options.onclick) {
        const toggle = options.onclick === 'alternate';
        el.addEventListener('click', e => {
            e.preventDefault();
            run(toggle ? 'alternate' : 'restart');
        });
        autoRun = false;
    }
    if (options.onscroll) {
        const scrollMagicOptions = typeof options.onscroll === 'boolean' ? { triggerElement: el } : options.onscroll;
        if (scrollMagicOptions.target) {
            scrollMagicOptions.triggerElement = scrollMagicOptions.target;
            delete scrollMagicOptions.target;
        }
        const controller = new ScrollMagic.Controller({
            ...(scrollMagicOptions.controller || {}),
        });
        const penOption = scrollMagicOptions.pen;
        delete scrollMagicOptions.controller;
        delete scrollMagicOptions.pen;
        const sceneOptions = scrollMagicOptions || {};
        const triggerElement = sceneOptions.triggerElement ? (
            typeof sceneOptions.triggerElement === 'string'
                ? document.querySelector(sceneOptions.triggerElement)
                : sceneOptions.triggerElement
        ) : el;
        delete sceneOptions.triggerElement;
        const scene = new ScrollMagic.Scene({
            triggerElement,
            duration: '100%',
            triggerHook: 1,
            ...sceneOptions,
        });
        if (penOption) {
            const pen = penOption === true ? triggerElement : document.querySelector(penOption);
            scene.setPin(pen);
        }
        scene.on('progress', e => {
            instance.seek(e.progress * instance.duration);
        }).addTo(controller);

        // Store the ScrollMagic scene and controller
        el.animeScrollMagicScene = scene;
        el.animeScrollMagicController = controller;

        delete options.onscroll;
        autoRun = false;
    }
    if (options.onhover) {
        $(el).on('mouseenter mouseleave', () => {
            run('alternate');
        });
        autoRun = false;
    }
    await loadingPromise;
    if (typeof options.onview !== 'undefined' && options.onview !== false) {
        const offset = typeof options.onview === 'number' ? options.onview : 0;
        const handler = () => {
            if (window.innerHeight > el.getBoundingClientRect().top - offset) {
                window.removeEventListener('scroll', handler);
                window.removeEventListener('resize', handler);
                run();
            }
        };
        window.addEventListener('scroll', handler);
        window.addEventListener('resize', handler);
        handler();
        autoRun = false;
    }
    if (options.media) {
        const mediaArray = typeof options.media === 'string' ? [options.media] : options.media;
        const mediaList = [];
        for (let i = 0; i < mediaArray.length; i++) {
            const bp = mediaArray[i];
            const group = i % 2 === 0 ? (mediaList[i / 2] = []) : mediaList[(i - 1) / 2];
            group.push({ bp, type: i % 2 === 0 ? 'min' : 'max' });
        }
        const mediaText = mediaList.map(mediaArray => '(' + mediaArray.map(({ bp, type }) => {
            const bpSize = breakpoints[bp] || 0;
            return `(${type}-width: ${type === 'max' ? bpSize - 1 : bpSize}px)`;
        }).join(' and ') + ')').join(' or ');
        const media = matchMedia(mediaText);
        const update = () => {
            run(media.matches ? "restart" : "reset");
        };
        media.onchange = update;
        update();
        autoRun = false;
    }
    if (autoRun) {
        run();
    } else if (options.animejs_animation_type === 'disable') {
        removeAnimationStyles($(el));
        destroyScrollMagicInstance($(el));
    }
};

const runDataAnime = async (el) => {
    if (!AnimeJSHelper.isDeviceAllowed(el)) {
        return; // Exit if the animation is not allowed on this device
    }
    const options = parseDataAttr(el.getAttribute('data-anime') || '', dataAnimeAttrType);
    const targets = options.targets ? [...$(options.targets, el)] : el;
    Object.assign(options, { targets });
    let instance;
    if (options.timeline) {
        const timelineName = options.timeline;
        delete options.timeline;
        if (!timelines[timelineName]) {
            if (!timelinesPromises[timelineName]) {
                timelinesPromises[timelineName] = new Promise(resolve => {
                    timelinesResolvers[timelineName] = resolve;
                });
            }
            await timelinesPromises[timelineName];
        }
        instance = timelines[timelineName](el, options);
    } else {
        instance = anime(options);
    }
    instance.pause();

    el.animeInstance = instance;
    runHelper(el, options, instance);
};

const timelines = {};
const timelinesPromises = {};
const timelinesResolvers = {};

const defineAnimeTimelineHelper = (name, fn) =>  {
    timelines[name] = fn;
    if (timelinesResolvers[name]) {
        timelinesResolvers[name](fn);
    }
};

Object.assign(window, { defineAnimeTimelineHelper });

const runDataAnimeToggle = async (el) => {
    const toggleSelector = el.getAttribute('data-anime-toggle') || '';
    el.addEventListener('click', e => {
        e.preventDefault();
        const els = [...$(toggleSelector)];
        els.forEach(other => {
            const instance = other.animeTimelineInstance || other.animeInstance;
            if (!instance) return;
            runInstance(other, instance, 'alternate');
        });
    });
};

// Stop and reset the animation
const resetAnimation = function($element) {
    const instance = $element[0].animeInstance;
    if (instance) {
        instance.pause();
        instance.reset();
        instance.remove();
        anime.remove($element[0]);
    }
};
            
// Remove inline styles
const removeAnimationStyles = function($element) {
    $element.css({
        opacity: '',
        transform: ''
    });
};

// Stop and destroy ScrollMagic scene and controller
const destroyScrollMagicInstance = function($element) {
    const scrollMagicScene = $element[0].animeScrollMagicScene;
    const scrollMagicController = $element[0].animeScrollMagicController;
    if (scrollMagicScene && scrollMagicController) {
        scrollMagicScene.off('progress');
        scrollMagicScene.remove();
        scrollMagicController.destroy(true);
        $element[0].animeScrollMagicScene = null;
        $element[0].animeScrollMagicController = null;
    }
};

const getCurrentDevice = () => {
    const width = window.innerWidth;
    if (width < 767) {
        return 'mobile';
    } else if (width < 1023) {
        return 'tablet';
    } else {
        return 'desktop';
    }
};

const isDeviceAllowed = (el) => {
    const allowedDevices = el.getAttribute('data-anime-devices');
    if (!allowedDevices) return true; // If no devices specified, allow all

    const deviceList = allowedDevices.split(',');
    const currentDevice = getCurrentDevice();
    return deviceList.includes(currentDevice);
};

const AnimeJSHelper = {
    currentDevice: null,

    init: function() {
        this.currentDevice = getCurrentDevice();
        
        if (window.elementorFrontend && elementorFrontend.isEditMode()) {
            elementor.channels.editor.on('change', this.onElementorChange);
        } else {
            this.applyAnimations();
        }
        
        // Add resize event listener with debounce
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => this.handleResize(), 250);
        });
    },

    handleResize: function() {
        const newDevice = getCurrentDevice();
        if (newDevice !== this.currentDevice) {
            this.currentDevice = newDevice;
            this.applyAnimations();
        }
    },

    updateElementAnimation: function(el) {
        const allowedDevices = el.getAttribute('data-anime-devices');
        
        if (allowedDevices) {
            const deviceList = allowedDevices.split(',');
            if (deviceList.includes(this.currentDevice)) {
                this.enableAnimation(el);
            } else {
                this.disableAnimation(el);
            }
        } else {
            // If no devices are specified, run the animation on all devices
            this.enableAnimation(el);
        }
    },

    isDeviceAllowed: function(el) {
        const allowedDevices = el.getAttribute('data-anime-devices');
        if (!allowedDevices) return true; // If no devices specified, allow all
    
        const deviceList = allowedDevices.split(',');
        return deviceList.includes(this.currentDevice);
    },

    enableAnimation: function(el) {
        // Remove any existing instance
        if (el.animeInstance) {
            el.animeInstance.pause();
            el.animeInstance.reset();
            anime.remove(el);
        }
        // Remove any existing ScrollMagic scene and controller
        if (el.animeScrollMagicScene) {
            el.animeScrollMagicScene.destroy(true);
            el.animeScrollMagicScene = null;
        }
        if (el.animeScrollMagicController) {
            el.animeScrollMagicController.destroy(true);
            el.animeScrollMagicController = null;
        }
        // Run the animation
        runDataAnime(el);
    },

    disableAnimation: function(el) {
        if (el.animeInstance) {
            el.animeInstance.pause();
            el.animeInstance.reset();
            anime.remove(el);
            el.animeInstance = null;
        }
        removeAnimationStyles($(el));
        if (el.animeScrollMagicScene) {
            el.animeScrollMagicScene.destroy(true);
            el.animeScrollMagicScene = null;
        }
        if (el.animeScrollMagicController) {
            el.animeScrollMagicController.destroy(true);
            el.animeScrollMagicController = null;
        }
    },

    applyAnimations: function() {
        $('[data-anime]').each((index, el) => {
            this.updateElementAnimation(el);
        });
    },

    applyAnimation: async function($element) {
        if ($element.length === 0) {
            console.warn('No element found to apply animation');
            return;
        }
        const el = $element[0];
        await runDataAnime(el);
    },

    onElementorChange: function(controlView, elementView) {
        const changed = controlView.model.get('name');
        if (changed.indexOf('animejs_') === 0) {
            const $element = elementView.$el;
            AnimeJSHelper.updateAnimation($element, elementView);
        }
    },

    updateAnimation: function($element, elementView, isInitial = false) {
        const settings = elementView.getEditModel().get('settings').toJSON();
        
        if (settings.animejs_animation_type !== 'disable') {
            if (settings.animejs_animation_type || !isInitial) {
                const dataAnime = AnimeJSHelper.generateDataAnime(settings);
                
                $element.attr('data-anime', dataAnime);
                $element.addClass('animejs-element');
    
                // Add selected devices as a data attribute
                if (settings.animejs_devices && settings.animejs_devices.length > 0) {
                    $element.attr('data-anime-devices', settings.animejs_devices.join(','));
                } else {
                    $element.removeAttr('data-anime-devices');
                }
    
                // Check if the current device is allowed before applying the animation
                if (this.isDeviceAllowed($element[0])) {
                    // Re-apply animation
                    this.enableAnimation($element[0]);
                } else {
                    // Disable animation if the current device is not allowed
                    this.disableAnimation($element[0]);
                }
            }
        } else {
            // Remove data-anime attribute and classes
            $element.removeAttr('data-anime');
            $element.removeAttr('data-anime-devices');
            $element.removeClass('animejs-element');
    
            this.disableAnimation($element[0]);
        }
    
        if (settings.animejs_animation_type !== 'onscroll') {
            destroyScrollMagicInstance($element);
        }
    },
    
    generateDataAnime: function(settings) {
        let dataAnime = [];

        if (settings.animejs_onscroll_viewport === 'top') {
            settings.animejs_onscroll_viewport = 0;
        } else if (settings.animejs_onscroll_viewport === 'center') {
            settings.animejs_onscroll_viewport = 0.5;
        } else {
            settings.animejs_onscroll_viewport = 1;
        }

        if (settings.animejs_animation_type === 'onview') {
            dataAnime.push(`onview: ${settings.animejs_onview_trigger_viewport}`);
            if (settings.animejs_onview_repeat === 'yes') {
                dataAnime.push(`loop: true`);
            } else {
                dataAnime.push(`loop: false`);
            }
            if (settings.animejs_onview_direction === 'alternate') {
                dataAnime.push(`direction: alternate`);
            } else if (settings.animejs_onview_direction === 'reverse') {
                dataAnime.push(`direction: reverse`);
            }
        } else if (settings.animejs_animation_type === 'onscroll') {
            dataAnime.push(`onscroll: ${settings.animejs_onscroll_scene || 'true'}`);
            dataAnime.push(`onscroll-trigger: ${settings.animejs_onscroll_viewport}`);
            dataAnime.push(`onscroll-duration: ${settings.animejs_onscroll_duration.size}%`);
            dataAnime.push(`onscroll-offset: ${settings.animejs_onscroll_offset}`);
        }

        if (settings.animejs_animation_type !== 'disable') {

            const properties = ['opacity', 'translateX', 'translateY', 'scale', 'rotate', 'skew'];
            properties.forEach(prop => {
                const from = settings[`animejs_animation_from_${prop}`];
                const to = settings[`animejs_animation_to_${prop}`];
                if (from !== '' && to !== '') {
                    dataAnime.push(`${prop}: [${from}, ${to}]`);
                } else if (from !== '') {
                    dataAnime.push(`${prop}: ${from}`);
                } else if (to !== '') {
                    dataAnime.push(`${prop}: ${to}`);
                }
            });

            let easing = settings.animejs_animation_easing;
            if (easing === 'custom') {
                easing = settings.animejs_animation_easing_custom;
            }
            dataAnime.push(`easing: '${easing}'`);
            dataAnime.push(`duration: ${settings.animejs_animation_speed}`);
            dataAnime.push(`delay: ${settings.animejs_animation_delay}`);

            if (settings.animejs_onview_targets && settings.animejs_onview_staggering) {
                let stagger = `anime.stagger(${settings.animejs_onview_staggering}`;
                if (settings.animejs_onview_staggering_start_after) {
                    stagger += `, {start: ${settings.animejs_onview_staggering_start_after}`;
                    if (settings.animejs_onview_staggering_from && settings.animejs_onview_staggering_from !== 'first') {
                        stagger += `, from: '${settings.animejs_onview_staggering_from}'`;
                    }
                    stagger += `}`;
                }
                stagger += `)`;
                dataAnime.push(`delay: ${stagger}`);
            }
            
        }

        return dataAnime.join('; ');
    }
};

// Initialize AnimeJSHelper
$(document).ready(AnimeJSHelper.init.bind(AnimeJSHelper));

// Keep the existing event listeners and function calls
dataAttrHelpers.watchDataAttr('data-anime', runDataAnime);
dataAttrHelpers.watchDataAttr('data-anime-toggle', runDataAnimeToggle);