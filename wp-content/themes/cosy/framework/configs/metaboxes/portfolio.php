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
function cosy_metaboxes_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name'      => 'portfolio',
        'title'     => esc_html__('Portfolio', 'cosy'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'        => 'short_description',
                'type'      => 'textarea',
                'title'     => esc_html__('Short Description', 'cosy')
            ),
            array(
                'id'        => 'portfolio_design',
                'type'      => 'select',
                'title'     => esc_html__('Portfolio Single Design', 'cosy'),
                'options'    => array(
                    'inherit' => esc_html__('Inherit', 'cosy'),
                    '1' => esc_html__('Design 01', 'cosy'),
                    'use_vc' => esc_html__('Show only post content', 'cosy')
                )
            ),
            array(
                'id'        => 'gallery',
                'type'      => 'gallery',
                'title'     => esc_html__('Gallery', 'cosy')
            ),
            array(
                'id'        => 'client',
                'type'      => 'text',
                'title'     => esc_html__('Client Name', 'cosy')
            ),
            array(
                'id'        => 'timeline',
                'type'      => 'text',
                'title'     => esc_html__('Timeline', 'cosy')
            ),
            array(
                'id'        => 'location',
                'type'      => 'text',
                'title'     => esc_html__('Location', 'cosy')
            ),
            array(
                'id'        => 'website',
                'type'      => 'text',
                'title'     => esc_html__('Website', 'cosy')
            )
        )
    );
    return $sections;
}