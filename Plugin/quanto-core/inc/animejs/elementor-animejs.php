<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_AnimeJS_Addon {

    // Hook into Elementor's actions.
    public function __construct() {


        // Register all controls
        add_action( 'elementor/element/after_section_end', [ $this, 'animejs_register_controls' ], 10, 3 );

        // Call frontend scripts and styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'animejs_enqueue_scripts' ] );

        // Call editor scripts and styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'animejs_enqueue_scripts' ] );
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'animejs_enqueue_editor_scripts' ] );

        // Add anime attributes to all elements
        add_action('elementor/element/after_add_attributes', [$this, 'add_anime_attributes']);

    }

    // Enqueue frontend scripts and styles
    public function animejs_enqueue_scripts() {
        wp_enqueue_script( 'animejs-main', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs.min.js', [], '3.2.1', true );
        wp_enqueue_script( 'animejs-scrollmagic', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs-scrollmagic.min.js', [], '3.2.1', true );
        wp_enqueue_script( 'animejs-data-attr-helper', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs-data-attr-helper.js', [ 'jquery', 'animejs-main' ], '1.0.0', true );
        wp_enqueue_script( 'animejs-helper', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs-helper.js', [ 'jquery', 'animejs-main' ], '1.0.0', true );
    }

    public function animejs_enqueue_editor_scripts() {
        wp_enqueue_script( 'animejs-elementor-editor', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs-editor.js', ['jquery', 'elementor-editor', 'animejs-main'], '1.0.0', true );
        wp_enqueue_script( 'animejs-elementor-context-menu', AGROLAND_PLUGDIRURI . 'inc/animejs/js/animejs-context-menu.js', [ 'jquery', 'elementor-editor' ], '1.0.0', true );
    }

    public function animejs_register_controls( $element, $section_id, $args ) {

        // Only add controls to the Advanced tab.
        if ( 'section_effects' !== $section_id ) {
            return;
        }

        $element->start_controls_section(
            'animejs_section',
            [
                'label' =>  __( 'AnimeJS Animations', 'genixcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'animejs_animation_type',
            [
                'label' => __( 'Animation Type', 'genixcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'disable' => __( 'Disable', 'genixcore' ),
                    'onview' => __( 'Appear Effect', 'genixcore' ),
                    'onscroll' => __( 'Scroll Animation', 'genixcore' ),
                ],
                'default' => 'disable',
                'prefix_class' => 'animejs-'
            ]
        );

        $element->add_control(
            'animejs_onview',
            [
                'label' => esc_html__( 'Appear Effects', 'genixcore' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'default' => 'true',
                'condition' => [
                    'animejs_animation_type' => 'onview',
                ],
            ]
        );

        $element->start_popover();
        require 'controls/onview.php';
        $element->end_popover();

        $element->add_control(
            'animejs_onscroll',
            [
                'label' => esc_html__( 'Scroll Animation', 'genixcore' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'genixcore' ),
                'label_on' => esc_html__( 'Custom', 'genixcore' ),
                'return_value' => 'true',
                'default' => 'yes',
                'condition' => [
                    'animejs_animation_type' => 'onscroll',
                ],
            ]
        );

        $element->start_popover();
        require 'controls/onscroll.php';
        $element->end_popover();

        require 'controls/general.php';

        $element->add_control(
            'animejs_devices',
            [
                'label' => esc_html__( 'Trigger on', 'genixcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => [
                    'mobile'  => esc_html__( 'Mobile', 'genixcore' ),
                    'tablet' => esc_html__( 'Tablet', 'genixcore' ),
                    'desktop' => esc_html__( 'Desktop', 'genixcore' ),
                ],
                'default' => [ 'desktop' ],
                'condition' => [
                    'animejs_animation_type!' => 'disable',
                ],
            ]
        );

        $element->end_controls_section();
    }

    public function get_anime_data_string($settings) {
        $data_anime = [];

        if ( $settings['animejs_onscroll_viewport'] === 'top' ) {
            $settings['animejs_onscroll_viewport'] = 0;
        } elseif ( $settings['animejs_onscroll_viewport'] === 'center' ) {
            $settings['animejs_onscroll_viewport'] = 0.5;
        } else {
            $settings['animejs_onscroll_viewport'] = 1;
        }

        // Animation type (onview or onscroll)
        if ( $settings['animejs_animation_type'] === 'onview' ) {
            $data_anime[] = "onview: " . $settings['animejs_onview_trigger_viewport'];
            if ( $settings['animejs_onview_repeat'] === 'yes' ) {
                $data_anime[] = "loop: true";
            } else {
                $data_anime[] = "loop: false";
            }
            if ( $settings['animejs_onview_direction'] === 'alternate' ) {
                $data_anime[] = "direction: alternate";
            } elseif ( $settings['animejs_onview_direction'] === 'reverse' ) {
                $data_anime[] = "direction: reverse";
            }
        } elseif ( $settings['animejs_animation_type'] === 'onscroll' ) {
            $data_anime[] = "onscroll: " . ( $settings['animejs_onscroll_scene'] ? $settings['animejs_onscroll_scene'] : 'true' );
            $data_anime[] = "onscroll-trigger: " . $settings['animejs_onscroll_viewport'];
            $data_anime[] = "onscroll-duration: " . $settings['animejs_onscroll_duration']['size'] . "%";
            $data_anime[] = "onscroll-offset: " . $settings['animejs_onscroll_offset'];
        }

        // Targets
        if ( ! empty( $settings['animejs_onview_targets'] ) ) {
            $data_anime[] = "targets: " . $settings['animejs_onview_targets'];
        }

        // Animation properties
        $properties = ['opacity', 'translateX', 'translateY', 'scale', 'rotate', 'skew'];
        foreach ( $properties as $prop ) {
            $from = $settings["animejs_animation_from_$prop"];
            $to = $settings["animejs_animation_to_$prop"];
            if ( $from !== '' && $to !== '' ) {
                $data_anime[] = "$prop: [$from, $to]";
            } elseif ( $from !== '' ) {
                $data_anime[] = "$prop: $from";
            } elseif ( $to !== '' ) {
                $data_anime[] = "$prop: $to";
            }
        }

        // Easing
        if ( $settings['animejs_animation_type'] === 'onview' ) {
            $easing = $settings['animejs_animation_easing'];
            if ( $easing === 'custom' ) {
                $easing = $settings['animejs_animation_easing_custom'];
            }
            $data_anime[] = "easing: '$easing'";
        } else {
            $data_anime[] = "easing: linear";
        }

        // Duration and delay
        $data_anime[] = "duration: " . $settings['animejs_animation_speed'];
        $data_anime[] = "delay: " . $settings['animejs_animation_delay'];

        // Staggering
        if ( ! empty( $settings['animejs_onview_targets'] ) && ! empty( $settings['animejs_onview_staggering'] ) ) {
            $stagger = "anime.stagger(" . $settings['animejs_onview_staggering'];
            if ( ! empty( $settings['animejs_onview_staggering_start_after'] ) ) {
                $stagger .= ", {start: " . $settings['animejs_onview_staggering_start_after'];
                if ( ! empty( $settings['animejs_onview_staggering_from'] ) && $settings['animejs_onview_staggering_from'] !== 'first' ) {
                    $stagger .= ", from: '" . $settings['animejs_onview_staggering_from'] . "'";
                }
                $stagger .= "}";
            }
            $stagger .= ")";
            $data_anime[] = "delay: $stagger";
        }

        // Join all properties
        return implode('; ', $data_anime);
    }

    public function add_anime_attributes($element) {
        $settings = $element->get_settings_for_display();

        if ('disable' !== $settings['animejs_animation_type']) {
            $data_anime_string = $this->get_anime_data_string($settings);

            $element->add_render_attribute('_wrapper', 'data-anime', $data_anime_string);
            $element->add_render_attribute('_wrapper', 'class', 'animejs-element');

            // Add selected devices as a data attribute
            if (!empty($settings['animejs_devices'])) {
                $element->add_render_attribute('_wrapper', 'data-anime-devices', implode(',', $settings['animejs_devices']));
            }
        }
    }

}

new Elementor_AnimeJS_Addon();

function console_log($data) { ?>
    <script>
    console.log(<?= json_encode($data); ?>);
    </script>
<?php }