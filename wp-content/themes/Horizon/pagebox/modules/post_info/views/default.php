<?php
/**
 * Post_info view
 */
?>

<?php global $post; ?>

<div class="<?php echo $this->get('css_class'); ?>">
    <div class="author">
        <div class="name">
            <?php

            $author = get_user_meta( $post->post_author );

            echo $author["first_name"][0] . ' ' . $author["last_name"][0];

            ?>
        </div>

        <div class="description">
            <?php echo $author["description"][0] ;?>
        </div>
    </div>



    <div class="published">
        <div class="text">
            Published on:
        </div>

        <div class="date">
            <?php echo get_the_time('j.m.Y',$post->ID) ;?>
        </div>
    </div>

    <div class="share">
        <span class="social">
            Social
        </span>
        <span class="print">
            Print
        </span>
    </div>
</div>

