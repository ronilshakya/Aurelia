<?php
/**
 * Template part for displaying posts
 *
 * @package Aurelia
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card mb-5 shadow-sm border-0'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
				<?php
                if ( has_post_thumbnail() ) {
					the_post_thumbnail('large', ['class' => 'card-img-top']);
				} else {
					// optional fallback image
					echo '<img src="' . get_template_directory_uri() . '/assets/img/default-thumbnail.jpg" class="card-img-top" alt="Default">';
				}
				?>
            </a>
        </div>
    <?php endif; ?>

    <div class="card-body p-4">
        <header class="entry-header mb-3">
            <?php if ( is_singular() ) : ?>
                <h1 class="entry-title h3 fw-bold mb-3"><?php the_title(); ?></h1>
            <?php else : ?>
                <h2 class="entry-title h4 fw-semibold mb-3">
                    <a class="text-decoration-none text-dark" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                </h2>
            <?php endif; ?>

            <?php if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta small text-muted d-flex gap-2">
                    <span><i class="bi bi-person me-1"></i><?php aurelia_posted_by(); ?></span>
                    <span><i class="bi bi-calendar-event me-1"></i><?php aurelia_posted_on(); ?></span>
                </div>
            <?php endif; ?>
        </header>

        <div class="entry-content mb-4">
            <?php
            if ( is_singular() ) {
                the_content();
            } else {
				$excerpt = wp_trim_words( get_the_content(), 20, '...' ); 
                echo '<p class="post-description">' . esc_html( $excerpt ) . '</p>';
                // echo '<a href="' . esc_url( get_permalink() ) . '" class="btn btn-outline-primary mt-2">Read More</a>';
            }
            ?>
        </div>

        <footer class="entry-footer border-top pt-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between small text-muted">
                <?php aurelia_entry_footer(); ?>
            </div>
        </footer>
    </div>
</article>
