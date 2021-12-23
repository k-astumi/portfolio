<?php
/**
 * Template Name: Without sidebar
 * Template Post Type: post,page
 *
 * @package Laid Back
 *
 */
__( 'Without sidebar', 'laid-back' );
get_header();
?>
<div class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents shadow_box br4'); ?>>
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/sort_order');
			get_template_part( 'template-parts/single/order' );
			$type_post = 'page';
			if(is_single()) $type_post = 'post';
			$function_name = 'laid_back_sort_order_custom_'.$type_post;
			laid_back_post_order( $type_post , $function_name() , $post);

		endwhile; ?>
	</main>
</div>
<?php get_footer();

