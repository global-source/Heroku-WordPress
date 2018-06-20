<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Sidebar settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function cosy_options_section_sidebar( $sections )
{
    $sections['sidebar'] = array(
        'name'          => 'sidebar_panel',
        'title'         => esc_html__('Sidebars', 'cosy'),
        'icon'          => 'fa fa-exchange',
        'sections' => array(
            array(
                'name'      => 'sidebar_add_section',
                'title'     => esc_html__('Add Sidebar', 'cosy'),
                'icon'      => 'fa fa-plus',
                'fields'    => array(
                    array(
                        'id'        => 'add_sidebars',
                        'type'      => 'group',
                        'title'     => esc_html__('Add New Sidebar', 'cosy'),
                        'button_title'    => esc_html__('Add','cosy'),
                        'accordion_title' => 'sidebar_id',
                        'fields'    => array(
                            array(
                                'id'        => 'sidebar_id',
                                'type'      => 'text',
                                'default'   => esc_html__('Sidebar ID', 'cosy'),
                                'title'     => esc_html__('Title', 'cosy')
                            ),
                            array(
                                'id'        => 'sidebar_desc',
                                'type'      => 'text',
                                'title'     => esc_html__('Description', 'cosy')
                            )
                        )
                    )
                )
            ),
            array(
                'name'      => 'sidebar_page_panel',
                'title'     => esc_html__('Pages', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'pages_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Pages', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all pages. This option overrides the page options.', 'cosy')
                    ),
                    array(
                        'id'             => 'pages_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global Page Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all pages.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_portfolio_posts_panel',
                'title'     => esc_html__('Portfolio Posts', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'portfolio_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Portfolio Posts', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all portfolio posts. This option overrides the portfolio post options.', 'cosy')
                    ),
                    array(
                        'id'             => 'portfolio_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global Portfolio Post Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all portfolio posts.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_portfolio_archive_panel',
                'title'     => esc_html__('Portfolio Archive', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'portfolio_archive_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Portfolio Archive', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all portfolio archive & taxonomy. This option overrides the portfolio options.', 'cosy')
                    ),
                    array(
                        'id'             => 'portfolio_archive_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global Portfolio Archive Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all portfolio archive & taxonomy.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_posts_panel',
                'title'     => esc_html__('Blog Posts', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'posts_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Blog Posts', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all blog posts. This option overrides the blog post options.', 'cosy')
                    ),
                    array(
                        'id'             => 'posts_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global Blog Post Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all blog posts.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_blog_post_panel',
                'title'     => esc_html__('Blog Archive', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'blog_archive_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Blog Archive', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all post category & tag. This option overrides the posts options.', 'cosy')
                    ),
                    array(
                        'id'             => 'blog_archive_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global Blog Archive Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all post category & tag.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_search_panel',
                'title'     => esc_html__('Search Page', 'cosy'),
                'fields'    => array(
                    array(
                        'id'             => 'search_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Search Page Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on the search results page.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_products_panel',
                'title'     => esc_html__('Woocommerce Products', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'products_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For WooCommerce Products', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all WooCommerce products. This option overrides the WooCommerce post options.', 'cosy')
                    ),
                    array(
                        'id'             => 'products_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global WooCommerce Product Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all WooCommerce products.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            ),
            array(
                'name'      => 'sidebar_shop_panel',
                'title'     => esc_html__('Woocommerce Archive', 'cosy'),
                'fields'    => array(
                    array(
                        'id'        => 'shop_global_sidebar',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html__('Activate Global Sidebar For Woocommerce Archive', 'cosy'),
                        'desc'      => esc_html__('Turn on if you want to use the same sidebars on all WooCommerce archive( shop,category,tag,search ). This option overrides the WooCommerce taxonomy options.', 'cosy')
                    ),
                    array(
                        'id'             => 'shop_sidebar',
                        'type'           => 'select',
                        'title'          => esc_html__('Global WooCommerce Archive Sidebar', 'cosy'),
                        'desc'           => esc_html__('Select sidebar that will display on all WooCommerce taxonomy.', 'cosy'),
                        'class'          => 'chosen',
                        'options'        => 'sidebars',
                        'default_option' => esc_html__('None', 'cosy')
                    )
                )
            )
        )
    );
    return $sections;
}