<style>
img[data-inject-svg] {
    opacity: 100;
}
.style-svg {
  fill: #fff;
}

svg.icon {
  fill: white;
}
</style>
<div class="banner shell">
	<?php 
		echo get_option('advert'); 
	?>
</div>

<!-- from NEW -->


<footer class="pb-4 bg-primary-3 text-light" id="footer">
      <div class="container">
	
        <div class="row mb-5">
          <div class="col-6 col-lg-3 col-xl-2">
            <h5>Navigate</h5>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a href="https://www.gothamvolleyball.org/about/" class="nav-link">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.gothamvolleyball.org/policydocuments/" class="nav-link">Bylaws &amp; Policies</a>
              </li>
              <li class="nav-item">
                <a href="https://www.gothamvolleyball.org/" class="nav-link">Gotham Volleyball</a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">Portfolio</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">Elements</a>
              </li> -->
            </ul>
          </div>
          <div class="col-6 col-lg">
            <h5>Contact</h5>
            <ul class="list-unstyled">
              <!-- <li class="mb-3 d-flex">
                <img class="icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/theme/map/marker-1.svg" alt="marker-1 icon" data-inject-svg />
                <div class="ml-3">
                  <span>put the address here
                    <br />New York, NY</span>
                </div>
              </li> -->
              <li class="mb-3 d-flex">
                <!-- <img class="icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/theme/communication/call-1.svg" alt="call-1 icon" data-inject-svg /> -->
                <img class="icon undefined" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/facebook.svg" alt="facebook social icon" data-inject-svg />
                <div class="ml-3">
                    <a href="https://www.facebook.com/GothamVolleyball/">Find us on Facebook</a>
                  <!-- <span>(212) 555-1212</span>
                  <span class="d-block text-muted text-small">Mon - Fri 9am - 5pm</span> -->
                </div>
              </li>
              <li class="mb-3 d-flex">
                <img class="icon" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/theme/communication/mail.svg" alt="mail icon" data-inject-svg />
                <div class="ml-3">
                  <a href="mailto:info@gothamvolleyball.org">
                    <div class="full-text">info@gothamvolleyball.org</div>
                    <div class="short-text">@Info</div>
                  </a>
                </div>
              </li>
            </ul>
          </div>

<!-- SUBSCRIBE START -->

<!-- PHP VERSION -->
          <?php
        // if ($page_title === 'sign_up') {
        //     echo '<div class="col-lg-5 col-xl-4 mt-3 mt-lg-0">';
        //     echo '<h5>Subscribe</h5>';
        //     echo '<p>Subscribe above in the sign-up form to receive our newsletter for the latest announcments, news, and updates, sent straight to your inbox.</p>';
        //     echo '<small class="text-muted form-text"><a href="https://www.gothamvolleyball.org/policydocuments/">Gotham Bylaws and Policy Documents</a></small>';
        //     echo '</div>';
        // } else {
          echo '<div class="col-lg-5 col-xl-4 mt-3 mt-lg-0">';
          echo '<h5>Subscribe</h5>';
          echo '<p>The latest announcments, news, and updates, sent straight to your inbox.</p>';
          echo '<form class="js-cm-form" id="subForm" action="https://www.createsend.com/t/subscribeerror?description=" method="post" data-id="5B5E7037DA78A748374AD499497E309E18B6A6B2093F1388A5CACE8538EE0DB34DF993CA615A3CF675B21EE978C3B12E0EAC6457D6642DB0C94B6787F41CC806">';
          echo '<div class="form-row">';
          echo '<div class="col-12">';
          echo '<input type="text" aria-label="Name" id="fieldName" maxlength="200" class="form-control mb-2" placeholder="Name" name="cm-name" ></div>';
          echo '<div class="col-12">';
          echo '<input type="email" autocomplete="Email" aria-label="Email" id="fieldEmail" maxlength="200" class="form-control mb-2 js-cm-email-input qa-input-email" placeholder="Email Address" name="cm-nvvk-nvvk"></div>';
          echo '<div class="col-12">';
          echo '<div class="d-none alert alert-success" role="alert" data-success-message>Thanks, you\'re all set!</div>';
          echo '<div class="d-none alert alert-danger" role="alert" data-error-message>Please fill all fields correctly.</div>';
          //echo '<div data-recaptcha data-sitekey="6Lf9CXsUAAAAAKA3ij7OyAUjDzG9tl2tPZ15F3XO" data-size="invisible" data-badge="bottomleft"></div>';
          echo '<button type="submit" class="btn btn-primary btn-loading btn-block" data-loading-text="Sending">';
          echo '<img class="icon" src="';?><?php bloginfo('stylesheet_directory');?><?php echo'/images/icons/theme/code/loading.svg" alt="loading icon" data-inject-svg />';
          echo '<span>Subscribe</span></button>';
          echo '</div></div>';
          echo '</form><script type="text/javascript" src="https://js.createsend1.com/javascript/copypastesubscribeformlogic.js"></script>';
          echo '<small class="text-muted form-text"><a href="https://www.gothamvolleyball.org/policydocuments/">Gotham Bylaws and Policy Documents</a></small>';
          echo '</div>';
        // }
          ?>

<!-- HTML VERSION -->
          <!-- <div class="col-lg-5 col-xl-4 mt-3 mt-lg-0">
            <h5>Subscribe</h5>
            <p>The latest announcments, news, and updates, sent straight to your inbox every month.</p>
            <form class="js-cm-form" id="subForm" action="https://www.createsend.com/t/subscribeerror?description=" method="post" data-id="5B5E7037DA78A748374AD499497E309E18B6A6B2093F1388A5CACE8538EE0DB34DF993CA615A3CF675B21EE978C3B12E0EAC6457D6642DB0C94B6787F41CC806">
            <div class="form-row">
              <div class="col-12">
                <input type="text" aria-label="Name" id="fieldName" maxlength="200" class="form-control mb-2" placeholder="Name" name="cm-name" >
              </div>
              <div class="col-12">
              <input type="email" autocomplete="Email" aria-label="Email" id="fieldEmail" maxlength="200" class="form-control mb-2 js-cm-email-input qa-input-email" placeholder="Email Address" name="cm-nvvk-nvvk">
              </div>
              <div class="col-12">
                  <div class="d-none alert alert-success" role="alert" data-success-message>
                  Thanks, you're all set!
                  </div>
                  <div class="d-none alert alert-danger" role="alert" data-error-message>
                  Please fill all fields correctly.
                  </div>
                  <div data-recaptcha data-sitekey="6Lf9CXsUAAAAAKA3ij7OyAUjDzG9tl2tPZ15F3XO" data-size="invisible" data-badge="bottomleft">
                  </div>
                  <button type="submit" class="btn btn-primary btn-loading btn-block" data-loading-text="Sending">
                  <img class="icon" src="<?php bloginfo('stylesheet_directory');?>/images/icons/theme/code/loading.svg" alt="loading icon" data-inject-svg />
                  <span>Subscribe</span>
                  </button>
              </div>
            </div>
            </form>
              <script type="text/javascript" src="https://js.createsend1.com/javascript/copypastesubscribeformlogic.js"></script>
              <small class="text-muted form-text"><a href="https://www.gothamvolleyball.org/policydocuments/">Gotham Bylaws and Policy Documents</a>
              </small>
          </div>  -->

<!-- SUBSCRIBE END -->

        </div>
        <div class="row justify-content-center mb-2">
          <div class="col-auto">
            <ul class="nav">
              <li class="nav-item">
                <a href="https://www.instagram.com/gothamvolleyball/" class="nav-link">
                  <img class="icon footer-fill" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/instagram.svg" alt="instagram social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="https://twitter.com/GothamVB" class="nav-link">
                  <img class="icon undefined style-svg" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/twitter.svg" alt="twitter social icon" data-inject-svg />
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/youtube.svg" alt="youtube social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/medium.svg" alt="medium social icon" data-inject-svg />
                </a>
              </li> -->
              <li class="nav-item">
                <a href="https://www.facebook.com/GothamVolleyball/" class="nav-link">
                  <img class="icon undefined" src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/facebook.svg" alt="facebook social icon" data-inject-svg />
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col col-md-auto text-center">
            <small class="text-muted">&copy;<?=date('Y')?> This page is protected by reCAPTCHA and is subject to the Google <a href="https://www.google.com/policies/privacy/">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service.</a>
            </small>
          </div>
        </div>
      </div>
    </footer>
    <a href="#" class="btn back-to-top btn-primary btn-round" data-smooth-scroll data-aos="fade-up" data-aos-offset="2000" data-aos-mirror="true" data-aos-once="false">
      <img class="icon" src="<?php bloginfo('stylesheet_directory');?>/images/icons/theme/navigation/arrow-up.svg" alt="arrow-up icon" data-inject-svg />
    </a>
    <!-- Required vendor scripts (Do not remove) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jquery.min.js"></script> -->
    

    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/popper.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.js"></script> -->

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- AOS (Animate On Scroll - animates elements into view while scrolling down-- allows for up-arrow in footer) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/aos.js"></script>
    <!-- Clipboard (copies content from browser into OS clipboard) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/clipboard.js"></script> -->
    <!-- Fancybox (handles image and video lightbox and galleries) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jquery.fancybox.min.js"></script> -->
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/flatpickr.min.js"></script>
    <!-- Flickity (handles touch enabled carousels and sliders) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/flickity.pkgd.min.js"></script>
    <!-- Ion rangeSlider (flexible and pretty range slider elements) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/ion.rangeSlider.min.js"></script>
    <!-- Isotope (masonry layouts and filtering) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/isotope.pkgd.min.js"></script>
    <!-- jarallax (parallax effect and video backgrounds) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jarallax.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jarallax-video.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jarallax-element.min.js"></script> -->
    <!-- jQuery Countdown (displays countdown text to a specified date) -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jquery.countdown.min.js"></script>
    <!-- jQuery smartWizard facilitates steppable wizard content -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jquery.smartWizard.min.js"></script> -->
    <!-- Plyr (unified player for Video, Audio, Vimeo and Youtube) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/plyr.polyfilled.min.js"></script> -->
    <!-- Prism (displays formatted code boxes) -->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/prism.js"></script> -->
    <!-- ScrollMonitor (manages events for elements scrolling in and out of view) MAKES CAPTCHA WINDOW APPEAR -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/scrollMonitor.js"></script>
    <!-- Smooth scroll (animation to links in-page)-->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/smooth-scroll.polyfills.min.js"></script> -->
    <!-- SVGInjector (replaces img tags with SVG code to allow easy inclusion of SVGs with the benefit of inheriting colors and styles)-->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/svg-injector.umd.production.js"></script> -->
    <!-- TwitterFetcher (displays a feed of tweets from a specified account)-->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/twitterFetcher_min.js"></script> -->
    <!-- Typed text (animated typing effect)-->
    <!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/typed.min.js"></script> -->
    <!-- Required theme scripts (Do not remove) allows for up-arrow from footer-->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/theme.js"></script>
    <!-- Removes page load animation when window is finished loading -->
    <script type="text/javascript">
      window.addEventListener("load", function () {    document.querySelector('body').classList.add('loaded');  });
    </script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/additional/additional-methods.min.js"></script>
    <script>
        $("#subForm").validate({
            rules: {
                'cm-nvvk-nvvk': {
                  required: true, email: true
              },
              'cm-name': {
                  required: true, minlength: 5
              }
            }
        });
  </script>
  
<!-- end NEW -->

<script type="text/javascript" charset="utf-8">
(function($){
	$('.top-nav ul li ul li:last').find('span').remove();
	$('.footer-nav ul li:last').find('span').remove();
	$('#menu-main-navigation > li:last').attr('class', 'last');
})(jQuery)
</script>
<script type="text/javascript" charset="utf-8">
	jQuery(function($) {
		//$(window).load(function(){
      $(window).on('load', function(){
		//$('#menu-main-navigation > li > ul').hide();
//		$('#menu-main-navigation > li').hover(function() {
//			$(this).find('ul').show();
//		}, function() {
//			$(this).find('ul').hide();
//		});
		$('.menu-item-has-children').each(function(){
		// $(this).click(function() {
      $(this).on("click", function() {  
			//alert('hiil');
			$(this).prevAll().find('ul').slideUp();
			$(this).find('ul').slideToggle();
						$(this).nextAll().find('ul').slideUp();
		});
		}); 
		//$('.login-butt').click(function(event) {
    $('.login-butt').on("click", function(event) {
		    event.preventDefault();
		//	alert('hiil');
			$('.signin-form').slideToggle();
			$(this).toggleClass('active');
			$('.login-butt i').toggleClass('fa-chevron-up');
		});
		$('.menu-toogle').on("click", function() {
		    //alert('hiil');
			$('#navigation').slideToggle();
			$('.menu-toogle i').toggleClass('fa-times');
		});
		$('img').on("click", function(s) {
		  var containersa = $(".signin-form"); // YOUR CONTAINER SELECTOR

  if (!containersa.is(s.target) // if the target of the click isn't the container...
      && containersa.has(s.target).length === 0) // ... nor a descendant of the container
  {
      //alert('show');
    containersa.slideUp();
    $('.login-butt i').removeClass('fa-chevron-up');
  }
		});
		// Hide div

  // $(document).mouseup(function (e)
  $(document).on("mouseup", function (e)
                    {
  var containers = $(".signin-form"); // YOUR CONTAINER SELECTOR

  if (!containers.is(e.target) // if the target of the click isn't the container...
      && containers.has(e.target).length === 0) // ... nor a descendant of the container
  {
      //alert('hide');
    containers.slideUp();
    $('.login-butt i').removeClass('fa-chevron-up');
  }
});	
		
		});
		$(window).on("scroll", function() {    
var scroll = $(window).scrollTop();
var headers = $('.header').height();
 //console.log(scroll);
if (scroll >= 200) {
    //console.log('a');
    $(".sticky").addClass("fixed");
} else {
    //console.log('a');
    $(".sticky").removeClass("fixed");
}
});
	});

	document.body.innerHTML = document.body.innerHTML.replace(/rrxx/g, 'challenge=<?php if (isset($_COOKIE['gothamvc'])) { echo($_COOKIE['gothamvc']); } ?>');
</script>

<script>
// header navbar reverts upon window resize
$(window).on("resize", function() {     
  if ($(window).width() >= 899) {                
    $("#navigation.new").css("display", "");     
  } 
});

// wpadmin bar pushes down main navbar
$(window).on("load resize", function() {  
  var wpheaderHeight = $("#wpadminbar").height(); 
	var cssString = wpheaderHeight + 'px'; 
	$("#navbar.header.sticky").css("padding-top", cssString); 
});

</script>
<?php wp_footer(); ?>
</body>
</html>