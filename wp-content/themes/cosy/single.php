<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>

<?php do_action( 'cosy/action/before_render_main' ); ?>

<?php
$enable_related = Cosy()->settings->get('blog_related_posts', 'off');
$related_style = Cosy()->settings->get('blog_related_design', 1);
$max_related = (int) Cosy()->settings->get('blog_related_max_post', 1);
$related_by = Cosy()->settings->get('blog_related_by', 'category');
?>

<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Cosy()->layout->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'cosy/action/before_render_main_inner' );?>

                    <div class="page-content">

                        <div class="single-post-detail clearfix">
                            <?php

                            do_action( 'cosy/action/before_render_main_content' );

                            if( have_posts() ):  the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>
                                    <?php
                                    if('above' == Cosy()->settings->get('blog_post_title')){
                                        the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
                                    }
                                    ?>
                                    <?php
                                        if(Cosy()->settings->get('featured_images_single') == 'on'){
                                            cosy_single_post_thumbnail();
                                        }
                                    ?>
                                    <?php
                                        if('below' == Cosy()->settings->get('blog_post_title') ){
                                            the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
                                        }
                                    ?>

                                    <div class="entry-meta clearfix"><span class="posted-on"><i class="fa-folder-open-o"></i><?php the_category(','); ?></span><?php
                                        cosy_entry_meta_item_postdate();
                                        cosy_entry_meta_item_comment_post_link();
                                        ?></div><!-- .entry-meta -->

                                    <div class="entry-content">
                                        <?php

                                        the_content( sprintf(
                                            esc_html__( 'Continue reading %s', 'cosy' ),
                                            the_title( '<span class="screen-reader-text">', '</span>', false )
                                        ) );

                                        wp_link_pages( array(
                                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cosy' ) . '</span>',
                                            'after'       => '</div>',
                                            'link_before' => '<span>',
                                            'link_after'  => '</span>',
                                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cosy' ) . ' </span>%',
                                            'separator'   => '<span class="screen-reader-text">, </span>',
                                        ) );
                                        ?>
                                    </div><!-- .entry-content -->

                                    <footer class="entry-footer">
                                        <div class="entry-meta-footer clearfix">
                                            <?php the_tags('<span class="tags-list"><span class="text-color-secondary"><i class="fa fa-tag"></i>'. esc_html__('Tagged in: ', 'cosy'). '</span>' ,', ','</span>') ;?>
                                            <?php
                                            if(Cosy()->settings->get('blog_social_sharing_box') == 'on'){
                                                echo '<div class="la-sharing-posts"><span class="m-sharing-box"><i class="fa fa-share-alt"></i></span>';
                                                cosy_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : ''));
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>

                                        <?php edit_post_link( null, '<span class="edit-link hidden">', '</span>' ); ?>

                                    </footer><!-- .entry-footer -->

                                </article><!-- #post-## -->

                            <?php

                                if(Cosy()->settings->get('blog_pn_nav') == 'on'){
                                    the_post_navigation( array(
                                        'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next article', 'cosy' ) . '</span> ' .
                                            '<span class="post-title">%title</span>',
                                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous article', 'cosy' ) . '</span> ' .
                                            '<span class="post-title">%title</span>'
                                    ) );
                                    echo '<div class="clearfix"></div>';
                                }

                                if(Cosy()->settings->get('blog_author_info') == 'on'){
                                    get_template_part( 'author-bio' );
                                }

                                if(Cosy()->settings->get('blog_comments') == 'on' && ( comments_open() || get_comments_number() ) ){
                                    comments_template();
                                }

                            endif;

                            do_action( 'cosy/action/after_render_main_content' );

                            wp_reset_postdata();

                            if($enable_related == 'on'){
                                $related_args = array(
                                    'posts_per_page' => $max_related,
                                    'post__not_in' => array( get_the_ID() )
                                );
                                if($related_by == 'random'){
                                    $related_args['orderby'] = 'rand';
                                }
                                if($related_by == 'category'){
                                    $cats = wp_get_post_terms( get_the_ID(), 'category' );
                                    if ( is_array( $cats ) && isset( $cats[0] ) && is_object( $cats[0] ) ) {
                                        $related_args['category__in'] = array($cats[0]->term_id);
                                    }
                                }
                                if($related_by == 'tag'){
                                    $tags = wp_get_post_terms( get_the_ID(), 'tag' );
                                    if ( is_array( $tags ) && isset( $tags[0] ) && is_object( $tags[0] ) ) {
                                        $related_args['tag__in'] = array($tags[0]->term_id);
                                    }
                                }
                                if($related_by == 'both'){
                                    $cats = wp_get_post_terms( get_the_ID(), 'category' );
                                    if ( is_array( $cats ) && isset( $cats[0] ) && is_object( $cats[0] ) ) {
                                        $related_args['category__in'] = array($cats[0]->term_id);
                                    }
                                    $tags = wp_get_post_terms( get_the_ID(), 'tag' );
                                    if ( is_array( $tags ) && isset( $tags[0] ) && is_object( $tags[0] ) ) {
                                        $related_args['tag__in'] = array($tags[0]->term_id);
                                    }
                                }

                                $related_query = new WP_Query($related_args);
                            }

                            if($enable_related == 'on'){

                                if($related_query->have_posts()){

                                    echo '<div class="clearfix"></div>';
                                    echo '<h3 class="title-related">' . esc_html__('Related Post', 'cosy') . '</h3>';

                                    $thumbnail_size           = Cosy_Helper::get_image_size_from_string(Cosy()->settings->get('blog_thumbnail_size', 'full'), 'full');

                                    echo '<div class="la-related-posts la-loop showposts-loop blog-main-loop blog-pagination-type-pagination blog-grid_1 grid-items lg-grid-2-items md-grid-2-items sm-grid-2-items xs-grid-1-items mb-grid-1-items xlg-grid-2-items">';

                                    while($related_query->have_posts()) {

                                        $related_query->the_post();
                                        ?>
                                        <div class="loop-item grid-item post-item">
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
                                                    <div class="item-info">
                                                        <header class="entry-header">
                                                            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h3>' ); ?>
                                                        </header>
                                                        <div class="entry-meta clearfix">
                                                            <?php
                                                            cosy_entry_meta_item_postdate();
                                                            cosy_entry_meta_item_comment_post_link();
                                                            ?>
                                                        </div>
                                                        <div class="entry-excerpt"><?php
                                                            add_filter('excerpt_length', create_function('','return 15;'), 1010);
                                                            the_excerpt();
                                                            remove_all_filters('excerpt_length', 1010);
                                                        ?> </div>
                                                        <div class="entry-meta-footer clearfix">
                                                            <a class="btn btn-outline btn-xs" href="<?php the_permalink();?>"><?php esc_html_e('Read more', 'cosy'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }

                                    echo '</div>';

                                }

                                wp_reset_postdata();

                            }

                            ?>
                        </div>

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
