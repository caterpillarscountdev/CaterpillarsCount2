<?php
	require_once('orm/User.php');
	require_once('orm/Survey.php');
	require_once('orm/resources/Keychain.php');
	
	$email = $_GET["email"];
	$salt = $_GET["salt"];
	$page = $_GET["page"];
	$filters = json_decode(rawurldecode($_GET["filters"]), true);
	$PAGE_LENGTH = 25;
	
	$user = User::findBySignInKey($email, $salt);
	if(is_object($user) && get_class($user) == "User"){
		$start = "last";
		if($page !== "last"){
			$start = ((intval($page) - 1) * $PAGE_LENGTH);
		}
		$surveys = Survey::findSurveysByUser($user, $filters, $start, $PAGE_LENGTH);
		$totalCount = $surveys[0];
		$totalPages = ceil($totalCount/$PAGE_LENGTH);
		$surveys = $surveys[1];
		$surveysArray = array();
		for($i = 0; $i < count($surveys); $i++){
			if(is_object($surveys[$i]) && get_class($surveys[$i]) == "Survey"){
				$arthropodSightings = $surveys[$i]->getArthropodSightings();
				$arthropodSightingsArray = array();
				for($j = 0; $j < count($arthropodSightings); $j++){
					if(is_object($arthropodSightings[$j]) && get_class($arthropodSightings[$j]) == "ArthropodSighting"){
						$arthropodSightingsArray[] = array(
							"id" => $arthropodSightings[$j]->getID(),
							"group" => $arthropodSightings[$j]->getGroup(),
							"length" => $arthropodSightings[$j]->getLength(),
							"quantity" => $arthropodSightings[$j]->getQuantity(),
							"photoURL" => $arthropodSightings[$j]->getPhotoURL(),
							"notes" => $arthropodSightings[$j]->getNotes(),
							"hairy" => $arthropodSightings[$j]->getHairy(),
							"rolled" => $arthropodSightings[$j]->getRolled(),
							"tented" => $arthropodSightings[$j]->getTented(),
						);
					}
				}
				$surveysArray[] = array(
					"id" => $surveys[$i]->getID(),
					"editable" => ($surveys[$i]->getPlant()->getSite()->isAuthority($user) || $surveys[$i]->getSubmissionTimestamp() >= (time() - (2 * 7 * 24 * 60 * 60)) || $user->getEmail() == "plocharczykweb@gmail.com" || $user->getEmail() == "hurlbert@bio.unc.edu"),
					"observerID" => $surveys[$i]->getObserver()->getID(),
					"observerFullName" => $surveys[$i]->getObserver()->getFullName(),
					"observerEmail" => $surveys[$i]->getObserver()->getEmail(),
					"plantCode" => $surveys[$i]->getPlant()->getCode(),
					"siteID" => $surveys[$i]->getPlant()->getSite()->getID(),
					"siteName" => $surveys[$i]->getPlant()->getSite()->getName(),
					"siteRegion" => $surveys[$i]->getPlant()->getSite()->getRegion(),
					"siteCoordinates" => $surveys[$i]->getPlant()->getSite()->getLatitude() . "," . $surveys[$i]->getPlant()->getSite()->getLongitude(),
					"circle" => $surveys[$i]->getPlant()->getCircle(),
					"orientation" => $surveys[$i]->getPlant()->getOrientation(),
					"color" => $surveys[$i]->getPlant()->getColor(),
					"localDate" => $surveys[$i]->getLocalDate(),
					"localTime" => $surveys[$i]->getLocalTime(),
					"observaionMethod" => $surveys[$i]->getObservationMethod(),
					"notes" => $surveys[$i]->getNotes(),
					"wetLeaves" => $surveys[$i]->getWetLeaves(),
					"plantSpecies" => $surveys[$i]->getPlantSpecies(),
					"numberOfLeaves" => $surveys[$i]->getNumberOfLeaves(),
					"averageLeafLength" => $surveys[$i]->getAverageLeafLength(),
					"herbivoryScore" => $surveys[$i]->getHerbivoryScore(),
					"submittedThroughApp" => $surveys[$i]->getSubmittedThroughApp(),
					"arthropodSightings" => $arthropodSightingsArray,
				);
			}
		}
		$sites = $user->getSites();
		$sitesArray = array();
		$dbconn = (new Keychain)->getDatabaseConnection();
		$query = mysqli_query($dbconn, "SELECT * FROM ArthropodSighting JOIN Survey ON ArthropodSighting.SurveyFK=Survey.ID JOIN Plant ON Survey.PlantFK=Plant.ID WHERE `UserFKOfObserver`='" . $user->getID() . "' AND PhotoURL<>'' AND SiteFK<>'2' LIMIT 1");
		$userHasINaturalistObservations = (mysqli_num_rows($query) > 0);
		for($i = 0; $i < count($sites); $i++){
			$query = mysqli_query($dbconn, "SELECT * FROM ArthropodSighting JOIN Survey ON ArthropodSighting.SurveyFK=Survey.ID JOIN Plant ON Survey.PlantFK=Plant.ID WHERE Plant.SiteFK='" . $sites[$i]->getID() . "' AND ArthropodSighting.PhotoURL<>'' AND Plant.SiteFK<>'2' LIMIT 1");
			$sitesArray[] = array($sites[$i]->getName(), (mysqli_num_rows($query) > 0));
		}
		mysqli_close($dbconn);
		die("true|" . json_encode(array($totalCount, $totalPages, $surveysArray, $sitesArray, $user->getINaturalistObserverID(), $userHasINaturalistObservations)));
	}
	die("false|Your log in dissolved. Maybe you logged in on another device.");
?>
