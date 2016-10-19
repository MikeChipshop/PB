<footer class="pb_main-footer">
	<div class="pb_wrap clearfix">
            <section class="pb_footer-section pb_footer-menu">
                <h2>Navigate</h2>
                <ul><?php wp_nav_menu( array('theme_location' => 'footer_menu' )); ?></ul>
            </section>
            <section class="pb_footer-section">
                <h2>Your PhotoBite</h2>
                <ul><?php wp_nav_menu( array('theme_location' => 'footer_account_menu' )); ?></ul>
            </section>
            <section class="pb_footer-section">
                <h2>Photobite Information</h2>
                <ul><?php wp_nav_menu( array('theme_location' => 'info_menu' )); ?></ul>
            </section>
            <section class="pb_footer-section">
        	<h2>Contacting PhotoBite</h2>
        	<ul class="pb_footer-social">
            	<li>
                    <a href="#">
                    	<span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-facebook fa-stack-1x"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-twitter fa-stack-1x"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-instagram fa-stack-1x"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-google-plus fa-stack-1x"></i>
                        </span>
                    </a>
                </li>
            </ul>
            <h2>Contacting PhotoBite</h2>
            <div class="pb_footer-newsletter">
            	<form>
            		<input type="text" value="Email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
					<button id="searchsubmit">Go</button>
				</form>
       		</div>
		</section>
    </div>
</footer>
<div class="pb_mobile-menu-overlay"></div>
<?php wp_footer(); ?>
</body>
</html>