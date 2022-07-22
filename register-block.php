<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Register ACF Block
 *
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
 */

if (function_exists('acf_register_block_type')) {

    class Register_Block {

        /**
         * __construct
         *
         * @param void
         * @return void
         */
        public function __construct()
        {
            $this->register_block();
            $this->create_fields();
        }

        /**
         * The block slug.
         *
         * @var string
         */
        public $slug = '';

        /**
         * The block name.
         *
         * @var string
         */
        public $name = '';

        /**
         * The block description.
         *
         * @var string
         */
        public $description = '';

        /**
         * The block category.
         *
         * @var string
         */
        public $category = '';

        /**
         * The block icon.
         *
         * @var string
         */
        public $icon = '';

        /**
         * The default block mode.
         *
         * @var string
         */
        public $mode = 'preview';

        /**
         * The block keywords.
         *
         * @var array
         */
        public $keywords = [];

        /**
         * The parent block type allow list.
         *
         * @var array
         */
        public $parent = [];

        /**
         * The default block alignment.
         *
         * @var string
         */
        public $align = '';

        /**
         * The post type allow list.
         *
         * @var array
         */
        public $post_types = [];

        /**
         * The supported block features.
         *
         * @var array
         */
        public $supports = [];

        /**
         * The block preview example data.
         *
         * @var array
         */
        public $example = [];

        /**
         * The block styles.
         *
         * @var array
         */
        public $styles = [];


        /**
         * Assets enqueued when rendering the block.
         *
         * @return void
         */
        public function enqueue()
        {
            //
        }


        /**
         * register_block
         *
         * @param void
         *
         * @return void
         */
        public function register_block()
        {
            acf_register_block_type([
                'name'            => $this->slug,
                'title'           => $this->name,
                'description'     => $this->description,
                'category'        => $this->category,
                'icon'            => $this->icon,
                'mode'            => $this->mode,
                'keywords'        => $this->keywords,
                'parent'          => $this->parent ?: null,
                'align'           => $this->align,
                'post_types'      => $this->post_types,
                'supports'        => $this->supports,
                'styles'          => $this->styles,
                'example'         => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => $this->example,
                    ]
                ],
                'render_callback' => function($block) {
                    $this->render_callback($block);
                },

            ]);
        }


        /**
         * Render callback
         *
         * @param array $block
         *
         * @return void
         */
        public function render_callback($block)
        {
            /**
             * Only enqueue assets if the block is being rendered.
             */
            $this->enqueue();

            /**
             * Create variables from data to send to block
             */
            $data = $this->send_to_block();
            foreach ($data as $key => $value) {
                $$key = $value;
            }

            /**
             * Define block data
             */
            $b_id = isset($block['anchor']) ? $block['anchor'] : null;
            $b_class = isset($block['supports']['className']) ? $block['supports']['className'] : null;
            $b_fontSize = isset($block['fontSize']) ? $block['fontSize'] : null;
            $b_backgroundColor = isset($block['backgroundColor']) ? $block['backgroundColor'] : null;
            $b_textColor = isset($block['textColor']) ? $block['textColor'] : null;
            $b_style_class = isset($block['className']) ? $block['className'] : null;
            $b_align_class = isset($block['align']) ? $block['align'] : null;
            $b_align_text_class = isset($block['align_text']) ? $block['align_text'] : null;
            $b_align_content_class = isset($block['align_content']) ? $block['align_content'] : null;

            /**
             * Create id attribute if anchor link exists
             */
            $b_id = isset($b_id) ? 'id="' . $b_id . '"' : '';

            /**
             * Create class attribute
             */
            $b_classes = $b_class ? 'class="' . $b_class : '';
            $b_fontSize ? $b_classes .= ' has-' . $b_fontSize . '-font-size' : '';
            $b_backgroundColor ? $b_classes .= ' has-' . $b_backgroundColor . '-background-color has-background' : '';
            $b_textColor ? $b_classes .= ' has-' . $b_textColor . '-color has-text-color' : '';
            $b_style_class ? $b_classes .= ' ' . $b_style_class : '';
            $b_align_class ? $b_classes .= ' align' . $b_align_class : '';
            $b_align_text_class ? $b_classes .= ' has-text-align-' . $b_align_text_class : '';
            $b_align_content_class ? $b_classes .= ' is-vertically-aligned-' . $b_align_content_class : '';
            $b_classes .= $b_class ? '"' : '';

            /**
             * Create style attribute
             */
            // open the string
            $b_styles = isset($block['style']) || isset($block['full_height']) ? 'style="' : '';

            // font size
            $b_styles .= isset($block['style']['typography']['fontSize']) ? 'font-size: ' . $block['style']['typography']['fontSize'] . ' !important;' : '';

            // line height
            $b_styles .= isset($block['style']['typography']['lineHeight']) ? 'line-height: ' . $block['style']['typography']['lineHeight'] . ' !important;' : '';

            // padding-top
            $b_styles .= isset($block['style']['spacing']['padding']['top']) ? 'padding-top: ' . $block['style']['spacing']['padding']['top'] . ' !important;' : '';

            // padding-right
            $b_styles .= isset($block['style']['spacing']['padding']['right']) ? 'padding-right: ' . $block['style']['spacing']['padding']['right'] . ' !important;' : '';

            // padding-bottom
            $b_styles .= isset($block['style']['spacing']['padding']['bottom']) ? 'padding-bottom: ' . $block['style']['spacing']['padding']['bottom'] . ' !important;' : '';

            // padding-left
            $b_styles .= isset($block['style']['spacing']['padding']['left']) ? 'padding-left: ' . $block['style']['spacing']['padding']['left'] . ' !important;' : '';

            // margin-top
            $b_styles .= isset($block['style']['spacing']['margin']['top']) ? 'margin-top: ' . $block['style']['spacing']['margin']['top'] . ' !important;' : '';

            // margin-right
            $b_styles .= isset($block['style']['spacing']['margin']['right']) ? 'margin-right: ' . $block['style']['spacing']['margin']['right'] . ' !important;' : '';

            // margin-bottom
            $b_styles .= isset($block['style']['spacing']['margin']['bottom']) ? 'margin-bottom: ' . $block['style']['spacing']['margin']['bottom'] . ' !important;' : '';

            // margin-left
            $b_styles .= isset($block['style']['spacing']['margin']['left']) ? 'margin-left: ' . $block['style']['spacing']['margin']['left'] . ' !important;' : '';

            // full height
            $b_styles .= isset($block['full_height']) ? 'min-height: 100vh' : '';

            // block-gap
            $b_styles .= isset($block['style']['spacing']['blockGap']) ? '--wp--style--block-gap: ' . $block['style']['spacing']['blockGap'] . ' !important;' : '';

            // close the string
            $b_styles .= isset($block['style']) || isset($block['full_height']) ? '"' : '';

            if (file_exists(CREATE_ACF_BLOCKS_PATH . "blocks/". $this->slug . "/". $this->slug . ".php")) {
                include(CREATE_ACF_BLOCKS_PATH . "blocks/". $this->slug . "/". $this->slug . ".php");
            }
        }
    }
}