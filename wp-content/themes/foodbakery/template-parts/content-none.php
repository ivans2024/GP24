<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package foodbakery
 */
?>
<?php
if ( ! isset($_GET['s']) ):
	$_GET['s'] = '';
endif;
?>
<?php $searchg_string = $_GET['s']; ?>
<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_showing_search_results_for')); ?>: <?php echo esc_attr($searchg_string); ?></h1>
    </header><!-- .page-header -->

	<?php if ( is_home() && current_user_can('publish_posts') ) : ?>

		<p><?php printf(wp_kses(esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'foodbakery'), array( 'a' => array( 'href' => array() ) )), esc_url(admin_url('post-new.php'))); ?></p>

	<?php elseif ( is_search() ) : ?>
		<div class="search-results">

			<div class="suggestions">
				<h4 class="cs-color"><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_suggestioins')); ?>:</h4>
				<ul>
					<li><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_content_none_line1')); ?></li>
					<li><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_content_none_line2')); ?></li>
					<li><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_content_none_line3')); ?></li>
				</ul>

			</div>									

		</div>

		<div class="suggestion-search">
			<?php get_search_form() ?>
		</div>
		<?php
	else :
		?>

		<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'foodbakery'); ?></p>
		<?php
		get_search_form();

	endif;
	?>
</section><!-- .no-results -->
