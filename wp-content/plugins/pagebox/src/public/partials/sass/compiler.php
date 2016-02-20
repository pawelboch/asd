<style>
	#console {
		width: 100%;
		max-height: 405px;
		background-color: #23282d;
		color: #ddd;
		font-size:12px;
		font-family:monospace;
		padding: 6px 10px;
		box-sizing: border-box;
		overflow: auto;
	}
	#console span.success span { color: limegreen; }
	#console span.error span { color: red; }
	#console span.warning span { color: orange; }
	#console span b { color: #fff; }
</style>
<div class="wrap">

	<h2>Pagebox Sass Compiler</h2>
	<p>
		<?php if( $permission_test ): ?>
		<a href="#" class="button button-primary">Recompile & minify</a>
		<a href="#" class="button button-secondary">Recompile theme (with bootstrap)</a>
		<a href="#" class="button">Recompile pagebox modules</a>
		<a href="#" class="button">Concatenate and minify</a>
		<?php else: ?>
		<div class="error"><p><strong>ERROR</strong>: File permissions denied! See console below for details.</p></div>
		<?php endif; ?>
	</p>

	<h3>Compiler console</h3>
	<div id="console"><?php echo $this->console; ?></div>

</div>