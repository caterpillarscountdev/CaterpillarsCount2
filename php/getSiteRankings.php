<?php
	require_once('orm/resources/Keychain.php');
	require_once('orm/Site.php');
	
	$dbconn = (new Keychain)->getDatabaseConnection();
	$query = mysqli_query($dbconn, "SELECT Site.ID, Site.Name, Site.Region, Site.Latitude, Site.Longitude, Site.OpenToPublic, SUM(CASE WHEN Survey.SubmissionTimestamp >= UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)) THEN 1 ELSE 0 END) AS Week, SUM(CASE WHEN Survey.SubmissionTimestamp >= UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(DATE_FORMAT(CURDATE(),'%Y-%m'), '-01 00:00:00'), '%Y-%m-%d %T')) THEN 1 ELSE 0 END) AS Month, SUM(CASE WHEN Survey.SubmissionTimestamp >= UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-01-01 00:00:00'), '%Y-%m-%d %T')) THEN 1 ELSE 0 END) AS Year, Count(*) AS Total, COUNT(DISTINCT Survey.LocalDate) AS TotalUniqueDates FROM Survey JOIN Plant ON Survey.PlantFK=Plant.ID JOIN Site ON Plant.SiteFK=Site.ID WHERE Site.ID<>2 GROUP BY Site.ID ORDER BY Year DESC");
		
	$rankingsArray = array();
  	$i = 1;
	while($row = mysqli_fetch_assoc($query)){
    		$openToPublic = $row["OpenToPublic"];
		$rankingsArray[strval($row["ID"])] = array(
      			"Rank" => $i++,
      			"Name" => $row["Name"] . " (" . $row["Region"] . ")",
      			"Coordinates" => $row["Latitude"] . "," . $row["Longitude"],
      			"Week" => $row["Week"],
			"UniqueDatesThisWeek" => 0,
      			"Month" => $row["Month"],
			"UniqueDatesThisMonth" => 0,
      			"LastYear" => $row["LastYear"],
			"UniqueDatesThisYear" => 0,
      			"Total" => $row["Total"],
      			"TotalUniqueDates" => $row["TotalUniqueDates"],
    		);
	}
	
	$query = mysqli_query($dbconn, "SELECT Plant.SiteFK, COUNT(DISTINCT LocalDate) AS UniqueDatesThisWeek FROM Survey JOIN Plant ON Survey.PlantFK=Plant.ID WHERE Survey.LocalDate >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) GROUP BY Plant.SiteFK");
	while($row = mysqli_fetch_assoc($query)){
		$rankingsArray[strval($row["SiteFK"])]["UniqueDatesThisWeek"] = $row["UniqueDatesThisWeek"];
	}

	$query = mysqli_query($dbconn, "SELECT Plant.SiteFK, COUNT(DISTINCT LocalDate) AS UniqueDatesThisMonth FROM Survey JOIN Plant ON Survey.PlantFK=Plant.ID WHERE Survey.LocalDate >= STR_TO_DATE(CONCAT(DATE_FORMAT(CURDATE(),'%Y-%m'), '-01 00:00:00'), '%Y-%m-%d %T') GROUP BY Plant.SiteFK");
	while($row = mysqli_fetch_assoc($query)){
		$rankingsArray[strval($row["SiteFK"])]["UniqueDatesThisMonth"] = $row["UniqueDatesThisMonth"];
	}

	$query = mysqli_query($dbconn, "SELECT Plant.SiteFK, COUNT(DISTINCT LocalDate) AS UniqueDatesThisYear FROM Survey JOIN Plant ON Survey.PlantFK=Plant.ID WHERE Survey.LocalDate >= STR_TO_DATE(CONCAT(YEAR(CURDATE()), "-01-01 00:00:00"), '%Y-%m-%d %T') GROUP BY Plant.SiteFK");
	while($row = mysqli_fetch_assoc($query)){
		$rankingsArray[strval($row["SiteFK"])]["UniqueDatesThisYear"] = $row["UniqueDatesThisYear"];
	}
	mysqli_close($dbconn);
	
	$allSites = Site::findAll();
	for($j = 0; $j < count($allSites); $j++){
		if(is_object($allSites[$j]) && get_class($allSites[$j]) == "Site" && $allSites[$j]->getID() != 2 && !array_key_exists(strval($allSites[$j]->getID()), $rankingsArray)){
			$coordinates = "NONE";
			if($allSites[$j]->getOpenToPublic()){
				$coordinates = $allSites[$j]->getLatitude() . "," . $allSites[$j]->getLongitude();
			}
			$rankingsArray[strval($allSites[$j]->getID())] = array(
				"Rank" => $i++,
				"Name" => $allSites[$j]->getName() . " (" . $allSites[$j]->getRegion() . ")",
				"Coordinates" => $coordinates,
				"Week" => 0,
				"UniqueDatesThisWeek" => 0,
				"Month" => 0,
				"UniqueDatesThisMonth" => 0,
				"Year" => 0,
				"UniqueDatesThisYear" => 0,
				"Total" => 0,
      				"TotalUniqueDates" => 0,
			);
		}
	}

	die(json_encode($rankingsArray));
	
?>
