<html>
  <head>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      function findOldSiteAndSubmitOldSurvey(plantCode, siteNotes, plantSpecies, herbivoryScore, observationMethod, numberOfLeaves, date, time, arthropodData){
	//get info by plant code
	$.get("https://caterpillarscount.unc.edu/php/getPlantCodeInfo.php?code=" + encodeURIComponent(plantCode) + "&email=" + encodeURIComponent(window.localStorage.getItem("email")) + "&salt=" + window.localStorage.getItem("salt"), function(data){
		//success
		if(data.indexOf("true|") == 0){
//alert("got plant code info");
			var newInfo = JSON.parse(data.replace("true|", ""));
			
			//get all old sites
			$.ajax({
 		    	url: "http://master-caterpillars.vipapps.unc.edu/api/sites.php",
 		    	type: "post",
  		   		dataType: "json",
      			data: JSON.stringify({action: "getAll"}),
      			success: function (sites, xhr, status) {
//alert("got all old sites");
      		  		var oldSiteID = -1;
      		  		for (var i = 0; i < sites.length; i++) {
      		  			if(newInfo["siteName"].trim().toLowerCase() == sites[i].siteName.trim().toLowerCase() && Math.abs(newInfo["latitude"] - sites[i].siteLat) < 0.01 && Math.abs(newInfo["longitude"] - sites[i].siteLong) < 0.01){
      		  				//match
      		  				oldSiteID = sites[i].siteID;
      		  				submitOldSurvey(oldSiteID, newInfo["circle"], newInfo["orientation"], siteNotes, plantSpecies, herbivoryScore, observationMethod, numberOfLeaves, date, time, arthropodData);
      		  				break;
      		  			}
  					}
  					if(oldSiteID < 0){
  						//no match
  						var data = {
							action: "create",
							email: "caterpillarscountdev@gmail.com",
							password: "opendevpass",
							siteName: newInfo["siteName"],
							siteState: newInfo["region"],
							siteLat: newInfo["latitude"],
							siteLong: newInfo["longitude"],
							siteDescription: newInfo["siteDescription"],
							sitePassword: "opendevpass",
							numCircles: newInfo["circleCount"]
						};
				
						//create site
						$.ajax({
							url: 'http://master-caterpillars.vipapps.unc.edu/api/sites.php',
							type: 'POST',
							dataType: "json",
							data: JSON.stringify(data),
							processData: false,
							success: function (data) {
//alert("created site");
								oldSiteID = data.siteID;
  								submitOldSurvey(oldSiteID, newInfo["circle"], newInfo["orientation"], siteNotes, plantSpecies, herbivoryScore, observationMethod, numberOfLeaves, date, time, arthropodData);
							},
							error: function (e) {
//alert("SITE CREATION ERROR: " + e);
							}
						});
  					}
        		},
        		error: function (xhr, status) {
//alert("GET SITES ERROR");
        		}
    		});
		}
		else{
//alert("GET PLANT CODE INFO ERROR: " + data);
		}
	})
	.fail(function(){
		//error
//alert("GET PLANT CODE INFO ERROR");
	});
}
function submitOldSurvey(oldSiteID, circle, orientation, siteNotes, plantSpecies, herbivoryScore, observationMethod, numberOfLeaves, date, time, arthropodData){
//alert("submitting old survey");
	if(observationMethod != "Visual"){observationMethod = "Beat_Sheet";}
	
	//submit old survey
	$.ajax({
		url: "http://master-caterpillars.vipapps.unc.edu/api/submission_full.php",
		type : "POST",
		crossDomain: true,
		dataType: 'json',
		data: JSON.stringify({
			"type" : "survey",
			"siteID" : oldSiteID,
			"userID" : 599,
			"password" : "opendevpass",
			//survey
			"circle" : circle,
			"survey" :  orientation,
			"timeStart" :  date + " " + time,
			"temperatureMin" : 9999,
			"temperatureMax" : 9999,
			"siteNotes" :  siteNotes,
			"plantSpecies" : plantSpecies,
			"herbivory" : herbivoryScore,
			"surveyType" :  observationMethod,
			"leafCount" : parseInt(numberOfLeaves),
			"source" : "Mobile"
		}),
		success: function(result){
//alert("submitted old survey");
			for(var i = 0; i < arthropodData.length; i++){
//alert("submitting arthropod order " + i + " of " + (arthropodData.length - 1));
				var newGroups = ["", "ant", "aphid", "bee", "beetle", "caterpillar", "daddylonglegs", "fly", "grasshopper", "leafhopper", "moths", "spider", "truebugs", "other", "unidentified"];
				var oldGroups = ["NONE", "Ants (Formicidae)", "Aphids and Psyllids (Sternorrhyncha)", "Bees and Wasps (Hymenoptera, excluding ants)", "Beetles (Coleoptera)", "Caterpillars (Lepidoptera larvae)", "Daddy longlegs (Opiliones)", "Flies (Diptera)", "Grasshoppers, Crickets (Orthoptera)", "Leaf hoppers and Cicadas (Auchenorrhyncha)", "Butterflies and Moths (Lepidoptera adult)", "Spiders (Araneae; NOT daddy longlegs!)", "True Bugs (Heteroptera)", "OTHER (describe in Notes)", "Unidentified"];
				var orderArthropod = oldGroups[Math.max(0, newGroups.indexOf(arthropodData[i][0]))];
				$.ajax({
					url: "http://master-caterpillars.vipapps.unc.edu/api/submission_full.php",
					type: "POST",
					crossDomain: true,
					dataType: 'json',
					data: JSON.stringify({
						"type": "order",
						"surveyID": result.surveyID,
						"userID": 599,
						"password": "opendevpass",
						//order
						"orderArthropod": orderArthropod,
						"orderLength": parseInt(arthropodData[i][1]),
						"orderNotes": arthropodData[i][3],
						"orderCount": parseInt(arthropodData[i][2]),
						//Caterpillar features
						"hairyOrSpiny": arthropodData[i][4] ? 1 : 0,
						"leafRoll": arthropodData[i][5] ? 1 : 0,
						"silkTent": arthropodData[i][6] ? 1 : 0
					}),
					success: function (arthropodResult) {
//alert("submitted arthropod order");
					},
					error: function () {
//alert("ARTHROPOD SUBMISSION ERROR: " + orderArthropod);
					}
				});
			}
		},
		error : function(xhr, status){
//alert("SURVEY SUBMISSION ERROR: " + xhr.status);
		}
	});
}
      var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var i = 0;
      var tranCheck = setInterval(function(){
        findOldSiteAndSubmitOldSurvey(data[i][0], data[i][1], data[i][2], data[i][3], data[i][4], data[i][5], data[i][6], data[i][7], data[i][8]);
        if(i == (data.length - 1)){
          clearInterval(tranCheck);
          alert("done");
        }
        document.getElementById("out").innerHTML += (i++) + "<br/> ";
      }, 1000);
    }
  };
  xhttp.open("GET", "php/getSurveysToTransfer.php", true);
  xhttp.send();
    </script>
  </head>
  <body>
    <div id="out"></div>
  </body>
</html>
