<?php
defined( 'ABSPATH' ) || exit;
/**
 * YAHMAN Add-ons Settings
 *
 * @package Laid Back
 */





$wp_customize->add_section('laid_back_pageview_setting',array(
  'title' => esc_html__('Pageview', 'laid-back'),
  'panel' => 'yahman_addon_panel',
));


$wp_customize->add_setting('pageview',array('sanitize_callback' => 'absint',));
$wp_customize->add_control('pageview',array(
  'section' => 'laid_back_pageview_setting',
  'type' => 'hidden'
));
$wp_customize->selective_refresh->add_partial( 'pageview', array(
  'selector' => '.page_view',
));


$wp_customize->add_setting( 'laid_back_pageview',array(
  'default'    => 'all',
  'sanitize_callback' => 'laid_back_sanitize_select',
));
$wp_customize->add_control( 'laid_back_pageview',array(
  'label'   => esc_html__( 'Display page view at the each post.', 'laid-back'),
  'section' => 'laid_back_pageview_setting',
  'type' => 'select',
  'choices' => array(
    //'none' =>  esc_html__( 'Hide', 'laid-back' ),
    'all' => esc_html__('Page View', 'laid-back'),
    'yearly' => esc_html__('Yearly Page View', 'laid-back'),
    'monthly' => esc_html__('Monthly Page View', 'laid-back'),
    'weekly' => esc_html__('Weekly Page View', 'laid-back'),
    'daily' => esc_html__('Daily Page View', 'laid-back'),
  ),
));

$wp_customize->add_setting( 'laid_back_pageview_logout',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_pageview_logout',array(
  'label'   => esc_html__( 'Enable', 'laid-back'),
  'description' => esc_html__('Display page view to logout user.', 'laid-back'),
  'section' => 'laid_back_pageview_setting',
  'type' => 'checkbox',
));