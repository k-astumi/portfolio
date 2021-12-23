<?php
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'laid_back_widgets_init' );

if ( ! function_exists( 'laid_back_widgets_init' ) ) :
  
  function laid_back_widgets_init() {
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
        'name' => esc_html__( 'Right Sidebar', 'laid-back' ),
        'id' => 'sidebar-1',
        'description' => sprintf( $shared['description'] , esc_html__( 'right sidebar', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'s_widget">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Left of footer', 'laid-back' ),
        'id' => 'footer-1',
        'description' => sprintf( $shared['description'] , esc_html__( 'the first column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));
    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Center of footer', 'laid-back' ),
        'id' => 'footer-2',
        'description' => sprintf( $shared['description'] , esc_html__( 'the second column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));
    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Right of footer', 'laid-back' ),
        'id' => 'footer-3',
        'description' => sprintf( $shared['description'] , esc_html__( 'the third column in the footer', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'f_widget">',
        'before_title' => $shared['title'].'fw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Header', 'laid-back' ),
        'id' => 'header_widget',
        'description' => sprintf( $shared['description'] , esc_html__( 'header', 'laid-back' ) ),
        'before_widget' => '<div id="%1$s" class="widget h_widget %2$s">',
        'before_title' => $shared['title'].'hw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Credit', 'laid-back' ),
        'id' => 'credit_widget',
        'description' => sprintf( $shared['description'] , esc_html__( 'credit', 'laid-back' ) ),
        'before_widget' => '<div id="%1$s" class="widget c_widget fc_fff %2$s">',
        'before_title' => '<div class="widget_title cw_title fsS fw_bold">',
      )));

    register_sidebar(
      array(
        'name' => esc_attr__( 'Custom Homepage', 'laid-back' ),
        'id' => 'custom_homepage',
        'description' => sprintf( $shared['description'] , esc_html__( 'Homepage', 'laid-back' ) ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb_L">',
        'before_title' => '<h2 class="widget_title ch_title mb_S f_box ai_c">',
        'after_title' => '</h2>',
        'after_widget' => '</div>',
      ));

    $setting_url = esc_url(admin_url('customize.php?autofocus[section]=index_widget_sections'));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Index List', 'laid-back' ),
        'id' => 'index_list',
        'description' => sprintf( $shared['description'] , esc_html__( 'index list', 'laid-back' ) ).' <a href="'.$setting_url.'">'.esc_html__( 'change the number of insert widget area.', 'laid-back' ).'</a>',
        'before_widget' => '<div id="%1$s" class="widget %2$s i_widget">',
        'before_title' => '<div class="widget_title mb_S fsS">',
      )));



    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Fixed Right Sidebar for Laptop', 'laid-back' ),
        'id' => 'sidebar-fixed',
        'description' => sprintf( $shared['description'] , esc_html__( 'right sidebar and fix in bottom', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'s_widget">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Left Sidebar for Laptop', 'laid-back' ),
        'id' => 'sidebar-2',
        'description' => sprintf( $shared['description'] , esc_html__( 'left sidebar', 'laid-back' ) ),
        'before_widget' => $shared['widget'].'s_widget">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Fixed Footer for Mobile', 'laid-back' ),
        'id' => 'footer-fixed',
        'description' => sprintf( $shared['description'] , esc_html__( 'bottom of content and fix', 'laid-back' ) ),
        'before_widget' => '<div id="%1$s" class="widget ff_widget %2$s">',
        'before_title' => $shared['title'].'sw_title">',
      )));

    register_sidebar( array_merge(
      $shared['args'],
      array(
        'name' => esc_html__( 'Search', 'laid-back' ),
        'id' => 'search_widget',
        'description' => sprintf( $shared['description'] , esc_html__( 'header', 'laid-back' ) ),
        'before_widget' => '<div id="%1$s" class="widget search_widget fc_fff %2$s">',
        'before_title' => '<div class="widget_title search_widget_title fsS fw_bold">',
      )));

    $i = 1;
    while($i<6){
      register_sidebar( array_merge(
        $shared['args'],
        array(
          'name' => esc_html__( 'Post widget', 'laid-back' ).' '.$i,
          'id' => 'post_widget_'.$i,
          'description' => sprintf( $shared['description'] , esc_html__( 'contents of the post', 'laid-back' ) ),
          'before_widget' => '<div id="%1$s" class="widget %2$s post_widget mb_L">',
          'before_title' => '<div class="widget_title">',
        )));
      ++$i;
    }


    $i = 1;
    while($i<6){
      register_sidebar( array_merge(
        $shared['args'],
        array(
          'name' => esc_html__( 'Page widget', 'laid-back' ).' '.$i,
          'id' => 'page_widget_'.$i,
          'description' => sprintf( $shared['description'] , esc_html__( 'contents of the page', 'laid-back' ) ),
          'before_widget' => '<div id="%1$s" class="widget %2$s post_widget mb_L">',
          'before_title' => '<div class="widget_title">',
        )));
      ++$i;
    }

  }
endif;


