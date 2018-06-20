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
function cosy_options_section_private_shop( $sections )
{
    $sections['private_shop'] = array(
        'name' => 'private_panel',
        'title' => esc_html__('Private Shop', 'cosy'),
        'icon' => 'fa fa-user-secret',
        'fields' => array(
            array(
                'id'        => 'enable_private_shop',
                'type'      => 'radio',
                'default'   => 'no',
                'class'     => 'la-radio-style',
                'title'     => esc_html__('Enable Private Shop', 'cosy'),
                'desc'      => esc_html__('Turn on to make your shop to be private (This option do not working with Maintenance was enabled)', 'cosy'),
                'options'   => array(
                    'no'    => esc_html__('No', 'cosy'),
                    'yes'   => esc_html__('Yes', 'cosy')
                )
            ),
            array(
                'id'        => 'private_login_page',
                'type'      => 'select',
                'title'     => esc_html__('Select Login Page', 'cosy'),
                'options'   => 'pages',
                'query_args'    => array(
                    'posts_per_page'  => -1
                ),
                'dependency'   => array( 'enable_private_shop_yes', '==', 'true' )
            )
        )
    );
    return $sections;
}