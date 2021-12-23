<?php defined( 'ABSPATH' ) || exit;
get_header();

if ( get_theme_mod( 'laid_back_page_header_breadcrumbs' , false) ){
	laid_back_header_breadcrumbs();
}

?>
<div id="main_wrap" class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents page_contents shadow_box br4'); ?>>
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/sort_order');
			get_template_part( 'template-parts/single/order' );

			laid_back_post_order( 'page' , laid_back_sort_order_custom_page() , $post);

		endwhile; ?>
	</main>
	<?php if(LAID_BACK_SIDEBAR) laid_back_show_sidebar(); ?>
</div>
<?php get_footer();
