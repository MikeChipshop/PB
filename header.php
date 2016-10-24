<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1">
<title><?php wp_title(''); ?><?php if(wp_title(' ', false)) { echo ' | '; } ?><?php bloginfo('name'); ?></title>
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
        	<div class="pb_header-user-text">Welcome back Mike<span><a href="#">Profile</a> - <a href="#">Log Out</a></span></div>
            <div class="pb_header-user-img"><a href="#"><?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 40 ); ?></a></div>
        </div>
    </div>
</header>
<div class="pb_mobile-nav-bar">
	<button class="pb_mobile-menu-toggle"><i class="fa fa-bars"></i></button>
	<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/photobite-logo.png" alt="Photobite Logo"></a>
</div>
<nav class="pb_main-nav-cont">
	<div class="pb_nav-wrap">
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
					<div class="pb_search-checkbox-wrap">
                    	<label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                        <label><input type="checkbox" name="" value="articles" />Articles</label>
                    </div>
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