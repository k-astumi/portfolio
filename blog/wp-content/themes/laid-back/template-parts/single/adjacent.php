<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package LAID_BACK
 */

if(is_attachment()) return;

echo '<nav class="adjacents f_box jc_sb f_wrap100">';
//echo '<div class="adjacent_info  w100 f_box ai_c jc_sb z1"></div>';
$prevpost = get_adjacent_post('', '', true); 
$nextpost = get_adjacent_post('', '', false); 

if ($prevpost) { 
	$thumurl = laid_back_get_thumbnail( $prevpost->ID , 'thumbnail');
        //wp_get_attachment_image_src (get_post_thumbnail_id ($prevpost->ID,  true));

	echo '<div class="mb_L w100"><a href="' . esc_url(get_permalink($prevpost->ID)) . '" title="' . get_the_title($prevpost->ID) . '" class="adjacent adjacent_L f_box ai_c jc_sb flow_box shadow_box h100 w100">';

	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_L h100 fit_box_img_wrap" style="flex:0 0 30%;">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($prevpost->ID) .'" decoding="async" />';
		echo '</div>';
	}

	echo '<div class="adjacent_prev f_box jc_c f_col p16" style="flex:1;"><div class="f_box ai_c pb8"><span class="mr4 svg12">'. laid_back_get_theme_svg( 'chevron-left' ) .'</span><span class="fw_bold fs14">'.esc_html__( 'Prev', 'laid-back' ).'</span></div><p class="adjacent_title adjacent_title_L fsMS line_clamp lc3 of_h">' . esc_html(mb_strimwidth(get_the_title($prevpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';





}else{

	echo '<div class="mb_L w100"><a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_L f_box ai_c p16 h100 flow_box shadow_box">';
	echo '<span class="sub_fc mr8" style="width:24px;height:24px;">'. laid_back_get_theme_svg( 'home' ) .'</span><span class="adjacent_title adjacent_title_L">'.esc_html__( 'Home', 'laid-back' ).'</span>';

}

echo '</a></div>';

if ( $nextpost ) { 
	$thumurl = laid_back_get_thumbnail( $nextpost->ID , 'thumbnail');
        //$thumurl = wp_get_attachment_image_src (get_post_thumbnail_id ($nextpost->ID,  true));


	echo '<div class="mb_L w100"><a href="' . esc_url(get_permalink($nextpost->ID)) . '" title="'. get_the_title($nextpost->ID) . '" class="adjacent adjacent_R f_box ai_c jc_sb flow_box shadow_box h100 w100">';





	echo '<div class="adjacent_next f_box jc_c f_col mla p16 ta_r" style="flex:1;"><div class="f_box ai_c pb8"><span class="fw_bold fs14 mla">'.esc_html__( 'Next', 'laid-back' ).'</span><span class="ml4 svg12">'. laid_back_get_theme_svg( 'chevron-right' ) .'</span></div><p class="adjacent_title adjacent_title_R fsMS mla line_clamp lc3 of_h">' . esc_html(mb_strimwidth(get_the_title($nextpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';

	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_R h100 fit_box_img_wrap" style="flex:0 0 30%;">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($nextpost->ID) .'" decoding="async" />';
		echo '</div>';
	}

}else{

	echo '<div class="mb_L w100"><a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_R f_box ai_c p16 h100 flow_box shadow_box">';


	echo '<span class="adjacent_title adjacent_title_R mla">'.esc_html__( 'Home', 'laid-back' ).'</span><span class="sub_fc ml8" style="width:24px;height:24px;">'. laid_back_get_theme_svg( 'home' ) .'</span>';

}

echo '</a></div>';

echo '</nav>';


