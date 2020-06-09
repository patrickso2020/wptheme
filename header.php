<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<script src="/cdn-cgi/apps/head/9PMV6fPAQ1U8oLgUfrmxlvrpKpE.js"></script><script src="/cdn-cgi/apps/head/9PMV6fPAQ1U8oLgUfrmxlvrpKpE.js"></script>
<link rel='stylesheet' id='sb-font-awesome-css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css' media='all' />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v202001" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/styles.pure.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>


<?php wp_deregister_script('jquery');
wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
wp_enqueue_script('jquery');  
wp_register_script('bootstrap.js','https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js');
wp_enqueue_script('bootstrap.js'); 
?>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>

<?php wp_head(); ?>

<!-- Google Auto Ads -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-3127250149672145",
enable_page_level_ads: true
});
</script>

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/flickity.pkgd.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/flickity.min.css" type="text/css" media="screen" title="no title" charset="utf-8">

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js?v2" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
(function($){
$(document).ready(function() {
$('a[rel="fancybox"]').fancybox();
});
})(jQuery)
</script>

<style>
#navigation {
	background: #f8f9fa;
}

#navbar.header {
	text-align: left;
}

@media (min-width: 300px) {
	wp-navbar,
	navbar-expand-lg .navbar-collapse { 
		display: flex; 
		flex-basis: auto;
	}
}
.navbar-expand-lg .navbar-nav,
.navbar-expand-lg .wp-navbar {
	flex-direction: row
}


.wp-navbar {
	flex-basis: 100%;
	flex-grow: 1;
	align-items: center;

	display: flex;
	flex-basis: auto;
	
}
	

</style>

</head>

<body <?php body_class(); ?>>

<div id="navbar" class="header sticky"> 
	<div class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
											<!-- <h1 id="logo"><a  href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="Gotham Volleyball" /></a></h1> -->

											<!-- FROM REGISTRATION -->
											<a class="navbar-brand fade-page" href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" width="211" alt="Gotham Volleyball"></a>
											
											<!-- REMOVED NAVBAR HAMBURGER NAV -->
											<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
											<span class="navbar-toggler-icon"></span>
											</button> -->
		<div class="top-banner-ad">
		</div>
					<div class="collapse navbar-collapse " id="navbarNavDropdown">
					<!-- <div class="wp-navbar " id="navbarNavDropdown">  -->
						<ul class="navbar-nav">
										<!-- <li class="nav-item active">
										<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
										</li> -->
										<?php
										if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == 'yes' || $_SESSION['authenticated'])) :
										$nav = array('Dashboard' => 'personal.php', 'Scores' => 'scores.php',
										'Friendlies' => 'friendly.php', 'Division' => 'historydivision.php',
										'Admin' => 'admin.php', 'Tournament Admin'=>'tournament_admin/',
										'Reports' => 'reports.php', 'Schedule' => 'schedule.php', 'Enter Scores' => 'admin_scores.php', 'Users' => 'admin-users.php',
										'Team' => 'team1.php', 'Power'=>'powerclass1.php', 'Season' => 'season.php');
										// $last = end($nav);
										$board_pages = array('Reports', 'Schedule', 'Enter Scores', 'Users', 'Tournament Admin');
										$admin_pages = array('Team', 'Power',  'Admin', 'Season');
										$history_dropdown_pages = array('Division', 'Power');

										$count = 1;
										$admin_menu_links = '';
										foreach ($nav as $title => $page) {
										$active_class = '';
										if (isset($current_page) && $current_page == $title) {
										$active_class = ' active';
										}
										if(strcmp($_SESSION['TYPE'],"admin") != 0) {
										if (in_array($title, $admin_pages)) continue;
										if (strcmp($_SESSION['TYPE'],"board member") != 0) {
										if (in_array($title, $board_pages)) continue;
										}
										}
										if (in_array($title, $admin_pages) || in_array($title, $board_pages)) {
										$admin_menu_links .= '<a href="/registration/'.$page.'" class="dropdown-item fade-page'.$active_class.'">'.$title.'</a>';
										} elseif (in_array($title, $history_dropdown_pages)) {
										if (isset($current_page) && $current_page == 'History') {
										$active_class = ' active';
										}
								echo '<li class="nav-item dropdown'.$active_class.'">
											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											History
											</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
										<a class="dropdown-item" href="/registration/historydivision.php">Division</a>
										<a class="dropdown-item" href="/registration/historypower.php">Power</a>
									</div>
								</li>';
										} else {
								echo '<li class="nav-item'.$active_class.'"><a href="/registration/'.$page.'" class="nav-link">'.$title.'</a></li>';
										}

										$count++;
										}

										$active_class = '';
										if (isset($current_page) && $current_page == 'Admin Pages') {
										$active_class = ' active';
										}
										// print out the admin menu
								echo '<li class="nav-item dropdown'.$active_class.'">
											<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown-grid" aria-expanded="false" aria-haspopup="true">Admin Pages</a>
									<div class="dropdown-menu row"><div class="col-auto" data-dropdown-content><div class="card card-sm card-body shadow-sm">';
										echo $admin_menu_links;
									echo '</div></div></div></li>';

										unset($nav);
										unset($board_pages);
										unset($admin_pages);
										else:
										$active_class_signup = '';
										$active_class_login = ' active';
										if (isset($current_page) && $current_page == 'Sign Up') {
										$active_class_signup = ' active';
										$active_class_login = '';
										}
								echo '<li class="nav-item"><a href="/registration/login.php#login" class="nav-link ">Login</a></li>';
								echo '<li class="nav-item"><a href="/registration/signup.php" class="nav-link">Sign Up</a></li>';
										// echo '<li class="nav-item"><a href="https://www.gothamvolleyball.org/about/" class="nav-link">About Us</a></li>';
										endif;
										?>

										<!-- <li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Dropdown link
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
										</div>
										</li> -->
						</ul>
					</div> <!--//collapse navbar -->
											<?php
											if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == 'yes' || $_SESSION['authenticated'])) :
											?>

					<div>
								<div class="d-flex align-items-center flex-wrap">
												<a href="/registration/settings.php" alt="edit address and update password">
													<img src="/registration/images/default_avatar.jpg" alt="edit address and update password" class="avatar avatar-lg m-1">
												</a>
								</div> 
								<div class="profile-link">
										<small><a href="/registration/settings.php">profile</a></small>
								</div>

								<!-- </div>    -->
								<div class="logout_header">
										<a href="/registration/logout.php">logout</a>
								</div>
											<?php
											endif;
											?>

					</div> <!--//noname -->
					
											<!-- END REGISTRATION -->
											<?php wp_nav_menu(array('theme_location' => 'header-menu', 'after' => '<span> &#124;&nbsp;</span>', 'container' => '')); ?>

                							<span class="menu-toogle"><i class="fa fa-list"></i></span>

		</div><!--//container -->
						<div id="navigation" class="new">
							<div class="wp-container">
								<?php wp_nav_menu('theme_location=main-menu&container='); ?>
                            </div>
                            
						</div>	
	</div> <!--//navbar -->	
</div> <!--//header sticky -->	
				
<!-- FROM OLD -->









