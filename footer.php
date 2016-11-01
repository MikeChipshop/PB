<footer class="pb_main-footer">
	<div class="pb_wrap clearfix">
            <section class="pb_footer-section pb_footer-menu">
                <h2>Navigate</h2>
                <ul><?php wp_nav_menu( array('theme_location' => 'footer_menu' )); ?></ul>
            </section>
            <section class="pb_footer-section">
                <h2>Your PhotoBite</h2>
                <?php if ( is_user_logged_in()): ?>
                	<ul><?php wp_nav_menu( array('theme_location' => 'footer_account_menu_logged_in' )); ?></ul>
                <?php else: ?>
                	<ul><?php wp_nav_menu( array('theme_location' => 'footer_account_menu' )); ?></ul>                	
                <?php endif; ?>
            </section>
            <section class="pb_footer-section">
                <h2>Photobite Information</h2>
                <ul><?php wp_nav_menu( array('theme_location' => 'info_menu' )); ?></ul>
            </section>
            <section class="pb_footer-section">                 
            <?php if( have_rows('social_links','option') ): ?>
        		<h2>Find us at&hellip;</h2>       
        		<ul class="pb_footer-social">
					<?php while ( have_rows('social_links','option') ) : the_row(); ?>
                        <li>
                            <a href="<?php the_sub_field('network_link'); ?>" title="Find us on <?php the_sub_field('network_name'); ?>" target="_blank">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa <?php the_sub_field('network_icon'); ?> fa-stack-1x"></i>
                                </span>
                            </a>
                        </li>
                    <?php endwhile; ?>
            	</ul>
            <?php endif; ?>
		</section>
    </div>
</footer>
<div class="pb_global-signup">
	<div class="pb_wrap">
    	<?php the_field('footer_signup_text','option'); ?>
        <!-- Begin MailChimp Signup Form -->
        <!-- <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css"> -->
        <div id="mc_embed_signup">
        <form action="//photobite.us13.list-manage.com/subscribe/post?u=97a2b55a5a76e3ab8d4b6a0a9&amp;id=fb8512fe45" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll" class="pb_footer-signup-cont">
            
        <div class="mc-field-group">
            <label for="mce-FULLNAME">Name </label>
            <input type="text" value="" name="FULLNAME" class="required" id="mce-FULLNAME">
        </div>
        <div class="mc-field-group">
            <label for="mce-EMAIL">Email </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_97a2b55a5a76e3ab8d4b6a0a9_fb8512fe45" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>
        </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[2]='FULLNAME';ftypes[2]='text';fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
    </div>
    <button class="pb_global-signup-close">
    	<span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-times fa-stack-1x fa-inverse"></i>
        </span>
    </button>
</div>
<div class="pb_mobile-menu-overlay"></div>
<?php wp_footer(); ?>
</body>
</html>