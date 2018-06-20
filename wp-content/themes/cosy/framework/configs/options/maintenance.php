<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Blog settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_maintenance( $sections )
{
    $sections['maintenance'] = array(
        'name' => 'maintenance_panel',
        'title' => esc_html__('Maintenance', 'cosy'),
        'icon' => 'fa fa-lock',
        'fields' => array(
            array(
                'id'        => 'enable_maintenance',
                'type'      => 'radio',
                'default'   => 'no',
                'class'     => 'la-radio-style',
                'title'     => esc_html__('Enable Maintenance Mode', 'cosy'),
                'desc'      => esc_html__('Turn on to make your website to be private', 'cosy'),
                'options'   => array(
                    'no'    => esc_html__('No', 'cosy'),
                    'yes'   => esc_html__('Yes', 'cosy')
                )
            ),
            array(
                'id'        => 'maintenance_page',
                'type'      => 'select',
                'title'     => esc_html__('Maintenance Page', 'cosy'),
                'options'   => 'pages',
                'query_args'    => array(
                    'posts_per_page'  => -1
                ),
                'default_option' => esc_html__('Select a page', 'cosy'),
                'dependency'   => array( 'enable_maintenance_yes', '==', 'true' )
            )
        )
    );
    return $sections;
}