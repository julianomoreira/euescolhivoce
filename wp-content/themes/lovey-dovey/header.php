<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php echo Mobile_Detect::is_mobile_or_tablet() ? 'small-device' : 'large-device'; ?>">

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="author" content="<?php the_author(); ?>">

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php
		$favicon = ld_option('favicon');
		$favicon_iphone = ld_option('favicon_iphone');
		$favicon_iphone_retina = ld_option('favicon_iphone_retina');
		$favicon_ipad = ld_option('favicon_ipad');
		$favicon_ipad_retina = ld_option('favicon_ipad_retina');
		?>

		<?php if (!empty($favicon)) : ?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<?php endif; ?>
		<?php if (!empty($favicon_iphone)) : ?>
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $favicon_iphone; ?>" />
		<?php endif; ?>
		<?php if (!empty($favicon_iphone_retina)) : ?>
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $favicon_iphone_retina; ?>" />
		<?php endif; ?>
		<?php if (!empty($favicon_ipad)) : ?>
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $favicon_ipad; ?>" />
		<?php endif; ?>
		<?php if (!empty($favicon_ipad_retina)) : ?>
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $favicon_ipad_retina; ?>" />
		<?php endif; ?>

		<!-- BEGIN CUSTOM HEADER SCRIPTS -->
		<?php echo ld_kses(ld_option('head_script')); ?>
		<!-- END CUSTOM HEADER SCRIPTS -->

		<?php wp_head(); ?>
	</head>

	<?php $preloader_class = ''; if ( ld_option( 'enable_preloader', 1 ) ) $preloader_class .= 'js-preloader'; ?>

	<body <?php body_class( $preloader_class ); ?>>
	
		<div class="doc">
			<header id="header" class="header">
				<div class="logo heading">
					<div class="container">
						<?php $logo = ld_option('logo');
						$header_date_format = ld_option('header_date_format');
						if ( empty($logo) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<div class="logo-name"><?php echo ld_option('party_a_nickname') . ' + ' . ld_option('party_b_nickname'); ?></div>
								<div class="separator logo-date">
									<b></b>
									<span><?php $timestamp = strtotime(ld_option('wedding_date')); echo date_i18n($header_date_format,$timestamp); ?></span>
									<b></b>
								</div>
							</a>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="logo"></a>
						<?php } ?>
					</div>
				</div>		
				
				<div class="navbar-floating-anchor"></div>
				<nav id="navbar" class="navbar navbar-default navbar-floating navbar-static-top" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-header">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="navbar-collapse-header">
							<?php wp_nav_menu( array( 
								'theme_location' => 'header-navigation', 
								'menu_class'     => 'nav navbar-nav',
								'depth'          => 0,
								'fallback_cb'    => 'LD_Nav_Walker::fallback',
								'walker'         => new LD_Nav_Walker(),
							) ); ?>
						</div>
					</div>
				</nav>
				<div class="navbar-spacer"></div>
			</header>
			
			<?php
				$pages_with_title_section = ld_option( 'pages_with_title_section' );

				if ( is_home() )                               { $type = 'blog_index';       $title = ( get_option( 'show_on_front' ) === 'page' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'lovey_dovey' ); }
				elseif ( is_search() )                         { $type = 'search';           $title = __( 'Search Result', 'lovey_dovey' ); }
				elseif ( is_year() )                           { $type = 'blog_archive';     $title = sprintf(__( 'Blog in %s' , 'lovey_dovey' ), get_the_date('Y')); }
				elseif ( is_month() )                          { $type = 'blog_archive';     $title = sprintf(__( 'Blog in %s' , 'lovey_dovey' ), get_the_date('F Y')); }
				elseif ( is_day() )                            { $type = 'blog_archive';     $title = sprintf(__( 'Blog in %s' , 'lovey_dovey' ), get_the_date()); }
				elseif ( is_author() )                         { $type = 'blog_archive';     $title = sprintf(__( 'Blog Posts by %s' , 'lovey_dovey' ), get_queried_object()->display_name); }
				elseif ( is_archive() )                        { $type = 'blog_archive';     $title = sprintf(__( 'Blog : %s' , 'lovey_dovey' ), get_queried_object()->name); }
				elseif ( is_single() )                         { $type = 'blog_single';      $title = get_the_title(); }
				elseif ( is_page() )                           { $type = 'page_single';      $title = get_the_title(); }
				else                                           { $type = ''; }
			
				$title_section_background_image = ld_option( 'title_section_background_image' );
				$title_section_background_repeat = ld_option( 'title_section_background_repeat' );
				$title_section_background_position = ld_option( 'title_section_background_position' );
				$title_section_background_attachment = ld_option( 'title_section_background_attachment' );
				$title_section_background_size = ld_option( 'title_section_background_size' );
				$title_section_overlay = ld_option( 'title_section_overlay' );

				$enable_parallax = ld_option( 'title_section_enable_parallax', 1 );

				if ( $enable_parallax ) wp_enqueue_script( 'jquery-parallax' );

				$style = implode( " ", array(
					! empty( $title_section_background_image ) ? "background-image: url($title_section_background_image);" : "",
					! empty( $title_section_background_position ) ? "background-position: $title_section_background_position;" : "",
					! empty( $title_section_background_repeat ) ? "background-repeat: $title_section_background_repeat;" : "",
					! empty( $title_section_background_size ) ? "background-size: $title_section_background_size;" : "",
					! empty( $title_section_background_attachment ) ? "background-attachment: $title_section_background_attachment;" : "",
				) );

				if ( is_home() || is_search() || is_archive() || -1 == ld_page_option( 'enable_page_title_section', -1 ) || is_null( ld_page_option( 'enable_page_title_section', -1 ) ) ) {
					// inherit from theme options
					$show_page_title = in_array( $type, $pages_with_title_section );
				} else {
					// there is specific option for current page
					$show_page_title = ld_page_option( 'enable_page_title_section', 1 );
				}

				if ( $show_page_title ) : ?>
				<section id="title" class="title-section section <?php echo ld_option( 'title_section_color_scheme', 'light' ); ?>-scheme">
					
					<?php if ( ! empty( $title_section_background_image ) ) : ?>
						<div class="section-background <?php echo $enable_parallax ? 'parallax-background' : ''; ?> <?php if ($title_section_overlay != 'none') { echo $title_section_overlay; } ?>" style="<?php echo $style; ?>"></div>
					<?php endif; ?>

					<div class="container">
						<h1 class="big-title">
							<span><?php echo $title; ?></span>
						</h1>
					</div>
				</section>
				<?php endif; ?>