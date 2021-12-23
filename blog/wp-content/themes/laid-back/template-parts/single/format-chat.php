<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content chat
 *
 * @package Laid Back
 */


add_filter( 'laid_back_extra_content_chat_text', 'wpautop' );

function laid_back_content_format_chat($content) {
  global $_post_format_chat_ids;

  
  $_post_format_chat_ids = array();

  
  $separator = ': ';

  
  $chat_output = "\n\t\t\t" . '<div id="chat_box-' . esc_attr( get_the_ID() ) . '" class="chat_box">';

  
  $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

  $i = 1;
  
  foreach ( $chat_rows as $chat_row ) {

    
    if ( strpos( $chat_row, $separator ) ) {

      
      $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

      
      $chat_author = strip_tags( trim( $chat_row_split[0] ) );

      
      $chat_text = trim( $chat_row_split[1] );

      
      $speaker_id = laid_back_content_format_chat_row_id( $chat_author );

      if($i%2 == 0) {
        $f_row_r = 'ta_r chat_R ';
      }else{
        $f_row_r = '';
      }

      
      $chat_output .= "\n\t\t\t\t" . '<div class="chat_row mb_L ' . $f_row_r . sanitize_html_class( "chat_speaker-{$speaker_id}" ) . '">';

      
      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat_author mb8 ' . sanitize_html_class( "chat_author-{$speaker_id}" ) . ' ">' . $chat_author. '</div>';

      

      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat_text comment_text br4 p12 dib relative"><p>' . str_replace( array( "\r", "\n", "\t" ), '', $chat_text ) . '</div>';

      
      $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat_row -->';

      ++$i;
    } else {

      
      if ( !empty( $chat_row ) ) {

        
        $chat_output .= $chat_row;
      }
    }
  }

  
  $chat_output .= "\n\t\t\t</div><!-- .chat_box -->\n";

  
  return apply_filters( 'laid_back_content_format_chat_content', $chat_output );


      //return $chat_output;
}

function laid_back_content_format_chat_row_id( $chat_author ) {
  global $_post_format_chat_ids;

  
  $chat_author = strtolower( strip_tags( $chat_author ) );

  
  $_post_format_chat_ids[] = $chat_author;

  
  $_post_format_chat_ids = array_unique( $_post_format_chat_ids );

  
  return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}