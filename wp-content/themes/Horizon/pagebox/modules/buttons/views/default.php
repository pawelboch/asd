<?php
/**
 * Text view
 */
?>

<div class="col-md-12">
	<div class="row">
		<div class="triple-btn">
			<div class="single-btn col-md-4 btn-left">
				<?php if ($this->get('switch1') !== false): ?>
					<?php if (empty($this->get('mediaURL1'))): ?>
						<?php $postek = get_post_by_slug( $this->get('select1') ); ?>
							<a href="<?php echo get_permalink( $postek );?>" class="btn-2"><?php echo $this->get('external1') ;?></a>
						<?php else: ?>
							<a href="<?php echo wp_get_attachment_url($this->get('mediaURL1')) ;?>" class="btn-2"><?php echo $this->get('external1') ;?><?php echo $this->get('name1') ;?></a>
						<?php endif ?>
					<?php else: ?>
						<!--Button Switched to display none-->
				<?php endif ?>
			</div>
			<div class="single-btn col-md-4 btn-middle">
				<?php if ($this->get('switch2') !== false): ?>
					<?php if (empty($this->get('mediaURL2'))):
							$spaces = str_replace(' ', '%20', $this->get('ks-team')); ?>
							<a href="<?php echo esc_url( home_url( '/' ) . $this->get('select2') . '?team=' . $spaces ); ?>" class="btn-2"><?php echo $this->get('external2') ;?></a>
						<?php else: ?>
							<a href="<?php echo wp_get_attachment_url($this->get('mediaURL2')) ;?>" class="btn-2"><?php echo $this->get('external2') ;?><?php echo $this->get('name2') ;?></a>
						<?php endif ?>
					<?php else: ?>
						<!--Button Switched to display none-->
				<?php endif ?>
			</div>
			<div class="single-btn col-md-4 btn-right">
				<?php if ($this->get('switch3') !== false): ?>
					<?php if (empty($this->get('mediaURL3'))): ?>
						<?php $postek = get_post_by_slug( $this->get('select3') ); ?>
							<a href="<?php echo get_permalink( $postek ); echo ($postek->post_title == 'Investment Teams') ? '?p='.str_replace(' ', '', get_the_title(get_post()->post_parent)) : ''; ?>" class="btn-2"><?php echo $this->get('external3') ;?> <?php echo $postek->post_title; ?></a>
						<?php else: ?>
							<a href="<?php echo wp_get_attachment_url($this->get('mediaURL3')) ;?>" class="btn-2"><?php echo $this->get('external3') ;?><?php echo $this->get('name3') ;?></a>
						<?php endif ?>
					<?php else: ?>
						<!--Button Switched to display none-->
				<?php endif ?>
			</div>
		</div>
	</div>
</div>