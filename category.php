<?php get_header(); ?>	
	<div class="pb_default-wrap clearfix pb_article-list">
    	<header>
        	<h1 class="pb_single-page-title"><?php the_archive_title(); ?></h1>
            <div class="pb_article-list-intro rte">
		    </div>
        </header>
    	
        <div class="pb_index-options">
            <nav>
                <span>Filter Categories: </span>
				<?php wp_dropdown_categories( 'show_option_none=Select category&hide_empty=1' ); ?>
				<script type="text/javascript">
					<!--
						var dropdown = document.getElementById("cat");
						function onCatChange() {
							if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
								location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
							}
						}
						dropdown.onchange = onCatChange;
					-->
				</script>
            </nav>
        </div>
    	<main class="pb_main">
        	
        	<?php if ( have_posts() ) {?>
            	<ul class="pb_index-list clearfix">
					<?php while ( have_posts() ) : the_post(); ?>
                        <li id="pb_post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                        	<div class="pb_index-img">
                            	<a href="<?php the_permalink(); ?>">
                                	<div class="pb_img-overflow">
										<?php the_post_thumbnail( 'featured-thumb' ); ?>
                               		</div>
                                	<time><?php echo '' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago ';?></time>
                                </a>
                            	<?php
									$post_type = $_GET['post_type'];
									if (isset( $post_type )) {
									} else {
								?>
									<span class="pb_post-type">
										<?php
											$type = get_post_type();
											if ( 'post' == $type )
											echo 'Blog';
											elseif ( 'page' == $type )
											echo 'Page';
											elseif ( 'competitions' == $type )
											echo 'Win Stuff';
											elseif ( 'reviews' == $type )
											echo 'The Measure';
											elseif ( 'news' == $type )
											echo 'The Word';
										?>
									</span>
                           		<?php }; ?>
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
            <?php } else { ?>
            	<?php get_template_part('includes/module','nocontent'); ?>
            <?php }; ?>
        </main>
    </div>
<?php get_footer(); ?>