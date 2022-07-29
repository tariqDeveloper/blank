<?php
/**
* Template Name: Quote Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ickon
 */

get_header();
?>

	<main id="primary" class="site-main">

				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
		

			$ch = curl_init();
			  curl_setopt($ch, CURLOPT_URL,'https://api.kanye.rest');
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			  for ($i = 0; $i <5 ; $i++) {
			  	$response = curl_exec($ch);
			  	$result = json_decode($response);
			  	echo "<h2>".$result->quote."</h2>";
			  	
			  }

			  
			  
			  


			get_template_part( 'template-parts/content', 'none' );

		?>

	</main><!-- #main -->

<?php
get_footer();
