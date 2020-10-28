<?php

 ini_set('allow_url_include', 'On');
 
  $opts = array('http' => array(
    'method' => "GET",
    'header' =>
    "Content-Type: application/x-www-form-urlencoded\r\n",
  ));
  

  $context = stream_context_create($opts);
  $city = file_get_contents('http://13.233.29.39:8012/getAllCity', false, $context);
  $getAllCity = json_decode($city, true);
  
  if($city === false)
  {
	print_r(error_get_last());
	phpinfo();
	die(__FILE__ . __LINE__);
  }



  $exp = file_get_contents('http://13.233.29.39:8012/getAllExercise', false, $context);
  $getAllExercise = json_decode($exp, true);
 
  
?>