<?php get_header(); ?>	
	<div class="pb_default-wrap clearfix">
    	<main class="pb_main">
        	<?php if ( have_posts() ) {?>
					<?php while ( have_posts() ) : the_post(); ?>
                        <article id="pb_single-post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                        		<h3 class="pb_single-page-title"><?php the_title(); ?></h3>
                            	<div class="pb_single-page-cont rte"><?php the_content(); ?></div>
                    	</article>
                    <?php endwhile; ?>
            <?php } else { ?>
            	<?php get_template_part('includes/module','nocontent'); ?>
            <?php }; ?>
        </main>
    </div>
<?php get_footer(); ?>