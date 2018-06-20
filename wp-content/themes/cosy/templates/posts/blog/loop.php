<?php
global $cosy_loop;
$thumbnail_size     = !empty($cosy_loop['image_size']) ? $cosy_loop['image_size'] : 'thumbnail';
$title_tag      = !empty($cosy_loop['title_tag']) ? $cosy_loop['title_tag'] : 'h3';
$show_excerpt   = ( isset($cosy_loop['excerpt_length']) && 0 < absint($cosy_loop['excerpt_length']) ) ? true : false;

$post_class     = array('loop-item','grid-item','blog-post-item');
$post_class[]   = ( $show_excerpt ? 'show' : 'hide' ) .  '-excerpt';
?>
<article <?php post_class($post_class); ?>>
    <div class="item-inner">
        <div class="item-inner-wrap">
            <?php if(has_post_thumbnail()): ?>
                <div class="entry-thumbnail blog-item-has-effect">
                    <a href="<?php the_permalink();?>">
                        <?php Cosy()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                        <span class="pf-icon pf-icon-link"></span>
                        <div class="item--overlay"></div>
                    </a>
                </div>
            <?php endif; ?>
            <div class="item-info clearfix">
                <?php
                cosy_entry_meta_item_category_list('');
                ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<%s class="entry-title"><a href="%s">',$title_tag, esc_url( get_the_permalink() ) ), sprintf('</a></%s>', $title_tag) ); ?>
                </header>
                <?php if($show_excerpt): ?>
                    <div class="entry-excerpt"><?php the_excerpt(); ?></div>
                <?php endif; ?>
                <footer class="entry-meta-footer clearfix">
                    <a class="btn btn-outline btn-xs" href="<?php the_permalink();?>"><?php esc_html_e('Read more', 'cosy'); ?></a>
                </footer>
            </div>
        </div>
    </div>
</article>