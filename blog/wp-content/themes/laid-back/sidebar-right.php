<?php
defined( 'ABSPATH' ) || exit;



if( !is_active_sidebar( 'sidebar-1' ) && !is_active_sidebar( 'sidebar-fixed' ) ) return;
?>
<aside id="sidebar" class="sidebar sidebar_right f_box f_col101 f_wrap010 jc_sb010" itemscope itemtype="https://schema.org/WPSideBar">
	<?php
	dynamic_sidebar( 'sidebar-1' );
	if( is_active_sidebar( 'sidebar-fixed' ) ) {
		echo '<div class="fix_sidebar">';
		dynamic_sidebar( 'sidebar-fixed' );
		echo '</div>';
	}
	?>
</aside>
