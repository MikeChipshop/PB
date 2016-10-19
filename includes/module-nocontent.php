<div class="pb_no-content">
                	<h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No content found</h1>
                	<div class="pb_no-content-suggest">
						<p>but you might be interested in...</p>
						<?php $suggestloop = new WP_Query( array( 'post_type' => 'any', 'posts_per_page' => '4') ); ?>
        				<?php if ( $suggestloop->have_posts() ) {?>
            				<ul class="pb_index-list clearfix">
								<?php while ( $suggestloop->have_posts() ) : $suggestloop->the_post(); ?>
									<li id="pb_post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                        	<div class="pb_index-img">
                            	<a href="<?php the_permalink(); ?>">
                                <div class="pb_img-overflow">
								<?php the_post_thumbnail( 'featured-thumb' ); ?>
                                </div>
                                <time><?php echo '' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago ';?>
                                </time>
                                </a>
                            </div>
                            <div class="pb_index-excerpt">
                        		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="pb_index-post-meta">
                                	<span class="pb_index-author"><?php the_author_posts_link(); ?></span>
                                  	<span class="pb_index-comments">
                                  		<a href="<?php the_permalink(); ?>#comments">
                                  			<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
                                  		</a>
                                   	</span>
                                    <div class="pb_index-category"><?php the_category( ' ' ); ?></div>
                                </div>
                            	<div class="pb_index-excerpt-cont">
									<?php if ( has_excerpt( $post->ID ) ) {
										the_excerpt();
									} else {
										echo wp_trim_words( get_the_content(), 60 );
									}; ?>
                            	</div>
                            </div>
                        </li>
								<?php endwhile; ?>
							</ul>
						<?php }; ?>
					</div>
                </div>