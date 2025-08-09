var $j = jQuery.noConflict();

$j(document).ready(function() {
    "use strict";
    StickyHeader();
});

function StickyHeader() {
    var header = $j('.elementor-element.mas-sticky-yes'),
        container = $j('.mas-sticky-yes .elementor-container, .elementor-element.mas-sticky-yes.e-con'),
        header_elementor = $j('.elementor-edit-mode .mas-header-yes'),
        data_settings = header.data('settings');

    if (typeof data_settings !== 'undefined') {
        var responsive_settings = data_settings["mas_transparent_on"];
        var width = $j(window).width();
        var  header_height= header.height();
    }

    if (typeof width !== 'undefined' && width) {
        var enabled;
        if (width >= 1025) {
            enabled = "desktop";
        } else if (width > 767 && width < 1025) {
            enabled = "tablet";
        } else if (width <= 767) {
            enabled = "mobile";
        }
    }

    if ($j.inArray(enabled, responsive_settings) != '-1') {
        var scroll_distance = data_settings["mas_scroll_distance"];
        var background = data_settings["mas_background"];
        var bottom_border_color = data_settings["mas_custom_bottom_border_color"],
            bottom_border_width = data_settings["mas_custom_bottom_border_width"];

        var shrink_header = data_settings["mas_shrink_header"],
            data_height = data_settings["mas_custom_height_header"],
            data_height_tablet = data_settings["mas_custom_height_header_tablet"],
            data_height_mobile = data_settings["mas_custom_height_header_mobile"];

        var sticky_width = data_settings["sticky_width"]['size'];
        var sticky_unit = data_settings["sticky_width"]['unit'];
        var sticky_gap_top = data_settings["sticky_gap_top"]['size'];
        var sticky_gap_unit = data_settings["sticky_gap_top"]['unit'];
           

            
        var scroll_distance_hide_header = data_settings["mas_scroll_distance_hide_header"];
        

        // Box Shadow settings
        var box_shadow = data_settings["mas_box_shadow"]; // Default shadow if none is set


        var shrink_height;
        if (typeof data_height !== "undefined" && data_height) {
            if (width >= 1025) {
                shrink_height = data_height["size"];
            } else if (width > 767 && width < 1025) {
                shrink_height = data_height_tablet["size"] || data_height["size"];
            } else if (width <= 767) {
                shrink_height = data_height_mobile["size"] || data_height["size"];
            }
        }

        if (typeof bottom_border_width !== 'undefined' && bottom_border_width) {
            var bottom_border = bottom_border_width["size"] + "px solid " + bottom_border_color;
        }

      

        $j(window).on("scroll", function() {

            var scroll = $j(window).scrollTop();

            if (header_elementor) {
                header_elementor.css("position", "relative");
            }

            var sd_s = scroll_distance["size"],
                        sd_u = scroll_distance["unit"],
                        sd_tablet = data_settings["mas_scroll_distance_tablet"],
                        sd_tablet_s = sd_tablet["size"],
                        sd_tablet_u = sd_tablet["unit"],
                        sd_mobile = data_settings["mas_scroll_distance_mobile"],
                        sd_mobile_s = sd_mobile["size"],
                        sd_mobile_u = sd_mobile["unit"];

            // get responsive view
            if ( typeof scroll_distance != "undefined" && scroll_distance ) {
                if (width >= 1025) {
                    var sd = sd_s,
                        sd_u = sd_u;
                   
                    if (sd_u == "vh") {
                        sd = window.innerHeight * (sd / 100);
                    }
                } else if (width > 767 && width < 1025) {
                    var sd = sd_tablet_s,
                        sd_u = sd_tablet_u;

                    if (sd == "") {
                        sd = sd_s;
                    }
                    
                    if (sd_u == "vh") {
                        sd = window.innerHeight * (sd / 100);
                    }
                } else if (width <= 767) {
                    var sd = sd_mobile_s,
                        sd_u = sd_mobile_u;

                    if (sd == "") {
                        sd = sd_s;
                    }
                    

                    if (sd_u == "vh") {
                        sd = window.innerHeight * (sd / 100);
                    }
                }
            }
           

            if (scroll >= scroll_distance["size"] ) {
                header.addClass("mas-sticky-header").css({
                    "background-color": background,
                    "border-bottom": bottom_border,
                    "box-shadow": box_shadow,
                    "max-width" : sticky_width+sticky_unit,
                    "transition": "all 0.4s ease-in-out",
                    "top"       : sticky_gap_top + sticky_gap_unit,
					"padding"   : "0"
                })

                if (shrink_header === "yes") {
                    header.css({"padding": "0", "margin": "0"});
                    container.css({
                        "min-height": shrink_height,
                        "transition": "all 0.4s ease-in-out"
                    });
                }

            } else {
                header.removeClass("mas-sticky-header").css({
                    "background-color": "",
                    "border-bottom": "",
                    "box-shadow": "" 
                })

                if (shrink_header === "yes") {
                    container.css("min-height", "");
                }
            }
        });

          // hide header on scroll
          if (typeof scroll_distance_hide_header !== "undefined" && scroll_distance_hide_header) {
            var mywindow = $j(window);
            var mypos = mywindow.scrollTop(); 
            var sd_hh_size = scroll_distance_hide_header["size"];
            var sd_hh_unit = scroll_distance_hide_header["unit"];
           
            console.log(sd_hh_size);
            // Convert vh to px if needed
            if (sd_hh_unit === "vh") {
                sd_hd_full = window.innerHeight * (sd_hh_size / 100);
            }
        
            mywindow.scroll(function () {
                var currentScroll = mywindow.scrollTop(); 
                var viewportHeight = window.innerHeight; 
                var documentHeight = $(document).height(); 
                var scrollBottom = documentHeight - viewportHeight; 
               
                // Calculate the threshold to hide the header
                var heightminus = scrollBottom - sd_hh_size; 
                
               
                if (currentScroll >= heightminus) {
                    
                    header.addClass('headerup');
                } else {
                   
                    header.removeClass('headerup');
                }
            });
            
        }
               
        
        
    }
}
