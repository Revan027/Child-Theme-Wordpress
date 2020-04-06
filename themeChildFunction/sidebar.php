<?php

add_action( 'widgets_init', 'create_sidebar_video' );
function create_sidebar_video() {
      $args = array(
      'name'          => 'Sidebar Video',
      'id'            => 'sidebar-video',
      'description'   => 'The Sidear only for video',
      'class'         => '',
      'before_widget' => '<div class="sidebar-video">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widgettitle">',
      'after_title'   => '</h2>' 
      );

      register_sidebar( $args );
}

add_action( 'widgets_init', 'create_sidebar_sound' );
function create_sidebar_sound() {
      $args = array(
      'name'          => 'Sidebar Sound',
      'id'            => 'sidebar-sound',
      'description'   => 'The Sidear only for the music',
      'class'         => '',
      'before_widget' => '<div class="sidebar-sound">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widgettitle">',
      'after_title'   => '</h2>' 
      );

      register_sidebar( $args );
}