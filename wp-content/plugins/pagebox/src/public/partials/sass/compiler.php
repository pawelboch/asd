<div class="wrap pagebox-sass-compiler">

	<h2>Pagebox Sass Compiler</h2>
	<p>
		<?php if( $permission_test ): ?>
		<a href="<?php echo admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile' ); ?>" onclick="return confirm('Are You sure?');" class="button button-primary">Recompile & minify</a>
		<a href="<?php echo admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile_theme' ); ?>" onclick="return confirm('Are You sure?');" class="button button-secondary">Recompile theme (with bootstrap)</a>
		<a href="<?php echo admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile_modules' ); ?>" onclick="return confirm('Are You sure?');" class="button">Recompile pagebox modules</a>
		<a href="<?php echo admin_url( 'admin.php?page=pagebox-sass-compiler&task=minify' ); ?>" onclick="return confirm('Are You sure?');" class="button">Concatenate and minify</a>
		<?php else: ?>
		<div class="error"><p><strong>ERROR</strong>: File permissions denied! See console below for details.</p></div>
		<?php endif; ?>
	</p>

	<h3>Compiler console</h3>
	<div id="console"><?php echo $this->console; ?></div>

</div>