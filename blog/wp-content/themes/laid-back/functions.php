<?php
defined( 'ABSPATH' ) || exit;

define( 'LAID_BACK_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'LAID_BACK_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );


// Handle SVG icons.
require_once LAID_BACK_THEME_DIR . '/classes/class_svg_icons.php';
require_once LAID_BACK_THEME_DIR . '/inc/svg-icons.php';


require_once LAID_BACK_THEME_DIR . 'inc/widgets.php' ;

require_once LAID_BACK_THEME_DIR . 'inc/template-tags.php' ;


if ( ! function_exists( 'laid_back_after_setup_theme' ) ) :
	function laid_back_after_setup_theme() {
		
		require_once LAID_BACK_THEME_DIR . 'inc/after_setup_theme.php' ;
	}
endif;
add_action( 'after_setup_theme', 'laid_back_after_setup_theme' , 0 );


if ( ! function_exists( 'laid_back_content_width' ) ) :
	function laid_back_content_width() {
		if(LAID_BACK_SIDEBAR){
			$GLOBALS['content_width'] = apply_filters( 'laid_back_content_width', 678 );
		}else{
			$GLOBALS['content_width'] = apply_filters( 'laid_back_content_width', 774 );
		}
	}
endif;
add_action( 'template_redirect', 'laid_back_content_width', 0 );





/**
 * Register navigation menus uses wp_nav_menu in six places.
 */
if ( ! function_exists( 'laid_back_menus' ) ) :
	function laid_back_menus() {
		$locations = array(
			
			'primary'   => __( 'Header Menu', 'laid-back' ),
			'secondary' => __( 'Footer Menu', 'laid-back' ),
			'credit_1'  => __( 'Credit Menu', 'laid-back' ).' 1',
			'credit_2'  => __( 'Credit Menu', 'laid-back' ).' 2',
			'credit_3'  => __( 'Credit Menu', 'laid-back' ).' 3',
			'credit_4'  => __( 'Credit Menu', 'laid-back' ).' 4',
		);

		register_nav_menus( $locations );
	}
endif;
add_action( 'init', 'laid_back_menus' );


add_action( 'wp', 'laid_back_define_sidebar');


if ( ! function_exists( 'laid_back_define_sidebar' ) ) :
	
	function laid_back_define_sidebar() {

		$sidebar['define'] = false;
		$sidebar['display'] = get_theme_mod( 'laid_back_sidebar_display','all');
		
		if( ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-fixed' ) || is_active_sidebar( 'sidebar-2' ) ) && $sidebar['display'] !== 'none' ){

			$sidebar['define'] = true;

			if( ( !is_singular() || is_front_page() ) && $sidebar['display'] === 'post' ){

				$sidebar['define'] = false;

			}

		}

		if (is_page_template('templates/with_sidebar.php') )
			$sidebar['define'] = true;

		if(is_page_template('templates/title_content_no_sidebar.php') || is_page_template('templates/without_sidebar.php') )
			$sidebar['define'] = false;

		
		if ( function_exists( 'laid_back_bbpress_sidebar' ) && function_exists( 'is_bbpress' ) && is_bbpress() )
			$sidebar['define'] = laid_back_bbpress_sidebar();


		if (!defined('LAID_BACK_SIDEBAR'))
			define( 'LAID_BACK_SIDEBAR', $sidebar['define'] );

	}
endif;


if ( ! function_exists( 'laid_back_show_sidebar' ) ) :
	function laid_back_show_sidebar() {

		if ( function_exists( 'laid_back_bbpress_sidebar' ) && ( function_exists( 'is_bbpress' ) && is_bbpress() ) ){

			if( is_active_sidebar( 'bbpress-sidebar-1' ) ) laid_back_bbpress_sidebar_right();
			if( is_active_sidebar( 'bbpress-sidebar-2' ) ) laid_back_bbpress_sidebar_left();

		}else{

			if( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-fixed' ) ) get_sidebar('right');
			if( is_active_sidebar( 'sidebar-2' ) ) get_sidebar('left');

		}

	}
endif;


if ( ! function_exists( 'laid_back_scripts_styles' ) ) :
	function laid_back_scripts_styles() {

		//wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'laid_back_style', LAID_BACK_THEME_URI . 'assets/css/style.min.css',array() );

		//wp_enqueue_script( 'laid_back_script', LAID_BACK_THEME_URI . 'assets/js/base.js', array(), false, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && intval(get_comments_number()) !== 0 ) {
			 // Load comment-reply.js (into footer)
			wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
		}

	}
endif;
add_action( 'wp_enqueue_scripts', 'laid_back_scripts_styles' );

if ( ! function_exists( 'laid_back_block_front_styles' ) ) :
	function laid_back_block_front_styles(){

		if ( function_exists( 'has_block' ) ){
			if( has_blocks() ){
				if ( !defined("LAID_BACK_SIDEBAR") ) define( 'LAID_BACK_SIDEBAR', false );

				wp_enqueue_style( 'laid_back_block', LAID_BACK_THEME_URI . 'assets/css/block.min.css',array( 'laid_back_style' ) );
				if(!LAID_BACK_SIDEBAR || is_page_template( 'templates/title_content_no_sidebar.php' )){
					wp_enqueue_style( 'laid_back_block_one_column', LAID_BACK_THEME_URI . 'assets/css/block_one_column.min.css',array( 'laid_back_block' ) );
				}

				return;

			}

		}

		if( !get_theme_mod( 'laid_back_no_use_block_widget',false) ){
			return;
		}

		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
	}
endif;
add_action( 'enqueue_block_assets', 'laid_back_block_front_styles' );


if ( ! function_exists( 'laid_back_header_style' ) ) :
	function laid_back_header_style() {

		if( is_singular() ){

			if( has_post_thumbnail() ){

				if( get_post_type() === 'post' ){
					$thum_size = get_theme_mod( 'laid_back_post_thum_size','large');
				}else{
					$thum_size = get_theme_mod( 'laid_back_page_thum_size','large');
				}
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id, $thum_size);
				echo '<link rel="preload" as="image" href="'.$image_url[0].'">';
			}

		}

	}
endif;
add_action( 'wp_head', 'laid_back_header_style' );

if ( ! function_exists( 'laid_back_footer_scripts_styles' ) ) :
	function laid_back_footer_scripts_styles() {

		

		wp_enqueue_style( 'laid_back_keyframes', LAID_BACK_THEME_URI . 'assets/css/keyframes.min.css',array() );

		wp_enqueue_style( 'laid_back_printer', LAID_BACK_THEME_URI . 'assets/css/printer.min.css',array() );

	}
endif;
add_action( 'wp_footer', 'laid_back_footer_scripts_styles' );


if ( is_admin() ){

	add_action('enqueue_block_editor_assets', function(){
		wp_enqueue_style( 'laid_back_block', LAID_BACK_THEME_URI . 'assets/css/block.min.css',array() );

		wp_enqueue_style( 'laid_back_block_one_column', LAID_BACK_THEME_URI . 'assets/css/block_one_column.min.css',array( 'laid_back_block' ) );
	});

}else{

	require_once LAID_BACK_THEME_DIR . 'inc/content-replace.php';

}


// Setup the Theme Customizer settings and controls...
if( is_customize_preview() )
	require_once LAID_BACK_THEME_DIR . 'inc/customizer/customizer.php';


if ( class_exists( 'bbPress' ) ) {
	require_once LAID_BACK_THEME_DIR . 'inc/third/bbpress.php';
}
