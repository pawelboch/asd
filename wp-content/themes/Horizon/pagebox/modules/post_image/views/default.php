<?php
/**
 * Post_image view
 */
?>

<?php global $post; ?>

<div class="<?php echo $this->get('css_class'); ?>">

    <div class="content container">
        <div class="row">
            <img src="<?php echo wp_get_attachment_url($this->get('image')); ?>" alt="<?php echo $this->get('alt') ;?>" style="width: <?php echo $this->get('width') ;?>; height: <?php echo $this->get('height') ;?> ;">
        </div>
    </div>

</div>

