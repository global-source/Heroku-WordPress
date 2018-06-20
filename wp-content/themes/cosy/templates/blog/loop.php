<?php

global $cosy_loop;

$blog_design = isset($cosy_loop['blog_design']) ? $cosy_loop['blog_design'] : 'grid';
$show_featured_image    = (Cosy()->settings->get('featured_images_blog') == 'on') ? true : false;
$show_format_content    = false;
$tmp_img_size           = Cosy_Helper::get_image_size_from_string(Cosy()->settings->get('blog_thumbnail_size', 'full'), 'full');
$thumbnail_size2        = Cosy_Helper::get_image_size_from_string(Cosy()->settings->get('blog_thumbnail_size2', 'full'), 'full');
$content_display_type   = ( Cosy()->settings->get('blog_content_display', 'excerpt') == 'excerpt') ? 'excerpt' : 'full';
$post_class             = array('loop-item','grid-item','post-item');
if($show_featured_image){
    $show_format_content    = (Cosy()->settings->get('format_content_blog') == 'on') ? true : false;
}

if($show_featured_image){
    $post_class[] = 'show-featured-image';
}else{
    $post_class[] = 'hide-featured-image';
}
if($show_format_content){
    $post_class[] = 'show-format-content';
}else{
    $post_class[] = 'hide-format-content';
}
if($content_display_type != 'full' && !Cosy()->settings->get('blog_excerpt_length')){
    $post_class[] = 'hide-excerpt';
}

$thumbnail_size = $tmp_img_size;

$loop_index = isset($cosy_loop['loop_index']) ? $cosy_loop['loop_index'] : 0;
$loop_index++;
$cosy_loop['loop_index'] = $loop_index;

if($blog_design == 'list_1'){

    if( ($loop_index - 1) % 3 == 0 ){
        $thumbnail_size = $thumbnail_size2;
    }
    else{
        $thumbnail_size = $tmp_img_size;
    }
}

$thumbnail_size = apply_filters('cosy/filter/blog/post_thumbnail', $thumbnail_size, $cosy_loop);
?>
<article <?php post_class($post_class); ?>>
    <div class="item-inner">
        <div class="item-inner-wrap">
            <?php
            if($show_featured_image){
                $flag_format_content = false;
                if($show_format_content){
                    switch(get_post_format()){
                        case 'link':
                            $link = Cosy()->settings->get_post_meta( get_the_ID(), 'format_link' );
                            if(!empty($link)){
                                printf(
                                    '<div class="entry-thumbnail format-link" %2$s><div class="format-content">%1$s</div><a class="post-link-overlay" href="%1$s"></a></div>',
                                    esc_url($link),
                                    ''
                                    /* has_post_thumbnail() ? 'style="background-image:url('.Cosy()->images->get_post_thumbnail_url(get_the_ID()).')"' : '' */
                                );
                                $flag_format_content = true;
                            }
                            break;
                        case 'quote':
                            $quote_content = Cosy()->settings->get_post_meta(get_the_ID(), 'format_quote_content');
                            $quote_author = Cosy()->settings->get_post_meta(get_the_ID(), 'format_quote_author');
                            $quote_background = Cosy()->settings->get_post_meta(get_the_ID(), 'format_quote_background');
                            $quote_color = Cosy()->settings->get_post_meta(get_the_ID(), 'format_quote_color');
                            if(!empty($quote_content)){
                                $quote_content = '<p class="format-quote-content">'. $quote_content .'</p>';
                                if(!empty($quote_author)){
                                    $quote_content .= '<span class="quote-author">'. $quote_author .'</span>';
                                }
                                $styles = array();
                                $styles[] = 'background-color:' . $quote_background;
                                $styles[] = 'color:' . $quote_color;
                                printf(
                                    '<div class="entry-thumbnail format-quote" style="%3$s"><div class="format-content">%1$s</div><a class="post-link-overlay" href="%2$s"></a></div>',
                                    $quote_content,
                                    get_the_permalink(),
                                    esc_attr( implode(';', $styles) )
                                );
                                $flag_format_content = true;
                            }

                            break;

                        case 'gallery':
                            $ids = Cosy()->settings->get_post_meta(get_the_ID(), 'format_gallery');
                            $ids = explode(',', $ids);
                            $ids = array_map('trim', $ids);
                            $ids = array_map('absint', $ids);
                            $__tmp = '';
                            if(!empty( $ids )){
                                foreach($ids as $image_id){
                                    $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                        get_the_permalink(),
                                        Cosy()->images->get_attachment_image( $image_id, $thumbnail_size)
                                    );
                                }
                            }
                            if(has_post_thumbnail()){
                                $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                    get_the_permalink(),
                                    Cosy()->images->get_post_thumbnail(get_the_ID(), $thumbnail_size )
                                );
                            }
                            if(!empty($__tmp)){
                                printf(
                                    '<div class="entry-thumbnail format-gallery"><div class="la-slick-slider" data-slider_config="%1$s">%2$s</div></div>',
                                    esc_attr(json_encode(array(
                                        'slidesToShow' => 1,
                                        'slidesToScroll' => 1,
                                        'dots' => false,
                                        'arrows' => true,
                                        'speed' => 300,
                                        'autoplay' => false,
                                        'prevArrow'=> '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                                        'nextArrow'=> '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
                                    ))),
                                    $__tmp
                                );
                                $flag_format_content = true;
                            }
                            break;

                        case 'audio':
                        case 'video':
                            $embed_source = Cosy()->settings->get_post_meta(get_the_ID(), 'format_embed');
                            $embed_aspect_ration = Cosy()->settings->get_post_meta(get_the_ID(), 'format_embed_aspect_ration');
                            if(!empty($embed_source)){
                                $flag_format_content = true;
                                printf(
                                    '<div class="entry-thumbnail format-embed"><div class="la-media-wrapper la-media-aspect-%2$s">%1$s</div></div>',
                                    balanceTags($embed_source, true),
                                    esc_attr($embed_aspect_ration ? $embed_aspect_ration : 'origin')
                                );
                            }
                            break;
                    }
                }
                if(!$flag_format_content && has_post_thumbnail()){ ?>
                    <div class="entry-thumbnail blog-item-has-effect">
                        <a href="<?php the_permalink();?>">
                            <?php Cosy()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                            <span class="pf-icon pf-icon-<?php echo get_post_format() ? get_post_format() : 'standard' ?>"></span>
                            <div class="item--overlay"></div>
                        </a>
                    </div>
                <?php
                }
            }
            ?>
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
                <?php
                if($content_display_type != 'full'){
                    if( Cosy()->settings->get('blog_excerpt_length') ){
                        echo '<div class="entry-excerpt">';
                        the_excerpt();
                        echo '</div>';
                    }
                }
                else{
                    echo '<div class="entry-content">';
                    the_content( esc_html__( 'Continue reading', 'cosy' ) );
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cosy' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cosy' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    echo '</div>';
                }
                ?>
                <footer class="entry-meta-footer clearfix">
                    <a class="btn btn-outline btn-xs" href="<?php the_permalink();?>"><?php esc_html_e('Read more', 'cosy'); ?></a>
                </footer>
            </div>
        </div>
    </div>
</article>