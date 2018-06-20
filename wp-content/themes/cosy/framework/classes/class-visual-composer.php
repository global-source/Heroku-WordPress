<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Cosy_Visual_Composer{

    public $category;

    public static $instance = null;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct(){

        $this->category = esc_html__( 'La Studio', 'cosy');

        if(!class_exists('Vc_Manager')) return false;

        add_action( 'vc_before_init', array( $this, 'vcBeforeInit') );
        add_action( 'vc_after_init', array( $this, 'vcAfterInit') );
        add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG , array( $this, 'customFilterTags' ), 10, 3 );
        add_filter('vc_tta_container_classes', array( $this, 'modifyTtaTabsClasses'), 10, 2 );

    }

    public function vcBeforeInit(){
        vc_set_as_theme();
        //vc_disable_frontend();
        if(class_exists( 'WooCommerce' )){
            remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
        }
        add_filter('vc_map_get_param_defaults', array( $this, 'modifyCssAnimationValue' ), 10, 2);
    }

    public function vcAfterInit(){
        $this->overrideVcSection();
        $this->overrideMessage();
        $this->overrideProgressBar();
        $this->overridePieChart();
        $this->overrideTtaAccordion();
        $this->overrideTtaTabs();
        $this->overrideTtaTour();
        $this->overrideTtaSection();

        if( function_exists('vc_set_default_editor_post_types') ){
            $list = array(
                'page',
                'post',
                'la_block',
                'la_portfolio'
            );
            vc_set_default_editor_post_types( $list );
        }
    }

    public function modifyCssAnimationValue($value, $param){
        if( 'css_animation' ==  $param['param_name'] && 'none' == $value){
            $value = '';
        }
        return $value;
    }

    public function customFilterTags($css_classes, $shortcode_name, $atts){
        if ( $shortcode_name == 'vc_progress_bar' ){
            if( isset($atts['display_type']) ){
                $css_classes .= ' vc_progress_bar_' . esc_attr($atts['display_type']);
            }
        }
        if ( $shortcode_name == 'vc_tta_tabs' || $shortcode_name == 'vc_tta_accordion' || $shortcode_name == 'vc_tta_tour' ){
            if( isset($atts['style']) && strpos($atts['style'], 'la-') !== false ){
                $css_classes = preg_replace('/ vc_tta-(o|shape|spacing|gap|color)[0-9a-zA-Z\_\-]+/','',$css_classes);
                if($shortcode_name == 'vc_tta_tabs'){
                    $css_classes .= ' vc_tta-o-no-fill';
                    $css_classes = str_replace('vc_tta-style-','tabs-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
                if($shortcode_name == 'vc_tta_tour'){
                    $css_classes = str_replace('vc_tta-style-','tour-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
            }
        }
        if($shortcode_name == 'vc_btn'){
            if(!empty($atts['style']) && in_array($atts['style'], array('modern', 'outline', 'custom', 'outline-custom'))){
                if( false !== strpos( $css_classes, 'vc_btn3-container')){
                    $css_classes .= ' la-vc-btn';
                }
            }
        }

        if ( $shortcode_name == 'vc_row' ) {
            $css_classes .= ' la_fp_slide la_fp_child_section';
        }

        return $css_classes;
    }

    public function overrideMessage(){
        $shortcode_name = 'vc_message';

        $shortcode_object = vc_get_shortcode($shortcode_name);
        $shortcode_params = $shortcode_object['params'];

        $message_box_color = self::getParamIndex($shortcode_params,'message_box_color');
        $message_box_style = self::getParamIndex($shortcode_params,'message_box_style');
        $color = self::getParamIndex($shortcode_params,'color');
        $style = self::getParamIndex($shortcode_params,'style');
        $icon_type = self::getParamIndex($shortcode_params,'icon_type');

        $shortcode_params[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'text_color',
            'heading'       => esc_html__('Text Color', 'cosy'),
            'group'         => esc_html__('Typography', 'cosy'),
        );

        if($message_box_color !== -1){
            unset($shortcode_params[$message_box_color]);
        }
        if($message_box_style !== -1){
            unset($shortcode_params[$message_box_style]);
        }
        if($color !== -1){
            unset($shortcode_params[$color]);
        }
        if($style !== -1){
            unset($shortcode_params[$style]);
        }
        if($icon_type !== -1){
            $shortcode_params[$icon_type]['value'][esc_html__( 'None', 'cosy' )] = 'none';
        }

        vc_map_update($shortcode_name , array(
            'category' => $this->category,
            'params' => $shortcode_params
        ));
    }

    public function overrideProgressBar(){
        vc_map_update( 'vc_progress_bar', array(
            'category' => $this->category
        ));
    }

    public function overridePieChart(){
        $shortcode_tag = 'vc_pie';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];

        $shortcode_params = array(
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html__( 'Style 01', 'cosy' ) => '1',
                    esc_html__( 'Style 02', 'cosy' ) => '2',
                ),
                'default'   => '1',
                'heading' => esc_html__( 'Style', 'cosy' ),
                'description' => esc_html__( 'Select display style.', 'cosy' )
            )
        ) + $shortcode_params ;

        vc_map_update( $shortcode_tag , array(
            'category' => $this->category,
            'params'   => $shortcode_params
        ));
    }

    public function overrideTtaAccordion(){
        vc_map_update('vc_tta_accordion' , array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__( 'Cosy 01', 'cosy' ) => 'la-1',
                        esc_html__( 'Cosy 02', 'cosy' ) => 'la-2',
                        esc_html__( 'Cosy 03', 'cosy' ) => 'la-3',
                        esc_html__( 'Classic', 'cosy' ) => 'classic',
                        esc_html__( 'Modern', 'cosy' ) => 'modern',
                        esc_html__( 'Flat', 'cosy' ) => 'flat',
                        esc_html__( 'Outline', 'cosy' ) => 'outline',
                    ),
                    'heading' => esc_html__( 'Style', 'cosy' ),
                    'description' => esc_html__( 'Select accordion display style.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html__( 'Rounded', 'cosy' ) => 'rounded',
                        esc_html__( 'Square', 'cosy' ) => 'square',
                        esc_html__( 'Round', 'cosy' ) => 'round',
                    ),
                    'heading' => esc_html__( 'Shape', 'cosy' ),
                    'description' => esc_html__( 'Select accordion shape.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'heading' => esc_html__( 'Color', 'cosy' ),
                    'description' => esc_html__( 'Select accordion color.', 'cosy' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill',
                    'heading' => esc_html__( 'Do not fill content area?', 'cosy' ),
                    'description' => esc_html__( 'Do not fill content area with color.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__( 'Spacing', 'cosy' ),
                    'description' => esc_html__( 'Select accordion spacing.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__( 'Gap', 'cosy' ),
                    'description' => esc_html__( 'Select accordion gap.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_align',
                    'value' => array(
                        esc_html__( 'Left', 'cosy' ) => 'left',
                        esc_html__( 'Right', 'cosy' ) => 'right',
                        esc_html__( 'Center', 'cosy' ) => 'center',
                    ),
                    'heading' => esc_html__( 'Alignment', 'cosy' ),
                    'description' => esc_html__( 'Select accordion section title alignment.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html__( 'Autoplay', 'cosy' ),
                    'description' => esc_html__( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'collapsible_all',
                    'heading' => esc_html__( 'Allow collapse all?', 'cosy' ),
                    'description' => esc_html__( 'Allow collapse all accordion sections.', 'cosy' ),
                ),
                // Control Icons
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_icon',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        esc_html__( 'Chevron', 'cosy' ) => 'chevron',
                        esc_html__( 'Plus', 'cosy' ) => 'plus',
                        esc_html__( 'Triangle', 'cosy' ) => 'triangle',
                    ),
                    'std' => 'plus',
                    'heading' => esc_html__( 'Icon', 'cosy' ),
                    'description' => esc_html__( 'Select accordion navigation icon.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_position',
                    'value' => array(
                        esc_html__( 'Left', 'cosy' ) => 'left',
                        esc_html__( 'Right', 'cosy' ) => 'right',
                    ),
                    'dependency' => array(
                        'element' => 'c_icon',
                        'not_empty' => true,
                    ),
                    'heading' => esc_html__( 'Position', 'cosy' ),
                    'description' => esc_html__( 'Select accordion navigation icon position.', 'cosy' ),
                ),
                // Control Icons END
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html__( 'Active section', 'cosy' ),
                    'value' => 1,
                    'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'cosy' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'cosy' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cosy' ),
                ),
            )
        ));
    }

    public function overrideTtaTabs(){
        vc_map_update( 'vc_tta_tabs', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => __( 'Widget title', 'cosy' ),
                    'description' => __( 'Enter text used as widget title (Note: located above content element).', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__( 'Cosy 01', 'cosy' ) => 'la-1',
                        esc_html__( 'Cosy 02', 'cosy' ) => 'la-2',
                        esc_html__( 'Cosy 03', 'cosy' ) => 'la-3',
                        esc_html__( 'Cosy 04', 'cosy' ) => 'la-4',
                        esc_html__( 'Classic', 'cosy' ) => 'classic',
                        esc_html__( 'Modern', 'cosy' ) => 'modern',
                        esc_html__( 'Flat', 'cosy' ) => 'flat',
                        esc_html__( 'Outline', 'cosy' ) => 'outline',
                    ),
                    'heading' => esc_html__( 'Style', 'cosy' ),
                    'description' => esc_html__( 'Select tabs display style.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html__( 'Rounded', 'cosy' ) => 'rounded',
                        esc_html__( 'Square', 'cosy' ) => 'square',
                        esc_html__( 'Round', 'cosy' ) => 'round',
                    ),
                    'heading' => esc_html__( 'Shape', 'cosy' ),
                    'description' => esc_html__( 'Select tabs shape.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'heading' => esc_html__( 'Color', 'cosy' ),
                    'description' => esc_html__( 'Select tabs color.', 'cosy' ),
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),

                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill_content_area',
                    'heading' => esc_html__( 'Do not fill content area?', 'cosy' ),
                    'std' => 'true',
                    'description' => esc_html__( 'Do not fill content area with color.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__( 'Spacing', 'cosy' ),
                    'description' => esc_html__( 'Select tabs spacing.', 'cosy' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__( 'Gap', 'cosy' ),
                    'description' => esc_html__( 'Select tabs gap.', 'cosy' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html__( 'Top', 'cosy' ) => 'top',
                        esc_html__( 'Bottom', 'cosy' ) => 'bottom',
                    ),
                    'heading' => esc_html__( 'Position', 'cosy' ),
                    'description' => esc_html__( 'Select tabs navigation position.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html__( 'Left', 'cosy' ) => 'left',
                        esc_html__( 'Right', 'cosy' ) => 'right',
                        esc_html__( 'Center', 'cosy' ) => 'center',
                    ),
                    'heading' => esc_html__( 'Alignment', 'cosy' ),
                    'description' => esc_html__( 'Select tabs section title alignment.', 'cosy' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html__( 'Autoplay', 'cosy' ),
                    'description' => esc_html__( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html__( 'Active section', 'cosy' ),
                    'value' => 1,
                    'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_style',
                    'value' => array(
                        esc_html__( 'None', 'cosy' ) => '',
                        esc_html__( 'Square Dots', 'cosy' ) => 'outline-square',
                        esc_html__( 'Radio Dots', 'cosy' ) => 'outline-round',
                        esc_html__( 'Point Dots', 'cosy' ) => 'flat-round',
                        esc_html__( 'Fill Square Dots', 'cosy' ) => 'flat-square',
                        esc_html__( 'Rounded Fill Square Dots', 'cosy' ) => 'flat-rounded',
                    ),
                    'heading' => esc_html__( 'Pagination style', 'cosy' ),
                    'description' => esc_html__( 'Select pagination style.', 'cosy' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'heading' => esc_html__( 'Pagination color', 'cosy' ),
                    'description' => esc_html__( 'Select pagination color.', 'cosy' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'std' => 'grey',
                    'dependency' => array(
                        'element' => 'pagination_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'cosy' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cosy' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'CSS box', 'cosy' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design Options', 'cosy' ),
                ),
            )
        ));
    }

    public function overrideTtaSection(){
        $shortcode_tag = 'vc_tta_section';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];
        $i_type_idx = self::getParamIndex($shortcode_params,'i_type');
        $el_class_idx = self::getParamIndex($shortcode_params,'el_class');
        if($i_type_idx !== -1 && $el_class_idx !== -1){
            $el_class = $shortcode_params[$el_class_idx];
            $shortcode_params[$i_type_idx]['value'][esc_html__('LaStudio Icon Outline', 'cosy')] = 'la_icon_outline';
            $shortcode_params[$el_class_idx] = array (
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'cosy' ),
                'param_name' => 'i_icon_la_icon_outline',
                'value' => 'la-icon design-2_image',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'la_icon_outline',
                    'iconsPerPage' => 50,
                ),
                'dependency' => array(
                    'element' => 'i_type',
                    'value' => 'la_icon_outline',
                )
            );
            $shortcode_params[] = $el_class;
            vc_map_update($shortcode_tag , array(
                'params' => $shortcode_params
            ));
        }
    }

    public function modifyTtaTabsClasses($classes, $atts){
        if(isset($atts['style']) && strpos($atts['style'],'la-') !== false && isset($atts['alignment'])){
            $classes[] = 'vc_tta-' . $atts['style'];
            $classes[] = 'vc_tta-alignment-' . $atts['alignment'];
        }
        return $classes;
    }

    public function overrideTtaTour(){
        vc_map_update( 'vc_tta_tour', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__( 'Cosy 01', 'cosy' ) => 'la-1',
                    ),
                    'heading' => esc_html__( 'Style', 'cosy' ),
                    'description' => esc_html__( 'Select tabs display style.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html__( 'Left', 'cosy' ) => 'left',
                        esc_html__( 'Right', 'cosy' ) => 'right',
                    ),
                    'heading' => esc_html__( 'Position', 'cosy' ),
                    'description' => esc_html__( 'Select tour navigation position.', 'cosy' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html__( 'Left', 'cosy' ) => 'left',
                        esc_html__( 'Right', 'cosy' ) => 'right',
                        esc_html__( 'Center', 'cosy' ) => 'center',
                    ),
                    'heading' => esc_html__( 'Alignment', 'cosy' ),
                    'description' => esc_html__( 'Select tabs section title alignment.', 'cosy' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'hidden',
                    'param_name' => 'autoplay',
                    'std' => 'none',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'controls_size',
                    'value' => array(
                        esc_html__( 'Auto', 'cosy' ) => '',
                        esc_html__( 'Extra large', 'cosy' ) => 'xl',
                        esc_html__( 'Large', 'cosy' ) => 'lg',
                        esc_html__( 'Medium', 'cosy' ) => 'md',
                        esc_html__( 'Small', 'cosy' ) => 'sm',
                        esc_html__( 'Extra small', 'cosy' ) => 'xs',
                    ),
                    'heading' => esc_html__( 'Navigation width', 'cosy' ),
                    'description' => esc_html__( 'Select tour navigation width.', 'cosy' ),
                ),

                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html__( 'Active section', 'cosy' ),
                    'value' => 1,
                    'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'cosy' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'cosy' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cosy' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'CSS box', 'cosy' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design Options', 'cosy' ),
                ),
            )
        ));
    }

    public function overrideVcSection(){
        vc_add_params('vc_section', array(
            array(
                'type' => 'dropdown',
                'heading' => __('Section Behaviour', 'cosy'),
                'param_name' => 'fp_auto_height',
                'admin_label' => true,
                'value' => array(
                    __('Full Height', 'cosy') => 'off',
                    __('Auto Height', 'cosy') => 'on',
                    __('Responsive Auto Height', 'cosy') => 'responsive',
                    __('Top Fixed Header', 'cosy') => 'fixed_top',
                    __('Bottom Fixed Footer', 'cosy') => 'fixed_bottom',
                ),
                'description' => __('Select section row behaviour.', 'cosy'),
                'group' => esc_html__('Full Page Settings', 'cosy'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Anchor', 'cosy'),
                'param_name' => 'fp_anchor',
                'admin_label'   => true,
                'value' => '',
                'description' => __('Enter an anchor (ID).', 'cosy'),
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'group' => esc_html__('Full Page Settings', 'cosy'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Tooltip', 'cosy'),
                'param_name' => 'fp_tooltip',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html__('Full Page Settings', 'cosy'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => __('Rows as Slides', 'cosy'),
                'param_name' => 'fp_column_slide',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html__('Full Page Settings', 'cosy'),
                'description' => __('Enable if you want to show each row in this section as slides.', 'cosy'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => __('No Scrollbars', 'cosy'),
                'param_name' => 'fp_no_scrollbar',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html__('Full Page Settings', 'cosy'),
                'description' => __('Enable if scrolloverflow is enabled but you don\'t want to show scrollbars for this section.', 'cosy'),
            )
        ));
    }

    protected function arrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }
        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name=>$value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = $this->arrayToObject($value);
                }
            }
            return $object;
        }
        else {
            return false;
        }
    }

    public static function getParamIndex($array, $attr){
        foreach ($array as $index => $entry) {
            if ($entry['param_name'] == $attr) {
                return $index;
            }
        }
        return -1;
    }

}