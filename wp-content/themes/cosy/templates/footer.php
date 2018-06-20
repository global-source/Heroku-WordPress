<?php
$footer_layout = Cosy()->layout->get_footer_layout();
$number_col = absint(substr(ltrim($footer_layout),0,1));

$footer_copyright = Cosy()->settings->get('footer_copyright');

if($number_col < 1) $number_col = 1;
?>
<footer id="colophon" class="site-footer la-footer-<?php echo esc_attr($footer_layout)?>">
    <?php if($footer_layout == '4col_cosy1' || $footer_layout == '4col_cosy2'): ?>
    <div class="footer-wrap">
        <div class="container">
            <div class="row">
                <div class="footer-row-column footer-row-column-1">
                    <div class="row">
                        <?php if( $footer_layout == '4col_cosy1' ): ?>
                            <?php
                            for ( $i = 1; $i <= 3; $i++ ){
                                echo '<div class="footer-column footer-column-'.esc_attr($i).'">';
                                dynamic_sidebar( apply_filters('cosy/filter/footer_column_'. $i, 'f-col-'. $i, $footer_layout));
                                echo '</div>';
                            }
                            ?>
                        <?php else: ?>
                            <div class="footer-column footer-column-1">
                                <?php dynamic_sidebar( apply_filters('cosy/filter/footer_column_1', 'f-col-1', $footer_layout)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if( $footer_layout == '4col_cosy1' ): ?>
                        <?php if(Cosy()->settings->get('enable_footer_copyright','no') == 'yes' && !empty($footer_copyright)): ?>
                            <div class="footer-bottom">
                                <div class="footer-bottom-inner">
                                    <?php echo Cosy_Helper::remove_js_autop( $footer_copyright );?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="footer-row-column footer-row-column-2">
                    <div class="row">
                        <?php if( $footer_layout == '4col_cosy1' ): ?>
                            <div class="footer-column footer-column-4">
                                <?php dynamic_sidebar( apply_filters('cosy/filter/footer_column_4', 'f-col-4', $footer_layout)); ?>
                            </div>
                        <?php else: ?>
                            <?php
                            for ( $i = 2; $i <= 4; $i++ ){
                                echo '<div class="footer-column footer-column-'.esc_attr($i).'">';
                                dynamic_sidebar( apply_filters('cosy/filter/footer_column_'. $i, 'f-col-'. $i, $footer_layout));
                                echo '</div>';
                            }
                            ?>
                        <?php endif; ?>
                    </div>
                    <?php if( $footer_layout == '4col_cosy2' ): ?>
                        <?php if(Cosy()->settings->get('enable_footer_copyright','no') == 'yes' && !empty($footer_copyright)): ?>
                            <div class="footer-bottom">
                                <div class="footer-bottom-inner">
                                    <?php echo Cosy_Helper::remove_js_autop( $footer_copyright );?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <?php
                    for ( $i = 1; $i <= $number_col; $i++ ){
                        echo '<div class="footer-column footer-column-'.esc_attr($i).'">';
                        dynamic_sidebar( apply_filters('cosy/filter/footer_column_'. $i, 'f-col-'. $i, $footer_layout));
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php if(Cosy()->settings->get('enable_footer_copyright','no') == 'yes' && !empty($footer_copyright)): ?>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom-inner">
                        <?php echo Cosy_Helper::remove_js_autop( $footer_copyright );?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif;?>
</footer>
<!-- #colophon -->