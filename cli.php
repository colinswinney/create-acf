<?php

if (defined('WP_CLI') && WP_CLI) {

    class CREATE_ACF_CLASS {

        /**
         * Dummy Placeholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_uppercase($str)
        {
            return substr(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $str), 1);
        }



        /**
         * dummy placeholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_lowercase($str)
        {
            $str = preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $str);
            return substr(strtolower($str), 1);
        }



        /** 
         * dummy-placeholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_slug($str)
        {
            $str[0] = strtolower($str[0]);
            $func = function($c){
                return '-'.strtolower($c[1]);
            };
            return preg_replace_callback('/([A-Z])/', $func, $str);
        }



        /** 
         * dummy_placeholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_snake($str)
        {
            $str[0] = strtolower($str[0]);
            $func = function($c){
                return '_'.strtolower($c[1]);
            };
            return preg_replace_callback('/([A-Z])/', $func, $str);
        }



        /** 
         * Dummy_Placeholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_snake_uppercase($str)
        {
            $func = function($c){
                return "_" . $c[1];;
            };
            $str = preg_replace_callback('/([A-Z])/', $func, $str);
            return ltrim($str, $str[0]);
        }



        /** 
         * dummyPlaceholder <- DummyPlaceholder
         * 
         * @param string $str
         * 
         * @return string
         */
        private function camel_case_to_lcfirst($str)
        {
            return lcfirst($str);
        }



        /**
         * Copy and replace text in the newly created destination files
         * 
         * @param string $src
         * @param string $dest
         * @param array $src_strings 
         * @param array $dest_strings 
         * @param string $file_get_contents
         * @param string $action
         * 
         * @return void
         */
        private function copy_replace_file_contents($src, $dest, $src_strings, $dest_strings, $file_get_contents, $action)
        {
            if( !copy($src, $dest) ) { 
                WP_CLI::error( $action , $exit = true );
            } 
            else { 
                $file_contents = file_get_contents($file_get_contents);
                $file_contents = str_replace($src_strings, $dest_strings, $file_contents);
                file_put_contents($file_get_contents, $file_contents);

                echo WP_CLI::colorize( "%B" . $action . " went well" ), PHP_EOL;
            }
        }



        /**
         * Create a new field  ( wp create-acf field ExampleField )
         * 
         * @param array $args
         * 
         * @return void
         */
        public function field($args)
        {

            // User input
            $file_name = $args[0];

            // Take file name arg and convert the string to necessary variables
            $file_name_slug = $this->camel_case_to_slug($file_name);
            $file_name_snake = $this->camel_case_to_snake($file_name);
            $file_name_camel_lower = $this->camel_case_to_lcfirst($file_name);
            
            // Copy dummy-field.stub to example-field.php and replace the variables
            $src_fields = CREATE_ACF_BLOCKS_PATH . 'stubs/dummy-field.stub';
            $dest_fields = CREATE_ACF_BLOCKS_PATH . 'fields/' . $file_name_slug . '.php';
            $src_strings = ['dummy-field', 'dummy_field', 'dummyField'];
            $dest_strings = [$file_name_slug, $file_name_snake, $file_name_camel_lower];
            $file_get_contents = $dest_fields;
            $action = 'Create field';

            $this->copy_replace_file_contents($src_fields, $dest_fields, $src_strings, $dest_strings, $file_get_contents, $action);
        }


        
         /**
         * Create a new block ( wp create-acf block ExampleBlock )
         * 
         * @param array $args
         * 
         * @return void
         */
        public function block($args)
        {
            // User input
            $file_name = $args[0];



            // Take file name, convert to various strings, and store them in variables
            $file_name_uppercase = $this->camel_case_to_uppercase($file_name);
            $file_name_lowercase = $this->camel_case_to_lowercase($file_name);
            $file_name_slug = $this->camel_case_to_slug($file_name);
            $file_name_snake = $this->camel_case_to_snake($file_name);
            $file_name_snake_upper = $this->camel_case_to_snake_uppercase($file_name);
            $file_name_camel_lower = $this->camel_case_to_lcfirst($file_name);



            // Create the block folder
            is_dir(CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '') || mkdir(CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '');

            // Create the block asset folder
            is_dir(CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/assets') || mkdir(CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/assets');



            // Copy register-dummy-placeholder.stub to register-*.php
            $src_register = CREATE_ACF_BLOCKS_PATH . 'stubs/register-dummy-placeholder.stub';
            $dest_register = CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/register-' . $file_name_slug . '.php';
            $dummy_strings = ['DummyPlaceholder','Dummy Placeholder', 'dummy placeholder', 'dummy-placeholder', 'dummy_placeholder', 'Dummy_Placeholder'];
            $file_name_strings = [$file_name, $file_name_uppercase, $file_name_lowercase, $file_name_slug, $file_name_snake,  $file_name_snake_upper];
            $file_get_contents = $dest_register;
            $action = 'Clone register file';

            $this->copy_replace_file_contents($src_register, $dest_register, $dummy_strings, $file_name_strings, $file_get_contents, $action);



            // Copy dummy-placeholder.stub to *.php
            $src_block = CREATE_ACF_BLOCKS_PATH . 'stubs/dummy-placeholder.stub';
            $dest_block = CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/' . $file_name_slug . '.php';
            $dummy_strings = [];
            $file_name_strings = [];
            $file_get_contents = $dest_block;
            $action = 'Clone block file';

            $this->copy_replace_file_contents($src_block, $dest_block, $dummy_strings, $file_name_strings, $file_get_contents, $action);



            // copy js file
            $src_js = CREATE_ACF_BLOCKS_PATH . 'stubs/dummy-placeholder-js.stub';
            $dest_js = CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/assets/' . $file_name_slug . '.js';
            $dummy_strings_js = ['dummy-placeholder'];
            $file_name_strings_js = [$file_name_slug];
            $file_get_contents_js = $dest_js;
            $action_js = 'Clone JS file';

            $this->copy_replace_file_contents($src_js, $dest_js, $dummy_strings_js, $file_name_strings_js, $file_get_contents_js, $action_js);



            // copy css file
            $src_css = CREATE_ACF_BLOCKS_PATH . 'stubs/dummy-placeholder-css.stub';
            $dest_css = CREATE_ACF_BLOCKS_PATH . 'blocks/' . $file_name_slug . '/assets/' . $file_name_slug . '.css';
            $dummy_strings_css = ['dummy-placeholder'];
            $file_name_strings_css = [$file_name_slug];
            $file_get_contents_css = $dest_css;
            $action_css = 'Clone CSS file';

            $this->copy_replace_file_contents($src_css, $dest_css, $dummy_strings_css, $file_name_strings_css, $file_get_contents_css, $action_css);

            WP_CLI::success('All done!');
        }
  }

  WP_CLI::add_command('create-acf', 'CREATE_ACF_CLASS');

}