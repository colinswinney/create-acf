<?php
/**
 * Define your ACF variables
 */
$items = get_field('items') ?: $example;

/**
 * Block markup
 */
?>

<div class="<?php echo $b_classList; ?>" id="<?php echo $b_id; ?>" <?php echo $b_style_string; ?>>
	<?php
		if ($items) :
			echo '<ol>';
				foreach ($items as $item) {
					echo '<li>' . $item['item'] . '</li>';
				}
			echo '</ol>';
		endif;
	?>
	
	<InnerBlocks
		<?php
			echo 'allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '"';
			echo 'template="' . esc_attr( wp_json_encode( $template ) ) . '"';
		?>
	/>
	<?php echo '<pre>' . json_encode($block, JSON_PRETTY_PRINT, '100') . '</pre>'; ?>
</div>