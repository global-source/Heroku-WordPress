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
function cosy_metaboxes_section_post( $sections )
{
    $sections['post'] = array(
        'name'      => 'post',
        'title'     => esc_html__('Post', 'cosy'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html__('For post format QUOTE', 'cosy')
            ),
            array(
                'id'            => 'format_quote_content',
                'type'          => 'textarea',
                'title'         => esc_html__('Quote Content', 'cosy')
            ),
            array(
                'id'            => 'format_quote_author',
                'type'          => 'text',
                'title'         => esc_html__('Quote Author', 'cosy')
            ),
            array(
                'id'            => 'format_quote_background',
                'type'          => 'color_picker',
                'title'         => esc_html__('Quote Background Color', 'cosy'),
                'default'       => '#343538'
            ),
            array(
                'id'            => 'format_quote_color',
                'type'          => 'color_picker',
                'title'         => esc_html__('Quote Text Color', 'cosy'),
                'default'       => '#fff'
            ),

            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html__('For post format LINK', 'cosy')
            ),
            array(
                'id'            => 'format_link',
                'type'          => 'text',
                'title'         => esc_html__('Custom Link', 'cosy')
            ),

            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html__('For post format VIDEO & AUDIO', 'cosy')
            ),
            array(
                'id'            => 'format_embed',
                'type'          => 'textarea',
                'title'         => esc_html__('Embed Code', 'cosy'),
                'desc'          => esc_html__('Insert Youtube or Vimeo or Audio embed code.', 'cosy'),
                'sanitize'      => false
            ),
            array(
                'id'             => 'format_embed_aspect_ration',
                'type'           => 'select',
                'title'          => esc_html__('Embed aspect ration', 'cosy'),
                'options'        => array(
                    'origin'        => 'origin',
                    '169'           => '16:9',
                    '43'            => '4:3',
                    '235'           => '2.35:1'
                )
            ),
            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html__('For post format GALLERY', 'cosy')
            ),
            array(
                'id'            => 'format_gallery',
                'type'          => 'gallery',
                'title'         => esc_html__('Gallery Images', 'cosy')
            )
        )
    );
    return $sections;
}