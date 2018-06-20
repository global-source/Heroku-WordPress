<?php
$post_class             = array('loop-item','grid-item','post-item');
?>
<article <?php post_class($post_class); ?>>
    <div class="item-inner">
        <div class="item-inner-wrap">
            <div class="item-info">
                <header class="entry-header">
                    <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h3>' ); ?>
                </header>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <footer class="entry-meta-footer clearfix">
                    <a class="btn btn-outline btn-xs" href="<?php the_permalink();?>"><?php esc_html_e('Read more', 'cosy'); ?></a>
                </footer>
            </div>
        </div>
    </div>
</article>