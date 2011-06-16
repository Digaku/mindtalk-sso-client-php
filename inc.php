<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           inc.php
 * Summary:        Digaku SSO engine example.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

/**
 * Please set DOMAIN_NAME correctly or your browser cannot save cookie
 * and produce infinite redirect loop.
 */
define("DOMAIN_NAME", "sso-client.com");

define("BASE_URL", "http://". DOMAIN_NAME ."/~Robin/mtsso");
define("SSO_API_KEY", "809d4c10fead4d31076e0b52624ea1426fb872ba");
define("SSO_API_ENDPOINT", "sso.example.com:2195");


/**
 * Helpers
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

