<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Cryout Creations
 * @subpackage Mantra
 * @since Mantra 1.0
 */

get_header(); ?>

<!------------------------- EN-TETE / AFFICHAGE NOM DE LA CATEGORIE -------------------------->
<div class="titre-single">
      <div class="fond-titre-single">
            <div class="filtre-titre-single">
                  <div class="titre-meta">				
                        <h1>
                              <?php  
                              $arr =  get_the_category() ; 
                              echo $arr[0]->name; 
                              ?>
                        </h1>
                  </div>
                  <div class="entry-meta desc-categ">
                        <?php  echo $arr[0]->description; ?>
                  </div>
            </div>
      </div>
</div>

<section id="container">
      <div id="content" role="main">    
            <?php cryout_before_content_hook(); ?>

            <?php if ( have_posts() ):?>
                  <?php mantra_content_nav( 'nav-above' ); ?>

                  <?php 
                        /********************* AFFICHAGE DES ARTICLES ******************************/
                        while ( have_posts() ) : the_post(); 

                              get_template_part( 'content/content-category', get_post_format() );

                        endwhile; 
                  ?>
            <?php else : ?>

                  <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                              <h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                              <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mantra' ); ?></p>
                              <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                  </article><!-- #post-0 -->

      
            <?php endif; ?>
      
            <?php cryout_after_content_hook(); ?>
      </div>

</section>

<?php mantra_content_nav( 'nav-above' ); ?>

<?php if($mantra_pagination=="Enable") mantra_pagination(); else mantra_content_nav( 'nav-below' ); ?>
<?php 
get_footer();
