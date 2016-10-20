<?php get_header(); ?>	
	<div class="pb_default-wrap clearfix">
    	<main class="pb_main">
        	<?php if ( have_posts() ) {?>
					<?php while ( have_posts() ) : the_post(); ?>
                        <article id="pb_single-post-<?php the_ID(); ?>" <?php post_class('pb_content-page clearfix'); ?>>
                        		<h3 class="pb_single-page-title"><?php the_title(); ?></h3>  
                                <div class="pb_single-page-cont">
                                	<?php if( have_rows('content_page_layouts') ): while ( have_rows('content_page_layouts') ) : the_row(); ?>
                                    	<?php if( get_row_layout() == 'single_column_layout' ): ?>
                                        	<div class="pb_one-col-layout rte">
                                            	<?php the_sub_field('single_column_content'); ?>
                                            </div>
                                        <?php elseif( get_row_layout() == 'two_column_layout' ): ?>
                                        	<div class="pb_two-col-layout">
                                            	<div class="pb_two-col-one rte">
                                                	<?php the_sub_field('two_column_content_one'); ?>
                                                </div>
                                                <div class="pb_two-col-two rte">
                                                	<?php the_sub_field('two_column_content_two'); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; endif; ?>
                                </div>
                    	</article>
                    <?php endwhile; ?>
            <?php } else { ?>
            	<?php get_template_part('includes/module','nocontent'); ?>
            <?php }; ?>
        </main>
    </div>
<?php get_footer(); ?>