<?php
add_action('wp_ajax_aurelia_hero_pagination', 'aurelia_hero_pagination');
add_action('wp_ajax_nopriv_aurelia_hero_pagination', 'aurelia_hero_pagination');

function aurelia_hero_pagination() {
    $category_id = intval($_POST['category']);
    $page = intval($_POST['page']);
    $posts_per_page = 4;

    $query = new WP_Query(array(
        'cat' => $category_id,
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'post_status' => 'publish',
    ));

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body p-2">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <h6 class="card-title"><?php the_title(); ?></h6>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile;
    endif;

    wp_reset_postdata();
    echo ob_get_clean();
    wp_die();
}
