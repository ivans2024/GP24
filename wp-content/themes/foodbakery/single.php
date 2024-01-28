<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package foodbakery
 */
foodbakery_post_views_count(get_the_ID());
get_header();

$foodbakery_var_options = FOODBAKERY_VAR_GLOBALS()->theme_options();
$section_margin_class = 'page-margin';
$foodbakery_var_page_margin_switch = get_post_meta($post->ID, 'foodbakery_var_page_margin_switch', true);
if ( $foodbakery_var_page_margin_switch == 'on' ) {
	$section_margin_class = 'page-margin';
}
?>
<div class="main-section <?php esc_attr($section_margin_class); ?>">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part('template-parts/blog-detail/default_view', get_post_format());
	endwhile; // End of the loop.
	?>
</div>
<?php
get_footer();
