<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Auto Mobile 1.0
  /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
$var_arrays = array( 'post_id', 'foodbakery_var_static_text' );
$comment_global_vars = foodbakery_VAR_GLOBALS()->globalizing($var_arrays);
extract($comment_global_vars);
?>

<?php
if ( have_comments() ) :
    if ( function_exists('the_comments_navigation') ) {
        the_comments_navigation();
    }
    ?>
    <div class="page_comments">
        <div class="comments" id="comments">
            <div class="element-title">
                <h3>
                    <?php
                    $comments_number = get_comments_number();
                    if ( 1 === $comments_number ) {
                        /* translators: %s: post title */
                        printf(esc_html(_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'foodbakery')), get_the_title());
                    } else {
                        printf(
                                // translators: 1: number of comments, 2: post title.
                                esc_html(_nx(
                                                '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'foodbakery'
                                )), esc_html(number_format_i18n($comments_number)), get_the_title()
                        );
                    }
                    ?>
                </h3>
            </div>
            <ul>
                <?php
                wp_list_comments(array( 'callback' => 'foodbakery_var_comment' ));
                ?>
            </ul>
        </div><!-- .comment-list -->
    </div>
    <?php
endif; // Check for have_comments().
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments') ) :
    ?>
    <p class="no-comments"><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_comments_closed')); ?></p>
<?php endif; ?>

<div class="blog_comments">
    <div class="comment-form">
        <div id="respond" class="contact-form form-holder">

            <?php
            $foodbakery_msg_class = '';
            if ( is_user_logged_in() ) {
                $foodbakery_msg_class = 'cs-message';
            }
		function comment_form_not_checked_cookies_consent( $fields ) {
			$fields['cookies'] = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />' .
							 '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'foodbakery' ) . '</label></p></div>';
			return $fields;
		}
			add_filter( 'comment_form_default_fields', 'comment_form_not_checked_cookies_consent' );
            $you_may_use = foodbakery_var_theme_text_srt('foodbakery_var_you_may');
            $must_login = '<a href="%s">' . foodbakery_var_theme_text_srt('foodbakery_var_logged_in') . '</a>' . foodbakery_var_theme_text_srt('foodbakery_var_you_must');
            $logged_in_as = foodbakery_var_theme_text_srt('foodbakery_var_log_in') . ' <a href="%1$s">%2$s</a>.<a href="%3$s" title="' . foodbakery_var_theme_text_srt('foodbakery_var_log_out_title') . '">' . foodbakery_var_theme_text_srt('foodbakery_var_log_out') . '</a>';
            $required_fields_mark = ' ' . foodbakery_var_theme_text_srt('foodbakery_var_require_fields');
            $required_text = sprintf($required_fields_mark, '<span class="required">*</span>');
            $defaults = array(
                'fields' => apply_filters('comment_form_default_fields', array(
                    'author' => '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="field-holder">
                <strong>' . foodbakery_var_theme_text_srt('foodbakery_var_name') . '</strong>
					<label>
                <input id="author"  name="author" class="nameinput" type="text" placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_name_place') . ' " value=""' .
                    esc_attr($commenter['comment_author']) . ' tabindex="1" required></label></div></div>',
                    'email' => '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="field-holder">' .
                    '<strong>' . foodbakery_var_theme_text_srt('foodbakery_var_text_email') . '</strong><label>
                <input id="email" name="email" class="emailinput" type="text" placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_email') . ' "  value=""' .
                    esc_attr($commenter['comment_author_email']) . ' size="30" tabindex="2" required>' .
                    '</label></div></div>',
                    'url' => '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="field-holder">' .
                    '<strong>' . foodbakery_var_theme_text_srt('foodbakery_var_phone') . '</strong><label>
                    <input id="url" name="url" type="text" class="websiteinput" placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_phone_place') . '" value="" size="30" tabindex="3">' .
                    '</label></div></div>',
                )),
                'comment_field' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="field-holder">
                <textarea id="comment_mes" name="comment"  placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_text_here') . '"></textarea>' .
                '</div></div>',
                'must_log_in' => '<span>' . sprintf($must_login, wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span>',
                'logged_in_as' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><span>' . sprintf($logged_in_as, admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span></div>',
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                'class_form' => ' contact-form row',
                'id_form' => 'form-style',
                'class_submit' => 'cs-button cs-bgcolor',
                'id_submit' => 'cs-bg-color',
                'title_reply' => '<div class="element-title">
                                <h4>' . foodbakery_var_theme_text_srt('foodbakery_var_post_comment') . '</h4>
                            </div>',
                'title_reply_to' => '<h2 class="cs-element-title">' . foodbakery_var_theme_text_srt('foodbakery_var_leave_comment') . '</h2>',
                'cancel_reply_link' => foodbakery_var_theme_text_srt('foodbakery_var_cancel_reply'),
                'label_submit' => foodbakery_var_theme_text_srt('foodbakery_var_leave_comment'),
            );
            comment_form($defaults, $post_id);
            ?>
        </div>
    </div>
</div><!-- .comments-area -->
