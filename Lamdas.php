<?php
    define("DEBUG_LOG_OUT","true");

	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $str){
	    if(DEBUG_LOG_OUT){
	        echo $str;
	    }
	}
?>