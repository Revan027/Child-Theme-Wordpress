<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
get_header();
if ($mantra_frontpage=="Enable" && is_front_page() ) {
	mantra_frontpage_generator();
}
else {
	?>          <!------------------------- en-tête de l'article -------------------------->
                  <div class="titre-single">
                        <div class="fond-titre-single">
                              <div class="filtre-titre-single">
                                    <div class="titre-meta">				
                                          <h1><?php the_title(); ?></h1>
                                    </div>
                                    <div class="entry-meta">
                                    </div><!-- .entry-meta -->
                              </div>
                        </div>
                  </div>

			<section id="container">
				<div id="content" role="main">
				<?php cryout_before_content_hook(); ?>

				<?php get_template_part( 'content/content', 'page'); ?>

				<?php cryout_after_content_hook(); ?>
				</div><!-- #content -->
			</section><!-- #container -->


	<?php } // else

get_footer(); 
