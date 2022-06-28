<?php
/**
 * Register ACF Block
 * 
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
 */
if (function_exists('acf_register_block_type')) {

    acf_register_block([
        'name'            => 'testinngs',
        'title'           => __('Testinngs', 'create-acf'),
        'description'     => __('A simple testinngs block', 'create-acf'),
        'category'        => 'formatting',
        'icon'            => 'smiley',
        'mode'            => 'preview',
        'keywords'        => ['button', 'text', 'acf'],
        'align'           => '',
        'post_types'      => [],
        'usesContext'     => [],
        'supports'        => 
            [
                'className'     => 'wp-block-testinngs',
                'anchor'        => false,
                'align'         => true,
                'align_text'    => false,
                'align_content' => false,
                'color'         => 
                    [
                        'background'    => true,
                        'gradients'     => true,
                        'text'          => true,
                    ],
                'full_height'   => false,
                'jsx'           => true,
                'mode'          => true,
                'multiple'      => true,
                'spacing'       => 
                    [
                        'margin'        => true,
                        'padding'       => true,
                        'blockGap'      => true,
                    ],
                'typography'    => 
                    [
                        'fontSize'      => true,
                        'lineHeight'    => true,
                    ],
            ],
        'enqueue_style'   => CREATE_ACF_BLOCKS_URL . 'blocks/testinngs/testinngs.css',
        'enqueue_script'  => CREATE_ACF_BLOCKS_URL . 'blocks/testinngs/testinngs.js',
        'enqueue_assets'  => false,
        'render_template' => false,
        'render_callback' => 'testinngs_render_callback',
        'example'         => 
            [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => 
                        [
                            'items' => [
                                ['item' => 'Item one'],
                                ['item' => 'Item two'],
                                ['item' => 'Item three'],
                            ],
                        ]
                    ],
            ],
    ]);

    /**
     * Render callback
     */
    function testinngs_render_callback($block) {
        /**
         * Define block data
         */
        $b_id = $block['id'];
        $b_classList = $block['supports']['className'];
        $b_backgroundColor = $block['backgroundColor'];
        $b_textColor = $block['textColor'];

        /**
         * Add any color related classnames to b_classList
         */
        $b_textColor ? $b_classList .= ' has-' . $b_textColor . '-color has-text-color' : '';
        $b_backgroundColor ? $b_classList .= ' has-' . $b_backgroundColor . '-background-color has-background' : '';

        /**
         * Create style attribute
         */
        $b_style = $block['style'];
        $b_style_string = $block['style'] ? 'style="' : '';

        // font size
        $b_style_string .= $block['style']['typography']['fontSize'] ? 'font-size: ' . $block['style']['typography']['fontSize'] . ' !important;' : '';
        // line height
        $b_style_string .= $block['style']['typography']['lineHeight'] ? 'line-height: ' . $block['style']['typography']['lineHeight'] . ' !important;' : '';
        // padding-top
        $b_style_string .= $block['style']['spacing']['padding']['top'] ? 'padding-top: ' . $block['style']['spacing']['padding']['top'] . ' !important;' : '';
        // padding-right
        $b_style_string .= $block['style']['spacing']['padding']['right'] ? 'padding-right: ' . $block['style']['spacing']['padding']['right'] . ' !important;' : '';
        // padding-bottom
        $b_style_string .= $block['style']['spacing']['padding']['bottom'] ? 'padding-bottom: ' . $block['style']['spacing']['padding']['bottom'] . ' !important;' : '';
        // padding-left
        $b_style_string .= $block['style']['spacing']['padding']['left'] ? 'padding-left: ' . $block['style']['spacing']['padding']['left'] . ' !important;' : '';
        // margin-top
        $b_style_string .= $block['style']['spacing']['margin']['top'] ? 'margin-top: ' . $block['style']['spacing']['margin']['top'] . ' !important;' : '';
        // margin-right
        $b_style_string .= $block['style']['spacing']['margin']['right'] ? 'margin-right: ' . $block['style']['spacing']['margin']['right'] . ' !important;' : '';
        // margin-bottom
        $b_style_string .= $block['style']['spacing']['margin']['bottom'] ? 'margin-bottom: ' . $block['style']['spacing']['margin']['bottom'] . ' !important;' : '';
        // margin-left
        $b_style_string .= $block['style']['spacing']['margin']['left'] ? 'margin-left: ' . $block['style']['spacing']['margin']['left'] . ' !important;' : '';
        // block-gap
        $b_style_string .= $block['style']['spacing']['blockGap'] ? '--wp--style--block-gap: ' . $block['style']['spacing']['blockGap'] . ' !important;' : '';
        // close the string
        $b_style_string .= $block['style'] ? '"' : '';

        /**
         * Store example data
         */
        $example = $block['example']['attributes']['data']['items'];

        /**
         * Allowed InnerBlocks
         */
        $allowed_blocks = [
            [ 'core/paragraph' ]
        ];

        /**
         * InnerBlocks Template
         */
        $template = [
            [ 'core/paragraph', ['placeholder' => 'An inner paragraph'] ]
        ];

        if (file_exists(CREATE_ACF_BLOCKS_PATH . "blocks/testinngs/testinngs.php")) {
            include(CREATE_ACF_BLOCKS_PATH . "blocks/testinngs/testinngs.php");
        }
    }
}