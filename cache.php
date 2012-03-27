<?php
/**
 * Caching the body of a HTTP response
 * Licensed under WTFPL
 * @param $url string
 * @param $skip_cache bool
 * @return mixed $data | FALSE
 */
function cache_url($url, $skip_cache = FALSE) {
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
	if ($filetimemod < time() OR $skip_cache) {
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
		if ($data AND ! $skip_cache) {
			file_put_contents($file, $data);
		}
	} else {
		$data = file_get_contents($file);
	}
	
	return $data;
}
