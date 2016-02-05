<?php
/**
 * Element view file for post input
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>
<table>
	<tr class="subelement-type">
		<th class="label" scope="row">
			<label><?php _e( 'Post type', 'pagebox' ); ?></label>
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['type'])) :
					$this->values['type'] = 'post';
				endif;
			?>
			<select data-setting="type" name="<?php echo $this->getConfig( 'name' ); ?>[type]">
				<?php var_dump($this->values['type']); ?>
				<?php selected('post', $this->values['type']); ?>
				<option value="post" <?php selected('post', $this->values['type']); ?>><?php _e('Post', 'pagebox'); ?></option>
				<option value="page" <?php selected('page', $this->values['type']); ?>><?php _e('Page', 'pagebox'); ?></option>
			</select>
		</td>
	</tr>

	<?php if (is_array($this->pages)) : ?>
	<tr class="subelement-page" data-type="page">
		<th class="label" scope="row">
			<label><?php _e( 'Page name', 'pagebox' ); ?></label>
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['page'])) :
					$this->values['page'] = '';
				endif;
			?>
			<select data-setting="page" name="<?php echo $this->getConfig( 'name' ); ?>[page]">
				<?php foreach ($this->pages as $page): ?>

				<option value="<?php echo $page->ID; ?>" <?php selected($page->ID, $this->values['page']); ?>>
					<?php echo $page->post_title; ?>
				</option>

				<?php endforeach;?>
			</select>
			<p class="description">
				<?php _e( 'Specify page to display', 'pagebox' ); ?>
			</p>
		</td>
	</tr>
	<?php endif; ?>

	<?php if (is_array($this->posts)) : ?>
	<tr class="subelement-post" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Post name', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['post'])) :
					$this->values['post'] = '';
				endif;
			?>
			<select data-setting="post" name="<?php echo $this->getConfig( 'name' ); ?>[post]">
				<option value=""></option>

				<?php foreach ($this->posts as $post): ?>

				<option value="<?php echo $post->ID; ?>" <?php selected($post->ID, $this->values['post']); ?>>
					<?php echo $post->post_title; ?>
				</option>

				<?php endforeach;?>
			</select>
			<p class="description">
				<?php _e( 'Select specific post name to display or use settings below', 'pagebox' ); ?>
			</p>
		</td>
	</tr>
	<?php endif; ?>

	<?php if (is_array($this->categories)) : ?>
	<tr class="subelement-categories" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Categories', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['category'])) :
					$this->values['category'] = '';
				endif;
			?>
			<select data-setting="category" name="<?php echo $this->getConfig( 'name' ); ?>[category]" multiple>
				<option value=""></option>

				<?php foreach ($this->categories as $category): ?>

				<option value="<?php echo $category->term_id; ?>" <?php selected($category->term_id, $this->values['category']); ?>>
						<?php echo $category->name; ?>
				</option>

				<?php endforeach;?>
			</select>
			<p class="description">
				<?php _e( 'Select category name to specify post query', 'pagebox' ); ?>
			</p>
		</td>
	</tr>
	<?php endif; ?>

	<tr class="subelement-tags" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Tags', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['tag'])) :
					$this->values['tag'] = '';
				endif;
			?>
			<select data-setting="tag" name="<?php echo $this->getConfig( 'name' ); ?>[tag]" multiple>
				<option value=""></option>

				<?php foreach ($this->tags as $tag): ?>

				<option value="<?php echo $tag->term_id; ?>" <?php selected($tag->term_id, $this->values['tag']); ?>>
						<?php echo $tag->name; ?>
				</option>

				<?php endforeach;?>
			</select>
			<p class="description">
				<?php _e( 'Enter tags to specify post query. It is possible to enter more than one tag. Tags should be separated with comma sign (,) without additional spaces.', 'pagebox' ); ?>
			</p>
		</td>
	</tr>

	<tr class="subelement-orderby" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Order by', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['orderby'])) :
					$this->values['orderby'] = '';
				endif;
			?>
			<select data-setting="orderby" name="<?php echo $this->getConfig( 'name' ); ?>[orderby]">
				<option value="title" <?php selected('title', $this->values['orderby']); ?>><?php _e('Title', 'pagebox'); ?></option>
				<option value="date" <?php selected('date', $this->values['orderby']); ?>><?php _e('Date', 'pagebox'); ?></option>
				<option value="random" <?php selected('random', $this->values['orderby']); ?>><?php _e('Random', 'pagebox'); ?></option>
			</select>
			<p class="description">
				<?php _e( 'Sort retrieved posts by selected parameter.', 'pagebox' ); ?>
			</p>
		</td>
	</tr>

	<tr class="subelement-order" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Order', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['order'])) :
					$this->values['order'] = '';
				endif;
			?>
			<select data-setting="order" name="<?php echo $this->getConfig( 'name' ); ?>[order]">
				<option value="ASC" <?php selected('ASC', $this->values['order']); ?>>
					<?php _e('Ascending order', 'pagebox'); ?>
				</option>
				<option value="DESC" <?php selected('DESC', $this->values['order']); ?>>
					<?php _e('Descending order', 'pagebox'); ?>
				</option>
			</select>
			<p class="description">
				<?php _e( 'Designate the ascending (1, 2, 3) or descending (3, 2, 1) order.', 'pagebox' ); ?>
			</p>
		</td>
	</tr>

	<tr class="subelement-found" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Posts found', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<div class="found"></div>
		</td>
	</tr>

	<tr class="subelement-offset" data-type="post">
		<th class="label" scope="row">
			<label><?php _e( 'Offset', 'pagebox' ); ?></label> 
		</th>
		<td class="input">
			<?php
				// set default value
				if (!isset($this->values['offset'])) :
					$this->values['offset'] = '';
				endif;
			?>
			<input data-setting="offset" name="<?php echo $this->getConfig( 'name' ); ?>[offset]" <?php if (isset($this->values['offset'])): ?>value="<?php echo $this->values['offset']; ?>"<?php endif; ?>/>
			<p class="description">
				<?php _e( 'Enter number of first posts to ommit', 'pagebox' ); ?>
			</p>
		</td>
	</tr>
</table>