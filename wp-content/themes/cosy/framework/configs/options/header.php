<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Header settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_header( $sections ) {
    $sections['header'] = array(
        'name'          => 'header_panel',
        'title'         => esc_html__('Header', 'cosy'),
        'icon'          => 'fa fa-arrow-up',
        'sections' => array(
            array(
                'name'      => 'header_layout_sections',
                'title'     => esc_html__('Layout', 'cosy'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_layout',
                        'title'     => esc_html__('Header Layout', 'cosy'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'class'     => 'la-radio-style',
                        'default'   => '1',
                        'desc'      => esc_html__('Controls the general layout of the header.', 'cosy'),
                        'options'   => Cosy_Options::get_config_header_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'header_full_width',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html__('100% Header Width', 'cosy'),
                        'desc'      => esc_html__('Turn on to have the header area display at 100% width according to the window size. Turn off to follow site width.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_opts(false),
                        'info'      => esc_html__('This option do not allow for header type 4,5', 'cosy')
                    ),
                    array(
                        'id'        => 'header_transparency',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html__('Header Transparency', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_opts(false),
                        'info'      => esc_html__('This option do not allow for header type 4,5', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'header_element_sections',
                'title'     => esc_html__('Elements', 'cosy'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_show_cart',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html__('Header Shopping Cart', 'cosy'),
                        'desc'      => esc_html__('Show/Hide Shopping Cart in the Header.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'header_show_search',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html__('Header Search Form', 'cosy'),
                        'desc'      => esc_html__('Show/Hide Search Form in the Header.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'header_show_wishlist',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html__('Header Wishlist Icon', 'cosy'),
                        'desc'      => esc_html__('Show/Hide Wishlist Icon in the Header.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_opts(false)
                    )
                )
            ),
            array(
                'name'      => 'header_default_styling_sections',
                'title'     => esc_html__('Default Header Styling', 'cosy'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => '#fff'
                        ),
                        'title'     => esc_html__('Background', 'cosy'),
                        'desc'      => esc_html__('for default header', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_text_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'title'     => esc_html__('Text Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_link_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'title'     => esc_html__('Link Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'title'     => esc_html__('Link Hover Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'title'     => esc_html__('Menu Level 1 Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html__('Menu Level 1 Background Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'title'     => esc_html__('Menu Level 1 Hover Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html__('Menu Level 1 Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For default header', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'header_top_styling_sections',
                'title'     => esc_html__('Header Top Styling', 'cosy'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_top_background_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html__('Header Top Background Color', 'cosy'),
                        'desc'      => esc_html__('For default header top', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_top_text_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(255,255,255,0.2)',
                        'title'     => esc_html__('Header Top Text Color', 'cosy'),
                        'desc'      => esc_html__('For default header top', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_top_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html__('Header Top Link Color', 'cosy'),
                        'desc'      => esc_html__('For default header top', 'cosy'),
                    ),
                    array(
                        'id'        => 'header_top_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'title'     => esc_html__('Header Top Link Hover Color', 'cosy'),
                        'desc'      => esc_html__('For default header top', 'cosy'),
                    )
                )
            ),
            array(
                'name'      => 'header_transparency_styling_sections',
                'title'     => esc_html__('Transparency Header Styling', 'cosy'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'transparency_header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => 'rgba(0,0,0,0)'
                        ),
                        'title'     => esc_html__('Background', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_header_text_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html__('Text Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_header_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html__('Link Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'title'     => esc_html__('Link Hover Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html__('Menu Level 1 Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html__('Menu Level 1 Background Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'title'     => esc_html__('Menu Level 1 Hover Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html__('Menu Level 1 Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For transparency header', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'header_offcanvas_styling_sections',
                'title'     => esc_html__('Aside Menu Styling', 'cosy'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'offcanvas_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Background Color', 'cosy'),
                        'desc'      => esc_html__('For Aside Header', 'cosy')
                    ),
                    array(
                        'id'        => 'offcanvas_text_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Text color', 'cosy'),
                        'desc'      => esc_html__('For Aside Header', 'cosy')
                    ),
                    array(
                        'id'        => 'offcanvas_heading_color',
                        'default'   => Cosy_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Heading color', 'cosy'),
                        'desc'      => esc_html__('For Aside Header', 'cosy')
                    ),
                    array(
                        'id'        => 'offcanvas_link_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link color', 'cosy'),
                        'desc'      => esc_html__('For Aside Header', 'cosy')
                    ),
                    array(
                        'id'        => 'offcanvas_link_hover_color',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Hover color', 'cosy'),
                        'desc'      => esc_html__('For Aside Header', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'header_megamenu_styling_sections',
                'title'     => esc_html__('Mega Menu Styling', 'cosy'),
                'icon'      => 'fa fa-bars',
                'fields'    => array(
                    array(
                        'id'        => 'mm_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "DropDown"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_color',
                        'default'   => Cosy_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Color', 'cosy'),
                        'desc'      => esc_html__('For type "DropDown"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "DropDown"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Hover Color', 'cosy'),
                        'desc'      => esc_html__('For type "DropDown"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "DropDown"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_heading_color',
                        'default'   => Cosy_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Heading Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_color',
                        'default'   => Cosy_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Hover Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Link Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For type "Wide"', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'header_mobile_styling_sections',
                'title'     => esc_html__('Header Mobile', 'cosy'),
                'icon'      => 'fa fa-bars',
                'fields'    => array(
                    array(
                        'id'        => 'header_mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Header', 'cosy')
                    ),
                    array(
                        'id'        => 'header_mb_text_color',
                        'default'   => Cosy_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Text Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Header', 'cosy')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html__('Mobile Menu Styling', 'cosy'))
                    ),
                    array(
                        'id'        => 'mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_1_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 1 Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_1_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 1 Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_color',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 1 Hover Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 1 Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_2_color',
                        'default'   => Cosy_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 2 Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_2_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 2 Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_color',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 2 Hover Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_bg_color',
                        'default'   => Cosy_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html__('Menu Level 2 Hover Background Color', 'cosy'),
                        'desc'      => esc_html__('For Mobile Menu', 'cosy')
                    )
                )
            )
        )
    );
    return $sections;
}