<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying comments.
 *
 * @package LAID_BACK
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area post_item mb_L">

	<?php
	
	if ( have_comments() ) :

		$comments_number = get_comments_number();
		$ping_count = get_comments( array( 'status' => 'approve', 'post_id'=> get_the_ID(), 'type'=> 'pings', 'count' => true, ) );
		$comments_number = $comments_number - $ping_count;

		if($comments_number != 0): ?>
			<h4 class="comments-title mb16">

				<?php
				if ( 1 === $comments_number ) {
					
					echo '<span class="svg12">'. laid_back_get_theme_svg( 'comment-o' ) .'</span> '. esc_html__( 'One Comment', 'laid-back' );

				} else {
					printf('<span class="svg12">'. laid_back_get_theme_svg( 'comments-o' ) .'</span> '.
						
						esc_html(__('%1$s Comments','laid-back')),
						absint(number_format_i18n( $comments_number ))
					);
				}
				?>
			</h4>

			<ul class="comment-list mb_L">
				<?php wp_list_comments( array(
					'type' => 'comment',
					'callback' => 'laid_back_comment',
				) ); ?>
				<?php
				//wp_list_comments( array('avatar_size' => 100,'style'       => 'ol',					'short_ping'  => true,				) );
				?>
			</ul>
			<?php
		endif;

		if($ping_count != 0): ?>
			<h4 class="ping-title mb_M">
				<span class="svg16"><?php echo laid_back_get_theme_svg( 'chain' ); ?></span>
				<?php
				if ( 1 === $ping_count ) {
					esc_html_e( 'One Pingback', 'laid-back' );

				} else {
					
					printf(esc_html(__('%1$s Pingbacks','laid-back')),
						absint(number_format_i18n( $ping_count ))
					);
				}
				?>
			</h4>
			<ul class="ping-list mb_L">
				<?php wp_list_comments( array(
					'type' => 'pings',
					'callback' => 'laid_back_comment',
					'short_ping'  => true,
				) ); ?>
			</ul>

			<?php
		endif;

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav>
				<ul class="comment_pager mb_L f_box jc_sb">
					<li class="comment_previous"><?php previous_comments_link( '<span class="mr4" style="line-height:12px;"><svg fill="#005af0" class="svg-icon" width="14" height="14" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M5.2,11.4L16.4,0.2C16.6,0.1,16.8,0,17,0c0.2,0,0.4,0.1,0.6,0.2l1.2,1.2C18.9,1.6,19,1.8,19,2s-0.1,0.4-0.2,0.6L9.3,12 l9.5,9.5c0.1,0.1,0.2,0.4,0.2,0.6c0,0.2-0.1,0.4-0.2,0.6l-1.2,1.2C17.4,23.9,17.2,24,17,24s-0.4-0.1-0.6-0.2L5.2,12.6 C5.1,12.4,5,12.2,5,12S5.1,11.6,5.2,11.4z"></path></svg></span>'.__( 'Older Comments', 'laid-back' ) ); ?></li>
					<li class="comment_next"><?php next_comments_link( __( 'Newer Comments', 'laid-back' ).'<span class="ml4" style="line-height:12px;"><svg fill="#005af0" class="svg-icon" width="14" height="14" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19,12c0,0.2-0.1,0.4-0.2,0.6L7.6,23.8C7.4,23.9,7.2,24,7,24s-0.4-0.1-0.6-0.2l-1.2-1.2C5.1,22.4,5,22.2,5,22 c0-0.2,0.1-0.4,0.2-0.6l9.5-9.5L5.2,2.5C5.1,2.4,5,2.2,5,2s0.1-0.4,0.2-0.6l1.2-1.2C6.6,0.1,6.8,0,7,0s0.4,0.1,0.6,0.2l11.2,11.2 C18.9,11.6,19,11.8,19,12z"></path></svg></span>' ); ?></li>
				</ul>
			</nav>
			<!-- .comment-navigation -->
		  <?php } // Check for comment navigation

		endif; 

		
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments fw_bold"><?php esc_html_e( 'Comments are closed.', 'laid-back' ); ?></p>
		<?php
	endif;
	comment_form( laid_back_comment_custom_fields() );
	?>

</div><!-- #comments -->

<?php

function laid_back_comment_custom_fields(){
	$commenter = wp_get_current_commenter();

	$req = array();
	$req['aria'] = '' ;
	$req['placeholder'] = '';
	$req['validate'] = '';
	$req['consent']   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	if( get_option( 'require_name_email' ) ){
		$req['aria'] = " aria-required='true'";
		$req['placeholder']  = " *";
		$req['validate'] = ' validate';
	}





	$email_note = array();
	if(get_theme_mod( 'laid_back_post_comments_mail',false)) $email_note = array('comment_notes_before' => '');

	return array(
            // change the title of send button
		'label_submit'=> esc_html__('Post Comment', 'laid-back'),
            // change the title of the reply section
		'title_reply'=> esc_html__('Leave a Comment', 'laid-back'),
		'class_submit'          => 'submit flow_box',
            // redefine your own textarea (the comment body)
		'comment_field' => '
		<div class="form-group mb_M"><div class="input-field"><textarea class="materialize-textarea comment_input" type="text" rows="10" id="textarea1" name="comment" aria-required="true" placeholder="'. esc_attr__('Comments', 'laid-back') .'" aria-label="'. esc_attr__('Comments', 'laid-back') .'"></textarea></div></div>',

		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' =>'' .
			'<div class="form-group mb_M"><div class="input-field">' .
			'<input class="comment_input'.$req['validate'].'" id="name" name="author" placeholder="'. esc_attr_x('Name', 'comment placeholder' ,'laid-back') .$req['placeholder'].'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $req['aria'] . ' aria-label="'. esc_attr_x('Name', 'comment placeholder' ,'laid-back') .'" /></div></div>',

			'email' => get_theme_mod( 'laid_back_post_comments_mail',false) ? '' :
			'<div class="form-group mb_M"><div class="input-field">' .
			'<input class="comment_input'.$req['validate'].'" id="email" name="email" placeholder="'. esc_attr__('Email', 'laid-back') .$req['placeholder'].'" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $req['aria'] . ' aria-label="'. esc_attr__('Email', 'laid-back') .'" /></div></div>',

			'url' => get_theme_mod( 'laid_back_post_comments_website',false) ? '' :
			'<div class="form-group mb_M"><div class="input-field"><input class="comment_input" placeholder="'. esc_attr__('Website', 'laid-back') .'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" aria-label="'. esc_attr__('Website', 'laid-back') .'" /></div></div>',

			'cookies' => get_option( 'show_comments_cookies_opt_in' ) ? '<p class="comment-form-cookies-consent f_box ai_c mb8"><input id="wp-comment-cookies-consent" class="mr8" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $req['consent'] . ' />' .
			'<label for="wp-comment-cookies-consent" class="fsS m0">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'laid-back' ) . '</label></p>' : '',
		)
	),
	) + $email_note;
}


