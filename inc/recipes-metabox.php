<?php
function recipes_page_metabox( $meta_boxes ) {

	$recipes_prefix = '_recipes_';
	$meta_boxes[] = array(
		'id'        => 'recipes_metaboxes',
		'title'     => esc_html__( 'Other Options', 'recipes-companion' ),
		'post_types'=> array( 'recipes' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $recipes_prefix . 'short_text',
				'type'  => 'textarea',
				'name'  => esc_html__( 'Recipes Short Text', 'recipes-companion' ),
			),
			array(
				'id'    => $recipes_prefix . 'rating',
				'type'  => 'button_group',
				'name'  => esc_html__( 'Recipes Ratings', 'recipes-companion' ),
				'inline'  => true,
				'options' => [
					'1' => '<span class="dashicons dashicons-star-filled"></span> <strong>1</strong>',
					'2' => '<span class="dashicons dashicons-star-filled"></span> <strong>2</strong>',
					'3' => '<span class="dashicons dashicons-star-filled"></span> <strong>3</strong>',
					'4' => '<span class="dashicons dashicons-star-filled"></span> <strong>4</strong>',
					'5' => '<span class="dashicons dashicons-star-filled"></span> <strong>5</strong>',
				]
			),
			array(
				'id'    => $recipes_prefix . 'time',
				'type'  => 'text',
				'name'  => esc_html__( 'Time To Prepare', 'recipes-companion' ),
				'placeholder'  => esc_html__( 'Ex: 30 mins', 'recipes-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'recipes_page_metabox' );