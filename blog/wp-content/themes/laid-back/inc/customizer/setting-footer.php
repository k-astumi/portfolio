<?php
defined( 'ABSPATH' ) || exit;
/**
 * Footer Settings
 *
 * @package Laid Back
 */



$wp_customize->add_section('footer_copyright_sections',array(
	'title' => esc_html__('Copyright','laid-back'),
	'panel' => 'footer_panel',
));

$copyright_year = 1994;
$copyright_year_list = array();
while($copyright_year <= date('Y')){
  $copyright_year_list[$copyright_year] = (string) $copyright_year;
  ++$copyright_year;
}

$wp_customize->add_setting( 'laid_back_footer_copyright_year',array(
  'default'    => date('Y'),
  'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control( 'laid_back_footer_copyright_year',array(
  'label'   => esc_html__( 'Year of Publication', 'laid-back'),
  'section' => 'footer_copyright_sections',
  'type' => 'select',
  'choices' => $copyright_year_list,
));








