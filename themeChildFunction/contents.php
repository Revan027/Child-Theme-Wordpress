<?php
function postHome(){
      $numberPost = 5;

      $args = array(
            'numberposts' => $numberPost,
            'offset' => 0,
            'category' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'include' => '',
            'exclude' => '',
            'meta_key' => '',
            'meta_value' =>'',
            'post_type' => 'post',
            'post_status' => 'draft, publish, future, pending, private',
            'suppress_filters' => true
      );

      $postInfo = wp_get_recent_posts( $args ) ;
      $tabPost = [ $numberPost, $postInfo] ;

      return  $tabPost;
}
