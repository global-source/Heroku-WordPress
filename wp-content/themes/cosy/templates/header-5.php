<?php

$header_layout = Cosy()->layout->get_header_layout();

$show_cart      = (Cosy_Helper::is_active_woocommerce() && Cosy()->settings->get('header_show_cart') == 'yes' && Cosy()->settings->get('catalog_mode', 'off') != 'on');
$show_wishlist  = (Cosy_Helper::is_active_woocommerce() && Cosy()->settings->get('header_show_wishlist') == 'yes' && function_exists('yith_wcwl_object_id'));
$show_search    = (Cosy()->settings->get('header_show_search') == 'yes') ? true : false;
?>
<div class="header5-stuck">
    <?php if($show_cart): ?>
        <div class="header-toggle-cart">
            <a href="<?php echo esc_url(wc_get_page_permalink('cart')) ?>"><i class="cosy-icon-bag"></i><span class="la-cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ) ?></span></a>
            <div class="header_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <div class="cart-loading"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php
    if($show_wishlist){
        $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
        if($wishlist_page_id){
            printf(
                '<div class="header-toggle-wishlist"><a href="%s"><i class="cosy-icon-favourite-28"></i></a></div>',
                esc_url(get_the_permalink($wishlist_page_id))
            );
        }
    }
    ?>
    <?php if($show_search): ?>
        <div class="header-toggle-search">
            <a href="#"><i class="cosy-icon-zoom2"></i></a>
        </div>
    <?php endif; ?>
</div>
<header id="masthead_aside" class="header--aside">
    <div class="site-header-inner">
        <div class="container">
            <div class="header-main clearfix">
                <div class="header-left">
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/'  ) ); ?>" rel="home">
                            <figure class="logo--normal"><?php Cosy()->layout->render_logo();?></figure>
                            <figure class="logo--transparency"><?php Cosy()->layout->render_transparency_logo();?></figure>
                        </a>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-toggle-menu">
                        <div class="btn-aside-toggle">
                            <a href="#"><i class="cosy-icon-menu-left"></i></a><span><?php esc_html_e('Menu', 'cosy') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- #masthead_aside -->
<div class="header5-fallback">
    <div class="btn-aside-toggle">
        <span class="cosy-icon-simple-close"></span>
    </div>
    <div class="header5-fallback-inner">
        <div class="header5-nav dl-menuwrapper">
            <?php Cosy()->layout->render_main_nav(array(
                'menu_class'    => 'main-menu mega-menu',
                'walker'        => ''
            ));?>
        </div>
    </div>
</div>