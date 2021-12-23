<?php
defined( 'ABSPATH' ) || exit;
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Laid Back
 */


class LAID_BACK_WALKER_NAV_MENU extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		$output .= "";
	}
	function end_lvl( &$output, $depth = 0, $args = Array() ) {
		$output .= "";
	}
	function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {

		$menu_class = '';

		foreach ($item->classes as $key => $value) {
			$menu_class .= ' ' . $value;
		}

		if (in_array('menu-item-has-children', $item->classes)) {
        // parent

			$input_id = "nav-".$item->ID;
			$caption = $item->title;
			$label = '';

			if($args->theme_location === 'primary'){

				$label = "\n" .'<label class="drop_icon fs16 m0" for="'.$input_id.'">';
				if($depth !== 0){
					$label .= "\n" . '<span class="svg10 dn001">'. laid_back_get_theme_svg( 'caret-down' ) .'</span><span class="svg10 dn110">'. laid_back_get_theme_svg( 'caret-right' ) .'</span>';
				}else{
					$label .= "\n" . '<span class="svg10">'. laid_back_get_theme_svg( 'caret-down' ) .'</span>';
				}
				$label .= "\n" . '<span class="screen-reader-text">'.esc_attr__( 'Open menu', 'laid-back' ).'</span>' . "\n" ;
				$label .= "\n" . '</label>' . "\n" ;
			}

			$output .= "\n" . '<li id="menu-item-'.$item->ID.'" class="menu-item-'.$item->ID.$menu_class.' relative fs20 fw_bold f_box jc_sb ai_c">' . "\n";
			$output .= "\n" . '<input type="checkbox" id="'.$input_id.'" class="dn">';
			//$output .= "\n" . '<div class="caret_wrap f_box jc_sb ai_c">' . "\n";
			$output .= $this->create_a_tag($item, $depth, $args , '');
			$output .= "\n" . $label . "\n";
			//$output .= "\n" . '</div>' . "\n";
			$output .= "\n" . '<ul id="sub-'.$input_id.'" class="sub-menu absolute db lsn br4" aria-hidden="true" aria-label="'.esc_attr__( 'Sub menu', 'laid-back' ).'">';


		}
		else {
        // child
			$label = '';
			$output .= "\n" . '<li id="menu-item-'.$item->ID.'"  class="menu-item-'.$item->ID.$menu_class.' relative fs20 fw_bold f_box jc_sb ai_c">' . "\n";
			//$output .= "\n" . '<div class="f_box jc_sb ai_c">' . "\n";
			$output .= $this->create_a_tag($item, $depth, $args , $label);
			//$output .= "\n" . '</div>' . "\n";
		}
	}
	function end_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {
		if (in_array('menu-item-has-children', $item->classes)) {
        // parent
			$output .= "\n".'</ul>' . "\n" . '</li>';
		}
		else {
        // child
			$output .= "\n".'</li>' ."\n" ;
		}
	}

	private function create_a_tag($item, $depth, $args , $label) {
        // link attributes
		$attributes = ' class="menu_s_a f_box jc_sb ai_c"';
		$attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ! empty( $item->classes[4] ) ? ' aria-haspopup="true"' : '';
        //$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$label,
			$args->after
		);
		return apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



if ( ! function_exists( 'laid_back_primary_menu' ) ) :

	function laid_back_primary_menu() { ?>


			<nav id="nav_h" class="nav_h relative" itemscope itemtype="https://schema.org/SiteNavigationElement">
				<?php wp_nav_menu( array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu_h menu_a f_box001 f_wrap ai_c lsn',
					'menu_id'         => 'menu_header',
					'container'       => 'ul',
					'fallback_cb'     => '__return_false',
					'walker'            => new LAID_BACK_WALKER_NAV_MENU,
				));
				?>
			</nav>

		<?php
	}

endif;


if ( ! function_exists( 'laid_back_footer_menu' ) ) :
	function laid_back_footer_menu(){
		echo '<div id="menu_f" class=""><nav id="nav_f" class="nav_f wrap_frame f_box jc_c">';
		wp_nav_menu( array(
			'theme_location'  => 'secondary',
			'menu_class'      => 'menu_f menu_a menu_s o_s_t f_box ai_c m0 lsn',
			'menu_id'         => 'menu_footer',
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			'walker'            => new LAID_BACK_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;


if ( ! function_exists( 'laid_back_credit_menu' ) ) :
	function laid_back_credit_menu($num){
		echo '<div class="menu_c mb_L"><div class="fw8 mb_S">'.wp_get_nav_menu_name('credit_'.$num).'</div><nav class="nav_c">';
		wp_nav_menu( array(
			'theme_location'  => 'credit_'.$num,
			'menu_class'      => 'menu_credit menu_a m0 lsn',
			'menu_id'         => 'menu_credit_'.$num,
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			//'walker'            => new LAID_BACK_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;


if ( ! function_exists( 'laid_back_header_widget' ) ) :
	function laid_back_header_widget(){
		if ( is_active_sidebar( 'header_widget' ) ){
			echo '<div id="header_widget" class="f_box f_col100 jc_c ai_c">';
			dynamic_sidebar('header_widget');
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'laid_back_header_logo_title' ) ) :
	function laid_back_header_logo_title () {

		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			echo '<a href="'. esc_url( home_url( '/' ) ) .'" rel="home" class="dib" style="line-height:0;"><img src="' . esc_url( $logo[0] ) . '" class="header_logo" alt="' . get_bloginfo( 'name' , 'display' ) . '" width="'.esc_attr( $logo[1] ).'" height="'.esc_attr( $logo[2] ).'" decoding="async" /></a>';
		} else {
			echo '<h1 class="title_text fs24 fw_bold"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'.get_bloginfo( 'name' , 'display' ).'</a></h1>';
		}


	}
endif;

if ( ! function_exists( 'laid_back_header_logo_icon' ) ) :
	function laid_back_header_logo_icon () {

		$header_icon = get_theme_mod( 'laid_back_header_icon','');

		if($header_icon !== '' ){
			$header_icon_size = wp_get_attachment_metadata( attachment_url_to_postid($header_icon) );
			echo '<a href="'. esc_url( home_url( '/' ) ) .'" rel="home" class="dib" style="line-height:0;"><img src="' . esc_url( $header_icon ) . '" class="header_icon mr8" width="'.$header_icon_size['width'].'" height="'.$header_icon_size['height'].'" alt="' . get_bloginfo( 'name' , 'display' ) . '" decoding="async" /></a>';
		}

	}
endif;


if ( ! function_exists( 'laid_back_human_time_diff' ) ) :
	function laid_back_human_time_diff($time) {

		$tzstring = get_option( 'timezone_string' );
		$offset   = get_option( 'gmt_offset' );

    //Manual offset...
    //@see http://us.php.net/manual/en/timezones.others.php
    //@see https://bugs.php.net/bug.php?id=45543
    //@see https://bugs.php.net/bug.php?id=45528
    //IANA timezone database that provides PHP's timezone support uses POSIX (i.e. reversed) style signs
		if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
			$offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
			$tzstring  = 'Etc/GMT'.$offset_st;
		}

    //Issue with the timezone selected, set to 'UTC'
		if( empty( $tzstring ) ){
			$tzstring = 'UTC';
		}

		$now = new DateTime('', new DateTimeZone( $tzstring ) );

		$interval = $now->diff(new DateTime($time, new DateTimeZone( $tzstring ) ));

		//if ($interval->invert == 0) return __('just now','laid-back');//'just now';
		if ($interval->y == 1) return __('a year ago','laid-back');
		
		if ($interval->y > 1) return  sprintf( __( '%s years ago' , 'laid-back' ), $interval->format('%y') );
		if ($interval->m == 1) return __('a month ago','laid-back');
		
		if ($interval->m > 1) return  sprintf( __( '%s months ago' , 'laid-back' ), $interval->format('%m') );
		
		if ($interval->d > 13) return sprintf( __('%s weeks ago','laid-back'), intval($interval->d / 7) );
		if ($interval->d == 7) return __('a week ago','laid-back');
		
		if ($interval->d == 1) return sprintf( __('yesterday at %s','laid-back'), get_post_time('h:i a') );
		
		if ($interval->d > 1) return  sprintf( __( '%s days ago' , 'laid-back' ), $interval->format('%d') );
		if ($interval->h == 1) return __('an hour ago','laid-back');
		
		if ($interval->h > 1) return sprintf( __( '%s hours ago' , 'laid-back' ), $interval->format('%h') );
		if ($interval->i == 1) return __('a minute ago','laid-back');
		
		if ($interval->i > 1) return sprintf( __( '%s minutes ago' , 'laid-back' ), $interval->format('%i') );
		return __('just now','laid-back');//$interval->format('just now');
	}
endif;


if ( ! function_exists( 'laid_back_get_thumbnail' ) ) :
	function laid_back_get_thumbnail($post_id = '' , $size = 'thumbnail') {

		/*
	     * @param string $post_id Post ID.
	     * @param string $size thumbnail, middle ,large etc.
	    */
		$thumbnail = array();

		if( has_post_thumbnail($post_id) ) {
			
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post_id) , $size );
			$thumbnail['has_image'] = true;

			return $thumbnail;

		}else{

			preg_match("/<img[^>]+src=[\"'](s?https?:\/\/[\-_\.!~\*'()a-z0-9;\/\?:@&=\+\$,%#]+\.(jpg|jpeg|png|gif))[\"'][^>]+>/i", get_post($post_id)->post_content, $thumurl);

			if(isset($thumurl[1])){

				$img_id = attachment_url_to_postid($thumurl[1]);
				$img_data = wp_get_attachment_metadata ($img_id);

				
				if(!empty($img_data) ){
					$thumbnail[0] = $thumurl[1];
					$thumbnail[1] = $img_data['width'];
					$thumbnail[2] = $img_data['height'];
					$thumbnail['has_image'] = true;
					return $thumbnail;
				}

			}

		}


		$thumbnail[0] = get_theme_mod( 'laid_back_no_thumbnail' , LAID_BACK_THEME_URI .'assets/images/no_image.png');
		$thumbnail[1] = '1280';
		$thumbnail[2] = '960';
		$thumbnail['has_image'] = false;

		return $thumbnail;

	}
endif;


if ( ! function_exists( 'laid_back_comment_author_anchor' ) ) :
	function laid_back_comment_author_anchor( $author_link ){
		return str_replace( "<a", "<a target='_blank'", $author_link );
	}
endif;
add_filter( "get_comment_author_link", "laid_back_comment_author_anchor" );

if ( ! function_exists( 'laid_back_comment' ) ) :
	function laid_back_comment($comment, $args, $depth) {

		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
			?>
			<li class="pingback">
				<p class="mb8"><span class="svg12 mr4"><?php echo laid_back_get_theme_svg( 'caret-right' ); ?></span><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'laid-back' ), ' <span class="svg16 ml8 mr4">' . laid_back_get_theme_svg( 'pencil' ) . '</span><span class="edit-link">', '</span>' ); ?></p>

				<?php

				break;
				default:

				$comment_author = '';

				if ( false !== strpos( comment_class('',null,null,false), 'bypostauthor' ) ) {
					$comment_author = 'author ';
				}

				?>



				<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
					<div class="comment_body mb_L f_box" itemscope itemtype="https://schema.org/UserComments">
						<div class="comment_avatar br50 of_h mr16">
							<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
						</div>

						<div class="comment_meta w100">
							<span class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person"><?php echo get_comment_author_link(); ?></span>
							<div class="mb16">
								<time class="fsS"><?php comment_date(get_option( 'date_format' )); ?></time>

								<span class="comment_edit ml8">
									<?php edit_comment_link('<span class="svg12">' . laid_back_get_theme_svg( 'pencil' ) . '</span> '.__('Edit', 'laid-back'),'  ','') ?>
								</span>
							</div>
							<div class="<?php echo esc_attr($comment_author); ?>comment_text mb_L" itemprop="commentText">
								<?php comment_text() ?>
								<div class="comment_reply">
									<?php comment_reply_link(array_merge( $args, array('reply_text' => '<span class="svg12">' . laid_back_get_theme_svg( 'reply' ) . '</span> '.__('Reply', 'laid-back'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
								</div>
							</div>
							<?php if ($comment->comment_approved == '0') : ?>
								<span><?php esc_html_e('*Your comment is awaiting moderation.*', 'laid-back') ?></span>
							<?php endif; ?>
						</div>







					</div>


					<?php
					break;
				endswitch;

			}
		endif;

		function laid_back_move_comment_field_to_bottom( $fields ) {

			if(get_theme_mod( 'laid_back_post_comments_bottom',false) ){
				$order = array('author','email','url','comment','cookies');

				uksort($fields, function($key1, $key2) use ($order) {
					return (array_search($key1, $order) > array_search($key2, $order));
				});
			}

			return $fields;
		}

		add_filter( 'comment_form_fields', 'laid_back_move_comment_field_to_bottom' );


		if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 */
		do_action( 'wp_body_open' );
	}
endif;



if ( ! function_exists( 'laid_back_the_posts_pagination' ) ) :
	function laid_back_the_posts_pagination( $args = array() ) {

	    // Don't print empty markup if there's only one page.
		if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
		$navigation = '';



		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 1,
				'prev_next'          => false,
				'next_next'          => false,
				//'prev_text' => '&lt;',
				//'next_text' => '&gt;',
				'screen_reader_text' => __( 'Posts navigation' , 'laid-back' ),
			)
		);

		$args['type'] = 'list';

		    // Set up paginated links.
		$links = paginate_links( $args );

		if ( $links ) {
			$links = preg_replace(array(
				'{<ul class=["\']page-numbers["\']>}',
				'{<li>}',
				//'{<li>(.*?)</li>}',
				//'{<a class=["\']prev(.*?)</a>}',
				//'{<a class=["\']next(.*?)</a>}',
					//
					//'{<a class=["\']prev}',
					//'{<a class=["\']next}',
				'{<a class=["\']page-numbers["\']}',
				'{["\']page-numbers dots["\']}',
				'{["\']page-numbers current["\']}',
			),
			array(
				'<ul class="nav-links f_box ai_c jc_c fsM mb_L lsn">',
				'<li class="mr8 mb8">',
				//'$1',
				//'$1',
				//'',
				//'',
					//'<li class="prev_li mra mb8"><a class="prev$1</li><li class="nav_brake"></li>',
					//'<li class="nav_brake"></li><li class="next_li mla mb8"><a class="next$1</li>',
					//
					//'<a class="number prev flow_box br4 fw8',
					//'<a class="number next flow_box br4 fw8',
				'<a class="number flow_box br4"',
				'"dots fsS"',
				'"number current br4"',
			),
			$links);

			if ( empty( $args['screen_reader_text'] ) ) {
				$args['screen_reader_text'] = __( 'Posts navigation' , 'laid-back' );
			}

			$template = '
			<nav class="navigation pagination-outer w100" role="navigation">
			<h2 class="screen-reader-text">%1$s</h2>
			%2$s
			</nav>';
			$navigation = sprintf($template, esc_html( $args['screen_reader_text'] ), $links);
		}

		echo $navigation;



	}
endif;

if ( ! function_exists( 'laid_back_remove_hentry' ) ) :
	
	function laid_back_remove_hentry( $hentry ) {
		return array_diff($hentry, array('hentry'));
	}
endif;
add_filter('post_class', 'laid_back_remove_hentry');

if ( ! function_exists( 'laid_back_replace_reply_link_class' ) ) :
	function laid_back_replace_reply_link_class($class){
		return str_replace("class='comment-reply-link", "class='comment-reply-link dib p4_8 br4 mt8 shadow_box flow_box", $class);
	}
endif;
add_filter('comment_reply_link', 'laid_back_replace_reply_link_class');


if ( ! function_exists( 'laid_back_header_search_widget' ) ) :
	function laid_back_header_search_widget(){
		?>
		<div class="sw_open relative" style="z-index:100;">
			<input type="checkbox" id="sw" class="dn" />
			<div id="sw_wrap" class="left0 top0" style="z-index:100;">
				<label for="sw" class="absolute w100 h100 left0 top0" style="z-index:101;"></label>
				<div class="sw_inner absolute" style="z-index:102;">
					<label for="sw" class="sw_close ta_c svg24 fc_fff" style="margin:0 auto -8px;cursor:pointer;"><?php echo laid_back_get_theme_svg( 'close' ); ?></label>
					<?php dynamic_sidebar('search_widget'); ?>
				</div>
			</div>
		</div>
		<?php
	}
endif;




if ( ! function_exists( 'laid_back_show_footer_widget' ) ) :
	function laid_back_show_footer_widget(){

		if ( is_page_template( 'templates/title_content_no_sidebar.php' ) ) return;

		
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ){

			if ( is_active_sidebar( 'bbpress-footer-1' )  || is_active_sidebar( 'bbpress-footer-2' )  || is_active_sidebar( 'bbpress-footer-3' )  ) : ?>
				<div class="f_widget_wrap">
					<div class="wrap_frame f_widget_inner f_box f_wrap010 jc_sb f_col100">
						<div class="f_widget_L f_widget_block f_123"><?php dynamic_sidebar('bbpress-footer-1'); ?></div>
						<div class="f_widget_C f_widget_block f_123"><?php dynamic_sidebar('bbpress-footer-2'); ?></div>
						<div class="f_widget_R f_widget_block f_123"><?php dynamic_sidebar('bbpress-footer-3'); ?></div>
					</div>
				</div>
				<?php
			endif;


		}else{

			if ( is_active_sidebar( 'footer-1' )  || is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  ) : ?>
				<div class="f_widget_wrap">
					<div class="wrap_frame f_widget_inner f_box f_wrap010 jc_sb f_col100">
						<div class="f_widget_L f_widget_block f_123"><?php dynamic_sidebar('footer-1'); ?></div>
						<div class="f_widget_C f_widget_block f_123"><?php dynamic_sidebar('footer-2'); ?></div>
						<div class="f_widget_R f_widget_block f_123"><?php dynamic_sidebar('footer-3'); ?></div>
					</div>
				</div>
				<?php
			endif;

		}




	}
endif;


if ( ! function_exists( 'laid_back_header_breadcrumbs' ) ) :
	function laid_back_header_breadcrumbs() {

		require_once LAID_BACK_THEME_DIR . 'inc/breadcrumbs.php';
		echo '<nav class="h_breadcrumb fsS bg_fff"><div class="breadcrumb wrap_frame f_box o_s_t ai_c lh_1" itemscope itemtype="https://schema.org/BreadcrumbList">';
		echo laid_back_breadcrumb_list();
		//echo str_replace( ' mb8', '', laid_back_breadcrumb_list() );
		echo '</div></nav>';

	}
endif;
