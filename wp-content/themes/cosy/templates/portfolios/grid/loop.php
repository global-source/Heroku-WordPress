<?php
if(!has_post_thumbnail()){
    return;
}
global $cosy_loop;
if(!isset($cosy_loop['loop_index'])){
    $cosy_loop['loop_index'] = 0;
}
$cosy_loop['loop_index']++;
$loop_index     = isset($cosy_loop['loop_index']) ? $cosy_loop['loop_index'] : 1;
$thumbnail_size = isset($cosy_loop['image_size']) && !empty($cosy_loop['image_size']) ? $cosy_loop['image_size'] : 'thumbnail';
$title_tag      = isset($cosy_loop['title_tag']) && !empty($cosy_loop['title_tag']) ? $cosy_loop['title_tag'] : 'h3';
$post_class     = array('loop-item','grid-item','portfolio-item');
?>
<article <?php post_class($post_class); ?>>
    <div class="item-inner">
        <div class="item--thumbnail">
            <a href="<?php the_permalink()?>">
            <?php
            Cosy()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size);
            ?>
            </a>
        </div>
        <div class="item--info">
            <div class="item--info-inner item--holder">
                <header class="entry-header">
                    <?php the_title( sprintf( '<%s class="entry-title"><a href="%s">',$title_tag, esc_url( get_the_permalink() ) ), sprintf('</a></%s>', $title_tag) ); ?>
                </header>
            </div>
        </div>
        <a class="item--link-overlay" href="<?php the_permalink()?>"></a>
    </div>
</article>