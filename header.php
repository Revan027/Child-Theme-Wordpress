<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<?php cryout_seo_hook(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
 	cryout_header_hook();
	wp_head(); ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body <?php body_class(); ?>>

<!-------------------------- widget hidden-------------------------->
<div class="widget-hidden">
	<div class="icon-widget-hidden" id="video">	
		<?PHP echo wp_get_attachment_image(487,array("40"), "", array( "class" => "img-responsive icon" ) ); ?>		
		<p>Vidéo du moment</p>
	</div>

	<div class="icon-widget-hidden" id="sound">
		<?PHP echo wp_get_attachment_image(526,array("40"), "", array( "class" => "img-responsive icon" ) ); ?>		
		<p>Musique du moment</p>
	</div>	
</div>

<!------------------------- VIDEO -------------------------->
<?php
      is_active_sidebar( 'sidebar-video' ) ?  dynamic_sidebar( 'sidebar-video' ):'';
?>    

<!------------------------- MUSIC -------------------------->
<?php
      is_active_sidebar( 'sidebar-sound' ) ?  dynamic_sidebar( 'sidebar-sound' ):'';
?>    





<?php cryout_body_hook(); ?>
<div id="branding" role="banner" >
      <!-- 
	<div class="icones-banner">
		<?PHP 
			/*echo "<div>".wp_get_attachment_image(369,array('60'), "", array( "class" => "img-responsive" ) )."</div>"; 
			echo "<div>".wp_get_attachment_image(368,'full' , "", array( "class" => "img-responsive" ) )."</div>"; 
		?>
		
		<?PHP 
			echo "<div>".wp_get_attachment_image(367,array('60'), "", array( "class" => "img-responsive" ) )."</div>"; 
			echo "<div>".wp_get_attachment_image(370,'full' , "", array( "class" => "img-responsive" ) )."</div>"; */
		?>
      </div> -->
      
	<!-------------------------- menu par default -------------------------->
	<nav id="access" class="jssafe" role="navigation">
		<?php cryout_access_hook();?>
	</nav>
	
  
	<!-------------------------- menu responsive -------------------------->
	<div class="hidden-menu">
			<!--------<a id="nav-toggle"><span>&nbsp; <?php/* _e('Menu', 'mantra');*/?></span></a>--------->
			<a><span>Menu</span></a>
	</div>

	<ul class="categ-menu-responsive">
		<?php
            echo showCategory();
            echo showPages();
		?>		
	</ul>

	
	<!-------------------------- logo et slogan -------------------------->
	<div class="logo">	
		<?PHP echo "<a href='".home_url()."'>".wp_get_attachment_image(194,'full', "", array( "class" => "img-responsive" ) )."</a>"; ?>		
	</div>
	
	<div class="slogan">				
		<p>S'entrainer, se depasser, partager... </p>
	</div>
	
	<?php //cryout_branding_hook();?>

</div>

<?php //cryout_access_hook();?>




<div id="wrapper" class="hfeed">

	
<?php  cryout_wrapper_hook(); ?>



<div id="main" class="main">
	<div  id="forbottom" >
		<?php cryout_forbottom_hook(); ?>

		<div style="clear:both;"> </div>

		<?php cryout_breadcrumbs_hook();?>
