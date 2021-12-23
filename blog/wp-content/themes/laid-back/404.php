<?php defined( 'ABSPATH' ) || exit;
get_header();

?>
<div id="main_wrap" class="main_wrap wrap_frame f_box f_col110 jc_c001">
	<main id="page404" <?php post_class('main_contents post_contents br4'); ?>>
		<h1 class="ta_c mb_M">404</h1>
		<h2 class="ta_c"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'laid-back' ); ?></h2>
	</main>
</div>
<?php get_footer();
