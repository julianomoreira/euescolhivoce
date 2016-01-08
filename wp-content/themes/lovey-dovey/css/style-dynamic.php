<?php
/**
 * Fetch Variables
 */
$heading_font_face = ld_option( 'heading_font_face' );
$body_font_face    = ld_option( 'body_font_face' );

$color_accent      = ld_option( 'color_accent' );

?>
/**
 * Body Font Face
 */
body {
	font-family: <?php echo $body_font_face; ?>;
}
/**
 * Heading Font Face
 */
h1, h2, h3, h4, h5, h6,
input[type="submit"],
a.button,
.heading,
.widget.panel .title,
.widget_ld_widget_section_couple_summary_and_countdown .text-and-date .js-countdown .countdown-period,
.header .navbar a,
.title-section .big-title,
.aside-section .widget .widget-title,
.comments .comments-list li .comment-header,
.event-single .event-meta .event-meta-title,
.footer .copyright, .post-meta-mobile, .guestbook .list-guestbook-entries .guestbook-entry .guestbook-name {
	font-family: <?php echo $heading_font_face; ?>;	
}
/**
 * Accent Text Color
 */
a,
a:hover,
.color-accent,
.header .navbar-nav li a:hover,
.header .navbar-nav li a:focus,
.header .logo .logo-date,
.widget_ld_widget_section_couple_summary_and_countdown .text-and-date .married-text span,
.widget_ld_widget_section_post_type_event .event-title,
.widget_categories ul li a:hover,
.widget_categories ul li a:focus,
.widget_nav_menu ul li a:hover,
.widget_nav_menu ul li a:focus,
.widget_recent_entries ul li a:hover,
.widget_recent_entries ul li a:focus,
.widget_recent_comments ul li a:hover,
.widget_recent_comments ul li a:focus,
.widget_archive ul li a:hover,
.widget_archive ul li a:focus,
.widget_meta ul li a:hover,
.widget_meta ul li a:focus,
.widget_pages ul li a:hover,
.widget_pages ul li a:focus,
.widget_rss ul li a:hover, 
.widget_rss ul li a:focus,
.main-section .post-title a:hover,
.main-section .post-title a:focus,
.main-section .blog-loop .post-meta-comment-count a:hover,
.main-section .blog-loop .post-meta-comment-count a:focus {
	color: <?php echo $color_accent; ?>;
}
/**
 * Accent Background Color
 */
input[type="submit"],
.button,
#preloader-content .spinner {
	background-color: <?php echo $color_accent; ?>;
}
/**
 * Accent Border Color
 */
.header .navbar li.current-menu-item,
.header .navbar li.current_page_ancestor,
.header .navbar li.current_page_parent {
	border-color: <?php echo $color_accent; ?>;
}
/**
 * Accent Border Color For Sticky Ribbon
 */
.blog-loop .sticky-ribbon {
	border-top-color: <?php echo $color_accent; ?>;	
	border-bottom-color: <?php echo $color_accent; ?>;	
}






