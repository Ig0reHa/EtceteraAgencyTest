<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}




add_action('init', 'property_object_post_types');
add_action('init', 'create_property_region');
add_action('init', 'tags_for_property_objects');
add_action('widgets_init', 'sidebar_widgets');
add_shortcode('property-object-filter', 'property_object_filter'); 


function sidebar_widgets(){	
	register_sidebar( array(
		'name'          => 'Сайдбар недвижимости',
		'id'            => 'property-object-sidebar',
		'description'   => 'Сайдбар недвижимости',
		'before_widget' => '<div class="property-object-sidebar">',
		'after_widget'  => "</div>\n",
	) );
}

function property_object_filter() {

	echo '<form action="';
	echo site_url();
	echo '/wp-admin/admin-ajax.php" method="POST" id="filter">';

	echo '<p><b>Фильтры по недвижимости:</b></p>';

	if( $property_regions = get_terms( array( 'taxonomy' => 'property-region', 'orderby' => 'name' ) ) ) : 
		echo '<select name="region_filter"><option value="">Район...</option>';
		foreach ( $property_regions as $property_region ) :
			echo '<option value="' . $property_region->term_id . '">' . $property_region->name . '</option>'; // ID of the category as the value of an option
		endforeach;
		echo '</select>';
	endif;

	if( $property_building_types = acf_get_field('field_603f7cfc275f7') ) : 
		echo '<select name="building_types_filter"><option value="">Тип строения...</option>';
		foreach ( $property_building_types["choices"] as $building_type ) :
			echo '<option value="' . $building_type . '">' . $building_type . '</option>'; // ID of the category as the value of an option
		endforeach;
		echo '</select>';
	endif;

	echo ' <div class="range-box">
			<div class="range-title">Количество этажей:</div>
			<div class="range-values">
				<input type="text" name="floors_min" placeholder="От" />
				<input type="text" name="floors_max" placeholder="До" />
			</div>
		</div>
		<label>
			<input type="radio" name="ecology" value="DESC" /> Экологичность: сначала лучшие
		</label>
		<label>
			<input type="radio" name="ecology" value="ASC" /> Экологичность: сначала худшие
		</label>
		<label>
			<input type="checkbox" name="featured_image" /> Только с изображением
		</label>
		<p><b>Фильтры по помещениям:</b></p>
		<label>
			<input type="checkbox" name="property_room_balcony" /> Балкон
		</label>
		<label>
			<input type="checkbox" name="property_room_bathroom" /> Санузел
		</label>
		<label>
			<input type="checkbox" name="property_room_image" /> Только с изображением
		</label>
		<div class="range-box">
			<div class="range-title">Площадь:</div>
			<div class="range-values">
				<input type="text" name="square_min" placeholder="От" />
				<input type="text" name="square_max" placeholder="До" />
			</div>
		</div>
		<div class="range-box">
			<div class="range-title">Количество комнат:</div>
			<div class="range-values">
				<input type="text" name="rooms_min" placeholder="От" />
				<input type="text" name="rooms_max" placeholder="До" />
			</div>
		</div>
		<button>Применить</button>
		<input type="hidden" name="action" value="myfilter">
	</form>
	<div id="property-filter-items-box"></div>

	<script>
		jQuery(function($){
			$("#filter").submit(function(){
				var filter = $("#filter");
				$.ajax({
					url:filter.attr("action"),
					data:filter.serialize(), // form data
					type:filter.attr("method"), // POST
					beforeSend:function(xhr){
						filter.find("button").text("Загрузка..."); // changing the button label
					},
					success:function(data){
						filter.find("button").text("Применить"); // changing the button label back
						$("#property-filter-items-box").html(data); // insert data
					}
				});
				return false;
			});
		});
	</script>
	';
}


wp_enqueue_style('style', get_stylesheet_uri() );

function property_object_post_types() {
	register_post_type( 'property-object' , array(
		'labels'             => array(
			'name'               => 'Объекты недвижимости',
			'singular_name'      => 'Объект недвижимости',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый объект недвижимости',
			'edit_item'          => 'Изменить объект недвижимости',
			'new_item'           => 'Новый объект недвижимости',
			'view_item'          => 'Посмотреть объект недвижимости',
			'search_items'       => 'Поиск по объектам недвижимости',
			'not_found'          => 'Объекы недвижимости не найдены',
			'not_found_in_trash' => 'Объекы недвижимости не найдены в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Объекты недвижимости'),
		'public'             => true,
		'name' 				 => 'property-object',
		'description'		 => '',
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'   		 => 'dashicons-building',
		'supports'           => array('title','editor')
	) );
}

function create_property_region() {
	register_taxonomy('property-region', array('post'), array(
		'label'                 => '',
		'labels'                => array(
			'name'              => 'Районы',
			'singular_name'     => 'Район',
			'search_items'      => 'Поиск по районам',
			'all_items'         => 'Все районы',
			'view_item '        => 'Посмотреть район',
			'parent_item'       => 'Родительские районы',
			'parent_item_colon' => 'Родительские районы:',
			'edit_item'         => 'Изменить район',
			'update_item'       => 'Обновить район',
			'add_new_item'      => 'Добавить новый район',
			'new_item_name'     => 'Название нового района',
			'menu_name'         => 'Районы',
		),
		'description'           => 'Районы',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite' 				=> array( 'slug' => 'property-region' ),
	) );
}

function tags_for_property_objects(){
	register_taxonomy_for_object_type( 'property-region', 'property-object' );
}


//var_dump()

add_action('wp_ajax_myfilter', 'property_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'property_filter_function');
 
function property_filter_function(){
	$args = array(
		'post_type'      => 'property-object',
		'posts_per_page' => 5,
		'orderby'        => 'date',
		'order'	         => 'DESC',
	);

	// for taxonomies / categories

	if( $_POST['region_filter'] != "" ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'property-region',
				'field' => 'id',
				'terms' => $_POST['region_filter']
			)
		);
	}
	
	if( isset( $_POST['floors_min'] ) && $_POST['floors_min'] || isset( $_POST['floors_max'] ) && $_POST['floors_max'] || isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' ) {
		$args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true
	}

	if( isset( $_POST['floors_min'] ) && $_POST['floors_min'] && isset( $_POST['floors_max'] ) && $_POST['floors_max'] ) {
		$args['meta_query'][] = array(
			'key' => 'property_floors_num',
			'value' => array( $_POST['floors_min'], $_POST['floors_max'] ),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		if( isset( $_POST['floors_min'] ) && $_POST['floors_min'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_floors_num',
				'value' => $_POST['floors_min'],
				'type' => 'numeric',
				'compare' => '>'
			);
		}

		if( isset( $_POST['floors_max'] ) && $_POST['floors_max'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_floors_num',
				'value' => $_POST['floors_max'],
				'type' => 'numeric',
				'compare' => '<'
			);
		}
	}
 
 
	if( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' ) {
		$args['meta_query'][] = array(
			'key'     => 'property_image',
			'value'   => '',
			'compare' => '!='
		);
	}

	if( isset( $_POST['ecology'] ) ) {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'property_ecology';
		$args['order'] = $_POST['ecology'];
	}

	if( $_POST['building_types_filter'] != "" ) {
		$args['meta_query'][] = array(
			'key'     => 'property_building_type',
			'value'   => $_POST['building_types_filter'],
		);
	}


	// PROPERTY ROOM FILTERS


	if( isset( $_POST['property_room_balcony'] ) && $_POST['property_room_balcony'] == 'on' ) {
		$args['meta_query'][] = array(
			'key'     => 'property_room_property_room_balcony',
			'value'   => 'Да',
		);
	}
	
	if( isset( $_POST['property_room_bathroom'] ) && $_POST['property_room_bathroom'] == 'on' ) {
		$args['meta_query'][] = array(
			'key'     => 'property_room_property_room_bathroom',
			'value'   => 'Да',
		);
	}

	if( isset( $_POST['property_room_image'] ) && $_POST['property_room_image'] == 'on' ) {
		$args['meta_query'][] = array(
			'key'     => 'property_room_property_room_image',
			'value'   => '',
			'compare' => '!='
		);
	}

	if( isset( $_POST['square_min'] ) && $_POST['square_min'] && isset( $_POST['square_max'] ) && $_POST['square_max'] ) {
		$args['meta_query'][] = array(
			'key' => 'property_room_property_room_square',
			'value' => array( $_POST['square_min'], $_POST['square_max'] ),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		if( isset( $_POST['square_min'] ) && $_POST['square_min'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_room_property_room_square',
				'value' => $_POST['square_min'],
				'type' => 'numeric',
				'compare' => '>'
			);
		}

		if( isset( $_POST['square_max'] ) && $_POST['square_max'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_room_property_room_square',
				'value' => $_POST['square_max'],
				'type' => 'numeric',
				'compare' => '<'
			);
		}
	}

	if( isset( $_POST['rooms_min'] ) && $_POST['rooms_min'] && isset( $_POST['rooms_max'] ) && $_POST['rooms_max'] ) {
		$args['meta_query'][] = array(
			'key' => 'property_room_property_room_quantity',
			'value' => array( $_POST['rooms_min'], $_POST['rooms_max'] ),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		if( isset( $_POST['rooms_min'] ) && $_POST['rooms_min'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_room_property_room_quantity',
				'value' => $_POST['rooms_min'],
				'type' => 'numeric',
				'compare' => '>'
			);
		}
			
		if( isset( $_POST['rooms_max'] ) && $_POST['rooms_max'] ) {
			$args['meta_query'][] = array(
				'key' => 'property_room_property_room_quantity',
				'value' => $_POST['rooms_max'],
				'type' => 'numeric',
				'compare' => '<'
			);
		}
	}


	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();

			$meta_property_image = get_field( 'property_image' );
			$meta_property_floors = get_post_meta( $query->post->ID, 'property_floors_num' );
			$meta_property_ecology = get_post_meta( $query->post->ID, 'property_ecology' );
			$meta_property_building_type = get_post_meta( $query->post->ID, 'property_building_type' );
			$meta_property_room_balcony = get_post_meta( $query->post->ID, 'property_room_property_room_balcony' );
			$meta_property_room_bathroom = get_post_meta( $query->post->ID, 'property_room_property_room_bathroom' );
			$meta_property_room_square = get_post_meta( $query->post->ID, 'property_room_property_room_square' );
			$meta_property_room_quantity = get_post_meta( $query->post->ID, 'property_room_property_room_quantity' );
			$meta_property_room_image = get_field( 'property_room_property_room_image' );

			echo '<div class="property-filter-items">';

			echo '<a href="' . get_the_permalink() . '"><h4>' . $query->post->post_title . '</h4></a>';

			if ($meta_property_image) {
				echo '<a href="' . get_the_permalink() . '"><img src="' . $meta_property_image . '"></a><br>';
			}
			echo 'Кол-во этажей: ' . $meta_property_floors[0] . '<br>';
			echo 'Экологичность: ' . $meta_property_ecology[0] . '<br>';
			echo 'Тип строения: ' . $meta_property_building_type[0] . '<br>';

			echo '<br>В помещении:<br>';
			if ($meta_property_room_image) {
				echo '<img src="' . $meta_property_room_image . '"> <br>';
			}
			echo 'Балкон: ' . $meta_property_room_balcony[0] . '<br>';
			echo 'Санузел: ' . $meta_property_room_bathroom[0] . '<br>';
			echo 'Площадь: ' . $meta_property_room_square[0] . ' кв. м.<br>';
			echo 'Количество комнат: ' . $meta_property_room_quantity[0] . '<br>';

			echo '</div>';
		endwhile;
		wp_reset_postdata();
	else :
		echo 'Объекты недвижимости не найдены';
	endif;
 
	die();
}