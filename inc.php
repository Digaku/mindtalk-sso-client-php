<?php
/**
 * Copyright (C) 2011 Ansvia.
 * License:			MIT
 * File:           inc.php
 * Summary:        Helper.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("config.php");


/**
 * function url_get_data
 * Helper untuk url GET.
 * Get data from given url.
 * @param {String} $url -- url to download.
 */
function url_get_data($url)
{
	$ch = curl_init($url);
	
	curl_setopt( $ch, CURLOPT_HEADER, false );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	
	$result = curl_exec( $ch );
	
    curl_close( $ch );
    
	return $result;
}

/**
 * Helpers untuk ngepost data.
 */
function url_post_data($url, $params)
{

    $data = array();
    
    foreach($params as $k => $v){
        $data[] = $k . "=" . urlencode($v);
    }
    
    $form_data = implode("&", $data);
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, count($form_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);    
    
    $result = curl_exec( $ch );
    
    curl_close($ch);
    
    return $result;
}

