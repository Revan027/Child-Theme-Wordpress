<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */

get_header(); ?>

		

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                        <!------------------------- last post title-------------------------->

                        <!------------------------- en-tête de l'article -------------------------->
				<div class="titre-single">
					<div class="fond-titre-single">
						<div class="filtre-titre-single">
							<div class="iconCateg">
                                                <?php the_category() ; ?>
                                                <div class="icon_author"><?php the_author(); ?></div>                       
							</div>
							<div class="titre-meta">				
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="entry-meta">
								<?php mantra_posted_on(); cryout_post_meta_hook(); ?>
							</div><!-- .entry-meta -->
						</div>
					</div>
                        </div>
                        
            <section id="container">
			<div id="contentPost" role="main">

			<?php cryout_before_content_hook(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ); ?></div>
                        </div><!-- #nav-above -->
                        

                        <!------------------------- contenu de l'article -------------------------->
				<div class="block-article">
					<article id="post-<?php the_ID(); ?>">
						
						<?php cryout_post_title_hook(); ?>

						<div class="entry-content">
                                          <div class="image-entete">
                                                <?php the_post_thumbnail( 'medium' ); ?>
                                          </div>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ), 'after' => '</span></div>' ) ); ?>
						</div><!-- .entry-content -->

						<div class="entry-utility">
							<?php //mantra_posted_in(); ?>
							<?php edit_post_link( __( 'Edit', 'mantra' ), '<span class="edit-link">', '</span>' ); cryout_post_footer_hook(); ?>
						</div><!-- .entry-utility -->
					</article><!-- #post-## -->
				</div>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<div id="entry-author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mantra_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( esc_attr__( 'About %s', 'mantra' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
						<div id="author-link">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by ','mantra').'%s <span class="meta-nav">&rarr;</span>', get_the_author() ); ?>
							</a>
						</div><!-- #author-link	-->
					</div><!-- #author-description -->
				</div><!-- #entry-author-info -->
<?php endif; ?>

                         <!------------------------- navigation pour les autres articles -------------------------->      
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ); ?></div>
				</div><!-- #nav-below -->


                        <!------------------------- vers les commentaires -------------------------->  
				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
		</section><!-- #container -->

<?php 
get_footer();
