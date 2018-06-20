<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Cosy_Admin {

    public function __construct(){
        $this->init_page_options();
        $this->init_meta_box();
        $this->init_shortcode_manager();
        Cosy_MegaMenu_Init::get_instance();
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts') );
        add_action( 'customize_register', array( $this, 'override_customize_control') );
        add_action( 'registered_post_type', array( $this, 'remove_revslider_metabox') );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu') );
    }

    public function admin_scripts(){
        wp_enqueue_style('cosy-admin-css', Cosy::$template_dir_url. '/assets/admin/css/admin.css');
        wp_enqueue_script('cosy-admin-theme', Cosy::$template_dir_url . '/assets/admin/js/admin.js', array( 'jquery'), false, true );
    }

    public function init_page_options(){
        $options = !empty(Cosy()->options()->sections) ? Cosy()->options()->sections : array();
        if(class_exists('LaStudio_Options')) {
            $settings = array(
                'menu_title' => esc_html__('Theme Options', 'cosy'),
                'menu_type' => 'theme',
                'menu_slug' => 'theme_options',
                'ajax_save' => true,
                'show_reset_all' => true,
                'disable_header' => false,
                'framework_title' => esc_html__('Cosy', 'cosy')
            );
            if(!empty($options)){
                LaStudio_Options::instance( $settings, $options, Cosy::get_option_name());
            }
        }
        if(class_exists('LaStudio_Customize') && function_exists('la_convert_option_to_customize')){
            if(!empty($options)){
                $customize_options = la_convert_option_to_customize($options);
                LaStudio_Customize::instance( $customize_options, Cosy::get_option_name());
            }
        }
    }

    public function init_meta_box(){
        $default_metabox_opts = !empty(Cosy()->options()->metabox_sections) ? Cosy()->options()->metabox_sections : array();
        if(!class_exists('LaStudio_Metabox')){
            return;
        }
        if(empty($default_metabox_opts)){
            return;
        }

        $metaboxes = array();

        /**
         * Pages
         */
        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Page Options', 'cosy'),
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional',
                'fullpage'
            ))
        );

        /**
         * Post
         */
        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Post Options', 'cosy'),
            'post_type' => 'post',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'post',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Product View Options', 'cosy'),
            'post_type' => 'product',
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );
        /**
         * Portfolio
         */
        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Portfolio Options', 'cosy'),
            'post_type' => 'la_portfolio',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'portfolio',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );
        /**
         * Testimonial
         */
        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Testimonial Information', 'cosy'),
            'post_type' => 'la_testimonial',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'testimonial'
            ))
        );

        /**
         * Member
         */

        $metaboxes[] = array(
            'id'        => Cosy::get_original_option_name(),
            'title'     => esc_html__('Page Options', 'cosy'),
            'post_type' => 'la_team_member',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Cosy()->options()->get_metabox_by_sections(array(
                'member',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );
        LaStudio_Metabox::instance($metaboxes);
    }

    public function init_shortcode_manager(){
        if(class_exists('LaStudio_Shortcode_Manager')){
            $options       = array();
            $options[]     = array(
                'title'      => esc_html__('La Shortcodes', 'cosy'),
                'shortcodes' => array(
                    array(
                        'name'      => 'la_text',
                        'title'     => esc_html__('Custom Text', 'cosy'),
                        'fields'    => array(
                            array(
                                'id'    => 'color',
                                'type'  => 'color_picker',
                                'title' => esc_html__('Color', 'cosy')
                            ),
                            array(
                                'id'        => 'font_size',
                                'type'      => 'responsive',
                                'title'     => esc_html__('Font Size', 'cosy'),
                                'desc'      => esc_html__('Enter the font size (ie 20px )', 'cosy')
                            ),
                            array(
                                'id'        => 'line_height',
                                'type'      => 'responsive',
                                'title'     => esc_html__('Line Height', 'cosy'),
                                'desc'      => esc_html__('Enter the line height (ie 20px )', 'cosy')
                            ),
                            array(
                                'id'    => 'el_class',
                                'type'  => 'text',
                                'title' => esc_html__('Extra Class Name', 'cosy')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'textarea',
                                'title' => esc_html__('Content', 'cosy')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_btn',
                        'title'     => esc_html__('Button', 'cosy'),
                        'fields'    => array(
                            array(
                                'id'    => 'title',
                                'type'  => 'text',
                                'title' => esc_html__('Text', 'cosy'),
                                'default' => esc_html__('Text on the button', 'cosy')
                            ),
                            array(
                                'id'        => 'link',
                                'type'      => 'fieldset',
                                'title'     => esc_html__('URL (Link)', 'cosy'),
                                'desc'      => esc_html__('Add link to button.', 'cosy'),
                                'before'    => '<div data-parent-atts="1" data-atts="link" data-atts-separator="|">',
                                'after'     => '</div>',
                                'fields'    => array(
                                    array(
                                        'id'    => 'url',
                                        'type'  => 'text',
                                        'title' => esc_html__('URL', 'cosy'),
                                        'default' => '#',
                                        'attributes' => array(
                                            'data-child-atts' => 'url'
                                        )
                                    ),
                                    array(
                                        'id'    => 'title',
                                        'type'  => 'text',
                                        'title' => esc_html__('Link Text', 'cosy'),
                                        'attributes' => array(
                                            'data-child-atts' => 'title'
                                        )
                                    ),
                                    array(
                                        'id'        => 'target',
                                        'type'      => 'radio',
                                        'default'   => '_self',
                                        'class'     => 'la-radio-style',
                                        'title'     => esc_html__('Open link in a new tab', 'cosy'),
                                        'options'   => array(
                                            '_self' => esc_html__('No', 'cosy'),
                                            '_blank' => esc_html__('Yes', 'cosy')
                                        ),
                                        'attributes' => array(
                                            'data-child-atts' => 'target',
                                            'data-check' => 'yes'
                                        )
                                    ),
                                ),
                            ),

                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html__('Style', 'cosy'),
                                'desc'  => esc_html__('Select button display style.', 'cosy'),
                                'options'        => array(
                                    'flat'          => esc_html__('Flat', 'cosy'),
                                    'outline'       => esc_html__('Outline', 'cosy'),
                                ),
                                'default' => 'flat'
                            ),
                            array(
                                'id'    => 'color',
                                'type'  => 'select',
                                'title' => esc_html__('Color', 'cosy'),
                                'desc'  => esc_html__('Select button color.', 'cosy'),
                                'options'        => array(
                                    'black'      => esc_html__('Black', 'cosy'),
                                    'primary'    => esc_html__('Primary', 'cosy'),
                                    'white'      => esc_html__('White', 'cosy'),
                                    'white2'     => esc_html__('White2', 'cosy'),
                                    'gray'       => esc_html__('Gray', 'cosy'),
                                ),
                                'default' => 'black'
                            ),
                            array(
                                'id'    => 'size',
                                'type'  => 'select',
                                'title' => esc_html__('Size', 'cosy'),
                                'desc'  => esc_html__('Select button display size.', 'cosy'),
                                'options'        => array(
                                    'md'    => esc_html__('Normal', 'cosy'),
                                    'lg'    => esc_html__('Large', 'cosy'),
                                    'sm'    => esc_html__('Small', 'cosy'),
                                    'xs'    => esc_html__('Mini', 'cosy')
                                ),
                                'default' => 'md'
                            ),
                            array(
                                'id'    => 'align',
                                'type'  => 'select',
                                'title' => esc_html__('Alignment', 'cosy'),
                                'desc'  => esc_html__('Select button alignment.', 'cosy'),
                                'options'        => array(
                                    'inline'    => esc_html__('Inline', 'cosy'),
                                    'left'      => esc_html__('Left', 'cosy'),
                                    'right'     => esc_html__('Right', 'cosy'),
                                    'center'    => esc_html__('Center', 'cosy')
                                ),
                                'default' => 'left'
                            ),
                            array(
                                'id'    => 'el_class',
                                'type'  => 'text',
                                'title' => esc_html__('Extra Class Name', 'cosy'),
                                'desc' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cosy')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_dropcap',
                        'title'     => esc_html__('DropCap', 'cosy'),
                        'fields'    => array(
                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html__('Design', 'cosy'),
                                'options'        => array(
                                    '1'          => esc_html__('Style 1', 'cosy')
                                )
                            ),
                            array(
                                'id'    => 'color',
                                'type'  => 'color_picker',
                                'title' => esc_html__('Text Color', 'cosy')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'text',
                                'title' => esc_html__('Content', 'cosy')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_quote',
                        'title'     => esc_html__('Custom Quote', 'cosy'),
                        'fields'    => array(
                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html__('Design', 'cosy'),
                                'options'        => array(
                                    '1'          => esc_html__('Style 1', 'cosy'),
                                    '2'          => esc_html__('Style 2', 'cosy')
                                )
                            ),
                            array(
                                'id'    => 'author',
                                'type'  => 'text',
                                'title' => esc_html__('Source Name', 'cosy')
                            ),
                            array(
                                'id'    => 'link',
                                'type'  => 'text',
                                'title' => esc_html__('Source Link', 'cosy')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'textarea',
                                'title' => esc_html__('Content', 'cosy')
                            )
                        )
                    ),
                    array(
                        'name'          => 'la_icon_list',
                        'title'         => esc_html__('Icon List', 'cosy'),
                        'view'          => 'clone',
                        'clone_id'      => 'la_icon_list_item',
                        'clone_title'   => esc_html__('Add New', 'cosy'),
                        'fields'        => array(
                            array(
                                'id'        => 'el_class',
                                'type'      => 'text',
                                'title'     => esc_html__('Extra Class', 'cosy'),
                                'desc'     => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cosy'),
                            )
                        ),
                        'clone_fields'  => array(
                            array(
                                'id'        => 'icon',
                                'type'      => 'icon',
                                'default'   => 'fa fa-check',
                                'title'     => esc_html__('Icon', 'cosy')
                            ),
                            array(
                                'id'        => 'icon_color',
                                'type'      => 'color_picker',
                                'title'     => esc_html__('Icon Color', 'cosy')
                            ),
                            array(
                                'id'        => 'content',
                                'type'      => 'textarea',
                                'title'     => esc_html__('Content', 'cosy')
                            ),
                            array(
                                'id'        => 'el_class',
                                'type'      => 'text',
                                'title'     => esc_html__('Extra Class', 'cosy'),
                                'desc'     => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cosy'),
                            )
                        )
                    ),
                )
            );
            LaStudio_Shortcode_Manager::instance( $options );
        }
    }

    public function remove_revslider_metabox($post_type){
        add_action('do_meta_boxes', function () use ($post_type) {
            remove_meta_box('mymetabox_revslider_0', $post_type, 'normal');
        });
    }

    public function admin_menu(){
        /*
         * @Todo remove the submenu items
         * @Example: Custom Header,Custom Background
         * We need use global variable `$submenu`
         */

    }

    public function override_customize_control( $wp_customize ) {
        $wp_customize->remove_section('colors');
        $wp_customize->remove_section('header_image');
        $wp_customize->remove_section('background_image');
        $wp_customize->remove_control('display_header_text');
        $wp_customize->remove_control('site_icon');
        $wp_customize->remove_control('custom_css');
    }


    public function admin_init(){
        add_filter('tiny_mce_before_init', array( $this, 'add_control_to_tinymce'));
        add_filter('mce_buttons_2', array( $this, 'add_button_to_tinymce'));
    }

    public function add_button_to_tinymce($buttons){
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }

    public function add_control_to_tinymce($settings){
        $style_formats = array(
            array(
                'title' => esc_html__('Styled Subtitle', 'cosy'),
                'inline' => 'small',
                'classes' => 'small'
            ),
            array(
                'title' => esc_html__('Title H1', 'cosy'),
                'block' => 'div',
                'classes' => 'h1'
            ),
            array(
                'title' => esc_html__('Title H2', 'cosy'),
                'block' => 'div',
                'classes' => 'h2'
            ),
            array(
                'title' => esc_html__('Title H3', 'cosy'),
                'block' => 'div',
                'classes' => 'h3'
            ),
            array(
                'title' => esc_html__('Title H4', 'cosy'),
                'block' => 'div',
                'classes' => 'h4'
            ),
            array(
                'title' => esc_html__('Title H5', 'cosy'),
                'block' => 'div',
                'classes' => 'h5'
            ),
            array(
                'title' => esc_html__('Title H6', 'cosy'),
                'block' => 'div',
                'classes' => 'h6'
            ),
            array(
                'title' => esc_html__('Light Title', 'cosy'),
                'inline' => 'span',
                'classes' => 'light'
            ),
            array(
                'title' => esc_html__('Highlight Font', 'cosy'),
                'inline' => 'span',
                'classes' => 'highlight-font-family'
            )
        );
        $settings['wordpress_adv_hidden'] = false;
        $settings['style_formats'] = json_encode($style_formats);
        return $settings;
    }
}