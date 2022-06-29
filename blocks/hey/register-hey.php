<?php

/**
 * Register Hey Block
 * 
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
 */
class Hey extends Register_Block {
    /**
     * The block slug.
     *
     * @var string
     */
    public $slug = 'hey';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hey';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Hey block';

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
    public $icon = 'smiley';

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
    public $supports = [
        'className'     => 'wp-block-hey',
        'anchor'        => false,
        'align'         => false,
        'align_text'    => false,
        'align_content' => false,
        'color'         =>  [
            'background'    => false,
            'gradients'     => false,
            'text'          => false,
        ],
        'full_height'   => false,
        'jsx'           => false,
        'mode'          => true,
        'multiple'      => true,
        'spacing'       =>  [
            'margin'        => false,
            'padding'       => false,
            'blockGap'      => false,
        ],
        'typography'    => [
            'fontSize'      => false,
            'lineHeight'    => false,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        [
            'name' => 'light',
            'label' => 'Light',
            'isDefault' => true,
        ],
        [
            'name' => 'dark',
            'label' => 'Dark',
        ]
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'items' => [
            ['item' => 'Item one'],
            ['item' => 'Item two'],
            ['item' => 'Item three'],
        ],
    ];

    /**
     * Enqueue the block styles.
     *
     * @return string
     */
    public function enqueue_style()
    {
        return CREATE_ACF_BLOCKS_URL . 'blocks/hey/assets/hey.css';
    }

    /**
     * Enqueue the block script.
     *
     * @return string
     */
    public function enqueue_script()
    {
        return CREATE_ACF_BLOCKS_URL . 'blocks/hey/assets/hey.js';
    }

    /**
     * Build fields
     * 
     * @return bool
     */
    public function create_fields()
    {
        $hey_fields = new StoutLogic\AcfBuilder\FieldsBuilder('hey');

        $hey_fields->setLocation('block', '==', 'acf/hey');

        $hey_fields
            ->addRepeater('items')
                ->addText('item')
            ->endRepeater();

        return acf_add_local_field_group($hey_fields->build());
    }

    /**
     * Functions to be passed to the block
     */
    public function send_to_block() {
        return [
            'items' => $this->items()
        ];
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
    }
}

/**
 * Instantiate the hey block 
 * 
 * @param   void
 * 
 * @return  Hey
 */
function hey() {
    $hey = new Hey();
    return $hey;
}
hey();