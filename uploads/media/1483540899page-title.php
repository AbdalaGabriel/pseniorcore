<?php
/**
 * The template for displaying page title
 *
 * @package WordPress
 * @subpackage orion
 * @since orion v1.0
 */
global $post;
$page_title = '';
$page_title_enable = 1;
$page_title_layout = '';
$page_breadcrumbs_enable = 1;
$page_title_bg_image = '';
$page_title_left_style = '';

$page_title_layout = g5plus_get_option('page_title_layout', 'normal');
$page_title_padding = g5plus_get_option('page_title_padding', array('padding-top' => '145px', 'padding-bottom' => '145px'));
$page_title_parallax = g5plus_get_option('page_title_parallax', 1);
$has_frame = g5plus_get_option('page_title_frame');
$page_title_text_color = g5plus_get_option('page_title_text_color');

$page_id  = isset($post) ? $post->ID : null;
if( function_exists('wc_get_page_id') && function_exists('is_shop') && is_shop()){
    $page_id =  wc_get_page_id('shop');
}
if (is_home()) {
    $page_id = get_option('page_for_posts');
}
if (is_front_page()) {
    $page_id = get_option('page_on_front');
}

if($page_title===''){
    if (is_home()) {
        if (empty($page_title)) {
            $page_title = esc_html__("Our Blog", 'g5plus-orion');
        }
    } elseif (!is_singular() && !is_front_page()) {
        if (!have_posts()) {
            $page_title = esc_html__('404 Page', 'g5plus-orion');
        } elseif (is_tag() || is_tax('product_tag')) {
            $page_title = single_tag_title(esc_html__("Tags: ", 'g5plus-orion'), false);
        } elseif (is_category() || is_tax()) {
            $page_title = single_cat_title('', false);
        } elseif (is_author()) {
            $page_title = sprintf(esc_html__('Author: %s', 'g5plus-orion'), get_the_author());
        } elseif (is_day()) {
            $page_title = sprintf(esc_html__('Daily Archives: %s', 'g5plus-orion'), get_the_date());
        } elseif (is_month()) {
            $page_title = sprintf(esc_html__('Monthly Archives: %s', 'g5plus-orion'), get_the_date(_x('F Y', 'monthly archives date format', 'g5plus-orion')));
        } elseif (is_year()) {
            $page_title = sprintf(esc_html__('Yearly Archives: %s', 'g5plus-orion'), get_the_date(_x('Y', 'yearly archives date format', 'g5plus-orion')));
        } elseif (is_search()) {
            $page_title = sprintf(esc_html__('Search Results: &ldquo;%s&rdquo;', 'g5plus-orion'), get_search_query());
        } elseif (is_tax('post_format', 'post-format-aside')) {
            $page_title = esc_html__('Asides', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $page_title = esc_html__('Galleries', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $page_title = esc_html__('Images', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $page_title = esc_html__('Videos', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $page_title = esc_html__('Quotes', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $page_title = esc_html__('Links', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $page_title = esc_html__('Statuses', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $page_title = esc_html__('Audios', 'g5plus-orion');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $page_title = esc_html__('Chats', 'g5plus-orion');
        }

        $cat = get_queried_object();
        // custom page title background
        if ($cat && property_exists($cat, 'term_id')) {
            $page_title_enable = g5plus_get_tax_meta($cat->term_id, 'page_title_enable');

            if ($page_title_enable != '' && $page_title_enable != -1) {
                return;
            }
            $bg_image = g5plus_get_tax_meta($cat->term_id, 'page_title_bg_image');
            if (isset($bg_image['url'])) {
                $page_title_bg_image = $bg_image['url'];
            }
        }
    }
}

$page_title_enable = g5plus_get_rwmb_meta('custom_page_title_visible', array(),$page_id);

$page_breadcrumbs_enable = g5plus_get_rwmb_meta('custom_breadcrumbs_visible', array(),$page_id);

if($page_breadcrumbs_enable==='-1' || $page_breadcrumbs_enable==='' || is_404()){
    $page_breadcrumbs_enable = g5plus_get_option('breadcrumbs_enable', 1);
}
if($page_title_enable==='-1' || $page_title_enable==='' || is_404()){
    $page_title_enable = g5plus_get_option('page_title_enable', 1);
}

if(!$page_title_enable)
    return;

if (g5plus_get_rwmb_meta('is_custom_page_title', array(),$page_id) == '1') {
    $page_title = g5plus_get_rwmb_meta('custom_page_title', array(),$page_id);

} else {
    $page_title = g5plus_get_option('page_title', $page_title);
    $page_title = $page_title ? $page_title : get_the_title(get_the_ID());
}

if (g5plus_get_rwmb_meta('is_custom_page_title_bg', array(),$page_id) == '1') {
    $page_title_bg_image = g5plus_get_rwmb_meta_image('custom_page_title_bg_image', array(),$page_id);
} else {
    $page_title_bg_image = g5plus_get_option('page_title_bg_image', array('url' => ''));
    $page_title_bg_image = isset($page_title_bg_image['url']) ? $page_title_bg_image['url'] : '';
}



$page_title = apply_filters('g5plus_page_title', $page_title);

$page_title_class = array('page-title');

//check frame
if($has_frame){
    $page_title_class[] = 'page-title-has-frame';
}

//text color
if (g5plus_get_rwmb_meta('is_custom_page_title_bg', array(),$page_id) == '1') {
    $page_title_text_color = g5plus_get_rwmb_meta('custom_page_title_text_color', array(),$page_id);
}
if($page_title_text_color != 'default'){
    $page_title_class[] = $page_title_text_color;
}

$page_title_class[] = 'page-title-layout-' . $page_title_layout;

// region Custom Styles

$custom_styles = array();
$page_title_left = array();
if (isset($page_title_padding['padding-top']) && !empty($page_title_padding['padding-top']) && ($page_title_padding['padding-top'] != 'px')) {
    $page_title_left[] = "padding-top:" . $page_title_padding['padding-top'] . (strpos($page_title_padding['padding-top'],'px') ? '' : 'px');
}
if (isset($page_title_padding['padding-bottom']) && !empty($page_title_padding['padding-bottom']) && ($page_title_padding['padding-bottom'] != 'px')) {
    $page_title_left[] = "padding-bottom:" . $page_title_padding['padding-bottom'] . (strpos($page_title_padding['padding-bottom'],'px') ? '' : 'px');
}
if ($page_title_left) {
    $page_title_left_style = 'style="' . join(';', $page_title_left) . '"';
}

if (!empty($page_title_bg_image)) {
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image . ')';
    $page_title_class[] = 'page-title-background';

    if ($page_title_parallax) {
        $page_title_class[] = 'parallax';
    }
}else{
    $page_title_class[] = 'no-background-image';
}

$custom_style = '';
if ($custom_styles) {
    $custom_style = 'style="' . join(';', $custom_styles) . '"';
}
if (!empty($page_title_bg_image) && $page_title_parallax) {
    $custom_style .= ' data-stellar-background-ratio="0.5"';
}

if(isset(g5plus_get_option('page_title_background_color')['rgba'])) {
    $page_title_bg_color = g5plus_get_option('page_title_background_color')['rgba'];
}elseif(isset(g5plus_get_option('page_title_background_color')['color'])){
    $page_title_bg_color = g5plus_get_option('page_title_background_color')['color'];
}else{
    $page_title_bg_color_opacity = g5plus_get_option('page_title_background_color_rgba', 0)/100;
    $page_title_background_color = g5plus_get_option('page_title_background_color');
    $page_title_bg_color = g5plus_hex2rgba($page_title_background_color,$page_title_bg_color_opacity);
}

if (g5plus_get_rwmb_meta('is_custom_page_title_bg', array(),$page_id) == '1') {
    $page_title_bg_color_opacity = g5plus_get_rwmb_meta('custom_page_title_bg_color_rgba','type=slider',$page_id);
    $page_title_bg_color = g5plus_get_rwmb_meta('custom_page_title_bg_color', array(),$page_id);
    $page_title_bg_color = g5plus_hex2rgba($page_title_bg_color,$page_title_bg_color_opacity);
}

$overlay_styles = array();
if(!empty($page_title_bg_color)){
    $overlay_styles[] = 'background-color: '.$page_title_bg_color.';';
}
$overlay_style = '';
if ($overlay_styles) {
    $overlay_style = 'style="' . join(';', $overlay_styles) . '"';
}
// endregion
?>
<section class="<?php echo join(' ', $page_title_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
    <div class="page-title-overlay" <?php echo wp_kses_post($overlay_style); ?>>
        <div class="container">
            <div class="page-title-inner">
                <div class="page-title-left" <?php echo wp_kses_post($page_title_left_style); ?>>
                    <div class="page-title-heading">
                        <h1><?php echo esc_html($page_title) ?></h1>
                        <?php if ($page_breadcrumbs_enable) {
                            get_template_part('templates/breadcrumb');
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
