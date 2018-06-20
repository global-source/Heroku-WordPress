<?php
global $cosy_loop;
$thumbnail_size = (isset($cosy_loop['image_size']) && !empty($cosy_loop['image_size']) ? $cosy_loop['image_size'] : 'thumbnail');
$title_tag      = (isset($cosy_loop['title_tag']) && !empty($cosy_loop['title_tag']) ? $cosy_loop['title_tag'] : 'h3');
$role           = Cosy()->settings->get_post_meta(get_the_ID(), 'role');
$post_class     = array('loop-item','grid-item','team-member-item');
?>
<article <?php post_class($post_class)?>>
    <div class="item-inner">
        <div class="item--image">
            <a href="javascript:;"><?php
                Cosy()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size);
            ?><div class="item--overlay"></div></a>
        </div>
        <div class="item--info">
            <?php
            printf(
                '<%1$s class="%4$s"><a href="%2$s">%3$s</a></%1$s>',
                esc_attr($title_tag),
                'javascript:;',
                get_the_title(),
                'item--title'
            );
            if(!empty($role)){
                printf(
                    '<p class="item--role">%s</p>',
                    esc_html($role)
                );
            }
            ?>
            <?php Cosy()->template->member_social_template(get_the_ID()); ?>
        </div>
    </div>
</article>