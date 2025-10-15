<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aurelia
 */

?>

</div> <!-- container -->
	<footer id="colophon" class="aurelia-footer">
		<div class="py-5">

			<div class="container">
				<div class="row g-4">
					<div class="col-md-3 py-4">
						<div class="footer-brand">
							<?php if ( has_custom_logo() ) {
								the_custom_logo();
							} else { ?>
								<a href="<?php echo esc_url( home_url('/') ); ?>">
								<?php bloginfo('name'); ?>
								</a>
							<?php } ?>
							<p class="description"><?php bloginfo('description'); ?></p>
	
						</div>
	
					</div>
					<div class="col-md-3 py-4">
						<h5 class="footer-title">Categories</h5>
						<?php
						$all_categories = get_categories( array(
							'orderby' => 'name',
							'order' => 'ASC',
							'number' => 6
						));
						echo '<div class="all-categories">';
						foreach ( $all_categories as $cat ) {
							echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
						}
						echo '</div>';
						?>
	
					</div>
					<div class="col-md-3 py-4">
						<h5 class="footer-title">Links</h5>
						<?php
						// Show the footer menu for column 1
						if ( has_nav_menu( 'footer-col-1' ) ) {
							wp_nav_menu( array(
								'theme_location' => 'footer-col-1',
								'menu_class'     => 'footer-menu list-unstyled',
								'container'      => false,
							) );
						}
						?>
					</div>
					<div class="col-md-3 py-4">
						<h5 class="footer-title">Follow</h5>
						<?php
						$social_networks = aurelia_get_social_networks();
						$social_links_exist = false;
	
						foreach ( $social_networks as $network ) {
							if ( get_theme_mod( "aurelia_{$network}_link" ) ) {
								$social_links_exist = true;
								break;
							}
						}
	
						if ( $social_links_exist ) : ?>
							<div class="social-links my-4">
								<?php
								foreach ( $social_networks as $network ) {
									$link = get_theme_mod( "aurelia_{$network}_link" );
									if ( $link ) {
										echo '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center text-decoration-none text-secondary-emphasis py-1">';
										echo '<i class="fab fa-' . esc_attr( $network ) . ' me-2"></i><p class="m-0">'. esc_attr(ucfirst($network)) .'</p>';
										echo '</a>';
									}
								}
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="site-info text-center py-4 mx-4 border-top">
			<p>@<?php bloginfo('name') ?> - <?php echo date('Y') ?>. All Rights Reserved.</p>
			<p><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'aurelia' ), 'Aurelia', '<a href="https://ronilshakya.com.np">Ronil Shakya</a>' ); ?></p>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
