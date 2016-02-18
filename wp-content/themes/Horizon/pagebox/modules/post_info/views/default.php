<?php
/**
 * Post_info view
 */
?>

<?php global $post; ?>

<div class="author">
    <?php

    $author = get_user_meta( $post->post_author );

    echo $author["first_name"][0] . ' ' . $author["last_name"][0];

    ?>
</div>

<div class="description">
    <?php echo $author["description"][0] ;?>
</div>

<div class="published">
    <div>
        Published on:
    </div>

    <div>
        <?php echo get_the_time('Y-d-a',$post->ID) ;?>
    </div>
</div>
