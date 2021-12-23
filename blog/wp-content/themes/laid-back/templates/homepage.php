<?php defined( 'ABSPATH' ) || exit;
/**
 * Template Name: Custom Homepage
 * Template Post Type: page
 *
 * @package Laid Back
 *
 */
__( 'Custom Homepage', 'laid-back' );
get_header();
?>
<div class="main_wrap wrap_frame hp_wrap f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents page_contents hp_contents shadow_box br4'); ?>>
		<?php
		dynamic_sidebar( 'custom_homepage' );
		while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>
	</main>
</div>
<?php get_footer();
