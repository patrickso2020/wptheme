<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<!-- <script src="/cdn-cgi/apps/head/9PMV6fPAQ1U8oLgUfrmxlvrpKpE.js"></script><script src="/cdn-cgi/apps/head/9PMV6fPAQ1U8oLgUfrmxlvrpKpE.js"></script> -->
<link rel='stylesheet' id='sb-font-awesome-css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css' media='all' />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v202001" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/styles.pure.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_deregister_script('jquery');
wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js');
wp_enqueue_script('jquery');  
wp_register_script('popper.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
wp_enqueue_script('popper.js'); 
wp_register_script('bootstrap.js','https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js');
wp_enqueue_script('bootstrap.js'); 
?>

<!-- Latest compiled and minified JavaScript -->
<!-- <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script> -->

<?php wp_head(); ?>

<!-- Google Auto Ads -->
<!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-3127250149672145",
enable_page_level_ads: true
});
</script> -->

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/flickity.pkgd.min.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" charset="utf-8"></script> -->
<!-- <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" title="no title" charset="utf-8"> -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/flickity.min.css" type="text/css" media="screen" title="no title" charset="utf-8">

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js?v2" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
// (function($){
// $(document).ready(function() {
// $('a[rel="fancybox"]').fancybox();
// });
// })(jQuery)
</script>

<style>
#navigation {
	background: #eff4f7;
}
#navbar.header {
	text-align: left;
}
.navbar-collapse.col {
	padding-left: .75rem;
}
/* wp-navbar styling */
@media (min-width: 300px) {
	wp-navbar,
	navbar-expand-lg .navbar-collapse { 
		display: flex; 
		flex-basis: auto;
	}
}
.navbar.wplinks {
	border-bottom: none;
	padding-left: .75rem;
}
.navbar-expand-lg .navbar-nav,
.navbar-expand-lg .wp-navbar {
	flex-direction: row
}
#wp-main-nav.row {
	flex-grow: 1;
	padding-left: 12px;
}
.wp-navbar {
	flex-basis: 100%;
	flex-grow: 1;
	align-items: center;
	display: flex;
	flex-basis: auto;
	justify-content: left;
}
.avatar {
	flex-shrink: 0;
	width: 3rem;
	height: 3rem;
	border-radius: 50%;
	/* margin: 0rem .375rem; */
}
.dropdown-menu.show {
	display: block;
	text-align: center;
	right: 0;
}
.navbar-collapse.col {
	margin-right: -.925rem;
}
div.dropdown-menu.show {
    position: absolute;
    right: 0 !important;
    left: auto !important;
    text-align: center;
}

</style>
</head>

<body <?php body_class(); ?>>

<div id="navbar" class="header sticky"> 
	<div class="navbar navbar-expand-lg justify-content-between navbar-light navbar-custom" style="display: flex;">
		<div class="container">
			<div class="flex-fill px-0 d-flex justify-content-between">
							<!-- FROM REGISTRATION -->
					<a class="navbar-brand mr-0 fade-page logo-link" href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="Gotham Volleyball" id="logo_gothamvolleyball"></a>
							<!-- REMOVED NAVBAR HAMBURGER NAV -->
							<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
							</button> -->

				<div class=" navbar-collapse col px-0 px-lg-2 flex-fill wplinks">
					<div class="py-2 py-lg-0 menu-items">
							<!-- <div class="row" id="wp-main-nav"> -->
							<!-- <div class="collapse navbar-collapse " id="navbarNavDropdown"> -->
							<!-- <div class="wp-navbar " id="navbarNavDropdown" >  -->
						<ul class="navbar-nav">
									<!-- <li class="nav-item active">
									<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
									</li> -->
									<?php
									//$_SESSION['authenticated'] = 'yes';  // forced authentication
									if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == 'yes' || $_SESSION['authenticated'])) :
									$nav = array('My Account' => 'personal.php');
									// 'Scores' => 'scores.php',
									// 'Friendlies' => 'friendly.php', 'Division' => 'historydivision.php',
									// 'Admin' => 'admin.php', 'Tournament Admin'=>'tournament_admin/',
									// 'Reports' => 'reports.php', 'Schedule' => 'schedule.php', 'Enter Scores' => 'admin_scores.php', 'Users' => 'admin-users.php',
									// 'Team' => 'team1.php', 'Power'=>'powerclass1.php', 'Season' => 'season.php');
									$last = end($nav);
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
									echo '<li class="nav-item full-text'.$active_class.'"><a href="/registration/'.$page.'" class="nav-link">'.$title.'</a></li>';
									}
									$count++;
									}
									$active_class = '';
									if (isset($current_page) && $current_page == 'Admin Pages') {
									$active_class = ' active';
									}
									// print out the admin menu

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

						</ul>
					</div> <!-- // menu-items -->
				</div> <!--// collapse-navbar wplinks -->
			</div> 	<!-- // flex-fill -->
							<?php
							if (isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == 'yes' || $_SESSION['authenticated'])) :
							?>

				<div id="avatarMenu">
					<div class="d-flex align-items-center flex-wrap">
								<ul class="navbar-nav">
								<li class="nav-item dropdown ">
								<a href="#" id="navbarDropdownProfileSettings" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/social/default_avatar.jpg" alt="edit address and update password" id="avatar-pic" class="avatar avatar-md m-1"></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfileSettings">
								<a class="dropdown-item short-text" href="/registration/settings.php">My Account</a>
							<div class="dropdown-divider header-menu">								
							</div>
								<a class="dropdown-item" href="/registration/settings.php">Profile</a>
								<a class="dropdown-item" href="/registration/logout.php">Logout</a>
						</div>
								</li>
								</ul>
					</div>
				</div> <!-- moved this /div before the endif; -->
							<?php
							endif;
							?>
				<!-- // avatarMenu -->
							<?php wp_nav_menu(array('theme_location' => 'header-menu', 'after' => '<span> &#124;&nbsp;</span>', 'container' => '')); ?>
							<span class="menu-toogle"><i class="fa fa-list"></i></span>
			</div>
			 <!-- //container -->	
		
		</div> <!--//navbar-expand -->
							
			<div id="navigation" class="new">
				<div class="wp-container">
				<?php wp_nav_menu('theme_location=main-menu&container='); ?>
				</div>
			</div> 

	</div> <!--//header sticky -->	
<!-- </div> --> 	
				










