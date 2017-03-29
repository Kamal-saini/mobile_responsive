<?php

require_once(dirname(__FILE__) . '../../../config/config.inc.php');
require_once(dirname(__FILE__) . '../../../init.php');
include(dirname(__FILE__) . '/responsive.php');

$my_module = new RESPONSIVE();


    //$url = "http://188.166.238.255/project/";
    $url = _PS_BASE_URL_ . __PS_BASE_URI__;    
   
	if (!empty((Configuration::get("RESPONSIVE_GOOGLE_API")))){
		
	$myKEY = Configuration::get("RESPONSIVE_GOOGLE_API");
	}else{
		$myKEY = "AIzaSyAsAD56f-gh0C7v2Fg2KnAPeQRGb9kD_9I";
	}   
 

    $mobile_ready = json_decode($my_module->isMobileReady($url, $myKEY), true);
    

     echo "<div class='mobileresponse_custom'>";               
    echo "<div class='mobileresponse'> Score<br> ";
    if ($mobile_ready['ruleGroups']['USABILITY']['score'] || isset($mobile_ready['ruleGroups'])) {
        echo $mobile_ready['ruleGroups']['USABILITY']['score'];
    } else {
        echo '0';
    }
    echo "</samp>/100%<span class='phon_result'><br>";
    if ($mobile_ready['ruleGroups']['USABILITY']['pass'] == '1' || isset($mobile_ready['ruleGroups']['USABILITY']['pass'])) {
        echo "Passed";
    } else {
        echo "Failed";
    }
    echo "</span>";
    echo "</div>";
     echo "</div>";
   
    if($mobile_ready['ruleGroups']['USABILITY']['score'] < 80 ){
       echo   "<p class='developer_web'> Need developers to fix responsiveness? <a href='http://www.cwebconsultants.com/' class= target='_blank' >   click here. </a></p>";
    }

?>
