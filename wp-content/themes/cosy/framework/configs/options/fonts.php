<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Fonts settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_fonts( $sections )
{
    $sections['fonts'] = array(
        'name'          => 'fonts_panel',
        'title'         => esc_html__('Typography', 'cosy'),
        'icon'          => 'fa fa-font',
        'fields'        => array(
            array(
                'id'        => 'body_font_size',
                'type'      => 'slider',
                'default'    => 16,
                'title'     => esc_html__( 'Body Font Size', 'cosy' ),
                'options'   => array(
                    'step'    => 1,
                    'min'     => 10,
                    'max'     => 20,
                    'unit'    => 'px'
                )
            ),
            array(
                'id'        => 'font_source',
                'type'      => 'radio',
                'default'   => '1',
                'title'     => esc_html__('Font Sources', 'cosy'),
                'options'   => array(
                    '1' => esc_html__('Standard + Google Webfonts', 'cosy'),
                    '2' => esc_html__('Google Custom', 'cosy'),
                    '3' => esc_html__('Adobe Typekit', 'cosy'),
                )
            ),
            array(
                'id'        => 'main_font',
                'type'      => 'typography',
                'default'   => array(
                    'family' => esc_html__('Roboto Condensed', 'cosy'),
                    'font' => 'google',
                ),
                'title' => esc_html__('Body Font', 'cosy'),
                'dependency' => array('font_source_1', '==', 'true'),
                'variant' => 'multi'
                //'variant' => 'multi'
            ),
            array(
                'id'        => 'secondary_font',
                'type'      => 'typography',
                'default'   => array(
                    'family' => esc_html__('Roboto Condensed', 'cosy'),
                    'font' => 'google',
                ),
                'title' => esc_html__('Heading Font', 'cosy'),
                'dependency' => array('font_source_1', '==', 'true'),
                'variant' => 'multi'
            ),
            array(
                'id'        => 'highlight_font',
                'type'      => 'typography',
                'default'   => array(
                    'family' => esc_html__('Playfair Display', 'cosy'),
                    'font' => 'google',
                ),
                'title' => esc_html__('Three Font', 'cosy'),
                'dependency' => array('font_source_1', '==', 'true'),
                'variant' => 'multi'
            ),
            array(
                'id'            => 'font_google_code',
                'type'          => 'text',
                'title'         => esc_html__('Font Google code', 'cosy'),
                'dependency'    => array('font_source_2', '==', 'true')
            ),
            array(
                'id'            => 'main_google_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Body Google Font Face', 'cosy'),
                'after'         => 'e.g : open sans',
                'desc'          => esc_html__('Enter your Google Font Name for the theme\'s Body Typography', 'cosy'),
                'dependency'    => array('font_source_2', '==', 'true')
            ),
            array(
                'id'            => 'secondary_google_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Heading Google Font Face', 'cosy'),
                'after'         => 'e.g : open sans',
                'desc'          => esc_html__('Enter your Google Font Name for the theme\'s Heading Typography', 'cosy'),
                'dependency'    => array('font_source_2', '==', 'true')
            ),
            array(
                'id'            => 'highlight_google_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Three Google Font Face', 'cosy'),
                'after'         => 'e.g : open sans',
                'desc'          => esc_html__('Enter your Google Font Name for the theme\'s Three Typography', 'cosy'),
                'dependency'    => array('font_source_2', '==', 'true')
            ),
            array(
                'id'            => 'font_typekit_kit_id',
                'type'          => 'text',
                'title'         => esc_html__('Typekit ID', 'cosy'),
                'dependency'    => array('font_source_3', '==', 'true')
            ),
            array(
                'id'            => 'main_typekit_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Body Typekit Font Face', 'cosy'),
                'after'         => 'e.g : futura-pt',
                'desc'          => esc_html__('Enter your Typekit Font Name for the theme\'s Body Typography', 'cosy'),
                'dependency'    => array('font_source_3', '==', 'true')
            ),
            array(
                'id'            => 'secondary_typekit_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Heading Typekit Font Face', 'cosy'),
                'after'         => 'e.g : futura-pt',
                'desc'          => esc_html__('Enter your Typekit Font Name for the theme\'s Heading Typography', 'cosy'),
                'dependency'    => array('font_source_3', '==', 'true')
            ),
            array(
                'id'            => 'highlight_typekit_font_face',
                'type'          => 'text',
                'title'         => esc_html__('Three Typekit Font Face', 'cosy'),
                'after'         => 'e.g : futura-pt',
                'desc'          => esc_html__('Enter your Typekit Font Name for the theme\'s Three Typography', 'cosy'),
                'dependency'    => array('font_source_3', '==', 'true')
            ),

            array(
                'id'        => 'heading_custom_font',
                'type'      => 'radio',
                'default'   => 'no',
                'class'     => 'la-radio-style',
                'title'     => esc_html__('Custom Typography For Heading', 'cosy'),
                'desc'      => esc_html__('Turn on to manager google font for special heading tag H1 -> H6', 'cosy'),
                'options'   => Cosy_Options::get_config_radio_opts(false)
            ),
            array(
                'id'        => 'h1_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H1 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            ),
            array(
                'id'        => 'h2_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H2 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            ),
            array(
                'id'        => 'h3_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H3 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            ),
            array(
                'id'        => 'h4_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H4 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            ),
            array(
                'id'        => 'h5_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H5 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            ),
            array(
                'id'        => 'h6_font',
                'type'      => 'typography',
                'default'   => array(
                    'family'    => esc_html__('Roboto Condensed', 'cosy'),
                    'font'      => 'google',
                ),
                'title'     => esc_html__('H6 Font', 'cosy'),
                'variant'   => true,
                'fz_res'    => true,
                'lh_res'    => true,
                'dependency'=> array('heading_custom_font_yes', '==', 'true')
            )
        )
    );
    return $sections;
}