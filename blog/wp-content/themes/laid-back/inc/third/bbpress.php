<?php
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'laid_back_bbpress_widgets_init' );

if ( ! function_exists( 'laid_back_bbpress_widgets_init' ) ) :
  
  function laid_back_bbpress_widgets_init() {
    $shared['args'] = array(
      'after_widget' => '</div>',
      'after_title' => '</div>'
    );
    $shared['description'] = esc_html__('Widgets in this area will be displayed in %s.', 'laid-back');
    $shared['widget'] = '<div id="%1$s" class="%2$s widget br4 mb_L shadow_box ';
    $shared['title'] = '<div class="widget_title mb_S fsS fw_bold ';

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Right Sidebar for bbPress', 'laid-back' ),
        'id' => 'bbpress-sidebar-1',
        'description' => sprintf( $shared['description'] , esc_html__( 'right sidebar', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'s_widget">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Left Sidebar for bbPress when Laptop', 'laid-back' ),
        'id' => 'bbpress-sidebar-2',
        'description' => sprintf( $shared['description'] , esc_html__( 'left sidebar', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'s_widget">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Left of footer for bbPress', 'laid-back' ),
        'id' => 'bbpress-footer-1',
        'description' => sprintf( $shared['description'] , esc_html__( 'the first column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));
    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Center of footer for bbPress', 'laid-back' ),
        'id' => 'bbpress-footer-2',
        'description' => sprintf( $shared['description'] , esc_html__( 'the second column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));
    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Right of footer for bbPress', 'laid-back' ),
        'id' => 'bbpress-footer-3',
        'description' => sprintf( $shared['description'] , esc_html__( 'the third column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));

  }
endif;

if ( ! function_exists( 'laid_back_bbpress_sidebar' ) ) :

  function laid_back_bbpress_sidebar(){

    if( function_exists( 'is_bbpress' ) && !is_bbpress() ) return false;

    if( is_active_sidebar( 'bbpress-sidebar-1' ) || is_active_sidebar( 'bbpress-sidebar-2' ) ){
      return true;
    }

    return false;

  }

endif;


if ( ! function_exists( 'laid_back_bbpress_sidebar_right' ) ) :

  function laid_back_bbpress_sidebar_right(){?>

    <aside id="sidebar" class="sidebar sidebar_right f_box f_col101 f_wrap010 jc_sb010" itemscope itemtype="https://schema.org/WPSideBar">
      <?php
      dynamic_sidebar( 'bbpress-sidebar-1' );
      ?>
    </aside>

    <?php
  }

endif;

if ( ! function_exists( 'laid_back_bbpress_sidebar_left' ) ) :

  function laid_back_bbpress_sidebar_left(){?>

    <aside id="sidebar_left" class="sidebar sidebar_left dn" itemscope itemtype="https://schema.org/WPSideBar">
      <?php dynamic_sidebar( 'bbpress-sidebar-2' ); ?>
    </aside>

    <?php
  }

endif;



add_action( 'wp_enqueue_scripts', 'laid_back_bbpress_css' );
if ( ! function_exists( 'laid_back_bbpress_css' ) ) :
  function laid_back_bbpress_css() {

    
    if( function_exists( 'is_bbpress' ) && is_bbpress() ) {

      wp_enqueue_style( 'laid_back_bbpress_style', LAID_BACK_THEME_URI . 'assets/css/bbpress.min.css',array('laid_back_style') );

    }else{

      wp_dequeue_style( 'bbp-default' );

    }

  }
endif;

