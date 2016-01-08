			<footer id="footer" class="footer">
				<div class="container">
					<div class="logo heading">
					<?php $logo_footer = ld_option('logo_footer');	
				 	if ( empty($logo_footer) ) { ?>
						<?php echo '<div class="logo-name">' . ld_option('party_a_nickname') . ' + ' . ld_option('party_b_nickname') . '</div>'; ?>
					<?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo ld_option('logo_footer'); ?>" alt="logo"></a>
					<?php } ?>
					</div>
					<?php $copyright_text = ld_option('copyright_text');
					if ( ! empty($copyright_text) ) : ?>
					<div class="copyright">
						<?php echo $copyright_text; ?>
					</div>
					<?php endif; ?>
				</div>
			</footer>
		</div>	

		<div class="popup-document" id="popup-document"></div>

		<?php if ( ld_option( 'enable_preloader', 1 ) ) : ?>
			<div id="preloader-content">
				<div class="preloader-content-inner">
					<div class="preloader-image">

						<div class="spinner"></div>

						<div class="logo heading">
						<?php $logo_footer = ld_option('logo_footer');	
					 	if ( empty($logo_footer) ) { ?>
							<?php echo '<div class="logo-name">' . ld_option('party_a_nickname') . ' + ' . ld_option('party_b_nickname') . '</div>'; ?>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo ld_option('logo_footer'); ?>" alt="logo"></a>
						<?php } ?>
						</div>
						
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<!-- BEGIN CUSTOM FOOTER SCRIPTS -->
		<?php echo ld_kses(ld_option('foot_script')); ?>
		<!-- END CUSTOM FOOTER SCRIPTS -->

		<?php wp_footer(); ?>
	</body>
	
</html>