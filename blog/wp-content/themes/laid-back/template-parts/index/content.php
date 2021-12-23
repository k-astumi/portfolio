<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Laid Back
 */

$i = 1;

$mod_value = array(
	'index_widget' => get_theme_mod( 'laid_back_index_widget','after'),
	'index_widget_num' => get_theme_mod( 'laid_back_index_widget_num',3),
	'thum_size' => get_theme_mod( 'laid_back_index_thum_size','large'),
);


while(have_posts()): the_post();
	$post_title = get_the_title();

	$post_date = get_the_date();
	$post_author = get_the_author();
	$human_time = '';
	$sticky = '';

	if( is_sticky() ) {
		$sticky = '<span class="mr4 mb_S">'. laid_back_get_theme_svg( 'thumb-tack' ) .'</span> ';
		$post_date = '';
	}

	?>


	<article <?php post_class('index_card flow_box shadow_box of_h relative' ); ?>>
		<a href="<?php echo get_permalink(); ?>" class="tap_no f_box f_col h100">

			<?php
			echo '<figure class="index_thum mb_M fit_box_img_wrap">';
			if(has_post_thumbnail()) {
				the_post_thumbnail($mod_value['thum_size']);
			}else{
				$thumurl = laid_back_get_thumbnail($post->ID,$mod_value['thum_size']);
				echo '<img src="'.esc_url( $thumurl[0] ).'" width="'.esc_attr( $thumurl[1] ).'" height="'.esc_attr( $thumurl[2] ).'" alt="'. esc_attr($post_title) .'" decoding="async" />';
			}
			echo '</figure>';
			echo '<div class="index_meta f_box f_col f_auto">';
			$category = get_the_category();
			if(!empty($category)){
				echo '<div class="index_category fs12 sub_fc mb_M ta_c">' . esc_html($category[0]->cat_name) . '</div>';
			}



			echo '<div class="f_box jc_c ai_c f_auto lh_15">'.$sticky.'<h2 class="index_title line_clamp lc3 of_h mb_M">'.$post_title.'</h2>'.'</div>';
			if(get_post_type() !== 'page'):
				?>

				<div class="index_date sub_fc fs12 ta_c" title="<?php echo get_the_date(); ?>"><?php echo $post_date; ?></div>

				<?php
			endif;
			?>

		</div>
	</a>
</article>


<?php


if ( is_active_sidebar( 'index_list' ) ){
	if( ($mod_value['index_widget_num'] === $i && $mod_value['index_widget'] === 'after') || ( $i % $mod_value['index_widget_num'] === 0 && $mod_value['index_widget'] === 'every') ){
		?>
		<div class="index_card index_widget shadow_box">
			<?php dynamic_sidebar( 'index_list' ); ?>
		</div>
		<?php
	}
}

++$i;

endwhile;

