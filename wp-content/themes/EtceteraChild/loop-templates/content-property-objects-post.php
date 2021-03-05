<?php
/**
 * Partial template for content in page.php
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( get_field( 'property_image' ) ) : ?>
		<img src="<?php the_field( 'property_image' ); ?>" />
	<?php endif ?>

	<div class="entry-content">

		<p>Название - <?php the_field( 'property_name' ); ?></p>
		<?php the_content('Читать полностью...'); ?>
		<p>Местополжение строения: <?php the_field( 'property_coords' ); ?></p>
		<p>Кол-во этажей: <?php the_field( 'property_floors_num' ); ?></p>
		<p>Тип строения: <?php the_field( 'property_building_type' ); ?></p>
		<p>Экология строения: <?php the_field( 'property_ecology' ); ?></p>
		<br>
		<?php if ( have_rows( 'property_room' ) ) : ?>
			<p>Помещение:</p>
			<?php while ( have_rows( 'property_room' ) ) : the_row(); ?>
				<?php if ( get_sub_field( 'property_room_image' ) ) : ?>
					<img src="<?php the_sub_field( 'property_room_image' ); ?>" />
				<?php endif ?>
				<p>Площадь: <?php the_sub_field( 'property_room_square' ); ?></p>
				<p>Количество комнат: <?php the_sub_field( 'property_room_quantity' ); ?></p>
				<p>Балкон - <?php the_sub_field( 'property_room_balcony' ); ?></p>
				<p>Санузел - <?php the_sub_field( 'property_room_bathroom' ); ?></p>
			<?php endwhile; ?>
		<?php endif; ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->