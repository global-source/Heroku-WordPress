<?php if ( ! defined( 'ABSPATH' ) ) { die; }

add_filter('LaStudio/global_loop_variable', 'cosy_set_loop_variable');
if(!function_exists('cosy_set_loop_variable')){
    function cosy_set_loop_variable( $var = ''){
        return 'cosy_loop';
    }
}

add_filter('lastudio/google_map_api', 'cosy_add_googlemap_api');
if(!function_exists('cosy_add_googlemap_api')){
    function cosy_add_googlemap_api( $key = '' ){
        return Cosy()->settings->get('google_key', $key);
    }
}

add_filter('cosy/filter/page_title', 'cosy_override_page_title_bar_title');
if(!function_exists('cosy_override_page_title_bar_title')){
    function cosy_override_page_title_bar_title( $title ){

        $_tmp = '<header><div class="page-title h1">%s</div></header>';

        $context = (array) Cosy()->get_current_context();

        if(in_array('is_singular', $context)){
            $custom_title = Cosy()->settings->get_post_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($_tmp, $custom_title);
            }
        }

        if(in_array('is_tax', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
            $custom_title = Cosy()->settings->get_term_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($_tmp, $custom_title);
            }
        }

        return $title;
    }
}

add_action( 'pre_get_posts', 'cosy_set_posts_per_page_for_portfolio_cpt' );
if(!function_exists('cosy_set_posts_per_page_for_portfolio_cpt')){
    function cosy_set_posts_per_page_for_portfolio_cpt( $query ) {
        if ( !is_admin() && $query->is_main_query() ) {
            if( is_post_type_archive( 'la_portfolio' ) || is_tax(get_object_taxonomies( 'la_portfolio' ))){
                $pf_per_page = (int) Cosy()->settings->get('portfolio_per_page', 9);
                $query->set( 'posts_per_page', $pf_per_page );
            }
        }
    }
}



add_action('wp', 'cosy_hook_maintenance');
if(!function_exists('cosy_hook_maintenance')){
    function cosy_hook_maintenance(){
        wp_reset_postdata();
        $enable_maintenance = Cosy()->settings->get('enable_maintenance', 'no');
        $enable_private = Cosy()->settings->get('enable_private_shop', 'no');
        if($enable_maintenance == 'yes' && !is_admin()){
            if(!is_user_logged_in()){
                $maintenance_page_id = Cosy()->settings->get('maintenance_page');
                if(empty($maintenance_page_id)){
                    wp_redirect(wp_login_url());
                    exit;
                }
                else{
                    $maintenance_page_id = absint($maintenance_page_id);
                    if(!is_page($maintenance_page_id)){
                        wp_redirect(get_permalink($maintenance_page_id));
                        exit;
                    }
                }
            }
        }
        if($enable_private == 'yes' && $enable_maintenance != 'yes' && !is_admin()){
            if(Cosy_Helper::is_active_woocommerce() && !is_user_logged_in()){
                if(is_shop() || is_cart() || is_product_taxonomy() || is_product() || is_checkout()){
                    $page_id = Cosy()->settings->get('private_login_page');
                    if(empty($page_id)){
                        wp_redirect(wp_login_url());
                        exit;
                    }
                    else{
                        $page_id = absint($page_id);
                        if(!is_page($page_id)){
                            wp_redirect(get_permalink($page_id));
                            exit;
                        }
                    }
                }
            }
        }
    }
}