<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

	<div id="comment-wrapper-<?php comment_ID(); ?>" class="comment-wrapper">
		<?php switch ( $comment->comment_type ) :

		// ===============================================

			case 'pingback' : case 'trackback' : ?>
				<p><?php _e( 'Pingback:', 'lovey_dovey' ); ?> <?php comment_author_link(); ?></p>
			<?php break;

		// ===============================================

			default :

				global $post; ?>
				<div class="comment-avatar"><?php echo get_avatar( $comment, '50' ); ?></div>

				<div class="comment-header">
					<span class="comment-name"><?php comment_author_link(); ?></span>
					<?php if ( $comment->user_id === $post->post_author ) : ?>
						<span class="comment-is-author label label-default"><?php _e( 'Author', 'lovey_dovey' ); ?></span>
					<?php endif; ?>
					<small class="comment-date">
						<?php printf( __( '%s at %s', 'lovey_dovey' ), get_comment_date(), get_comment_time() ); ?>
					</small>
				</div>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lovey_dovey' ); ?></p>
				<?php endif; ?>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

				<div class="comment-action">
					<?php comment_reply_link( array_merge( $args, array(
						'add_below'  => 'comment-wrapper',
						'respond_id' => 'respond-wrapper',
						'reply_text' => '<span class="btn btn-default btn-sm">' . __( 'Reply', 'lovey_dovey' ) . '</span>',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
					) ) ); 
					edit_comment_link('<span class="btn btn-default btn-sm">'. __('Edit','lovey_dovey') . '</span>', '', '' );
					?>
				</div>
					
			<?php break;

		endswitch; ?>
	</div>
</li>