<?php
  header('Access-Control-Allow-Origin: *');
  
  require_once("../orm/resources/mailing.php");
  
  email4("plocharczykweb@gmail.com", "The Caterpillars Count! Season Has Begun!", "Aaron");
  email5("plocharczykweb@gmail.com", "Need Help Submitting Caterpillars Count! Surveys?", "Aaron");
  email6("plocharczykweb@gmail.com", "Touching Base about Example Site", "Example Site");
?>
