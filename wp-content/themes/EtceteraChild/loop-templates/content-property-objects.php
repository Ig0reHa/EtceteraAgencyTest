<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="col-md-6">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<header class="entry-header">
			<a href="<?php the_permalink() ?>"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></a>
		</header><!-- .entry-header -->

		<?php if ( get_field( 'property_image' ) ) : ?>
			<a href="<?php the_permalink() ?>"><img src="<?php the_field( 'property_image' ); ?>" /></a>
		<?php endif ?>

		<div class="entry-content">

			<p>Название - <?php the_field( 'property_name' ); ?></p>
			<?php the_content('Читать полностью...'); ?>
			<p>Местополжение строения: <?php the_field( 'property_coords' ); ?></p>
			<p>Кол-во этажей: <?php the_field( 'property_floors_num' ); ?></p>
			<p>Тип строения: <?php the_field( 'property_building_type' ); ?></p>
			<p>Экология строения: <?php the_field( 'property_ecology' ); ?></p>

		</div><!-- .entry-content -->

	</article><!-- #post-## -->
</div>