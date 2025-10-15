<?php
/**
 * Template part for displaying hero with posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aurelia
 */

?>

<section class="container-fluid px-0 mb-5">
    <ul class="nav nav-tabs w-100 aurelia-nav-tabs">
        
        <li class="nav-item position-static">
            <a class="nav-link bg-black text-white rounded-0 border-black" href="#">Home</a>
        </li>
        <?php
        $categories = get_categories();
        foreach ($categories as $cat) :
            $hero_posts = new WP_Query(array(
                'cat' => $cat->term_id,
                'posts_per_page' => 4, // posts per page
                'post_status' => 'publish',
                'paged' => 1, // start at first page
            ));
        ?>
        <li class="nav-item aurelia-nav-item dropdown position-static">
            <a class="nav-link" href="#" aria-expanded="false">
                <?php echo esc_html($cat->name); ?> 
            </a>

            <div class="dropdown-menu w-100 p-3 aurelia-menu">
                <div class="container">
                    <div class="container-fluid">
                        <div class="bg-black py-3 aurelia-tab-wrapper">
                        <div class="row  aurelia-row" 
                            data-category="<?php echo esc_attr($cat->term_id); ?>" 
                            data-page="1">
                            
                            <?php if ($hero_posts->have_posts()) : ?>
                                <?php while ($hero_posts->have_posts()) : $hero_posts->the_post(); ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail', ['class' => 'card-img-top']); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="card-body p-2">
                                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                    <h6 class="card-title"><?php the_title(); ?></h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p class="px-3">No posts found in this category.</p>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex mx-4 gap-2">
                            <button class="aurelia-nav-btn  hero-prev" 
                                    data-category="<?php echo esc_attr($cat->term_id); ?>" disabled>
                                <i class="fa-solid fa-caret-left"></i>
                            </button>
                            <button class="aurelia-nav-btn hero-next" 
                                    data-category="<?php echo esc_attr($cat->term_id); ?>">
                                <i class="fa-solid fa-caret-right"></i>
                            </button>
                        </div>
        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>

    </ul>

   <?php 
$home_posts = new WP_Query([
    'posts_per_page' => 7,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
]);
?>

<div class="w-100 border-top border-5 border-black">
    <?php if ($home_posts->have_posts()) : ?>
        <div class="d-none d-md-block"> <!-- Grid for md+ screens -->
            <div class="row g-1">
                <?php $count = 0; ?>
                <?php while ($home_posts->have_posts()) : $home_posts->the_post(); $count++; ?>
                    <div class="<?php echo $count <= 3 ? 'col-md-4' : 'col-md-3'; ?>">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none d-block position-relative">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class'=>'img-fluid w-100']); ?>
                            <?php endif; ?>
                            <div class="post-title-overlay position-absolute w-100 text-white px-2 py-1" 
                                 style="bottom:0; background: rgba(0,0,0,0.5);">
                                <h6 class="m-0"><?php the_title(); ?></h6>
                                <p class="m-0"><?php the_author(); ?> - <?php echo get_the_date(); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="d-block d-md-none"> <!-- Carousel for mobile -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php while ($home_posts->have_posts()) : $home_posts->the_post(); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none d-block position-relative">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', ['class'=>'img-fluid w-100']); ?>
                                <?php endif; ?>
                                <div class="post-title-overlay position-absolute w-100 text-white px-2 py-1" 
                                     style="bottom:0; background: rgba(0,0,0,0.5);">
                                    <h6 class="m-0"><?php the_title(); ?></h6>
                                    <p class="m-0"><?php the_author(); ?> - <?php echo get_the_date(); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <!-- Optional navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    <?php else: ?>
        <p>No recent posts found.</p>
    <?php endif; ?>
</div>



</section>

