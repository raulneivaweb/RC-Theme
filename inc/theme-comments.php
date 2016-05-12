<?php
/**
 * Structure comments default theme
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 */

/* ==========================================================================
   File Security Check
   ========================================================================== */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( __('You do not have sufficient permissions to access this page', 'nexothemes') );
}

/* Global Panel
   ========================================================================== */
global $nexo_options;



/**
 * Comments
 * @param  array $comment
 * @param  array $args
 * @param  array $depth
 */
function nexo_commentlist($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    /* List comments
       ========================================================================== */
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

        <?php
        /* Start wrap comments */
        ?>
        <div id="comment-<?php comment_ID(); ?>" class="comment-wrap">

            <!-- avatar -->
            <div class="avatar-comment">
                <?php echo get_avatar( $comment, 90 ); ?>
            </div>
            <!-- end avatar -->

            <!-- infos comment -->
            <div class="infos-comment">
                <span class="name-comment">
                    <?php printf(__('%s'), get_comment_author_link())?>
                </span>

                <span class="date-comment">
                    EM <?php echo get_comment_date('j/m/Y'); ?>
                </span>

                <div class="reply-link">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>

                <div class="entry entry-comment">
                    <?php comment_text() ?>
                </div>
            </div>
            <!-- end infos comment -->

        </div>
        <?php
        /* end wrap comments */
        ?>
<?php }

/**
 * Register a new avatar
 * @version 1.0
 */
function nexo_avatar_default ($avatar_defaults) {

    // New Avatar Image from assets 'avatar.png'
    $myavatar = NEXO_THEME_DIR . 'assets/images/avatar.png';

    // Name Author
    $avatar_defaults[$myavatar] = __("Custom Avatar", 'nexothemes');

    return $avatar_defaults;
}
add_filter('avatar_defaults', 'nexo_avatar_default');
?>