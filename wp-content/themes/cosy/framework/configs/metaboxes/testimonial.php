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
function cosy_metaboxes_section_testimonial( $sections )
{
    $sections['testimonial'] = array(
        'name'      => 'testimonial',
        'title'     => esc_html__('Information', 'cosy'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'    => 'role',
                'type'  => 'text',
                'title' => esc_html__('Role', 'cosy'),
            ),
            array(
                'id'    => 'content',
                'type'  => 'textarea',
                'title' => esc_html__('Content', 'cosy'),
            ),
            array(
                'id'    => 'avatar',
                'type'  => 'image',
                'title' => esc_html__('Avatar', 'cosy'),
            )
        )
    );
    return $sections;
}