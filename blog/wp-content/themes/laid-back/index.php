<?php defined( 'ABSPATH' ) || exit;
get_header(); ?>
<div id="main_wrap" class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<div class="w100"><?php  ?>
		<main class="main_contents index_contents f_box f_wrap jc_sb br4">
			<?php
			if(have_posts()):

				get_template_part( 'template-parts/index/content' );

			else:

				get_template_part( 'template-parts/index/content', 'none' );

			endif;

			?>
		</main>
		<?php laid_back_the_posts_pagination(); ?>
	</div>
	<?php if(LAID_BACK_SIDEBAR) laid_back_show_sidebar(); ?>
</div>
<?php get_footer();
