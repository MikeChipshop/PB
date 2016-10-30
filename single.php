<?php get_header(); ?>	
<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
    	<article id="pb_single-post-<?php the_ID(); ?>" <?php post_class('pb_single-post-container clearfix'); ?>>
        	<header>
            	<h1 class="pb_single-page-title"><?php the_title(); ?></h1>
                <?php if ( get_field('feature_intro') ) {?>
            		<h2><?php the_field('feature_intro'); ?></h2>
            	<?php }; ?>
            </header>
            <div class="pb_single-post-meta">
            	<div class="pb_single-meta-left">
                    <div class="pb_single-post-meta-img">
                        <?php
                        $author_id = get_the_author_meta('ID');
                        $attachment_id = get_field('profile_pic', 'user_'. $author_id);
                        $size = "avatar-small";
                        $image = wp_get_attachment_image_src( $attachment_id, $size );				
                        ?>
                        <img src="<?php echo $image[0]; ?>" alt="Author avatar" />
                    </div>
                    <div class="pb_single-post-meta-details">
                        <p>By <?php the_author_posts_link(); ?>, <?php echo 'Posted ' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago ';?></time></p>
                        <p>In <?php the_category( ', ' ); ?></p>
                    </div>
                </div> 
                <div class="pb_single-meta-right">
                	<a href="#comments">Read Comments</a>
                </div>               
            </div>
            <?php if(get_field('featured_image_toggle')){?>
				<?php if ( has_post_thumbnail() ) {?>
                    <div class="pb_single-header-image">
                        <?php the_post_thumbnail(); ?>     	
                    </div>
                <?php }; ?>
            <?php }; ?>
            <?php if ( is_singular( 'competitions' )) { ?>
            	<?php if(get_field('competition_status') == 'open'){?>		
                <div class="pb_single-comp-status pb_comp-enter">Enter Now!</div> 
                <?php } elseif(get_field('competition_status') == 'closed'){ ?>
                <div class="pb_single-comp-status pb_comp-closed">Closed</div>
                <?php } elseif(get_field('competition_status') == 'ending'){ ?>
                <div class="pb_single-comp-status pb_comp-ending">Ending Soon!</div>
                <?php }; ?>
            <?php }; ?>
            <div class="pb_single-page-cont rte">
            	<?php the_content(); ?>
            </div>
            <div class="pb_about-author clearfix">
            	<div class="pb_about-author-img">
                	<?php
                        $author_id = get_the_author_meta('ID');
                        $attachment_id = get_field('profile_pic', 'user_'. $author_id);
                        $size = "featured-thumb";
                        $image = wp_get_attachment_image_src( $attachment_id, $size );				
                        ?>
                        <img src="<?php echo $image[0]; ?>" alt="Author avatar" />
                </div>
                <div class="pb_about-author-content">
                	<h3>About <?php the_author(); ?></h3>
                    <?php
                    	$author_id = get_the_author_meta('ID');
                        the_field('short_about_author', 'user_'. $author_id);
					?>
                	<p class="pb_other-author-posts">Other posts by <?php the_author_posts_link(); ?></p>
                </div>
            </div>
            <aside class="pb_single-aside" id="comments">
            	<div class="pb_comments-section">
            		<?php comments_template(); ?>
            	</div>
    		</aside>
    	</article>
    <?php endwhile; } else { ?>
    	<?php get_template_part('includes/module','nocontent'); ?>
    <?php }; ?>
<?php get_footer(); ?>