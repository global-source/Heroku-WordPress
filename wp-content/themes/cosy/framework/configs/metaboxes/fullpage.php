<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * MetaBox
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_metaboxes_section_fullpage( $sections )
{
    $sections['fullpage'] = array(
        'name'      => 'fullpage',
        'title'     => esc_html__('Full Page JS', 'cosy'),
        'icon'      => 'laicon-anchor',
        'fields'    => array(
            array(
                'id'            => 'enable_fp',
                'type'          => 'radio',
                'default'       => 'no',
                'class'         => 'la-radio-style',
                'title'         => esc_html__('Enable Full Page', 'cosy'),
                'desc'          => esc_html__('This option just apply for page layout 1 column', 'cosy'),
                'options'       => Cosy_Options::get_config_radio_opts(false)
            ),
            array(
                'id'            => 'fp_section_nav',
                'type'          => 'fieldset',
                'title'         => esc_html__('Navigation', 'cosy'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_navigation',
                        'type'          => 'select',
                        'title'         => esc_html__('Section Navigation', 'cosy'),
                        'desc'          => esc_html__('This parameter determines the position of navigation bar.', 'cosy'),
                        'default'       => 'off',
                        'options'       => array(
                            'off' => esc_html__('Off', 'cosy'),
                            'left' => esc_html__('Left', 'cosy'),
                            'right' => esc_html__('Right', 'cosy')
                        )
                    ),
                    array(
                        'id'            => 'fp_sectionnavigationstyle',
                        'type'          => 'select',
                        'title'         => esc_html__('Section Navigation Style', 'cosy'),
                        'desc'          => esc_html__('This parameter determines section navigation style.', 'cosy'),
                        'default'       => 'default',
                        'options'       => array(
                            '1'               => esc_html__('Style 01', 'cosy'),
                            '2'               => esc_html__('Style 02', 'cosy')
                        ),
                        'dependency'    => array( 'fp_navigation', '!=', 'off' )
                    ),
                    /*
                    array(
                        'id'            => 'fp_showactivetooltip',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Show Active Tooltip', 'cosy'),
                        'desc'          => esc_html__('This parameter shows a persistent tooltip for the actively viewed section in the vertical navigation.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_navigation', '!=', 'off' )
                    ),
                    array(
                        'id'            => 'fp_bigsectionnavigation',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Bigger Navigation', 'cosy'),
                        'desc'          => esc_html__('This parameter sets bigger navigation bullets.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_navigation', '!=', 'off' )
                    ),
                    */
                    array(
                        'id'            => 'fp_slidenavigation',
                        'type'          => 'select',
                        'title'         => esc_html__('Slides Navigation', 'cosy'),
                        'desc'          => esc_html__('This parameter determines the position of landscape navigation bar for sliders.', 'cosy'),
                        'default'       => 'off',
                        'options'       => array(
                            'off'   => esc_html__('Off', 'cosy'),
                            'left'  => esc_html__('Top', 'cosy'),
                            'bottom'   => esc_html__('Bottom', 'cosy')
                        )
                    ),
                    array(
                        'id'            => 'fp_slidenavigationstyle',
                        'type'          => 'select',
                        'title'         => esc_html__('Slide Navigation Style', 'cosy'),
                        'desc'          => esc_html__('This parameter determines section navigation style.', 'cosy'),
                        'default'       => 'default',
                        'options'       => array(
                            '1'               => esc_html__('Style 01', 'cosy'),
                            '2'               => esc_html__('Style 02', 'cosy')
                        ),
                        'dependency'    => array( 'fp_slidenavigation', '!=', 'off' )
                    ),
                    /*
                    array(
                        'id'            => 'fp_bigslidenavigation',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Bigger Slide Navigation', 'cosy'),
                        'desc'          => esc_html__('This parameter sets bigger slide navigation bullets .', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_slidenavigation', '!=', 'off' )
                    ),
                    array(
                        'id'            => 'fp_controlarrows',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Control Arrows', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether to use control arrows for the slides to move right or left.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    */
                    array(
                        'id'            => 'fp_lockanchors',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Lock Anchors', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether anchors in the URL will have any effect.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_animateanchor',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Animate Anchor', 'cosy'),
                        'desc'          => esc_html__('This parameter defines whether the load of the site when given anchor (#) will scroll with animation to its destination.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_keyboardscrolling',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Keyboard Scrolling', 'cosy'),
                        'desc'          => esc_html__('This parameter defines if the content can be navigated using the keyboard.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_recordhistory',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Record History', 'cosy'),
                        'desc'          => esc_html__('This parameter defines whether to push the state of the site to the browsers history, so back button will work on section navigation.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    )
                ),
            ),
            array(
                'id'            => 'fp_section_scroll',
                'type'          => 'fieldset',
                'title'         => esc_html__('Scrolling', 'cosy'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_autoscrolling',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Auto Scrolling', 'cosy'),
                        'desc'          => esc_html__('This parameter defines whether to use the automatic scrolling or the normal one.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_fittosection',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Fit To Section', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether or not to fit sections to the viewport or not.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_fittosectiondelay',
                        'type'          => 'number',
                        'default'       => 1000,
                        'title'         => esc_html__('Fit To Section Delay', 'cosy'),
                        'desc'          => esc_html__('The delay in miliseconds for section fitting.', 'cosy'),
                        'dependency'    => array( 'fp_fittosection_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_scrollbar',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Scroll Bar', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether to use the scrollbar for the site or not.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_scrolloverflow',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Scroll Overflow', 'cosy'),
                        'desc'          => esc_html__('This parameter defines whether or not to create a scroll for the section in case the content is bigger than the height of it.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_hidescrollbars',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Hide Scrollbars', 'cosy'),
                        'desc'          => esc_html__('This parameter hides scrollbar even if the scrolling is enabled inside the sections.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_fadescrollbars',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Fade Scrollbars', 'cosy'),
                        'desc'          => esc_html__('This parameter fades scrollbar when unused.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_interactivescrollbars',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Interactive Scrollbars', 'cosy'),
                        'desc'          => esc_html__('This parameter makes scrollbar draggable and user can interact with it.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_scrolloverflow_yes', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_bigsectionsdestination',
                        'type'          => 'select',
                        'title'         => esc_html__('Big Sections Destination', 'cosy'),
                        'desc'          => esc_html__('This parameter defines how to scroll to a section which size is bigger than the viewport.', 'cosy'),
                        'default'       => 'default',
                        'options'       => array(
                            'default'   => esc_html__('Default', 'cosy'),
                            'top'       => esc_html__('Top', 'cosy'),
                            'bottom'    => esc_html__('Bottom', 'cosy')
                        )
                    ),
                    array(
                        'id'            => 'fp_contvertical',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Continuous Vertical', 'cosy'),
                        'desc'          => esc_html__('This parameter determines vertical scrolling is continuous.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_loopbottom',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Loop Bottom', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether to use the scrollbar for the site or not.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_contvertical_no', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_looptop',
                        'type'          => 'radio',
                        'default'       => 'no',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Loop Top', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether to use the scrollbar for the site or not.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false),
                        'dependency'    => array( 'fp_contvertical_no', '==', 'true' )
                    ),
                    array(
                        'id'            => 'fp_loophorizontal',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Loop Slides', 'cosy'),
                        'desc'          => esc_html__('This parameter defines whether horizontal sliders will loop after reaching the last or previous slide or not.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'fp_easing',
                        'type'          => 'select',
                        'title'         => esc_html__('Easing', 'cosy'),
                        'desc'          => esc_html__('This parameter determines the transition effect.', 'cosy'),
                        'default'       => 'css3_ease',
                        'options'       => array(
                            'css3_ease'             => esc_html__('CSS3 - Ease', 'cosy'),
                            'css3_linear'           => esc_html__('CSS3 - Linear', 'cosy'),
                            'css3_ease-in'          => esc_html__('CSS3 - Ease In', 'cosy'),
                            'css3_ease-out'         => esc_html__('CSS3 - Ease Out', 'cosy'),
                            'css3_ease-in-out'      => esc_html__('CSS3 - Ease In Out', 'cosy'),
                            'js_linear'             => esc_html__('Linear', 'cosy'),
                            'js_swing'              => esc_html__('Swing', 'cosy'),
                            'js_easeInQuad'         => esc_html__('Ease In Quad', 'cosy'),
                            'js_easeOutQuad'        => esc_html__('Ease Out Quad', 'cosy'),
                            'js_easeInOutQuad'      => esc_html__('Ease In Out Quad', 'cosy'),
                            'js_easeInCubic'        => esc_html__('Ease In Cubic', 'cosy'),
                            'js_easeOutCubic'       => esc_html__('Ease Out Cubic', 'cosy'),
                            'js_easeInOutCubic'     => esc_html__('Ease In Out Cubic', 'cosy'),
                            'js_easeInQuart'        => esc_html__('Ease In Quart', 'cosy'),
                            'js_easeOutQuart'       => esc_html__('Ease Out Quart', 'cosy'),
                            'js_easeInOutQuart'     => esc_html__('Ease In Out Quart', 'cosy'),
                            'js_easeInQuint'        => esc_html__('Ease In Quint', 'cosy'),
                            'js_easeOutQuint'       => esc_html__('Ease Out Quint', 'cosy'),
                            'js_easeInOutQuint'     => esc_html__('Ease In Out Quint', 'cosy'),
                            'js_easeInExpo'         => esc_html__('Ease In Expo', 'cosy'),
                            'js_easeOutExpo'        => esc_html__('Ease Out Expo', 'cosy'),
                            'js_easeInOutExpo'      => esc_html__('Ease In Out Expo', 'cosy'),
                            'js_easeInSine'         => esc_html__('Ease In Sine', 'cosy'),
                            'js_easeOutSine'        => esc_html__('Ease Out Sine', 'cosy'),
                            'js_easeInOutSine'      => esc_html__('Ease In Out Sine', 'cosy'),
                            'js_easeInCirc'         => esc_html__('Ease In Circ', 'cosy'),
                            'js_easeOutCirc'        => esc_html__('Ease Out Circ', 'cosy'),
                            'js_easeInOutCirc'      => esc_html__('Ease In Out Circ', 'cosy'),
                            'js_easeInElastic'      => esc_html__('Ease In Elastic', 'cosy'),
                            'js_easeOutElastic'     => esc_html__('Ease Out Elastic', 'cosy'),
                            'js_easeInOutElastic'   => esc_html__('Ease In Out Elastic', 'cosy'),
                            'js_easeInBack'         => esc_html__('Ease In Back', 'cosy'),
                            'js_easeOutBack'        => esc_html__('Ease Out Back', 'cosy'),
                            'js_easeInOutBack'      => esc_html__('Ease In Out Back', 'cosy'),
                            'js_easeInBounce'       => esc_html__('Ease In Bounce', 'cosy'),
                            'js_easeOutBounce'      => esc_html__('Ease Out Bounce', 'cosy'),
                            'js_easeInOutBounce'    => esc_html__('Ease In Out Bounce', 'cosy')
                        )
                    ),
                    array(
                        'id'            => 'fp_scrollingspeed',
                        'type'          => 'number',
                        'default'       => 700,
                        'title'         => esc_html__('Scrolling Speed', 'cosy'),
                        'desc'          => esc_html__('Speed in miliseconds for the scrolling transitions.', 'cosy')
                    )
                )
            ),
            array(
                'id'            => 'fp_section_design',
                'type'          => 'fieldset',
                'title'         => esc_html__('Design', 'cosy'),
                'dependency'    => array( 'enable_fp_yes', '==', 'true' ),
                'wrap_class'    => 'la-fieldset-toggle',
                'un_array'      => true,
                'fields'        => array(
                    array(
                        'id'            => 'fp_verticalcentered',
                        'type'          => 'radio',
                        'default'       => 'yes',
                        'class'         => 'la-radio-style',
                        'title'         => esc_html__('Vertically Centered', 'cosy'),
                        'desc'          => esc_html__('This parameter determines whether to center the content vertically.', 'cosy'),
                        'options'       => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'fp_respwidth',
                        'type'      => 'slider',
                        'default'   => 0,
                        'title'     => esc_html__('Responsive Width', 'cosy' ),
                        'desc'      => esc_html__('Normal scroll will be used under the defined width in pixels. (autoScrolling: false)', 'cosy'),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 1920,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'fp_respheight',
                        'type'      => 'slider',
                        'default'   => 0,
                        'title'     => esc_html__('Responsive Height	', 'cosy' ),
                        'desc'      => esc_html__('Normal scroll will be used under the defined height in pixels. (autoScrolling: false)', 'cosy'),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 5000,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'fp_padding',
                        'type'      => 'spacing',
                        'title'     => esc_html__('Padding', 'cosy'),
                        'desc'      => esc_html__('Defines top/bottom padding for each section. Useful in case of using fixed header/footer', 'cosy'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 0,
                            'bottom' => 0
                        )
                    )
                )
            )
        )
    );
    return $sections;
}