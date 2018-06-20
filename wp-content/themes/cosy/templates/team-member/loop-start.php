<?php
global $cosy_loop;
$loop_id = isset($cosy_loop['loop_id']) ? $cosy_loop['loop_id'] : uniqid('la-team-member-');
$loop_style = isset($cosy_loop['loop_style']) ? $cosy_loop['loop_style'] : 1;
$responsive_column = isset($cosy_loop['responsive_column']) ? $cosy_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$excerpt_length = isset($cosy_loop['excerpt_length']) ? $cosy_loop['excerpt_length'] : 15;
$slider_configs = isset($cosy_loop['slider_configs']) ? $cosy_loop['slider_configs'] : '';

$loopCssClass = array('la-loop','team-member-loop');
$loopCssClass[] = 'loop-style-' . $loop_style;
if($loop_style == 1 || $loop_style == 2){
    $loopCssClass[] = 'loop--normal';
}
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