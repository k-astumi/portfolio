<?php
defined( 'ABSPATH' ) || exit;
/**
 * Block Settings
 *
 * @package Laid Back
 */



$wp_customize->add_section('block_widget_sections',array(
  'title' => esc_html__('Widget','laid-back'),
  'panel' => 'block_panel',
));

$wp_customize->add_setting( 'laid_back_no_use_block_widget', array(
  'default'           => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_no_use_block_widget', array(
  'label'    => esc_html__( 'Not using block widgets', 'laid-back' ),
  'section'  => 'block_widget_sections',
  'type' => 'checkbox',
));








