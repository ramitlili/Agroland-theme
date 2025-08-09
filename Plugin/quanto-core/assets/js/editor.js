/*
* Initialize Modules
*/
;(function($, window, document, undefined){

    $( window ).on( 'elementor:init', function() {

    // Make our custom css visible in the panel's front-end
    if( typeof elementorPro == 'undefined' ) {
        elementor.hooks.addFilter( 'editor/style/styleText', function( css, context ){
            if ( ! context ) {
                return;
            }
            var model = context.model,
                customCSS = model.get('settings').get('quanto_custom_css');

            var selector = '.elementor-element.elementor-element-' + model.get('id');

            if ('document' === model.get('elType')) {
                selector = elementor.config.document.settings.cssWrapperSelector;
            }

            if (customCSS) {
                css += customCSS.replace(/selector/g, selector);
            }

            return css;
        });
    }
} );
"use strict";!function(n){var e=function(){function n(){"elementor"in window&&"elementorFrontend"in window&&(this.document=elementor.documents.currentDocument,this.breakpoints=elementorFrontend.config.breakpoints,this.init())}var e=n.prototype;return e.init=function(){var n=this;this.document.container.children.forEach(function(e){n.updateBreakPointCSS(e)}),elementor.hooks.addAction("panel/open_editor/widget",function(e,t,o){n.delay(function(){n.addDevice(o)})}),elementor.hooks.addAction("panel/open_editor/section",function(e,t,o){n.delay(function(){n.runFromRootSection(o)})}),elementor.hooks.addAction("panel/open_editor/column",function(e,t,o){n.delay(function(){n.runFromRootSection(o)})})},e.delay=function(n,e,t){void 0===e&&(e=10),void 0===t&&(t=20);var o=setInterval(function(){n(),0>=t&&clearInterval(o)},e)},e.runFromRootSection=function(n){var e=this.getRootSection(n.container);e&&this.updateBreakPointCSS(e)},e.updateBreakPointCSS=function(n){var e=this;n.view&&this.addDevice(n.view),n.children.forEach(function(n){e.updateBreakPointCSS(n)})},e.getRootSection=function(n){return n.parent||console.log("Something went wrong"),n.parent&&"document"==n.parent.type&&"section"==n.type?n:this.getRootSection(n.parent)},e.addDevice=function(n){var e=n.controlsCSSParser.stylesheet;for(var t in this.breakpoints)if(!["xs","sm","md","lg","xxl"].includes(t)){var o=this.breakpoints[t].input1;void 0===o&&(o=this.breakpoints[t]),e.addDevice(t,o)}this.renderStyles(n)},e.renderStyles=function(n){n.renderStyles()},n}();n(window).load(function(){new e})}(jQuery);
})(jQuery, window, document);


 
