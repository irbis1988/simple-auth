<?php

class Helper{		
	
	public static function t($word=''){		
		
		if(isset($GLOBALS['lang'][$word])){
			return $GLOBALS['lang'][$word];
		}else{
			return $word;
		}
		
	}	
	
}


