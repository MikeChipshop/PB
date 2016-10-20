<?php
/*
 * Plugin Name: Site Functions
 * Description: Adds specific content functions to the Royal Exchange theme. Please make sure this plugin stays activated!
 * Plugin URI: http://miniman-webdesign.co.uk
 * Version: 1.0
 * Author: Mike @ Miniman
 * Author URI: http://miniman-webdesign.co.uk
 * License: Private
*/

/***************************************************
/ PAGINATE
/***************************************************/

/* Function that Rounds To The Nearest Value.
   Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}

/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('');
	//$pagenavi_options['pages_text'] = ('%CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('&laquo;');
    $pagenavi_options['last_text'] = ('&raquo;');
    $pagenavi_options['next_text'] = '&gt;';
    $pagenavi_options['prev_text'] = '&lt;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;

    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        //intval — Get the integer value of a variable
        /*http://php.net/manual/en/function.intval.php*/
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;

        //empty — Determine whether a variable is empty
        /*http://php.net/manual/en/function.empty.php*/
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;

        if($start_page <= 0) {
            $start_page = 1;
        }

        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }

        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);

        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";

            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            previous_posts_link($pagenavi_options['prev_text']);

            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }

            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }

            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }

            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);

            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}

/***************************************************
/ GRABBING PARENT PAGE ID
/***************************************************/

function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if(is_page()&&($post->post_parent==$pid||is_page($pid)))
               return true;   // we're at the page or at a sub page
	else
               return false;  // we're elsewhere
};


/* ------------------------------------------------------------------*/
/* Odd and Even Class
/* ------------------------------------------------------------------*/
function oddeven_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}
add_filter ( 'post_class' , 'oddeven_post_class' );
global $current_class;
$current_class = 'odd';
/* ------------------------------------------------------------------*/
/* CURRENT TEMPLATE ID */
/* ------------------------------------------------------------------*/
add_filter( 'template_include', 'var_template_id', 1000 );
function var_template_id( $t ){
    $GLOBALS['current_template_id'] = basename($t);
    return $t;
}

function get_template_id( $echo = false ) {
    if( !isset( $GLOBALS['current_template_id'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_template_id'];
    else
        return $GLOBALS['current_template_id'];
}

/* ------------------------------------------------------------------*/
/* RESPONSIVE IMAGES */
/* ------------------------------------------------------------------

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
return $html; }


/* RD Blog Tab Fix */
function rd_fix_blog_tab_on_cpt($classes, $item, $args) {
  if (!is_singular('post') && !is_category() && !is_tag()) {
    $blog_page_id = intval(get_option('page_for_posts'));
    if ($blog_page_id != 0) {
      if ($item->object_id == $blog_page_id) {
        unset($classes[array_search('current_page_parent', $classes)]);
      }
    }
  }
  return $classes;
}

add_filter('nav_menu_css_class', 'rd_fix_blog_tab_on_cpt', 10, 3);

function ptobr($string)
{
return preg_replace("/<\/p>[^<]*<p>/", "<br /><br />", $string);
}

function stripp($string)
{
return preg_replace('/(<p>|<\/p>)/i','',$string) ;
}
add_filter('wp_nav_menu_args', 'prefix_nav_menu_args');
function prefix_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}
// Removes ul class from wp_nav_menu
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );

/***************************************************
/ Site Navigation Menus
/***************************************************/

if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
			'main_menu' => 'Main Menu',
			'footer_menu' => 'Footer Menu',
			'info_menu' => 'Information Menu',
			'footer_account_menu' => 'Footer Account Menu'
  		)
  	);
}



/***************************************************
/ Responsive Embeds
/***************************************************/

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="cs_embed-container">'.$html.'</div>';
    return $return;
}

/***************************************************
/ THE WORD POST TYPE
/***************************************************/

add_action( 'init', 'register_cpt_news' );

function register_cpt_news() {

    $labels = array( 
        'name' => _x( 'News', 'news' ),
        'singular_name' => _x( 'News', 'news' ),
        'add_new' => _x( 'Add New', 'news' ),
        'add_new_item' => _x( 'Add New News', 'news' ),
        'edit_item' => _x( 'Edit News', 'news' ),
        'new_item' => _x( 'New News', 'news' ),
        'view_item' => _x( 'View News', 'news' ),
        'search_items' => _x( 'Search News', 'news' ),
        'not_found' => _x( 'No news found', 'news' ),
        'not_found_in_trash' => _x( 'No news found in trash', 'news' ),
        'parent_item_colon' => _x( 'Parent news:', 'news' ),
        'menu_name' => _x( 'The Word', 'news' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Post type for news',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'author' ),
        'taxonomies' => array('category', 'post_tag'), 
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'the-word', 'with_front' => FALSE),
        'capability_type' => 'post'
    );

    register_post_type( 'news', $args );
}

/***************************************************
/ THE MEASURE POST TYPE
/***************************************************/

add_action( 'init', 'register_cpt_reviews' );

function register_cpt_reviews() {

    $labels = array( 
        'name' => _x( 'Reviews', 'reviews' ),
        'singular_name' => _x( 'Review', 'reviews' ),
        'add_new' => _x( 'Add New Review', 'reviews' ),
        'add_new_item' => _x( 'Add New Review', 'reviews' ),
        'edit_item' => _x( 'Edit Review', 'reviews' ),
        'new_item' => _x( 'New Review', 'reviews' ),
        'view_item' => _x( 'View Review', 'reviews' ),
        'search_items' => _x( 'Search Reviews', 'reviews' ),
        'not_found' => _x( 'No reviews found', 'reviews' ),
        'not_found_in_trash' => _x( 'No reviews found in trash', 'reviews' ),
        'parent_item_colon' => _x( 'Parent Review:', 'reviews' ),
        'menu_name' => _x( 'The Measure', 'reviews' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Post type for reviews',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions' ),
        'taxonomies' => array('category'), 
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'the-measure', 'with_front' => FALSE),
        'capability_type' => 'post'
    );

    register_post_type( 'reviews', $args );
}

/***************************************************
/ WIN STUFF POST TYPE
/***************************************************/

add_action( 'init', 'register_cpt_competitions' );

function register_cpt_competitions() {

    $labels = array( 
        'name' => _x( 'Competitions', 'competitions' ),
        'singular_name' => _x( 'Competition', 'competitions' ),
        'add_new' => _x( 'Add New Competition', 'competitions' ),
        'add_new_item' => _x( 'Add New Competition', 'competitions' ),
        'edit_item' => _x( 'Edit Competition', 'competitions' ),
        'new_item' => _x( 'New Competition', 'competitions' ),
        'view_item' => _x( 'View Competition', 'competitions' ),
        'search_items' => _x( 'Search Reviews', 'competitions' ),
        'not_found' => _x( 'No competitions found', 'competitions' ),
        'not_found_in_trash' => _x( 'No competitions found in trash', 'competitions' ),
        'parent_item_colon' => _x( 'Parent Competition:', 'competitions' ),
        'menu_name' => _x( 'Win Stuff', 'competitions' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Post type for competitions',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions' ),
        'taxonomies' => array('category'), 
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'win-stuff', 'with_front' => FALSE),
        'capability_type' => 'post'
    );

    register_post_type( 'competitions', $args );
}

function pb_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
}
add_action( 'admin_menu', 'pb_change_post_label' );

// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

add_action( 'add_meta_boxes', 'your_custom_add_custom_box' );

	function your_custom_add_custom_box() {
		add_meta_box('ps_custom_post_type_uploads', __('Portfolio Slideshow', 'port_slide'), 'ps_custom_post_type_uploads', 'clubs', 'normal', 'default');
	}