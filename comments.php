<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (__('Please do not load this page directly. Thanks!', 'nexothemes'));
if ( post_password_required() ) { ?>
    <p class="nocomments">
        <?php _e( 'This article need password. Please insert the password to show the comments.', 'nexothemes' ); ?>
    </p>
<?php
return;
} ?>


<?php
/**
 * Forms
 */
if ( comments_open() ) : ?>

    <!--respond-->
    <div id="respond">

        <?php
        if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>

            <p class="need-login">
                <?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'nexothemes'), get_bloginfo('url') . '/wp-login.php?redirect_to=' . get_permalink() ) ?>
            </p>

        <?php else : ?>

        <!-- forms comment -->
        <div class="forms-comments">

            <!--cancel-->
            <div class="cancel-comment-reply">
                <?php cancel_comment_reply_link(__( 'Cancel Reply', 'nexothemes' )); ?>
            </div>
            <!--/cancel-->

            <!-- form comment -->
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-comment" id="commentform">

                <?php if ( is_user_logged_in() ) : ?>
                    <p class="links-comentario">
                        <?php _e( 'Logged in as', 'nexothemes' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> - <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e( 'Logout', 'nexothemes' );?>"><?php _e( 'Logout', 'nexothemes' );?></a>
                    </p>
                <?php else : ?>

                    <input class="input-text" type="text" name="author" id="author" value="" size="22" tabindex="1" placeholder="<?php _e( 'Name', 'nexothemes' );?>" />

                    <input class="input-text" type="text" name="email" id="email" value="" size="22" tabindex="2" placeholder="<?php _e( 'E-mail (It will not be published)', 'nexothemes' ); ?>" />

                    <input class="input-text" type="text" name="url" id="url" value="" size="22" tabindex="3" placeholder="<?php _e( 'Website', 'nexothemes' ); ?>" />



                <?php endif; ?>

                <div class="box-message <?php if ( is_user_logged_in() ) { ?>full<?php }?>">
                    <textarea name="comment" class="textarea-comment" rows="7" placeholder="<?php _e( 'Message', 'nexothemes' );?>" id="comment" tabindex="4"></textarea>
                </div>

                <input name="submit" type="submit" class="send-cmt-button" id="submit" tabindex="5" value="<?php _e( 'Send', 'nexothemes' ) ?>" />

                <?php comment_id_fields(); ?>

                <?php do_action('comment_form', $post->ID); ?>
            </form>
            <!-- end form comment -->

        </div>
        <!-- end form comments -->

        <?php endif; ?>

    </div>
    <!-- end #respond -->

<?php endif; ?>



<?php
/**
 * List comments
 */
if ( have_comments() ) : ?>

    <!-- heading cmt -->
    <h3 class="heading-cmt">
        <?php comments_number( __( '0 Comments', 'nexothemes' ), __( '1 Comment', 'nexothemes' ), __( '% Comments', 'nexothemes' ); ?>
    </h3>
    <!-- end heading cmt -->

    <!-- list comments -->
    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=nexo_commentlist'); ?>
    </ol>
    <!-- end list comments -->


    <!-- navi comment rodape -->
    <div class="navi-comment">
        <div class="alignleft">
            <?php previous_comments_link() ?>
        </div>

        <div class="alignright">
            <?php next_comments_link() ?>
        </div>
    </div>
    <!-- end nav comment rodape -->

<?php else: ?>

    <?php  if ( comments_open() ) : ?>

        <?php // comment opened ?>

    <?php else : ?>

        <p class="nocomments">
            <?php _e( 'Comments Closed', 'nexothemes' ); ?>
        </p>

    <?php endif; ?>

<?php endif; ?>
