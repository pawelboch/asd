<?php
/**
 * Header for generator pages
 *
 * Displays page title, menu for generators and filter
 *
 * @author Kuba Mikita
 * @since 1.0.0
 *
 * @package pagebox
 */
?>

<div class="wrap">

	<h2><?php _e( 'Pagebox Generator', 'pagebox' ); ?></h2>

	<div class="wp-filter">

		<ul class="filter-links">
			<li><a href="<?php echo admin_url( 'admin.php?page=pagebox-generator&tab=templates' ); ?>" class="<?php if ( $this->get( 'current_tab' ) == 'templates' ) echo 'current'; ?>">Templates</a></li>
			<li><a href="<?php echo admin_url( 'admin.php?page=pagebox-generator&tab=modules' ); ?>" class="<?php if ( $this->get( 'current_tab' ) == 'modules' ) echo 'current'; ?>">Modules</a></li>
		</ul>

	</div>