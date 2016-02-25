<?php
/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 15/02/16
 * Time: 16:00
 * Template Name: Search Page
 */

get_header(); ?>



    <div class="search-content" role="main">
        <div class="container-fluid">
            <div class="container">
                <h1><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php endwhile; ?>
                <?php else : ?>

                    <div class="no-resoult">
                        nothing to show.
                    </div>

                <?php endif; ?>

            </div><!-- /.container -->
        </div> <!-- /.search-content -->
        </div>


<?php get_footer();