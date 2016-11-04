<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1">
<title><?php wp_title(''); ?><?php if(wp_title(' ', false)) { echo ' | '; } ?><?php bloginfo('name'); ?></title>
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/manifest.json">
<link rel="mask-icon" href="<?php bloginfo('stylesheet_directory'); ?>/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="PhotoBite">
<meta name="application-name" content="PhotoBite">
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">
<?php if(get_field('store_toggle','option') ){ ?>
	<style>
		.pb_shop-toggle-item {
			display:none;
		}
	</style>
<?php }; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class('pb_default-view pb_footer-signup-relative'); ?>>
<header class="pb_main-header">
	<div class="pb_default-wrap">
    	<div class="pb_header-logo">
		<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/photobite-logo.png" alt="Photobite Logo"></a>
        </div>
        <div class="pb_header-user">
        	<?php if ( is_user_logged_in()): ?>
            	<?php global $userdata; wp_get_current_user(); ?>
        		<div class="pb_header-user-text">
                	Welcome back <?php echo $userdata->user_firstname; ?>
                	<span><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>">Profile</a> - <a href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a></span>
                </div>
            	<div class="pb_header-user-img">
                	<a href="#"><?php echo get_avatar( $userdata->ID, 40 ); ?></a>
                </div>
            <?php else: ?>
            	<div class="pb_header-user-text">
                	Welcome to PhotoBite 
                	<span><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a></span>
                </div>
            	<div class="pb_header-user-img">
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="pb_mobile-nav-bar">
	<button class="pb_mobile-menu-toggle"><i class="fa fa-bars"></i></button>
	<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/photobite-logo.png" alt="Photobite Logo"></a>
</div>
<nav class="pb_main-nav-cont">
	<div class="pb_nav-wrap">
    	<button class="pb_mobile-nav-close"><i class="fa fa-times" aria-hidden="true"></i></button>
        <ul class="pb_main-nav clearfix">
            <?php wp_nav_menu( array('theme_location' => 'main_menu' )); ?>
        </ul>
        <!-- <div class="pb_cart-nav">
        	<a href="<?php echo WC()->cart->get_cart_url(); ?>" title="View your basket">
				<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
            	<i class="fa fa-shopping-basket"></i>
            </a>
        </div> -->
        <div class="pb_header-global-search">
        	<i class="fa fa-search" aria-hidden="true"></i>
            <div class="pb_search-options">
            	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                    <input type="search" value="Site search..." name="s" id="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
					<!-- <div class="pb_search-checkbox-wrap">
                    	<label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                    </div> -->
                    <button id="searchsubmit">Search <span class="fa fa-search" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
</nav>
<?php if(is_front_page()){?>
<section class="pb_home-slider-cont">
	<div class="owl-carousel-home hide">
    	<?php if (have_rows('home_banner')){ while(have_rows('home_banner')): the_row(); ?>
			<?php 
                $attachment_id = get_sub_field('image');
                $size = "homeslide";
                $image = wp_get_attachment_image_src( $attachment_id, $size );
            ?>
            <div class="item" style="background:url(<?php echo $image[0]; ?>) no-repeat center center;background-size:cover;">
                <?php if(get_sub_field('link')){?><a href="<?php the_sub_field('link'); ?>" style="color:<?php the_sub_field('font_colour'); ?>;"><?php }; ?>
                    <?php if(get_sub_field('content')){?>
						<h2 style="color:<?php the_sub_field('font_colour'); ?>;" class="pb_<?php the_sub_field('content_placement'); ?>"><?php the_sub_field('content'); ?></h2>
					<?php }; ?>
                <?php if(get_sub_field('link')){?></a><?php }; ?>
            </div>
        <?php endwhile; }; ?>
    </div>
</section>
<?php }; ?>