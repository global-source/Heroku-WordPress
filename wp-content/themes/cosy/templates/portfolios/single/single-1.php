<?php
$gallery = Cosy()->settings->get_post_meta(get_the_ID(),'gallery');
$client = Cosy()->settings->get_post_meta(get_the_ID(),'client');
$timeline = Cosy()->settings->get_post_meta(get_the_ID(),'timeline');
$location = Cosy()->settings->get_post_meta(get_the_ID(),'location');
$website = Cosy()->settings->get_post_meta(get_the_ID(),'website');
$additional = Cosy()->settings->get_post_meta(get_the_ID(),'additional');
if(!empty($gallery)){
    $gallery = explode(',', $gallery);
}
if(empty($gallery)){
    $gallery = array();
}
if(has_post_thumbnail()){
    $gallery[] = get_post_thumbnail_id();
}
$main_class = 'col-xs-12';
?>
<div class="portfolio-single-page style-1">
    <?php
    if(!empty($gallery) && is_array($gallery)): ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="pf-gal-items la-slick-slider" data-slider_config='{"autoplay":true}'>
                    <?php
                    foreach($gallery as $g_id){
                        printf(
                            '<div class="gal-item"><a href="%1$s" class="la-popup-slideshow" data-rel="pf:galley">%2$s</a></div>',
                            wp_get_attachment_image_url($g_id, 'full'),
                            wp_get_attachment_image($g_id, 'full')
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <h1 class="pf-title h3"><?php the_title();?></h1>
            <div class="entry-tax-list">
                <?php echo get_the_term_list(get_the_ID(), 'la_portfolio_category');?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-3 col-md-push-8">
            <div class="portfolio-meta-data">
                <?php
                if(!empty($client)){
                    echo sprintf('<div class="meta-item"><span class="cosy-icon-users-circle"></span><span>%s</span></div>', esc_html($client));
                }
                if(!empty($timeline)){
                    echo sprintf('<div class="meta-item"><span class="cosy-icon-ui-calendar"></span><span>%s</span></div>', esc_html($timeline));
                }
                if(!empty($location)){
                    echo sprintf('<div class="meta-item"><span class="cosy-icon-flag"></span><span>%s</span></div>', esc_html($location));
                }
                if(!empty($website)){
                    echo sprintf('<div class="meta-item"><span class="cosy-icon-link2"></span><span>%s</span></div>', esc_html($website));
                }
                ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-7 col-md-pull-3">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>