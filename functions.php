<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/*************************************************fonctions du theme enfant*************************************************/
/*************************************************                          *************************************************        
*************************************************                           *************************************************
*************************************************                           *************************************************/

/*************************************************Category menu*************************************************/
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







/*************************************************surcharge des fonctions du thème parent*************************************************/
/*************************************************                          *************************************************        
*************************************************                           *************************************************
*************************************************                           *************************************************/



/*************************************************Removing in init, parent's functions*************************************************/

add_action( 'init', 'remove_actions_parent_theme');//init, au demarrage

function remove_actions_parent_theme() {//fonction de remove et d'action. Faire un add action de son remove action
     remove_action( 'cryout_forbottom_hook','mantra_smenur_socials');//retrait action fonction parente
     add_action( 'cryout_forbottom_hook', 'mantra_smenur_socials_override' ); //ajout action fonction enfante
     
     remove_action( 'cryout_branding_hook','mantra_title_and_description');
     add_action( 'cryout_branding_hook', 'mantra_title_and_description_override' ); 
 
     remove_action( 'cryout_footer_hook', 'mantra_site_info', 12 );
     //add_action( 'cryout_footer_hook', 'mantra_site_info_override', 12 );
     add_action('info_footer','mantra_copyright_override'); 
     add_action('copyright_footer','mantra_site_info_override');   //priorité supérieur pour afficher le texte en premier avant le copyright
 
     /*supprime l'action du theme parent*/
     remove_action('cryout_before_comments_hook','mantra_number_comments');
     /*ajoute le mien*/
     add_action( 'cryout_before_comments_hook', 'override_mantra_number_comments' );
     
     add_action('wp_enqueue_scripts', 'styles_mantra_child');
  
}
 
function styles_mantra_child() {
      wp_register_style( 'fontawesome', get_template_directory_uri()."-child/img/fontawesome/css/all.css");
      wp_enqueue_style('fontawesome');
}



/************************************************* SIDEBARS *************************************************/
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

/*************************************************change form comment default*************************************************/

function customizeFormComment($fields){
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );


    $fields["fields"]["author"] = "<input type='text' class='form-control' placeholder='Votre nom*' ' . $aria_req . '>";

    $fields["fields"]["email"] = 
    '<input id="email" name="email" type="text" class="form-control" placeholder="Votre mail" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';

    $fields["fields"]['cookies'] =  '<p class="comment-form-cookies-consent">
    <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '
    <label for="wp-comment-cookies-consent"> Enregistez mon nom et mon adresse mail pour le prochain commentaire</label></p>';

    unset($fields["fields"]["url"]);

    //var_dump( $fields["fields"]);
    return  $fields;
}

/*function a(){
    echo"ddddddddddddddddddddddddddddddddddddd";
}add_action( 'comment_form_defaults','a' ); ajoute une action lors de l'apelle de comment_form_defaults*/
add_filter( 'comment_form_defaults','customizeFormComment' );




/*************************************************number of comments*************************************************/
function override_mantra_number_comments() { ?>
    <div class="blockTitreCommentaire">
        <span class="left-titre-categ-home"></span>
        <h3 id="comments-title">
            <?php          
                echo"Commentaires postés <small>(".get_comments_number().")</small>" ;
            ?>
        </h3>
        <span class="right-titre-categ-home"></span>
    </div>
     <?php 
}




/*************************************************construction d'un commentaire*************************************************/
function mantra_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="fondComment">
            <div class="block-avatar">
                <?php echo get_avatar( $comment, 40 ); ?>
            </div>
            
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-author vcard">
                    <?php printf(  '%s <span class="says">'.__('says:', 'mantra' ).'</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>


                </div><!-- .comment-author .vcard -->

                <div class="comment-meta commentmetadata"><!--<a href="<?php //echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">-->
                    <?php
                        /* translators: 1: date, 2: time */
                        printf(  '%1$s '.__('at', 'mantra' ).' %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mantra' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->

                <div class="comment-body">
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'mantra' ); ?></em>
                    <br />
                <?php endif; ?>
                <?php comment_text(); ?></div>

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </div><!-- #comment-##  -->
        </div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'mantra' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'mantra'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}





/*************************************************Contenu d'un article*************************************************/
if ( ! function_exists( 'mantra_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post—date/time and author.
     *
     * @since mantra 0.5
     */
    function mantra_posted_on() {
    
        $date_string = '<time class="onDate date published" datetime="' . get_the_time( 'c' ) . '"> %3$s </time>';
        $date_string .= '<time class="updated"  datetime="' . get_the_modified_date( 'c' ) . '">' . get_the_modified_date() . '</time>';
    
        // If author is hidden don't give it a value
       /* $author_string = sprintf( '<span class="author vcard" > %4$s <a class="url fn n" rel="author" href="%1$s" title="%2$s">%3$s</a> <span class="bl_sep"> le </span></span>',
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    sprintf( esc_attr__( 'View all posts by %s', 'mantra' ), get_the_author() ),
                    get_the_author(),
                    __('By ', 'mantra')
                );*/
    
        // Print the meta data
        //revan change position categorie
        //printf( ' %4$s  '.$date_string.' <span class="bl_categ"> %2$s </span>  ',
        printf( ' %4$s  '.$date_string.' ',
            'meta-prep meta-prep-author',
            get_the_category_list( ', ' ),
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span> <span class="entry-time"> - %2$s</span></a>',
                esc_url( get_permalink() ),
                esc_attr( get_the_time() ),
                get_the_date()
            ), $author_string
    
        );
    }
    endif;



/*************************************************Image mise en avant*************************************************/
if ( ! function_exists( 'mantra_set_featured_thumb' ) ) :
    /**
     * Adds a post thumbnail and if one doesn't exist the first image from the post is used.
     */
    
    function mantra_set_featured_thumb() {
        global $mantra_options;
        extract($mantra_options);
        global $post;
        $image_src = cryout_echo_first_image($post->ID);
    
        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $mantra_fpost=='Enable') {
            //the_post_thumbnail( 'custom', array( "class" => "post-thumbnail" ) );
            the_post_thumbnail('medium' );
        } elseif ($mantra_fpost=='Enable' && $mantra_fauto=="Enable" && $image_src && ($mantra_excerptarchive != "Full Post" || $mantra_excerpthome != "Full Post")) { ?>
            <a class="post-thumbnail-link" title="<?php echo the_title_attribute('echo=0') ?>" href="<?php echo esc_url( get_permalink() ) ?>" >
                <img width="<?php echo $mantra_fwidth ?>" title="" alt="<?php echo the_title_attribute('echo=0') ?>" class="align<?php echo strtolower($mantra_falign) ?> post_thumbnail" src="<?php echo $image_src ?>">
            </a>
        <?php }
    }
endif; // mantra_set_featured_thumb




/*ici*/

/*************************************************Show info Footer*************************************************/

function info_footer(){
    do_action('info_footer');   //Lance le hook
}

function copyright_footer(){
    do_action('copyright_footer');   //Lance le hook
}

function mantra_site_info_override() { ?>
    <div class="copyright" >
        <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php bloginfo( 'name' ); ?></a> | Réalisé par Freyss Morgan 
    </div><!-- #site-info --> <?php 
}

function mantra_copyright_override() {
    global $mantra_options; ?>
    <div id="info-footer"> 
        <?php echo wp_kses_post( do_shortcode( $mantra_options['mantra_copyright'] ) ) ?>
    </div>
    <?php
}
    



/*************************************************Hidden social header icones*************************************************/
function mantra_smenur_socials_override() {//fonction enfante override
   // mantra_set_social_icons('smenur');
}

function mantra_title_and_description_override() {
	global $mantra_options;
	global $mantra_totalSize;
	extract( $mantra_options );

	// Header styling and image loading
	// Check if this is a post or page, if it has a thumbnail, and if it's a big one

	global $post;

	if (get_header_image() != '') { $header_image = get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && ($mantra_fheader == "Enable") && ($image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'header' ) ) && (intval($image[1]) >= $mantra_totalSize) ):
		$header_image = $image[0];
	endif;

	if (isset($header_image) && ($header_image != '')) {
		printf( '<img id="bg_image" alt="%1$s" title="" src="%2$s" />', esc_attr( get_bloginfo( 'name', 'display' ) ), $header_image );
	}
	?>
	
	<div id="header-container">
	
	<?php
	switch ($mantra_siteheader) {

		case 'Site Title and Description': 
			$heading_tag = ( ( is_home() || is_front_page() ) && !is_page() ) ? 'h1' : 'div'; ?>
			<div>
				<<?php echo $heading_tag ?> id="site-title">
					<span> <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ) ?></a> </span>
				</<?php echo $heading_tag ?>>
				<div id="site-description" ><?php echo esc_attr( get_bloginfo( 'description' ) ) ?></div>
			</div> <?php
		break;

		case 'Clickable header image': ?>
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" id="linky"></a>
			<?php
		break;

		case 'Custom Logo' :
			if (!empty($mantra_logoupload)) { ?>
			<div>
				<a id="logo" href="<?php echo esc_url( home_url( '/' ) ) ?>"> <img title="" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" src="<?php echo $mantra_logoupload ?>" /> </a>
			</div> 
			<?php }
		break;

		case 'Empty' :
			// nothing to do here
		break;
	}

	//if ($mantra_socialsdisplay0): mantra_header_socials(); endif;
	?>
	</div> <!-- #header-container -->
	<?php
}


?>