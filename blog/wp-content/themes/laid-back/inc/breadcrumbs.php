<?php
defined( 'ABSPATH' ) || exit;
/**
 * @package Laid Back
*/

function laid_back_breadcrumb_list(){
	
	
	$home_link        = esc_url(home_url('/'));
	$home_text        = esc_html__( 'Home', 'laid-back' );
	$link_before      = '<div class="f_box ai_c lh_1 mb8" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span class="f_box mr4 svg18">'. laid_back_get_theme_svg( 'folder-open-o' ) .'</span>';
	$link_after       = '</div>';
	$link_prop_before = '<span itemprop="name">';
	$link_prop_after  = '</span>';

	$meta_position  = '<meta itemprop="position" content="root" />';//</span>
	$link             = $link_before . '<a href="%1$s"><span class="" itemprop="name">%2$s</span></a>' . $link_after;
	$delimiter        = '<span class="ml8 mr8 svg10">'. laid_back_get_theme_svg( 'angle-right' ) .'</span>';
	$before           = '<div class="f_box ai_c lh_1 mb8" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><span class="f_box mr4 svg18">'. laid_back_get_theme_svg( 'file-text-o' ) .'</span><span itemprop="name" class="current">';
	$after            = '</span><meta itemprop="position" content="root"></div>';
	$page_addon       = '';
	$breadcrumb_trail = '';
	$category_links   = '';



	$home_svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24"><path d="M20.6,13.5v7.1c0,0.5-0.4,1-1,1h-5.7v-5.7h-3.8v5.7H4.4c-0.5,0-1-0.4-1-1v-7.1c0,0,0-0.1,0-0.1L12,6.3L20.6,13.5 C20.6,13.4,20.6,13.4,20.6,13.5z M23.9,12.4L23,13.5c-0.1,0.1-0.2,0.1-0.3,0.2h0c-0.1,0-0.2,0-0.3-0.1L12,5L1.7,13.6 c-0.1,0.1-0.2,0.1-0.4,0.1c-0.1,0-0.2-0.1-0.3-0.2l-0.9-1.1c-0.2-0.2-0.1-0.5,0.1-0.7l10.7-8.9c0.6-0.5,1.6-0.5,2.3,0l3.6,3V3 c0-0.3,0.2-0.5,0.5-0.5h2.9c0.3,0,0.5,0.2,0.5,0.5V9l3.3,2.7C24,11.9,24.1,12.2,23.9,12.4z"/></svg>';

	
	
	$wp_the_query   = $GLOBALS['wp_the_query'];
	$queried_object = $wp_the_query->get_queried_object();

	
	if ( is_singular() ) {
		
		
		$post_object = sanitize_post( $queried_object );

		
		$title          = esc_html($post_object->post_title);
		$parent         = $post_object->post_parent;
		$post_type      = $post_object->post_type;
		$post_id        = $post_object->ID;
		$post_link      = $before . $title . $after;
		$parent_string  = '';
		$post_type_link = '';


		if ( 'post' === $post_type) {
			
			$categories = get_the_category( $post_id );
			if ( $categories ) {
				
				$category  = $categories[0];
				$category_links = get_category_parents( $category, true, '' );
				$category_links = mb_ereg_replace(">(.*?)<\/a>",">$link_prop_before\\1$link_prop_after</a></div>",$category_links);
				$category_links = str_replace( '<a',   $link_before . '<a itemprop="item"', $category_links );
				$category_links = str_replace( '</div>', $meta_position . $delimiter . '</div>', $category_links );
			}
		}

		if ( !in_array( $post_type, array('post', 'page', 'attachment') ) ) {
			$post_type_object = get_post_type_object( $post_type );
			$archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

			$post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
		}

		
		if ( 0 !== $parent ) {

			$parent_links = array();
			while ( $parent ) {
				$post_parent = get_post( $parent );

				$parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

				$parent = $post_parent->post_parent;

			}



			$parent_links = array_reverse( $parent_links );

			$parent_string = '';
			foreach ($parent_links as $key => $value) {

				//$value = mb_ereg_replace(">(.*?)<\/a>",">$link_prop_before\\1$link_prop_after</a></div>",$value);
				$value = str_replace( '<a',   '<a itemprop="item"', $value );
				$parent_string .= str_replace( '</div>', $meta_position . $delimiter . '</div>', $value );

			}

			//$parent_string = implode( $delimiter, $parent_links );
		}

		
		if ( $parent_string ) {
			$breadcrumb_trail = $parent_string  . $post_link;
		} else {
			$breadcrumb_trail = $post_link;
		}

		if ( $post_type_link )
			$breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

		if ( $category_links )
			$breadcrumb_trail = $category_links . $breadcrumb_trail;

	}elseif( is_archive() ){

		


		if ( is_category() || is_tag() || is_tax() ) {
			
			$term_object        = get_term( $queried_object );
			$taxonomy           = $term_object->taxonomy;
			$term_id            = $term_object->term_id;
			$term_name          = $term_object->name;
			$term_parent        = $term_object->parent;
			$taxonomy_object    = get_taxonomy( $taxonomy );
			$current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
			$parent_term_string = '';

			if ( 0 !== $term_parent ) {
				
				$parent_term_links = array();
				while ( $term_parent ) {
					$term = get_term( $term_parent, $taxonomy );

					$parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

					$term_parent = $term->parent;
				}

				$parent_term_links  = array_reverse( $parent_term_links );
				$parent_term_string = implode( $delimiter, $parent_term_links );
			}

			if ( $parent_term_string ) {
				$breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
			} else {
				$breadcrumb_trail = $current_term_link;
			}

		} elseif ( is_author() ) {

			$breadcrumb_trail = esc_html__( 'Author archive for ', 'laid-back' ) .  $before . $queried_object->data->display_name . $after;

		} elseif ( is_date() ) {
			
			$year     = $wp_the_query->query_vars['year'];
			$monthnum = $wp_the_query->query_vars['monthnum'];
			$day      = $wp_the_query->query_vars['day'];

			
			if ( $monthnum ) {
				$date_time  = DateTime::createFromFormat( '!m', $monthnum );
				$month_name = $date_time->format( 'F' );
			}

			if ( is_year() ) {

				$breadcrumb_trail = $before . $year . $after;

			} elseif( is_month() ) {

				$year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

				$breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

			} elseif( is_day() ) {

				$year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
				$month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

				$breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
			}

		} elseif ( is_post_type_archive() ) {

			$post_type        = $wp_the_query->query_vars['post_type'];
			$post_type_object = get_post_type_object( $post_type );

			$breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

		}
	}elseif ( is_search() && !is_paged()) {

		

		
		$breadcrumb_trail = $before . sprintf( esc_html__( 'Search query for: %s', 'laid-back' ) , get_search_query()) . $after;

	}elseif ( is_search() && is_paged()) {


		$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		
		$breadcrumb_trail = $before . sprintf(esc_html__( 'Search query for: %s', 'laid-back' ) , get_search_query()). sprintf( esc_html__( '( Page %s )' , 'laid-back' ), number_format_i18n( $current_page ) ) . $after;
	}elseif ( is_404() ) {

		

		$breadcrumb_trail = $before . esc_html__( 'Error 404', 'laid-back' ) . $after;

	}elseif ( is_paged() && !is_search() ) {

		

		$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		
		$page_addon   = $before . sprintf( esc_html__( '( Page %s )' , 'laid-back' ), number_format_i18n( $current_page ) ) . $after;
	}else{
		return;
	}

	$breadcrumb_output_link  = '';

	$breadcrumb_output_link .= '<div class="f_box ai_c lh_1 mb8" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><span class="f_box mr4 svg18">'. laid_back_get_theme_svg( 'home' ) .'</span><a href="' . $home_link . '" itemprop="item"><span class="breadcrumb_home" itemprop="name">' . $home_text . '</span></a><meta itemprop="position" content="1">'.$delimiter.'</div>';

	if ( is_home() || is_front_page() ) {
		
		if ( is_paged() ) {
			
			$breadcrumb_output_link .= $page_addon;
		}
	} else {
		
		//$breadcrumb_output_link .= $delimiter;
		$breadcrumb_output_link .= $breadcrumb_trail;
		$breadcrumb_output_link .= $page_addon;
	}



	$i = 0;
	$j = substr_count($breadcrumb_output_link, 'content="root"');


	while($j > $i){
		++$i;
		$breadcrumb_output_link = preg_replace('/content="root"/', 'content="'.($i + 1).'"', $breadcrumb_output_link,1);
	}


	if( !get_theme_mod( 'laid_back_breadcrumbs_current',true) ){
		$str = '{'.$delimiter.'</div>'.$before.'(.*)'.$after.'}u';
		$breadcrumb_output_link = preg_replace( $str , '</div>' , $breadcrumb_output_link ,1);
	}

	return $breadcrumb_output_link;


}
