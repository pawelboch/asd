<?php
/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 23/02/16
 * Time: 09:40
 */

get_header() ;?>


<div class="container-fluid head">
    <div class="transparency">
        <h2>ERROR 404</h2>
    </div>
</div>

<div class="container content">
    <h2 class="col-md-12">Page not found</h2>
    <p class="col-md-7">The page you are looking for doesn’t exist or another error occured.
        Go <a href="javascript:history.go(-1)">back</a> or head over to our <a href="<?php echo home_url() ;?>">homepage</a> to choose another page.</p>
</div>

<div class="container contact-us">
    <div class="col-md-6 left-part">
        <h2 class="title">
            Get in touch
        </h2>

        <p class="description">

        </p>

    </div>
    <div class="col-md-6 contact-form">
        <?php echo do_shortcode('[contact-form-7 id="90" title="Contact form"]') ;?>
    </div>
</div>




<?php get_footer(); ?>