<?php
/**
 * Tables view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>">
		<div class="tabs">
			<div class="row">
				<div class="head">
					<div id="first" class="title col-md-3 col-sm-3 col-xs-12 active">
						<h2><?php echo $this->get( 'first_tab_title' ) ;?></h2>
					</div>
					<div id="second" class="title col-md-3 col-sm-3 col-xs-12">
						<h2><?php echo $this->get( 'second_tab_title' ) ;?></h2>
					</div>
					<div id="third" class="title col-md-3 col-sm-3 col-xs-12">
						<h2><?php echo $this->get( 'third_tab_title' ) ;?></h2>
					</div>
					<div id="fourth" class="title col-md-3 col-sm-3 col-xs-12">
						<h2><?php echo $this->get( 'fourth_tab_title' ) ;?></h2>
					</div>
				</div>
				<div class="content first active">
					<?php echo $this->get( 'first_tab_content' ) ;?>
				</div>
				<div class="content second">
					<?php echo $this->get( 'second_tab_content' ) ;?>
				</div>
				<div class="content third">
					<?php echo $this->get( 'third_tab_content' ) ;?>
				</div>
				<div class="content fourth">
					<?php echo $this->get( 'fourth_tab_content' ) ;?>
				</div>
			</div>
		</div>
	</div>

