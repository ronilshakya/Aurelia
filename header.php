<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aurelia
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aurelia' ); ?></a>

	<header id="masthead" class="site-header">
		<!-- main navigation -->
		<div class="container">
			<nav class="navbar navbar-expand-lg aurelia-navigation my-4 h-5 py-2 px-2 px-lg-4">
				<div class="container-fluid">
					<div class="d-flex align-items-center">
						<div class="site-branding navbar-brand">
							<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
								<div class="site-logo">
									<?php the_custom_logo(); ?>
								</div>
								<?php else : ?>
									<h1 class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-decoration-none fs-5 text-black">
											<?php bloginfo( 'name' ); ?>
										</a>
									</h1>
								<?php endif; ?>
						</div><!-- .site-branding -->
		
						<div id="site-navigation" class="main-navigation d-none d-xl-block px-5">
							<?php
							wp_nav_menu(array(
								'theme_location'  => 'menu-1',
								'depth'           => 2,
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse',
								'container_id'    => 'mainNavbar',
								'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0 gap-2',
								'fallback_cb'     => '__return_false',
								'walker'          => new Bootstrap_WP_Navwalker(),
							));
							?>
						</div>
					</div>

					<div>
						<button class="p-2 bg-transparent border-0 shadow-none"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
							<i class="fa-solid fa-magnifying-glass fa-lg"></i>
						</button>

		
						<button class="navbar-toggler d-lg-inline  border-0 shadow-none p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
							aria-controls="offcanvasNavbar" aria-label="<?php esc_attr_e('Toggle navigation', 'aurelia'); ?>">
							<i class="fa-solid fa-bars fa-lg"></i>
						</button>
					</div>
				</div>
			</nav><!-- #site-navigation -->
		</div>

		<!-- Secondary Navigation -->
		<nav id="sticky-navbar" class="navbar navbar-expand-lg sticky-navbar py-2 bg-light shadow-sm position-fixed top-0 w-100">
			<div class="container">
				<!-- social links -->
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
										echo '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer" class=" text-decoration-none text-secondary-emphasis py-1">';
										echo '<i class="fab fa-' . esc_attr( $network ) . ' me-2"></i>';
										echo '</a>';
									}
								}
								?>
							</div>
					<?php endif; ?>
				<!-- logo -->
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-decoration-none fs-5 text-black">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				<?php endif; ?>
				<!-- actions -->
				 <div>
						<button class="p-2 bg-transparent border-0 shadow-none"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
							<i class="fa-solid fa-magnifying-glass fa-lg"></i>
						</button>

		
						<button class="navbar-toggler d-lg-inline  border-0 shadow-none p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
							aria-controls="offcanvasNavbar" aria-label="<?php esc_attr_e('Toggle navigation', 'aurelia'); ?>">
							<i class="fa-solid fa-bars fa-lg"></i>
						</button>
					</div>
			</div>
		</nav>

		<!-- offcanvas search -->
		<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
			<div class="offcanvas-body d-flex justify-content-center align-items-center flex-column">
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				<h5 class="my-4">Type and hit enter to search</h5>
				<form role="search" method="get" class="search-form d-flex" action="<?php echo esc_url(home_url('/')); ?>">
				<input type="search" class="form-control me-2" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" required/>
				<button type="submit" class="aurelia-btn">
					<i class="fa-solid fa-magnifying-glass fa-lg"></i>
				</button>
				</form>

			</div>
		</div>

		<!-- Offcanvas Mobile Menu (only visible on small screens) -->
		<div class="offcanvas aurelia-offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
			<div class="offcanvas-header px-4">
				<h5 class="offcanvas-title" id="offcanvasNavbarLabel">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
						<?php else : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-decoration-none">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
						<?php endif; ?>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body px-5">
				<!-- Menu links -->
				<div class="menu-links my-4">
					<?php
						wp_nav_menu(array(
							'theme_location'  => 'menu-1',
							'depth'           => 2,
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => false,
							'walker'          => new Offcanvas_Bootstrap_WP_Navwalker(),
						));
					?>
				</div>

				<!-- description -->
				<p class="site-description fs-6"><?php echo esc_html(get_bloginfo('description')); ?></p>


				<!-- <h5>Social</h5> -->
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
									echo '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center text-decoration-none text-secondary-emphasis py-2">';
									echo '<i class="fab fa-' . esc_attr( $network ) . ' me-2"></i><p class="m-0">'. esc_attr(ucfirst($network)) .'</p>';
									echo '</a>';
								}
							}
							?>
						</div>
					<?php endif; ?>

			</div>
		</div>
	</header><!-- #masthead -->
<div class="container">