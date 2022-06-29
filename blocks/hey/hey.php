<div <?php echo $b_classes; ?> <?php echo $b_id; ?> <?php echo $b_styles; ?>>
	<?php
		if ($items) :
			echo '<ol>';
				foreach ($items as $item) {
					echo '<li>' . $item['item'] . '</li>';
				}
			echo '</ol>';
		endif;
	?>
	
	<div class="innerblocks">
		<InnerBlocks />
	</div>
</div>