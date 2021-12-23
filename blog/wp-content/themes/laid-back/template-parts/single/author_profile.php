<?php
defined( 'ABSPATH' ) || exit;
/**
 * Author profile
 *
 * @package LAID_BACK
 */

function laid_back_author_profile(){

 $author['nickname'] = apply_filters( 'yahman_themes_author_nickname', get_the_author_meta('nickname') );
 $author['ID'] = get_the_author_meta( 'ID' );

 ?>
 <!--Author profile-->

 <div id="about_author" class="about_author post_item mb_L br4 p12 f_box f_col100 ai_c shadow_box">

  <div class="aa_avatar p4_8">
    <img src="<?php echo esc_url( get_avatar_url( $author['ID'], array('size' => '192') ) ); ?>" width="96" height="96" class="br50" alt="<?php echo esc_attr( $author['nickname'] ); ?>" decoding="async" />
  </div>

  <div class="aa_profile p4_8" >
    <ul class="aa_pl m0 lsn">
      <li class="p4_8"><div class="aa_name fsL fw4 f_box jc_c100"><a href="<?php echo esc_url(get_author_posts_url( $author['ID'] )); ?>" class=""><?php echo esc_html($author['nickname']); ?></a></div></li>
      <li class="sub_fc p4_8"><?php echo wpautop(get_the_author_meta('user_description')); ?></li>
      <?php if(function_exists('yahman_addons_user_profile_output')) yahman_addons_user_profile_output('p4_8'); ?>
    </ul>
  </div>

</div>
<!--/Author profile-->
<?php
}
