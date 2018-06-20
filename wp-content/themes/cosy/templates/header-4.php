<?php

$header_layout = Cosy()->layout->get_header_layout();

$show_cart      = (Cosy_Helper::is_active_woocommerce() && Cosy()->settings->get('header_show_cart') == 'yes' && Cosy()->settings->get('catalog_mode', 'off') != 'on');
$show_wishlist  = (Cosy_Helper::is_active_woocommerce() && Cosy()->settings->get('header_show_wishlist') == 'yes' && function_exists('yith_wcwl_object_id'));
$show_search    = (Cosy()->settings->get('header_show_search') == 'yes') ? true : false;

$aside_sidebar_name = apply_filters('optima/filter/aside_widget_bottom', 'aside-widget');

?>
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
                <div class="header-middle">
                    <?php if($show_search): ?>
                        <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                            <input autocomplete="off" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here&hellip;', 'placeholder', 'cosy' ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'cosy' ); ?>" />
                            <button class="search-button" type="submit"><i class="cosy-icon-zoom"></i></button>
                            <?php if(Cosy_Helper::is_active_woocommerce()): ?>
                                <input type="hidden" name="post_type" value="product"/>
                            <?php endif; ?>
                        </form>
                        <!-- .search-form -->
                    <?php endif; ?>
                    <?php if($show_cart): ?>
                        <div class="header_shopping_cart">
                            <a href="<?php echo esc_url(wc_get_page_permalink('cart')) ?>">
                                <span><?php esc_html_e('Your Cart : ', 'cosy');  ?></span><span class="la-cart-total-price"><?php echo WC()->cart->get_cart_total(); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="header-right">
                    <nav class="header-aside-nav menu--vertical menu--vertical-<?php echo is_rtl() ? 'right' : 'left' ?> clearfix">
                        <div class="nav-inner" data-container="#masthead_aside">
                            <?php Cosy()->layout->render_main_nav(array(
                                'menu_class'    => 'main-menu mega-menu isVerticalMenu'
                            ));?>
                        </div>
                    </nav>
                </div>
                <?php if(is_active_sidebar($aside_sidebar_name)): ?>
                    <div class="clearfix"></div>
                    <div class="header-widget-bottom">
                        <?php
                        dynamic_sidebar($aside_sidebar_name);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!-- #masthead -->