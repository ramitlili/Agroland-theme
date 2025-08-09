/*

[Main Script]

Project: Quanto
Version: 1.0
Author : vecurosoft.com

*/
; (function ($) {
    "use strict";

    jQuery(window).on('elementor/frontend/init', function () {
        // console.log( elementorFrontend);
        if (typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {

            elementor.settings.page.addChangeCallback('quanto_header_style', function (newValue) {
                if (newValue == 'prebuilt') {
                    elementor.saver.update({
                        onSuccess: function () {
                            elementor.reloadPreview();
                            elementor.once('preview:loaded', function () {
                                elementor.getPanelView().setPage('page_settings').activateTab('settings');
                            });
                        }
                    });
                }
            });


            elementor.settings.page.addChangeCallback('quanto_header_builder_option', function (newValue) {
                elementor.saver.update({
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            elementor.getPanelView().setPage('page_settings').activateTab('settings');
                        });
                    }
                });
            });

            elementor.settings.page.addChangeCallback('quanto_footer_style', quantoFooterStyle);
            function quantoFooterStyle(newValue) {
                elementor.saver.update({
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            elementor.getPanelView().setPage('page_settings').activateTab('settings');
                        });
                    }
                });
            }
            elementor.settings.page.addChangeCallback('quanto_footer_choice', quantoFooterChoice);
            function quantoFooterChoice(newValue) {
                elementor.saver.update({
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            elementor.getPanelView().setPage('page_settings').activateTab('settings');
                        });
                    }
                });
            }

        }
    });

})(jQuery);