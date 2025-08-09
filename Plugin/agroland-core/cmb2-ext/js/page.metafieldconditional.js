(function ($) {
    "use strict";

    let $quanto_page_breadcrumb_area = $("#_quanto_page_breadcrumb_area");
    let $quanto_page_settings = $("#_quanto_page_breadcrumb_settings");
    let $quanto_page_breadcrumb_image = $("#_quanto_breadcumb_image");
    let $quanto_page_title = $("#_quanto_page_title");
    let $quanto_page_title_settings = $("#_quanto_page_title_settings");

    if ($quanto_page_breadcrumb_area.val() == '1') {
        $(".cmb2-id--quanto-page-breadcrumb-settings").show();
        if ($quanto_page_settings.val() == 'global') {
            $(".cmb2-id--quanto-breadcumb-image").hide();
            $(".cmb2-id--quanto-page-title").hide();
            $(".cmb2-id--quanto-page-title-settings").hide();
            $(".cmb2-id--quanto-custom-page-title").hide();
            $(".cmb2-id--quanto-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--quanto-breadcumb-image").show();
            $(".cmb2-id--quanto-page-title").show();
            $(".cmb2-id--quanto-page-breadcrumb-trigger").show();

            if ($quanto_page_title.val() == '1') {
                $(".cmb2-id--quanto-page-title-settings").show();
                if ($quanto_page_title_settings.val() == 'default') {
                    $(".cmb2-id--quanto-custom-page-title").hide();
                } else {
                    $(".cmb2-id--quanto-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--quanto-page-title-settings").hide();
                $(".cmb2-id--quanto-custom-page-title").hide();

            }
        }
    } else {
        $quanto_page_breadcrumb_area.parents('.cmb2-id--quanto-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $quanto_page_breadcrumb_area.on("change", function () {
        if ($(this).val() == '1') {
            $(".cmb2-id--quanto-page-breadcrumb-settings").show();
            if ($quanto_page_settings.val() == 'global') {
                $(".cmb2-id--quanto-breadcumb-image").hide();
                $(".cmb2-id--quanto-page-title").hide();
                $(".cmb2-id--quanto-page-title-settings").hide();
                $(".cmb2-id--quanto-custom-page-title").hide();
                $(".cmb2-id--quanto-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--quanto-breadcumb-image").show();
                $(".cmb2-id--quanto-page-title").show();
                $(".cmb2-id--quanto-page-breadcrumb-trigger").show();

                if ($quanto_page_title.val() == '1') {
                    $(".cmb2-id--quanto-page-title-settings").show();
                    if ($quanto_page_title_settings.val() == 'default') {
                        $(".cmb2-id--quanto-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--quanto-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--quanto-page-title-settings").hide();
                    $(".cmb2-id--quanto-custom-page-title").hide();

                }
            }
        } else {
            $(this).parents('.cmb2-id--quanto-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $quanto_page_title.on("change", function () {
        if ($(this).val() == '1') {
            $(".cmb2-id--quanto-page-title-settings").show();
            if ($quanto_page_title_settings.val() == 'default') {
                $(".cmb2-id--quanto-custom-page-title").hide();
            } else {
                $(".cmb2-id--quanto-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--quanto-page-title-settings").hide();
            $(".cmb2-id--quanto-custom-page-title").hide();

        }
    });

    //page settings
    $quanto_page_settings.on("change", function () {
        if ($(this).val() == 'global') {
            $(".cmb2-id--quanto-breadcumb-image").hide();
            $(".cmb2-id--quanto-page-title").hide();
            $(".cmb2-id--quanto-page-title-settings").hide();
            $(".cmb2-id--quanto-custom-page-title").hide();
            $(".cmb2-id--quanto-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--quanto-breadcumb-image").show();
            $(".cmb2-id--quanto-page-title").show();
            $(".cmb2-id--quanto-page-breadcrumb-trigger").show();

            if ($quanto_page_title.val() == '1') {
                $(".cmb2-id--quanto-page-title-settings").show();
                if ($quanto_page_title_settings.val() == 'default') {
                    $(".cmb2-id--quanto-custom-page-title").hide();
                } else {
                    $(".cmb2-id--quanto-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--quanto-page-title-settings").hide();
                $(".cmb2-id--quanto-custom-page-title").hide();

            }
        }
    });

    // page title settings
    $quanto_page_title_settings.on("change", function () {
        if ($(this).val() == 'default') {
            $(".cmb2-id--quanto-custom-page-title").hide();
        } else {
            $(".cmb2-id--quanto-custom-page-title").show();
        }
    });

})(jQuery);