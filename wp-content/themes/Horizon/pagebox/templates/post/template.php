<?php
/**
 * post template file
 *
 * @author Pagebox Generator
 */
?>

<div class="post container">

		<div class="top container-fluid">
			<?php foreach ($this->get_variable( 'post-100-up_modules' ) as $module): ?>
				<?php $module->display(); ?>
			<?php endforeach ?>
		</div>


		<div class="left col-md-2">
			<?php foreach ($this->get_variable( 'post-30_modules' ) as $module): ?>
				<?php $module->display(); ?>
			<?php endforeach ?>
		</div>





		<div class="right col-md-10">
			<?php foreach ($this->get_variable( 'post-70_modules' ) as $module): ?>
				<?php $module->display(); ?>
			<?php endforeach ?>
		</div>



		<div class="bottom">
			<div class="row">
				<?php foreach ($this->get_variable( 'post-100-down_modules' ) as $module): ?>
					<?php $module->display(); ?>
				<?php endforeach ?>
			</div>
		</div>


</div>