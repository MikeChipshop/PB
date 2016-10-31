<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 680;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add featured thumbnails to the index, and header.
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'featured-thumb', 300, 300, true );
	add_image_size( 'featured-thumb-large', 500, 500, true );
	add_image_size( 'homeslide', 1120, 400, true );
	add_image_size( 'avatar-small', 100, 100, true );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}
endif;

/***************************************************
/ PAGINATE
/***************************************************/
 
if ( ! function_exists( 'miniman_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * Based on paging nav function from Twenty Fourteen
 */

function miniman_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&laquo;', 'yourtheme' ),
		'next_text' => __( '&raquo;', 'yourtheme' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'yourtheme' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;
/****************************************************
ENQUEUES
*****************************************************/
function miniman_load_scripts() {
    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery2',  get_template_directory_uri() . '/js/jquery-2.2.0.min.js', false,'',true );
	wp_register_script( 'site-common',  get_template_directory_uri() . '/js/site-common.js', array(),'',true  );
	wp_register_script( 'owljs',  get_template_directory_uri() . '/js/owl.carousel.min.js', array('site-common'),'',true  );
	wp_register_style( 'main-css', get_template_directory_uri() . '/style.css','','', 'screen' );
	wp_register_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900','','', 'screen' );
	wp_register_style( 'google-fonts-os', 'https://fonts.googleapis.com/css?family=Oswald:400,700,300','','', 'screen' );
	wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css','','', 'screen' );
	wp_register_style( 'owlcss', get_template_directory_uri() . '/owl.carousel.css','','', 'screen' );
	wp_register_style( 'google-fonts-m', 'https://fonts.googleapis.com/css?family=Merriweather:400,700,300','','', 'screen' );
	
	//wp_enqueue_script( 'jquery2' );
	wp_enqueue_script( 'site-common' );
	wp_enqueue_script( 'owljs' );
	wp_enqueue_style( 'main-css' );
	wp_enqueue_style( 'owlcss' );
	wp_enqueue_style( 'google-fonts' );
	wp_enqueue_style( 'google-fonts-os' );
	wp_enqueue_style( 'google-fonts-m' );
	wp_enqueue_style( 'fontawesome' );
}

add_action('wp_enqueue_scripts', 'miniman_load_scripts');


/****************************************************
EXCERPTS
*****************************************************/

function cust_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'cust_excerpt_length');
/* Returns a "Continue Reading" link for excerpts */
function twentyeleven_continue_reading_link() {
	return ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . __( 'read more &raquo;', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link() */
function twentyeleven_auto_excerpt_more( $more ) {
	return '&hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );


/****************************************************
GALLERIES
*****************************************************/

/* Remove inline styles printed when the gallery shortcode is used. */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :

/****************************************************
COMMENTS
*****************************************************/

/* Template for comments and pingbacks. */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/* Removes the default styles that are packaged with the Recent Comments widget */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :

/* Prints HTML with meta information for the current post—date/time and author */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/* Prints HTML with meta information for the current post (category, tags and permalink) */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;



/***************************************************
/ CUSTOM MENU
/***************************************************/

/*
/ HTML 5 Placeholders for the comments form
*/
function my_update_fields($fields) {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields['author'] =
		'<p class="comment-form-author">
			<input required minlength="3" maxlength="30" placeholder="Your Name*" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
    	</p>';

    $fields['email'] =
    	'<p class="comment-form-email">
    		<input required placeholder="Your Email*" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
    	</p>';

	$fields['url'] =
		'<p class="comment-form-url">
			<input placeholder="Your URL" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
    	</p>';

	return $fields;
}

add_filter('comment_form_default_fields','my_update_fields');

function my_update_comment_field($comment_field) {

	$comment_field =
		'<p class="comment-form-comment">
			<textarea required placeholder="Enter Your Comment…" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
		</p>';

	return $comment_field;
}
add_filter('comment_form_field_comment','my_update_comment_field');

/***************************************************
/ ADD PARENT SLUG TO BODY CLASS
/***************************************************/

add_filter('body_class','body_class_section');

function body_class_section($classes) {
    global $wpdb, $post;
    if (is_page()) {
        if ($post->post_parent) {
            $parent  = end(get_post_ancestors($current_page_id));
        } else {
            $parent = $post->ID;
        }
        $post_data = get_post($parent, ARRAY_A);
        $classes[] = 'parent-' . $post_data['post_name'];
    }
    return $classes;
}
//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


/* Options Pages */
if(function_exists('acf_add_options_page')) {

	acf_add_options_page();
	acf_add_options_sub_page('Sidebar');
	acf_add_options_sub_page('Misc');

}
/* Sidebars */
function mini_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'textdomain' ),
        'id'            => 'sidebar-main',
        'description'   => __( 'Widgets in this area will be shown in the main sidebar.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="cs_widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="cs_widgettitle">',
        'after_title'   => '</h2><div class="cs_widget-content">',
    ) );
}
add_action( 'widgets_init', 'mini_theme_slug_widgets_init' );

// Related Posts Function, matches posts by tags - call using joints_related_posts(); )
function joints_related_posts() {
    global $post;
    $tags = wp_get_post_tags( $post->ID );
    if($tags) {
        foreach( $tags as $tag ) {
            $tag_arr .= $tag->slug . ',';
        }
        $args = array(
            'tag' => $tag_arr,
            'numberposts' => 3, /* You can change this to show more */
            'post__not_in' => array($post->ID)
        );
        $related_posts = get_posts( $args );
        if($related_posts) {
        echo '<h4>Related Posts</h4>';
        echo '<ul id="joints-related-posts">';
            foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
                <li class="related_post">
                    <a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <?php get_template_part( 'partials/content', 'byline' ); ?>
                </li>
            <?php endforeach; }
            }
    wp_reset_postdata();
    echo '</ul>';
}

// De-auto P

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

// Custom category page loop
function custom_cpl( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$post_types = get_post_types();
        $query->set( 'post_type', $post_types );
		return $query;
	}
}
add_action( 'pre_get_posts', 'custom_cpl' );

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}