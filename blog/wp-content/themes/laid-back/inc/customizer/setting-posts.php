<?php
defined( 'ABSPATH' ) || exit;
/**
 * Posts Settings
 *
 * @package Laid Back
 */



$wp_customize->add_section('posts_reorder_sections',array(
  'title' => esc_html__('Reorder Sections','laid-back'),
  'panel' => 'posts_panel',
));


$wp_customize->add_setting( 'laid_back_posts_sortable',
 array(
  'default'   => laid_back_sort_order_base_post(),
  'sanitize_callback' => 'laid_back_array_sanitize',
)
);
$wp_customize->add_control( new Laid_back_Posts_Sortable_Custom_Control( $wp_customize, 'laid_back_posts_sortable',
 array(
  'type' => 'posts_sortable',
  'label' => esc_html__( 'Reorder Sections', 'laid-back' ),
  'description' => esc_html__( 'drag the columns to rearrange their order.', 'laid-back' ),
  'section' => 'posts_reorder_sections',
  'choices'  => laid_back_sort_order_custom_post(),
)
) );


$wp_customize->add_section('post_thumbnail_sections',array(
  'title' => esc_html__('Thumbnail','laid-back'),
  'panel' => 'posts_panel',
));
$wp_customize->add_setting( 'laid_back_post_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_post_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'laid-back' ),
  'section'  => 'post_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'laid-back' ),
    'medium' => esc_html__( 'Medium', 'laid-back' ),
    'large' => esc_html__( 'Large', 'laid-back' ),
    'full' => esc_html__( 'Full', 'laid-back' ),
  ),
));


$wp_customize->add_section('laid_back_post_date',array(
  'title' => esc_html__('Date','laid-back'),
  'panel' => 'posts_panel',
));

$wp_customize->add_setting( 'laid_back_post_date_display', array(
  'default'           => 'both',
  'sanitize_callback' => 'laid_back_sanitize_radio',
));
$wp_customize->add_control( 'laid_back_post_date_display', array(
  'label'    => esc_html__( 'Date display', 'laid-back' ),
  'section'  => 'laid_back_post_date',
  'type'     => 'radio',
  'choices'  => array(
    'none' => esc_html__( 'Hidden', 'laid-back' ),
    'publish' => esc_html__( 'Publish', 'laid-back' ),
    'update' => esc_html__( 'Update', 'laid-back' ),
    'both' => esc_html__( 'Publish & Update', 'laid-back' ),
  ),
));

$wp_customize->add_section('laid_back_post_author',array(
  'title' => esc_html__('Author','laid-back'),
  'panel' => 'posts_panel',
));

$wp_customize->add_setting( 'laid_back_post_author_avatar',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_author_avatar',array(
  'label'   => esc_html__( 'Avatar', 'laid-back'),
  'section' => 'laid_back_post_author',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'laid_back_post_author_name',array(
  'default'    => true,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_author_name',array(
  'label'   => esc_html__( 'Name', 'laid-back'),
  'section' => 'laid_back_post_author',
  'type' => 'checkbox',
));


$wp_customize->add_section('laid_back_post_comments',array(
  'title' => esc_html__('Comments','laid-back'),
  'panel' => 'posts_panel',
));
$wp_customize->add_setting( 'laid_back_post_comments_bottom',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_comments_bottom',array(
  'label'   => esc_html__( 'Comment Text Field to Bottom', 'laid-back'),
  'section' => 'laid_back_post_comments',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'laid_back_post_comments_website',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_comments_website',array(
  'label'   => esc_html__( 'Website Field Disappear', 'laid-back'),
  'section' => 'laid_back_post_comments',
  'type' => 'checkbox',
));

$wp_customize->add_setting( 'laid_back_post_comments_mail',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_comments_mail',array(
  'label'   => esc_html__( 'Mail Field Disappear', 'laid-back'),
  'section' => 'laid_back_post_comments',
  'type' => 'checkbox',
));


$wp_customize->add_section('laid_back_post_breadcrumb',array(
  'title' => esc_html__('Breadcrumb','laid-back'),
  'panel' => 'posts_panel',
));
$wp_customize->add_setting( 'laid_back_post_header_breadcrumbs',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'laid_back_post_header_breadcrumbs',array(
  'label'   => esc_html__( 'Header', 'laid-back'),
  'section' => 'laid_back_post_breadcrumb',
  'type' => 'checkbox',
));


$wp_customize->add_section('laid_back_post_widget_fit_sections',array(
  'title' => esc_html__('Widget','laid-back'),
  'panel' => 'posts_panel',
));

$i = 1;
while($i<6){
  $wp_customize->add_setting( 'laid_back_widget_fit_post_widget_'.$i, array(
    'default'           => true,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'laid_back_widget_fit_post_widget_'.$i,array(
    'label'   => esc_html__( 'Post widget', 'laid-back' ).' '.$i,
    'section' => 'laid_back_post_widget_fit_sections',
    'type' => 'checkbox',
  ));
  ++$i;
}