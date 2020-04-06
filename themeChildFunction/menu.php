<?php

function showPages(){
      $args = array(
            'child_of'     => 0,
            'sort_order'   => 'ASC',
            'sort_column'  => 'post_title',
            'hierarchical' => 1,
            'exclude'      => array(),
            'include'      => array(),
            'meta_key'     => '',
            'meta_value'   => '',
            'authors'      => '',
            'parent'       => -1,
            'exclude_tree' => array(),
            'number'       => '',
            'offset'       => 0,
            'post_type'    => 'page',
            'post_status'  => 'publish',
      );
      $pages = get_pages( $args );
      $chaine = "";
      $chaine .= "<li class='categMenu' id='categ".$value->term_id."'><p>Pages</p>";
      $chaine .="<ul>";

      foreach($pages as $value){
            $chaine .= "<li id='post".$value->ID."'><a href='".get_permalink($value->ID)."'>".$value->post_title."</a></li>";	
      }
      $chaine .="</ul>";
      return $chaine;
  }

  
function showPost($category){
    $args = array(
        'posts_per_page'   => 3,
        'offset'           => 0,
        'cat'         => '',
        'category_name'    => $category,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'	   => '',
        'author_name'	   => '',
        'post_status'      => 'publish',
        'suppress_filters' => true,
        'fields'           => '',
    );
    $post = get_posts( $args );
    $chaine = "";

    foreach($post as $value){
        $chaine .= "<li id='post".$value->ID."'><a href='".get_permalink($value->ID)."'>".$value->post_title."</a></li>";	
    }
    return $chaine;
}


function showCategory(){
    $chaine = "";
    $categ = get_categories();

    foreach($categ as $value){
        $chaine .= "<li class='categMenu' id='categ".$value->term_id."'><p>".$value->name."</p>";
        $chaine .="<ul>".showPost($value->slug )."</ul></li>";
    }
    return $chaine;
}
