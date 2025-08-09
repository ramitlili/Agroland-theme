<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// OnScroll Controls
$element->add_control(
    'animejs_onscroll_scene',
    [
        'label' => __( 'Parent scene', 'genixcore' ),
        'description' => 'Select your section parent scene by a CSS Selector that defines the start of the scroll animation. If undefined the scene will start right at the start of the page ',
        'type' => \Elementor\Controls_Manager::TEXT,
		'ai' => [
			'active' => false,
		],
        'condition' => [
            'animejs_animation_type' => 'onscroll',
        ],
    ]
);

$element->add_control(
    'animejs_onscroll_viewport',
    [
        'label' => esc_html__( 'Start from', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'top' => [
                'title' => esc_html__( 'Top', 'genixcore' ),
                'icon' => 'eicon-v-align-top',
            ],
            'center' => [
                'title' => esc_html__( 'Center', 'genixcore' ),
                'icon' => 'eicon-v-align-middle',
            ],
            'end' => [
                'title' => esc_html__( 'Bottom', 'genixcore' ),
                'icon' => 'eicon-v-align-bottom',
            ],
        ],
        'default' => 'end',
        'toggle' => false,
        'condition' => [
            'animejs_animation_type' => 'onscroll',
        ],
    ]
);

$element->add_control(
    'animejs_onscroll_duration',
    [
        'label' => esc_html__( 'Duration (%)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['%'],
        'range' => [
            '%' => [
                'min' => 0,
                'max' => 1000,
            ],
        ],
        'default' => [
            'unit' => ['%'],
            'size' => 150,
        ],
        'condition' => [
            'animejs_animation_type' => 'onscroll',
        ],
    ]
);

$element->add_control(
    'animejs_onscroll_offset',
    [
        'label' => esc_html__( 'Offset (px)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => -999,
        'max' => 999,
        'step' => 10,
        'default' => 0,
        'condition' => [
            'animejs_animation_type' => 'onscroll',
        ],
    ]
);

$element->add_control(
    'animejs_onscroll_reverse',
    [
        'label' => esc_html__( 'Reverse animation', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'genixcore' ),
        'label_off' => esc_html__( 'No', 'genixcore' ),
        'default' => 'no',
        'condition' => [
            'animejs_animation_type' => 'onscroll',
        ],
    ]
);