<?php
$show_search    = (Cosy()->settings->get('header_show_search') == 'yes') ? true : false;
?>
<?php if( Cosy()->settings->get('backtotop_btn') ): ?>
<div class="clearfix">
    <div class="backtotop-container">
        <a href="#page" class="btn-backtotop btn btn-secondary"><span class="fa-angle-up"></span></a>
    </div>
</div>
<?php endif; ?>
<?php
    Cosy()->layout->render_footer_tpl();
?>
    </div><!-- .site-inner -->
</div><!-- #page-->

<?php if($show_search): ?>
    <div class="searchform-fly-overlay">
        <a href="javascript:;" class="btn-close-search"><i class="cosy-icon-simple-close"></i></a>
        <div class="searchform-fly">
            <p><?php esc_html_e('Start typing and press Enter to search', 'cosy')?></p>
            <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                <input autocomplete="off" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here&hellip;', 'placeholder', 'cosy' ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'cosy' ); ?>" />
                <button class="search-button" type="submit"><i class="cosy-icon-zoom"></i></button>
                <?php if(Cosy_Helper::is_active_woocommerce()): ?>
                    <input type="hidden" name="post_type" value="product"/>
                <?php endif; ?>
            </form>
            <!-- .search-form -->
        </div>
    </div>
<?php endif; ?>

<div class="la-overlay-global"></div>


<?php
$show_popup = Cosy()->settings->get('enable_newsletter_popup');
$only_home_page = Cosy()->settings->get('only_show_newsletter_popup_on_home_page');
$delay = Cosy()->settings->get('newsletter_popup_delay', 2000);
$popup_content = Cosy()->settings->get('newsletter_popup_content');
$show_checkbox = Cosy()->settings->get('show_checkbox_hide_newsletter_popup', false);
$back_display_time = Cosy()->settings->get('newsletter_popup_show_again', '1');
$popup_dont_show_text = Cosy()->settings->get('popup_dont_show_text', '');
if($show_popup){
    if($only_home_page && !is_front_page()){
        $show_popup = false;
    }
}
if($show_popup && !empty($popup_content)):
    ?>
    <div class="la-newsletter-popup" data-back-time="<?php echo esc_attr( floatval($back_display_time) ); ?>" data-show-mobile="<?php echo Cosy()->settings->get('disable_popup_on_mobile') ? 1 : 0 ?>" id="la_newsletter_popup" data-delay="<?php echo esc_attr( absint($delay) ); ?>">
        <a href="#" class="btn-close-newsletter-popup"><span class="cosy-icon-simple-close"></span></a>
        <div class="newsletter-popup-content"><?php echo Cosy_Helper::remove_js_autop($popup_content); ?></div>
        <?php if($show_checkbox): ?>
            <label><input type="checkbox" id="dont_show_popup"/><?php echo esc_html($popup_dont_show_text); ?></label>
        <?php endif;?>
    </div>
<?php endif; ?>

<?php
do_action('cosy/action/after_render_body');
wp_footer();
?>
</body>
</html>