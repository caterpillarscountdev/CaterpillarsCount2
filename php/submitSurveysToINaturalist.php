<?php
	require_once('/opt/app-root/src/php/orm/resources/Keychain.php');
	require_once("/opt/app-root/src/php/submitToINaturalist.php");
	
	$dbconn = (new Keychain)->getDatabaseConnection();

	$BATCH_SIZE = 1;
	
	//Get batch
	$query = mysqli_query($dbconn, "SELECT ID FROM ArthropodSighting WHERE NeedToSendToINaturalist='1' LIMIT " . $BATCH_SIZE);
	$ids = array("0");
	if(mysqli_num_rows($query) > 0){
		while($idRow = mysqli_fetch_assoc($query)){
			$ids[] = $idRow["ID"];
		}
	}
	
	$idMatchSQL = "='" . $ids[1] . "'";
	if($BATCH_SIZE != 1){
		$idMatchSQL = " IN (" . implode(", ", $ids) . ")";
	}

	//Mark batch as completed
	mysqli_query($dbconn, "UPDATE ArthropodSighting SET NeedToSendToINaturalist='0' WHERE ID" . $idMatchSQL . " LIMIT " . $BATCH_SIZE);
	
	//Submit batch to iNaturalist
	$query = mysqli_query($dbconn, "SELECT ArthropodSighting.ID AS ArthropodSightingID, User.INaturalistObserverID, User.Hidden, Plant.Code, Survey.LocalDate, Survey.ObservationMethod, Survey.Notes AS SurveyNotes, Survey.WetLeaves, ArthropodSighting.Group, ArthropodSighting.Hairy, ArthropodSighting.Rolled, ArthropodSighting.Tented, ArthropodSighting.Quantity, ArthropodSighting.Length, ArthropodSighting.PhotoURL, ArthropodSighting.Notes AS ArthropodSightingNotes, Survey.NumberOfLeaves, Survey.AverageLeafLength, Survey.HerbivoryScore FROM `ArthropodSighting` JOIN Survey ON ArthropodSighting.SurveyFK=Survey.ID JOIN `User` ON Survey.UserFKOfObserver=`User`.ID JOIN Plant ON Survey.PlantFK=Plant.ID WHERE ArthropodSighting.ID" . $idMatchSQL . " LIMIT " . $BATCH_SIZE);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$observerID = $row["INaturalistObserverID"];
			if(filter_var($row["Hidden"], FILTER_VALIDATE_BOOLEAN)){
				$observerID = "anonymous";
			}
			submitINaturalistObservation($observerID, $row["Code"], $row["LocalDate"], $row["ObservationMethod"], $row["SurveyNotes"], filter_var($row["WetLeaves"], FILTER_VALIDATE_BOOLEAN), $row["Group"], filter_var($row["Hairy"], FILTER_VALIDATE_BOOLEAN), filter_var($row["Rolled"], FILTER_VALIDATE_BOOLEAN), filter_var($row["Tented"], FILTER_VALIDATE_BOOLEAN), intval($row["Quantity"]), intval($row["Length"]), "/" . $row["PhotoURL"], $row["ArthropodSightingNotes"], intval($row["NumberOfLeaves"]), intval($row["AverageLeafLength"]), intval($row["HerbivoryScore"]));
		}
	}
	mysqli_close($dbconn);
?>
