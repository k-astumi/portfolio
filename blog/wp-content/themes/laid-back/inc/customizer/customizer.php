<?php
defined( 'ABSPATH' ) || exit;

add_action( 'customize_register' , array( 'LAID_BACK_CUSTOMIZER' , 'register' ) );

class LAID_BACK_CUSTOMIZER {

	public static function register ( $wp_customize ) {

		
		require_once LAID_BACK_THEME_DIR . 'template-parts/single/sort_order.php';
		
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/sanitize.php';

		
		$wp_customize->add_setting( 'laid_back_header_icon',array(
			'default'    => '',
			'sanitize_callback' => 'laid_back_sanitize_image_file',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'laid_back_header_icon', array(
			'label' => esc_html__( 'Icon Image', 'laid-back'),
			'section' => 'title_tagline',
		)));


		
		$wp_customize->add_panel( 'posts_panel', array(
			//'priority'    => 1,
			'title'       => esc_html__('Posts', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-posts.php';

		
		$wp_customize->add_panel( 'pages_panel', array(
			//'priority'    => 1,
			'title'       => esc_html__('Pages', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-pages.php';

		
		$wp_customize->add_panel( 'sidebar_panel', array(
			'title'       => esc_html__('Sidebar', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-sidebar.php';

		
		$wp_customize->add_panel( 'header_panel', array(
			'title'       => esc_html__('Header', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-header.php';

		
		$wp_customize->add_panel( 'footer_panel', array(
			'title'       => esc_html__('Footer', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-footer.php';

		
		$wp_customize->add_panel( 'index_panel', array(
			'title'       => esc_html__('Index', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-index.php';

		
		$wp_customize->add_panel( 'block_panel', array(
			'title'       => esc_html__('Block', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-block.php';

		
		$wp_customize->add_panel( 'yahman_addon_panel', array(
			'title'       => esc_html__('YAHMAN Add-ons', 'laid-back'),
		));
		require_once LAID_BACK_THEME_DIR . 'inc/customizer/setting-yahman_addon.php';

	}
}//end of LAID_BACK_CUSTOMIZER


if ( class_exists( 'WP_Customize_Control' ) ) {

	require_once LAID_BACK_THEME_DIR . 'inc/customizer/control-sortable.php';

}


if ( ! function_exists( 'laid_back_customizer_scripts_styles' ) ) :
	function laid_back_customizer_scripts_styles() {
		wp_enqueue_style( 'laid_back_customizer_css', LAID_BACK_THEME_URI . 'assets/css/customizer.min.css', array(), null );
	}
endif;
add_action('customize_controls_print_styles', 'laid_back_customizer_scripts_styles');
