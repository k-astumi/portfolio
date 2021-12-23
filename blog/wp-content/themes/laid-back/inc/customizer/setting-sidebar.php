<?php
defined( 'ABSPATH' ) || exit;
/**
 * Sidebar Settings
 *
 * @package Laid Back
 */



$wp_customize->add_section('sidebar_display_sections',array(
	'title' => esc_html__('Display','laid-back'),
	'panel' => 'sidebar_panel',
));

$wp_customize->add_setting( 'laid_back_sidebar_display', array(
	'default'           => 'all',
	'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_sidebar_display', array(
	'label'    => esc_html__( 'Sidebar display', 'laid-back' ),
	'section'  => 'sidebar_display_sections',
	'type'     => 'radio',
	'choices'  => array(
		'none' => esc_html__( 'Hidden', 'laid-back' ),
		'all' => esc_html__( 'All', 'laid-back' ),
		'post' => esc_html__( 'Only post', 'laid-back' ),
	),
));









