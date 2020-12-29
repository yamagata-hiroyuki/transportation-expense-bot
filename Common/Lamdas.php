<?php
    define("DEBUG_LOG_OUT","true");

	$DEF = function($defName){return $defName;};

	function DEBUG_LOG(string $file, string $func, string $line, string $str,$ary = NULL){
	    if(DEBUG_LOG_OUT){
	        if($ary == NULL){
	            echo $file."::".$func."()::".$line."::".$str."\n";
	        }else{
	            echo $file."::".$func."()::".$line."::".$str."\n";
	           print_r($ary);
	           echo "\n";
	        }
	    }
	}
?>