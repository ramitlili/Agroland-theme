window.addEventListener('elementor/init', () => {
    let elTypes = ['widget', 'section', 'column', 'container'];

    // Variable to store the ID of the copied element
    let copiedElementId = null;

    function getCurrentDevice() {
        const width = window.innerWidth;
        if (width < 767) {
            return 'mobile';
        } else if (width < 1023) {
            return 'tablet';
        } else {
            return 'desktop';
        }
    }

    // Function to filter AnimeJS animation settings
    function getAnimejsSettings(attributes) {
        const animejsSettingsStored = {};
        for (let key in attributes) {
            if (attributes.hasOwnProperty(key) && key.startsWith('animejs_')) {
                animejsSettingsStored[key] = attributes[key];
            }
        }
        return animejsSettingsStored;
    }

    // Function to display notifications using Elementor's built-in system
    function showNotification(message) {
        elementorCommon.notifications.showToast({ message });
    }

    // Function to handle copying AnimeJS settings
    function copyAnimejsSettings() {
        const panelView = elementor.getPanelView();
        const currentPageView = panelView ? panelView.getCurrentPageView() : null;
        const editedElementView = currentPageView ? currentPageView.getOption('editedElementView') : null;
        const currentModel = editedElementView ? editedElementView.model : null;

        if (!currentPageView) {
            showNotification('No current page view found.');
            return;
        }

        if (!currentModel) {
            showNotification('No target element selected. Please click first on the element you want to copy from!');
            return;
        }

        const animejsSettings = currentModel.get('settings').attributes;
        const animejsSettingsStored = getAnimejsSettings(animejsSettings);

        const clipboardData = {
            type: 'animejs',
            elements: [{ animejsSettingsStored }]
        };

        elementorCommon.storage.set('clipboard', clipboardData);
        copiedElementId = currentModel.id;
        showNotification('AnimeJS settings copied to clipboard.');
    }

    // Function to get paste data from local storage
    function getPasteData() {
        return elementorCommon.storage.get('clipboard') || {};
    }

    // Function to handle pasting AnimeJS settings
    function pasteAnimejsSettings() {
        const clipboardData = getPasteData();
    
        if (!clipboardData || !clipboardData.elements || clipboardData.type !== 'animejs') {
            showNotification('No valid AnimeJS settings found in clipboard.');
            return;
        }
    
        const panelView = elementor.getPanelView();
        const currentPageView = panelView ? panelView.getCurrentPageView() : null;
        const editedElementView = currentPageView ? currentPageView.getOption('editedElementView') : null;
        const currentModel = editedElementView ? editedElementView.model : null;
    
        if (!currentPageView || !currentModel) {
            showNotification('No target element selected.');
            return;
        }
    
        const animejsSettings = clipboardData.elements[0].animejsSettingsStored;
    
        if (currentModel.id !== copiedElementId) {
            // Update the model with new settings
            currentModel.get('settings').set(animejsSettings, { silent: true });
            currentModel.trigger('change');
    
            // Refresh the specific AnimeJS controls in the panel view
            for (let control in currentPageView.options.controls) {
                if (control.startsWith('animejs_')) {
                    let controlView = currentPageView.children.find(child => child.model.get('name') === control);
                    if (controlView && controlView.render) {
                        controlView.render();
                    }
                }
            }
    
            // Trigger Elementor's change detection
            elementor.channels.data.trigger('element:after:add', currentModel);
            elementor.saver.setFlagEditorChange(true);
    
            // Apply the new animation settings to the element
            const $element = editedElementView.$el;
            applyAnimeAttributes(currentModel, $element);
    
            showNotification('AnimeJS settings pasted successfully.');
        } else {
            showNotification('Oops! You are pasting the settings on the same element.');
        }
    }
    
    function applyAnimeAttributes(model, $element) {
        const settings = model.get('settings').attributes;
    
        if (settings.animejs_animation_type !== 'disable') {
            const dataAnimeString = generateDataAnimeString(settings);
    
            $element.attr('data-anime', dataAnimeString);
            $element.addClass('animejs-element');
    
            // Add device information
            if (settings.animejs_devices && settings.animejs_devices.length > 0) {
                $element.attr('data-anime-devices', settings.animejs_devices.join(','));
            } else {
                $element.removeAttr('data-anime-devices');
            }
    
            // Check if the current device is allowed before applying the animation
            if (isDeviceAllowed(settings.animejs_devices)) {
                runAnimation($element);
            } else {
                removeAnimeAttributes($element);
            }
        } else {
            removeAnimeAttributes($element);
        }
    }
    
    function isDeviceAllowed(allowedDevices) {
        if (!allowedDevices || allowedDevices.length === 0) {
            return true; // If no devices specified, allow all
        }
        const currentDevice = getCurrentDevice();
        return allowedDevices.includes(currentDevice);
    }
    
    function runAnimation($element) {
        if (typeof AnimeJSHelper !== 'undefined' && AnimeJSHelper.applyAnimation) {
            AnimeJSHelper.applyAnimation($element);
        } else {
            console.warn('AnimeJSHelper not found. Animation not applied.');
        }
    }
    
    function removeAnimeAttributes($element) {
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
    }

    // add copy/paste AnimeJS animations actions
    let animejsMenuActions = {
        name: 'animejs-actions',
        actions: [
            {
                name: 'animejs_copy_settings',
                title: 'Copy settings',
                shortcut: 'AnimeJS',
                isEnabled: () => true,
                callback: copyAnimejsSettings,
            },
            {
                name: 'animejs_paste_settings',
                title: 'Paste settings',
                shortcut: 'AnimeJS',
                isEnabled: () => true,
                callback: pasteAnimejsSettings,
            },
        ]
    };

    // create a group for AnimeJS animations actions
    elTypes.forEach((type) => {
        elementor.hooks.addFilter(`elements/${type}/contextMenuGroups`, (animejsMenuGroup) => {
            animejsMenuGroup.push(animejsMenuActions);
            return animejsMenuGroup;
        });
    });
});