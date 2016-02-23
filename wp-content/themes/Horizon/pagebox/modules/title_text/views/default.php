<?php
/**
 * title_text view
 */
?>

<div class="container <?php echo $this->get('css_class'); ?>">
    <div class="col-md-12">
        <h2 class="title">
            <?php echo $this->get('title') ;?>
        </h2>

        <div class="description">
            <?php echo $this->get('description') ;?>
        </div>
    </div>
</div>