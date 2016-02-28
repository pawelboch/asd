<?php
/**
 * Text view
 */
?>

<div class="container <?php echo $this->get('css_class'); ?>">
	<div class="border clearfix">

		<div class="border-container col-md-12">

			<?php echo $this->get( 'text' ) ;?>

			<?php if($this->get('btn_switch') !== false): ?>
				<a href="<?php echo $this->get( 'button' );?>" class="col-xs-12 col-md-3 learn-more-btn"><?php echo $this->get('button_text') ;?><span></span></a>
			<?php else: ;?>
				<!-- btn off -->
			<?php endif ;?>

		</div>
	</div>
</div>