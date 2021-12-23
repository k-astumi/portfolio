<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Laid Back
 */



$next_heading = '';
$link_pages = '';

$judge = preg_match_all('/<!--nextpage-->.*?<h[1-6].*?>(.*?)<\/h[1-6].*?>/is', $post->post_content, $match);
if($judge){
	$str = array();
	$count = 1;

	foreach ($match[0] as $key => $value) {
		
		$count += substr_count( $value, '<!--nextpage-->' );
		
		$str[$count] = $match[1][$key];
	}

	
	
	if ( get_query_var('paged') ) { $paged_num = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged_num = get_query_var('page'); }
	else { $paged_num = 1; }

	if(isset( $str[ $paged_num + 1 ])){
		$next_heading = $str[$paged_num + 1];

		$link_pages = wp_link_pages( array(
			'before'      => '',
			'after'       => '',
			'next_or_number'   => 'next',
			'nextpagelink'     => '<div class="next_arrow relative fc_fff fsS" style="flex:none;">'.esc_html__( 'Next Page', 'laid-back' ).'</div><div class="next_heading fsM">'.esc_html($next_heading).'</div>',
			'previouspagelink' => '',
			'echo'             => 0
		) );

		$link_pages =  preg_replace('/<a.*?href=".*?"><\/a>/i', '' , $link_pages);
		$link_pages =  str_replace(' class="post-page-numbers"', '', $link_pages);

		$link_pages =  preg_replace('/href="(.*?)"/i', 'href="$1'.apply_filters( 'yahman_themes_next_page_heading', '' ).'"' , $link_pages);

		$link_pages =  str_replace('<a', '<a style="display:inline-flex;" class="page_link_next post_item mb_L ai_c jc_c dib br4 of_h mla mra shadow_box flow_box" ', $link_pages);

		$link_pages = '<div class="ta_c">' . $link_pages . '</div>' ;







	}




}









$link_pages .= wp_link_pages( array(
	'before'      => '<nav class="page-links post_item mb_L f_box ai_c jc_c f_wrap"><span class="mr8">' . esc_html__( 'Pages:', 'laid-back' ).'</span><ul class="nav-links f_box ai_c jc_c f_wrap fsM lsn"><li class="mr8 mb8">',
	'after'       => '</li></ul></nav>',
	'separator'        => '</li><li class="mr8 mb8">',
	'link_before' => '',
	'link_after'  => '',
	'echo'             => 0
) );

$link_pages = preg_replace(array(
	'{post-page-numbers}',
	'{number flow_box br4 current}',
),
array(
	'number flow_box br4',
	'number current br4',
),
$link_pages);

echo $link_pages;


