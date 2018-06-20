<?php
add_action( 'tgmpa_register', 'cosy_register_required_plugins' );

if(!function_exists('cosy_register_required_plugins')){

	function cosy_register_required_plugins() {

		$plugins = array();

		$plugins[] = array(
			'name'					=> esc_html__('LA Studio Core','cosy'),
			'slug'					=> 'lastudio-core',
			'source'				=> get_template_directory() . '/plugins/lastudio-core.zip',
			'required'				=> true,
			'version'				=> '2.0.2.2'
		);

		$plugins[] = array(
			'name'					=> esc_html__('Cosy Package Demo Data','cosy'),
			'slug'					=> 'cosy-demo-data',
			'source'				=> 'https://github.com//la-studioweb/cosy/raw/master/cosy-demo-data.zip',
			'required'				=> false,
			'version'				=> '1.0.0'
		);

		$plugins[] = array(
			'name'					=> esc_html__('WPBakery Visual Composer','cosy'),
			'slug'					=> 'js_composer',
			'source'				=> get_template_directory() . '/plugins/js_composer.zip',
			'required'				=> true,
			'version'				=> '5.1.1'
		);

		$plugins[] = array(
			'name'     				=> esc_html__('WooCommerce','cosy'),
			'slug'     				=> 'woocommerce',
			'version'				=> '3.0.3',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'					=> esc_html__('Slider Revolution','cosy'),
			'slug'					=> 'revslider',
			'source'				=> get_template_directory() . '/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '5.4.3.1'
		);

		$plugins[] = array(
			'name'     				=> esc_html__('Envato Market', 'cosy'),
			'slug'     				=> 'envato-market',
			'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '1.0.0-RC2'
		);

		$plugins[] = array(
			'name' 					=> esc_html__('Contact Form 7', 'cosy'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html__('YITH WooCommerce Wishlist','cosy'),
			'slug'     				=> 'yith-woocommerce-wishlist',
			'required' 				=> false
		);

		$plugins[] = array(
			'name' 					=> esc_html__('Easy Forms for MailChimp by YIKES', 'cosy'),
			'slug' 					=> 'yikes-inc-easy-mailchimp-extender',
			'required' 				=> false
		);

		$config = array(
			'id'           				=> 'cosy',
			'default_path' 				=> '',
			'menu'         				=> 'tgmpa-install-plugins',
			'has_notices'  				=> true,
			'dismissable'  				=> true,
			'dismiss_msg'  				=> '',
			'is_automatic' 				=> false,
			'message'      				=> ''
		);

		tgmpa( $plugins, $config );

	}

}