<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aurelia
 */

get_header();
?>

	<main id="primary" class="site-main py-5">
    <div class="container">
        <?php get_template_part('template-parts/home/content','hero'); ?>
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <?php
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) : ?>
                        <header class="mb-4">
                            <h1 class="page-title h3 fw-bold border-bottom pb-2 mb-3">
                                <?php single_post_title(); ?>
                            </h1>
                        </header>
                    <?php endif;?>
                    <div class="row">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            <div class="col-md-6">
                            <?php
                                get_template_part( 'template-parts/content', get_post_type() );
                            ?>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                    <?php

                    // Pagination
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( '<i class="bi bi-arrow-left"></i> Prev', 'aurelia' ),
                        'next_text' => __( 'Next <i class="bi bi-arrow-right"></i>', 'aurelia' ),
                        'class'     => 'mt-4',
                    ) );

                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar bg-light p-4 rounded shadow-sm">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
