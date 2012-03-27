<?php
    /*
     * Caching something with just one function
     * Licensed under WTFPL 
     */
	function open($url){
  		// settings
	 	$cachetime = (60 * 60 * 24 * 7); //one week
		$where = "cache";

		$file = "$where/". md5($url) .".cache";
	 	// check the bloody file.
 		if (file_exists($file)) 
 			$filetimemod = filemtime($file) + $cachetime;
 		//if the renewal date is smaller than now, return true; else false (no need for update)
        if (@$filetimemod < time()) {
     			//echo "remote shit";
     			//curl iz here	
				$ch=curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
				$data=curl_exec($ch);
				curl_close($ch);
		//save the file		
		file_put_contents("$where/". md5($url) .".cache" , $data);
     	} else {        
		//echo "local file";
		$data = file_get_contents($file);
        }

  	echo "$data";
}


echo open ("http://www.google.ro");