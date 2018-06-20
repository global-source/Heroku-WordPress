<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Social Media settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_social_media( $sections )
{
    $sections['social_media'] = array(
        'name'          => 'social_panel',
        'title'         => esc_html__('Social Media', 'cosy'),
        'icon'          => 'fa fa fa-share-alt',
        'sections' => array(
            array(
                'name'      => 'social_link_sections',
                'title'     => esc_html__('Social Media Links', 'cosy'),
                'icon'      => 'fa fa-share-alt',
                'fields'    => array(
                    array(
                        'id'        => 'social_links',
                        'type'      => 'group',
                        'title'     => esc_html__('Social Media Links', 'cosy'),
                        'desc'      => esc_html__('Social media links use a repeater field and allow one network per field. Click the "Add" button to add additional fields.', 'cosy'),
                        'button_title'    => esc_html__('Add','cosy'),
                        'accordion_title' => 'title',
                        'fields'    => array(
                            array(
                                'id'        => 'title',
                                'type'      => 'text',
                                'default'   => esc_html__('Title', 'cosy'),
                                'title'     => esc_html__('Title', 'cosy')
                            ),
                            array(
                                'id'        => 'icon',
                                'type'      => 'icon',
                                'default'   => 'fa fa-share',
                                'title'     => esc_html__('Custom Icon', 'cosy')
                            ),
                            array(
                                'id'        => 'link',
                                'type'      => 'text',
                                'default'   => '#',
                                'title'     => esc_html__('Link (URL)', 'cosy')
                            )
                        )
                    )
                )
            ),
            array(
                'name'      => 'social_sharing_sections',
                'title'     => esc_html__('Social Sharing Box', 'cosy'),
                'icon'      => 'fa fa-share-square-o',
                'fields'    => array(
                    array(
                        'id'        => 'sharing_facebook',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Facebook', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Facebook in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_twitter',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Twitter', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Twitter in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_reddit',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Reddit', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Reddit in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_linkedin',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('LinkedIn', 'cosy'),
                        'desc'      => esc_html__('Turn on to display LinkedIn in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_google_plus',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Google+', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Google+ in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_tumblr',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Tumblr', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Tumblr in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_pinterest',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Pinterest', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Pinterest in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_whatsapp',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('WhatsApp', 'cosy'),
                        'desc'      => esc_html__('Turn on to display WhatsApp in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_vk',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('VK', 'cosy'),
                        'desc'      => esc_html__('Turn on to display VK in the social share box.', 'cosy')
                    ),
                    array(
                        'id'        => 'sharing_email',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Email', 'cosy'),
                        'desc'      => esc_html__('Turn on to display Email in the social share box.', 'cosy')
                    )
                )
            )
        )
    );
    return $sections;
}