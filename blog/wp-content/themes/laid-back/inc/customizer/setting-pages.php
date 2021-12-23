<?php
defined( 'ABSPATH' ) || exit;
/**
 * Pages Settings
 *
 * @package Laid Back
 */



$wp_customize->add_section('pages_reorder_sections',array(
  'title' => esc_html__('Reorder Sections','laid-back'),
  'panel' => 'pages_panel',
));


$wp_customize->add_setting( 'laid_back_pages_sortable',
 array(
  'default'   => laid_back_sort_order_default_base_page(),
  'sanitize_callback' => 'laid_back_array_sanitize',
)
);
$wp_customize->add_control( new Laid_back_Posts_Sortable_Custom_Control( $wp_customize, 'laid_back_pages_sortable',
 array(
  'type' => 'posts_sortable',
  'label' => esc_html__( 'Reorder Sections', 'laid-back' ),
  'description' => esc_html__( 'drag the columns to rearrange their order.', 'laid-back' ),
  'section' => 'pages_reorder_sections',
  'choices'  => laid_back_sort_order_custom_page(),
)
) );


$wp_customize->add_section('page_thumbnail_sections',array(
  'title' => esc_html__('Thumbnail','laid-back'),
  'panel' => 'pages_panel',
));
$wp_customize->add_setting( 'laid_back_page_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_page_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'laid-back' ),
  'section'  => 'page_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'laid-back' ),
    'medium' => esc_html__( 'Medium', 'laid-back' ),
    'large' => esc_html__( 'Large', 'laid-back' ),
    'full' => esc_html__( 'Full', 'laid-back' ),
  ),
));

$wp_customize->add_section('laid_back_page_date',array(
  'title' => esc_html__('Date','laid-back'),
  'panel' => 'pages_panel',
));

$wp_customize->add_setting( 'laid_back_page_date_display', array(
  'default'           => 'none',
  'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_page_date_display', array(
  'label'    => esc_html__( 'Date display', 'laid-back' ),
  'section'  => 'laid_back_page_date',
  'type'     => 'radio',
  'choices'  => array(
    'none' => esc_html__( 'Hidden', 'laid-back' ),
    'publish' => esc_html__( 'Publish', 'laid-back' ),
    'update' => esc_html__( 'Update', 'laid-back' ),
    'both' => esc_html__( 'Publish & Update', 'laid-back' ),
  ),
));


$wp_customize->add_section('laid_back_page_author',array(
  'title' => esc_html__('Author','laid-back'),
  'panel' => 'pages_panel',
));

$wp_customize->add_setting( 'laid_back_page_author_avatar',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_page_author_avatar',array(
  'label'   => esc_html__( 'Avatar', 'laid-back'),
  'section' => 'laid_back_page_author',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'laid_back_page_author_name',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_page_author_name',array(
  'label'   => esc_html__( 'Name', 'laid-back'),
  'section' => 'laid_back_page_author',
  'type' => 'checkbox',
));


$wp_customize->add_section('laid_back_page_breadcrumb',array(
  'title' => esc_html__('Breadcrumb','laid-back'),
  'panel' => 'pages_panel',
));
$wp_customize->add_setting( 'laid_back_page_header_breadcrumbs',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_page_header_breadcrumbs',array(
  'label'   => esc_html__( 'Header', 'laid-back'),
  'section' => 'laid_back_page_breadcrumb',
  'type' => 'checkbox',
));





$wp_customize->add_section('laid_back_page_widget_fit_sections',array(
  'title' => esc_html__('Widget','laid-back'),
  'panel' => 'pages_panel',
));

$i = 1;
while($i<6){
  $wp_customize->add_setting( 'laid_back_widget_fit_page_widget_'.$i, array(
    'default'           => true,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'laid_back_widget_fit_page_widget_'.$i,array(
    'label'   => esc_html__( 'Page widget', 'laid-back' ).' '.$i,
    'section' => 'laid_back_page_widget_fit_sections',
    'type' => 'checkbox',
  ));
  ++$i;
}