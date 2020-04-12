<?php
/**
 * The default template for displaying content
 *
 * @package Cryout Creations
 * @subpackage Mantra
 * @since Mantra 1.0
 */

$options= mantra_get_theme_options();
foreach ($options as $key => $value) {
     ${"$key"} = $value ;
} 

?>
<?php cryout_before_article_hook(); 


$postInfo  = get_query_var('postInfo ');//récupère la variable


?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
		<header class="entry-header">	
                  <div class="post-illustration">
                        <?php echo get_the_post_thumbnail( $postInfo["ID"], 'medium'); ?>

                        <div class="illustration-container">  
                              <div class="header-author">De <?php echo get_the_author_meta('display_name', $postInfo["post_author"] ) ?></div>  

                              <div class="illustration-title">
                                    <div><h5 class="entry-title">
                                          <a href="<?php echo get_permalink($postInfo["ID"]) ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mantra' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                                                <?php 
                                                      /*************************** TAILLE DU TITRE ******************************/
                                                      $titre = $postInfo["post_title"];
                            
                                                      (strlen($titre) >30) ?  $titre = substr($titre,0,30)."..." :  $titre; 
      
                                                      echo $titre;
                                                ?>
                                          </a>
                                    </h5></div>
                              </div>
                              
                              <div class="illustration-info">
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo  substr($postInfo["post_date"] , 0 , 10)  ?></span>
                                    <span><i class="fa fa-comment"></i>  <?php echo  $postInfo["comment_count"] ?></span>  
                              </div>
                         </div>              
                  </div>


			<?php cryout_post_title_hook(); 
			?><?php if ( 'post' == get_post_type() ) : ?>

			<!-- <div class="entry-meta">
				<?php //mantra_posted_on(); //retrait des infos meta du thème ?>
				<?php /* if ( comments_open() && ! post_password_required() ) :*/ ?>
			
			<?php /* endif; */ ?><?php 

			cryout_post_meta_hook();  ?>
			</div>--><!-- .entry-meta -->
			<?php endif; ?>

		
		</header><!-- .entry-header -->
			<?php cryout_post_before_content_hook();  
                  ?><?php if ( is_archive() || is_search() ) : 

                  /*************************** Contenu à afficher pour les archives/catéogries/recherches ******************************/ 
                  ?>	
                        <?php if ($mantra_excerptarchive != "Full Post" ){ ?>
                        <div class="entry-summary">
                        <?php //mantra_set_featured_thumb(); ?>
                        <?php //the_excerpt(); ?>
                        </div><!-- .entry-summary -->
                        <?php } else { ?>
                        <div class="entry-content">
                        <?php mantra_set_featured_thumb(); ?>
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
                        </div><!-- .entry-content --> 
                        <?php }   ?>
			
		<?php else : 
				if (is_sticky() && $mantra_excerptsticky == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($mantra_excerpthome != "Full Post" && $sticky_test==0){ ?>
					
					
						<!-- <div class="entry-summary">
					
						<?php //the_excerpt(); ?>
						</div> --> 
						<?php } else { ?>
						<!-- <div class="entry-content">
						<?php //the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div>--> 
						<?php }  

			endif; 
		 cryout_post_after_content_hook();  ?>

		

	</article><!-- #post-<?php the_ID(); ?> -->
	
	
<?php cryout_after_article_hook(); ?>