<?php

/**
 * Plugin Name:   Create ACF
 * Plugin URI:    https://colinswinney.com
 * Description:   Create blocks and fields using ACF Pro and ACF Builder
 * Version:       1.0
 * Author:        Colin Swinney
 * Author URI:    https://colinswinney.com
 */

/**
 * Exit if accessed directly
 */
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Only run this plugin if ACF Pro is installed
 */
if ( class_exists('acf_pro') ) {

    class Create_ACF {
        
        /**
         * __construct
         * 
         * @param void
         * 
         * @return void
         */
        
        public function __construct()
        {
            add_action( 'acf/init', array($this, 'init') );
        }



        /**
         * init
         * 
         * Sets up the plugin
         * 
         * @param void
         * 
         * @return void
         */
        public function init()
        {

            // Define constants.
			$this->define( 'CREATE_ACF_BLOCKS_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'CREATE_ACF_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

            // Load ACF Builder / Vendor files
            if (file_exists(CREATE_ACF_BLOCKS_PATH . '/vendor/autoload.php')) {
                require_once(CREATE_ACF_BLOCKS_PATH . '/vendor/autoload.php');
            }

            // Require WP-CLI commands
            require_once(CREATE_ACF_BLOCKS_PATH . '/cli.php');

            // Require main Register Block class
            require_once(CREATE_ACF_BLOCKS_PATH . '/register-block.php');

            // Require all "register-" files in the blocks directories
            $dir = glob(CREATE_ACF_BLOCKS_PATH .'blocks/*/register-*.php');
            foreach($dir as $file) {
                require_once($file);
            }

            // Require all "fields-" files in the blocks directories
            $dir = glob(CREATE_ACF_BLOCKS_PATH .'blocks/*/fields-*.php');
            foreach($dir as $file) {
                require_once($file);
            }

            // Require all files in the fields directory
            $dir = glob(CREATE_ACF_BLOCKS_PATH .'fields/*.php');
            foreach($dir as $field) {
                require_once($field);
            }
        }



        /**
         * define
         *
         * Defines a constant if doesn't already exist.
         *
         * @param string $name
         * @param mixed  $value
         * 
         * @return void
         */
        function define( $name, $value = true )
        {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }
    }

    /**
     * create_acf 
     * 
	 * @param void
     * 
	 * @return Create_ACF
     */
    function create_acf()
    {
        global $create_acf;

		// Instantiate only once.
		if ( ! isset( $create_acf ) ) {
			$create_acf = new Create_ACF();
		}
		return $create_acf;
    }
    
    // Instantiate
    create_acf();

} else {
    add_action( 'admin_notices', function() {
        ?>
        <div class="notice notice-error">
            <p><?php _e( 'The plugin Create ACF requires Advanced Custom Fields Pro to be installed and activated.', 'create-acf' ); ?></p>
        </div>
        <?php
    } );
    
} // end if class_exists('ACF')