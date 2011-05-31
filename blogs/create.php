<?php

/**
 * BuddyPress - Create Blog
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_blogs_content' ); ?>

<?php get_template_part( 'bp-wrapper-header' ); ?>

			<?php do_action( 'template_notices' ); ?>

				<h3><?php _e( 'Create a Blog', 'buddypress' ); ?> &nbsp;<a class="button" href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_blogs_root_slug() ) ?>"><?php _e( 'Blogs Directory', 'buddypress' ); ?></a></h3>

			<?php do_action( 'bp_before_create_blog_content' ); ?>

			<?php if ( bp_blog_signup_enabled() ) : ?>

				<?php bp_show_blog_signup_form(); ?>

			<?php else: ?>

				<div id="message" class="info">
					<p><?php _e( 'Blog registration is currently disabled', 'buddypress' ); ?></p>
				</div>

			<?php endif; ?>

			<?php do_action( 'bp_after_create_blog_content' ); ?>

<?php get_template_part( 'bp-wrapper-footer' ); ?>

	<?php do_action( 'bp_after_directory_blogs_content' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>

