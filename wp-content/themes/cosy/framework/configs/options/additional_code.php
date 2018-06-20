<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Additional code settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_additional_code( $sections )
{
    $sections['additional_code'] = array(
        'name'          => 'additional_code_panel',
        'title'         => esc_html__('Additional Code', 'cosy'),
        'icon'          => 'fa fa-code',
        'fields'        => array(
            array(
                'id'        => 'google_key',
                'type'      => 'text',
                'title'     => esc_html__('Google API Key', 'cosy'),
                'desc'      => esc_html__('Type your Google API Key here.', 'cosy')
            ),
            array(
                'id'        => 'instagram_token',
                'type'      => 'text',
                'title'     => esc_html__('Instagram Access Token', 'cosy'),
                'info'      => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                    esc_html__('In order to display your photos you need an Access Token from Instagram. To get yours, You can use the button on', 'cosy'),
                    'http://cosy.la-studioweb.com/instagram-token-plugin.php',
                    esc_html__('this page', 'cosy')
                    )
            ),
            array(
                'id'        => 'la_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'class'     => 'la-customizer-section-large',
                'title'     => esc_html__('Custom CSS', 'cosy'),
                'desc'      => esc_html__('Paste your custom CSS code here.', 'cosy'),
            ),
            array(
                'id'        => 'header_js',
                'type'      => 'ace_editor',
                'mode'      => 'javascript',
                'title'     => esc_html__('Header Javascript Code', 'cosy'),
                'desc'      => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'cosy')
            ),
            array(
                'id'        => 'footer_js',
                'type'      => 'ace_editor',
                'mode'      => 'javascript',
                'title'     => esc_html__('Footer Javascript Code', 'cosy'),
                'desc'     => esc_html__('Paste your custom JS code here. The code will be added to the footer of your site.', 'cosy')
            )
        )
    );
    return $sections;
}