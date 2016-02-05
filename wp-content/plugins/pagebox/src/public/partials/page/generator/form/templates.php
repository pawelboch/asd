<?php
/**
 * Template generator form
 *
 * Used to generate the form for templates generator
 *
 * @author Kuba Mikita
 * @since 1.0.0
 *
 * @package pagebox
 */
?>

<div class="postbox">
	<div class="pagebox-form">
		<form action="" class="generator pagebox_form" method="post">

			<?php wp_nonce_field( 'pagebox-generate-template', 'nonce' ); ?>

			<table class="form-table">

				<?php echo $this->get( 'fields' )->render(); ?>

				<tr>
					<td colspan="2" class="buttonset">
						<?php submit_button( __( 'Generate', 'pagebox' ), 'primary', 'generate-template-request', false ) ?>
					</td>
				</tr>

			</table>

		</form>
	</div>
</div>