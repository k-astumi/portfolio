<?php
defined( 'ABSPATH' ) || exit;
/**
 * Archive title
 *
 * @package Laid Back
 */

if ( ! function_exists( 'laid_back_get_the_archive_title' ) ) :
  
  function laid_back_get_the_archive_title($title) {
    if ( is_category() ) {
      $title = single_cat_title( '<span class="mr4">'.laid_back_get_theme_svg( 'folder-open-o' ).'</span>', false );
    }elseif ( is_tag() ) {
      $title = single_tag_title( '<span class="mr4">'.laid_back_get_theme_svg( 'tag' ).'</span>', false );
    } elseif ( is_author() ) {
      $title = '<span class="mr4">'.laid_back_get_theme_svg( 'user' ).'</span><span class="">'. get_the_author() . '</span>';

    } elseif ( is_year() || is_month() || is_day() ) {
     $title = '<span class="mr4">'.laid_back_get_theme_svg( 'calendar' ).'</span><span class="">'. $title . '</span>';
   }
   return $title;
 }
endif;
add_filter( 'get_the_archive_title', 'laid_back_get_the_archive_title');
