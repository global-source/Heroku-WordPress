.site-loading .la-image-loading {
    opacity: 1;
    visibility: visible
}
.la-image-loading.spinner-custom .content {
    width: 100px;
    margin-top: -50px;
    height: 100px;
    margin-left: -50px;
    text-align: center
}

.la-image-loading.spinner-custom .content img {
    width: auto;
    margin: 0 auto
}

.site-loading #page.site {
    opacity: 0;
    transition: all .3s ease-in-out
}

#page.site {
    opacity: 1
}
.la-image-loading {
    opacity: 0;
    position: fixed;
    z-index: 999999;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background: #fff;
    overflow: hidden;
    transition: all .3s ease-in-out;
    -webkit-transition: all .3s ease-in-out;
    visibility: hidden;
}

.la-image-loading .content {
    position: absolute;
    width: 50px;
    height: 50px;
    top: 50%;
    left: 50%;
    margin-left: -25px;
    margin-top: -25px;
}

<?php
$current_context = Cosy()->get_current_context();

$page_title_bar_func = 'get';
if(Cosy()->settings->get_setting_by_context('page_title_bar_style', 'no') == 'yes'){
    $page_title_bar_func = 'get_setting_by_context';
}

//if(in_array('is_product', $current_context) || in_array('is_shop', $current_context) || in_array('is_product_taxonomy', $current_context)){
//    $page_title_bar_func = 'get_setting_by_context';
//}

$page_title_bar_bg = Cosy()->settings->$page_title_bar_func('page_title_bar_background');
$page_title_bar_heading_color = Cosy()->settings->$page_title_bar_func('page_title_bar_heading_color', '#252634');
$page_title_bar_text_color = Cosy()->settings->$page_title_bar_func('page_title_bar_text_color', '#8a8a8a');
$page_title_bar_link_color = Cosy()->settings->$page_title_bar_func('page_title_bar_link_color', '#8a8a8a');
$page_title_bar_link_hover_color = Cosy()->settings->$page_title_bar_func('page_title_bar_link_hover_color', '#343538');
$page_title_bar_spacing = Cosy()->settings->$page_title_bar_func('page_title_bar_spacing');
$page_title_bar_spacing_tablet = Cosy()->settings->$page_title_bar_func('page_title_bar_spacing_tablet');
$page_title_bar_spacing_mobile = Cosy()->settings->$page_title_bar_func('page_title_bar_spacing_mobile');

$page_title_bar_bg = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), $page_title_bar_bg);

$page_title_bar_spacing = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing );

$page_title_bar_spacing_tablet = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing_tablet );

$page_title_bar_spacing_mobile = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing_mobile );

?>
.section-page-header{
    color: <?php echo esc_url($page_title_bar_text_color); ?>;
    <?php Cosy_Helper::render_background_atts($page_title_bar_bg);?>
}
.section-page-header .page-title{
    color: <?php echo esc_url($page_title_bar_heading_color); ?>;
}
.section-page-header a{
    color: <?php echo esc_url($page_title_bar_link_color); ?>;
}
.section-page-header a:hover{
    color: <?php echo esc_url($page_title_bar_link_hover_color); ?>;
}
.section-page-header .page-header-inner{
    padding-top: <?php echo absint($page_title_bar_spacing_mobile['top']) ?>px;
    padding-bottom: <?php echo absint($page_title_bar_spacing_mobile['bottom']) ?>px;
}
@media(min-width: 768px){
    .section-page-header .page-header-inner{
        padding-top: <?php echo absint($page_title_bar_spacing_tablet['top']) ?>px;
        padding-bottom: <?php echo absint($page_title_bar_spacing_tablet['bottom']) ?>px;
    }
}
@media(min-width: 992px){
    .section-page-header .page-header-inner{
        padding-top: <?php echo absint($page_title_bar_spacing['top']) ?>px;
        padding-bottom: <?php echo absint($page_title_bar_spacing['bottom']) ?>px;
    }
}

<?php
$main_space = Cosy()->settings->get_setting_by_context('main_space');
if(!empty($main_space) && is_array($main_space)){
    $main_space = shortcode_atts(array(
        'top' => '',
        'bottom' => ''
    ), $main_space);
    echo '.site-main{';
    if($main_space['top'] != ''){
        echo  'padding-top:' . absint($main_space['top']) . 'px;';
    }
    if($main_space['bottom'] != ''){
        echo  'padding-bottom:' . absint($main_space['bottom']) . 'px';
    }
    echo '}';
}

$font_source = Cosy()->settings->get('font_source', 1);

$body_font_family = '';
$heading_font_family = '';
$highlight_font_family = '';

switch ($font_source) {
    case '1':

        $_s_main_font = (array) Cosy()->settings->get('main_font');
        $_s_secondary_font = (array) Cosy()->settings->get('secondary_font');
        $_s_highlight_font = (array) Cosy()->settings->get('highlight_font');

        if(!empty($_s_main_font['family'])){
            $body_font_family = '"' . $_s_main_font['family'] . '"';
        }
        if(!empty($_s_secondary_font['family'])){
            $heading_font_family = '"' . $_s_secondary_font['family'] . '"';
        }
        if(!empty($_s_highlight_font['family'])){
            $highlight_font_family = '"' . $_s_highlight_font['family'] . '"';
        }

        break;

    case '2':
        $body_font_family = Cosy()->settings->get('main_google_font_face');
        $heading_font_family = Cosy()->settings->get('secondary_google_font_face');
        $highlight_font_family = Cosy()->settings->get('highlight_google_font_face');
        break;

    case '3':
        $body_font_family = Cosy()->settings->get('main_typekit_font_face');
        $heading_font_family = Cosy()->settings->get('secondary_typekit_font_face');
        $highlight_font_family = Cosy()->settings->get('highlight_typekit_font_face');
        break;
}

$body_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Cosy()->settings->get('body_background'));

$header_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Cosy()->settings->get('header_background'));

$transparency_header_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => 'rgba(0,0,0,0)'
), Cosy()->settings->get('transparency_header_background'));

$footer_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Cosy()->settings->get('footer_background'));

$body_boxed = Cosy()->settings->get('body_boxed', 'no');
$body_boxed_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), Cosy()->settings->get('body_boxed_background'));

$popup_background =  shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), Cosy()->settings->get('popup_background'));

?>
body.cosy-body{
    font-size: <?php echo esc_attr(Cosy()->settings->get('body_font_size', 16)) ?>px;
    <?php Cosy_Helper::render_background_atts($body_background);?>
}
body.cosy-body.body-boxed #page.site{
    width: <?php echo esc_attr(Cosy()->settings->get('body_max_width', 1230)) ?>px;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    <?php Cosy_Helper::render_background_atts($body_boxed_background);?>
}
#masthead_aside,
.site-header .site-header-inner{
    <?php Cosy_Helper::render_background_atts($header_background);?>
}
.enable-header-transparency .site-header:not(.is-sticky) .site-header-inner{
    <?php Cosy_Helper::render_background_atts($transparency_header_background);?>
}
.site-footer{
    <?php Cosy_Helper::render_background_atts($footer_background);?>
}

.open-newsletter-popup .lightcase-inlineWrap{
<?php Cosy_Helper::render_background_atts($popup_background);?>
}

<?php if( Cosy()->settings->get('catalog_mode', 'off') == 'on'){
    if( Cosy()->settings->get('catalog_mode_price', 'off') == 'on'){
?>
.woocommerce .product-price,
.woocommerce span.price,
.woocommerce div.price,
.woocommerce p.price{
    display: none !important;
}
<?php
    }
}
?>
.products-grid-countdown .elm-countdown {
    position: absolute;
    top: 50px;
    right: 20px;
    width: 50px;
}

.elm-countdown-style-vertical .countdown-row .countdown-section {
    width: 100%;
    display: block;
    margin: 10px 0;
    float: left;
}

.elm-countdown-style-vertical .countdown-row .countdown-section span {
    display: block;
    text-align: center;
    line-height: normal;
    font-size: 14px;
}

.elm-countdown-style-vertical .countdown-row .countdown-section span.countdown-amount {
    font-size: 24px;
}

.elm-countdown-style-vertical .countdown-row .countdown-section span.countdown-period {
    color: <?php echo esc_attr( Cosy()->settings->get("primary_color","#35d56a") ) ?>;
    font-style: italic;
    text-transform: lowercase;
    line-height: 1;
    font-family: <?php echo ( $highlight_font_family ) ?>;
}
