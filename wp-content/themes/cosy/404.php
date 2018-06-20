<?php get_header(); ?>
<?php do_action( 'cosy/action/before_render_main' ); ?>
<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Cosy()->layout->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'cosy/action/before_render_main_inner' );?>

                    <div class="page-content">
                        <?php
                        $content_404 = Cosy()->settings->get('404_page_content');
                        if(!empty($content_404)) : ?>
                            <div class="customerdefine-404-content">
                                <?php echo Cosy_Helper::remove_js_autop($content_404); ?>
                            </div>
                        <?php else : ?>
                            <div class="default-404-content">
                                <h1><?php esc_html_e('404 Not Found', 'cosy') ?></h1>
                                <p class="highlight-font-family"><?php esc_html_e('Oops ! We are sorry but the page you are looking for does not exist. Please try searching again or click on the button below to continue exploring website.', 'cosy');?></p>
                                <p class="btn-wrapper"><a class="btn text-uppercase" href="<?php echo home_url('/') ?>"><?php esc_html_e('back to homepage','cosy')?></a></p>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>

                    <?php do_action( 'cosy/action/after_render_main_inner' );?>
                </div>
            </main>
            <!-- #site-content -->
            <?php get_sidebar();?>
        </div>
    </div>
</div>
<!-- .site-main -->
<?php do_action( 'cosy/action/after_render_main' ); ?>
<?php get_footer();?>