<?php
/**
 * title_text view
 */
?>

<div class="container <?php echo $this->get('css_class'); ?>">
    <div class="col-md-12">
        <?php if($this->get('title') != ''): ?>
        <h2 class="title">
            <?php echo $this->get('title') ;?>
        </h2>
        <?php endif ;?>

        <div class="description">
            <?php echo $this->get('description') ;?>
        </div>
    </div>
</div>