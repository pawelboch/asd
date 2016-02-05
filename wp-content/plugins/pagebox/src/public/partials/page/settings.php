<div class="wrap">

	<h2><?php _e( 'Pagebox Settings', 'pagebox' ); ?></h2>

	<form action="options.php" method="post" enctype="multipart/form-data">
		<?php settings_fields( 'pagebox_settings' ); ?>
		<?php do_settings_sections( 'pagebox' ); ?>
		<?php submit_button( __( 'Save', 'pagebox' ), 'primary', 'save' ); ?>
	</form>

</div>