<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Cosy_Layout {

    public function __construct() {

        add_action( 'cosy/action/before_render_body', array( $this, 'render_pageloader_icon' ), 1);
        add_action( 'cosy/action/before_render_main', array( $this, 'render_additional_block_content_top' ) );
        add_action( 'cosy/action/before_render_main_inner', array( $this, 'render_additional_block_content_inner_top' ) );
        add_action( 'cosy/action/after_render_main_inner', array( $this, 'render_additional_block_content_inner_bottom' ) );
        add_action( 'cosy/action/after_render_main', array( $this, 'render_additional_block_content_bottom' ) );

        add_filter('cosy/filter/sidebar_primary_name', array( $this, 'set_sidebar_name'), 10 );
        add_filter('cosy/filter/main_menu_location', array( $this, 'main_menu_location'), 10 );

        add_action('wp_head', array( $this, 'render_favicon') );
        add_action('admin_head', array( $this, 'render_favicon') );

        add_filter('cosy/get_site_layout', array( $this, 'get_404_layout') );
    }

    public function get_site_layout(){
        $layout = Cosy()->settings->get_setting_by_context('layout', 'col-1c');
        return apply_filters('cosy/get_site_layout', $layout);
    }

    public function get_404_layout( $layout ){
        if(is_404()){
            return 'col-1c';
        }
        return $layout;
    }

    public function get_content_width(){
        return 1170;
    }

    public function get_main_content_css_class( $el_class =  '' ){

        $site_layout = $this->get_site_layout();

        switch($this->get_site_layout()){

            case 'col-2cl':
                $_class = 'col-md-9 col-md-push-3';
                break;
            case 'col-2cr':
                $_class = 'col-md-9';
                break;
            case 'col-2cl-l':
                $_class = 'col-md-8 col-md-push-4';
                break;
            case 'col-2cr-l':
                $_class = 'col-md-8';
                break;
            case 'col-3cl':
                $_class = 'col-md-6';
                break;
            case 'col-3cm':
                $_class = 'col-md-6';
                break;
            case 'col-3cr':
                $_class = 'col-md-6';
                break;
            default:
                $_class = 'col-md-12';
        }

        if($site_layout == 'col-1c'){
            $blog_small_layout = Cosy()->settings->get('blog_small_layout', 'off');

            if(is_singular('post')){
                $single_small_layout_global = Cosy()->settings->get('single_small_layout', 'off');
                $single_small_layout = Cosy()->settings->get_post_meta( get_queried_object_id() , 'small_layout' );
                if($single_small_layout == 'on'){
                    $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                }else{
                    if($single_small_layout_global == 'on'){
                        $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                    }else{
                        if($blog_small_layout == 'on'){
                            $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                        }
                    }
                }
            }
            if(is_tag() || is_category()){
                $blog_archive_small_layout = Cosy()->settings->get_post_meta( get_queried_object_id() , 'small_layout' );
                if($blog_archive_small_layout == 'on'){
                    $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                }else{
                    if($blog_small_layout == 'on'){
                        $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                    }
                }
            }
            if ( !is_front_page() && is_home() ) {
                if($blog_small_layout == 'on'){
                    $_class = 'col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';
                }
            }
        }

        if(!empty($el_class)){
            $_class .= ' ';
            $_class .= $el_class;
        }
        return $_class;
    }

    public function get_main_sidebar_css_class( $el_class = '' ) {
        switch($this->get_site_layout()){
            case 'col-2cl':
                $_class = 'col-md-3 col-md-pull-9';
                break;
            case 'col-2cr':
                $_class = 'col-md-3';
                break;
            case 'col-2cl-l':
                $_class = 'col-md-4 col-md-pull-8';
                break;
            case 'col-2cr-l':
                $_class = 'col-md-4';
                break;
            case 'col-3cl':
                $_class = 'col-md-3';
                break;
            case 'col-3cm':
                $_class = 'col-md-3';
                break;
            case 'col-3cr':
                $_class = 'col-md-3';
                break;
            default:
                $_class = 'hidden';
        }
        if(!empty($el_class)){
            $_class .= ' ';
            $_class .= $el_class;
        }
        return $_class;
    }

    public function get_header_layout(){
        return Cosy()->settings->get_setting_by_context('header_layout', 1);
    }

    public function get_page_title_bar_layout(){
        return Cosy()->settings->get_setting_by_context('page_title_bar_layout', 'hide');
    }

    public function get_footer_layout(){
        return Cosy()->settings->get_setting_by_context('footer_layout', '1col');
    }

    public function render_logo(){
        $logo = Cosy()->settings->get('logo', false);
        $logo2x = Cosy()->settings->get('logo_2x', false);
        $logo_src = $default_logo = Cosy::$template_dir_url . '/assets/images/logo.png';
        $logo_2x_src = false;
        if($logo){
            $logo_src = wp_get_attachment_image_url( $logo, 'full' );
        }
        if(!$logo_src){
            $logo_src = $default_logo;
        }
        if($logo2x){
            $logo_2x_src = wp_get_attachment_image_url( $logo2x, 'full' );
        }
        printf(
            '<img src="%1$s" alt="%2$s"%3$s/>',
            esc_url($logo_src),
            esc_attr(get_bloginfo('name')),
            (false !== $logo_2x_src ? ' srcset="'.esc_url( $logo_2x_src ).' 2x"' : '')
        );
    }

    public function render_transparency_logo(){
        $logo = Cosy()->settings->get('logo_transparency', false);
        $logo2x = Cosy()->settings->get('logo_transparency_2x', false);
        $logo_src = $default_logo = Cosy::$template_dir_url . '/assets/images/logo.png';
        $logo_2x_src = false;
        if($logo){
            $logo_src = wp_get_attachment_image_url( $logo, 'full' );
        }
        if(!$logo_src){
            $logo_src = $default_logo;
        }
        if($logo2x){
            $logo_2x_src = wp_get_attachment_image_url( $logo2x, 'full' );
        }
        printf(
            '<img src="%1$s" alt="%2$s"%3$s/>',
            esc_url($logo_src),
            esc_attr(get_bloginfo('name')),
            (false !== $logo_2x_src ? ' srcset="'.esc_url( $logo_2x_src ).' 2x"' : '')
        );
    }

    public function render_mobile_logo(){
        $logo = Cosy()->settings->get('logo_mobile', false);
        $logo2x = Cosy()->settings->get('logo_mobile_2x', false);
        $logo_src = $default_logo = Cosy::$template_dir_url . '/assets/images/logo.png';
        $logo_2x_src = false;
        if($logo){
            $logo_src = wp_get_attachment_image_url( $logo, 'full' );
        }
        if(!$logo_src){
            $logo_src = $default_logo;
        }
        if($logo2x){
            $logo_2x_src = wp_get_attachment_image_url( $logo2x, 'full' );
        }
        printf(
            '<img src="%1$s" alt="%2$s"%3$s/>',
            esc_url($logo_src),
            esc_attr(get_bloginfo('name')),
            (false !== $logo_2x_src ? ' srcset="'.esc_url( $logo_2x_src ).' 2x"' : '')
        );
    }

    public function render_main_nav( $args = array() ) {
        $default = array(
            'container'     => false,
            'menu_class'    => 'main-menu mega-menu',
            'link_before'   => '<span class="mm-text">',
            'link_after'    => '</span>',
            'fallback_cb'   => array( 'Cosy_MegaMenu_Walker', 'fallback' ),
            'walker'        => new Cosy_MegaMenu_Walker
        );

        $menu_args = array_merge( $default, apply_filters( 'cosy/filter/main_menu_location' , array(
            'theme_location' => 'main-nav'
        )) ,$args );

        do_action('cosy/action/before_render_main_menu');
        wp_nav_menu($menu_args);
        do_action('cosy/action/after_render_main_menu');
    }

    public function render_header_tpl(){
        if(Cosy()->settings->get_setting_by_context('hide_header') == 'yes'){
            return;
        }
        $value = $this->get_header_layout();
        do_action('cosy/action/before_render_header',$value);
        get_template_part('templates/header',$value);
        do_action('cosy/action/after_render_header',$value);
    }

    public function render_header_mobile_tpl(){
        if(Cosy()->settings->get_setting_by_context('hide_header') == 'yes'){
            return;
        }
        get_template_part('templates/header-mobile');
    }

    public function render_page_title_bar_layout_tpl(){
        $value = $this->get_page_title_bar_layout();
        if(!empty($value) && $value != 'hide'){
            do_action('cosy/action/before_render_page_title_bar',$value);
            get_template_part('templates/page-title-bar',$value);
            do_action('cosy/action/after_render_page_title_bar',$value);
        }
    }

    public function render_footer_tpl(){
        if(Cosy()->settings->get_setting_by_context('hide_footer') == 'yes'){
            return;
        }
        $value = $this->get_footer_layout();
        do_action('cosy/action/before_render_footer',$value);
        get_template_part('templates/footer',$value);
        do_action('cosy/action/after_render_footer',$value);
    }

    public function set_sidebar_name( $sidebar ){
        $context = Cosy()->get_current_context();

        if(in_array( 'is_search', $context)){
            if( $sidebar_search = Cosy()->settings->get('search_sidebar', $sidebar) && !empty( $sidebar_search) ) {
                return $sidebar;
            }
        }
        if(in_array('is_category', $context) || in_array( 'is_tag', $context )){
            $sidebar = Cosy()->settings->get('blog_archive_sidebar', $sidebar);

            if( Cosy()->settings->get('blog_archive_global_sidebar', false) ){
                /*
                 * Return global sidebar if option will be enable
                 * We don't need more checking in context
                 */
                return $sidebar;
            }

            $_sidebar = Cosy()->settings->get_term_meta( get_queried_object_id(), 'sidebar');

            if(!empty($_sidebar)){

                return $sidebar;

            }
        }

        if(is_singular('post')){
            $sidebar = Cosy()->settings->get('posts_sidebar', $sidebar);
            if( Cosy()->settings->get('posts_global_sidebar', false) ){
                /*
                 * Return global sidebar if option will be enable
                 * We don't need more checking in context
                 */
                return $sidebar;
            }

            $_sidebar = Cosy()->settings->get_post_meta( get_queried_object_id(), 'sidebar');
            if(!empty($_sidebar)){
                return $sidebar;
            }
        }

        if(in_array('is_tax', $context) && is_tax(get_object_taxonomies( 'la_portfolio' ))){
            $sidebar = Cosy()->settings->get('portfolio_archive_sidebar', $sidebar);
            if( Cosy()->settings->get('portfolio_archive_global_sidebar', false) ){
                /*
                 * Return global sidebar if option will be enable
                 * We don't need more checking in context
                 */
                return $sidebar;
            }
            $_sidebar = Cosy()->settings->get_post_meta( get_queried_object_id(), 'sidebar');
            if(!empty($_sidebar)){
                return $sidebar;
            }
        }

        if(is_singular('la_portfolio')){
            $sidebar = Cosy()->settings->get('portfolio_sidebar', $sidebar);
            if( Cosy()->settings->get('portfolio_global_sidebar', false) ){
                /*
                 * Return global sidebar if option will be enable
                 * We don't need more checking in context
                 */
                return $sidebar;
            }
            $_sidebar = Cosy()->settings->get_post_meta( get_queried_object_id(), 'sidebar');
            if(!empty($_sidebar)){
                return $sidebar;
            }
        }
        if(is_page()){
            $sidebar = Cosy()->settings->get('pages_sidebar', $sidebar);
            if( Cosy()->settings->get('pages_global_sidebar', false) ){
                /*
                 * Return global sidebar if option will be enable
                 * We don't need more checking in context
                 */
                return $sidebar;
            }
            $_sidebar = Cosy()->settings->get_post_meta( get_queried_object_id(), 'sidebar');
            if(!empty($_sidebar)){
                return $sidebar;
            }
        }

        return $sidebar;
    }

    public function main_menu_location( $args ){
        if( $menu_id = Cosy()->settings->get_setting_by_context('main_menu') ){
            if(is_nav_menu($menu_id)){
                if(isset($args['theme_location'])){
                    unset($args['theme_location']);
                }
                $args['menu'] = $menu_id;
            }
        }
        return $args;
    }

    public function render_additional_block_content_top(){
        if( $block_id = (int) Cosy()->settings->get_setting_by_context('block_content_top') ){
            printf( '<div class="la-block-content-top container">%s</div>',
                do_shortcode('[la_block id="'. $block_id .'"]')
            );
        }
        if(is_active_sidebar('la-custom-block-top')){
            echo '<div class="la-block-content-top container">';
                dynamic_sidebar('la-custom-block-top');
            echo '</div>';
        }
    }

    public function render_additional_block_content_inner_top(){
        if( $block_id = (int) Cosy()->settings->get_setting_by_context('block_content_inner_top') ){
            printf( '<div class="la-block-content-inner-top">%s</div>',
                do_shortcode('[la_block id="'. $block_id .'"]')
            );
        }
        if(is_active_sidebar('la-custom-block-inner-top')){
            echo '<div class="la-block-content-top">';
            dynamic_sidebar('la-custom-block-inner-top');
            echo '</div>';
        }
    }

    public function render_additional_block_content_bottom(){
        if( $block_id = (int) Cosy()->settings->get_setting_by_context('block_content_bottom') ){
            printf( '<div class="la-block-content-bottom container">%s</div>',
                do_shortcode('[la_block id="'. $block_id .'"]')
            );
        }
        if(is_active_sidebar('la-custom-block-bottom')){
            echo '<div class="la-block-content-bottom container">';
            dynamic_sidebar('la-custom-block-bottom');
            echo '</div>';
        }
    }

    public function render_additional_block_content_inner_bottom(){
        if( $block_id = (int) Cosy()->settings->get_setting_by_context('block_content_inner_bottom') ){
            printf( '<div class="la-block-content-inner-bottom container">%s</div>',
                do_shortcode('[la_block id="'. $block_id .'"]')
            );
        }
        if(is_active_sidebar('la-custom-block-inner-bottom')){
            echo '<div class="la-block-content-bottom">';
            dynamic_sidebar('la-custom-block-inner-bottom');
            echo '</div>';
        }
    }

    public function render_pageloader_icon(){
        if(Cosy()->settings->get('page_loading_animation', 'off') == 'on'){
            $loading_style = Cosy()->settings->get('page_loading_style', '1');
            if($loading_style == 'custom'){
                if($img = Cosy()->settings->get('page_loading_custom')){
                    echo '<div class="la-image-loading spinner-custom"><div class="content"><div class="la-loader">'. wp_get_attachment_image($img, 'full') .'</div></div></div>';
                }else{
                    echo '<div class="la-image-loading"><div class="content"><div class="la-loader spinner1"></div></div></div>';
                }
            }else{
                echo '<div class="la-image-loading"><div class="content"><div class="la-loader spinner'.esc_attr($loading_style).'"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>';
            }
        }
    }

    public function render_favicon(){
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon'), 'full') ){
                printf('<link rel="apple-touch-icon" sizes="16x16" href="%s"/>', esc_url($favicon));
            }
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon_iphone'), 'full') ){
                printf('<link rel="apple-touch-icon" sizes="57x57" href="%s"/>', esc_url($favicon));
            }
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon_ipad'), 'full') ){
                printf('<link rel="apple-touch-icon" sizes="72x72" href="%s"/>', esc_url($favicon));
            }
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon'), 'full') ){
                printf('<link  rel="shortcut icon" type="image/png" sizes="72x72" href="%s"/>', esc_url($favicon));
            }
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon_iphone'), 'full') ){
                printf('<link  rel="shortcut icon" type="image/png" sizes="57x57" href="%s"/>', esc_url($favicon));
            }
            if( $favicon = wp_get_attachment_image_url(Cosy()->settings->get('favicon_ipad'), 'full') ){
                printf('<link  rel="shortcut icon" type="image/png" sizes="16x16" href="%s"/>', esc_url($favicon));
            }
        }
    }
}