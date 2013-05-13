<?php

 //extraneous function..
 function getJobCount($key, $keywords, $location){
  $location = urlencode($location);
		$keywords = urlencode($keywords);
		$url = "http://api.careerbuilder.com/V1/jobsearch?DeveloperKey=$key&ExcludeNational=True&Keywords=$keywords&Location=$location&PerPage=1";
		try {
			$xml = simplexml_load_file($url);
		}catch(Exception $e){
			print_r($e);
		}
		
		$count = $xml->TotalCount;
		return $count;
 }
 
 
 //extraneous function..
 function getJobCountSinceDate($key, $keywords, $location, $daysBackToLook){
  $location = urlencode($location);
		$keywords = urlencode($keywords);
		$url = "http://api.careerbuilder.com/V1/jobsearch?DeveloperKey=$key&ExcludeNational=True&Keywords=$keywords&Location=$location&PostedWithin=$daysBackToLook";
		 
		try {
			$xml = simplexml_load_file($url);
		}catch(Exception $e){
			print_r($e);
		}
                 
		$count = $xml->TotalCount;
		return $count;
		
 }
 
 
 //API..
 //@return 1 (true; has onlineApplication)... or return 0 (false; does NOT have onlineApplication)...
 function onlineApplicationTrueFalse($key, $DID){
  $url = "http://api.careerbuilder.com/v1/application/blank?JobDID=$DID&DeveloperKey=$key";    //Doesn't like spaces between the begin/end quotes and the url info.. so keeping it tight..

  try{
	 $xml = simplexml_load_file($url);
	}catch(Exception $e){
	 print_r($e);
	}
	 
	foreach($xml as $k1 => $v1){
   if($k1 == 'Errors')
   {
    if( count($v1) < 1 )
    {
     return 1;
    }
    else{
     return 0;
    }
   }
  }

 } //end onlineApplicationTrueFalse()..
 
  //echo getJobCount('WDTZ14P67NZKL453DBTN', 'php', 'atlanta');
  
  //echo getJobCountSinceDate('WDTZ14P67NZKL453DBTN', 'php', 'san diego', 7);  //daysBackToLook (default to 30.. must be either 1,3,7,30 ...
 
   echo onlineApplicationTrueFalse('WDTZ14P67NZKL453DBTN', 'J3J6ZT6XHXWY7CFN5C1' );
   
   
   //Steps to work:
   /*
   *  1.) Gather all fields for database insertion..
   *  2.)  If the record returns true @ 'onlineApplicationTrueFalse()' :
   *   a.) Perform logic related to actually accepting the requirements page, then..
   *   b.) Fill out all required fields (including resume), then submit..        
   *
   *
   */         
   
 
?>
