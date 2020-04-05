<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */

get_header(); ?>

	<div id="container" >
	
		<div id="content" class="content_404" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e('Not Found', 'mantra' ); ?></h1>

				<div class="entry-content" >
					<?PHP 
						/*custom imageErreur revan*/
						$tab = wp_get_attachment_image_src(236);	//fonction recherchant une image via son id
						echo '<img src="'.$tab[0].'"/>';	
					?>
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'mantra' ); ?></p>
					<div class="contentsearch"><?php get_search_form(); ?></div>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
		

	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer();