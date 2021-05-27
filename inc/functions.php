<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Recipes Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function recipes_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'recipes_companion_frontend_scripts', 99 );
function recipes_companion_frontend_scripts() {

	wp_enqueue_script( 'recipes-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'recipes-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_recipes_portfolio_ajax', 'recipes_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_recipes_portfolio_ajax', 'recipes_portfolio_ajax' );
function recipes_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo recipes_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function recipes_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Recipes - Custom Post Type
function recipes_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Recipes', 'post type general name', 'recipes-companion' ),
		'singular_name'      => _x( 'Recipe', 'post type singular name', 'recipes-companion' ),
		'menu_name'          => _x( 'Recipes', 'admin menu', 'recipes-companion' ),
		'name_admin_bar'     => _x( 'Recipes', 'add new on admin bar', 'recipes-companion' ),
		'add_new'            => _x( 'Add New', 'recipes', 'recipes-companion' ),
		'add_new_item'       => __( 'Add New Recipes', 'recipes-companion' ),
		'new_item'           => __( 'New Recipe', 'recipes-companion' ),
		'edit_item'          => __( 'Edit Recipe', 'recipes-companion' ),
		'view_item'          => __( 'View Recipe', 'recipes-companion' ),
		'all_items'          => __( 'All Recipes', 'recipes-companion' ),
		'search_items'       => __( 'Search Recipes', 'recipes-companion' ),
		'parent_item_colon'  => __( 'Parent Recipes:', 'recipes-companion' ),
		'not_found'          => __( 'No Recipes found.', 'recipes-companion' ),
		'not_found_in_trash' => __( 'No Recipes found in Trash.', 'recipes-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'recipes-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recipes' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'recipes', $args );

	// recipes-cat - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Recipes Category', 'taxonomy general name', 'recipes-companion' ),
		'singular_name'     => _x( 'Recipes Categories', 'taxonomy singular name', 'recipes-companion' ),
		'search_items'      => __( 'Search Recipes Categories', 'recipes-companion' ),
		'all_items'         => __( 'All Recipes Categories', 'recipes-companion' ),
		'parent_item'       => __( 'Parent Recipe Category', 'recipes-companion' ),
		'parent_item_colon' => __( 'Parent Recipe Category:', 'recipes-companion' ),
		'edit_item'         => __( 'Edit Recipe Category', 'recipes-companion' ),
		'update_item'       => __( 'Update Recipe Category', 'recipes-companion' ),
		'add_new_item'      => __( 'Add New Recipe Category', 'recipes-companion' ),
		'new_item_name'     => __( 'New Recipe Category Name', 'recipes-companion' ),
		'menu_name'         => __( 'Recipe Category', 'recipes-companion' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'recipes-category' ),
	);

	register_taxonomy( 'recipes-cat', array( 'recipes' ), $args );


	// recipes-tags - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Recipes Tags', 'taxonomy general name', 'recipes-companion' ),
		'singular_name'     => _x( 'Recipes Tags', 'taxonomy singular name', 'recipes-companion' ),
		'search_items'      => __( 'Search Recipes Tags', 'recipes-companion' ),
		'all_items'         => __( 'All Recipes Tags', 'recipes-companion' ),
		'parent_item'       => __( 'Parent Recipe Tag', 'recipes-companion' ),
		'parent_item_colon' => __( 'Parent Recipe Tag:', 'recipes-companion' ),
		'edit_item'         => __( 'Edit Recipe Tag', 'recipes-companion' ),
		'update_item'       => __( 'Update Recipe Tag', 'recipes-companion' ),
		'add_new_item'      => __( 'Add New Recipe Tag', 'recipes-companion' ),
		'new_item_name'     => __( 'New Recipe Tag Name', 'recipes-companion' ),
		'menu_name'         => __( 'Recipe Tag', 'recipes-companion' ),
	);

	$args = array(
		// 'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'recipes-tag' ),
	);

	register_taxonomy( 'recipes-tag', array( 'recipes' ), $args );

}
add_action( 'init', 'recipes_custom_posts' );



/*=========================================================
    Cases Section
========================================================*/
function recipes_case_section( $post_order ){ 
	$cases = new WP_Query( array(
		'post_type' => 'case',
		'order' => $post_order,

	) );
	
	if( $cases->have_posts() ) {
		while ( $cases->have_posts() ) {
			$cases->the_post();			
			$case_cat = get_the_terms(get_the_ID(), 'case-cat');
			$case_img      = get_the_post_thumbnail( get_the_ID(), 'recipes_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
			?>
			<div class="single_case">
				<?php 
					if ( $case_img ) {
						echo '
							<div class="case_thumb">
								'.$case_img.'
							</div>
						';
					}
				?>
				<div class="case_heading">
					<span><?php echo $case_cat[0]->name?></span>
					<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
				</div>
			</div>
			<?php
		}
	}
}

// Related recipes for Single Page
function recipes_related_items( $current_post_id = null, $post_item = 3, $post_order = 'DESC' ){
	$related_recipes = new WP_Query( array(
        'post_type' => 'recipes',
        'order' => $post_order,
        'posts_per_page' => $post_item,
		'post__not_in' => array( $current_post_id ),
        // 'posts_per_page'    => $pnumber,
    ) );
	?>
	<!-- recepie_area_start  -->
	<div class="recepie_area inc_padding">
        <div class="container">
            <div class="row">
				<?php
				if( $related_recipes->have_posts() ) {
					while ( $related_recipes->have_posts() ) {
						$related_recipes->the_post();			
						$recipe_img = get_the_post_thumbnail( get_the_ID(), 'recipes_circle_thumb_300x300', '', array( 'alt' => get_the_title() ) );
						$making_time = ! empty( recipes_meta( 'time') ) ? recipes_meta( 'time') : 'N/A';
						?>
						<div class="col-xl-4 col-lg-4 col-md-6">
							<div class="single_recepie text-center">
								<?php
									if ( has_post_thumbnail() ) {
										echo '
											<div class="recepie_thumb">
												'.$recipe_img.'
											</div>
										';
									}
								?>
								<h3><?php the_title()?></h3>
								<span><?php echo recipes_get_tax_function('recipes-cat')?></span>
								<p><?php _e('Time Needs :', 'recipes-companion')?> <?php echo esc_html($making_time)?></p>
								<a href="<?php the_permalink()?>" class="line_btn"><?php _e('View Full Recipe', 'recipes-companion')?></a>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<!-- recepie_area_end  -->
	<?php
}