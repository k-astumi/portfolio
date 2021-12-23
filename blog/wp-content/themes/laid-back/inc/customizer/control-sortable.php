<?php
defined( 'ABSPATH' ) || exit;
/**
 * Sortable Control
 *
 * @package Laid Back
 */

class Laid_back_Posts_Sortable_Custom_Control extends WP_Customize_Control {
  
  public $type = 'laid_back_posts_sortable';
  
  public function enqueue() {
    wp_register_script(
      'laid_back_sortable',
      LAID_BACK_THEME_URI . 'assets/js/customizer/sortable.min.js',
      array( 'jquery', 'customize-base', 'jquery-ui-core', 'jquery-ui-sortable' ),
      '',
      true
    );
    wp_enqueue_script( 'laid_back_sortable' );
  }

  
  public function render_content() {





    echo '<span class="customize-control-title">'.esc_html($this->label).'</span>';
    echo '<span class="description customize-control-description">'.esc_html($this->description).'</span>';
    echo '<ul class="laid_back_posts_sortable_ul">';

    foreach ($this->choices as $key => $value) {
      $value_item = self::section_name($value);
      echo '<li class="" data-value="'.esc_attr($value).'"><i class="dashicons dashicons-visibility visibility"></i>'.esc_html($value_item).'<i class="dashicons dashicons-menu"></i></li>';
    }

    $diff = '';
    require_once LAID_BACK_THEME_DIR . 'template-parts/single/sort_order.php';
    if($this->id === 'laid_back_posts_sortable'){
      $diff = laid_back_sort_order_diff_post();
    }
    if($this->id === 'laid_back_pages_sortable'){
      $diff = laid_back_sort_order_diff_page();
    }
    if(!empty($diff)){
      foreach ($diff as $key => $value) {
        $value_item = self::section_name($value);
        echo '<li class="invisible" data-value="'.esc_attr($value).'"><i class="dashicons dashicons-visibility visibility dashicons-visibility-faint"></i>'.esc_html($value_item).'<i class="dashicons dashicons-menu"></i></li>';
      }
    }

    echo '</ul>';
  }


  public function section_name($value) {

    switch ($value){
      case 'breadcrumbs':
      $value_item = esc_html_x( 'Breadcrumbs' , 'post_sortable' ,'laid-back' );
      break;
      case 'title':
      $value_item = esc_html_x( 'Title' , 'post_sortable' ,'laid-back' );
      break;
      case 'date':
      $value_item = esc_html_x( 'Date' , 'post_sortable' ,'laid-back' );
      break;
      case 'author':
      $value_item = esc_html_x( 'Author & Date' , 'post_sortable' ,'laid-back' );
      break;
      case 'pv':
      $value_item = esc_html_x( 'Page views' , 'post_sortable' ,'laid-back' );
      break;
      case 'thumbnail':
      $value_item = esc_html_x( 'Thumbnail' , 'post_sortable' ,'laid-back' );
      break;
      case 'content':
      $value_item = esc_html_x( 'Content' , 'post_sortable' ,'laid-back' );
      break;
      case 'widget_1':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'laid-back' ).' 1';
      break;
      case 'widget_2':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'laid-back' ).' 2';
      break;
      case 'widget_3':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'laid-back' ).' 3';
      break;
      case 'widget_4':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'laid-back' ).' 4';
      break;
      case 'widget_5':
      $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'laid-back' ).' 5';
      break;
      case 'page_link':
      $value_item = esc_html_x( 'Page Link' , 'post_sortable' ,'laid-back' );
      break;
      case 'cta':
      $value_item = esc_html_x( 'CTA' , 'post_sortable' ,'laid-back' );
      break;
      case 'share':
      $value_item = esc_html_x( 'Share' , 'post_sortable' ,'laid-back' );
      break;
      case 'author_profile':
      $value_item = esc_html_x( 'About the author' , 'post_sortable' ,'laid-back' );
      break;
      case 'related':
      $value_item = esc_html_x( 'Related' , 'post_sortable' ,'laid-back' );
      break;
      case 'category':
      $value_item = esc_html_x( 'Category' , 'post_sortable' ,'laid-back' );
      break;
      case 'tag':
      $value_item = esc_html_x( 'Tag' , 'post_sortable' ,'laid-back' );
      break;
      case 'adjacent':
      $value_item = esc_html_x( 'Adjacent' , 'post_sortable' ,'laid-back' );
      break;
      case 'comment':
      $value_item = esc_html_x( 'Comment' , 'post_sortable' ,'laid-back' );
      break;
      default:
      $value_item = esc_html_x( 'Mystery' , 'post_sortable' ,'laid-back' );
    }

    return $value_item;
  }


  }//end Laid_back_Posts_Sortable_Custom_Control


