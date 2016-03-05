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

    <div class="share col-md-12">
        <span class="social col-md-6">
            <i class="fa fa-angle-right"></i>Social
        </span>
        <span class="print col-md-6">
            Print
        </span>
        <span class="social-toggle">
                <img src="<?php echo get_template_directory_uri ()?>/assets/images/facebookico.svg" alt="">
                <img src="<?php echo get_template_directory_uri ()?>/assets/images/twitterico.svg" alt="">
                <img src="<?php echo get_template_directory_uri ()?>/assets/images/googleico.svg" alt="">
                <img src="<?php echo get_template_directory_uri ()?>/assets/images/youtubeico.svg" alt="">
        </span>
    </div>
</div>

