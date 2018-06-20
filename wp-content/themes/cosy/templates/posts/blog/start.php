<?php
global $cosy_loop;
$loop_id = isset($cosy_loop['loop_id']) ? $cosy_loop['loop_id'] : uniqid('la-showposts-');
$layout = isset($cosy_loop['loop_layout']) ? $cosy_loop['loop_layout'] : 'grid';
$style = isset($cosy_loop['loop_style']) ? $cosy_loop['loop_style'] : 1;
$responsive_column = isset($cosy_loop['responsive_column']) ? $cosy_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$slider_configs = isset($cosy_loop['slider_configs']) ? $cosy_loop['slider_configs'] : '';

$loopCssClass = array('la-loop','showposts-loop');
$loopCssClass[] = "$layout-$style";
$loopCssClass[] = 'showposts-' . $layout;

$loopCssClass[] = 'grid-items';

if(!empty($slider_configs)){
    $loopCssClass[] = 'la-slick-slider';
}else{
    foreach( $responsive_column as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}
?>
<div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
if(!empty($slider_configs)){
    echo ' data-slider_config="'. esc_attr( $slider_configs ) .'"';
}
?>>