<?php
/**
 * Full width template file
 *
 * @author Pagebox Generator
 */
?>

<div class="row">
	<div class="col-md-12">
			<?php foreach ($this->get_variable( 'full-width_modules' ) as $module): ?>
				<?php $module->display(); ?>
			<?php endforeach ?>
	</div>
</div>