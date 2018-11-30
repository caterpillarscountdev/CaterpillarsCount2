<?php
	require_once('vendor/autoload.php');
	
	function email($to, $subject, $body, $attachments=array()){
		
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->Host = 'relay.unc.edu';

		$mail->From = "caterpillarscount@gmail.com";
		$mail->FromName = "Caterpillars Count!";
		$mail->addAddress($to);
		
		for($i = 0; $i < count($attachments); $i++){
			$mail->addAttachment($attachments[$i]);
		}
	
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = strip_tags($body);

		if($mail->send()){
	   		return true;
	  	} 
	  	return false;//"Mailer Error: " . $mail->ErrorInfo;
	}
  
  	function advancedEmail($to, $fromAddress, $fromName, $subject, $htmlBody, $altBody, $attachments=array()){
		$mail = new PHPMailer;
	  	$mail->IsSMTP();
	  	$mail->Host = 'relay.unc.edu';

	  	$mail->From = $fromAddress;
	  	$mail->FromName = $fromName;
	  	$mail->addAddress($to);
		
		for($i = 0; $i < count($attachments); $i++){
			$mail->addAttachment($attachments[$i]);
		}
		
	  	$mail->isHTML(true);
	  	$mail->Subject = $subject;
	  	$mail->Body = $htmlBody;
	  	$mail->AltBody = strip_tags($altBody);

	  	if($mail->send()){
	  	   return true;
	  	} 
	  	return false;//"Mailer Error: " . $mail->ErrorInfo;
	}

	function email4($to, $subject, $firstName){
		email($to, $subject, "<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> body{ margin:0px; height:100% !important; margin:0px !important; padding:0px !important; width:100% !important; } header{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg\"); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box; } #headerText{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderText.png\"); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%; } main{ padding:20px; max-width:565px; margin:auto; } .panel{ padding:10px 0px; border-bottom:2px solid #eaeaea; } .panel:last-of-type{ border-bottom:0px none transparent; } h1{ font-size: 24px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; text-align:center; } .panel img{ width:100%; padding:18px 0px; display:block; margin:auto; } p{ margin:0px; font-family: 'Merriweather', Georgia, \"Times New Roman\", serif; font-size:14px; padding:13px 0px; line-height:175%; } .tagline{ font-style:italic; } a{ color:#6faf6d; text-decoration:underline; } button{ border:0px none transparent; background:#89D085; padding:10px; font-size:18px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-weight:bold; color:#fff; border-radius:3px; display:block; margin:18px auto; cursor:pointer; } .note{ background:#89D085; padding:0px 18px; } .table{ display:table; } .cell{ display:table-cell; vertical-align:top; } footer{ padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%; } footer>div{ padding:9px 0px; } footer .icon{ padding:0px 9px; width:24px; } footer #copyrightLine{ font-style:italic; } footer a{ color:#fff; } .bold{ font-weight:bold; } .underlined{ text-decoration:underline; } .centeredText{ text-align:center; } @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <body> <header> <div id=\"headerText\"></div> </header> <main> <div class=\"panel\"> <p class=\"tagline centeredText\">Caterpillars Count! relies on citizen scientists (you!) to help understand some of the most important organisms in our ecosystems&ndash;caterpillars and other insects&ndash;by conducting surveys of the plants and trees around them.</p> <h1>The Season Is Here!</h1> <img src=\"https://caterpillarscount.unc.edu/images/participants_counting4.jpg\"/> <h1 style=\"text-align:left;\">Hi $firstName,</h1> <p>Leaves are out and surveying season is underway in your area! We see that you have registered as a Caterpillars Count! host site, but have not yet submitted any survey data.</p> <p>We just wanted to check in to see how you're doing with Caterpillars Count! and if you have any questions about the surveying process or using the mobile app or website to enter your data.</p> <p>We are here to support you! Check out the <a href=\"https://caterpillarscount.unc.edu/faq/\">FAQ</a>, ask a question on the <a href=\"https://groups.google.com/forum/embed/?place=forum%2Fcaterpillars-count&showsearch=true&showtabs=false&parenturl=https%3A%2F%2Fcaterpillarscount.unc.edu%2Ffaq%2F&theme=default#!forum/caterpillars-count\">Forum</a>, or shoot us an email anytime at <a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a>.</p> <p>Also, if you are using paper datasheets to collect data and have not yet entered your surveys, let us know. Remember to get that data entered as soon as you can, so you can make the most use of the <a href=\"https://caterpillarscount.unc.edu/mapsAndGraphs/\">visualization tools</a> on the website.</p> <p>All the best, and happy counting!</p> <p>The Caterpillars Count! Team</p></div> </main> <footer> <div> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\"/></a> </div> <div id=\"copyrightLine\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div> <div class=\"bold\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a></div> </div> <div>If your site is no longer active, please retire your site by visiting your <a href=\"https://caterpillarscount.unc.edu/manageMySites/\" target=\"_blank\">Manage My Sites</a> page, editing the site, unchecking the \"site will continue submitting surveys\" checkbox, and clicking \"Save Site Settings\".</div> </footer> </body> </html>");
	}
	
	function email5($to, $subject, $firstName){
		email($to, $subject, "<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> body{ margin:0px; height:100% !important; margin:0px !important; padding:0px !important; width:100% !important; } header{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg\"); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box; } #headerText{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderText.png\"); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%; } main{ padding:20px; max-width:565px; margin:auto; } .panel{ padding:10px 0px; border-bottom:2px solid #eaeaea; } .panel:last-of-type{ border-bottom:0px none transparent; } h1{ font-size: 24px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; text-align:center; } .panel img{ width:100%; padding:18px 0px; display:block; margin:auto; } p{ margin:0px; font-family: 'Merriweather', Georgia, \"Times New Roman\", serif; font-size:14px; padding:13px 0px; line-height:175%; } .tagline{ font-style:italic; } a{ color:#6faf6d; text-decoration:underline; } button{ border:0px none transparent; background:#89D085; padding:10px; font-size:18px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-weight:bold; color:#fff; border-radius:3px; display:block; margin:18px auto; cursor:pointer; } .note{ background:#89D085; padding:0px 18px; } .table{ display:table; } .cell{ display:table-cell; vertical-align:top; } footer{ padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%; } footer>div{ padding:9px 0px; } footer .icon{ padding:0px 9px; width:24px; } footer #copyrightLine{ font-style:italic; } footer a{ color:#fff; } .bold{ font-weight:bold; } .underlined{ text-decoration:underline; } .centeredText{ text-align:center; } @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <body> <header> <div id=\"headerText\"></div> </header> <main> <div class=\"panel\"> <p class=\"tagline centeredText\">Caterpillars Count! relies on citizen scientists (you!) to help understand some of the most important organisms in our ecosystems&ndash;caterpillars and other insects&ndash;by conducting surveys of the plants and trees around them.</p> <h1>We're Here To Help!</h1> <img src=\"https://caterpillarscount.unc.edu/images/trainingparticipants_thumbnail.jpg\"/> <h1 style=\"text-align:left;\">Hi $firstName,</h1> <p>Just checking in again to see if you need any support using the Caterpillars Count! tools or conducting surveys. We haven't yet seen any survey data come in for your site.</p> <p>If you are using paper datasheets to conduct your surveys, remember to enter your data regularly using the <a href=\"https://caterpillarscount.unc.edu/submitObservations/\">Submit Observations</a> page on the website, under the Participate tab. Once you have data entered for your site, you can use the visualization tools on the website.</p> <p>We do recommend you use the new and improved Caterpillars Count! app when conducting your surveys, if possible. The app has some built&ndash;in checks to ensure data quality, cuts down on data transcription errors and eliminates a step in data entry &ndash; any data entered in the field will be saved in the app and automatically upload when you reconnect to wifi.</p> <p>Remember, we are here to support you! Check out the <a href=\"https://caterpillarscount.unc.edu/faq/\">FAQ</a>, ask a question on the <a href=\"https://groups.google.com/forum/embed/?place=forum%2Fcaterpillars-count&showsearch=true&showtabs=false&parenturl=https%3A%2F%2Fcaterpillarscount.unc.edu%2Ffaq%2F&theme=default#!forum/caterpillars-count\">Forum</a>, or shoot us an email at <a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a>.</p> <p>All the best, and happy counting!</p> <p>The Caterpillars Count! Team</p> </div> </main> <footer> <div> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\"/></a> </div> <div id=\"copyrightLine\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div> <div class=\"bold\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a></div> </div> <div>If your site is no longer active, please retire your site by visiting your <a href=\"https://caterpillarscount.unc.edu/manageMySites/\" target=\"_blank\">Manage My Sites</a> page, editing the site, unchecking the \"site will continue submitting surveys\" checkbox, and clicking \"Save Site Settings\".</div> </footer> </body> </html>");
	}
	
	function email6($to, $subject, $siteName){
		email($to, $subject, "<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <div style=\"height:100%;margin:0;padding:0;width:100%\"> <header style=\"background-image:url('http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg'); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box;\"> <div id=\"headerText\" style=\"background-image:url('http://caterpillarscount.unc.edu/images/emailHeaderText.png'); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%;\"></div> </header> <main style=\"padding:20px; max-width:565px; margin:auto;\"> <div class=\"panel\" style=\"padding:10px 0px;border-bottom:2px solid #eaeaea;\"> <p class=\"tagline centeredText\" style=\"font-style:italic;margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;text-align:center;\">Caterpillars Count! relies on citizen scientists (you!) to help understand some of the most important organisms in our ecosystems&ndash;caterpillars and other insects&ndash;by conducting surveys of the plants and trees around them.</p> <h1 style=\"font-size: 24px; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center;\">It's Been a While!</h1> <img src=\"https://caterpillarscount.unc.edu/images/getOutThere.jpg\" style=\"width:100%; padding:18px 0px; display:block; margin:auto;\"/> <h1 style=\"font-size: 24px; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;\">Hi there!</h1> <p style=\"margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;\">Thank you so much for participating in Caterpillars Count! We noticed that you submitted data earlier in the season, but that it has been a couple of weeks since you last submitted surveys. We just wanted to touch base and make sure you haven't been encountering any issues.</p> <p style=\"margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;\">Let us know if there's anything that we can help you with by asking a question on the <a href=\"https://groups.google.com/forum/embed/?place=forum%2Fcaterpillars-count&showsearch=true&showtabs=false&parenturl=https%3A%2F%2Fcaterpillarscount.unc.edu%2Ffaq%2F&theme=default#!forum/caterpillars-count\" style=\"color:#6faf6d;text-decoration:underline;\">Forum</a>, or sending us an email at <a href=\"mailto:caterpillarscount@gmail.com\" style=\"color:#6faf6d;text-decoration:underline;\">caterpillarscount@gmail.com</a>. You also may find answers to common questions on our <a href=\"https://caterpillarscount.unc.edu/faq/\" style=\"color:#6faf6d;text-decoration:underline;\">FAQ</a>.</p> <p style=\"margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;\">Your contributions are important to help us understand the seasonal variations in caterpillars, spiders, beetles, and other \"bugs\" at $siteName. We hope you will continue sharing your caterpillar (and other arthropod) counts!</p> <p style=\"margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;\">All the best,</p> <p style=\"margin:0px; font-family: 'Merriweather', Georgia, 'Times New Roman', serif; font-size:14px; padding:13px 0px; line-height:175%;\">The Caterpillars Count! Team</p> </div> </main> <footer style=\"padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%;\"> <div style=\"padding:9px 0px;\"> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\" style=\"color:#fff;text-decoration:underline;\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\" style=\"padding:0px 9px;width:24px;\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\" style=\"color:#fff;text-decoration:underline;\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\" style=\"padding:0px 9px;width:24px;\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\" style=\"color:#fff;text-decoration:underline;\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\" style=\"padding:0px 9px;width:24px;\"/></a> </div> <div id=\"copyrightLine\" style=\"font-style:italic;padding:9px 0px;\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div style=\"padding:9px 0px;\"> <div class=\"bold\" style=\"font-weight:bold;\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\" style=\"color:#fff;text-decoration:underline;\">caterpillarscount@gmail.com</a></div> </div> <div style=\"padding:9px 0px;\">If your site is no longer active, please retire your site by visiting your <a href=\"https://caterpillarscount.unc.edu/manageMySites/\" target=\"_blank\" style=\"color:#fff;text-decoration:underline;\">Manage My Sites</a> page, editing the site, unchecking the \"site will continue submitting surveys\" checkbox, and clicking \"Save Site Settings\".</div> </footer> </div>");
		      //"<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> body{ margin:0px; height:100% !important; margin:0px !important; padding:0px !important; width:100% !important; } header{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg\"); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box; } #headerText{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderText.png\"); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%; } main{ padding:20px; max-width:565px; margin:auto; } .panel{ padding:10px 0px; border-bottom:2px solid #eaeaea; } .panel:last-of-type{ border-bottom:0px none transparent; } h1{ font-size: 24px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; text-align:center; } .panel img{ width:100%; padding:18px 0px; display:block; margin:auto; } p{ margin:0px; font-family: 'Merriweather', Georgia, \"Times New Roman\", serif; font-size:14px; padding:13px 0px; line-height:175%; } .tagline{ font-style:italic; } a{ color:#6faf6d; text-decoration:underline; } button{ border:0px none transparent; background:#89D085; padding:10px; font-size:18px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-weight:bold; color:#fff; border-radius:3px; display:block; margin:18px auto; cursor:pointer; } .note{ background:#89D085; padding:0px 18px; } .table{ display:table; } .cell{ display:table-cell; vertical-align:top; } footer{ padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%; } footer>div{ padding:9px 0px; } footer .icon{ padding:0px 9px; width:24px; } footer #copyrightLine{ font-style:italic; } footer a{ color:#fff; } .bold{ font-weight:bold; } .underlined{ text-decoration:underline; } .centeredText{ text-align:center; } @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <body> <header> <div id=\"headerText\"></div> </header> <main> <div class=\"panel\"> <p class=\"tagline centeredText\">Caterpillars Count! relies on citizen scientists (you!) to help understand some of the most important organisms in our ecosystems&ndash;caterpillars and other insects&ndash;by conducting surveys of the plants and trees around them.</p> <h1>It's Been a While!</h1> <img src=\"https://caterpillarscount.unc.edu/images/getOutThere.jpg\"/> <h1 style=\"text-align:left;\">Hi there!</h1> <p>Thank you so much for participating in Caterpillars Count! We noticed that you submitted data earlier in the season, but that it has been a couple of weeks since you last submitted surveys. We just wanted to touch base and make sure you haven't been encountering any issues.</p> <p>Let us know if there's anything that we can help you with by asking a question on the <a href=\"https://groups.google.com/forum/embed/?place=forum%2Fcaterpillars-count&showsearch=true&showtabs=false&parenturl=https%3A%2F%2Fcaterpillarscount.unc.edu%2Ffaq%2F&theme=default#!forum/caterpillars-count\">Forum</a>, or sending us an email at <a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a>. You also may find answers to common questions on our <a href=\"https://caterpillarscount.unc.edu/faq/\">FAQ</a>.</p> <p>Your contributions are important to help us understand the seasonal variations in caterpillars, spiders, beetles, and other \"bugs\" at $siteName. We hope you will continue sharing your caterpillar (and other arthropod) counts!</p> <p>All the best,</p> <p>The Caterpillars Count! Team</p> </div> </main> <footer> <div> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\"/></a> </div> <div id=\"copyrightLine\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div> <div class=\"bold\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a></div> </div> <div>If your site is no longer active, please retire your site by visiting your <a href=\"https://caterpillarscount.unc.edu/manageMySites/\" target=\"_blank\">Manage My Sites</a> page, editing the site, unchecking the \"site will continue submitting surveys\" checkbox, and clicking \"Save Site Settings\".</div> </footer> </body> </html>");
	}
	
	function email7($to, $subject, $userCount, $surveyCount, $siteName, $arthropodCount, $caterpillarCount, $siteID){
		$userCountS = "";
		if(intval($userCount) != 1){
			$userCountS = "s";
		}
		
		$surveyCountS = "";
		if(intval($surveyCount) != 1){
			$surveyCountS = "s";
		}
		
		$arthropodCountS = "";
		if(intval($arthropodCount) != 1){
			$arthropodCountS = "s";
		}
		
		$caterpillarCountS = "";
		if(intval($caterpillarCount) != 1){
			$caterpillarCountS = "s";
		}
		$caterpillarClause = "";
		if(intval($caterpillarCount) > 0){
			$caterpillarClause = ", including <span class=\"bold\">$caterpillarCount</span> caterpillar" . $caterpillarCountS;
		}
		email($to, $subject, "<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> body{ margin:0px; height:100% !important; margin:0px !important; padding:0px !important; width:100% !important; } header{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg\"); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box; } #headerText{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderText.png\"); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%; } main{ padding:20px; max-width:565px; margin:auto; } .panel{ padding:10px 0px; border-bottom:2px solid #eaeaea; } .panel:last-of-type{ border-bottom:0px none transparent; } h1{ font-size: 24px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; text-align:center; } .panel img{ width:100%; padding:18px 0px; display:block; margin:auto; } p{ margin:0px; font-family: 'Merriweather', Georgia, \"Times New Roman\", serif; font-size:14px; padding:13px 0px; line-height:175%; } .tagline{ font-style:italic; } a{ color:#6faf6d; text-decoration:underline; } button{ border:0px none transparent; background:#89D085; padding:10px; font-size:18px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-weight:bold; color:#fff; border-radius:3px; display:block; margin:18px auto; cursor:pointer; } .note{ background:#89D085; padding:0px 18px; } .table{ display:table; padding:18px 0px; } .cell{ display:table-cell; vertical-align:top; padding:0px 20px; box-sizing:border-box; } .cell:first-of-type{ padding-left:0px; } .cell:last-of-type{ padding-right:0px; } footer{ padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%; } footer>div{ padding:9px 0px; } footer .icon{ padding:0px 9px; width:24px; } footer #copyrightLine{ font-style:italic; } footer a{ color:#fff; } .bold{ font-weight:bold; } .underlined{ text-decoration:underline; } .centeredText{ text-align:center; } #surveyPageOverlay{ position:absolute; top:30%; left:0px; width:100%; padding-right:inherit; box-sizing:border-box; text-align:center; font-size:24px; font-family:'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight:bold; color:#333; } @media screen and (max-width: 418px){ #surveyPageOverlay{ font-size:14px; } } @media screen and (max-width: 300px){ #surveyPageOverlay{ font-size:10px; } } @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <body> <header> <div id=\"headerText\"></div> </header> <main> <div class=\"panel\"> <h1>Thank You for Participating in Caterpillars Count!</h1> <p class=\"tagline centeredText\">Caterpillars Count! relies on citizen scientists (you!) to help understand some of the most important organisms in our ecosystems&ndash;caterpillars and other insects&ndash;by conducting surveys of the plants and trees around them.</p> <img src=\"https://caterpillarscount.unc.edu/images/participating.jpg\"/> </div> <div class=\"panel\"> <div class=\"table\"> <div class=\"cell\" style=\"width:25%;\"> <div style=\"position:relative;\"> <img src=\"https://caterpillarscount.unc.edu/images/shadedPage.png\" style=\"padding:0px;\"/> <div id=\"surveyPageOverlay\"><div style=\"padding:0px 5px;\">&#10004; $surveyCount</div></div> </div> </div> <div class=\"cell\"> <h1 style=\"text-align:left;\">Look at Your Surveys!</h1> <p>Over the past week, <span class=\"bold\">$userCount</span> different user" . $userCountS . " submitted <span class=\"bold\">$surveyCount</span> total survey" . $surveyCountS . " at $siteName.</p> </div> </div> </div> <div class=\"panel\"> <div class=\"table\"> <div class=\"cell\" style=\"width:25%;position:relative;\"> <img src=\"https://caterpillarscount.unc.edu/images/chartRise.png\" style=\"padding:0px;\"/> <!--<div style=\"background-image:url('rise.png');background-size:cover;background-position:center;background-repeat:no-repeat;border-radius:10px;overflow:hidden;height:150px;\"></div>--> <div style=\"position:absolute;top:-3%;right:7%;padding-right:inherit;box-sizing:border-box;font-size:11px;font-family:'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold;color:#ddd;\"><div style=\"padding:0px 5px;\">$arthropodCount</div></div> </div> <div class=\"cell\"> <h1 style=\"text-align:left;\">And Your Arthropods!</h1> <p>$siteName found a total of <span class=\"bold\">$arthropodCount</span> arthropod" . $arthropodCountS . $caterpillarClause . "!</p> </div> </div> </div> <div class=\"panel\"> <h1>Want More?</h1> <img src=\"https://caterpillarscount.unc.edu/images/examine.jpg\"/> <a href=\"https://caterpillarscount.unc.edu/mapsAndGraphs/#selectedPhenology" . $siteID . "\" style=\"text-decoration:none;\"><button>Get a complete summary of all arthropods seen to date!</button></a> </div> <div class=\"panel\"> <p class=\"centeredText\">Keep up the countin'!</p> <p class=\"centeredText bold\" style=\"padding-top:0px;\">&ndash;The Caterpillars Count! Team</p> </div> </main> <footer> <div> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\"/></a> </div> <div id=\"copyrightLine\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div> <div class=\"bold\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a></div> </div> <div>If your site is no longer active, please retire your site by visiting your <a href=\"https://caterpillarscount.unc.edu/manageMySites/\" target=\"_blank\">Manage My Sites</a> page, editing the site, unchecking the \"site will continue submitting surveys\" checkbox, and clicking \"Save Site Settings\".</div> </footer> </body> </html>");
	}
	
	function r($search, $replace, $subject){
		return str_replace($search, $replace, $subject);
	}
	function myUrlEncode($string) {
	    return r(" ", "%20", r(">", "%3E", r("!", "%21", r("*", "%2A", r("(", "%28", r(")", "%29", r(";", "%3B", r(":", "%3A", r("@", "%40", r("&", "%26", r("=", "%3D", r("+", "%2B", r("$", "%24", r(",", "%2C", r("/", "%2F", r("?", "%3F", r("%", "%25", $string)))))))))))))))));
	}
    	function cleanParam($param){
		$param = myUrlEncode(preg_replace('!\s+!', ' ', trim(preg_replace('/[^a-zA-Z0-9.!*();:@&=+$,\/?%>-]/', ' ', trim((string)$param)))));
		if($param == ""){
			return "None";
		}
		return $param;
	}
	function email8($to, $subject, $sites, $arthropodCount, $caterpillarCount, $iNaturalistObserverID, $userHasINaturalistObservations){
		$sitesNameString = "";
		if(count($sites) == 1){
			$sitesNameString = $sites[0]->getName();
		}
		else if(count($sites) == 2){
			$sitesNameString = $sites[0]->getName() . " and " . $sites[1]->getName();
		}
		else{
			for($i = 0; $i < count($sites); $i++){
				if($i == (count($sites) - 1)){
					$sitesNameString .= "and " . $sites[$i]->getName();
				}
				else{
					$sitesNameString .= $sites[$i]->getName() . ", ";
				}
			}
		}
		
		$arthropodCountS = "";
		if(intval($arthropodCount) != 1){
			$arthropodCountS = "s";
		}
		
		$caterpillarCountS = "";
		if(intval($caterpillarCount) != 1){
			$caterpillarCountS = "s";
		}
		
		$caterpillarClause = "";
		if(intval($caterpillarCount) > 0){
			$caterpillarClause = ", including <span class=\"bold\">$caterpillarCount</span> caterpillar" . $caterpillarCountS;
		}
		
		$siteParagraphs = "";
		for($i = 0; $i < count($sites); $i++){
			$siteParagraphs .= "<p>Click <a href=\"https://caterpillarscount.unc.edu/mapsAndGraphs/#selected" . $sites[$i]->getID() . "\">here</a> for a summary of all arthropods seen at " . $sites[$i]->getName() . ".</p>";
			$siteParagraphs .= "<p>Click <a href=\"https://www.inaturalist.org/observations?place_id=any&subview=grid&field:Site%20Name=" . cleanParam($sites[$i]->getName()) . "\">here</a> to see all participants' photos submitted from " . $sites[$i]->getName() . " which were submitted to iNaturalist.</p>";
		}
		
		$usersINaturalistParagraph = "Remember that any arthropod photos you take with the app as a part of your surveys get sent automatically to <a href=\"https://www.inaturalist.org/\">iNaturalist.org</a> where they might get identified by experts!";
		if($userHasINaturalistObservations){
			$usersINaturalistParagraph = "<p><a href=\"https://www.inaturalist.org/observations?field:Caterpillars%20Count!%20Observer=" . $iNaturalistObserverID . "\">Here</a> is a link to arthropod photos you have taken which were submitted to iNaturalist. Maybe someone has identified them for you!</p>";
		}
		
		email($to, $subject, "<html> <head> <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width\" /> <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\"> <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:700\" rel=\"stylesheet\"> <style> body{ margin:0px; height:100% !important; margin:0px !important; padding:0px !important; width:100% !important; } header{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderBackground.jpg\"); background-size:cover; background-position:center; background-repeat:no-repeat; height:164px; background-color:#eee; padding:40px 20px; box-sizing:border-box; } #headerText{ background-image:url(\"http://caterpillarscount.unc.edu/images/emailHeaderText.png\"); background-size:contain; background-position:center; background-repeat:no-repeat; height:100%; width:100%; } main{ padding:20px; max-width:565px; margin:auto; } .panel{ padding:10px 0px; border-bottom:2px solid #eaeaea; } .panel:last-of-type{ border-bottom:0px none transparent; } h1{ font-size: 24px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; text-align:center; } .panel img{ width:100%; padding:18px 0px; display:block; margin:auto; } p{ margin:0px; font-family: 'Merriweather', Georgia, \"Times New Roman\", serif; font-size:14px; padding:13px 0px; line-height:175%; } .tagline{ font-style:italic; } a{ color:#6faf6d; text-decoration:underline; } button{ border:0px none transparent; background:#89D085; padding:10px; font-size:18px; font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-weight:bold; color:#fff; border-radius:3px; display:block; margin:18px auto; cursor:pointer; } .note{ background:#89D085; padding:0px 18px; } .table{ display:table; padding:18px 0px; } .cell{ display:table-cell; vertical-align:top; padding:0px 20px; box-sizing:border-box; } .cell:first-of-type{ padding-left:0px; } .cell:last-of-type{ padding-right:0px; } footer{ padding:45px 18px 63px 18px; background:#083000; text-align:center; color:#fff; font-family: Helvetica; font-size:12px; line-height:150%; } footer>div{ padding:9px 0px; } footer .icon{ padding:0px 9px; width:24px; } footer #copyrightLine{ font-style:italic; } footer a{ color:#fff; } .bold{ font-weight:bold; } .underlined{ text-decoration:underline; } .centeredText{ text-align:center; } #surveyPageOverlay{ position:absolute; top:30%; left:0px; width:100%; padding-right:inherit; box-sizing:border-box; text-align:center; font-size:24px; font-family:'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight:bold; color:#333; } .cell:first-of-type{ width:50%; } .cell:first-of-type{ width:30%; } @media screen and (max-width: 445px){ .cell:first-of-type{ width:25%; } } @media screen and (max-width: 360px){ .cell:first-of-type{ width:20%; } } @media screen and (max-width: 555px){ header{ height:110px; padding:25 20px; } } </style> </head> <body> <header> <div id=\"headerText\"></div> </header> <main> <div class=\"panel\"> <h1>Thank you for submitting one or more Caterpillars Count! surveys this past week!</h1> <img src=\"https://caterpillarscount.unc.edu/images/chart.png\"/> <p class=\"centeredText\" style=\"background:#444;border-radius:4px;color:#fff;padding:18px;margin-top:-18px;\">Your participation is helping to characterize the seasonal variation in caterpillars, spiders, beetles, and other \"bugs\" at $sitesNameString.</p> </div> <div class=\"panel\"> <div class=\"table\"> <div class=\"cell\"> <img src=\"https://caterpillarscount.unc.edu/images/blackTrueBugLine.png\" style=\"padding:0px;\"/> </div> <div class=\"cell\"> <h1 style=\"text-align:left;\">Look at Your Arthropods!</h1> <p>This week you found <span class=\"bold\">$arthropodCount</span> total arthropod" . $arthropodCountS . $caterpillarClause . "!</p> $usersINaturalistParagraph </div> </div> </div> <div class=\"panel\"> <div class=\"table\"> <div class=\"cell\"> <img src=\"https://caterpillarscount.unc.edu/images/blackFlyLine.png\" style=\"padding:0px;\"/> <!--<div style=\"background-image:url('rise.png');background-size:cover;background-position:center;background-repeat:no-repeat;border-radius:10px;overflow:hidden;height:150px;\"></div>--> </div> <div class=\"cell\"> <h1 style=\"text-align:left;\">And Other Participants' Arthropods!</h1> $siteParagraphs </div> </div> </div> <div class=\"panel\"> <h1>Want More?</h1> <img src=\"https://caterpillarscount.unc.edu/images/rainbowBars.png\"/> <a href=\"https://caterpillarscount.unc.edu/mapsAndGraphs\" style=\"text-decoration:none;\"><button>Dive Deeper on Our Maps &amp; Graphs Page!</button></a> </div> <div class=\"panel\"> <p class=\"centeredText\">Keep up the countin'!</p> <p class=\"centeredText bold\" style=\"padding-top:0px;\">&ndash;The Caterpillars Count! Team</p> </div> </main> <footer> <div> <a href=\"https://www.facebook.com/Caterpillars-Count-1854259101283140/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailFacebookIcon.png\"/></a> <a href=\"https://twitter.com/CaterpillarsCt\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailTwitterIcon.png\"/></a> <a href=\"https://caterpillarscount.unc.edu/\" target=\"_blank\"><img class=\"icon\" src=\"https://caterpillarscount.unc.edu/images/emailLinkIcon.png\"/></a> </div> <div id=\"copyrightLine\">Copyright &copy; 2018 Caterpillars Count!, All rights reserved.</div> <div> <div class=\"bold\">Caterpillars Count!</div> <div>University of North Carolina at Chapel Hill</div> <div><a href=\"mailto:caterpillarscount@gmail.com\">caterpillarscount@gmail.com</a></div> </div> </footer> </body> </html>");
	}
?>
