<?php
defined( 'ABSPATH' ) || exit;
/**
 * Index Settings
 *
 * @package Laid Back
 */


$wp_customize->add_section('index_thumbnail_sections',array(
	'title' => esc_html__('Thumbnail','laid-back'),
	'panel' => 'index_panel',
));
$wp_customize->add_setting( 'laid_back_index_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_index_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'laid-back' ),
  'section'  => 'index_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'laid-back' ),
    'medium' => esc_html__( 'Medium', 'laid-back' ),
    'large' => esc_html__( 'Large', 'laid-back' ),
    'full' => esc_html__( 'Full', 'laid-back' ),
  ),
));


$wp_customize->add_section('index_widget_sections',array(
	'title' => esc_html__('Widget','laid-back'),
	'panel' => 'index_panel',
));

$wp_customize->add_setting( 'laid_back_index_widget', array(
	'default'           => 'after',
	'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_index_widget', array(
	'label'    => esc_html__( 'How to Insert Index list widget area', 'laid-back' ),
	'section'  => 'index_widget_sections',
	'type'     => 'radio',
	'choices'  => array(
		'after' => esc_html__( 'Just after post', 'laid-back' ),
		'every' => esc_html__( 'Every post', 'laid-back' ),
	),
));

$wp_customize->add_setting( 'laid_back_index_widget_num', array(
	'default' => 3,
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control( 'laid_back_index_widget_num', array(
	'label' => esc_html__( 'Count of post for above configuring', 'laid-back' ),
    'section' => 'index_widget_sections', // Add a default or your own section
    'type' => 'number',
    'input_attrs' => array(
    	'min' => 1, 'step' => 1, 'max' => 10,
    ),
));






