<?php
global $cosy_loop;
$loop_style     = isset($cosy_loop['loop_style']) ? $cosy_loop['loop_style'] : 1;
$title_tag      = (isset($cosy_loop['title_tag']) && !empty($cosy_loop['title_tag']) ? $cosy_loop['title_tag'] : 'div');
$role           = Cosy()->settings->get_post_meta(get_the_ID(),'role');
$content        = Cosy()->settings->get_post_meta(get_the_ID(),'content');
$avatar         = Cosy()->settings->get_post_meta(get_the_ID(),'avatar');
$post_class     = array('loop-item','grid-item','testimonial-item');
?>
<div <?php post_class($post_class)?>>
    <div class="item-inner">
        <div class="item--info">
            <div class="item--excerpt"><?php echo esc_html($content);?></div>
        </div>
        <div class="item--bottom">
            <?php if($avatar): ?>
            <div class="item--image"><?php
                echo wp_get_attachment_image($avatar, 'full');
                ?></div>
            <?php endif; ?>
            <div class="item--title-role">
                <?php
                printf(
                    '<%1$s class="%4$s">%3$s</%1$s>',
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
            </div>
        </div>
    </div>
</div>