<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Laid Back
 */


function laid_back_title_post(){
	echo '<h1 class="post_title fs24 fw_bold lh15">'. get_the_title().'</h1>';
}

function laid_back_title_page(){
	echo '<h1 class="post_title fs24 fw_bold lh15">'. get_the_title().'</h1>';
}

