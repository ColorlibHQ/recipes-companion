<?php
/*
 * Plugin Name:       Recipes Companion
 * Plugin URI:        https://colorlib.com/wp/themes/recipes/
 * Description:       Recipes Companion is a companion for Recipes theme.
 * Version:           1.0.1
 * Author:            Colorlib
 * Author URI:        https://colorlib.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       recipes-companion
 * Domain Path:       /languages
 */


if( !defined( 'WPINC' ) ){
    die;
}

/*************************
    Define Constant
*************************/

// Define version constant
if( !defined( 'RECIPES_COMPANION_VERSION' ) ){
    define( 'RECIPES_COMPANION_VERSION', '1.1' );
}

// Define dir path constant
if( !defined( 'RECIPES_COMPANION_DIR_PATH' ) ){
    define( 'RECIPES_COMPANION_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Define inc dir path constant
if( !defined( 'RECIPES_COMPANION_INC_DIR_PATH' ) ){
    define( 'RECIPES_COMPANION_INC_DIR_PATH', RECIPES_COMPANION_DIR_PATH.'inc/' );
}

// Define sidebar widgets dir path constant
if( !defined( 'RECIPES_COMPANION_SW_DIR_PATH' ) ){
    define( 'RECIPES_COMPANION_SW_DIR_PATH', RECIPES_COMPANION_INC_DIR_PATH.'sidebar-widgets/' );
}

// Define elementor widgets dir path constant
if( !defined( 'RECIPES_COMPANION_EW_DIR_PATH' ) ){
    define( 'RECIPES_COMPANION_EW_DIR_PATH', RECIPES_COMPANION_INC_DIR_PATH.'elementor-widgets/' );
}

// Define demo data dir path constant
if( !defined( 'RECIPES_COMPANION_DEMO_DIR_PATH' ) ){
    define( 'RECIPES_COMPANION_DEMO_DIR_PATH', RECIPES_COMPANION_INC_DIR_PATH.'demo-data/' );
}


$current_theme = wp_get_theme();

$is_parent = $current_theme->parent();



if( ( 'Recipes' ==  $current_theme->get( 'Name' ) ) || ( $is_parent && 'Recipes' == $is_parent->get( 'Name' ) ) ){
    require_once RECIPES_COMPANION_DIR_PATH . 'recipes-init.php';
}else{

    add_action( 'admin_notices', 'recipes_companion_admin_notice', 99 );
    function recipes_companion_admin_notice() {
        $url = 'https://demo.colorlib.com/recipes/';
    ?>
        <div class="notice-warning notice">
            <p><?php printf( __( 'In order to use the <strong>Recipes Companion</strong> plugin you have to also install the %1$sRecipes Theme%2$s', 'recipes-companion' ), '<a href="'.esc_url( $url ).'" target="_blank">', '</a>' ); ?></p>
        </div>
        <?php
    }
}

?>