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
function cosy_metaboxes_section_layout( $sections )
{
    $sections['layout'] = array(
        'name'      => 'layout',
        'title'     => esc_html__('Layout', 'cosy'),
        'icon'      => 'laicon-tools',
        'fields'    => array(
            array(
                'id'        => 'layout',
                'type'      => 'image_select',
                'title'     => esc_html__('Layout', 'cosy'),
                'desc'      => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'cosy'),
                'default'   => 'inherit',
                'radio'     => true,
                'options'   => Cosy_Options::get_config_main_layout_opts(true, true)
            ),
            array(
                'id'        => 'small_layout',
                'type'      => 'radio',
                'class'     => 'la-radio-style elm-show-pagenow-post',
                'default'   => 'inherit',
                'title'     => esc_html__('Enable Small Layout', 'cosy'),
                'dependency' => array('layout_col-1c', '==', 'true'),
                'options'   => array(
                    'inherit'        => esc_html__('Inherit', 'cosy'),
                    'on'        => esc_html__('On', 'cosy'),
                    'off'       => esc_html__('Off', 'cosy')
                )
            ),
            array(
                'id'        => 'main_full_width',
                'type'      => 'radio',
                'class'     => 'la-radio-style',
                'default'   => 'inherit',
                'title'     => esc_html__('100% Main Width', 'cosy'),
                'desc'      => esc_html__('Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'cosy'),
                'options'   => Cosy_Options::get_config_radio_opts()
            ),
            array(
                'id'            => 'main_space',
                'type'          => 'spacing',
                'title'         => esc_html__('Custom Main Space', 'cosy'),
                'desc'          => esc_html__('Leave empty if you not need', 'cosy'),
                'unit' 	        => 'px'
            ),
            array(
                'id'            => 'sidebar',
                'type'          => 'select',
                'title'         => esc_html__('Override Sidebar', 'cosy'),
                'desc'          => esc_html__('Select sidebar that will display on this page.', 'cosy'),
                'class'         => 'chosen',
                'options'       => 'sidebars',
                'default_option'=> esc_html__('Inherit', 'cosy'),
                'dependency'    => array('layout_col-1c', '!=', '1')
            ),
            array(
                'id'            => 'main_menu',
                'type'          => 'select',
                'title'         => esc_html__('Main Menu','cosy'),
                'class'         => 'chosen',
                'options'       => 'tags',
                'query_args'    => array(
                    'orderby'   => 'name',
                    'order'     => 'ASC',
                    'taxonomies'=>  'nav_menu'
                ),
                'default_option'=> esc_html__('Inherit', 'cosy')
            )
        )
    );
    return $sections;
}