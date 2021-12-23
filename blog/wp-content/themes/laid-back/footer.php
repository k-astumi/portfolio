<?php defined( 'ABSPATH' ) || exit; ?>

<footer id="site_f" itemscope itemtype="https://schema.org/WPFooter">

	<?php
	laid_back_show_footer_widget();

	if( has_nav_menu('secondary') ) laid_back_footer_menu(); ?>

	<div class="f_credit_wrap wrap_frame">
		<div class="f_credit f_box jc_sb f_wrap fs12 w100">


			<?php if( has_nav_menu('credit_1') ) laid_back_credit_menu(1); ?>
			<?php if( has_nav_menu('credit_2') ) laid_back_credit_menu(2); ?>
			<?php if( has_nav_menu('credit_3') ) laid_back_credit_menu(3); ?>
			<?php if( has_nav_menu('credit_4') ) laid_back_credit_menu(4); ?>
			<div class="">
				<?php
				if ( is_active_sidebar( 'credit_widget' ) ) : ?>
					<div class="f_credit_widget mb_M"><?php dynamic_sidebar('credit_widget'); ?></div>
					<?php
				endif;
				?>
				<span class="fsM"><?php echo get_bloginfo('description' , 'display'); ?></span>

				<div class="fsS">
					&copy;<?php echo esc_html( get_theme_mod( 'laid_back_footer_copyright_year', date('Y') ) ) .' <a href="'. esc_url( home_url() ).'">'.esc_html( get_bloginfo('name') , 'display' ).'</a>';

					$local_url = '';
					if( get_locale() !== 'ja' )$local_url = 'en/';
					?>
				</div>
			</div>
			<div class="f_box ai_c p16_0 w100">
				<div class="mr8">Powered by <a href="<?php echo esc_attr__( 'https://wordpress.org/', 'laid-back' ); ?>">WordPress</a></div>
				<div class="">Theme by <a href="<?php echo esc_attr__('https://dev.back2nature.jp/en/laid-back/', 'laid-back'); ?>">Laid Back</a></div>
			</div>
		</div>
	</div>
</footer>

<?php if( is_active_sidebar( 'footer-fixed' ) ) : ?>
	<div class="fix_footer dn001 z2">
		<?php dynamic_sidebar( 'footer-fixed' ); ?>
	</div>
	<?php
endif;

if( is_active_sidebar( 'search_widget' ) ) laid_back_header_search_widget();

wp_footer();
?>
</body>
</html>
