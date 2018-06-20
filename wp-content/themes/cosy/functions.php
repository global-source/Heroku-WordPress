<?php

/**
 * Require plugins vendor
 */

require_once get_template_directory() . '/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/plugins/plugins.php';

/**
 * Include the main class.
 */

include_once get_template_directory() . '/framework/classes/class-cosy.php';


Cosy::$template_dir_path   = get_template_directory();
Cosy::$template_dir_url    = get_template_directory_uri();
Cosy::$stylesheet_dir_path = get_stylesheet_directory();
Cosy::$stylesheet_dir_url  = get_stylesheet_directory_uri();

/**
 * Include the autoloader.
 */
include_once Cosy::$template_dir_path . '/framework/classes/class-autoload.php';

new Cosy_Autoload();

/**
 * load functions for later usage
 */

require_once Cosy::$template_dir_path . '/framework/functions/functions.php';

new Cosy_Multilingual();

if(!function_exists('cosy_init_options')){
    function cosy_init_options(){
        Cosy::$options = Cosy_Options::get_instance();
    }
    cosy_init_options();
}

if(!function_exists('Cosy')){
    function Cosy(){
        return Cosy::get_instance();
    }
}

new Cosy_Scripts();

new Cosy_Admin();

new Cosy_WooCommerce();

Cosy_Visual_Composer::get_instance();

/**
 * Set the $content_width global.
 */
global $content_width;
if ( ! is_admin() ) {
    if ( ! isset( $content_width ) || empty( $content_width ) ) {
        $content_width = (int) Cosy()->layout->get_content_width();
    }
}



require_once Cosy::$template_dir_path . '/framework/functions/extra-functions.php';