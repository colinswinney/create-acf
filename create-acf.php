<?php

/**
 * Plugin Name:   Create ACF
 * Plugin URI:    https://colinswinney.com
 * Description:   Create blocks and fields using ACF and ACF Builder
 * Version:       1.0
 * Author:        Colin Swinney
 * Author URI:    https://colinswinney.com
 */

/**
 * Exit if accessed directly
 */
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Define plugin's path
 */
define( 'CREATE_ACF_BLOCKS_PATH', plugin_dir_path( __FILE__ ) );
define( 'CREATE_ACF_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load ACF Builder / Vendor files
 */
if (file_exists(CREATE_ACF_BLOCKS_PATH . '/vendor/autoload.php')) {
    require_once(CREATE_ACF_BLOCKS_PATH . '/vendor/autoload.php');
}

/**
 * Add CLI commands
 */
require_once(CREATE_ACF_BLOCKS_PATH . '/cli.php');

/**
 * Init plugin
 * 
 * - loop through the blocks directory and require all "register-" files
 * - loop through the fields directory and require all files
 * 
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
add_action('acf/init', function() {

    $dir = glob(CREATE_ACF_BLOCKS_PATH .'blocks/*/register-*.php');
    foreach($dir as $file) {
        require_once($file);
    }

    $dir = glob(CREATE_ACF_BLOCKS_PATH .'fields/*.php');
    foreach($dir as $field) {
        require_once($field);
    }

});


