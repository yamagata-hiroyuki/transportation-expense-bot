<?php
    define("DEBUG_LOG_OUT","true");

	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $str,$ary = NULL){
	    if(DEBUG_LOG_OUT){
	        if($ary == NULL){
	           echo $str."\n";
	        }else{
	           echo $str."\n";
	           print_r($ary);
	           echo "\n";
	        }
	    }
	}
?>