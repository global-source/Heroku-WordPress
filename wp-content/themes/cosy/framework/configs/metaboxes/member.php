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
function cosy_metaboxes_section_member( $sections )
{
    $sections['member'] = array(
        'name'      => 'member',
        'title'     => esc_html__('Member Information', 'cosy'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'    => 'role',
                'type'  => 'text',
                'title' => esc_html__('Role', 'cosy'),
            ),
            array(
                'id'    => 'phone',
                'type'  => 'text',
                'title' => esc_html__('Phone Number', 'cosy'),
            ),
            array(
                'id'    => 'facebook',
                'type'  => 'text',
                'title' => esc_html__('Facebook URL', 'cosy'),
            ),
            array(
                'id'    => 'twitter',
                'type'  => 'text',
                'title' => esc_html__('Twitter URL', 'cosy'),
            ),
            array(
                'id'    => 'pinterest',
                'type'  => 'text',
                'title' => esc_html__('Pinterest URL', 'cosy'),
            ),
            array(
                'id'    => 'linkedin',
                'type'  => 'text',
                'title' => esc_html__('LinkedIn URL', 'cosy'),
            ),
            array(
                'id'    => 'dribbble',
                'type'  => 'text',
                'title' => esc_html__('Dribbble URL', 'cosy'),
            ),
            array(
                'id'    => 'google_plus',
                'type'  => 'text',
                'title' => esc_html__('Google Plus URL', 'cosy'),
            ),
            array(
                'id'    => 'youtube',
                'type'  => 'text',
                'title' => esc_html__('Youtube URL', 'cosy'),
            ),
            array(
                'id'    => 'email',
                'type'  => 'text',
                'title' => esc_html__('Email Address', 'cosy'),
            )
        )
    );
    return $sections;
}