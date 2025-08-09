(function ($) {
    "use strict";

    let $agroland_page_breadcrumb_area = $("#_agroland_page_breadcrumb_area");
    let $agroland_page_settings = $("#_agroland_page_breadcrumb_settings");
    let $agroland_page_breadcrumb_image = $("#_agroland_breadcumb_image");
    let $agroland_page_title = $("#_agroland_page_title");
    let $agroland_page_title_settings = $("#_agroland_page_title_settings");

    if ($agroland_page_breadcrumb_area.val() == '1') {
        $(".cmb2-id--agroland-page-breadcrumb-settings").show();
        if ($agroland_page_settings.val() == 'global') {
            $(".cmb2-id--agroland-breadcumb-image").hide();
            $(".cmb2-id--agroland-page-title").hide();
            $(".cmb2-id--agroland-page-title-settings").hide();
            $(".cmb2-id--agroland-custom-page-title").hide();
            $(".cmb2-id--agroland-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--agroland-breadcumb-image").show();
            $(".cmb2-id--agroland-page-title").show();
            $(".cmb2-id--agroland-page-breadcrumb-trigger").show();

            if ($agroland_page_title.val() == '1') {
                $(".cmb2-id--agroland-page-title-settings").show();
                if ($agroland_page_title_settings.val() == 'default') {
                    $(".cmb2-id--agroland-custom-page-title").hide();
                } else {
                    $(".cmb2-id--agroland-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--agroland-page-title-settings").hide();
                $(".cmb2-id--agroland-custom-page-title").hide();

            }
        }
    } else {
        $agroland_page_breadcrumb_area.parents('.cmb2-id--agroland-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $agroland_page_breadcrumb_area.on("change", function () {
        if ($(this).val() == '1') {
            $(".cmb2-id--agroland-page-breadcrumb-settings").show();
            if ($agroland_page_settings.val() == 'global') {
                $(".cmb2-id--agroland-breadcumb-image").hide();
                $(".cmb2-id--agroland-page-title").hide();
                $(".cmb2-id--agroland-page-title-settings").hide();
                $(".cmb2-id--agroland-custom-page-title").hide();
                $(".cmb2-id--agroland-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--agroland-breadcumb-image").show();
                $(".cmb2-id--agroland-page-title").show();
                $(".cmb2-id--agroland-page-breadcrumb-trigger").show();

                if ($agroland_page_title.val() == '1') {
                    $(".cmb2-id--agroland-page-title-settings").show();
                    if ($agroland_page_title_settings.val() == 'default') {
                        $(".cmb2-id--agroland-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--agroland-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--agroland-page-title-settings").hide();
                    $(".cmb2-id--agroland-custom-page-title").hide();

                }
            }
        } else {
            $(this).parents('.cmb2-id--agroland-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $agroland_page_title.on("change", function () {
        if ($(this).val() == '1') {
            $(".cmb2-id--agroland-page-title-settings").show();
            if ($agroland_page_title_settings.val() == 'default') {
                $(".cmb2-id--agroland-custom-page-title").hide();
            } else {
                $(".cmb2-id--agroland-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--agroland-page-title-settings").hide();
            $(".cmb2-id--agroland-custom-page-title").hide();

        }
    });

    //page settings
    $agroland_page_settings.on("change", function () {
        if ($(this).val() == 'global') {
            $(".cmb2-id--agroland-breadcumb-image").hide();
            $(".cmb2-id--agroland-page-title").hide();
            $(".cmb2-id--agroland-page-title-settings").hide();
            $(".cmb2-id--agroland-custom-page-title").hide();
            $(".cmb2-id--agroland-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--agroland-breadcumb-image").show();
            $(".cmb2-id--agroland-page-title").show();
            $(".cmb2-id--agroland-page-breadcrumb-trigger").show();

            if ($agroland_page_title.val() == '1') {
                $(".cmb2-id--agroland-page-title-settings").show();
                if ($agroland_page_title_settings.val() == 'default') {
                    $(".cmb2-id--agroland-custom-page-title").hide();
                } else {
                    $(".cmb2-id--agroland-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--agroland-page-title-settings").hide();
                $(".cmb2-id--agroland-custom-page-title").hide();

            }
        }
    });

    // page title settings
    $agroland_page_title_settings.on("change", function () {
        if ($(this).val() == 'default') {
            $(".cmb2-id--agroland-custom-page-title").hide();
        } else {
            $(".cmb2-id--agroland-custom-page-title").show();
        }
    });

})(jQuery);