<?php
/**
 * Template Name: Объекты недвижимости
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
							<?php
								global $post;

								$args = array(
									'numberposts' => 10,
									'orderby'     => 'date',
									'order'       => 'DESC',
									'post_type'   => 'property-object',
								);
								$myposts = get_posts( $args );

								foreach( $myposts as $post ){ setup_postdata($post);
									get_template_part( 'loop-templates/content', 'property-objects' );
								}
								
								wp_reset_postdata();
							?>
							</div>
						</div>
						<?php get_template_part( 'sidebar-templates/sidebar', 'property-object' ); ?>
					</div>
				</main><!-- #main -->

			</div><!-- #primary -->
			
		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
