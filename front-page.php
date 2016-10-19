<?php get_header(); ?>	
    	<section class="pb_home-latest-articles">
        	<div class="pb_wrap">
            	<h1 class="pb_home-section-titles">Featured</h1>
            	<div class="pb_home-featured-wrap">
					<?php
                        $postargs = array(
                            'post_type' => 'post',
                            'posts_per_page' => 5
                        );
                        $postslider = new WP_Query( $postargs ); if ( $postslider->have_posts() ) { $i=0;
                    ?>
                        
                        
                            <?php while ( $postslider->have_posts() ) : $postslider->the_post();?>
                                <?php if ( $i == 0 ) : ?>
                                    <?php 
                                        $thumb_id = get_post_thumbnail_id();
                                        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'featured-thumb-large', true);
                                        $thumb_url = $thumb_url_array[0];
                                    ?>
                                    <div class="pb_homelatest-articles-hero" style="background:url(<?php echo $thumb_url ?>) no-repeat center center;background-size:cover;">
                                        <a href="<?php the_permalink(); ?>" title="Go to <?php the_title(); ?>">
                                            <h2><?php the_title(); ?></h2>
                                        </a>
                                    </div>
                                    <div class="pb_home-latest-article-small">
                                <?php endif; ?>
                                <?php if ( $i != 0 ) : ?>
                                    <?php 
                                        $thumb_id = get_post_thumbnail_id();
                                        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'featured-thumb-large', true);
                                        $thumb_url = $thumb_url_array[0];
                                    ?>
                                    <div class="pb_home-latest-article-small-item">
                                        <a href="<?php the_permalink(); ?>" title="Go to <?php the_title(); ?>">
                                            <img src="<?php echo $thumb_url ?>">
                                            <h2><?php the_title(); ?></h2>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php $i++; endwhile; ?>
                        </div>
                   <?php }; wp_reset_postdata();?>
               </div>
           </div>
        </section>
        <div class="pb_wrap pb_home-further-pos">
        	<?php 
				$wordargs = array(
					'post_type' => 'news',
					'posts_per_page' => 3
				);
				$wordloop = new WP_Query( $wordargs ); if ( $wordloop->have_posts() ) { ?>
        		<section class="pb_home-words">
                	<h1 class="pb_home-section-titles">The Word</h1>
					<?php while ( $wordloop->have_posts() ) : $wordloop->the_post(); ?>
                        <?php 
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'featured-thumb', true);
                            $thumb_url = $thumb_url_array[0];
                        ?>
                        <div class="item">
                            <a href="<?php the_permalink(); ?>" title="Visit Article">
                               <img src="<?php echo $thumb_url ?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                        </div>
                    <?php endwhile; ?>
                	<a class="pb_find-more-button" href="<?php bloginfo('url'); ?>/the-word-landing" title="Find more in The Word">Find more in The Word</a>
            	</section>
            <?php } wp_reset_postdata();?>
			<?php 
				$revargs = array(
					'post_type' => 'reviews',
					'posts_per_page' => 3
				);
				$revargs = new WP_Query( $revargs ); if ( $revargs->have_posts() ) { ?>
        		<section class="pb_home-measure">
                	<h1 class="pb_home-section-titles">The Measure</h1>
					<?php while ( $revargs->have_posts() ) : $revargs->the_post(); ?>
                        <?php 
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'featured-thumb', true);
                            $thumb_url = $thumb_url_array[0];
                        ?>
                        <div class="item">
                            <a href="<?php the_permalink(); ?>" title="Visit Article">
                                <img src="<?php echo $thumb_url ?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                        </div>
                    <?php endwhile; ?>
                    
					<a class="pb_find-more-button" href="<?php bloginfo('url'); ?>/the-measure-landing" title="Find more in The Measure">Find more in The Measure</a>
            	</section>
            <?php } wp_reset_postdata();?>
            <section class="pb_home-win">
            	<h1 class="pb_home-section-titles">Win Stuff</h1>
				<?php 
                    $compargs = array(
                        'post_type' => 'competitions',
                        'posts_per_page' => 3
                    );
                    $comploop = new WP_Query( $compargs ); if ( $comploop->have_posts() ) { ?>
                        <?php while ( $comploop->have_posts() ) : $comploop->the_post(); ?>
                            <?php 
                                $thumb_id = get_post_thumbnail_id();
                                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'featured-thumb', true);
                                $thumb_url = $thumb_url_array[0];
                            ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>" title="Visit Article">
                                   	<img src="<?php echo $thumb_url ?>">
                                    <h2><?php the_title(); ?></h2>
                                </a>
                            </div>
                        <?php endwhile; ?>
                <?php } else { ?>
                	We're currently not running any competitions. Check back soon for more stuff to win!                    
                <?php } wp_reset_postdata();?>
                <a class="pb_find-more-button" href="<?php bloginfo('url'); ?>/win-stuff-landing" title="Find more in Win Stuff">Find more in Win Stuff</a>
            </section>
        </div>
<?php get_footer(); ?>