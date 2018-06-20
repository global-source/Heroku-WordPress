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
function cosy_options_section_blog( $sections )
{
    $sections['blog'] = array(
        'name'          => 'blog_panel',
        'title'         => esc_html__('Blog', 'cosy'),
        'icon'          => 'fa fa-newspaper-o',
        'sections' => array(
            array(
                'name'      => 'blog_general_section',
                'title'     => esc_html__('General Blog', 'cosy'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_blog',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Blog Page Layout', 'cosy'),
                        'desc'      => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'cosy'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Cosy_Options::get_config_main_layout_opts(true, true)
                    ),
                    array(
                        'id'        => 'blog_small_layout',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Enable Small Layout', 'cosy'),
                        'dependency' => array('layout_blog_col-1c', '==', 'true'),
                        'options'   => array(
                            'on'        => esc_html__('On', 'cosy'),
                            'off'       => esc_html__('Off', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'page_title_bar_layout_blog',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Page Title Bar', 'cosy'),
                        'desc'      => esc_html__('Turn on to show the page title bar for the assigned blog page in "settings > reading" or blog archive pages', 'cosy'),
                        'options'   => array(
                            'inherit'   => esc_html__('Default', 'cosy'),
                            'on'        => esc_html__('On', 'cosy'),
                            'off'       => esc_html__('Off', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'blog_design',
                        'default'   => 'list_1',
                        'title'     => esc_html__('Blog Design', 'cosy'),
                        'desc'      => esc_html__('Controls the layout for the assigned blog page in "settings > reading" or blog archive pages', 'cosy'),
                        'type'      => 'select',
                        'options'   => array(
                            'list_1'        => esc_html__('List Style', 'cosy'),
                            'grid_1'        => esc_html__('Grid Style', 'cosy')
                        )
                    ),
                    array(
                        'id'      => 'blog_post_column',
                        'default'   => array(
                            'xlg' => 2,
                            'lg' => 2,
                            'md' => 2,
                            'sm' => 1,
                            'xs' => 1,
                            'mb' => 1
                        ),
                        'title'     => esc_html__('Blog Post Columns', 'cosy'),
                        'desc'      => esc_html__('Controls the amount of columns for the grid layout when using it for the assigned blog page in "settings > reading" or blog archive pages or search results page.', 'cosy'),
                        'type'      => 'column_responsive',
                        'dependency' => array('blog_design', '!=', 'list_1'),
                    ),
                    array(
                        'id'        => 'featured_images_blog',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Featured Image on Blog Archive Page', 'cosy'),
                        'desc'      => esc_html__('Turn on to display featured images on the blog or archive pages.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_thumbnail_size2',
                        'type'      => 'text',
                        'default'   => 'full',
                        'title'     => esc_html__('Blog Image Size (Large)', 'cosy'),
                        'dependency' => array('featured_images_blog_on|blog_design', '==|==', 'true|list_1')
                    ),
                    array(
                        'id'        => 'blog_thumbnail_size',
                        'type'      => 'text',
                        'default'   => 'full',
                        'title'     => esc_html__('Blog Image Size', 'cosy'),
                        'dependency' => array('featured_images_blog_on', '==', 'true'),
                        'desc'      => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'cosy')
                    ),
                    array(
                        'id'        => 'format_content_blog',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Format content on Blog Archive Page', 'cosy'),
                        'desc'      => esc_html__('Turn on to display format content on the blog or archive pages.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false),
                        'dependency' => array('featured_images_blog_on', '==', 'true')
                    ),
                    array(
                        'id'        => 'blog_content_display',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'excerpt',
                        'title'     => esc_html__('Blog Content Display', 'cosy'),
                        'desc'      => esc_html__('Controls if the blog content displays an excerpt or full content for the assigned blog page in "settings > reading" or blog archive pages.', 'cosy'),
                        'options'   => array(
                            'excerpt'   => esc_html__('Excerpt', 'cosy'),
                            'full'      => esc_html__('Full Content', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'blog_excerpt_length',
                        'type'      => 'slider',
                        'default'   => 20,
                        'title'     => esc_html__( 'Excerpt Length', 'cosy' ),
                        'desc'      => esc_html__('Controls the number of words in the post excerpts for the assigned blog page in "settings > reading" or blog archive pages.', 'cosy'),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 500,
                            'unit'    => ''
                        ),
                        'dependency' => array('blog_content_display_excerpt', '==', 'true')
                    ),
                    array(
                        'id'        => 'blog_masonry',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Enable Blog Masonry', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false),
                        'dependency' => array('blog_design', '!=', 'list_1'),
                    ),
                    array(
                        'id'        => 'blog_pagination_type',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'pagination',
                        'title'     => esc_html__('Pagination Type', 'cosy'),
                        'desc'      => esc_html__('Controls the pagination type for the assigned blog page in "settings > reading" or blog pages.', 'cosy'),
                        'options'   => array(
                            'pagination' => esc_html__('Pagination', 'cosy'),
                            'infinite_scroll' => esc_html__('Infinite Scroll', 'cosy'),
                            'load_more' => esc_html__('Load More Button', 'cosy')
                        )
                    )
                )
            ),
            array(
                'name'      => 'blog_single_section',
                'title'     => esc_html__('Blog Single Post', 'cosy'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_single_post',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Single Page Layout', 'cosy'),
                        'desc'      => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'cosy'),
                        'default'   => 'inherit',
                        'radio'     => true,
                        'options'   => Cosy_Options::get_config_main_layout_opts(true, true)
                    ),
                    array(
                        'id'        => 'single_small_layout',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Enable Small Layout', 'cosy'),
                        'dependency' => array('layout_single_post_col-1c', '==', 'true'),
                        'options'   => array(
                            'on'        => esc_html__('On', 'cosy'),
                            'off'       => esc_html__('Off', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'page_title_bar_layout_single',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Page Title Bar', 'cosy'),
                        'desc'      => esc_html__('Turn on to show the page title bar for the single post', 'cosy'),
                        'options'   => array(
                            'inherit'   => esc_html__('Default', 'cosy'),
                            'on'        => esc_html__('On', 'cosy'),
                            'off'       => esc_html__('Off', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'featured_images_single',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html__('Featured Image / Video on Single Blog Post', 'cosy'),
                        'desc'      => esc_html__('Turn on to display featured images and videos on single blog posts.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_pn_nav',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Previous/Next Pagination', 'cosy'),
                        'desc'      => esc_html__('Turn on to display the previous/next post pagination for single blog posts.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_post_title',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'below',
                        'title'     => esc_html__('Post Title', 'cosy'),
                        'desc'      => esc_html__('Controls if the post title displays above or below the featured post image or is disabled.', 'cosy'),
                        'options'   => array(
                            'below'        => esc_html__('Below', 'cosy'),
                            'above'        => esc_html__('Above', 'cosy'),
                            'off'          => esc_html__('Disabled', 'cosy')
                        )
                    ),
                    array(
                        'id'        => 'blog_author_info',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Author Info Box', 'cosy'),
                        'desc'      => esc_html__('Turn on to display the author info box below posts.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_social_sharing_box',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Social Sharing Box', 'cosy'),
                        'desc'      => esc_html__('Turn on to display the social sharing box.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_related_posts',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Related Posts', 'cosy'),
                        'desc'      => esc_html__('Turn on to display related posts.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'blog_related_design',
                        'default'   => '1',
                        'title'     => esc_html__('Related Design', 'cosy'),
                        'type'      => 'select',
                        'options'   => array(
                            '1'        => esc_html__('Style 1', 'cosy')
                        ),
                        'dependency' => array('blog_related_posts_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'blog_related_by',
                        'default'   => 'random',
                        'title'     => esc_html__('Related Posts By', 'cosy'),
                        'type'      => 'select',
                        'options'   => array(
                            'category'      => esc_html__('Category', 'cosy'),
                            'tag'           => esc_html__('Tag', 'cosy'),
                            'both'          => esc_html__('Category & Tag', 'cosy'),
                            'random'        => esc_html__('Random', 'cosy')

                        ),
                        'dependency' => array('blog_related_posts_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'blog_related_max_post',
                        'type'      => 'slider',
                        'default'   => 1,
                        'title'     => esc_html__( 'Maximum Related Posts', 'cosy' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 1,
                            'max'     => 10,
                            'unit'    => ''
                        ),
                        'dependency' => array('blog_related_posts_on', '==', 'true')
                    ),
                    array(
                        'id'        => 'blog_comments',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html__('Comments', 'cosy'),
                        'desc'      => esc_html__('Turn on to display comments.', 'cosy'),
                        'options'   => Cosy_Options::get_config_radio_onoff(false)
                    )
                )
            )
        )
    );
    return $sections;
}