<html>
	<head>
		<!-- Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113319025-1"></script>
		<script>
  			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());
			gtag('config', 'UA-113319025-1');
		</script>
		<!-- End of Google Analytics -->

		<title>We Have a New Website! | Caterpillars Count!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Fanwood+Text:400i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
		<link href="../css/template.css" rel="stylesheet">
		<script src="../js/template.js?v=1"></script>
		<script>
			$(document).ready(function(){
				loadBackgroundImage($("#splashImage"), "../images/splash.png");
			});
		</script>
	</head>
	<body>
		<div id="splash">
			<div id="splashImage"></div>
			<div id="splashOverlay">
				<div id="splashIntroText">Welcome to</div>
				<div id="splashMainText">Caterpillars Count!</div>
				<button id="splashButton" onclick="this.blur();scrollToPanel(1);">We Have a New Website!</button>
			</div>
		</div>
		<header>
			<h1><a href="../">Caterpillars Count!</a></h1>
			<div id="hamburger" onclick="toggleNav();">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div id="navKnockDown" class="clearBoth"></div>
			<nav class="loadingNav">
				<ul>
					<li onclick="accessSubMenu(this);">
						<span>Participate</span>
						<ul onclick="event.stopPropagation();">
							<li class="closeSubmenu" onclick="closeSubmenu(this.parentNode);"><img src="../images/arrow.png"/></li>
							<li><a href="../getStarted">Get Started</a></li>
							<li><a href="../conductASurvey">Conduct a Survey</a></li>
							<li><a href="../submitObservations">Submit Observations</a></li>
							<li><a href="../hostASurveySite">Host a Survey Site</a></li>
							<li><a href="../resources">Resources</a></li>
						</ul>
					</li>
					<li onclick="accessSubMenu(this);">
						<span>Explore</span>
						<ul onclick="event.stopPropagation();">
							<li class="closeSubmenu" onclick="closeSubmenu(this.parentNode);"><img src="../images/arrow.png"/></li>
							<li><a href="../mapsAndGraphs">Maps & Graphs</a></li>
							<li><a href="https://www.inaturalist.org/observations?place_id=any&subview=grid&user_id=caterpillarscount&verifiable=any">Recent Observations</a></li>
						</ul>
					</li>
					<li onclick="accessSubMenu(this);">
						<span>Learn</span>
						<ul onclick="event.stopPropagation();">
							<li class="closeSubmenu" onclick="closeSubmenu(this.parentNode);"><img src="../images/arrow.png"/></li>
							<li><a href="../identificationSkills">Identification Skills</a></li>
							<li><a href="../forEducators">For Educators</a></li>
							<li><a href="../faq">FAQ</a></li>
						</ul>
					</li>
					<li onclick="window.location = '../news';">
						<span>News</span>
					</li>
					<li onclick="window.location = '../signIn';">
						<span>Sign In</span>
						<ul onclick="event.stopPropagation();">
							<li class="closeSubmenu" onclick="closeSubmenu(this.parentNode);"><img src="../images/arrow.png"/></li>
							<li><a href="../createNewSite">Create New Site</a></li>
							<li><a href="../manageMySites">Manage My Sites</a></li>
							<li><a href="../manageMySurveys">Manage My Surveys</a></li>
							<li><a href="../settings">Settings</a></li>
							<li><a href="" onclick="logOut();">Sign Out</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<div id="navBack" onclick="resetMenu(false);">&#10094;</div>
		</header>
		<main>
			<div class="panel">
				<h2>We Have a New Website!</h2>
				<div class="tagline">And we would love to share it with you.</div>
				<div class="content">
          				<p>Somehow you've used our old website to sign up for an old Caterpillars Count! account. Please <a href="https://caterpillarscount.unc.edu/signUp">click here</a> to sign up for our new website instead. It's quick and simple.</p>
          				<button onclick="window.location = 'https://caterpillarscount.unc.edu/signUp';">Sign up for our new website!</button>
        			</div>
			</div>
		</main>
		<footer>
			<div>Part of the <a href="http://pheno-mismatch.org" target="_blank">Pheno Mismatch</a> project funded by the National Science Foundation</div>

			<div><img src="../images/unc.png"/></div><div>
				<a target="_blank" href="https://www.facebook.com/Caterpillars-Count-1854259101283140/"><img src="../images/facebook.png" alt="facebook"/></a><a target="_blank" href="https://twitter.com/CaterpillarsCt"><img src="../images/twitter.png" alt="twitter"/></a>
			</div>

			<div>Contact us: <a href="mailto:caterpillarscount@gmail.com">caterpillarscount@gmail.com</a></div>

			<div>View our <a href="../privacyPolicy">privacy policy</a></div>
		</footer>
	</body>
</html>
