<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 * Handle enqueueing scrips.
 */
class Cosy_Scripts
{

    /**
     * The class construction
     */
    public function __construct()
    {

        if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 20);
            add_action('script_loader_tag', array($this, 'add_async'), 10, 2);
        }

        if (class_exists('WooCommerce')) {
            add_filter('woocommerce_enqueue_styles', array($this, 'remove_woo_scripts'));
        }

        add_action('wp_head', array( $this, 'get_custom_css_from_setting'));
        add_action('wp_head', array( $this, 'add_custom_header_js' ), 100 );
        add_action('wp_footer', array( $this, 'add_custom_footer_js' ), 100 );
    }

    /**
     * Takes care of enqueueing all our scripts.
     */
    public function enqueue_scripts()
    {

        $styleNeedRemove = array(
            'yith-woocompare-widget',
            'jquery-selectBox',
            'yith-wcwl-font-awesome',
            'woocomposer-front-slick',
            'jquery-colorbox'
        );
        $scriptNeedRemove = array(
            'woocomposer-slick',
            'vc_jquery_skrollr_js',
            'waypoints'
        );

        foreach ($styleNeedRemove as $style) {
            if (wp_style_is($style, 'registered')) {
                wp_deregister_style($style);
            }
        }
        foreach ($scriptNeedRemove as $script) {
            if (wp_script_is($script, 'registered')) {
                wp_dequeue_script($script);
            }
        }
        $font_source = Cosy()->settings->get('font_source', 1);
        switch ($font_source) {
            case '1':
                wp_enqueue_style('cosy-google_fonts', $this->get_google_font_url(), array(), null);
                break;
            case '2':
                wp_enqueue_style('cosy-font_google_code', $this->get_google_font_code_url(), array(), null);
                break;
            case '3':
                wp_enqueue_style('cosy-font_typekit', $this->get_google_font_typekit_url(), array(), null);
                wp_add_inline_script( 'cosy-font_typekit', 'try{ Typekit.load({ async: true });}catch(e){}' );
                break;
        }


        wp_enqueue_style('font-awesome', Cosy::$template_dir_url . '/assets/css/font-awesome.min.css', array(), null);
        wp_enqueue_style('animate-css', Cosy::$template_dir_url . '/assets/css/animate.min.css', array(), null);
        wp_enqueue_style('cosy-theme', get_template_directory_uri() . '/style.css', array('font-awesome', 'animate-css'), null);

        /*
         * Scripts
         */
        wp_register_script('cosy-libs', Cosy::$template_dir_url . '/assets/js/plugins.js', array('jquery'), null, true);
        $cosy_js_require = array('cosy-libs');
        $fullpage_config = array();
        if (in_array('is_page', Cosy()->get_current_context())) {
            $fp_metadata = Cosy()->settings->get_post_meta(get_the_ID());

            if (Cosy()->layout->get_site_layout() == 'col-1c' && (!empty($fp_metadata['enable_fp']) && $fp_metadata['enable_fp'] == 'yes')) {
                $fp_easing = !empty($fp_metadata['fp_easing']) ? $fp_metadata['fp_easing'] : 'css3_ease';
                $fp_scrolloverflow = !empty($fp_metadata['fp_scrolloverflow']) ? $fp_metadata['fp_scrolloverflow'] : 'no';
                $fullpage_js_require = array('jquery');
                if (substr($fp_easing, 0, 3) == 'js_') {
                    wp_register_script('cosy-easings', Cosy::$template_dir_url . '/assets/js/jquery.easings.min.js', array('jquery'), null, true);
                    $fullpage_js_require[] = 'cosy-easings';
                }
                if ($fp_scrolloverflow == 'yes') {
                    wp_register_script('cosy-scrolloverflow', Cosy::$template_dir_url . '/assets/js/scrolloverflow.min.js', array('jquery'), null, true);
                    $fullpage_js_require[] = 'cosy-scrolloverflow';
                }
                wp_register_script('cosy-fullpage', Cosy::$template_dir_url . '/assets/js/jquery.fullPage.min.js', $fullpage_js_require, null, true);
                $cosy_js_require[] = 'cosy-fullpage';

                $fullpage_config = $this->get_fullpage_config();
            }
        }

        wp_enqueue_script('cosy-theme', Cosy::$template_dir_url . '/assets/js/theme.js', $cosy_js_require, null, true);

        wp_localize_script('cosy-theme', 'cosy_configs', apply_filters('cosy/filter/global_message_js', array(
            'compare' => array(
                'view' => esc_attr__('View List Compare', 'cosy'),
                'success' => esc_attr__('has been added to comparison list.', 'cosy'),
                'error' => esc_attr__('An error occurred ,Please try again !', 'cosy')
            ),
            'wishlist' => array(
                'view' => esc_attr__('View List Wishlist', 'cosy'),
                'success' => esc_attr__('has been added to your wishlist.', 'cosy'),
                'error' => esc_attr__('An error occurred ,Please try again !', 'cosy')
            ),
            'addcart' => array(
                'view' => esc_attr__('View Cart', 'cosy'),
                'success' => esc_attr__('has been added to your cart', 'cosy'),
                'error' => esc_attr__('An error occurred ,Please try again !', 'cosy')
            ),
            'global' => array(
                'error' => esc_attr__('An error occurred ,Please try again !', 'cosy'),
                'comment_author' => esc_attr__('Please enter Name !', 'cosy'),
                'comment_email' => esc_attr__('Please enter Email Address !', 'cosy'),
                'comment_rating' => esc_attr__('Please select a rating !', 'cosy'),
                'comment_content' => esc_attr__('Please enter Comment !', 'cosy'),
                'continue_shopping' => esc_attr__('Continue Shopping', 'cosy'),
            ),
            'text' => array(
                'backtext' => esc_attr__('Back', 'cosy')
            ),
            'instagram_token' => esc_attr(Cosy()->settings->get('instagram_token')),
            'fullpage' => $fullpage_config,
            'popup' => array(
                'max_width' => esc_attr(Cosy()->settings->get('popup_max_width', 790)),
                'max_height' => esc_attr(Cosy()->settings->get('popup_max_height', 430))
            )
        )));

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        wp_add_inline_style('cosy-theme', Cosy_Helper::compress_text($this->dynamic_css(), true));
    }

    /**
     * Removes WooCommerce scripts.
     *
     * @access public
     * @since 1.0
     * @param array $scripts The WooCommerce scripts.
     * @return array
     */
    public function remove_woo_scripts($scripts)
    {

        if (isset($scripts['woocommerce-layout'])) {
            unset($scripts['woocommerce-layout']);
        }
        if (isset($scripts['woocommerce-smallscreen'])) {
            unset($scripts['woocommerce-smallscreen']);
        }
        if (isset($scripts['woocommerce-general'])) {
            unset($scripts['woocommerce-general']);
        }
        return $scripts;

    }

    private function dynamic_css()
    {
        ob_start();
        include Cosy::$template_dir_path . '/framework/functions/additional_css.php';
        include Cosy::$template_dir_path . '/framework/functions/dynamic_css.php';
        return ob_get_clean();
    }

    public function get_custom_css_from_setting(){
        if( $la_custom_css = Cosy()->settings->get('la_custom_css') ){
            printf( '<%1$s id="cosy-extra-custom-css" type="%3$s">%2$s</%1$s>', 'style', $la_custom_css, 'text/css' );
        }
    }

    /**
     * Add async to theme javascript file for performance
     *
     * @param  string $tag The script tag.
     * @param  string $handle The script handle.
     */
    public function add_async($tag, $handle)
    {
        return (in_array($handle, array('la-swatches', 'cosy-theme'))) ? preg_replace('/(><\/[a-zA-Z][^0-9](.*)>)$/', ' async $1 ', $tag) : $tag;
    }

    protected function get_fullpage_config()
    {
        $config = array();
        $metadata = Cosy()->settings->get_post_meta(get_the_ID());
        if (!empty($metadata['fp_navigation']) && $metadata['fp_navigation'] != 'off') {
            $config['navigation'] = true;
            $config['navigationPosition'] = esc_attr($metadata['fp_navigation']);
            $config['showActiveTooltip'] = (!empty($metadata['fp_showactivetooltip']) && $metadata['fp_showactivetooltip'] == 'yes') ? true : false;
        }
        if (!empty($metadata['fp_slidenavigation']) && $metadata['fp_slidenavigation'] != 'off') {
            $config['slidesNavigation'] = true;
            $config['slidesNavPosition'] = esc_attr($metadata['fp_slidenavigation']);
        }
        $config['controlArrows'] = (!empty($metadata['fp_controlarrows']) && $metadata['fp_controlarrows'] == 'yes') ? true : false;
        $config['lockAnchors'] = (!empty($metadata['fp_lockanchors']) && $metadata['fp_lockanchors'] == 'yes') ? true : false;
        $config['animateAnchor'] = (!empty($metadata['fp_animateanchor']) && $metadata['fp_animateanchor'] == 'yes') ? true : false;
        $config['keyboardScrolling'] = (!empty($metadata['fp_keyboardscrolling']) && $metadata['fp_keyboardscrolling'] == 'yes') ? true : false;
        $config['recordHistory'] = (!empty($metadata['fp_recordhistory']) && $metadata['fp_recordhistory'] == 'yes') ? true : false;

        $config['autoScrolling'] = (!empty($metadata['fp_autoscrolling']) && $metadata['fp_autoscrolling'] == 'yes') ? true : false;
        $config['fitToSection'] = (!empty($metadata['fp_fittosection']) && $metadata['fp_fittosection'] == 'yes') ? true : false;
        $config['fitToSectionDelay'] = (!empty($metadata['fp_fittosectiondelay'])) ? absint($metadata['fp_fittosectiondelay']) : 1000;

        $config['scrollBar'] = (!empty($metadata['fp_scrollbar']) && $metadata['fp_scrollbar'] == 'yes') ? true : false;
        $config['scrollOverflow'] = (!empty($metadata['fp_scrolloverflow']) && $metadata['fp_scrolloverflow'] == 'yes') ? true : false;
        if ($config['scrollOverflow']) {
            $config['scrollOverflowOptions'] = array(
                'scrollbars' => (!empty($metadata['fp_hidescrollbars']) && $metadata['fp_hidescrollbars'] == 'yes') ? true : false,
                'fadeScrollbars' => (!empty($metadata['fp_fadescrollbars']) && $metadata['fp_fadescrollbars'] == 'yes') ? true : false,
                'interactiveScrollbars' => (!empty($metadata['fp_interactivescrollbars']) && $metadata['fp_interactivescrollbars'] == 'yes') ? true : false
            );
        }
        if (!empty($metadata['fp_bigsectionsdestination']) && $metadata['fp_bigsectionsdestination'] != 'default') {
            $config['bigSectionsDestination'] = esc_attr($metadata['fp_bigsectionsdestination']);
        }

        if (!empty($metadata['fp_contvertical']) && $metadata['fp_contvertical'] == 'yes') {
            $config['continuousVertical'] = true;
            $config['loopBottom'] = false;
            $config['loopTop'] = false;
        } else {
            $config['continuousVertical'] = false;
            $config['loopBottom'] = (!empty($metadata['fp_loopbottom']) && $metadata['fp_loopbottom'] == 'yes') ? true : false;
            $config['loopTop'] = (!empty($metadata['fp_looptop']) && $metadata['fp_looptop'] == 'yes') ? true : false;
        }

        $config['loopHorizontal'] = (!empty($metadata['fp_loophorizontal']) && $metadata['fp_loophorizontal'] == 'yes') ? true : false;
        $config['scrollingSpeed'] = (!empty($metadata['fp_scrollingspeed'])) ? absint($metadata['fp_scrollingspeed']) : 700;

        $fp_easing = !empty($metadata['fp_easing']) ? $metadata['fp_easing'] : 'css3_ease';
        if (substr($fp_easing, 0, 5) == 'css3_') {
            $config['css3'] = true;
            $config['easing'] = "easeInOutCubic";
            $config['easingcss3'] = substr($fp_easing, 5, strlen($fp_easing));
        } else if (substr($fp_easing, 0, 3) == 'js_') {
            $config['css3'] = false;
            $config['easingcss3'] = "ease";
            $config['easing'] = substr($fp_easing, 3, strlen($fp_easing));
        }

        $config['verticalCentered'] = (!empty($metadata['fp_verticalcentered']) && $metadata['fp_verticalcentered'] == 'yes') ? true : false;
        $config['responsiveWidth'] = (!empty($metadata['fp_respwidth'])) ? absint($metadata['fp_respwidth']) : 0;
        $config['responsiveHeight'] = (!empty($metadata['fp_respheight'])) ? absint($metadata['fp_respheight']) : 0;

        $config['paddingTop'] = (!empty($metadata['fp_padding']['top'])) ? absint($metadata['fp_padding']['top']) . 'px' : '0px';
        $config['paddingBottom'] = (!empty($metadata['fp_padding']['bottom'])) ? absint($metadata['fp_padding']['bottom']) . 'px' : '0px';

        $fixedElements = (!empty($metadata['fp_fixedelements'])) ? esc_attr($metadata['fp_fixedelements']) : "";
        $fixedElements = array_filter(explode(',', $fixedElements));
        $fixedElements = array_merge(array('.la_fp_fixed_top', '.la_fp_fixed_bottom'), $fixedElements);

        $config['fixedElements'] = implode(',', $fixedElements);
        return $config;
    }

    public function get_gfont_from_setting(){
        $array = array();
        $main_font = Cosy()->settings->get('main_font');
        $secondary_font = Cosy()->settings->get('secondary_font');
        $highlight_font = Cosy()->settings->get('highlight_font');

        if(!empty($main_font['family'])){
            $array['body'] = $main_font['family'];
        }
        if(!empty($secondary_font['family'])){
            $array['heading'] = $secondary_font['family'];
        }
        if(!empty($highlight_font['family'])){
            $array['highlight'] = $highlight_font['family'];
        }
        return $array;
    }

    public function get_google_font_url(){

        $_tmp = array();

        $main_font = (array) Cosy()->settings->get('main_font');
        $secondary_font = (array) Cosy()->settings->get('secondary_font');
        $highlight_font = (array) Cosy()->settings->get('highlight_font');

        if(!empty($main_font['family'])){
            if(!empty($main_font['variant'])){
                $_tmp[] = $main_font['family'] . ":" . implode(',', (array) $main_font['variant']);
            }else{
                $_tmp[] = $main_font['family'];
            }
        }

        if(!empty($secondary_font['family'])){
            if(!empty($secondary_font['variant'])){
                $_tmp[] = $secondary_font['family'] . ":" . implode(',', (array) $secondary_font['variant']);
            }else{
                $_tmp[] = $secondary_font['family'];
            }
        }

        if(!empty($highlight_font['family'])){
            if(!empty($highlight_font['variant'])){
                $_tmp[] = $highlight_font['family'] . ":" . implode(',', (array) $highlight_font['variant']);
            }else{
                $_tmp[] = $highlight_font['family'];
            }
        }

        if(empty($_tmp)){
            return '';
        }

        return esc_url( add_query_arg('family', implode( '|', $_tmp ),'//fonts.googleapis.com/css') );
    }

    public function get_google_font_code_url() {
        $fonts_url = '';
        $_font_code = Cosy()->settings->get('font_google_code', '');
        if(!empty($_font_code)){
            $fonts_url = $_font_code;
        }
        return esc_url($fonts_url);
    }

    public function get_google_font_typekit_url(){
        $fonts_url = '';
        $_api_key = Cosy()->settings->get('font_typekit_kit_id', '');
        if(!empty($_api_key)){
            $fonts_url =  '//use.typekit.net/' . preg_replace('/\s+/', '', $_api_key) . '.js';
        }
        return esc_url($fonts_url);
    }

    public function add_custom_header_js(){
        printf( '<%1$s %2$s>try{ %3$s }catch (ex){}</%1$s>', 'script', '', Cosy()->settings->get('header_js') );
    }

    public function add_custom_footer_js(){
        printf( '<%1$s %2$s>try{ %3$s }catch (ex){}</%1$s>', 'script', '', Cosy()->settings->get('footer_js') );
    }
}