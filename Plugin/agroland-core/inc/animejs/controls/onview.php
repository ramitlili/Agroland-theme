<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// OnView Controls
$element->add_control(
    'animejs_onview_trigger_viewport',
    [
        'label' => __( 'Trigger Viewport', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => -100,
        'condition' => [
            'animejs_animation_type' => 'onview',
        ],
    ]
);

$element->add_control(
    'animejs_onview_direction',
    [
        'label' => esc_html__( 'Direction', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'normal' => [
                'title' => esc_html__( 'Normal', 'genixcore' ),
                'icon' => 'eicon-long-arrow-right',
            ],
            'alternate' => [
                'title' => esc_html__( 'Alternate', 'genixcore' ),
                'icon' => 'eicon-exchange',
            ],
            'reverse' => [
                'title' => esc_html__( 'Reverse', 'genixcore' ),
                'icon' => 'eicon-undo',
            ],
        ],
        'default' => 'normal',
        'toggle' => false,
        'condition' => [
            'animejs_animation_type' => 'onview',
        ],
    ]
);

$element->add_control(
    'animejs_onview_repeat',
    [
        'label' => esc_html__( 'Loop', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'genixcore' ),
        'label_off' => esc_html__( 'No', 'genixcore' ),
        'return_value' => 'yes',
        'default' => '',
        'condition' => [
            'animejs_animation_type' => 'onview',
        ],
    ]
);

$element->add_control(
    'animejs_onview_targets',
    [
        'label' => __( 'Targets', 'genixcore' ),
        'description' => 'A CSS Selector to target child elements, keep it empty if you want this animation apply to the current element.',
        'type' => \Elementor\Controls_Manager::TEXT,
		'ai' => [
			'active' => false,
		],
        'condition' => [
            'animejs_animation_type' => 'onview',
        ],
    ]
);

$element->add_control(
    'animejs_onview_staggering',
    [
        'label' => __( 'Staggering Delay (ms)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 100,
        'condition' => [
            'animejs_animation_type' => 'onview',
            'animejs_onview_targets!' => '',
        ],
    ]
);

$element->add_control(
    'animejs_onview_staggering_from',
    [
        'label' => __( 'From', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'first' => __( 'First', 'genixcore' ),
            'center' => __( 'Center', 'genixcore' ),
            'last' => __( 'Last', 'genixcore' ),
        ],
        'default' => 'first',
        'condition' => [
            'animejs_animation_type' => 'onview',
            'animejs_onview_targets!' => '',
        ],
    ]
);

$element->add_control(
    'animejs_onview_staggering_start_after',
    [
        'label' => __( 'Start after (ms)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 500,
        'condition' => [
            'animejs_animation_type' => 'onview',
            'animejs_onview_targets!' => '',
        ],
    ]
);