<?php
/**
 * Caching something with just one function
 * Licensed under WTFPL 
 * @param string
 * @return mixed
 */
function cache_url($url) {
	// settings
	$cachetime = 604800; //one week
	$where = "cache";
	if ( ! is_dir($where)) {
		mkdir($where);
	}
	
	$hash = md5($url);
	$file = "$where/$hash.cache";
	
	// check the bloody file.
	$mtime = 0;
	if (file_exists($file)) {
		$mtime = filemtime($file);
	}
	$filetimemod = $mtime + $cachetime;
	
	// if the renewal date is smaller than now, return true; else false (no need for update)
	if ($filetimemod < time()) {
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_HEADER         => FALSE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_USERAGENT      => 'Googlebot/2.1 (+http://www.google.com/bot.html)',
			CURLOPT_FOLLOWLOCATION => TRUE,
			CURLOPT_MAXREDIRS      => 5,
			CURLOPT_CONNECTTIMEOUT => 15,
			CURLOPT_TIMEOUT        => 30,
		));
		$data = curl_exec($ch);
		curl_close($ch);
		
		// save the file if there's data
		if ($data) {
			file_put_contents($file, $data);
		}
	} else {
		$data = file_get_contents($file);
	}
	
	return $data;
}
