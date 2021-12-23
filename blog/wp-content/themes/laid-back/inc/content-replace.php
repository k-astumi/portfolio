<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content
 *
 * @package Laid Back
 */

add_filter('the_content','laid_back_content_replace');

function laid_back_content_replace($the_content) {

  if( 'chat' === get_post_format() ){
    require_once LAID_BACK_THEME_DIR .  'template-parts/single/format-chat.php';
    $the_content = laid_back_content_format_chat($the_content);
  }
  return $the_content;

}

