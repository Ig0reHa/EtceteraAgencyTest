<?php
/**
 * Template Name: Объект недвижимости
 * Template Post Type: property-object
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

			<div class="<?php echo is_active_sidebar( 'right-sidebar' ) ? 'col-md-8' : 'col-md-12'; ?> content-area" id="primary">

				<main class="site-main" id="main" role="main">
					
				<?php
					if ( have_posts() ) {
					
						the_post();

						get_template_part( 'loop-templates/content', 'property-objects-post' );
					
					}
				?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_template_part( 'sidebar-templates/sidebar', 'property-object' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();