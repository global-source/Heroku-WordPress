<?php
global $cosy_loop;
$title_tag      = !empty($cosy_loop['title_tag']) ? $cosy_loop['title_tag'] : 'h3';
$show_excerpt   = ( isset($cosy_loop['excerpt_length']) && 0 < absint($cosy_loop['excerpt_length']) ) ? true : false;

$post_class     = array('loop-item','grid-item','blog-post-item');
$post_class[]   = ( $show_excerpt ? 'show' : 'hide' ) .  '-excerpt';
?>
<article <?php post_class($post_class); ?>>
    <div class="item-inner">
        <div class="item-inner-wrap">
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