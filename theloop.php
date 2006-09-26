	 <?php /* Start The Loop */ if (have_posts()) { while (have_posts()) { the_post(); ?>
		<?php /* Permalink navigation has to be inside the loop */ if (is_single()) include (TEMPLATEPATH . '/navigation.php'); ?>
		<?php      		$time = get_the_time('M d');			list($mo, $da) = explode(" ", $time);		?>
		<acronym class="published" title="<?php the_time('Y-m-d\TG:i:sO'); ?>">
			<span class="pub-month"><?php echo($mo); ?></span>
			<span class="pub-date"><?php echo($da); ?></span>
		</acronym>	
		<div id="post-<?php the_ID(); ?>" class="wppost">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title='<?php printf(__('Permanent Link to "%s"','k2_domain'), strip_tags(get_the_title())) ?>'><?php the_title(); ?></a></h3>	

			<div class="itemtext">
					<?php if ( is_archive() or is_search() or (function_exists('is_tag') and is_tag()) ) {
						the_excerpt();
					} else {
						the_content(__('Continue reading','k2_domain') . " '" . the_title('', '', false) . "'");
					} ?>
	
					<?php link_pages('<p><strong>'.__('Pages:','k2_domain').'</strong> ', '</p>', __('number','k2_domain')); ?>
			</div>

			<!--
				<?php trackback_rdf(); ?>
			-->
		</div>
	<?php } /* End while */?>
	<?php } /*End loop*/ ?>