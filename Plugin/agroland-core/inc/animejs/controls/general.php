<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// General Controls
$easing_options = [
    'linear' => __( 'Linear', 'genixcore' ),
    'easeInQuad' => __( 'EaseInQuad', 'genixcore' ),
    'easeInCubic' => __( 'EaseInCubic', 'genixcore' ),
    'easeInQuart' => __( 'EaseInQuart', 'genixcore' ),
    'easeInQuint' => __( 'EaseInQuint', 'genixcore' ),
    'easeInSine' => __( 'EaseInSine', 'genixcore' ),
    'easeInExpo' => __( 'EaseInExpo', 'genixcore' ),
    'easeInCirc' => __( 'EaseInCirc', 'genixcore' ),
    'easeInBack' => __( 'EaseInBack', 'genixcore' ),
    'easeOutQuad' => __( 'EaseOutQuad', 'genixcore' ),
    'easeOutCubic' => __( 'EaseOutCubic', 'genixcore' ),
    'easeOutQuart' => __( 'EaseOutQuart', 'genixcore' ),
    'easeOutQuint' => __( 'EaseOutQuint', 'genixcore' ),
    'easeOutSine' => __( 'EaseOutSine', 'genixcore' ),
    'easeOutExpo' => __( 'EaseOutExpo', 'genixcore' ),
    'easeOutCirc' => __( 'EaseOutCirc', 'genixcore' ),
    'easeOutBack' => __( 'EaseOutBack', 'genixcore' ),
    'easeInBounce' => __( 'EaseInBounce', 'genixcore' ),
    'easeInOutQuad' => __( 'EaseInOutQuad', 'genixcore' ),
    'easeInOutCubic' => __( 'EaseInOutCubic', 'genixcore' ),
    'easeInOutQuart' => __( 'EaseInOutQuart', 'genixcore' ),
    'easeInOutQuint' => __( 'EaseInOutQuint', 'genixcore' ),
    'easeInOutSine' => __( 'EaseInOutSine', 'genixcore' ),
    'easeInOutExpo' => __( 'EaseInOutExpo', 'genixcore' ),
    'easeInOutCirc' => __( 'EaseInOutCirc', 'genixcore' ),
    'easeInOutBack' => __( 'EaseInOutBack', 'genixcore' ),
    'easeInOutBounce' => __( 'EaseInOutBounce', 'genixcore' ),
    'easeOutBounce' => __( 'EaseOutBounce', 'genixcore' ),
    'easeOutInQuad' => __( 'EaseOutInQuad', 'genixcore' ),
    'easeOutInCubic' => __( 'EaseOutInCubic', 'genixcore' ),
    'easeOutInQuart' => __( 'EaseOutInQuart', 'genixcore' ),
    'easeOutInQuint' => __( 'EaseOutInQuint', 'genixcore' ),
    'easeOutInSine' => __( 'EaseOutInSine', 'genixcore' ),
    'easeOutInExpo' => __( 'EaseOutInExpo', 'genixcore' ),
    'easeOutInCirc' => __( 'EaseOutInCirc', 'genixcore' ),
    'easeOutInBack' => __( 'EaseOutInBack', 'genixcore' ),
    'easeOutInBounce' => __( 'EaseOutInBounce', 'genixcore' ),
    'custom' => __( 'Custom', 'genixcore' ),
];

$element->add_control(
    'animejs_animation_speed',
    [
        'label' => esc_html__( 'Speed (ms)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 5000,
        'step' => 50,
        'default' => 500,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_delay',
    [
        'label' => esc_html__( 'Delay (ms)', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 5000,
        'step' => 50,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_easing',
    [
        'label' => __( 'Easing', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => $easing_options,
        'default' => 'easeInCubic',
        'condition' => [
            'animejs_animation_type' => 'onview',
        ],
    ]
);

$element->add_control(
    'animejs_animation_easing_custom',
    [
        'label' => __( 'Custom Easing Function', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'cubicBezier(1, 0, 0, 1)',
		'ai' => [
			'active' => false,
		],
        'condition' => [
            'animejs_animation_type' => 'onview',
            'animejs_animation_easing' => 'custom',
        ],
    ]
);

$element->add_control(
    'animejs_animation_enter',
    [
        'label' => esc_html__( 'Enter Animations', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->start_popover();

$element->add_control(
    'animejs_animation_from_opacity',
    [
        'label' => esc_html__( 'Opacity', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 1,
        'step' => 0.1,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_from_translateX',
    [
        'label' => __( 'Translate X', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_from_translateY',
    [
        'label' => __( 'Translate Y', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_from_scale',
    [
        'label' => __( 'Scale', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 1,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_from_rotate',
    [
        'label' => __( 'Rotate', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_from_skew',
    [
        'label' => __( 'Skew', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->end_popover();

$element->add_control(
    'animejs_animation_exit',
    [
        'label' => esc_html__( 'Exit Animations', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->start_popover();

$element->add_control(
    'animejs_animation_to_opacity',
    [
        'label' => esc_html__( 'Opacity', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 1,
        'step' => 0.1,
        'default' => 1,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_to_translateX',
    [
        'label' => __( 'Translate X', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_to_translateY',
    [
        'label' => __( 'Translate Y', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_to_scale',
    [
        'label' => __( 'Scale', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 1,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_to_rotate',
    [
        'label' => __( 'Rotate', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->add_control(
    'animejs_animation_to_skew',
    [
        'label' => __( 'Skew', 'genixcore' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 0,
        'condition' => [
            'animejs_animation_type!' => 'disable',
        ],
    ]
);

$element->end_popover();