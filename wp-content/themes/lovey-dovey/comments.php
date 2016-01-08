<?php if ( comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
} ?>

<?php if ( have_comments() ) : ?>
	<div id="comments" class="comments">
		<h3 class="comments-title">
			<span>
				<?php comments_number(
					__( 'No Comments', 'lovey_dovey' ),
					__( '1 Comment', 'lovey_dovey' ),
					__( '% Comments', 'lovey_dovey' )
				); ?>
			</span>
		</h3>

		<ul class="comments-list">
			<?php wp_list_comments( array( 'callback' => 'ld_list_comments_callback' ) ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
		<nav class="pagination heading clearfix">
			<div class="prev"><?php previous_comments_link( __('Previous Comments', 'lovey_dovey' ) ); ?></div>
			<div class="next"><?php next_comments_link( __('Next Comments', 'lovey_dovey' ) ); ?></div>
		</nav>
		<?php endif; ?>

	</div>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<div id="respond-wrapper" class="respond">

		<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : '' );

		$fields['author'] = '
			<div class="respond-author-field form-group">
				<input placeholder="' . __( 'Name', 'lovey_dovey' ) . '" id="respond-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' autocomplete="off" />
			</div>
		';

		$fields['email'] = '
			<div class="respond-author-field form-group">
				<input placeholder="' . __( 'Email', 'lovey_dovey' ) . '" id="respond-email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' autocomplete="off" />
			</div>
		';

		$fields['url'] = '
			<div class="respond-author-field form-group">
				<input placeholder="' . __( 'Website', 'lovey_dovey' ) . '" id="respond-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" autocomplete="off" />
			</div>
		';

		$comment = '
			<div class="respond-comment form-group">
				<textarea placeholder="' . __( 'Enter your comment &hellip;', 'lovey_dovey' ) . '" id="respond-comment" name="comment" rows="4" aria-required="true" autocomplete="off"></textarea>
			</div>
		';


		comment_form( array(
			'fields'              => $fields,
			'comment_field'       => $comment,
			'title_reply'         => __( 'Leave a Reply', 'lovey_dovey' ),
			'title_reply_to'      => __( 'Leave a Reply to %s', 'lovey_dovey' ),
			'cancel_reply_link'   => __( 'Cancel Reply', 'lovey_dovey' ),
			'label_submit'        => __( 'Post Reply', 'lovey_dovey' ),
			'comment_notes_before'=> '',
			'comment_notes_after' => '',
		) ); ?>

	</div>
<?php endif; ?>