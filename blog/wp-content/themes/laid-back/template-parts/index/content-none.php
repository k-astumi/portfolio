<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Laid Back
 */

?>
<div class="shadow_box p16 bg_fff m0a">

	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p>
			<?php esc_html_e( 'Ready to publish your first post?', 'laid-back'); ?>
			<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
				<?php esc_html_e( 'Get started here.', 'laid-back' ); ?>
			</a>
		</p>

		<?php
	elseif ( is_search() ) :
		?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'laid-back' ); ?></p>
		<p class="mb_L"><?php esc_html_e( 'Please try again with some different keywords.', 'laid-back' ); ?></p>
		<?php
		get_search_form();

	else :
		?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'laid-back' ); ?></p>
		<p class="mb_L"><?php esc_html_e( 'Perhaps searching can help.', 'laid-back' ); ?></p>
		<?php
		get_search_form();
	endif;
	?>


</div>
