<?php
/**
 * Text view
 */
?>

<div class="container text-module-fg23gh">

<?php $border = $this->get('border_switch');
	if($border !== false) : ?>
		<div class="border clearfix" style="border-bottom: <?php echo $this->get('border_style') ;?>">
	<?php else: ;?>
		<div class="border clearfix" style="border: none">
	<?php endif ;?>

		<div class="col-md-10">

			<?php echo $this->get( 'text' ) ;?>

			<?php if($this->get('btn_switch') !== false): ?>
				<a href="<?php echo $this->get( 'button' );?>" class="col-xs-12 col-md-3 learn-more-btn"><?php echo $this->get('button_text') ;?><span> > </span></a>
			<?php else: ;?>
				<!-- btn off -->
			<?php endif ;?>

		</div>
	</div>
</div>