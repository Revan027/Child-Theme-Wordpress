<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cryout Creations
 * @subpackage Mantra
 */
get_header();

if ($mantra_frontpage=="Enable" && is_front_page() ):
	mantra_frontpage_generator();
	if ($mantra_frontposts=="Enable"): get_template_part('content/content','frontpage'); endif;
else:
?>


<!------------------------- SLIDER -------------------------->
<div class='window'>
	<?php 
		echo do_shortcode('[smartslider3 slider=2]');   //interprete un shortcode
	?>	
</div>


<!------------------------- LISTE DES ARTICLES -------------------------->
<header id="header">
	<div class="titre-categ">
            <div>
                  <span class="left-titre-categ-home"></span>
                  <h1>Derniers articles</h1> 
                  <i class="fa fa-pen" aria-hidden="true"></i>         
                  <span class="right-titre-categ-home"></span>
            </div>	
            <p>Les dernières news du Trail, et les billets d'humeurs les plus récents du blog. Bonne découverte!</p>
	</div>								
</header>

<section id="container">
      <div id="content" role="main">     
            <?php cryout_before_content_hook(); ?>
            <?php if ( have_posts() ) : ?>

                  <?php mantra_content_nav( 'nav-above' ); ?>

                  <?php 
                        /********************* AFFICHAGE DES ARTICLES ******************************/
                        $i = 0;
                        while ($i<6){
                              the_post();
                              get_template_part( 'content/content', get_post_format() );   
                              $i++; 
                        }  
                  ?>

                  <?php if($mantra_pagination=="Enable") mantra_pagination(); else mantra_content_nav( 'nav-below' ); ?>

            <?php else : ?>

                  <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                              <h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
                        </header>

                        <div class="entry-content">
                              <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mantra' ); ?></p>
                              <?php get_search_form(); ?>
                        </div>
                  </article>
            <?php endif; ?>
            <?php cryout_after_content_hook(); ?>
      </div>
</section>


<!------------------------- SEPARATEUR -------------------------->
<div class="titre-categ-home">
      <div class="fondTitreCateg">
            <div class="filtreTitreCateg"></div>
      </div>
</div>

<div style="clear:both;"> </div>


<!------------------------- EVENEMENT -------------------------->
<div class="titre-categ">
      <div>
            <span class="left-titre-categ-home"></span>
            <h1>Calendrier des Trails</h1> 
            <i class="fa fa-calendar" aria-hidden="true"></i>         
            <span class="right-titre-categ-home"></span>
      </div>	
      <p>Le planning de mes prochaines courses</p>    
</div>
<div class="widget-calendar">
      <h2>COMING SOON...</h2>
</div>


<!------------------------- PORTFOLIO -------------------------->            
<div class="widget-portfolio">
            <?php echo (do_shortcode("[pfhub_portfolio_portfolio id='1']")); ?>
</div>
<?php 
endif;

get_footer(); 