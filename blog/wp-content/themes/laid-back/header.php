<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;

wp_head();

?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text shadow_box" href="#main_wrap"><?php _e( 'Skip to content', 'laid-back' ); ?></a>
	<header id="h_wrap" class="h_wrap f_box f_col ai_c w100" itemscope itemtype="https://schema.org/WPHeader">
		<input type="checkbox" id="mh" class="dn" />
		<div class="h_top<?php if ( !has_nav_menu( 'primary' ) ) echo ' no_menu'; ?> wrap_frame f_box ai_c jc_sb f_col110 w100">

			<div class="h_logo_wrap f_box ai_c relative">

				<?php laid_back_header_logo_icon(); ?>
				<?php laid_back_header_logo_title(); ?>

				<?php
				if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'search_widget' ) || is_active_sidebar( 'header_widget' ) ) : ?>

					<label aria-label="Menu" for="mh" class="mh_button m0 tap_no dn001 relative f_box ai_c jc_c"><span></span></label>

				<?php endif; ?>

			</div>

			<label for="mh" class="mh_base tap_no dn001"></label>
			<div id="menu_wrap" class="f_box ai_c f_col110">
				<?php laid_back_primary_menu();
				laid_back_header_widget();
				?>

				<?php
				if( is_active_sidebar( 'search_widget' ) ) echo '<label for="sw" class="search_widget svg18 m0 p4 tap_no lh_1 ta_c" style="cursor:pointer;">'.laid_back_get_theme_svg( 'search' ).'</label>';
				?>
			</div>
		</div>

	</header>
