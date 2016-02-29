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
            <div class="transparency"></div>
                <div class="container">
                    <div class="search-results-title clearfix">
                        <h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8 auto-position"> search results </h2>
                    </div>
                    <div class="search-results-cont">
                        <?php if ( have_posts() ) : ?>
                            <ol>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <li class="title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                    <p class="excerpt">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda consequuntur corporis debitis dignissimos ducimus id inventore ipsa nesciunt quod reprehenderit sit soluta, temporibus voluptate voluptatibus. Aliquam blanditiis iste repellat?
                                    </p>
                                <?php endwhile; ?>
                                <?php else : ?>

                                    <div class="no-resoult">
                                        nothing to show.
                                    </div>

                                <?php endif; ?>
                            </ol>
                        <hr>
                        <?php pagination(); ?>
                    </div>
                </div><!-- /.container -->
            </div> <!-- /.search-content -->
        </div>


<?php get_footer();