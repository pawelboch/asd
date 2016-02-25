<?php
/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 15/02/16
 * Time: 16:00
 * Template Name: Search Page
 */

get_header(); ?>


<section id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header><!-- .page-header -->

            <?php while ( have_posts() ) : the_post(); ?>

                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

            <?php endwhile; ?>

        <?php else : ?>

<!--            --><?php //get_template_part( 'no-results', 'search' ); ?>

        <?php endif; ?>

    </div><!-- #content .site-content -->
</section><!-- #primary .content-area -->


<?php get_footer();